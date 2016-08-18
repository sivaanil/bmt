<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bankdetails_model extends CI_Model {

	

	const TABLE_NAME = "bmt_bank_details";

	public function __construct(){
		parent::__construct();
	}

	public function createBankDetails($data)
	{
		$this->db->insert(self::TABLE_NAME, $data);
		//echo $this->db->last_query();exit;
		return $this->db->insert_id();
	}
	public function getSpecificSemiadmindetails($user_id)
	{
		$data = array();
		$query = $this->db->select('*')->where('ts_id',$user_id)->get(self::TABLE_NAME)->result_array();
		if(count($query))
		{
			$data = $query[0];
		}
		return $data;
	}

	public function getBankDetails($user_id)
	{
		$data = array();
		$query = "SELECT * FROM toll_center WHERE tc_id IN (SELECT tc_id FROM bmt_bank_details WHERE assigned_id = $user_id)";
		$result = $this->db->query($query)->result_array();
		if(count($result))
		{
			$data = $result;
		}
		return $data;
	}

	public function getBankTollNames($user_id,$tc_location)
	{
		$data = array();
		$query = "SELECT tc_name FROM toll_center WHERE tc_id NOT IN (SELECT tc_id FROM bmt_bank_details WHERE assigned_id = $user_id) AND assigned_id = $user_id AND tc_location = '$tc_location'";
		$result = $this->db->query($query)->result_array();
		if(count($result))
		{
			$data = $result;
		}
		return $data;
	}

	public function getSpecificBankDetails($tc_id)
	{
		$data = array();
		$query = $this->db->select("bmt_bank_details.*,toll_center.tc_name,toll_center.tc_location")->join('bmt_bank_details','bmt_bank_details.tc_id=toll_center.tc_id')->where('bmt_bank_details.tc_id',$tc_id)->get('toll_center')->result_array();
		//echo $this->db->last_query();exit;
		if(count($query))
			$data = $query[0];
		return $data;
	}

	public function accountTypes()
	{
		$data= array();
		$query = $this->db->select('*')->get('bank_account_types')->result_array();
		if(count($query))
			$data = $query;
		return $data;
	}
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */