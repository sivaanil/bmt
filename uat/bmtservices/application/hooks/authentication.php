<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Authentication
{
	private $CI;

	public function __construct()
	{
		$this->CI =&get_instance();
		header('Access-Control-Allow-Origin: *');
   	 	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		$this->CI->load->model('loghistory_model');
		$this->CI->load->model('business_model');
	}



	public function index()
	{  
		$data = 0;
		if($this->CI->router->fetch_class() != "mipapis" && $this->CI->router->fetch_class() != "welcome"){ 

			$headerexists = in_array("Authtoken",array_keys($this->CI->input->request_headers()));
			
			if($headerexists){

				$dataobj = $this->CI->loghistory_model->check_record($this->CI->input->request_headers()['Authtoken']);
				
					
				if(count($dataobj)){

					
					if($dataobj[0]['role_id'] > 0)
					{
						if($this->CI->business_model->checkBusinesstatus($dataobj[0]['business_id']))
							return true;
						else
							$this->CI->rest->response(responseObject(UNAUTHORIZED_CODE,"Business is blocked, please contact admin","","",NULL),UNAUTHORIZED_CODE);
					}
					
					list($authtoken, $userdetails, $code) = explode('|',$this->CI->input->request_headers()['Authtoken']);	
					$userdata = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $dataobj[0]['hash'], base64_decode($userdetails), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND));

					list($userid , $useremail, $roleid, $departmentid) = explode('|', $userdata);

					$loggedinuserid = $this->CI->rest->request->method == "post" ? $this->CI->rest->post("userID")     :  $dataobj[0]['userid'];
					$userroleid 	= $this->CI->rest->request->method == "post" ? $this->CI->rest->post("roleID")     :  $dataobj[0]['role_id'];
					$businessid 	= $this->CI->rest->request->method == "post" ? $this->CI->rest->post("businessID") :  $dataobj[0]['business_id'];
					$userdepid 		= $dataobj[0]['department_id'];

					if(count($dataobj) == 1){ 
						if($userid == $loggedinuserid && $useremail == $dataobj[0]['email'] && trim($roleid) == $userroleid && (int)trim($departmentid) == $userdepid){
							$data = 1;
						}	
					}
				}	
			}
			if($data == 0)
			{	
				$this->CI->rest->response(responseObject(UNAUTHORIZED_CODE,AUTH_TOKEN1,"","",NULL),UNAUTHORIZED_CODE);	
				return;						
			}
		}
		return true;
	}
}