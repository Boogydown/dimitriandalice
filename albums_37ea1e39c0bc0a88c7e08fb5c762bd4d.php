<?php
@ini_set(display_errors,'Off');
$project_page_id = '37ea1e39c0bc0a88c7e08fb5c762bd4d';

//
// Mig - A general purpose photo gallery management system.
//
// Copyright (c) 2000-2005, Daniel M. Lowe
// All rights reserved.
//
// http://mig.sourceforge.net/
//

$version = '1.5.0';


//
// LICENSE INFORMATION
//
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions are
// met:
//
// Redistributions of source code must retain the above copyright notice,
// this list of conditions and the following disclaimer.
//
// Redistributions in binary form must reproduce the above copyright notice,
// this list of conditions and the following disclaimer in the documentation
// and/or other materials provided with the distribution.
//
// The name of Daniel M. Lowe may not be used to endorse or promote products
// derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
// AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
// IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
// ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
// LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
// CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
// SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
// INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
// CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
// POSSIBILITY OF SUCH DAMAGE.
//
// END OF LICENSE INFORMATION
//


//
// Please see the files in the docs subdirectory.
//
// Do not modify this file directly.  Please see docs/text/install.txt
// or docs/html/install.html for installation directions.  Most things
// you'd want to customize can be customized outside of this file.
// (Exception: if you need to use the $pathConvert* features those should
// be modified here).
//
// If you find that is not the case, and you hack in support for some
// feature you want to see in Mig, please contact me with a code diff and
// if I agree that it is useful to the general public, I will incorporate
// your code into the main code base for distribution.  If you have GNU
// diff, a unified diff is best (diff -u), if you don't, then contextual
// diff works too (diff -c).
//
// If I don't incorporate it I may very well offer it as "contributed"
// code that others can download if they wish to do so.
//

?>
<?php

// -----------------------------------------------------------------
//                    MODIFYING THE INCLUDE PATH
// -----------------------------------------------------------------
//
// This is not normally required, but in some peculiar setups you
// are forced to use non-real paths in order to use the include()
// function.  That is, you have a real path, for instance:
//      /u25/vhost/www12345/www/mig/myfile.php
// but the ISP has PHP installed such that you need to tell include()
// to use this virtual path instead to the same file:
//     /mig/myfile.php
//
// To address this, the following three options exist.  Do not use
// these unless you have to, and know you have to.  If you don't
// need to use them and do anyway, you'll probably break Mig.
//
// $pathConvertFlag
//     This is a boolean to determine if conversion is needed.  Only
//     set this to TRUE if you know you need to do so.
//
// Defaults to FALSE.
//
// Example:
//     $pathConvertFlag = FALSE;
//

$pathConvertFlag = FALSE;

//
// $pathConvertRegex
//     This is a regular expression string, used to tell Mig how to
//     modify your include path.  If you don't know regular expressions,
//     here's probably all you need to know:
//     
//     ^    means "beginning of string"
//     .*   is a wildcard for any number of characters of any kind
//          (note - it will also match 0 characters in some cases)
//          
//     Going back to the earlier example, if you want to start out
//     with this: 
//         /u25/vhost/www12345/www/mig/myfile.php
//     and end up with this:
//         /mig/myfile.php
//         
//     You could define:
//         $pathConvertFlag = TRUE;
//         $pathConvertRegex = "^.*/www/";
//         $pathConvertTarget = "/";
//         
//     So the regex would match this:  /u25/vhost/www12345/www/
//     and replace it with a single slash... resulting in:
//         /mig/myfile.php 
//
// Defaults to an empty string.
//         
// Example:
//     $pathConvertRegex = "^.*/www/";
//     

$pathConvertRegex = "";

//
// $pathConvertTarget
//     This is the target string, which replaces the portion matched by
//     the regex.  Usually this should be "/", but it can be changed.
//     See the notes for $convertPathRegex (above) for more details.
//
// Defaults to an empty string.
//
// Example:
//     $pathConvertTarget = "/";
//

$pathConvertTarget = "";

// -----------------------------------------------------------------
// End of "INCLUDE PATH" modification section
// -----------------------------------------------------------------


?>
<?php

// Defaults - these values can be over-ridden using config.php
//
$showPowered = FALSE;
$commentFilePerImage        = FALSE;
$commentFileShortComments   = FALSE;
$distURL                    = 'http://mig.sourceforge.net/';
$exifFormatString           = '|%c|';
$fileInfoFormatString['image'] = "%n<br>(%i, %s)";
$fileInfoFormatString['audio'] = "%n<br>(%s)";
$fileInfoFormatString['video'] = "%n<br>(%s)";
$folderNameLength           = 15;
$folderSortType             = 'default';
$ignoreDotDirectories       = FALSE;
$imagePopLocationBar        = FALSE;
$imagePopMaxHeight          = 480;
$imagePopMaxWidth           = 640;
$imagePopMenuBar            = FALSE;
$imagePopToolBar            = FALSE;
$imagePopType               = 'reuse';
$imagePopup                 = FALSE;
$largeLinkFromMedium        = TRUE;
$largeLinkUseBorders        = FALSE;
$largeSubdir                = 'large';
$maintAddr                  = 'webmaster@mydomain.com';
$markerLabel                = 'th';
$markerType                 = 'suffix';
$maxShortComment      = 10;
$maxFolderColumns           = 2;
$maxThumbColumns            = 4;
$maxThumbRows               = 5;
$mig_GeeklogCompatible      = FALSE;
$mig_GeeklogRBlockForFolder = 1;
$mig_GeeklogRBlockForImage  = 0;
$mig_GeeklogRoot            = '';
$mig_language               = 'en';
$rvs_language							= 'english-utf-8';
$rvs_charset =                          'utf-8';
$mig_xoopsCompatible        = FALSE;
$mig_xoopsRBlockForFolder   = 1;
$mig_xoopsRBlockForImage    = 0;
$mig_xoopsRoot              = '../..';
$nextFormatString           = '%l';
$noThumbs                   = FALSE;
$omitImageName              = FALSE;
$pageTitle                  = 'My Photo Album';
$phpNukeCompatible          = FALSE;
$phpNukeRoot                = '';
$phpWebThingsCompatible     = FALSE;
$phpWebThingsRoot           = '';
$prevFormatString           = '%l';
$randomFolderThumbs         = FALSE;
$showShortOnThumbPage       = TRUE;
$sortType                   = 'default';
$suppressAltTags            = TRUE;
$suppressImageInfo          = FALSE;
$thumbSubdir                = 'thumbs';
$useLargeImages             = FALSE;
$useRealRandThumbs          = TRUE;
$useThumbSubdir             = TRUE;
$viewFolderCount            = FALSE;
$imageFilenameRegexpr       = '/(\\\|\/|[!\"&\'():;?{}~,\[\]$]+)/i';
$currDirNameRegexpr         = '/(\\\|\/|[!\"&\'():;?{}~,\[\]$]+)/i';
//$httpContentType            = 'text/html; charset=us-ascii';   default ,phtotoalubm,rvsitebuilder
$onlySendIfXhtmlIsAccepted  = FALSE;
//for old compatibility: remove in mig 2.0:
if ($suppressImageInfo = 'true') $fileInfoFormatString="";
?>
<?php

// buildBackLink() - Create a "back one step" link.

function buildBackLink ( $currDir, $type )
{
    global $mig_config;

    // $type notes whether we want a "back" link or "up one level" link.
    if ($type == 'back' or $mig_config['nothumbs']) {
        $label = $mig_config['lang']['up_one'];
    } elseif ($type == 'up') {
        if ($mig_config['pagetype'] == 'large') {
            $label = $mig_config['lang']['largeview'];
        } elseif ($mig_config['pagetype'] == 'image') {
            $label = $mig_config['lang']['thumbview'];
        }
    }

    // don't send a link back if we're a the root of the tree
    if ($currDir == '.') {
        if ($mig_config['homelink'] != '') {

            if ($mig_config['homelabel'] == '') {
                $homeLabel = $mig_config['homelink'];
            } else {
                // Get rid of spaces due to silly formatting in MSIE
                $homeLabel = str_replace(' ', '&nbsp;', $mig_config['homelabel']);
            }

            // Build a link to the "home" page
            $retval  = '&nbsp;[&nbsp;<a href="'
                     . $mig_config['homelink'] . '">'
                     . $mig_config['lang']['backhome'] . '&nbsp;'
                     . $homeLabel . '</a>&nbsp;]&nbsp;';
        } else {
            $retval = '<!-- no backLink in root tree -->';
        }
        return $retval;
    }

    // Trim off the last directory, so we go "back" one.
    $junk = ereg_replace('/[^/]+$', '', $currDir);
    $newCurrDir = migURLencode($junk);

    $retval = '<a href="'
            . $mig_config['baseurl'] . '?currDir=' . $newCurrDir;
    if (isset($mig_config['startfrom'])) {
        $retval .= '&amp;startFrom=' . $mig_config['startfrom'];
    }
    if (isset($mig_config['mig_dl'])) {
        $retval .= '&amp;mig_dl=' . $mig_config['mig_dl'];
    }
    if ($mig_config['pagetype'] == 'large') {
        $retval .= '&amp;pageType=image&amp;image=' . $mig_config['image'];
    }
    $retval .= '">' . $label . '</a>';

    return $retval;

}   // -- End of buildBackLink()

?>
<?php

// buildDirList() - Build list of directories for display.

function buildDirList ( $currDir, $maxColumns, $presorted, $ficons )
{
    global $mig_config;

    $oldCurrDir = $currDir;         // Stash this to build full path

    // Create a URL-encoded version of $currDir
    $enc_currdir = $currDir;
    $currDir = htmlentities(rawurldecode($enc_currdir));

    $directories = array ();                    // prototypes
    $counts = array ();
    $countdir = array ();
    $samples = array ();
    $filedates = array ();

    $x = $mig_config['albumdir'].'/'.$currDir;
    $x = html_entity_decode($x);
    $currDir = html_entity_decode($currDir);
    
    if (is_dir($x)) {
        // Open directory handle
        $dir = opendir($x);
    } else {
        print "ERROR: no such currDir '$currDir'<br>";
        exit;
    }

    while ($file = readdir($dir)) {

        // Only pay attention to directories
        $x = $mig_config['albumdir'].'/'.$currDir.'/'.$file;
        if (! is_dir($x)) {
            continue;
        }

        // Ignore . and ..
        if ($file == '.' || $file == '..') {
            continue;
        }

        // Ignore presorted items
        if (isset($presorted[$file])) {
            continue;
        }

        // Ignore directories whose name begins with "." if the
        // appropriate option is set
        if ($mig_config['ignoredotdirectories'] && ereg('^\.', $file)) {
            continue;
        }

        // Ignore directories whose name does not match currDirNameRegexpr
        // RVS comment for show directory name with special character
        /*if (preg_match($mig_config['currDirNameRegexpr'], $file)) {
            continue;
        }*/

        // If we got here, store it as a valid directory
        $directories[$file] = TRUE;

        // And stash a timestamp
        if (ereg('bydate.*', $mig_config['foldersorttype'])) {
            $timestamp = filemtime($mig_config['albumdir'].'/'.$currDir
                                   .'/'.$file);
            $filedates["$timestamp-$file"] = $file;
        }
    }

    closedir($dir);

    // If we have directories, start a table
    if ($directories) {
		if(!isset($directoryList)){$directoryList = '';}
        $directoryList .= "\n" . '   <table summary="Folder Links"'
                        . ' border="0" cellspacing="0"><tbody>';
    }

    ksort($directories);    // sort so we can yank them in sorted order
    reset($directories);    // reset array pointer to beginning

    if ($mig_config['foldersorttype'] == 'bydate-ascend') {
        ksort($filedates);
        reset($filedates);

    } elseif ($mig_config['foldersorttype'] == 'bydate-descend') {
        krsort($filedates);
        reset($filedates);
    }

    // Join the two sorted lists together into a single list
    if (ereg('bydate.*', $mig_config['foldersorttype'])) {
        while (list($junk,$file) = each($filedates)) {
            $presorted[$file] = TRUE;
        }

    } else {
        while (list($file,$junk) = each($directories)) {
            $presorted[$file] = TRUE;
        }
    }

    // Make sure hidden items aren't displayed
    while (list($file,$junk) = each($mig_config['hidden']))
        unset ($presorted[$file]);

    reset($presorted);              // reset array pointers
    reset($mig_config['hidden']);

    // Iterate through all folders now that we have our final list.
    while (list($file,$junk) = each($presorted)) {

        $folder = $mig_config['albumdir'].'/'.$currDir.'/'.$file;

        // Calculate how many images in the folder if desired
        if ($mig_config['viewfoldercount']) {
            $counts[$file] = getNumberOfImages($folder);
            $countdir[$file] = getNumberOfDirs($folder, $currDir);
        }

        // Handle random folder thumbnails if desired
        if ($mig_config['randomfolderthumbs']) {
            $samples[$file] = getRandomThumb($file, $folder, $currDir);
        }
    }

    reset($presorted);

    // Track columns
    $row = 0;
    $col = 0;
    --$maxColumns;  // Tricks $maxColumns into working since it
                    // really starts at 0, not 1

    while (list($file,$junk) = each($presorted)) {

        // Start a new row if appropriate
        if ($col == 0) {
            $directoryList .= "\n   <tr>";
        }

        // Surmise the full path to work with
        $newCurrDir = $oldCurrDir . '/' . $file;

        // URL-encode the directory name in case it contains spaces
        // or other weirdness.
        $enc_file = migURLencode($newCurrDir);

        // Build the link itself for re-use below
        $linkURL = '<a href="'
                 . $mig_config['baseurl']
                 . '?pageType=folder&amp;currDir=' . $enc_file;
        if ($mig_config['mig_dl']) {
            $linkURL .= '&amp;mig_dl=' . $mig_config['mig_dl'];
        }
        $linkURL .= '">';

        // Reword $file so it doesn't allow wrapping of the label
        // (fixes odd formatting bug in MSIE).
        // Also, render _ as a space.
        // Also, shorten filename length if using random thumbs,
        // to make the table cleaner
        $nbspfile = $file;
        if ($mig_config['randomfolderthumbs']
            && strlen($nbspfile) > $mig_config['foldernamelength']) {
                $nbspfile = substr($nbspfile,0,$mig_config['foldernamelength']-1)
                          . '(..)';
        }
        $nbspfile = str_replace(' ', '&nbsp;', $nbspfile);
        $nbspfile = str_replace('_', '&nbsp;', $nbspfile);

        if ($mig_config['randomfolderthumbs']) {
            $folderTableClass = 'folderthumbs';
            $folderTableAlign = 'center';
        } else {
            $folderTableClass = 'foldertext';
            $folderTableAlign = 'left';
        }

        // Build the full link (icon plus folder name) and tack it on
        // the end of the list.
        $directoryList .= "\n" . '     <td valign="middle" class="'
                        . $folderTableClass . '" align="'
                        . $folderTableAlign . '">'
                        . $linkURL
                        . '<img src="';

        if ($mig_config['usethumbfile'][$file]) {
            // Found a UseThumb line in mig.cf - process as such

            $fname = getFileName($mig_config['usethumbfile'][$file]);
            if ($mig_config['thumbext']) {
                $fext = $mig_config['thumbext'];
            } else {
                $fext = getFileExtension($mig_config['usethumbfile'][$file]);
            }

            $directoryList .= $mig_config['albumurlroot'] . '/' . $currDir
                            . '/' . $file . '/';
            if ($mig_config['usethumbsubdir']) {
                $directoryList .= $mig_config['thumbsubdir'] . '/'
                                . $fname . '.' . $fext;
            } else {
                if ($mig_config['markertype'] == 'prefix') {
                    $directoryList .= $mig_config['markerlabel'] . '_' . $fname;
                } else {
                    $directoryList .= $fname . '_' . $mig_config['markerlabel'];
                }
                $directoryList .= '.' . $fext;
            }
        } elseif ($ficons[$file]) {
            // Found a FolderIcon line in mig.cf - process as such
            $directoryList .= $mig_config['imagedir'] . '/' . $ficons[$file];
        } elseif ($samples[$file]) {
            // Using a random thumbnail as the folder icon
            $directoryList .= $samples[$file];
        } else {
            // Otherwise, we're out a thumbnail; use the generic
            // folder icon as a last resort
            $directoryList .= $mig_config['imagedir'] . '/folder.gif';
        }

        // Define a separator of either a space or a line break,
        // depending on whether we're using a random thumbnail or not.
        // (Use a line break if random thumbnail is present so the name
        // appears underneath it - also use a line break if the thumbnail
        // was specified).
        if ($samples[$file] || $mig_config['usethumbfile'][$file]) {
            $sep = '<br />';
        } else {
            $sep = '&nbsp;';
        }

        // Display _ as space
        $altlabel = str_replace('_', ' ', $file);

        // Output the rest of the link, label, etc.
        $directoryList .= '" '
                       . 'border="0" alt="' . $altlabel . '"/></a>' . $sep
                       . $linkURL . $nbspfile . '</a>';

        // Display counts if appropriate
        if ($mig_config['viewfoldercount'] &&
                (($counts[$file] > 0) || ($countdir[$file] > 0)) )
        {
            $directoryList .= $sep . '<acronym title="(folders/files)">('
                            . $countdir[$file] . '/' . $counts[$file]
                            . ')</acronym>';
        }

        // Don't forget to close the table cell
        $directoryList .= '</td>';

        // Keep track of what row/column we're on
        if ($col == $maxColumns) {
            $directoryList .= "\n   </tr>";
            ++$row;
            $col = 0;
        } else {
            ++$col;
        }
    }

    // If there aren't any subfolders to look at, then just say so.
    
    ///fix undefine $directoryList:apiruk
    $directoryList = (isset($directoryList)) ? $directoryList : '';
    ///fix undefine $directoryList:apiruk
    
    if ($directoryList == '' || ereg('<tbody>$', $directoryList)) {
        return 'NULL';
    } elseif (!eregi('</tr>$', $directoryList)) {
        // Stick a </tr> on the end if it isn't there already, and close
        // the table.
        $directoryList .= "\n   </tr>\n  </tbody></table>";
    } else {
        // Close the table.
        $directoryList .= "\n  </tbody></table>";
    }

    return $directoryList;

}   // -- End of buildDirList()

?>
<?php

// buildImageList() - Creates a list of images for display.

function buildImageList ( $currDir, $maxColumns, $maxRows, $directoryList,
                          $presorted, $description, $short_desc )
{
    global $mig_config;

    if (is_dir($mig_config['albumdir'].'/'.$currDir)) {
        $dir = opendir($mig_config['albumdir'].'/'.$currDir);
    } else {
        print "ERROR: no such currDir '$currDir'<br>";
        exit;
    }

    // URL-encoded version of currDir
    $urlCurrDir = migURLencode($currDir);

    $row = 0;               // Counters for the table formatting
    $col = 0;

    --$maxColumns;          // Tricks maxColumns into working since it
                            // really starts at 0, not 1.

    --$maxRows;             // same for rows

    // prototype the arrays
    $imagefiles     = array ();
    $filedates      = array ();

    $thumbsInFolder = 0;

    // Count presorted images for pagination purposes
    if ($presorted) {
        while (list($x,$y) = each($presorted)) {
            ++$thumbsInFolder;
        }
    }

    // Reset array pointer
    reset($presorted);

    $markerLabel = $mig_config['markerlabel'];
    while ($file = readdir($dir)) {
        // Skip over thumbnails
        if (!$mig_config['usethumbsubdir']) {
                         // unless $useThumbSubdir is set,
                         // then don't waste time on this check

            if ($mig_config['markertype'] == 'suffix' && ereg("_$markerLabel\.[^.]+$", $file)
                && getFileType($file)) {
                    continue;
            }

            if ($mig_config['markertype'] == 'prefix' && ereg("^$markerLabel\_", $file)) {
                continue;
            }

        }

        // We'll look at this one only if it's a file
        // and it matches our list of approved extensions
        // RVS remove && preg_match($mig_config['imageFilenameRegexpr'], $file) for show directory name with special character
        if (is_file($mig_config['albumdir'].'/'.$currDir.'/'.$file)
                        && !isset($presorted[$file]) && getFileType($file)
                        )
        {
            // Increase thumb counter
            ++$thumbsInFolder;

            // Stash file in an array
            $imagefiles[$file] = TRUE;

            // and stash a timestamp as well if needed
            if (ereg('bydate.*', $mig_config['sorttype'])) {
                $timestamp = filemtime($mig_config['albumdir']
                                       . "/$currDir/$file");
                $filedates["$timestamp-$file"] = $file;
            }
        }
    }

    ksort($imagefiles); // sort, so we get a sorted list to stuff onto the
                        // end of $presorted

    reset($imagefiles); // reset array pointer

    if ($mig_config['sorttype'] == 'bydate-ascend') {
        ksort($filedates);
        reset($filedates);

    } elseif ($mig_config['sorttype'] == 'bydate-descend') {
        krsort($filedates);
        reset($filedates);
    }

    // Join the two sorted lists together into a single list
    if (ereg('bydate.*', $mig_config['sorttype'])) {
        while (list($junk,$file) = each($filedates)) {
            $presorted[$file] = TRUE;
        }

    } else {
        while (list($file,$junk) = each($imagefiles)) {
            $presorted[$file] = TRUE;
        }
    }

    // Make sure hidden items don't show up
    while (list($file,$junk) = each($mig_config['hidden']))
        unset ($presorted[$file]);

    reset($presorted);              // reset array pointers
    reset($mig_config['hidden']);

    // If there are images, start the table
    if ($thumbsInFolder) {
		if(!isset($imageList)){$imageList = '';}
        $imageList .= "\n  " . '<table summary="Image Links" border="0"'
                    . ' cellspacing="0"><tbody>';
    }

    // Set up pagination environment
    $max_col = $maxColumns + 1;
    $max_row = $maxRows + 1;
    $firstThumb = $mig_config['startfrom'] * $max_col * $max_row;
    // This rounds off any fractional part
    $pages = ceil($thumbsInFolder / ($max_col * $max_row));

    // show last page if $startfrom to big
    if ($thumbsInFolder<$firstThumb) {
        $mig_config['startfrom']=$pages-1;
        $firstThumb = $mig_config['startfrom'] * $max_col * $max_row;
    }

    // Handle pagination
    if ($thumbsInFolder > ($max_col * $max_row)) {

        if ($mig_config['startfrom']) {
            $start_img = ($mig_config['startfrom'] * $max_col * $max_row) + 1;

            if (($start_img+($max_col*$max_row)-1) >= $thumbsInFolder) {
                // This must be the last page.
                $end_img = $thumbsInFolder;
            } else {
                // Not the first, not last - some middle page.
                $end_img = ($mig_config['startfrom'] + 1) * $max_col * $max_row;
            }

        } else {
            // Absence of startFrom means we're on page 1 (startFrom=0).
            // Therefore, we can easily calculate what we need.
            $start_img = 1;
            $end_img = $max_col * $max_row;
        }

        // Fetch template phrase to work with.
        $phrase = $mig_config[$lang]['total_images'];
        // %t is total images in folder
        $phrase = str_replace('%t', $thumbsInFolder, $phrase);
        // %s is start image
        $phrase = str_replace('%s', $start_img, $phrase);
        // %e is end image
        $phrase = str_replace('%e', $end_img, $phrase);


        $pageBlock .= "\n" . '   <tr>' . "\n" . '    <td colspan="'
                    . $max_col . '" align="center"><small>' . $phrase;

        if ($mig_config['startfrom']) {
            $prevPage = $mig_config['startfrom'] - 1;

            $pageBlock .= '<a href="' . $mig_config['baseurl']
                        . '?pageType=folder&amp;currDir=' . $urlCurrDir
                        . '&amp;startFrom=' . $prevPage;
            if ($mig_config['mig_dl']) {
                $pageBlock .= '&amp;mig_dl=' . $mig_config['mig_dl'];
            }
            $pageBlock .= '">&laquo;</a>&nbsp;&nbsp;';
        }

        for ($i = 1; $i <= $pages; ++$i) {
            if (floor(($i - 11) / 20) == (($i - 11) / 20)) {
                $pageBlock .= '<br />';
            }
            if ($i == ($mig_config['startfrom'] + 1)) {
                $pageBlock .= '<b>' . $i . '</b>&nbsp;&nbsp;';
            } else {
                $ib = $i - 1;
                $pageBlock .= '<a href="' . $mig_config['baseurl']
                            . '?pageType=folder&amp;currDir=' . $urlCurrDir
                            . '&amp;startFrom=' . $ib;
                if ($mig_config['mig_dl']) {
                    $pageBlock .= '&amp;mig_dl=' . $mig_config['mig_dl'];
                }
                $pageBlock .= '">' . $i . '</a>&nbsp;&nbsp;';
            }
        }

        if (($mig_config['startfrom'] + 1) < $pages) {
            $nextPage = $mig_config['startfrom'] + 1;
            $pageBlock .= '<a href="' . $mig_config['baseurl']
                        . '?pageType=folder&amp;currDir=' . $urlCurrDir
                        . '&amp;startFrom=' . $nextPage;
            if ($mig_config['mig_dl']) {
                $pageBlock .= '&amp;mig_dl=' . $mig_config['mig_dl'];
            }
            $pageBlock .= '">&raquo;</a>';
        }
		if(!isset($pageBlock)){$pageBlock = '';}
        $pageBlock .= "</small></td>\n   </tr>";
    }
	if(!isset($pageBlock)){$pageBlock = '';}
	
	///fix undefine $imageList :apiruk
	$imageList = (isset($imageList)) ? $imageList : '';
	///fix undefine $imageList :apiruk
	
    $imageList .= $pageBlock;

    $thumbCounter = -1;

    while (list($file,$junk) = each($presorted)) {

        ++$thumbCounter;

        if ($thumbCounter >= $firstThumb && $row <= $maxRows) {

            // Only look at valid image types
            if (getFileType($file)) {

                // If this is a new row, start a new <TR>
                if ($col == 0) {
                    $imageList .= "\n   <tr>";
                }

                $img = buildImageURL($currDir, $file, $description, $short_desc);
                $imageList .= $img;

                // Keep track of what row and column we are on
                if ($col == $maxColumns) {
                    $imageList .= "\n   </tr>";
                    ++$row;
                    $col = 0;
                } else {
                    ++$col;
                }
            }
        }
    }

    closedir($dir);

    $imageList .= $pageBlock;

    // If there aren't any images to work with, just say so.
    if ($imageList == '') {
        $imageList = 'NULL';
    } elseif (!eregi('</tr>$', $imageList)) {
        // Stick a </tr> on the end if it isn't there already and close
        // the table
        $imageList .= "\n  </tr>\n  </tbody></table>";
    } else {
        // Close the table.
        $imageList .= "\n  </tbody></table>";
    }

    return $imageList;

}   // -- End of buildImageList()

?>
<?php

// buildImageURL() - Create HTML link for a particular image.

function buildImageURL ( $currDir, $filename, $description, $short_desc )
{
    global $mig_config;

    $markerLabel = $mig_config['markerlabel'];

    // Collect information about this object.
    $fname  = getFileName($filename);
    $ext    = getFileExtension($filename);
    $type   = getFileType($filename);

    // newCurrDir is currDir without leading "./"
    $newCurrDir = getNewCurrDir($currDir);

    // URL-encode currDir, keeping an old copy too
    $oldCurrDir = $currDir;
    $currDir = migURLencode($currDir);

    // URL-encoded the filename
    $newFname = rawurlencode($fname);

    // Only show a thumbnail if one exists.  Otherwise use a default
    // "generic" thumbnail image.

    if ($type == 'image') {
        if ($mig_config['usethumbsubdir']) {

            $thumbFile = $mig_config['albumdir'] . "/$oldCurrDir/"
                       . $mig_config['thumbsubdir'] . "/$fname.";

            if ($mig_config['thumbext']) {
                $thumbFile .= $mig_config['thumbext'];
            } else {
                $thumbFile .= $ext;
            }

        } else {

            if ($mig_config['markertype'] == 'prefix') {
                $thumbFile  = $mig_config['albumdir']."/$oldCurrDir/"
                            . $mig_config['markerlabel'] . "_$fname.";

                if ($mig_config['thumbext']) {
                    $thumbFile .= $mig_config['thumbext'];
                } else {
                    $thumbFile .= $ext;
                }
            }

            if ($mig_config['markertype'] == 'suffix') {
                $thumbFile  = $mig_config['albumdir']."/$oldCurrDir/$fname"
                            . "_$markerLabel.";

                if ($mig_config['thumbext']) {
                    $thumbFile .= $mig_config['thumbext'];
                } else {
                    $thumbFile .= $ext;
                }
            }
        }
    }

    if (file_exists($thumbFile) && $type == 'image') {
        if ($mig_config['usethumbsubdir']) {
            $thumbImage  = $mig_config['albumurlroot'] . "/$currDir/" 
                         . $mig_config['thumbsubdir'] . "/$fname.";

            if ($mig_config['thumbext']) {
                $thumbImage .= $mig_config['thumbext'];
            } else {
                $thumbImage .= $ext;
            }

        } else {

            if ($mig_config['markertype'] == 'prefix') {
                $thumbImage  = $mig_config['albumurlroot']
                             . "/$currDir/".$mig_config['markerlabel']
                             . "_$fname.";

                if ($mig_config['thumbext']) {
                    $thumbImage .= $mig_config['thumbext'];
                } else {
                    $thumbImage .= $ext;
                }
            }

            if ($mig_config['markertype'] == 'suffix') {
                $thumbImage  = $mig_config['albumurlroot']
                             . "/$currDir/${fname}_$markerLabel.";

                if ($mig_config['thumbext']) {
                    $thumbImage .= $mig_config['thumbext'];
                } else {
                    $thumbImage .= $ext;
                }
            }
        }
        $thumbImage = migURLencode($thumbImage);

    } else {
        $newRoot = ereg_replace('/[^/]+$', '', $mig_config['baseurl']);
        switch ($type) {
            case 'image':
                //$thumbImage = $templateUrl . '/no_thumb.gif';
                $thumbImage = $mig_config['albumurlroot'] . '/' . $currDir . '/' . $filename;
                break;
            case 'audio':
                $thumbImage = $templateUrl . '/music.gif';
                break;
            case 'video':
                $thumbImage = $templateUrl . '/movie.gif';
                break;
        }
        $thumbImage = migURLencode($thumbImage);
    }

    // Get description, if any
    if ($mig_config['commentfileperimage']) {

        list($alt_desc, $x) = getImageDescFromFile($currDir);
	
        // Get a conventional comment if there isn't one here.
        if (! $alt_desc) {

            list($alt_desc, $desc) = getImageDescription("$fname.$ext", $description, $short_desc);
        }
	

    } else {
list($alt_desc, $desc) = getImageDescription("$fname.$ext", $description, $short_desc);
list($alt_desc, $desc) = rvsGetImageDescription($mig_config, $filename, $description, $short_desc);
    }

    // If there's a full description but no alt, use the full as alt.
    if ($desc && ! $alt_desc) {
        $alt_desc = $desc;
    }

    $alt_desc = strip_tags($alt_desc);

    if ($type == 'image') {
        // Figure out the image's size (in bytes and pixels) for display
        $imageFile = $mig_config['albumdir']."/$oldCurrDir/$fname.$ext";

        // Figure out the pixels
        $imageProps = GetImageSize($imageFile);
        $imageWidth = $imageProps[0];
        $imageHeight = $imageProps[1];


        // Figure out the bytes
        $imageFileSize = filesize($imageFile);
        }
    else {
        // get the filesize...
        if ($_SERVER[DOCUMENT_ROOT]) $scriptpath= $_SERVER[DOCUMENT_ROOT];
        else $scriptpath= DOCUMENT_ROOT;

        $imageFileSize=@filesize($scriptpath.$mig_config['albumurlroot'].'/'.$currDir.'/'.$filename);
    }

    if ($imageFileSize > 1048576) {
       $imageFileSize = sprintf('%01.1f', $imageFileSize / 1024 / 1024) . 'MB';
    } elseif ($imageFileSize > 1024) {
        $imageFileSize = sprintf('%01.1f', $imageFileSize / 1024) . 'KB';
    } else {
       $imageFileSize = $imageFileSize . $mig_config['lang']['bytes'];
    }


    // Figure out thumbnail geometry
    $thumbHTML = '';
    if (file_exists($thumbFile) && $type == 'image') {
        $thumbProps = GetImageSize($thumbFile);
        $thumbHTML = $thumbProps[3];
    } else {
		$rvsImage = $mig_config['albumdir'] . '/' . $currDir . '/' . $filename;
		$rvsImageSize = GetImageSize($rvsImage);
		$rvsImageWidth = $rvsImageSize[0];
		$rvsImageHeight = $rvsImageSize[1];
		if($rvsImageWidth > 100){
			$rvsImageWidth = 100 ;
		}
		
		if($rvsImageHeight > 100){
			$rvsImageHeight = 100 ;
		}
		
		$thumbHTML = 'width="' . $rvsImageWidth . '" height="' . $rvsImageHeight . '"' ;		
	}

    // If not an image, just print a URL to the object
    // with a few extra trimmings.
    if ($type != 'image') {

        $url = "\n" . '    <td align="center" class="image" valign="bottom"><a';
        if (! $mig_config['suppressalttags']) {
            $url .= ' title="' . $alt_desc . '"';
        }

        $url .= ' href="' . $mig_config['albumurlroot'] . '/' . $currDir . '/'
              . $fname . '.' . $ext . '">'
              . '<img src="' . $thumbImage . '" /></a>';


        $fileinfotable = array ( 'n' => $filename,
                                     's' => $imageFileSize
                                    // 'i' => $imageWidth.'x'.$imageHeight
                                     );
        // If $fileInfoFormatString is set, show the file info
        if ($mig_config['fileinfoformatstring']) {
            $url .= '<br />';

            $newstr=replaceString($mig_config['fileinfoformatstring'][$type],$fileinfotable);

            if (!$mig_config['nothumbs']) {
                $url .= $newstr;
            }
        }

        $url .= '</td>';

        return $url;

    // It's an image - jump through all the hoops
    } else {

        // beginning of the table cell
        $url = "\n" . '    <td align="center" class="image" valign="bottom"><a';

        if (! $mig_config['suppressalttags']) {
            $url .= ' title="' . $alt_desc . '"';
        }

        $url .= ' href="';

        // set up the image pop-up if appropriate to do so
        if ($mig_config['imagepopup']) {
            $popup_width = $imageWidth + 30;
            $popup_height = $imageHeight + 150;

            // Add max size for popup window
            if ($popup_width > $mig_config['imagepopmaxwidth']) {
                $popup_width = $mig_config['imagepopmaxwidth'];
            }
            if ($popup_height > $mig_config['imagepopmaxheight']) {
                $popup_height = $mig_config['imagepopmaxheight'];
            }
            $url .= '#" onClick="window.open(\'';
        }

        $url .= $mig_config['baseurl'] . '?currDir='
             . $currDir . '&amp;pageType=image&amp;image=' . $newFname
             . '.' . $ext;

        if ($mig_config['startfrom']) {
            $url .= '&amp;startFrom=' . $mig_config['startfrom'];
        }

        if (isset($mig_config['mig_dl'])) {
            $url .= '&amp;mig_dl=' . $mig_config['mig_dl'];
        }

        if ($mig_config['imagepopup']) {
            $url .= "','";

            if ($mig_config['imagepoptype'] == 'reuse') {
                $url .= 'mig_window_11190874';
            } else {
                $url .= 'mig_window_' . time() . '_' . $newFname;
            }

            $url .= "','width=$popup_width,height=$popup_height,"
                  . 'resizable=yes,scrollbars=1';

            // Set up various toolbar options if requested

            if ($mig_config['imagepoplocationbar']) {
                $url .= ',location=1';
            }
            if ($mig_config['imagepoptoolbar']) {
                $url .= ',toolbar=1';
            }
            if ($mig_config['imagepopmenubar']) {
                $url .= ',menubar=1';
            }

            $url .= "');return false;";
        }

        $url .= '">';

        // If $noThumbs is true, just print the image filename rather
        // than the <IMG> tag pointing to a thumbnail.
        if ($mig_config['nothumbs']) {
            $url .= "$newFname.$ext";
        } else {
            $url .= '<img src="' . $thumbImage . '"';
                // Only print the ALT tag if it's wanted.
                if (! $mig_config['suppressalttags']) {
                    $url .= ' alt="' . $alt_desc . '"';
                } else {
                    $url .= ' alt=""';
                }

            //$url .= '  border="0" class="imagethumb" ' . $thumbHTML . ' />';
        }
        
		$url .= ' border="0" class="imagethumb" ' . $thumbHTML . ' />';
			
        $url .= '</a>';     // End the <A> element

        // If $fileInfoFormatString is set, show the image info
        if ($mig_config['fileinfoformatstring']) {
            $url .= '<br />';
           //replace variables of the fileinfoformatstring
            //       %n = Filename
            //       %s = FileSize
            //       %i = ImageSize

            $fileinfotable = array ( 'n' => $fname . '.' . $ext,
                                     's' => $imageFileSize,
                                     'i' => $imageWidth.'x'.$imageHeight);

             $newstr=replaceString($mig_config['fileinfoformatstring'][$type],$fileinfotable);


             if (!$mig_config['nothumbs']) {
                $url .= $newstr;
            }
        }

        // If $showShortOnThumbPage is TRUE, show short comment
        if ($mig_config['showshortonthumbpage']) {
            $url .= '<br />';
           // $url .= $alt_desc;
         $url  .= dbeSubstr($alt_desc,0, $mig_config['maxShortComment'], $mig_config['rvs_language']);

        //   $url  .= getShortDescription($alt_desc, $mig_config['maxShortComment']);
           
        }

        $url .= '</td>';        // Close table cell
        return $url;
    }

}   // -- End of buildImageURL()

?>
<?php

// buildLargeHrefStart() - Builds the text used for template keyword "largeHrefStart".

function buildLargeHrefStart ( $currDir )
{
    global $mig_config;

    $newCurrDir = migURLencode($currDir);

    $retval = '<a href="' . $mig_config['baseurl'] . '?currDir='
            . $newCurrDir . '&amp;pageType=large&amp;image=' . $mig_config['image'];
    if ($mig_config['startfrom']) {
        $retval .= '&amp;startFrom=' . $mig_config['startfrom'];
    }
    if ($mig_config['mig_dl']) {
        $retval .= '&amp;mig_dl=' . $mig_config['mig_dl'];
    }
    $retval .= '">';

    return $retval;

}   // -- End of buildLargeHrefStart()

?>

<?php

// buildLargeLink() - Builds the text used for template keyword "largeLink".

function buildLargeLink( $currDir )
{
    global $mig_config;

    $newCurrDir = migURLencode($currDir);

    $retval = '<a href="' . $mig_config['baseurl'] . '?currDir='
            . $newCurrDir . '&amp;pageType=large&amp;image=' . $mig_config['image'];
    if ($mig_config['startfrom']) {
        $retval .= '&amp;startFrom=' . $mig_config['startfrom'];
    }
    if ($mig_config['mig_dl']) {
        $retval .= '&amp;mig_dl=' . $mig_config['mig_dl'];
    }
    $retval .= '">' . $mig_config['lang']['largelink']
             . '</a>';

    return $retval;

}   // -- End of buildLargeLink()

?>

<?php
// buildNextPrevLinks() - Build links to the "next" and "previous" images.

/**
/* is used by buildNextPrevLinks()
*/
function _greyLink($text)
{
    return '<span class="inactivelink">'.$text.'</span>';
}

function _prevNextLink($text,$currDir,$imgNr)
{
    global $mig_config;

        $link = '<a href="' . $mig_config['baseurl']
               . '?pageType=' . $mig_config['pagetype'] . '&amp;currDir=' . $currDir
               . '&amp;image=' . $imgNr;
        if (isset($mig_config['startfrom'])) {
            $link .= '&amp;startFrom=' . $mig_config['startfrom'];
        }
        if (isset($mig_config['mig_dl'])) {
            $link .= '&amp;mig_dl=' . $mig_config['mig_dl'];
        }
        $link .= '">' .$text. '</a>';

    return $link;
}

// buildNextPrevLinks() - Build links to the "next" and "previous" images.

function buildNextPrevLinks ( $currDir, $presorted )
{
    global $mig_config;

    // newCurrDir is currDir without the leading "./"
    $newCurrDir = getNewCurrDir($currDir);

    if (is_dir($mig_config['albumdir']."/$currDir")) {
        if ($mig_config['pagetype'] == 'large') {
            $dir = opendir($mig_config['albumdir']."/$currDir/".$mig_config['largesubdir']);
        } else {
            $dir = opendir($mig_config['albumdir']."/$currDir");
        }
    } else {
        print "ERROR: no such currDir '$currDir'<br>";
        exit;
    }

    // Gather all files into an array
    $fileList = array ();
    while ($file = readdir($dir)) {

        $markerLabel = $mig_config['markerlabel'];

        // Ignore thumbnails
        if ($mig_config['markertype'] == 'prefix' && ereg("^$markerLabel\_", $file)) {
            continue;
        }

        if ($mig_config['markertype'] == 'suffix' && ereg("_$markerLabel\.[^.]+$", $file)
            && getFileType($file)) {
                continue;
        }

        // Only look at valid image formats
        if (! getFileType($file)) {
            continue;
        }

        // Ignore the hidden images
        if (isset($mig_config['hidden'][$file])) {
            continue;
        }

        // Make sure this is a file, not a directory.
        // and make sure it isn't presorted
        if (is_file($mig_config['albumdir']."/$currDir/$file") && !isset($presorted[$file])) {
            $fileList[$file] = TRUE;
            // Store a date, too, if needed
            if (ereg('bydate.*', $mig_config['sorttype'])) {
                $timestamp = filemtime($mig_config['albumdir']."/$currDir/$file");
                $filedates["$timestamp-$file"] = $file;
            }
        }
    }

    closedir($dir);

    ksort($fileList);       // sort, so we see sorted results
    reset($fileList);       // reset array pointer

    if ($mig_config['sorttype'] == 'bydate-ascend') {
        ksort($filedates);
        reset($filedates);

    } elseif ($mig_config['sorttype'] == 'bydate-descend') {
        krsort($filedates);
        reset($filedates);
    }

    // Generated final sorted list
    if (ereg('bydate.*', $mig_config['sorttype'])) {
        // since $filedates is sorted by date, and date is
        // the key, the key is pointless to put in the list now.
        // so we store the value, not the key, in $presorted
        while (list($junk,$file) = each($filedates)) {
            $presorted[$file] = TRUE;
        }

    } else {
        // however, here we have real data in the key, so we push
        // the key, not the value, into $presorted.
        while (list($file,$junk) = each($fileList)) {
            $presorted[$file] = TRUE;
        }
    }

    reset($presorted);      // reset array pointer

    // Gather all files into an array

    $i = 1;                 // iteration counter, etc

    // Yes, position 0 is garbage.  Makes the math easier later.
    $fList = array ( 'blah' );

    while (list($file, $junk) = each($presorted)) {

        // If "this" is the one we're looking for, mark it as such.
        if ($file == $mig_config['image']) {
            $ThisImagePos = $i;
        }

        $fList[$i] = $file;     // Stash filename in the array
        ++$i;                   // increment the counter, of course.
    }
    reset($fList);

    --$i;                       // Get rid of the last increment...

    // Next is the next with a valid imageFilenameRegexpr behind $ThisImagePos.
    $tempThisImagePos = $ThisImagePos;
    //RVS comment for show all images
    /*while(isset($fList[$tempThisImagePos+1])
            && preg_match($mig_config['imageFilenameRegexpr'], $fList[$tempThisImagePos+1])) {
        ++$tempThisImagePos;
    }*/
    if (isset($fList[$tempThisImagePos+1])) {
        $next = migURLencode($fList[$tempThisImagePos+1]);
    } else {
        $next = 'NA';
    }

    // Previous is the first image with a valid imageFilenameRegexpr
    // before $ThisImagePos

    $tempThisImagePos = $ThisImagePos;
    //RVS comment for show all images
    /*while(isset($fList[$tempThisImagePos-1])
            && preg_match($mig_config['imageFilenameRegexpr'], $fList[$tempThisImagePos-1])) {
        --$tempThisImagePos;
    }*/
    if ($tempThisImagePos == 1) {
        $prev = 'NA';
    } elseif ($fList[$tempThisImagePos-1]) {
        $prev = migURLencode($fList[$tempThisImagePos-1]);
    }

    // URL-encode currDir
    $currDir = migURLencode($currDir);

    // newCurrDir is currDir without the leading "./"
    $newCurrDir = getNewCurrDir($currDir);

    //build the links:

    //first parse the prev/nextFormatStrings...

    $fileinfotable = array ( 'l' => $mig_config['lang']['previmage']
                           );
    $prevtext = replaceString($mig_config['prevformatstring'],$fileinfotable);

    $fileinfotable = array ( 'l' => $mig_config['lang']['nextimage']
                           );
    $nexttext = replaceString($mig_config['nextformatstring'],$fileinfotable);

    // If there is no previous image, show a greyed-out link
    if ($prev == 'NA') $pLink = _greyLink($prevtext);
    // else show a real link
    else $pLink = _prevNextLink($prevtext,$currDir,$prev);


    // If there is no next image, show a greyed-out link
    if ($next == 'NA') $nLink = _greyLink($nexttext);
    // else show a real link
    else $nLink = _prevNextLink($nexttext,$currDir,$next);

    // Current position in the list
    $currPos = '#' . $ThisImagePos . '&nbsp;of&nbsp;' . $i;

    return array( $nLink, $pLink, $currPos );

}   // -- End of buildNextPrevLinks()

?>

<?php

// buildTable() - Frames stuff in HTML table code so it's ready to use as a stand-alone
//                element in a template.

function buildTable ( $input, $tableclass, $tablesummary )
{
    global $mig_config;
    
    $retval = '<table summary="' . $tablesummary
            . '" border="0" cellpadding="0" cellspacing="0"><tbody>'
            . "\n" . ' <tr><td class="' . $tableclass . '" valign="bottom">'
            . $input . "\n" . ' </td></tr>' . "\n" . '</tbody></table>';

    return $retval;

}   // -- End of buildTable()

?>

<?php

// buildYouAreHere() - Build the "You are here" line for the top of each page.

function buildYouAreHere ( $currDir )
{
    global $mig_config;

    // Use $workingCopy so we don't trash value of $currDir
    $workingCopy = $currDir;

    // Loop until we get down to just the "."
    while ($workingCopy != '.') {

        // $label is the "last" thing in the path. Strip up to that
        $label = ereg_replace('^.*/', '', $workingCopy);

        // Render underscores as spaces and turn spaces into &nbsp;
        $label = str_replace('_', '&nbsp;', $label);
        $label = str_replace(' ', '&nbsp;', $label);

        // Get a URL-encoded copy of $workingCopy
        $encodedCopy = migURLencode($workingCopy);

        if ($mig_config['image'] == '' && $workingCopy == $currDir) {
            $url = '&nbsp;&gt;&nbsp;' . $label;
        } else {
            $url = '&nbsp;&gt;&nbsp;<a href="' . $mig_config['baseurl'] . '?currDir='
                 . $encodedCopy;
            if ($mig_config['mig_dl']) {
                $url .= '&amp;mig_dl=' . $mig_config['mig_dl'];
            }
            $url .= '">' . $label . '</a>';
        }

        // Strip the last piece off of $workingCopy to go to next loop
        $workingCopy = ereg_replace('/[^/]+$', '', $workingCopy);

        // Build up the final path over each loop iteration
        $x = $hereString;
        $hereString = $url . $x;
    }

    // If we're down to "." as our currDir then this is "Main"
    if ($currDir == '.') {
        $url = $mig_config['lang']['main'];
		if(!isset($hereString)){$hereString = '';}
        $x = $hereString;
        $hereString = $url . $x;

    // Or if we're not, then Main should be a link instead of just text
    } else {
        $url = '<a href="' . $mig_config['baseurl'] . '?currDir=' . $workingCopy;
        if ($mig_config['mig_dl']) {
            $url .= '&amp;mig_dl=' . $mig_config['mig_dl'];
        }
        $url .= '">' . $mig_config['lang']['main'] . '</a>';
        $x = $hereString;
        $hereString = $url . $x;
    }

    // If there's an image, tack it onto the end of the hereString
    // unless we have $omitImageName set to TRUE
    if ($mig_config['image'] != '' && ! $mig_config['omitimagename']) {
        $hereString .= '&nbsp;&gt;&nbsp;' . $mig_config['image'];
    }

    return $hereString;

}   // -- End of buildYouAreHere()

?>

<?php

// convertIncludePath() - Converts the path used by include() if needed.
//                        (Not normally needed, but some installations demand this).

function convertIncludePath ( $flag, $path='', $regex, $new )
{
    global $mig_config;
    
    if ($flag) {
        $path = ereg_replace($regex, $new, $path);
    }

    return $path;

}   // -- End of convertIncludePath()

?>

<?php

// formatExifData() - Formats EXIF data according to $exifFormatString.

function formatExifData ( $formatString, $exifData )
{
    global $mig_config;
    
    // %a   Aperture
    // %c   Comment
    // %f   Flash used?
    // %i   ISO rating
    // %l   Focal length
    // %m   Camera model
    // %s   Shutter speed

    // %Y   Year
    // %M   Month
    // %D   Day
    // %T   Time

    $table = array ( 'c' => $exifData['comment'],
                     'a' => $exifData['aperture'],
                     'f' => $exifData['flash'],
                     'i' => $exifData['iso'],
                     'l' => $exifData['foclen'],
                     'm' => $exifData['model'],
                     's' => $exifData['shutter'],
                     'Y' => $exifData['year'],
                     'M' => $exifData['month'],
                     'D' => $exifData['day'],
                     'T' => $exifData['time']           );
                     
    // separate elements of format string
    $matches = explode('|', $formatString);
    
    while (list($key,$val) = each($matches)) {
    
        // $changeflag is used to tell us if we should bother
        // printing this block at all.  If none of the format
        // characters in this block can be expanded, we never set
        // $changeflag to TRUE.  If it's not TRUE at the end of this
        // while(), the block is just dumped.
        $changeflag = FALSE;

        // Keep on going until every %X atom has been examined and
        // expanded.

        while (ereg('%([a-zA-Z])', $val, $lettermatch)) {

            // which letter matched?
            $letter = $lettermatch[1];

            // If this can be expanded, do so.  If it can be,
            // set $changeflag to TRUE so we know to include this
            // block instead of dumping it.
            if ($table[$letter]) {
                $newtext = $table[$letter];
                $changeflag = TRUE;
            }

            // Do interpolation
            $val = str_replace("%$letter", $newtext, $val);
        }

        // Only if $changeflag is TRUE do we bother tacking this
        // onto the final product.
        if ($changeflag) {
            $newstr .= $val;
        }
            
    }
    
    return $newstr;

}   // -- End of formatExifData()

?>

<?php

// getExifDescription() - Fetches a comment if available from the Exif comments file (exif.inf)
//                        as well as fetching EXIF data.

function getExifDescription ( $currDir, $formatString )
{
    global $mig_config;
    
    $aperture   = array ();
    $day        = array ();
    $desc       = array ();
    $flash      = array ();
    $foclen     = array ();
    $iso        = array ();
    $model      = array ();
    $month      = array ();
    $shutter    = array ();
    $time       = array ();
    $year       = array ();

    if (file_exists($mig_config['albumdir']."/$currDir/exif.inf")) {

        $file = fopen($mig_config['albumdir']."/$currDir/exif.inf", 'r');
        $line = fgets($file, 4096);     // get first line
        while (!feof($file)) {

            if (ereg('^File name    : ', $line)) {
                $fname = str_replace('File name    : ', '', $line);
                $fname = chop($fname);

            } elseif (ereg('^Comment      : ', $line)) {
                $comment = str_replace('Comment      : ', '', $line);
                $comment = chop($comment);
                $desc[$fname] = $comment;

            } elseif (ereg('^Camera model : ', $line)) {
                $x = str_replace('Camera model : ', '', $line);
                $x = chop($x);
                $model[$fname] = $x;

            // This one apparently sometimes has a space after
            // the colon, sometimes not.  Try to work either way.
            } elseif (ereg('^Exposure time: ?', $line)) {
                $x = ereg_replace('^Exposure time: ?', '', $line);
                if (ereg('\(', $x)) {
                    $x = ereg_replace('^.*\(', '', $x);
                    $x = ereg_replace(').*$', '', $x);
                }
                $x = chop($x);
                $shutter[$fname] = $x;

            } elseif (ereg('^Aperture     : ', $line)) {
                $x = str_replace('Aperture     : ', '', $line);
                // make it fN.N instead of f/N.N
                $x = ereg_replace('/', '', $x);
                $x = chop($x);
                $aperture[$fname] = $x;

            } elseif (ereg('^Focal length : ', $line)) {
                $x = str_replace('Focal length : ', '', $line);
                if (ereg('35mm equiv', $x)) {
                    $x = ereg_replace('^.*alent: ', '', $x);
                    $x = chop($x);
                    $x = ereg_replace(')$', '', $x);
                }
                $foclen[$fname] = $x;

            } elseif (ereg('^ISO equiv.   : ', $line)) {
                $x = str_replace('ISO equiv.   : ', '', $line);
                $x = chop($x);
                $iso[$fname] = $x;

            } elseif (ereg('^Flash used   : Yes', $line)) {
                $flash[$fname] = $mig_config['lang']['flash_used'];

            } elseif (ereg('^Date/Time    : ', $line)) {
                $x = str_replace('Date/Time    : ', '', $line);
                $x = chop($x);

                // Turn into human readable format and record
                list($w,$x,$y,$z) = parseExifDate($x);

                $year[$fname]     = $w;
                $month[$fname]    = $x;
                $day[$fname]      = $y;
                $time[$fname]     = $z;
            }

            $line = fgets($file, 4096);
        }

        fclose($file);
        
        $image = $mig_config['image'];

        $exifData = array ( 'comment'   => $desc[$image],
                            'model'     => $model[$image],
                            'year'      => $year[$image],
                            'month'     => $month[$image],
                            'day'       => $day[$image],
                            'time'      => $time[$image],
                            'iso'       => $iso[$image],
                            'foclen'    => $foclen[$image],
                            'shutter'   => $shutter[$image],
                            'aperture'  => $aperture[$image],
                            'flash'     => $flash[$image]        );

        $retval = formatExifData($formatString, $exifData);

        return $retval;

    } else {
        return '';
    }

}   // -- End of getExifDescription()

?>

<?php

// getFileExtension() - Figure out a file's extension and return it.

function getFileExtension ( $file )
{
    global $mig_config;
    
    // Strip off the extension part of filename
    return ereg_replace('^.*\.', '', $file);

}   // -- End of getFileExtension()

?>

<?php

// getFileName() - Figure out a file's name sans extension.

function getFileName ( $file )
{
    global $mig_config;
    
    // Strip off the non-extension part of filename
    return ereg_replace('\.[^\.]+$', '', $file);

}   // -- End of getFileName()

?>

<?php

// getFileType() - Returns TRUE if filetype is supported by Mig.  More specifically, returns
//                 a string filetype.

function getFileType ( $filename )
{
    global $mig_config;
    
    $ext = getFileExtension($filename);
    $ext = strtolower($ext);

    switch ($ext) {

        case 'jpg':
        case 'gif':
        case 'png':
        case 'jpeg': case 'jpe':// Alternate JPEG

            return 'image';
            break;

        case 'mov':             // Apple Quicktime
        case 'avi':             // AVI-container
        case 'mpg': case 'mpeg':// MPEG video
        case 'wmv':             // Windows Media video
        case 'mp4':             // MPEG-4 video
        case 'swf':             // Shockwave Flash
        case 'flv':             // Flash Video
        case 'rm':              // Realvideo
        case 'divx':            // DivX

            return 'video';
            break;

        case 'mp3':             // MPEG-3 audio
        case 'wav':             // WAV audio
        case 'ra':              // Realaudio
        case 'ram':             // Realaudio
        case 'wma':             // Microsoft Media Audio
        case 'ogg':             // ogg-container (flac, vorbis)
        case 'flac':            // Free Lossless Audio Codec
        case 'aac':             // Advanced Audio Coding
        case 'mpc': case 'mp+': // Musepack

            return 'audio';
            break;

        default:
            return FALSE;       // No valid match - failure.
            break;
    }

}   // -- End of getFileType()

?>

<?php

// getImageDescFromFile() - Fetches an image description from a per-image comment file
//                          (only used if $commentFilePerImage is TRUE).

function getImageDescFromFile ( $currDir )
{
    global $mig_config;

    $imageDesc = '';
    $fname = getFileName($mig_config['image']);
    $fname = rawurldecode($fname);

   $short_flag = $mig_config['commentfileshortcomments'];


    if (file_exists($mig_config['albumdir']."/$currDir/$fname.txt")) {

        $file = fopen($mig_config['albumdir']."/$currDir/$fname.txt", 'r');
        $line = fgets($file, 4096);         // get first line

        // This double-check exists so that files ending without
        // a proper newline character are not truncated.
        // This says "while (not EOF) and ($line is not empty)"...
        while ( $line || ! feof($file)) {
            $line = trim($line);

            // If the "short comments" flag is set, and there is
            // not yet a short description, set one.  This means this
            // must be the first line of the file.
            if ($short_flag && ! $short_desc) {
                $short_desc = $line;
            } else {
                // Otherwise just build on the main description (2nd
                // and further lines, in $firstLine mode, otherwise
                // all lines go here)
                $imageDesc .= "$line ";
            }
            $line = fgets($file, 4096); // get next line
        }

        fclose($file);

        // If there's not a long description, use the short_desc, if we
        // are in "short" mode.
        if ($short_flag && ! $imageDesc) {
            $imageDesc = $short_desc;
        }

        // If we're not in short mode, make sure there's an alt tag
        // of the comment if one exists
        if ($imageDesc && ! $short_desc) {
            $short_desc = $imageDesc;
        }

    } else {
        // File doesn't exist? Okay, return false.
        return FALSE;
    }

    return array ( trim($short_desc), trim($imageDesc) );

}   // -- End of getImageDescFromFile()

?>
<?php

// getImageDescription() - Fetches an image description from the comment file (mig.cf).

function getImageDescription ( $file, $description, $short_desc )
{
    global $mig_config;
    
    $imageDesc = '';

    // "Long" description
    if (isset($description[$file])) {
        $imageDesc = $description[$file];
    }

    // "Short" description
    if (isset($short_desc[$file])) {
        $imageShort = $short_desc[$file];
    }
	else {
		$imageShort = '';
	}

    // Return both - let the calling code decide which to use.
    return array ($imageShort, $imageDesc);

}   // -- End of getImageDescription()


?>

<?php

// getNewCurrDir() - Replaces the silly old $newCurrDir being all over the place.  Especially
//                   in the URI string.

function getNewCurrDir ( $currDir )
{
    global $mig_config;
    
    // This just rips off the leading "./" off currDir if it exists
    $newCurrDir = ereg_replace('^\.\/', '', $currDir);
    $newCurrDir = migURLencode($newCurrDir);

    return $newCurrDir;

}   // -- End of getNewCurrDir()

?>

<?php

// getNumberOfDirs() - Counts subdirectories in a given folder.

function getNumberOfDirs ( $folder, $currDir )
{
    global $mig_config;
    
    if (is_dir($folder)) {
        $dir = opendir($folder);    // Open directory handle
    } else {
        return 0;
    }

    $count = 0;

    while ($file = readdir($dir)) {
        // Get hidden item list from mig.cf
        list($mig_config['hidden'], $x) = parseMigCf($folder);

        // Must be a directory, and can't be . or ..
        if ($file != '.' && $file != '..' && is_dir("$folder/$file"))
        {
            // Ignore thumbnail subdirectories if in use
            if ($mig_config['usethumbsubdir']
                && $file == $mig_config['thumbsubdir'])
                continue;

            // And full-size directories too
            if ($mig_config['uselargeimages']
                && $file == $mig_config['largesubdir'])
                continue;

            // Ignore hidden items
            if ($mig_config['hidden'][$file]) {
                continue;
            }

            // Otherwise count it
            ++$count;
        }
    }
    
    return $count;

}   // -- End of getNumberOfDirs()

?>

<?php

// getNumberOfImages() - Counts images in a given folder.

function getNumberOfImages ( $folder )
{
    global $mig_config;
    
    $markerLabel = $mig_config['markerlabel'];
    
    if (is_dir($folder)) {
        $dir = opendir($folder);    // Open directory handle
    } else {
        return 0;
    }

    $count = 0;

    // Get hidden item list from mig.cf
    list($mig_config['hidden'], $x) = parseMigCf($folder);

    while ($file = readdir($dir)) {

        // Skip over thumbnails
        if (!$mig_config['usethumbsubdir']) {
                                 // unless $useThumbSubdir is set,
                                 // then don't waste time on this check

            if ($mig_config['markertype'] == 'suffix' && ereg("_$markerLabel\.[^.]+$",$file)
                && getFileType($file)) {
                    continue;
            }
            if ($mig_config['markertype'] == 'prefix' && ereg("^$markerLabel\_", $file)) {
                continue;
            }

        }

        // Ignore hidden items
        if ($mig_config['hidden'][$file]) {
            continue;
        }

        // We'll look at this one only if it's a file and it matches our list
        // of approved extensions
        if (is_file("$folder/$file") && getFileType($file)) {
                ++$count;
        }
    }

    return $count;

}   // -- End of getNumberOfImages()

?>

<?php

// getRandomThumb() - Find a random thumbnail to show instead of the folder icon.

function getRandomThumb ( $file, $folder, $currDir )
{
    global $mig_config;
    
    $markerLabel = $mig_config['markerlabel'];

    // SECTION ONE ...
    // If we're using thumbnail subdirectories.

    if ($mig_config['usethumbsubdir']) {
        $myThumbDir = $folder . '/' . $mig_config['thumbsubdir'];

        // Does the thumb subdir exist?  Why would it not?  It would not
        // if we're in a folder that contains only other folders, for
        // example.  Or it might just not exist because no one made thumbs,
        // in which case we can't show any thumbs anyway.
        if (is_dir($myThumbDir)) {
            $readSample = opendir($myThumbDir);
            $randThumbList = array ();          // initialize

            // Read each item in the directory...
            while ($sample = readdir($readSample)) {
                // Ignoring . and ..
                if ($sample != '.' && $sample != '..') {

                    // Ignore hidden items
                    if ($mig_config['hidden'][$sample]) {
                        continue;
                    }

                    // And use the first valid match found
                    if (getFileType($sample)) {
                        $mySample = $mig_config['albumurlroot'] . '/'
                                  . migURLencode($currDir)
                                  . '/' . migURLencode($file)
                                  . '/' .$mig_config['thumbsubdir']
                                  . '/' . $sample;

                        // If "real rand" is in use, add this to the
                        // list.  Otherwise just return what we found.
                        if ($mig_config['userealrandthumbs']) {
                            $randThumbList[] = $mySample;
                        } else {
                            return $mySample;
                        }
                    }
                }
            }
            closedir($readSample);

        } elseif (is_dir($folder)) {

            // No thumb subdir exists, although $useThumbSubdir
            // is set TRUE.  We're either in a folder which has no
            // thumbs generated, or we're in a folder which contains
            // only other folders.  Iterate through items to find
            // a folder and grab an item from THAT folder, if one
            // can be found.
            //
            // This should be able to drill down as far as necessary
            // until a valid thumb is found.

            $dirlist = opendir($folder);
            $subfList = array ();

            while ($item = readdir($dirlist)) {
                if (is_dir("$folder/$item") && $item != '.'
                            && $item != '..')
                {

                    // Ignore hidden items
                    if ($mig_config['hidden'][$item]) {
                        continue;
                    }

                    // Ignore dot directories if appropriate
                    if ($mig_config['ignoredotdirectories'] && ereg('^\.', $item)) {
                        continue;
                    }

                    // If using "real rand" create a list of folders
                    // and pick a random folder, then recurse into it.
                    // Otherwise just use the first folder found,
                    // and recurse into that.
                    if ($mig_config['userealrandthumbs']) {
                        $subfList[] = $item;
                    } else {
                        $mySample = getRandomThumb($file.'/'.$item, $folder.'/'.$item,
                                                   $currDir,
                                                   $mig_config['userealrandthumbs']);

                        if ($mySample) {
                            return $mySample;
                        }
                    }
                }
            }
            closedir($dirlist);

            if ($subfList[0]) {
                srand((double)microtime()*1000000); // get random folder
                $randval = rand(0,(sizeof($subfList)-1));
                $mySample = getRandomThumb($file.'/'.$subfList[$randval],
                                    $folder.'/'.$subfList[$randval], $currDir);

                return $mySample;
            }
        }

    // SECTION TWO...
    // Not using thumbnail subdirectories

    } else {

        if (is_dir($folder)) {
            // Open $folder as a directory handle
            $readSample = opendir($folder);
        } else {
            // If it's not a directory, just bail out now.
            return FALSE;
        }

        // Iterate through all files in this folder...
        while ($sample = readdir($readSample)) {

            unset($mySample);    // Cleanup from last loop iteration

            // Using prefix/suffix and label settings,
            // figure out if this is a thumbnail or not.
            // This is so we skip over regular images.
            if ($mig_config['markertype'] == 'prefix') {
                if (ereg("^$markerLabel\_", $sample)
                    && getFileType($sample))
                {
                    $mySample = $sample;
                }
            } elseif ($mig_config['markertype'] == 'suffix') {
                if (ereg("_$markerLabel\.[^.]+$", $sample)
                    && getFileType($sample))
                {
                    $mySample = $sample;
                }

            } else {
                print 'ERROR: no markerType set in getRandomThumb()';
                exit;
            }

            if ($mySample) {
                $mySample = $mig_config['albumurlroot'] . '/' . $currDir . '/' . $file
                          . '/' . $mySample;

                // If "real rand" is in effect, add to the list for
                // later random selection.  Otherwise just return
                // what we found.
                if ($mig_config['userealrandthumbs']) {
                    $randThumbList[] = $mySample;
                } else {
                    return $mySample;
                }

            } else {
                $dirlist = opendir($folder);
                $subfList = array ();
                while ($item = readdir($dirlist)) {
                    if (is_dir("$folder/$item") && $item != '.'
                               && $item != '..')
                    {

                        // Ignore hidden items
                        if ($mig_config['hidden'][$item]) {
                            continue;
                        }

                        // Ignore dot directories if appropriate
                        if ($mig_config['ignoredotdirectories'] && ereg('^\.', $item)) {
                            continue;
                        }

                        if ($mig_config['userealrandthumbs']) {
                            $subfList[] = $item;
                        } else {
                            $mySample = getRandomThumb($file.'/'.$item, $folder.'/'.$item,
                                            $currDir);

                            if ($mySample) {
                                return $mySample;
                            }
                        }
                    }
                }
                closedir($dirlist);

                if ($subfList[0]) {
                    srand((double)microtime()*1000000);     // get random folder
                    $randval = rand(0,(sizeof($subfList)-1));
                    $mySample = getRandomThumb($file.'/'.$subfList[$randval],
                                        $folder.'/'.$subfList[$randval], $currDir);

                    if ($mySample) {
                        return $mySample;
                    }
                }
            }
        }
        
        closedir($readSample);
    }

    if ($randThumbList) {
        srand((double)microtime()*1000000);   // choose random thumb
        $randval = rand(0,(sizeof($randThumbList)-1));
        return $randThumbList[$randval];
    } else {
        return FALSE;
    }

}   // -- End of getRandomThumb()

?>

<?php

// migURLencode() - Fixes a problem where "/" turns into "%2F" when using rawurlencode().

function migURLencode ( $string )
{
    global $mig_config;
    
    $new = rawurldecode($string);           // decode first
    $new = rawurlencode($new);              // then encode
    $new = str_replace('%2F', '/', $new);       // slash (/)

    return $new;

}   // -- End of migURLencode()

?>

<?php

// parseExifDate() - Parses an EXIF date string and returns it in a more human-readable format.

function parseExifDate ( $stamp )
{
    global $mig_config;

    // Separate into a date and a time
    list($date,$time) = split(' ', $stamp);

    // Parse date
    list($year, $month, $day) = split(':', $date);

    // Turn numeric month into a 3-character month string
    $month = $mig_config['lang']['month'][$month];

    // Parse time
    list($hour, $minute, $second) = split(':', $time);

    // Translate into 12-hour time
    switch ($hour) {
        case '00':
            $time = '12:' . $minute . $mig_config['lang']['am'];
            break;
        case '01':
        case '02':
        case '03':
        case '04':
        case '05':
        case '06':
        case '07':
        case '08':
        case '09':
        case '10':
        case '11':
            $time = $hour . ':' . $minute . $mig_config['lang']['am'];
            break;
        case '12':
            $time = $hour . ':' . $minute . $mig_config['lang']['pm'];
            break;
        case '13':
        case '14':
        case '15':
        case '16':
        case '17':
        case '18':
        case '19':
        case '20':
        case '21':
        case '22':
        case '23':
            $time = ($hour - 12) . ':' . $minute . $mig_config['lang']['pm'];
            break;
    }

    return array ( $year, $month, $day, $time );

}   // -- End of parseExifDate()

?>

<?php
// parseMigCf() - Parse a mig.cf file.

function parseMigCf ( $directory )
{
    global $mig_config;

    // What file to parse
    $cfgfile = 'mig.cf';

    // Prototypes
    $mig_config['hidden'] = array ();
    
    $presort_dir    = array ();
    $presort_img    = array ();
    $short_desc     = array ();
    $desc           = array ();
    $ficons         = array ();
    
    $mig_config['usethumbfile'] = array ();
	if(!isset($bulletin)){$bulletin = '';	}	
	if(!isset($template)){$template = '';	}
	if(!isset($fcols)){$fcols = '';	}
	if(!isset($tcols)){$tcols = '';	}
	if(!isset($trows)){$trows = '';	}	
	if(!isset($maintaddr)){$maintaddr = '';	}	
			
    // Hide thumbnail subdirectory if one is in use.
    if ($mig_config['usethumbsubdir']) {
        $mig_config['hidden'][$mig_config['thumbsubdir']] = TRUE;
    }

    // Hide large subdirectory if one is in use.
    if ($mig_config['uselargeimages']) {
        $mig_config['hidden'][$mig_config['largesubdir']] = TRUE;
    }

    if (file_exists("$directory/$cfgfile")) {
        $file = fopen("$directory/$cfgfile", 'r');
        $line = fgets($file, 4096);         // get first line

        while (! feof($file)) {

            // Parse <hidden> blocks
            if (eregi('^<hidden>', $line)) {
                $line = fgets($file, 4096);
                while (! eregi('^</hidden>', $line)) {
                    $line = trim($line);
                    $mig_config['hidden'][$line] = TRUE;
                    $line = fgets($file, 4096);
                }
            }

            // Parse <sort> structure
            if (eregi('^<sort>', $line)) {
                $line = fgets($file, 4096);
                while (! eregi('^</sort>', $line)) {
                    $line = trim($line);

                    if (is_file("$directory/$line")) {
                        $presort_img[$line] = TRUE;
                    } elseif (is_dir("$directory/$line")) {
                        $presort_dir[$line] = TRUE;
                    }

                    $line = fgets($file, 4096);
                }
            }

            // Parse <bulletin> structure
            if (eregi('^<bulletin>', $line)) {
                $line = fgets($file, 4096);
                while (! eregi('^</bulletin>', $line)) {
                    $bulletin .= $line;
                    $line = fgets($file, 4096);
                }
            }

            // Parse <comment> structure
            if (eregi('^<comment', $line)) {
               $commfilename = trim($line);
                $commfilename = str_replace('">', '', $commfilename);
                $commfilename = eregi_replace('^<comment "','',$commfilename);
                $line = fgets($file, 4096);
                while (! eregi('^</comment', $line)) {
                    $line = trim($line);
                    $mycomment .= "$line ";
                    $line = fgets($file, 4096);
                }
                $desc[$commfilename] = $mycomment;
                $commfilename = '';
                $mycomment = '';
            }

            // Parse <short> structure
            if (eregi('^<short', $line)) {
                $shortfilename = trim($line);
                $shortfilename = str_replace('">', '', $shortfilename);
                $shortfilename = eregi_replace('^<short "','',$shortfilename);
                $line = fgets($file, 4096);
                while (! eregi('^</short', $line)) {
                    $line = trim($line);
                    $myshort .= "$line ";
                    $line = fgets($file, 4096);
                }
                $short_desc[$shortfilename] = $myshort;
                $shortfilename = '';
                $myshort = '';
            }

            // Parse FolderIcon lines
            if (eregi('^foldericon ', $line)) {
                $x = trim($line);
                list($y, $folder, $icon) = explode(' ', $x);
                $ficons[$folder] = $icon;
            }

            // Parse UseThumb lines
            if (eregi('^usethumb ', $line)) {
                $x = trim($line);
                list($y, $folder, $thumbnail) = explode(' ', $x);
                $mig_config['usethumbfile'][$folder] = $thumbnail;
            }

            // Parse FolderTemplate lines
            if (eregi('^foldertemplate ', $line)) {
                $x = trim($line);
                list($y, $template) = explode(' ', $x);
            }

            // Parse PageTitle lines
            if (eregi('^pagetitle ', $line)) {
                $x = trim($line);
                $mig_config['pagetitle'] = eregi_replace('^pagetitle ', '', $x);
            }

            // Parse MaintAddr lines
            if (eregi('^maintaddr ', $line)) {
                $x = trim($line);
                $maintaddr = eregi_replace('^maintaddr ', '', $x);
            }

            // Parse MaxFolderColumns lines
            if (eregi('^maxfoldercolumns ', $line)) {
                $x = trim($line);
                list($y, $fcols) = explode(' ', $x);
            }

            // Parse MaxThumbColumns lines
            if (eregi('^maxthumbcolumns ', $line)) {
                $x = trim($line);
                list($y, $tcols) = explode(' ', $x);
            }

            // Parse MaxThumbRows lines
            if (eregi('^maxthumbrows ', $line)) {
                $x = trim($line);
                list($y, $trows) = explode(' ', $x);
            }

            // Get next line
            $line = fgets($file, 4096);

        } // end of main while() loop

        fclose($file);
    }

    return array ($presort_dir, $presort_img, $desc, $short_desc,
                  $bulletin, $ficons, $template, $fcols,
                  $tcols, $trows, $maintaddr);

}   //  -- End of parseMigCf()

?>

<?php

// printTemplate() - Prints HTML page from a template file.

function printTemplate ( $templateFile, $version, $maintAddr,
                         $folderList, $imageList, $backLink,
                         $currDir, $newCurrDir, $prevLink,
                         $nextLink, $currPos, $description, $youAreHere,
                         $distURL, $pathConvertFlag, $pathConvertRegex,
                         $pathConvertTarget, $largeLink, $largeHrefStart,
                         $largeHrefEnd, $largeLinkBorder ,$showPowered)
{
    global $mig_config;

    global $REQUEST_URI;
    global $HTTP_SERVER_VARS;

    // Get URL for %%newLang%% variable
    if ($_SERVER['REQUEST_URI']) {
        $newLang = $_SERVER['REQUEST_URI'];
    } elseif ($HTTP_SERVER_VARS['REQUEST_URI']) {
        $newLang = $HTTP_SERVER_VARS['REQUEST_URI'];
    } elseif ($REQUEST_URI) {
        $newLang = $REQUEST_URI;
    }
    if (ereg('mig_dl=',$newLang)) {
        $newLang = ereg_replace('[?&]mig_dl=[^?&]*', '', $newLang);
    }
    $newLang .= '&mig_dl';

    // Only prepend a path if one isn't there.  For unix-like systems this
    // checks for a leading slash, for Windows-like system it checks for
    // a leading drive letter or an SMB share.
    if (! eregi('^(/|[a-z]:|\\{2})', $templateFile)) {
        $templateFile = $mig_config['albumdir'] . '/' . $newCurrDir . '/' . $templateFile;
    }

    // Panic if the template file doesn't exist.
    if (! file_exists($templateFile)) {
        print "ERROR: $templateFile does not exist!";
        exit;
    }

    $file = fopen($templateFile,'r');    // Open template file
    $line = fgets($file, 4096);                         // Get first line

    while (! feof($file)) {             // Loop until EOF

        // Look for include directives and process them
        if (ereg('^#include', $line)) {
            $orig_line = $line;
            $line = trim($line);
            $line = str_replace('#include "', '', $line);
            $line = str_replace('";', '', $line);
            if (strstr($line, '/')) {
                $line = '<!-- ERROR: #include directive failed.'
                      . ' Path included a "/" character, indicating'
                      . ' an absolute or relative path.  All included'
                      . ' files must be located in the templates/'
                      . ' subdirectory. Directive was:'
                      . "\n     $orig_line\n-->\n";
                print $line;
            } else {
                $incl_file = $line;
                if (file_exists($mig_config['templatedir'] ."/$incl_file")) {

                    if (function_exists('virtual')) {
                        // virtual() doesn't like absolute paths,
                        // apparently, so just pass it a relative one.
                        $tmplDir = ereg_replace('^.*/', '', $mig_config['templatedir']);
                        virtual("$tmplDir/$incl_file");
                    } else {
                        include( convertIncludePath($pathConvertFlag,
                                            $mig_config['templatedir']."/$incl_file",
                                            $pathConvertRegex, $pathConvertTarget));
                    }

                } else {
                    // If the file doesn't exist, complain.
                    $line = '<!-- ERROR: #include directive failed.'
                          . ' Named file ' . $incl_file
                          . ' does not exist.  Directive was:'
                          . "\n    $orig_line\n-->\n";
                    print $line;
                }
            }

        } else {

            $albumURLroot		= $mig_config['albumurlroot'];
            $baseURL			= $mig_config['baseurl'];
            $image			= $mig_config['image'];
            $largeSubdir		= $mig_config['largesubdir'];
            $pageTitle			= $mig_config['pagetitle'];

            // Make sure this is URL encoded
            $encodedImageURL = migURLencode($mig_config['image']);

            $filetype=getFileType($mig_config['image']);
            // If pagetype is large, add largeSubdir to path.
            if ($filetype=='image' && $mig_config['image']) {
                // Get image pixel size for <IMG> element
				if(!is_file($mig_config['albumdir']."/$currDir/".$mig_config['image'])) {
					die("ERROR: Image file does not exist!");
				}
                if ($mig_config['pagetype'] == 'image') {
                    $imageProps = GetImageSize($mig_config['albumdir']."/$currDir/"
                                               .$mig_config['image']);
                } elseif ($mig_config['pagetype'] == 'large') {
                    $imageProps =
                      GetImageSize($mig_config['albumdir']."/$currDir/"
                                 . $mig_config['largesubdir']
                                 . '/'.$mig_config['image']);
                }
                $imageSize = $imageProps[3];
            } elseif ($filetype) { // known and !image -> display icon with link
                $largeHrefStart =
                       "<a href=\"$albumURLroot/$newCurrDir/$encodedImageURL\">";
                $largeHrefEnd = "</a><br />$encodedImageURL";
                $albumURLroot='.';
                $newCurrDir='images';
                switch ($filetype) {
                    case 'video': $encodedImageURL='movie.gif'; break;
                    case 'audio': $encodedImageURL='audio.gif'; break;
                    default: $encodedImageURL='no_thumb.gif'; break;
                }
            }

            // List of valid tags
            $replacement_list = array (
                'baseURL', 'maintAddr', 'version', 'folderList',
                'imageList', 'backLink', 'currDir', 'newCurrDir',
                'image', 'albumURLroot', 'pageTitle', 'nextLink',
                'prevLink', 'currPos', 'description', 'youAreHere',
                'distURL', 'encodedImageURL', 'newLang',
                'largeSubdir', 'largeLink', 'largeHrefStart',
                'largeHrefEnd', 'largeLinkBorder'//, 'imageSize'
            );

            // Do substitution for various variables            
            while (list($key,$val) = each($replacement_list)) {
				
                $line = str_replace("%%$val%%", $$val, $line);
            }

            print $line;                // Print resulting line
        }
        $line = fgets($file, 4096);     // Grab another line
    }
    
    if ($showPowered == TRUE) {
		echo '<center><a href="http://mig.sf.net/" target="_blank">'. $mig_config['lang']['this page was generated'] . '</a></center>';
    }

    fclose($file);
    return TRUE;

}    // -- End of printTemplate()

?>

<?php
function replaceString($val, $formattable){

        // $changeflag is used to tell us if we should bother
        // printing this block at all.  If none of the format
        // characters in this block can be expanded, we never set
        // $changeflag to TRUE.  If it's not TRUE at the end of this
        // while(), the block is just dumped.
        $changeflag = FALSE;

     
        // Keep on going until every %X atom has been examined and
        // expanded.
     
        while (ereg('%([a-zA-Z])', $val , $lettermatch)) {
  
            // which letter matched?
            $letter = $lettermatch[1];

            // If this can be expanded, do so.  If it can be,
            // set $changeflag to TRUE so we know to include this
            // block instead of dumping it.
            if ($formattable[$letter]) {
                $newtext = $formattable[$letter];
                $changeflag = TRUE;
            }

            // Do interpolation
            $val = str_replace("%$letter", $newtext, $val);
            $newtext = "";
         }
         
        // Only if $changeflag is TRUE do we bother tacking this
        // onto the final product.
        if ($changeflag) $newstr = $val;
        
        return $newstr;
 }           
?>

<?php

// Portugese - courtesy of Fadel <fadel@fee.unicamp.br>
$mig_config['lang_lib']['br'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'voltar&nbsp;para',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'flash&nbsp;usado',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Principal',
    'must_auth'     => 'Voc&ecirc;&nbsp;deve&nbsp;entrar&nbsp;com&nbsp;um'
                     . '&nbsp;login&nbsp;e&nbsp;senha&nbsp;v&aacute;lido'
                     . '&nbsp;para&nbsp;acessar&nbsp;este&nbsp;'
                     . 'conte&uacute;do',
    'nextimage'     => 'pr&oacute;xima&nbsp;imagem',
    'no_contents'   => 'Sem&nbsp;conte&uacute;do.',
    'previmage'     => 'imagem&nbsp;anterior',
    'thumbview'     => 'Voltar&nbsp;para&nbsp;os&nbsp;thumbnails',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'subir&nbsp;um&nbsp;n&iacute;vel',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Czech - encoding iso8859-2
// courtesy of Pavel XPJ Jisl <pavel@cetoraz.info>

$mig_config['lang_lib']['cz'] = array (
       'am'            => 'AM',
       'pm'            => 'PM',
       'backhome'      => 'zpt&nbsp;dom',
       'bytes'         => '&nbsp;byt',
       'flash_used'    => 'flash&nbsp;pouit',
       'largelink'     => 'zobrazit&nbsp;velk?&nbsp;obrzek',
       'largeview'     => 'zpt&nbsp;na&nbsp;zobrazen&nbsp;mal?ch&nbs;obrzk',
       'main'          => 'Hlavn',
       'must_auth'     => 'Muste&nbsp;vloit&nbsp;sprvn&nbsp;jmno&nbsp;a'
                        . '&nbsp;heslo&nbsp;pro&nbsp;vstup',
       'nextimage'     => 'nsledujc&nbsp;obrzek',
       'no_contents'   => 'dn&nbsp;obrzky.',
       'previmage'     => 'pedchoz&nbsp;obrzek',
       'thumbview'     => 'zpt&nbsp;na&nbsp;zobrazen&nbsp;nhled',
       // total_images is special.  It has three elements you can use:
       //     %t :    Total images in folder
       //     %s :    First image shown this page
       //     %e :    Last image shown this page
       'total_images'  => 'Zobrazuji&nbsp;obrzky&nbsp;%s-%e&nbsp;z&nbsp;%t'
                        . '&nbsp;celkem<br />',
       'up_one'        => 'o&nbsp;rove&nbsp;v?e',
       'month'         => array ( '01' => 'Led', '02' => 'no', '03' => 'Be',
                                  '04' => 'Dub', '05' => 'Kv', '06' => 'en',
                                  '07' => 'ec', '08' => 'Srp', '09' => 'Z',
                                  '10' => 'j', '11' => 'Lis', '12' => 'Pro' )
);

?>

<?php

// German - courtesy of "Burckhard Loeh" <lb@loeh.cx>
// Updated by Ekkehard Drre <ekke@doerre.net>
// Updated by Werner M. Krau <werner.krauss@hallstatt.net>
$mig_config['lang_lib']['de'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'zur&uuml;ck&nbsp;zu',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'Blitz&nbsp;benutzt',
    'largelink'     => 'Bild&nbsp;in&nbsp;voller&nbsp;Gr&ouml;&szlig;e&nbsp;betrachten',
    'largeview'     => 'zur&uuml;ck&nbps;zur&nbps;Webseitendarstellung',
    'main'          => 'Hauptverzeichnis',
    'must_auth'     => 'F&uuml;r&nbsp;den&nbsp;Zugang&nbsp;m&uuml;ssen&nbsp;'
                     . 'Sie&nbsp;eine&nbsp;g&uuml;ltige&nbsp;Benutzerkennung'
                     . '&nbsp;und&nbsp;Passwort&nbsp;eingeben',
    'nextimage'     => 'n&auml;chstes&nbsp;Bild',
    'no_contents'   => 'Kein&nbsp;Inhalt.',
    'previmage'     => 'vorheriges&nbsp;Bild',
    'thumbview'     => 'zur&uuml;ck&nbsp;zur&nbsp;Kleinbild&uuml;bersicht',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Es&nbsp;werden&nbsp;die&nbsp;Bilder&nbsp;%s-'
                     . '%e&nbsp;von&nbsp;%t&nbsp;angezeigt.<br />',
    'up_one'        => 'Eine&nbsp;Ebene&nbsp;h&ouml;her',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb',
                               '03' => 'M&auml;rz',
                               '04' => 'Apr', '05' => 'Mai', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Okt', '11' => 'Nov', '12' => 'Dez')
);

?>

<?php

// Danish - courtesy of Mikkel Mondrup Kristensen <mikkel@tdx.dk>
$mig_config['lang_lib']['dk'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'Tilbage&nbsp;til',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'Flash&nbsp;brugt',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Hovedside',
    'must_auth'     => 'Du&nbsp;skal&nbsp;skrive&nbsp;et&nbsp;gyldigt'
                     . '&nbsp;brugernavn&nbsp;og&nbsp;password'
                     . '&nbsp;for&nbsp;at&nbsp;komme&nbsp;ind',
    'nextimage'     => 'N&aelig;ste&nbsp;billede',
    'no_contents'   => 'Intet&nbsp;indhold.',
    'previmage'     => 'Forrige&nbsp;billede',
    'thumbview'     => 'Tilbage&nbsp;til&nbsp;oversigten',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Viser&nbsp;%s-%e&nbsp;af&nbsp;%t'
                     . '&nbsp;billeder<br />',
    'up_one'        => 'Tilbage',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'Maj', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Okt', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Estonian - courtesy of Jan Jasinski <jan@sps.ee>
$mig_config['lang_lib']['ee'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'tagasi',
    'bytes'         => '&nbsp;baiti',
    'flash_used'    => 'kasutatud&nbsp;v&auml;lku',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Avaleht',
    'must_auth'     => 'Vaatamiseks&nbsp;tuleb&nbsp;sisestada&nbsp;'
                     . 'kasutajatunnus&nbsp;ja&nbsp;arool',
    'nextimage'     => 'j&auml;rgmine&nbsp;pilt',
    'no_contents'   => 'Kataloog&nbsp;on&nbsp;t&uuml;hi',
    'previmage'     => 'eelmine&nbsp;pilt',
    'thumbview'     => 'tagasi&nbsp;ikoonide&nbsp;juurde',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'N&auml;itan&nbsp;pilte&nbsp;%s-%e&nbsp;(%t)'
                     . '&nbsp;<br />',
    'up_one'        => 'tase&nbsp;k&otilde;rgemale',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// English (default)
$mig_config['lang_lib']['en'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'back&nbsp;to',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Main',
    'must_auth'     => 'You&nbsp;must&nbsp;enter&nbsp;a&nbsp;valid'
                     . '&nbsp;username&nbsp;and&nbsp;password&nbsp;to'
                     . '&nbsp;enter',
    'nextimage'     => 'next&nbsp;image',
    'no_contents'   => 'No&nbsp;contents.',
    'previmage'     => 'previous&nbsp;image',
    'thumbview'     => 'back&nbsp;to&nbsp;thumbnail&nbsp;view',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'up&nbsp;one&nbsp;level',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Spanish - courtesy of Alex Dantart <alex@pixar.es>
// with some adjustments from JMN <umjumasa@terra.es>
$mig_config['lang_lib']['es'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'regresar&nbsp;inicio',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'flash&nbsp;usado',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Principal',
    'must_auth'     => 'Debes&nbsp;introducir&nbsp;un&nbsp;usuario&nbsp;y'
                     . '&nbsp;clave&nbsp;v&aacute;lidas&nbsp;para'
                     . '&nbsp;acceder',
    'nextimage'     => 'siguiente&nbsp;im&aacute;gen',
    'no_contents'   => 'Sin&nbsp;contenidos.',
    'previmage'     => 'anterior&nbsp;im&aacute;gen',
    'thumbview'     => 'volver&nbsp;a&nbsp;vista&nbsp;por&nbsp;iconos',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'subir&nbsp;un&nbsp;nivel',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Finnish - courtesy of Jani Mikkonen <jani@mikkonen.org>
$mig_config['lang_lib']['fi'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'takaisin',
    'bytes'         => '&nbsp;byte&auml;',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Etusivu',
    'must_auth'     => 'Sinun&nbsp;pit&auml;&auml;&nbsp;antaa&nbsp;oikea'
                     . '&nbsp;tunnus&nbsp;ja&nbsp;salasana'
                     . '&nbsp;jatkaasesi&nbsp;eteenp&nbsp;&auml;in',
    'nextimage'     => 'seuraava&nbsp;kuva',
    'no_contents'   => 'Albumi&nbsp;on&nbsp;tyhj&auml;',
    'previmage'     => 'edellinen&nbsp;kuva',
    'thumbview'     => 'takaisin&nbsp;kuva&nbsp;valikkoon',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'paluu&nbsp;edelliselle&nbsp;sivulle',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// French - courtesy of jrme ROUER <CCFRANCE.bibli@bigpond.com.kh>
//          Updated July 2002 by Yannick Mass <ymasse@henna-tatoo.net>
$mig_config['lang_lib']['fr'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'Retourner&nbsp;sur',
    'bytes'         => '&nbsp;octets',
    'flash_used'    => 'flash&nbsp;utilis&eacute;',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Liste&nbsp;des&nbsp;albums',
    'must_auth'     => 'Vous&nbsp;devez&nbsp;entrer&nbsp;un&nbsp;nom&nbsp;'
                     . 'login&nbsp;et&nbsp;un&nbsp;mot&nbsp;de&nbsp;passe'
                     . '&nbsp;valides&nbsp;pour&nbsp;entrer',
    'nextimage'     => 'Image&nbsp;suivante',
    'no_contents'   => 'VIDE',
    'previmage'     => 'Image&nbsp;pr&eacute;c&eacute;dente',
    'thumbview'     => 'Retour&nbsp;vue&nbsp;par&nbsp;vignettes',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Images&nbsp;%s&nbsp;&agrave;&nbsp;%e&nbsp;sur&nbsp;'
                     . '%t<br />',
    'up_one'        => 'Remonter&nbsp;niveau&nbsp;sup&eacute;rieur',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);

?>

<?php

// Courtesy of Tamas Buti <buty@axelero.hu>
$mig_config['lang_lib']['hu'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'Vissza:',
    'bytes'         => '&nbsp;byte',
    'flash_used'    => 'Vaku&nbsp;bekapcsolva',
    'largelink'     => 'Teljes&nbsp;m&eacute;ret&ucirc;&nbsp;k&eacute;p',
    'largeview'     => 'Vissza&nbsp;a&nbsp;norm&aacute;l&nbsp;m'
                     . '&eacute;rethez',
    'main'          => 'F&otilde;mappa',
    'must_auth'     => '&Eacute;rv&eacute;nyes&nbsp;jelsz&oacute;t&nbsp;'
                     . '&eacute;s&nbsp;felhaszn&aacute;l&oacute;nevet&nbsp;'
                     . 'kell&nbsp;megadni&nbsp;a&nbsp;bel&eacute;p&eacute;'
                     . 'shez',
    'nextimage'     => 'K&ouml;vetkez&otilde;',
    'no_contents'   => 'Nincs&nbsp;k&eacute;p.',
    'previmage'     => 'El&otilde;z&otilde;',
    'thumbview'     => 'Thumbnail&nbsp;k&eacute;pek',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => '%s-%e&nbsp;k&eacute;pek&nbsp;%t'
                     . '&nbsp;az&nbsp;&ouml;sszesb&otilde;l<br />',
    'up_one'        => 'Egy&nbsp;mapp&aacute;t&nbsp;fel',
    'month'         => array ( '01' => 'Jan',
                               '02' => 'Feb',
                               '03' => 'M&aacute;rc',
                               '04' => '&Aacute;pr',
                               '05' => 'M&aacute;j',
                               '06' => 'J&uacute;n',
                               '07' => 'J&uacute;l',
                               '08' => 'Aug',
                               '09' => 'Szept',
                               '10' => 'Okt',
                               '11' => 'Nov',
                               '12' => 'Dec'
                             )
);

?>

<?php

// Italian - courtesy of Marco Ermini <markoer@firenze.linux.it>
// Updated by Fabio Fioravanti <fioravanti@iasi.rm.cnr.it>
$mig_config['lang_lib']['it'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'torna&nbsp;a',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'usato&nbsp;flash',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Principale',
    'must_auth'     => 'Devi&nbsp;inserire&nbsp;un&nbsp;nome&nbsp;utente'
                     . '&nbsp;ed&nbsp;una&nbsp;password&nbsp;validi'
                     . '&nbsp;per&nbsp;accedere',
    'nextimage'     => 'prossima&nbsp;immagine',
    'no_contents'   => 'Vuoto.',
    'previmage'     => 'immagine&nbsp;precedente',
    'thumbview'     => 'torna&nbsp;alla&nbsp;vista&nbsp;per&nbsp;icone',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Immagini&nbsp;%s-%e&nbsp;di&nbsp;%t'
                     . '&nbsp;totali<br />',
    'up_one'        => 'torna&nbsp;al&nbsp;livello&nbsp;superiore',
    'month'         => array ( '01' => 'Gen', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'Mag', '06' => 'Giu',
                               '07' => 'Lug', '08' => 'Ago', '09' => 'Set',
                               '10' => 'Ott', '11' => 'Nov', '12' => 'Dic')
);

?>

<?php

// Japanese (UTF-8) - courtesy of Masaru Onozawa <masy@webmasters.gr.jp>
$mig_config['lang_lib']['jp'] = array (
    'am'            => '????',
    'pm'            => '???',
    'backhome'      => '????????&nbsp;-&nbsp;',
    'bytes'         => '&nbsp;?????',
    'flash_used'    => '???????使?',
    'largelink'     => '??大????????????',
    'largeview'     => '大????????????????',
    'main'          => '???????',
    'must_auth'     => '????????????????? ID ?????????????????????',
    'nextimage'     => '次????',
    'no_contents'   => '??????????????',
    'previmage'     => '??????',
    'thumbview'     => '?覧????',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => '表示中&nbsp;%s&nbsp;???&nbsp;'
                     . '-&nbsp;%e&nbsp;???&nbsp;/&nbsp;'
                     . '?????&nbsp;%t&nbsp;??<br />',
    'up_one'        => '???????',
    'month'         => array ( '01' => '1&nbsp;??',
                               '02' => '2&nbsp;??',
                               '03' => '3&nbsp;??',
                               '04' => '4&nbsp;??',
                               '05' => '5&nbsp;??',
                               '06' => '6&nbsp;??',
                               '07' => '7&nbsp;??',
                               '08' => '8&nbsp;??',
                               '09' => '9&nbsp;??',
                               '10' => '10&nbsp;??',
                               '11' => '11&nbsp;??',
                               '12' => '12&nbsp;??' )
);

?>

<?php

// Russian KOI8-R - courtesy of Anatoly Ropotov <lynx@rulez.lv>
$mig_config['lang_lib']['koi8r'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => '&times;&Aring;&Ograve;&Icirc;&Otilde;&Ocirc;&Oslash;'
                     . '&Oacute;&Ntilde;&nbsp;&Euml;',
    'bytes'         => '&nbsp;&Acirc;&Aacute;&Ecirc;&Ocirc;',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => '&igrave;&Eacute;&Atilde;&Aring;&times;&Aacute;'
                     . '&Ntilde;',
    'must_auth'     => '&divide;&Ugrave; &Auml;&Iuml;&Igrave;&Ouml;&Icirc;'
                     . '&Ugrave; &times;&times;&Aring;&Oacute;&Ocirc;&Eacute;'
                     . ' &Euml;&Iuml;&Ograve;&Ograve;&Aring;&Euml;&Ocirc;'
                     . '&Icirc;&Iuml;&Aring; &Eacute;&Iacute;&Ntilde; &ETH;'
                     . '&Iuml;&Igrave;&Oslash;&Uacute;&Iuml;&times;&Aacute;'
                     . '&Ocirc;&Aring;&Igrave;&Ntilde; &Eacute; &ETH;&Aacute;'
                     . '&Ograve;&Iuml;&Igrave;&Oslash;',
    'nextimage'     => '&Oacute;&Igrave;&Aring;&Auml;&Otilde;&Aacute;&Yacute;'
                     . '&Aacute;&Ntilde;&nbsp;&Euml;&Aacute;&Ograve;&Ocirc;'
                     . '&Eacute;&Icirc;&Euml;&Aacute;',
    'no_contents'   => '&eth;&Otilde;&Oacute;&Ocirc;&Iuml;.',
    'previmage'     => '&ETH;&Ograve;&Aring;&Auml;&Ugrave;&Auml;&Otilde;'
                     . '&Yacute;&Aacute;&Ntilde;&nbsp;&Euml;&Aacute;&Ograve;'
                     . '&Ocirc;&Eacute;&Icirc;&Euml;&Aacute;',
    'thumbview'     => '&times;&Aring;&Ograve;&Icirc;&Otilde;&Ocirc;&Oslash;'
                     . '&Oacute;&Ntilde;&nbsp;&Euml;&nbsp;&Otilde;&Iacute;'
                     . '&Aring;&Icirc;&Oslash;&Ucirc;&Aring;&Icirc;&Icirc;'
                     . '&Iuml;&Iacute;&Otilde;&nbsp;&times;&Eacute;&Auml;'
                     . '&Otilde;',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => '&ETH;&Ograve;&Aring;&Auml;&Ugrave;&Auml;&Otilde;'
                     . '&Yacute;&Aacute;&Ntilde;&nbsp;&ETH;&Aacute;&ETH;'
                     . '&Euml;&Aacute;',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Dutch - courtesy of Erik@Braindisorder.org
$mig_config['lang_lib']['nl'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'Terug&nbsp;naar',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Hoofdmenu',
    'must_auth'     => 'Je&nbsp;moet&nbsp;een&nbsp;geldige&nbsp;naam&nbsp;en'
                     . '&nbsp;wachtwoord&nbsp;invoeren&nbsp;om&nbsp;hier'
                     . '&nbsp;naar&nbsp;binnen&nbsp;te&nbsp;gaan',
    'nextimage'     => 'volgende&nbsp;foto',
    'no_contents'   => 'Geen&nbsp;commentaar.',
    'previmage'     => 'vorige&nbsp;foto',
    'thumbview'     => 'terug&nbsp;naar&nbsp;overzicht',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'een&nbsp;niveau&nbsp;omhoog',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);

?>

<?php

// Norwegian
// Translated by Joffer aka Christopher Thorjussen - January 8th, 2000
// http://www.irc-arendal.net
$mig_config['lang_lib']['no'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'tilbake',
    'bytes'         => '&nbsp;bytes',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Galleriet',
    'must_auth'     => 'Du&nbsp;m&aring;&nbsp;oppgi&nbsp;gyldig'
                     . '&nbsp;brukernavn&nbsp;og&nbsp;passord',
    'nextimage'     => 'neste&nbsp;bilde',
    'no_contents'   => 'Tom&nbsp;katalog',
    'previmage'     => 'forrige&nbsp;bilde',
    'thumbview'     => 'tilbake&nbsp;til&nbsp;oversikt',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'opp&nbsp;et&nbsp;niv&aring;',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Polish - courtesy of martvin@box43.pl
$mig_config['lang_lib']['pl'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'powr&oacute;t&nbsp;do',
    'bytes'         => '&nbsp;bajt&oacute;w',
    'flash_used'    => 'u&iquest;yto&nbsp;Flash',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'main'          => 'G&sup3;&oacute;wna',
    'must_auth'     => 'Musisz&nbsp;wpisa&aelig;&nbsp;prawid&sup3;ow&sup1;'
                     . '&nbsp;nazw&ecirc;&nbsp;u&iquest;ytkownika&nbsp;i'
                     . '&nbsp;has&sup3;o&nbsp;by&nbsp;wej?&aelig;',
    'nextimage'     => 'nast&ecirc;pny&nbsp;obrazek',
    'no_contents'   => 'nie&nbsp;ma&nbsp;zawarto?ci.',
    'previmage'     => 'poprzedni&nbsp;obrazek',
    'thumbview'     => 'powr&oacute;t&nbsp;do&nbsp;widoku&nbsp;miniatur',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'powr&oacute;t&nbsp;&nbsp;',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Polish ISO-8859-2
// courtesy of Krzysztof Wojtas <krzysin@cyklon.chemia.pk.edu.pl>
$mig_config['lang_lib']['pliso'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'powr&oacute;t&nbsp;do',
    'bytes'         => '&nbsp;bajt&oacute;w',
    'flash_used'    => 'u&iquest;yto&nbsp;Flash',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'G?&oacute;wna',
    'must_auth'     => 'Musisz&nbsp;wpisa&aelig;&nbsp;prawid?ow&plusmn;'
                     . '&nbsp;nazw&ecirc;&nbsp;u&iquest;ytkownika&nbsp;i'
                     . '&nbsp;has?o&nbsp;by&nbsp;wej&para;&aelig;;',
    'nextimage'     => 'nast&ecirc;pny&nbsp;obrazek',
    'no_contents'   => 'nie&nbsp;ma&nbsp;zawarto&para;ci.',
    'previmage'     => 'poprzedni&nbsp;obrazek',
    'thumbview'     => 'powr&oacute;t&nbsp;do&nbsp;widoku&nbsp;miniatur',
    // total_images is special.  It has three elements you can use:
    //      %t :    Total images in folder
    //      %s :    First image shown this page
    //      %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'powr&oacute;t&nbsp;&nbsp;',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Romanian - courtesy of Eugen Dedu <dedu@ese-metz.fr>
$mig_config['lang_lib']['ro'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => '&icirc;napoi&nbsp;la',
    'bytes'         => '&nbsp;octeti',
    'flash_used'    => 'utilizat&nbsp;flash',
    'largelink'     => 'vedere&nbsp;marita',
    'largeview'     => '&icirc;napoi&nbsp;la&nbsp;vederea&nbsp;normala',
    'main'          => 'Principal',
    'must_auth'     => 'Pentru&nbsp;a&nbsp;intra,&nbsp;trebuie&nbsp;sa'
                     . '&nbsp;introduceti&nbsp;un&nbsp;nume&nbsp;de'
                     . '&nbsp;utilizator&nbsp;si&nbsp;o&nbsp;parola'
                     . '&nbsp;valide',
    'nextimage'     => 'imaginea&nbsp;urmatoare',
    'no_contents'   => 'Repertoriu&nbsp;GOL',
    'previmage'     => 'imaginea&nbsp;precedenta',
    'thumbview'     => '&icirc;napoi&nbsp;la&nbsp;repertoriu',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Vedere&nbsp;imaginile&nbsp;%s-%e&nbsp;din&nbsp;%t'
                     . '&nbsp;&icirc;n&nbsp;total<br />',
    'up_one'        => 'nivelul&nbsp;precedent',
    'month'         => array ( '01' => 'ian', '02' => 'feb', '03' => 'mar',
                               '04' => 'apr', '05' => 'mai', '06' => 'iun',
                               '07' => 'iul', '08' => 'aug', '09' => 'sep',
                               '10' => 'oct', '11' => 'noi', '12' => 'dec')
);


?>

<?php

// Russian Windows-1251 - courtesy of Anatoly Ropotov <lynx@rulez.lv>
$mig_config['lang_lib']['ru'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => '&acirc;&aring;&eth;&iacute;&oacute;&ograve;&uuml;'
                     . '&ntilde;&yuml;&nbsp;&ecirc;',
    'bytes'         => '&nbsp;&aacute;&agrave;&eacute;&ograve;',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => '&Euml;&egrave;&ouml;&aring;&acirc;&agrave;&yuml;',
    'must_auth'     => '&Acirc;&ucirc; &auml;&icirc;&euml;&aelig;&iacute;'
                     . '&ucirc; &acirc;&acirc;&aring;&ntilde;&ograve;&egrave;'
                     . ' &ecirc;&icirc;&eth;&eth;&aring;&ecirc;&ograve;'
                     . '&iacute;&icirc;&aring; &egrave;&igrave;&yuml; &iuml;'
                     . '&icirc;&euml;&uuml;&ccedil;&icirc;&acirc;&agrave;'
                     . '&ograve;&aring;&euml;&yuml; &egrave; &iuml;&agrave;'
                     . '&eth;&icirc;&euml;&uuml;',
    'nextimage'     => '&ntilde;&euml;&aring;&auml;&oacute;&thorn;&ugrave;'
                     . '&agrave;&yuml;&nbsp;&ecirc;&agrave;&eth;&ograve;'
                     . '&egrave;&iacute;&ecirc;&agrave;',
    'no_contents'   => '&Iuml;&oacute;&ntilde;&ograve;&icirc;.',
    'previmage'     => '&iuml;&eth;&aring;&auml;&ucirc;&auml;&oacute;&ugrave;'
                     . '&agrave;&yuml;&nbsp;&ecirc;&agrave;&eth;&ograve;'
                     . '&egrave;&iacute;&icirc;&agrave;',
    'thumbview'     => '&acirc;&aring;&eth;&iacute;&oacute;&ograve;&uuml;'
                     . '&ntilde;&yuml;&nbsp;&ecirc;&nbsp;&oacute;&igrave;'
                     . '&aring;&iacute;&uuml;&oslash;&aring;&iacute;&iacute;'
                     . '&icirc;&igrave;&oacute;&nbsp;&acirc;&egrave;&auml;'
                     . '&oacute;',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => '&iuml;&eth;&aring;&auml;&ucirc;&auml;&oacute;&ugrave;'
                     . '&agrave;&yuml;&nbsp;&iuml;&agrave;&iuml;&ecirc;'
                     . '&agrave;',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Swedish - courtesy of Sebastian Djupsjbacka <basse@iki.fi>
$mig_config['lang_lib']['se'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'tillbaka',
    'bytes'         => '&nbsp;byte',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'F&ouml;rsta&nbsp;sidan',
    'must_auth'     => 'Du&nbsp;m&aring;ste&nbsp;ange&nbsp;korrekt'
                     . '&nbsp;anv&auml;ndarnamn&nbsp;och&nbsp;l&ouml;senord'
                     . '&nbsp;f&ouml;r&nbsp;att&nbsp;komma&nbsp;vidare',
    'nextimage'     => 'n&auml;sta&nbsp;bild',
    'no_contents'   => 'Det&nbsp;h&auml;r&nbsp;albumet&nbsp;&auml;r'
                     . '&nbsp;tomt',
    'previmage'     => 'f&ouml;reg&aring;ende&nbsp;bild',
    'thumbview'     => 'tillbaka&nbsp;till&nbsp;miniatyrbilderna',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'tillbaka&nbsp;till&nbsp;f&ouml;reg&aring;ende'
                     . '&nbsp;sida',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Slovenian courtesy - of Martin Vichar Donaj <martinvd@klaretinci.net>

$mig_config['lang_lib']['si'] = array (
    'am'            => 'dopoldan',
    'pm'            => 'popoldan',
    'backhome'      => 'nazaj&nbsp;k',
    'bytes'         => '&nbsp;bytov',
    'flash_used'    => 'uporablja&nbsp;flash',
    'largelink'     => 'nalo&#382;i&nbsp;polno&nbsp;velikost&nbsp;slike',
    'largeview'     => 'nazaj&nbsp;k&nbsp;web-velikosti&nbsp;slike',
    'main'          => 'Vrh',
    'must_auth'     => 'Mora&#353;&nbsp;imeti&nbsp;veljaven&nbsp;a&nbsp;vstop'
                     . '&nbsp;uporabnikIME&nbsp;in&nbsp;geslo&nbsp;za'
                     . '&nbsp;vstop',
    'nextimage'     => 'slika&nbsp;naprej',
    'no_contents'   => 'Ni&nbsp;vsebine.',
    'previmage'     => 'slika&nbsp;nazaj',
    'thumbview'     => 'index&nbsp;-&nbsp;kazalo&nbsp;',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Prikaz&nbsp;slik&nbsp;%s-%e&nbsp;od&nbsp;%t'
                     . '&nbsp;vseh<br />',
    'up_one'        => 'za&nbsp;en&nbsp;nivo&nbsp;navzgor',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'Maj', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Avg', '09' => 'Sep',
                               '10' => 'Okt', '11' => 'Nov', '12' => 'Dec')
);

?>

<?php

// Slovak - courtesy of Juro Polak <polak@axon.sk>
$mig_config['lang_lib']['sk'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'sp&auml;?&nbsp;na',
    'bytes'         => '&nbsp;bytov',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Hlavn&aacute;&nbsp;str&aacute;nka',
    'must_auth'     => 'Mus&iacute;te&nbsp;uvies?&nbsp;u?&iacute;vate'
                     . '&frac34;sk&eacute;&nbsp;meno&nbsp;a&nbsp;heslo&nbsp;'
                     . 'na&nbsp;vstup',
    'nextimage'     => '&iuml;al?&iacute;&nbsp;obr&aacute;zok',
    'no_contents'   => 'Pr&aacute;zdny&nbsp;adres&aacute;r.',
    'previmage'     => 'predch&aacute;dzaj&uacute;ci&nbsp;obr&aacute;zok',
    'thumbview'     => 'sp&auml;?&nbsp;na&nbsp;zmen?eniny&nbsp;obr&aacute;'
                     . 'zkov(thumbnail)',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'o&nbsp;&uacute;rove&ograve;&nbsp;vy??ie',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Turkish - courtesy of Dogan Sariguzel <dogan@procam.com.tr>
$mig_config['lang_lib']['tr'] = array (
    'am'            => 'AM',
    'pm'            => 'PM',
    'backhome'      => 'geri&nbsp;d&ouml;n:',
    'bytes'         => '&nbsp;bit',
    'flash_used'    => 'flash&nbsp;used',
    'largelink'     => 'view&nbsp;full-size&nbsp;image',
    'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
    'main'          => 'Ana',
    'must_auth'     => 'Ge&ccedil;erli&nbsp;bir&nbsp;kullan&yacute;c&yacute;'
                     . '&nbsp;ad&yacute;&nbsp;ve&nbsp;&thorn;ifre'
                     . '&nbsp;girmelisiniz.',
    'nextimage'     => 'sonraki&nbsp;resim',
    'no_contents'   => 'i&ccedil;erik&nbsp;yok.',
    'previmage'     => '&ouml;nceki&nbsp;resim',
    'thumbview'     => 'k&uuml;&ccedil;&uuml;k&nbsp;resimlere&nbsp;geri'
                     . '&nbsp;d&ouml;n',
    // total_images is special.  It has three elements you can use:
    //     %t :    Total images in folder
    //     %s :    First image shown this page
    //     %e :    Last image shown this page
    'total_images'  => 'Showing&nbsp;images&nbsp;%s-%e&nbsp;of&nbsp;%t'
                     . '&nbsp;total<br />',
    'up_one'        => 'bir&nbsp;seviye&nbsp;yukar&yacute;',
    'month'         => array ( '01' => 'Jan', '02' => 'Feb', '03' => 'Mar',
                               '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                               '07' => 'Jul', '08' => 'Aug', '09' => 'Sep',
                               '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
);


?>

<?php

// Traditional Chinese (big5)
// Courtesy of Belle Liu <belle@belleliu.com>
$mig_config['lang_lib']['zh'] = array (
     'am'            => 'W',
     'pm'            => 'U',
     'backhome'      => '^',
     'bytes'         => '&nbsp;줸',
     'flash_used'    => 'ΰ{O',
     'largelink'     => 'view&nbsp;full-size&nbsp;image',
     'largeview'     => 'back&nbsp;to&nbsp;web-sized&nbsp;view',
     'main'          => 'D',
     'must_auth'     => 'AJĪΤW٤αKX~iiJ',
     'nextimage'     => 'U@iϤ',
     'no_contents'   => 'Se',
     'previmage'     => 'W@iϤ',
     'thumbview'     => '^Y˵',
     // total_images is special.  It has three elements you can use:
     //     %t :    Total images in folder
     //     %s :    First image shown this page
     //     %e :    Last image shown this page
     'total_images'  => '?%tiϤ%s-%ei',
     'up_one'        => '^W@h',
     'month'         => array ( '01' => '@', '02' => 'G',
                                '03' => 'T', '04' => '|',
                                '05' => '', '06' => '',
                                '07' => 'C', '08' => 'K',
                                '09' => 'E', '10' => 'Q',
                                '11' => 'Q@', '12' => 'QG' )
);


?>

<?php

// URL to use to call myself again
if ($_SERVER['SCRIPT_NAME']) {
    $mig_config['baseurl'] = $_SERVER['SCRIPT_NAME'];
} elseif ($HTTP_SERVER_VARS['SCRIPT_NAME']) {
    $mig_config['baseurl'] = $HTTP_SERVER_VARS['SCRIPT_NAME'];
} elseif ($SCRIPT_NAME) {
    $mig_config['baseurl'] = $SCRIPT_NAME;
} elseif($_SERVER['SCRIPT_URI']) {
	$mig_config['baseurl'] = '/' . $_SERVER['SCRIPT_URI'];
} elseif ($_SERVER['PHP_SELF']) {
    $mig_config['baseurl'] = $_SERVER['PHP_SELF'];
} elseif ($HTTP_SERVER_VARS['PHP_SELF']) {
    $mig_config['baseurl'] = $HTTP_SERVER_VARS['PHP_SELF'];
} elseif ($PHP_SELF) {
    $mig_config['baseurl'] = $PHP_SELF;
}else {
    print 'FATAL ERROR: Could not set baseurl';
    exit;
}

//fix url have \' for php 4 only
if (substr(phpversion(),0,1) < 5) {
    $mig_config['baseurl'] = str_replace("\'","'",$mig_config['baseurl']);
}

$pattern = '/RvSitebuilderPreview/i';
if(!preg_match($pattern,$mig_config['baseurl'])){
	$unEncodeFileName = basename($mig_config['baseurl']);
	$encodeFileName = urlencode($unEncodeFileName);
	$newBaseUrl = str_replace($unEncodeFileName, $encodeFileName, $mig_config['baseurl']);
	$mig_config['baseurl'] = $newBaseUrl;
} 
// Fix pagename encode
$mig_config['baseurl'] = migURLencode($mig_config['baseurl']);


// Base directory of installation
if (isset($_SERVER['PATH_TRANSLATED'])) {
    $mig_config['basedir'] = $_SERVER['PATH_TRANSLATED'];
} elseif (isset($HTTP_SERVER_VARS['PATH_TRANSLATED'])) {
    $mig_config['basedir'] = $HTTP_SERVER_VARS['PATH_TRANSLATED'];
} elseif (isset($PATH_TRANSLATED)) {
    $mig_config['basedir'] = $PATH_TRANSLATED;
} elseif ($_SERVER['SCRIPT_FILENAME']) {
    $mig_config['basedir'] = $_SERVER['SCRIPT_FILENAME'];
} elseif ($HTTP_SERVER_VARS['SCRIPT_FILENAME']) {
    $mig_config['basedir'] = $HTTP_SERVER_VARS['SCRIPT_FILENAME'];
} elseif ($SCRIPT_FILENAME) {
    $mig_config['basedir'] = $SCRIPT_FILENAME;
} else {
    print 'FATAL ERROR: Can not set basedir';
    exit;
}

// Strip down to just directory name
$mig_config['basedir'] = dirname($mig_config['basedir']);

// Strip extra slashes out of basedir if appropriate
// This is basically for Windows SMB shares
if (eregi('^[\\]{2}', $mig_config['basedir'])) {
    $mig_config['basedir'] = stripslashes($mig_config['basedir']);
}

// Locate and load configuration
if (file_exists($mig_config['basedir'].'/config_album_'.$project_page_id.'.php')) {
    // Found it - regular mode
    $configFile = $mig_config['basedir'].'/config_album_'.$project_page_id.'.php';
}

// Include config file, making sure to modify the include path if appropriate.
if (isset($configFile)) {
    include(convertIncludePath($pathConvertFlag, $configFile,
                               $pathConvertRegex, $pathConvertTarget));
}

// Return an error if too many modes are set at once
$usePortal = 0;

if ($phpNukeCompatible)             ++$usePortal;
if ($phpWebThingsCompatible)        ++$usePortal;
if ($mig_xoopsCompatible)           ++$usePortal;
if ($mig_GeeklogCompatible)         ++$usePortal;

if ($usePortal > 1) {
    print 'FATAL ERROR: more than one content management system ';
    print 'is defined.';
    exit;
}

// Fetch some settings into $mig_config
$mig_config['commentfileperimage']              = $commentFilePerImage;
$mig_config['commentfileshortcomments']         = $commentFileShortComments;
$mig_config['fileinfoformatstring']             = $fileInfoFormatString;
$mig_config['foldernamelength']                 = $folderNameLength;
$mig_config['foldersorttype']                   = $folderSortType;
$mig_config['homelabel']                        = (isset($homeLabel)) ? $homeLabel : '';
$mig_config['homelink']                         = (isset($homeLink)) ? $homeLink : '';
$mig_config['ignoredotdirectories']             = $ignoreDotDirectories;
$mig_config['imagepoplocationbar']              = $imagePopLocationBar;
$mig_config['imagepopmaxheight']                = $imagePopMaxHeight;
$mig_config['imagepopmaxwidth']                 = $imagePopMaxWidth;
$mig_config['imagepoptoolbar']                  = $imagePopToolBar;
$mig_config['imagepoptype']                     = $imagePopType;
$mig_config['imagepopup']                       = $imagePopup;
$mig_config['largesubdir']                      = $largeSubdir;
$mig_config['nextformatstring']                 = $nextFormatString;
$mig_config['nothumbs']                         = $noThumbs;
$mig_config['omitimagename']                    = $omitImageName;
$mig_config['randomfolderthumbs']               = $randomFolderThumbs;
$mig_config['pagetitle']                        = $pageTitle;
$mig_config['prevformatstring']                 = $prevFormatString;
$mig_config['maxShortComment']  = $maxShortComment;
$mig_config['showshortonthumbpage']             = $showShortOnThumbPage;
$mig_config['sorttype']                         = $sortType;
$mig_config['suppressalttags']                  = $suppressAltTags;
$mig_config['suppressimageinfo']                = $suppressImageInfo;
$mig_config['thumbext']                         = (isset($thumbExt)) ? $thumbExt : '';
$mig_config['thumbsubdir']                      = $thumbSubdir;
$mig_config['uselargeimages']                   = $useLargeImages;
$mig_config['userealrandthumbs']                = $useRealRandThumbs;
$mig_config['usethumbsubdir']                   = $useThumbSubdir;
$mig_config['viewfoldercount']                  = $viewFolderCount;
$mig_config['imageFilenameRegexpr']             = $imageFilenameRegexpr;
$mig_config['currDirNameRegexpr']               = $currDirNameRegexpr;
$mig_config['rvs_language'] = $rvs_language;
$mig_config['rvs_charset'] = $rvs_charset;

//ถ้าเปิด config $showShortOnThumbPage(description) => $suppressAltTags(title) ก็จะใช้ได้
//ถ้า ปิด config $showShortOnThumbPage(description) => $suppressAltTags(title) ก็จะใช้ไม่ได้ แม้ว่าจะเปิดอยู่ก็ตาม

// Change settings for Nuke mode if appropriate
if ($phpNukeCompatible) {
    $mig_config['basedir'] .= '/mig';
    if (! $phpNukeRoot) {
        print "FATAL ERROR: \$phpNukeRoot not defined!\n";
        exit;
    }
    $result = chdir($phpNukeRoot);
    if (! $result) {
        print "FATAL ERROR: can not chdir() to \$phpNukeRoot!\n";
        exit;
    }
    // Detect PostNuke if it's there
    if (file_exists('includes/pnAPI.php')) {
        include('includes/pnAPI.php');
        pnInit();
    }

// or for PhpWebThings...
} elseif ($phpWebThingsCompatible) {
    $mig_config['basedir'] .= '/mig';
    if (! $phpWebThingsRoot) {
        print "FATAL ERROR: \$phpWebThingsRoot not defined!\n";
        exit;
    }
    $result = chdir($phpWebThingsRoot);
    if (! $result) {
        print "FATAL ERROR: can not chdir() to \$phpWebThingsRoot!\n";
        exit;
    }
    // phpWebThings library
    if (file_exists('core/main.php')) {
        include('core/main.php');
    } else {
        print "FATAL ERROR: phpWebThings lib missing!\n";
        exit;
    }

// or for XOOPS...
} elseif ($mig_xoopsCompatible) {
    if (! $mig_xoopsRoot) {
        print "FATAL ERROR: \$mig_xoopsRoot not defined!\n";
        exit;
    }
    $result = chdir($mig_xoopsRoot);
    if (! $result) {
        print "FATAL ERROR: can not chdir() to \$mig_xoopsRoot!\n";
        exit;
    }
    // XOOPS library
    if (file_exists('mainfile.php')) {
        include('mainfile.php');
    } else {
        print "FATAL ERROR: XOOPS lib missing!\n";
        exit;
    }

// or for Geeklog...
} elseif ($mig_GeeklogCompatible) {
    if (! $mig_GeeklogRoot) {
        print "FATAL ERROR: \$mig_GeeklogRoot not defined!\n";
        exit;
    }
    $result = chdir($mig_GeeklogRoot);
    if (! $result) {
        print "FATAL ERROR: can not chdir() to \$mig_GeeklogRoot!\n";
        exit;
    }
    // Geeklog library
    if (file_exists('lib-common.php')) {
        include('lib-common.php');
    } else {
        print "FATAL ERROR: lib-common.php missing!\n";
        exit;
    }
}
//**** RVS Edit
// Jump has to come before currDir redirect to work

if (!isset($jump)) {
    if (isset($_GET['jump'])) {
        $jump = $_GET['jump'];
    } elseif (isset($HTTP_GET_VARS['jump'])) {
        $jump = $HTTP_GET_VARS['jump'];
    }
}

if (!isset($SERVER_NAME)) {
    if (isset($_SERVER['SERVER_NAME'])) {
        $SERVER_NAME = $_SERVER['SERVER_NAME'];
    } elseif (isset($HTTP_SERVER_VARS['SERVER_NAME'])) {
        $SERVER_NAME = $HTTP_SERVER_VARS['SERVER_NAME'];
    }
}

if (!isset($SERVER_PORT)) {
    if (isset($_SERVER['SERVER_PORT'])) {
        $SERVER_PORT = $_SERVER['SERVER_PORT'];
    } elseif (isset($HTTP_SERVER_VARS['SERVER_PORT'])) {
        $SERVER_PORT = $HTTP_SERVER_VARS['SERVER_PORT'];
    }
}

if (!isset($SERVER_PORT)) {
    $SERVER_PORT = "80";
}

if (!isset($PATH_INFO)) {
    if (isset($_SERVER['PATH_INFO'])) {
        $PATH_INFO = $_SERVER['PATH_INFO'];
    } elseif (isset($HTTP_SERVER_VARS['PATH_INFO'])) {
        $PATH_INFO = $HTTP_SERVER_VARS['PATH_INFO'];
    }
}

// Is this a jump-tag URL?
if (isset($jump) && isset($jumpMap[$jump]) && isset($SERVER_NAME)) {
    header("Location: http://$SERVER_NAME:$SERVER_PORT" . $mig_config['baseurl']
         . "?$jumpMap[$jump]");
    exit;
}

// Jump-tag using PATH_INFO rather than "....?jump=x" URI
if (isset($PATH_INFO) && isset($jumpMap[$PATH_INFO]) && isset($SERVER_NAME)) {
    header("Location: http://$SERVER_NAME:$SERVER_PORT" . $mig_config['baseurl']
         . "?$jumpMap[$PATH_INFO]");
    exit;
}

//moved this some lines up... need it for checking if the image-file exists. wmk

$mig_config['albumdir'] = $mig_config['basedir'] . '/albums_'.$project_page_id;   // Where albums live
// If you change the directory here also make sure to change $albumURLroot



// Get currDir.  If there isn't one, default to "."
if (isset($_GET['currDir'])) {
    $currDir = $_GET['currDir'];
} elseif (isset($HTTP_GET_VARS['currDir'])) {
    $currDir = $HTTP_GET_VARS['currDir'];
} else    $currDir = '.';

if (!$currDir) {
    $currDir = '.';
}

// Get rid of \'s if magic_quotes_gpc is turned on (causes problems).
if (get_magic_quotes_gpc() == 1) {
    $currDir = stripslashes($currDir);
}

// Look at currDir from a security angle.  Don't let folks go outside
// the album directory base
//RVS remove !preg_match($mig_config['currDirNameRegexpr'], $currDir) for show folder with special character
if (strstr($currDir, '..')) {
    print 'SECURITY VIOLATION - ABANDON SHIP';
    exit;
}

// Try to validate currDir
//     Must be either "." (root) or,
//     must begin with "./" and dot or slash can't follow that
//     for at least two positions.
//
if ( $currDir != '.' && ! ereg('^./[^/][^/]*', $currDir) ) {
    print 'ERROR: \$currDir is invalid.  Exiting.';
    exit;
}

// currDir may not end in / unless it is './' in its entirety
if ( $currDir != './' && ereg('/$', $currDir) ) {
    print "ERROR: \$currDir is invalid.  Exiting.";
    exit;
}

// Strip URL encoding
$currDir = rawurldecode($currDir);

// Get image, if there is one.
if (!isset($image)) {
    if (isset($_GET['image'])) {
        $image = $_GET['image'];
    } elseif (isset($HTTP_GET_VARS['image'])) {
        $image = $HTTP_GET_VARS['image'];
    }
}

// Get rid of \'s if magic_quotes_gpc is turned on (causes problems).
if ((get_magic_quotes_gpc() == 1) && (isset($image))) {
        $image = stripslashes($image);
}

// Look at $image from a security angle.
// Don't let folks go outside the album directory base
// Don't let folks define ANY directory here
if(!isset($image)){$image = '';}
/*if (strstr($image, '..') || preg_match($mig_config['imageFilenameRegexpr'], $image)) {
    print 'ERROR: $image is invalid.  Exiting.';
    exit;
}*/

$mig_config['image'] = htmlentities($image);
$mig_config['image'] = html_entity_decode($mig_config['image']);

// check if the image exists...

if (($mig_config['image'])AND(!file_exists($mig_config['albumdir']."/$currDir/".$mig_config['image']))){
    echo "ERROR: ".$currDir."/".$mig_config['image']." is invalid.  Exiting.";
    exit;
}




// Get pageType.  If there isn't one, default to "folder"
if (!isset($pageType)) {
    if (isset($_GET['pageType'])) {
        $pageType = $_GET['pageType'];
    } elseif (isset($HTTP_GET_VARS['pageType'])) {
        $pageType = $HTTP_GET_VARS['pageType'];
    } else {
        $pageType = 'folder';
    }
}

// only allow one of the predefined values
$allowedTypes = array( "image" => 1, "folder" => 1, "large" => 1, "" => 1);

if(!isset($allowedTypes[$pageType])) {
	echo 'ERROR: $pageType is invalid.  Exiting.';
	exit;
}

unset($allowedTypes);

$mig_config['pagetype'] = $pageType;


if (!isset($startFrom)) {
    if (isset($_GET['startFrom'])) {
        $startFrom = $_GET['startFrom'];
    } elseif (isset($HTTP_GET_VARS['startFrom'])) {
        $startFrom = $HTTP_GET_VARS['startFrom'];
    }
}

// only allow digits for $startFrom
$mig_config['startfrom'] = isset($startFrom) ? $startFrom+0 : 0;

// use language set specified in URL, if one was.
if (!isset($mig_dl)) {
    if (isset($_GET['mig_dl'])) {
        $mig_dl = $_GET['mig_dl'];
    } elseif (isset($HTTP_GET_VARS['mig_dl'])) {
        $mig_dl = $HTTP_GET_VARS['mig_dl'];
    }
}
// Only use it if we find it - otherwise fall back to default language
if (isset($mig_dl) && isset($mig_config['lang_lib'][$mig_dl])) {
    $mig_language = $mig_dl;
	$mig_config['mig_dl'] = $mig_dl;
} else {
    unset ($mig_dl);        // destroy it so it isn't used in URLs
    
}

// Include root/reseller translate language
if(is_readable($mig_config['basedir']  . '/scripts/photo_album_' . $project_page_id . '/language/' . $rvs_language . '.php')){
	include_once ($mig_config['basedir']  . '/scripts/photo_album_' . $project_page_id . '/language/' . $rvs_language . '.php');
	$mig_config['lang'] = $aLang;
	for($i=1;$i<=12;$i++){
		$index = $i;
		if($i <= 9){
			$index =  	'0' . $i ;
		}	
		$mig_config['lang']['month'][$index] = $aLang[$index];
	}
}
else {
// Grab appropriate language from library
$mig_config['lang'] = $mig_config['lang_lib'][$mig_language];
	
}

// Backward compatibility with older config.php/mig.cfg versions
if (isset($maxColumns)) {
    $maxThumbColumns = $maxColumns;
}

// Turn off magic_quotes_runtime (causes trouble with some installations)
set_magic_quotes_runtime(0);


//
// Handle any password authentication needs
//

$workCopy = $currDir;     // temporary copy of currDir

while ($workCopy) {

    if (isset($protect[$workCopy])) {

        if (! $PHP_AUTH_USER) {
            if ($_SERVER['PHP_AUTH_USER']) {
                $PHP_AUTH_USER = $_SERVER['PHP_AUTH_USER'];
            } elseif ($HTTP_SERVER_VARS['PHP_AUTH_USER']) {
                $PHP_AUTH_USER = $HTTP_SERVER_VARS['PHP_AUTH_USER'];
            }
        }
        if (! $PHP_AUTH_PW) {
            if ($_SERVER['PHP_AUTH_PW']) {
                $PHP_AUTH_PW = $_SERVER['PHP_AUTH_PW'];
            } elseif ($HTTP_SERVER_VARS['PHP_AUTH_PW']) {
                $PHP_AUTH_PW = $HTTP_SERVER_VARS['PHP_AUTH_PW'];
            }
        }

        // If there's not a username yet, fetch one by popping up a
        // login dialog box
        if (! $PHP_AUTH_USER) {
            header('WWW-Authenticate: Basic realm="protected"');
            header('HTTP/1.0 401 Unauthorized');
            print $mig_config['lang']['must_auth'];
            exit;

        } else {
            // Case #2: password/user are present but don't match up
            // with our known user base.  Reject the attempt.
            if ( crypt($PHP_AUTH_PW,
                       substr($protect[$workCopy][$PHP_AUTH_USER],0,2))
                 != $protect[$workCopy][$PHP_AUTH_USER] )
            {
                header('WWW-Authenticate: Basic realm="protected"');
                header('HTTP/1.0 401 Unauthorized');
                print $mig_config['lang']['must_auth'];
                exit;
            }
        }
        break;      // Since we had a match let's stop this loop
    }

    // if $workCopy is already down to "." just nullify to end loop
    if ($workCopy == '.') {
        $workCopy = FALSE;
    } else {
        // parse $workCopy down one directory at a time
        // so we can check back all the way to "."
        $workCopy = ereg_replace('/[^/]+$', '', $workCopy);
    }
}

/*// send Content-Type
if($httpContentType) {
    header('Content-Type: '.$httpContentType);
}*/

// Where templates live
$mig_config['templatedir'] = $mig_config['basedir'] . '/templates_'.$project_page_id;

// baseURL with the scriptname torn off the end
$baseHref = ereg_replace('/[^/]+$', '', $mig_config['baseurl']);

// Adjust for Nuke mode if appropriate
if ($phpNukeCompatible || $phpWebThingsCompatible) {
    $baseHref .= '/mig';
}

// Location of image library (for instance, where icons are kept)
$mig_config['imagedir'] = $baseHref . '/templates_'.$project_page_id;

// Root where album images are living
$mig_config['albumurlroot'] = $baseHref . '/albums_'.$project_page_id;
// NOTE: Sometimes Windows users have to set this manually, like:
// $mig_config['albumurlroot'] = '/mig/albums';

// Well, GIGO... set default to sane if someone screws up their
// config file

if ($markerType != 'prefix' && $markerType != 'suffix' ) {
    $markerType = 'suffix';
}
$mig_config['markertype'] = $markerType;

if (! $markerLabel) {
    $markerLabel = 'th';
}
$mig_config['markerlabel'] = $markerLabel;

// Override folder sort if one's not present
if (! $mig_config['foldersorttype']) {
    $mig_config['foldersorttype'] = $mig_config['sorttype'];
}

// Fetch mig.cf information
list($presort_dir, $presort_img, $desc, $short_desc, $bulletin,
     $ficons, $folderTemplate, $folderFolderCols,
     $folderThumbCols, $folderThumbRows, $folderMaintAddr)
  = parseMigCf($mig_config['albumdir']."/$currDir");
  
// Set per-folder $maintAddr if one was defined
if ($folderMaintAddr) {
    $maintAddr = $folderMaintAddr;
}

// Is this a phpNuke compatible site?
if ($phpNukeCompatible) {

    if (! isset($mainfile)) {
        include('mainfile.php');
    }
    include('header.php');

    // A table to nest Mig in, inside the PHPNuke framework
    print '<table width="100%" border="0" cellspacing="0" cellpadding="2"'
        . ' bgcolor="#000000"><tr><td>'
        . '<table width="100%" border="0" cellspacing="1" cellpadding="7"'
        . ' bgcolor="#FFFFFF"><tr><td>';

// Is this a phpWebThings site?
} elseif ($phpWebThingsCompatible) {
    draw_header();
    if (function_exists('theme_draw_center_box_open')) {
        theme_draw_center_box_open($mig_config['pagetitle']);
    } elseif (function_exists('theme_draw_box_open')) {
        theme_draw_box_open($mig_config['pagetitle']);
    } else {
        print 'ERROR: Unable to find relevant drawing function';
        exit;
    }

// Is this a XOOPS site?
} elseif ($mig_xoopsCompatible) {
    include(XOOPS_ROOT_PATH.'/header.php');

// is this a Geeklog site?
} elseif ($mig_GeeklogCompatible) {
    echo COM_siteHeader ('menu');

}

// strip URL encoding here too
$mig_config['image'] = rawurldecode($mig_config['image']);

// if pageType is "folder") generate a folder view

if ($mig_config['pagetype'] == 'folder') {

    // Determine which template to use
    if ($folderTemplate) {
        $templateFile = $folderTemplate;
    } elseif ($usePortal) {    // portal is in use
        $templateFile = $mig_config['templatedir'] . '/mig_folder.php';
    } else {
        $templateFile = $mig_config['templatedir'] . '/folder.html';
    }

    // Determine columns and rows to use
    if ($folderFolderCols) {
        $maxFolderColumns = $folderFolderCols;
    }

    if ($folderThumbCols) {
        $maxThumbColumns = $folderThumbCols;
    }

    // Generate some HTML to pass to the template printer

    // list of available folders
    $folderList = buildDirList($currDir, $maxFolderColumns, $presort_dir, $ficons);
    // list of available images
    $imageList = buildImageList($currDir, $maxThumbColumns, $maxThumbRows,
                                $folderList, $presort_img, $desc, $short_desc);

    // Only frame the lists in table code when appropriate

    // Set style of table, either with text or thumbnails
    if ($mig_config['randomfolderthumbs']) {
        $folderTableClass = 'folderthumbs';
    } else {
        $folderTableClass = 'foldertext';
    }

    // no folders or images - print the "no contents" line
    if ($folderList == 'NULL' && $imageList == 'NULL') {
        $folderList = $mig_config['lang']['no_contents'];
        $tablesummary = 'Folders Frame';
        $folderList = buildTable($folderList, $folderTableClass,
                                 $tablesummary);
        $imageList = '';

    // images, no folders.  Frame the imagelist in a table
    } elseif ($folderList == 'NULL' && $imageList != 'NULL') {
        $folderList = '';
        /*$tablesummary = 'Images Frame';
        $tableclass = 'image';
        $imageList = buildTable($imageList, $tableclass, $tablesummary);*/

    // folders but no images.  Frame the folderlist in a table
    } elseif ($imageList == 'NULL' && $folderList != 'NULL') {
        $imageList = '';
        $tablesummary = 'Folders Frame';
        $folderList = buildTable($folderList, $folderTableClass,
                                 $tablesummary);

    // We have folders and we have images, so frame both in tables.
    } else {
        $tablesummary = 'Folders Frame';
        $folderList = buildTable($folderList, $folderTableClass,
                                 $tablesummary);
        /*$tablesummary = 'Images Frame';
        $tableclass = 'image';
        $imageList = buildTable($imageList, $tableclass, $tablesummary);*/
    }

    // We have a bulletin
    if ($bulletin != '') {
        $tablesummary = 'Bulletin Frame" width="60%';  //<--- kludge for now
        $tableclass = 'desc';
        $bulletin = '<center>' . $bulletin . '</center>';
        $bulletin = buildTable($bulletin, $tableclass, $tablesummary);
    }

    // build the "back" link
    $backLink = buildBackLink($currDir, 'back', '');

    // build the "you are here" line
    $youAreHere = buildYouAreHere($currDir, '', $mig_config['omitimagename']);

    // newcurrdir is currdir without the leading "./"
    $newCurrDir = getNewCurrDir($currDir);

    // parse the template file and print to stdout
    printTemplate($templateFile, $version, $maintAddr,
                  $folderList, $imageList, $backLink, '',
                  $newCurrDir, '', '', '', $bulletin,
                  $youAreHere, $distURL, $pathConvertFlag,
                  $pathConvertRegex, $pathConvertTarget, '', '', '', '' ,$showPowered);


// If pageType is "image", show an image

} elseif ($mig_config['pagetype'] == 'image') {

    // Trick back link into going to the right place by adding
    // a bogus directory at the end
    $backLink = buildBackLink("$currDir/blah", 'up');

    // Get the "next image" and "previous image" links, and the current
    // position (#x of y)
    $Links = array ();
    $Links = buildNextPrevLinks($currDir, $presort_img);
    list($nextLink, $prevLink, $currPos) = $Links;
    // Get image description
    if ($mig_config['commentfileperimage']) {
        list($x, $description) = getImageDescFromFile($currDir);
        // If getImageDescFromFile() returned false, get the normal
        // comment if there is one.
        if (! $description) {
            list($x, $description) = getImageDescription($image, $desc, $short_desc);
        }
    } else {
        list($x, $description) = getImageDescription($image, $desc, $short_desc);
        // add function check description and shortdescription
        list($x, $description) = rvsGetImageDescription($mig_config, $image, $desc, $short_desc);
    }


    $exifDescription = getExifDescription($currDir, $exifFormatString);

    // If there's a description but no exifDescription, just make the
    // exifDescription the description
    if ($exifDescription && ! $description) {
        $description = $exifDescription;
        unset($exifDescription);
    }

    // If both descriptions are non-NULL, separate them with an <HR>
    if ($description && $exifDescription) {
        $description .= '<hr>';
        $description .= $exifDescription;
    }

    // Build the "you are here" line
    $youAreHere = buildYouAreHere($currDir, $mig_config['omitimagename']);

    // Which template to use.
    if ($usePortal) {           // portal is in use
        $templateFile = $mig_config['templatedir'] . '/mig_image.php';
    } else {
        $templateFile = $mig_config['templatedir'] . '/image.html';
    }

    // newcurrdir is currdir without the leading "./"
    $newCurrDir = getNewCurrDir($currDir);

    if ($mig_config['uselargeimages'] &&
            file_exists($mig_config['albumdir']."/$currDir/"
                      . $mig_config['largesubdir']
                      . '/'.$mig_config['image']))
    {
        $largeLink = buildLargeLink($currDir);

        // Only build this link if we plan to use it
        if ($largeLinkFromMedium) {
            $largeHrefStart = buildLargeHrefStart($currDir);
            $largeHrefEnd = '</a>';
        }

        // Use a border?
        if (! $largeLinkUseBorders) {
            $largeLinkBorder = ' border="0"';
        }
    }

    // Send it all to the template printer to dump to stdout
    if(!isset($largeLink)){$largeLink = '';}
	if(!isset($largeHrefStart)){$largeHrefStart = '';}
	if(!isset($largeHrefEnd)){$largeHrefEnd = '';}
	if(!isset($largeLinkBorder)){$largeLinkBorder = '';}
	
    printTemplate($templateFile, $version, $maintAddr, '', '', $backLink,
                  $currDir, $newCurrDir, $prevLink, $nextLink, $currPos,
                  $description, $youAreHere, $distURL, $pathConvertFlag, $pathConvertRegex,
                  $pathConvertTarget, $largeLink, $largeHrefStart, $largeHrefEnd,
                  $largeLinkBorder,$showPowered);

// If the pageType is "large", show a large image

} elseif ($mig_config['pagetype'] == 'large') {

    // Trick the back link into going to the right place by adding
    // a bogus directory at the end
    $backLink = buildBackLink("$currDir/blah", 'up', '', '');

    // Get the "next image" and "previous image" links, and the current
    // position (#x of y)
    $Links = array ();
    $Links = buildNextPrevLinks($currDir, $presort_img);
    list($nextLink, $prevLink, $currPos) = $Links;

    // Get image description
    if ($mig_config['commentfileperimage']) {
        list($x, $description) = getImageDescFromFile($currDir);
        // If getImageDescFromFile() returned false, get the normal
        // comment if there is one.
        if (! $description) {
            list($x, $description) = getImageDescription($image, $desc,$short_desc);
        }
    } else {
        list($x, $description) = getImageDescription($image, $desc,$short_desc);
    }

    $exifDescription = getExifDescription($currDir,$exifFormatString);

    // If there's a description but no exifDescription, just make the
    // exifDescription the description
    if ($exifDescription && ! $description) {
        $description = $exifDescription;
        unset($exifDescription);
    }

    // If both descriptions are non-NULL, separate them with an <HR>
    if ($description && $exifDescription) {
        $description .= '<hr />';
        $description .= $exifDescription;
    }

    // Build the "you are here" line
    $youAreHere = buildYouAreHere($currDir, $mig_config['omitimagename']);

    // Which template to use
    if ($usePortal) {           // portal is in use
        $templateFile = $mig_config['templatedir'] . '/mig_large.php';
    } else {
        $templateFile = $mig_config['templatedir'] . '/large.html';
    }

    // newcurrdir is currdir without the leading "./"
    $newCurrDir = getNewCurrDir($currDir);

    // Send it all to the template printer to dump to stdout
    printTemplate($templateFile, $version, $maintAddr, '', '', $backLink,
                  $currDir, $newCurrDir, $prevLink, $nextLink, $currPos,
                  $description, $youAreHere, $distURL, $pathConvertFlag, $pathConvertRegex,
                  $pathConvertTarget, '', '', '', '',$showPowered);
}

// Finish up for content management systems

if ($phpNukeCompatible) {
    print '</tbody></table></center></td></tr></tbody></table>';
    include('footer.php');

} elseif ($phpWebThingsCompatible) {
    if (function_exists('theme_draw_center_box_close')) {
        theme_draw_center_box_close();
    } elseif (function_exists('theme_draw_box_close')) {
        theme_draw_box_close();
    } else {
        print 'Unable to find relevant drawing function';
        exit;
    }
    //if($modules['news']) draw_news(true);
    //draw_news(true);
    draw_footer();

} elseif ($mig_xoopsCompatible) {
    if ($mig_config['pagetype'] == 'image') {
        $xoopsOption['show_rblock'] = $mig_xoopsRBlockForImage;
    } else {
        $xoopsOption['show_rblock'] = $mig_xoopsRBlockForFolder;
    }
    include(XOOPS_ROOT_PATH.'/footer.php');

} elseif ($mig_GeeklogCompatible) {
    if ($mig_config['pagetype'] == 'folder') {
        echo COM_siteFooter($mig_GeeklogRBlockForFolder);
    } else {
        echo COM_siteFooter($mig_GeeklogRBlockForImage);
    }

}
function rvsGetImageDescription($mig_config, $filename, $description, $short_desc)
{
    //change
    /*  if (isset($description[$file])) {
        $imageDesc = $description[$file];
    }*/
    $array = array();
  
  $a = (isset($short_desc[$filename]) && $short_desc[$filename]) ? $short_desc[$filename] : $filename;
  $b = (isset($description[$filename]) && $description[$filename]) ? $description[$filename] : $filename;
  
  $charsetTo = (isset($mig_config['rvs_charset'])) ? $mig_config['rvs_charset'] : 'utf-8';
  $a = getConvertFunc($a, 'utf-8', $charsetTo);
  $b = getConvertFunc($b, 'utf-8', $charsetTo); 
  
    if ($mig_config['showshortonthumbpage']) {
        $array = array($a, $b);
    } 
   return $array;
 
}
function getShortDescription($alt_desc,$maxShortComment)
    {
       $shortDesc = substr($alt_desc, 0,$maxShortComment) . '...';
       return $shortDesc;
    }
    
   function dbeSubstr($string, $start, $lengh, $rvs_language)
    {        
        if (function_exists('mb_substr')) {
             $string = mb_substr($string, $start, $lengh, 'utf-8'). '...';
        } elseif (function_exists('substr')) {
            $string = substr($string, $start, $lengh). '...';
        } else {
            $string = $string;
        }
       
        return $string;
    }
    
    function getConvertFunc($value, $from, $to)
    {
        $convertValue = '';
        if (function_exists('iconv')) {
            $convertValue = @iconv($from, $to, $value);
        } elseif (function_exists('mb_convert_encoding') && function_exists('mb_internal_encoding')) {
            mb_internal_encoding($from);
            $convertValue = mb_convert_encoding($value, $to, $from);
        } elseif (function_exists('utf8_decode')) {
            $convertValue = utf8_decode($value);
        } else {
            $convertValue = $value;
        }
                
        return $convertValue;
    }
?>
