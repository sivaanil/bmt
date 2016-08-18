<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailswivio{

	public function __construct() 
	{
		$this->CI =& get_instance();
	}

	public function send_email_template($to,$subject,$message)
	{
		
		$headers = "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1"."\r\n";
		$headers .= 'From: Swivio <no-reply@swivio.com>'."\r\n";
		$res = mail($to,$subject,$message,$headers);
		   if( $res == true )  
		   {
		      return 1;
		   }
		   else
		   {
		     return 0;
		   }
	}
}
