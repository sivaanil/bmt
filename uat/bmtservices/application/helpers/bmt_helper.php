<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
    /**
     * [dd description]
     * @param  [type] $debugvariable [description]
     * @return [type]                [description]
     */
	function dd($debugvariable){
		var_dump($debugvariable);
		exit;
	}


	/**
	 * [pd description]
	 * @param  [type] $debugarray [description]
	 * @return [type]             [description]
	 */
	function pd($debugarray){
		print_r($debugarray);
		exit;
	}

/**
	 * [responseObject description]
	 * @param  integer $code     [description]
	 * @param  string  $message  [description]
	 * @param  string  $errors   [description]
	 * @param  string  $response [description]
	 * @return [type]            [description]
	 */
	
	function responseObject($code = 400,$error = "",$response="",$statusMessage="",$successMessage=""){
/*
		print_r($response);
		exit;*/

		$CI =& get_instance();
		// $error = trim($error);
		
		if(!empty($error)){
			$error = explode("</p>",trim($error));
			if(empty($error[count($error)-1])){
				unset($error[count($error)-1]);
			}
		}else{
			$error = array();
		}
		
		return array('response'=>$response,
					 'statuscode'=>$code,	
					 'statusMessage'=>$statusMessage,
					 'successMessage'=> $successMessage,
					 'error'=>$error
					);
	} 

	function generate_authToken($data){
		 return (md5($data['email_id'].time()));
    }

    function updaterecord($table_name,$where_condition,$data)
    {
    	$CI =& get_instance();
    	$CI->db->where($where_condition)->update($table_name, $data);
    	//echo $CI->db->last_query();exit;
    	return true;
    }

    function updaterecordpassword($table_name,$where_condition,$data)
    {
      $CI =& get_instance();
      $CI->db->where($where_condition)->update($table_name, $data);
      return $CI->db->affected_rows();
    }

    function checkValues($table_name,$where_condition)
    {
    	//pd($where_condition);
    	$CI =& get_instance();
    	$data =  $CI->db->select('*')->where($where_condition)->get($table_name)->num_rows();
    	//echo $CI->db->last_query();exit;
    	//pd($data);
    	if($data)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    function checkBelongsTo($table,$where_condition)
    {
    	$CI =& get_instance();
    	$data =  $CI->db->select('*')->where($where_condition)->get($table)->num_rows();
    	// echo $CI->db->last_query();exit;
        //pd($data);
    	if($data)
    		return false;
    	else 
    		return true;
    }

    function getLoginUserId()
    {
        $CI =& get_instance();
        if(isset($CI->input->request_headers()['Authtoken']))
            $data = $CI->db->select('*')->where('auth_token',$CI->input->request_headers()['Authtoken'])->where('status_flag',0)->get('toll_staff')->result_array();
    	if(isset($data) && !empty($data[0]))
        { 
           return $data[0];
        }
        else
        { 
            $CI->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
            return; 
        }
    }

    function getStatus($table,$where_condition)
    {
        $CI =& get_instance();
        $data =  $CI->db->select('status_flag')->where($where_condition)->get($table)->result_array();
        //echo $CI->db->last_query();exit;
        return $data[0]['status_flag'];
    }

    function getUserDetails($table,$where_condition)
    {
        $CI =& get_instance();
        $data =  $CI->db->select('*')->where($where_condition)->get($table)->result_array();
        return $data[0];
    }

    function sendPassword($message,$to,$subject)
    {
        $CI =& get_instance();
        
       // $config = Array('mailtype' => 'html',  );
        //$CI->email->initialize($config);
        $config['mailtype'] = 'html'; 
        $CI->email->initialize($config);
        $CI->email->clear(TRUE);
        $CI->email->set_newline("\r\n");
        $CI->email->from(ADMIN_EMAIL,'BookMyToll');
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        if($CI->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getNumberOfRecords($table_name,$where_condition)
    {
        $CI =& get_instance();
        $num_rows = $CI->db->select('tc_id')->where($where_condition)->get($table_name)->num_rows();
        //echo $CI->db->last_query();exit;
        return $num_rows;
    }

    function getRequireFields($table_name,$where_condition,$column)
    {
        $result = array();
        $CI =& get_instance();
        $data = $CI->db->select($column)->where($where_condition)->get($table_name)->result_array();
        if(count($data))
        {
            $result = $data[0];
        }
        return $result;
    }

//start laxmi 
function random_numbers($digits) {
    $min = pow(10, $digits - 1);
    $max = pow(10, $digits) - 1;
    return mt_rand($min, $max);
}
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = @strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function send_bmtmail($subject,$to,$msg){
    $CI =& get_instance();

 $config = Array('mailtype' => 'html',
                          );

$CI->email->initialize($config);
$CI->email->clear(TRUE);
$CI->email->set_newline("\r\n");
$CI->email->from(SITE_EMAIL,'BookMyToll');
$CI->email->to($to);
//$CI->email->to('ramesha@tayatech.com');
$CI->email->subject($subject);

$CI->email->message($msg);
$CI->email->send();
return true;
}
function is_email($login)
       {
    
	//If the username input string is an e-mail, return true
	if(filter_var($login, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
       // echo $login; exit;
       }
 function getWebLoginUserId()
    {
     
     $CI =& get_instance();
     //echo "ss=".$CI->input->request_headers()['Authtoken'];
     if(!empty($CI->input->request_headers()['Authtoken']))
        $data = $CI->db->select('*')->where('auth_token',$CI->input->request_headers()['Authtoken'])->get('user_register')->result_array();
     //echo $CI->db->last_query();
     //pd($data);
     if(!empty($data[0])){ //echo "hi"; 
     return $data[0];
     }else{  //echo "hddi"; 
      $CI->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return; 
     }
     function somefun(){
          $CI =& get_instance();
        return "foo"; exit;
     }
function sendPushNotification($deviceid,$message){
     $CI =& get_instance();
    echo "ggh";exit;
$regId=array($deviceid);
$url = 'https://android.googleapis.com/gcm/send';
$fields = array(
        'registration_ids' => $regId,
        'data' => array( "title"=>"Book My Toll","message" => $message ),
    );

$headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
         curl_close($ch);
         print_r($result);exit;
//    $registatoin_ids = array($regId);
//    $message = array("price" => $message);
//
//    $result = $gcm->send_notification($registatoin_ids, $message);

    //echo $result;
}

   //  exit;
    }  
    
function pushNote($deviceid,$msg)     
  {
     $CI =& get_instance();
    //echo "in helper";exit;
$regId=array($deviceid);
$url = 'https://android.googleapis.com/gcm/send';
$fields = array(
        'registration_ids' => $regId,
        'data' => array( "title"=>"Book My Toll","message" => $msg ),
    );

$headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
         // print_r($result);exit;
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }else{
            $res=json_decode($result);
            return @$res->success; 
        }
         curl_close($ch);
  }
  function sendNotification($deviceid,$msg, $devicetype){
      $CI =& get_instance();
     // echo $msg.'-'.$devicetype;
if($deviceid && $msg){
  switch($devicetype){
    case "ios": 
     iosPushNote($deviceid,$msg);
        break; 
    case "android": 
        //echo $deviceid;
       pushNote($deviceid,$msg);     
        break; 
    }
}
      
  }
function iosPushNote($deviceToken,$message){
    $CI =& get_instance();
 /*Production:
ssl://gateway.push.apple.com:2195

Development:
ssl://gateway.sandbox.push.apple.com:2195
    */
 //$deviceToken = '693d853d86a7b05a6840faaffa9a13ec423ddfceac6b3f0ef0ce8f93abd38e0d';
     $passphrase = 'taya@123';
   //  $message = 'enjoy ramesh';

     ////////////////////////////////////////////////////////////////////////////////
  $cert = realpath('PushNotificationAppCertificateKey.pem');
     $ctx = stream_context_create();
     stream_context_set_option($ctx, 'ssl', 'local_cert', $cert);
     stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

     //xdebug_break();
     // Open a connection to the APNS server
     $fp = stream_socket_client(
          'ssl://gateway.sandbox.push.apple.com:2195', $err,
          $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

     if (!$fp)
     {
         // exit("Failed to connect: $err $errstr" . PHP_EOL);
          return $err;
     }
     //echo 'Connected to APNS' . PHP_EOL;

     // Create the payload body
     $body['aps'] = array(
          'alert' => $message,
          'sound' => 'default'
          );

     // Encode the payload as JSON
     $payload = json_encode($body);

     // Build the binary notification
     $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

     // Send it to the server
     $result = fwrite($fp, $msg, strlen($msg));

     if (!$result)
         return true;
         // echo 'Message not delivered' . PHP_EOL;
     else
         return false;
         // echo 'Message successfully delivered' . PHP_EOL;

     // Close the connection to the server
     fclose($fp); 
 }
//end laxmi