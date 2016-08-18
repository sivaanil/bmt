<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*
	*To remove html tags and spaces
	*/
	function sanitize_input($data)
	{
		return htmlentities(addslashes(strip_tags(trim($data))));
	}

	function record_active_inactive($params)
	{

		$CI =& get_instance();

	    list($table, $field, $value, $status) = explode(".", $params);	
	    $query = $CI->db->select('status')->from($table)->where(array($field=>$value))->get()->result_array();

	    if (count($query) == 0){
	        return "0".".1";
	    } else {
	    	if($query[0]['status'] == $status){
	    		return "0".".2";
	    	}else{
	        	return "1";
	        }	
	    }

	} 

	/*
	check Autherization
	*/
	function checkAutherization()
	{
		$CI =& get_instance();
		$CI->session->set_flashdata('message','Unautharized Acess');
		redirect('user/logout');
		exit;
	}
	/*
	check status code
	*/
	function checkstatuscode($statuscode,$msg = NULL)
	{
		if($statuscode == 401 || $statuscode == 500)
		{
			$CI =& get_instance();
			if($msg != NULL){
				$CI->session->set_flashdata('message',"");
				$CI->session->set_flashdata('message',$msg);
			}
			else{
				$CI->session->set_flashdata('message','Unautharized Access');
			}
			redirect('user/logoutUnautherised');
			exit;
		}
		else
		{
			return true;
		}
	}

	function checkSession()
	{
		$CI =& get_instance();
		if($CI->router->fetch_class() != "login"){
			if($CI->session->userdata['user_data']['response']->id <= 0){
				redirect('login');
			}
		}
		
	}

	function checkSessionForTollStaff()
	{
		$CI =& get_instance();
		if($CI->router->fetch_class() != "login"){
			if($CI->session->userdata['user_data']->ts_id <= 0){
				redirect('toll');
			}
		}
		
	}

	function resizeImage($path,$folder)
	{
		$ci =& get_instance();
		$ci->load->library('image_lib');
		//echo base_url();exit;
		$config['image_library']  = 'gd2';
		$config['source_image']   = $path;
		$config['new_image']      = 'uploads/'.$folder;
		$config['width']          = 150;
		$config['height']         = 150;
		$ci->image_lib->initialize($config);
		//echo $config['new_image'];exit;

		if ( ! $ci->image_lib->resize())
		{
		   echo $ci->image_lib->display_errors();
		}
		else
		{
			$imgname = strrpos($path,'/');
			$path    = base_url().'uploads/'.$folder.'/'.substr($path, $imgname+1);
			return $path;
		}
	}
	// ------------------------------------------------------------------------	
	/**
	 * [check_user_authorization description] [Checking Authentication for user i.e Two users login at a time one should logout.]
	 * @return [type]      					   [String]
	 * 
	 */	
function check_user_authorization($status=NULL,$meth=NULL)
{
	
	$CI =& get_instance();
	if(($CI->session->userdata['user_data']->id) == '')
	{//echo "string";exit;
		$CI->session->set_flashdata('msg','Unauthorized process, Please Login.');
		redirect('user/logout');
		exit;
	}	
	else if(($status == 401) || ($status == 400))
	{
		if($meth == "ajax" )
		{ //echo "1";exit;
			return "fail_authorization";
			exit;
		}
		else
		{ //echo "2";exit;
			$CI->session->set_flashdata('msg','Someone else logged in with the Credentials. Please check and try again.');
			redirect('user/logout');
			exit;
		}

	}
	else if($status == 404)
	{//echo "fdf";exit;
		$CI->session->set_flashdata('msg','Oops Server is down. We will look into the problem. Sorry for the Inconvenience.');
		redirect('user/logout');
		exit;
	}
	
}
// ------------------------------------------------------------------------	
	/**
	 * [check_toll_authorization description] [Checking toll authorization i.e Two users login at a time one should logout.]
	 * @return [type]      					  [String]
	 * 
	 */	
function check_toll_authorization($status=NULL,$meth=NULL)
{
	$CI =& get_instance();
	if(($CI->session->userdata['user_data']->id) == '')
	{
		$CI->session->set_flashdata('msg','Unauthorized process, Please Login.');
		redirect('login/logout');
		exit;
	}	
	else if(($status == 401) || ($status == 400))
	{
		if($meth == "ajax" )
		{
			return "fail_authorization";
			exit;
		}
		else
		{
			$CI->session->set_flashdata('msg','Someone else logged in with the Credentials. Please check and try again.');
			redirect('login/logout');
			exit;
		}

	}
	else if($status == 404)
	{
		$CI->session->set_flashdata('msg','Oops Server is down. We will look into the problem. Sorry for the Inconvenience.');
		redirect('login/logout');
		exit;
	}
}
function pd($data)
	{
		echo "<pre>";print_r($data);exit;
	}

	function chackStatus($response)
	{
		$CI =& get_instance();
		if($response->statuscode == 401)
		{
			$CI->session->set_flashdata('msg',$response->error[0]);
			redirect('toll/logout');
		}
	}

function modeltest()     
{
  echo "in helper";
}
//payment method functions

	function encrypt($plainText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}

	function decrypt($encryptedText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	//*********** Padding Function *********************

	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0)
		    {
				$binString=$packedString;
		    } 
        	    
		    else 
		    {
				$binString.=$packedString;
		    } 
        	    
		    $count+=2; 
        	} 
  	        return $binString; 
    	  }
?>