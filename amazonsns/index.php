<?php

include 'config.php';
include 'sns.class.php';

$sns = Aws\Sns\SnsClient::factory(array(
    		'key'    => "AKIAJLC2IMZWW7HSIYZA",
    		'secret' => "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",
    		'region' =>  "ap-southeast-1"
		));
		

$reg = $sns->createPlatformEndpoint(array("PlatformApplicationArn"=>"arn:aws:sns:ap-southeast-1:030821119767:app/GCM/BMT-S","Token"=>"APA91bFNAuFxlWuX48SwA77NWLRqLWgqiHIww5d4dJUSFGkpWbDsgGaXL5u6Uir3ck7DFhbif1U_zS_mVirlc4sJNuziAWLRC--RqGyMtE2Pi2dB5DKNUrEb1OpU3R8Bdl_9bfLlQDGD6k5bNFfWc3fKT74U1nHER"));

print_r($reg);

?>