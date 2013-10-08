<?php

define("DEFAULT_DEV_CENTRAL", "developer");
define("DEFAULT_ENV", "sandbox");
define("DEFAULT_USER_NAME", "sdk-three_api1.sdk.com");
define("DEFAULT_PASSWORD", "QFZCWN5HZM8VBG7Q");
define("DEFAULT_SIGNATURE", "A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI");
define("DEFAULT_EMAIL_ADDRESS", "sdk-seller@sdk.com");
define("DEFAULT_IDENTITY_TOKEN", "G5JgcRdmlYUwnHcYSEXI2rFuQ5yv-Ei19fMFWn30aDkZAoKt_7LTuufYXUa");
define("DEFAULT_EWP_CERT_PATH", "cert/sdk-ewp-cert.pem");
define("DEFAULT_EWP_PRIVATE_KEY_PATH", "cert/sdk-ewp-key.pem");
define("DEFAULT_EWP_PRIVATE_KEY_PWD", "password");
define("DEFAULT_CERT_ID", "KJAERUGBLVF6Y");
define("PAYPAL_CERT_PATH", "cert/sandbox-cert.pem");
define("BUTTON_IMAGE", "https://www.paypal.com/en_US/i/btn/x-click-but23.gif");
define("PAYPAL_IPN_LOG", "paypal-ipn.log");
define("OTHER_LOG", "wedding-other.log");

define("WEDDING_DB_USER", "dimitria_web");
define("WEDDING_DB_PASSWORD", "wedding");

define("MODE_DEBUG", FALSE);
define("PRIMARY_BIZ_EMAIL", "sniperious@yahoo.com");//"dimitri@dimitriandalice.com");//"seller_1292859600_biz@gmail.com");
define("LOCK_TIMEOUT",120);
define("RES_TIMEOUT", 2 * 60 * 60 ); //time out a reservation after 2 hours
define("TABLE_LOCKS", "room_types WRITE, room_res WRITE, rsvps WRITE, payments WRITE");
define("TABLE_LOCKS_CARPOOL", "carpools WRITE, riders WRITE");
define("CANCELLATION_POLICY", "CANCELLATION POLICY\n\n".
"If, for any reason, you need to cancel your reservation\n".
"please contact Dimitri at: Dimitri@DimitriAndAlice.com\n\n".
"A full refund of the amount paid will be sent through Paypal\n".
"for any cancellations received before 11:59pm, April 20th.\n\n".
"For cancellations received After April 20th, the amount paid,\n".
"less 50% of the Total Reservation Cost, will be refunded.\n".
"(This means that if you only deposited half, you will receive no\n".
"refund.)");
?>
