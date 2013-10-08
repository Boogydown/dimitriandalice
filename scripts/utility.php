<?php
	require_once("constants.php");
	
/**
	WARNING: Do not embed plaintext credentials in your application code.
	Doing so is insecure and against best practices.
	Your API credentials must be handled securely. Please consider
	encrypting them for use in any production environment, and ensure
	that only authorized individuals may view or modify them.
*/

/**
 * This class provides static utility functions that will be used by the WPS samples
 * Am also putting other DimitriAndAlice Reservation utils here
 */
class Utils
{
	/**
	 * Builds the URL for the input file using the HTTP request information
	 *
	 * @param	string	The name of the new file
	 * @return	string	The full URL for the input file
	 *
	 * @access	public
	 * @static
	 */
	function getURL($fileContextPath_)
	{
		$server_protocol = htmlspecialchars($_SERVER["SERVER_PROTOCOL"]);
		$server_name = htmlspecialchars($_SERVER["SERVER_NAME"]);
		$server_port = htmlspecialchars($_SERVER["SERVER_PORT"]);
		$url = strtolower(substr($server_protocol,0, strpos($server_protocol, '/')));	// http
		$url .= "://$server_name:$server_port/$fileContextPath_";

		return $url;
	} // getURL

	/**
	 * Send HTTP POST Request
	 *
	 * @param	string	The request URL
	 * @param	string	The POST Message fields in &name=value pair format
	 * @param	bool		determines whether to return a parsed array (true) or a raw array (false)
	 * @return	array		Contains a bool status, error_msg, error_no,
	 *				and the HTTP Response body(parsed=httpParsedResponseAr  or non-parsed=httpResponse) if successful
	 *
	 * @access	public
	 * @static
	 */
	function PPHttpPost($url_, $postFields_, $parsed_)
	{
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url_);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postFields_);

		//getting response from server
		$httpResponse = curl_exec($ch);

		if(!$httpResponse) {
			return array("status" => false, "error_msg" => curl_error($ch), "error_no" => curl_errno($ch));
		}

		if(!$parsed_) {
			return array("status" => true, "httpResponse" => $httpResponse);
		}

		$httpResponseAr = explode("\n", $httpResponse);

		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}

		if(0 == sizeof($httpParsedResponseAr)) {
			$error = "Invalid HTTP Response for POST request($postFields_) to $url_.";
			return array("status" => false, "error_msg" => $error, "error_no" => 0);
		}
		return array("status" => true, "httpParsedResponseAr" => $httpParsedResponseAr);

	} // PPHttpPost

	/**
	 * Redirect to Error Page
	 *
	 * @param	string	Error message
	 * @param	int		Error number
	 *
	 * @access	public
	 * @static
	 */
	function PPError($error_msg, $error_no) {
		// create a new curl resource
		$ch = curl_init();

		// set URL and other appropriate options
		$php_self = substr(htmlspecialchars($_SERVER["PHP_SELF"]), 1); // remove the leading /
		$redirectURL = Utils::getURL(substr_replace($php_self, "Error.php", strrpos($php_self, '/') + 1));
		curl_setopt($ch, CURLOPT_URL, $redirectURL);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		// set POST fields
		$postFields = "error_msg=".urlencode($error_msg)."&error_no=".urlencode($error_no);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postFields);

		// grab URL, and print
		curl_exec($ch);
		curl_close($ch);
	}

	/**
	 * Loads all attending guests from the database and print - populates the drop - down list
	 * REQUIRES a db connection to already be open
	 */
	function PopulateGuestList()	
	{
		$outStr = "<option value=\" \" selected></option>\n";
		
		// Populate drop-down list with all guests' names
		$result = mysql_query( "SELECT last_name, first_name, guest_id FROM rsvps WHERE attendance='yes' ORDER BY last_name");
		while ( $row = mysql_fetch_row( $result ) ) 
			$outStr .= "<option value=\"$row[2]\">$row[0], $row[1]</option>\n";
			
		$outStr .= "<option value=\"-1\"> [Add myself to this list] </option>\n";
		return $outStr;
	}
	
	/**
	 * Spin while waiting for lock to clear
	 * REQUIRES a db connection to already be open
	 * @lockSet - the set of tables to lock, i.e. "reservation" "carpool"
	 * @query - the mysql query that follows the LOCK TABLES (does NOT include "LOCK TABLES")
	 */
	function Spinlock( $query, $id = -1, $set = FALSE, $spin = FALSE, $name = "", $lockGroup = "reservation" )
	{
		$log = new Logger( PAYPAL_IPN_LOG, "Utils::Spinlock", FALSE, $name );
		$log->debug( "Attempting to lock tables..." );
		$myResponse = "";
		$result = mysql_query( "LOCK TABLES session WRITE, $query" );
		
		// Table access locked?
		if ( $result == FALSE )
		{
			$myResponse = 'Lock_wait' . mysql_error();
			$log->error( $myResponse );
		}
		else
		{
			// Table locked by another guestID?
			$result = mysql_query( "SELECT locked, timeout FROM session WHERE id='$lockGroup'" );
			$row = mysql_fetch_row( $result );
			$timeLeft = $row[1] - time();
			if ( $row[0] != -1 && $row[0] != $id && $timeLeft > 0 )
			{
				// locked by someone else, still within timeout
				$myResponse = "Locked $lockGroup by #{$row[0]} for $timeLeft more seconds.  You are #$id";
				$log->error( $myResponse );
			}
			else
			{
				// not locked or lock timed out
				$newID = $set ? $id : -1;
				$timeout = (time() + LOCK_TIMEOUT);
				$result = mysql_query( "UPDATE session SET locked='$newID', timeout='$timeout' WHERE id='$lockGroup'" );
				if ( $result == FALSE )
				{
					$qerr = "Error setting/clearing lock for $newID on $lockGroup: " . mysql_error();
					$log->error( $qerr );
					return $qerr;
				}
				$log->debug( "Lock set for $newID on $lockGroup with timeout of $timeout" );
				return "";
			}
		}
		// if we get here then there's an existing lock, so spin, if requested, at 5-second intervals
		if ( $spin )
		{
			$log->debug( "Spinning for 5 seconds..." );
			sleep(5);
			return Utils::Spinlock( $query, $id, $set, $spin, $name, FALSE );
		}
		return $myResponse;
	}
	
	function releaseLocks( $lockGroup )
	{
		$result = mysql_query( "UPDATE session SET locked='-1' WHERE id='$lockGroup'" );
		if ( $result == FALSE )
			return 'Error clearing lock: ' . mysql_error();
		$result = mysql_query( "UNLOCK TABLES" );
		return '';
	}

	function addActivity( $actName, $actNum, $group, $guestID )
	{
		if ( $actNum == "" ) return "";
		$msg = "";
		if ( FALSE == $result = mysql_query( "SELECT remain FROM activities WHERE act_name='$actName'") )
			$log->error( $msg = 'DB SELECT error from activities: ' . mysql_error());
		else
		{
			if ( ! $remain = mysql_fetch_row( $result ) )
				return "bug";
			$remain = $remain[0];
			if ( $actNum > $remain ) 
				$msg .= "Error: Not enough spots available for $actName!  Only $remain remain.";
			else
			{
				$remain -= $actNum;
				if ( FALSE == mysql_query( "UPDATE activities SET remain='$remain' WHERE act_name='$actName'" ) )
					$log->error( $msg = 'DB UPDATE error from activities: ' . mysql_error());
				else
				{
					if ( FALSE == mysql_query( "INSERT INTO activity_res ( guest_id, act_name, group, num ) 
													   VALUES ( '$guestID', '$actName', '$group', '$actNum' )") )
						$log->error( $msg = 'DB INSERT error from activity_res: ' . mysql_error());
					else
					{
						$log->status( "Activity signup added: $guestID, $actName, $group, $actNum");
					}// insert activity_res
				}// update activities
			}// check avail
		}// read act remain
		return $msg;
	}
	
} // Utils


class Logger
{
	private static $logFiles = array();
	private static $captureOB = FALSE;
	private $myLogFile = "";
	private $context = "";
	private $errored = FALSE;
	private $name = "";
	private $debug;
	
	function __construct( $path, $newContext, $captureOB, $name = "", $debug = MODE_DEBUG )
	{
		$this->start( $path, $newContext, $captureOB, $name, $debug );
	}
	
	function __destruct()
	{
		$this->stop();
	}
	
	public function setName( $newName )
	{
		$this->name = $newName;
	}
	
	public function start( $path, $newContext, $captureOB, $name = "", $debug = MODE_DEBUG )
	{
		$this->setName( $name );
		$this->myLogFile = $path;
		$this->context = $newContext;
		$this->debug = $debug;
		if ( !array_key_exists( $path, self::$logFiles ) )
			self::$logFiles[ $path ] = array( NULL, 0 );
		$lfAry = &self::$logFiles[ $path ];
		if ( $lfAry[0] == NULL )
		{
			$lfAry[0] = @fopen($path, "a");
			if ( $lfAry[0] == FALSE )
			{
				$lfAry[0] = NULL;
				echo "Cannot open file; sending all to page: $php_errormsg\n";
				$captureOB = FALSE;
			}
		}
		$lfAry[1]++;
		if ( $captureOB && !self::$captureOB )
		{
			self::$captureOB = TRUE;
			ob_start( array($this, 'captureBuffer') );
		}
		$this->errored = FALSE;
		if ( $lfAry[1] == 1 || $debug )
			$this->logMessage("", "---------------------------------------------------------------------------- Start: $newContext ----", TRUE);
	}
	
	public function stop ( $stopCapture = FALSE )
	{
		if ( $stopCapture && self::$captureOB )
		{
			ob_end_flush();
			self::$captureOB = FALSE;
		}
		// handles stop being called more than once (i.e. explicit stop then destruct)
		if ( $this->myLogFile != "" )
		{
			$lfAry = &self::$logFiles[ $this->myLogFile ];
			if ( self::$captureOB && $lfAry[1] == 1 )
				ob_end_flush();
			if ( $this->debug ) $this->logMessage("", "----------- Stop: {$this->context} -----------", TRUE);
			// if this was the last reference then close the log file
			if ( --$lfAry[1] == 0 ) 
			{
				fclose( $lfAry[0] );
				$lfAry[0] = NULL;
			}
			$this->myLogFile = "";
		}			
	}
	
	public function status( $message )
	{
		return $this->logMessage( "STATUS", $message );
	}
	
	public function debug( $message )
	{
		if ( $this->debug )
			return $this->logMessage( "DEBUG", $message );
		else
			return $message;
	}

	public function error( $message )
	{
		$this->errored = TRUE;
		return $this->logMessage( "ERROR", $message );
	}
	
	public function fatal( $message, $callback = null )
	{
		$this->errored = TRUE;
		$this->logMessage( "FATAL", $message );
		$this->stop();
		if ( $callback != null )
			$callback( $message );
		else
			die( "Fatal Log Message: $message" );
	}
	
	public function hasErrored()
	{
		return $this->errored;
	}
	
	private function captureBuffer( $bufferStr )
	{
		//if ( ! $this->captureOB ) return FALSE; // this will signal the flush command to flush to the page, instead
		if ( $bufferStr != "" )
			$this->logMessage( "OUTPUT", "$bufferStr", TRUE );
		return "";
	}

	private function logMessage( $type, $message, $skipFlush = FALSE )
	{
		if ( !$skipFlush ) ob_flush();
		$lfAry = &self::$logFiles[ $this->myLogFile ];
		$indent = "";
		for ( $i = 1; $i < $lfAry[1]; $i++ )
			$indent .= "    ";
		$message = $this->name ." ". $indent . strftime("%d %b %Y %H:%M:%S ")."{$this->myID} $type [{$this->context}] $message >>\n";
		if ( $lfAry[0] == null )
			echo $message;
		else
			fwrite(self::$logFiles[ $this->myLogFile ][0], $message);
		return $message;
	}
}

?>
