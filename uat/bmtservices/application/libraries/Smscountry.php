<?php
class Smscountry 
{
	private $user="tayatechnologies"; //your username
	private $password='Bu!k$m$Tay@123'; //your password
	private $senderid="BMTOLL"; //Your senderid
	private $messagetype="N"; //Type Of Your Message
	private $DReports="Y"; //Delivery Reports
	private $mobilenumber="";
	private $message="";

	function __construct()
	{
		
	}
	
	public function sendSms($sms)
	{
		//print_r($sms);exit;
			$this->mobilenumber=str_replace(" ", '', $sms["mobilenumber"]); //enter Mobile numbers comma seperated
			$this->message =$sms["message"]; //enter Your Message
			
			//Please Enter Your Details
			
			$url="http://sms.tanukupeople.com/WebServiceSMS.aspx";
			$this->message = urlencode($this->message);
			$ch = curl_init();

				if (!$ch){die("Couldn't initialize a cURL handle");}
					$ret = curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt ($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt ($ch, CURLOPT_POSTFIELDS,
					"User=$this->user&passwd=$this->password&mobilenumber=$this->mobilenumber&message=$this->message&sid=$this->senderid&mtype=$this->messagetype&DR=$this->DReports");
					
					$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					
					$curlresponse = curl_exec($ch); // execute
						if(curl_errno($ch))

							echo 'curl error : '. curl_error($ch);
						if (empty($ret)) {
					// some kind of an error happened

							die(curl_error($ch));
							curl_close($ch); // close cURL handler
						} else {

							$info = curl_getinfo($ch);
							
							curl_close($ch); // close cURL handler
							return $curlresponse; //echo "Message Sent Succesfully" ;
							}
							//print_r($curlresponse); //echo "Message Sent Succesfully" ;
							//exit;

	}
}
?>