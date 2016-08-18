<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tollstaff_model extends CI_Model {

	

	const TABLE_NAME = "toll_staff";

	public function __construct(){
		parent::__construct();
	}

	public function login($data)
	{
		$result_array = array();
		$result = $this->db->select('*')->where(array('email_id'=>$data['email'],'password'=>$data['password']))->get(self::TABLE_NAME)->result_array();
		if(count($result)){
			if($result[0]['roll_id'] != 1)
			{
				$table = 'toll_center';
				$where_condition = array('tc_id'=>$result[0]['tc_id']);
				$toll_status =  getStatus($table,$where_condition);
				$login_user_status = $result[0]['status_flag'];
				if($toll_status == 1 || $login_user_status ==1)
				{
					$result_array = array('status'=>401,'auth_token'=>'');
					return $result_array;
				}
			}
			$authtoken = generate_authToken($result[0]);
			updaterecord(self::TABLE_NAME,array('ts_id'=>$result[0]['ts_id']),array('auth_token'=>$authtoken));
			$result[0]['auth_token'] = $authtoken;
			$result_array = $result[0];
		}
		return $result_array;
	}

	public function createSemiAdmin($data)
	{
		$this->db->insert(self::TABLE_NAME, $data);
		return $this->db->insert_id();
	}

	public function listSemiAdmins($user_id)
	{
		$data = array();
		$query = "SELECT toll_staff.*,toll_center.tc_name,toll_center.tc_location  FROM toll_staff,toll_center  WHERE toll_staff.assigned_id IN (SELECT toll_staff.ts_id FROM toll_staff WHERE toll_staff.ts_id = $user_id) ANd toll_staff.tc_id = toll_center.tc_id AND toll_staff.created_date IN (SELECT MAX(created_date) FROM toll_staff where roll_id = 3 GROUP BY tc_id)";
		$result = $this->db->query($query)->result_array();
		//echo $this->db->last_query();exit;
		if(count($result))
		{
			$data = $result;
		}
		return $data;
	}

	public function listTollOperator($login_user_id)
	{
		$data = array();
		$result = $this->db->select('*')->where('assigned_id',$login_user_id)->get(self::TABLE_NAME)->result_array();
		if(count($result))
			$data = $result;
		return $data;
	}

	public function getSpecificSemiadmindetails($user_id)
	{
		$data = array();
		$query = "SELECT toll_staff.*,toll_center.tc_name,toll_center.tc_location  FROM toll_staff,toll_center  WHERE toll_staff.ts_id = $user_id ANd toll_staff.tc_id = toll_center.tc_id";
		//$query = $this->db->select('*')->where('ts_id',$user_id)->get(self::TABLE_NAME)->result_array();
		$result = $this->db->query($query)->result_array();
		if(count($result))
		{
			$data = $result[0];
		}
		return $data;
	}
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */