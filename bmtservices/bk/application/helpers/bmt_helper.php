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
	
	function responseObject($code = 400,$errors = "",$response="",$statusMessage="",$successMessage=""){
/*
		print_r($response);
		exit;*/

		$CI =& get_instance();
		$errors = trim($errors);

		if(!empty($errors)){
			$errors = explode("</p>",trim($errors));
			if(empty($errors[count($errors)-1])){
				unset($errors[count($errors)-1]);
			}
		}	
		return array('response'=>$response,
					 'statuscode'=>$code,	
					 'statusMessage'=>$statusMessage,
					 'successMessage'=> $successMessage,
					 'errors'=>$errors
					);
	} 

	function generate_authToken($data){
		 return (md5($data['email_id'].time()));
    }

    function updaterecord($table_name,$where_condition,$data)
    {
    	$CI =& get_instance();
    	$CI->db->where($where_condition)->update($table_name, $data);
    	return $CI->db->affected_rows();
    }
    
//start laxmi 
function random_numbers($digits) {
    $min = pow(10, $digits - 1);
    $max = pow(10, $digits) - 1;
    return mt_rand($min, $max);
}
function send_bmtmail($sugject,$to,$msg){
    $CI =& get_instance();
$config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'abcdabcd987456321@gmail.com', // change it to yours
          'smtp_pass' => 'taya@123', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE,
          );

$CI->email->initialize($config);
$CI->email->clear(TRUE);
$CI->email->set_newline("\r\n");
$CI->email->from(ADMIN_EMAIL,'BookMyTool');
$CI->email->to($to);
$CI->email->subject($sugject);

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
     $data = $CI->db->select('*')->where('auth_token',$CI->input->request_headers()['Authtoken'])->get('user_register')->result_array();
     //echo $CI->db->last_query();
     //pd($data);
   
     if(!empty($data[0])){ //echo "hi"; 
     return $data[0];
     }else{  //echo "hddi"; 
      $CI->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return; 
     }
   //  exit;
    }      
//end laxmi