<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tollstaff_model extends CI_Model {

	/**
	*  TABLE NAME: setting
	*  _____________________________
	* |                             |
	* COLUMNS              ATTRIBUTES   
	* |_____________________________| 
	*  
	*  id                 INT(10) AUTO_INCREMENT 
	*  date               datetime
	*/

	const TABLE_NAME = "toll_staff";

	public function __construct(){
		parent::__construct();
	}

	public function login($data)
	{
		$result_array = array();
		$result = $this->db->select('*')->where(array('email_id'=>$data['email'],'password'=>$data['password']))->get(self::TABLE_NAME)->result_array();
		if(count($result)){
			$authtoken = generate_authToken($result[0]);
			updaterecord(self::TABLE_NAME,array('ts_id'=>$result[0]['ts_id']),array('auth_token'=>$authtoken));
			$result[0]['auth_token'] = $authtoken;
			$result_array = $result[0];
		}
		return $result_array;
	}
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */