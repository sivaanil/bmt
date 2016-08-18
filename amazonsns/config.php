<?php
/* Database credentials */
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_NAME","snsdb");
define("DB_PASSWORD","bHvhTb@1b6");

/* Amazon Credentials */
DEFINE("AMAZON_KEY","AKIAJLC2IMZWW7HSIYZA"); 
DEFINE("AMAZON_SECRET","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"); 

/* SNS Platform Application ARNs */
DEFINE("SNS_PLATFORM_ARN","arn:aws:sns:ap-southeast-1:030821119767:app/GCM/BMT-S"); // should be of either GCM or APNS

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

?>
