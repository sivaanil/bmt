<?php


//Application ARN:   arn:aws:sns:ap-southeast-1:030821119767

require 'amazonsns/aws-lib/aws.phar';
//use aws\Sns\SnsClient;

if(isset($_POST['submit']))
{
//echo "hi";exit;
   echo $push_message = $_POST['push_message'];

    if(!empty($push_message))
    {
echo "==ggg=";
        // Create a new Amazon SNS client
        $sns = Aws\Sns\SnsClient::factory(array(
            'key'    => 'AKIAJLC2IMZWW7HSIYZA',
            'secret' => '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',
            'region' => 'ap-southeast-1'
            ));

      //  $android_AppArn = "arn:aws:sns:ap-southeast-1:030821119767:app/GCM/BMT-S";

       // $android_model = $sns->listEndpointsByPlatformApplication(array('PlatformApplicationArn' => $android_AppArn));
echo "ff";
 $endpointArn='2db3d3ad052e279d';

        //$sns->publish(array('Message' => $push_message, 'TargetArn' => $endpointArn));

                echo "<strong>Success:</strong> ".$endpointArn."<br/>";
   

              //  echo "<strong>Failed:</strong> ".$endpointArn."<br/><strong>Error:</strong> ".$e->getMessage()."<br/>";
        

    }else{
echo "gg";
}
}   
?>
