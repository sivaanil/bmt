<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tollcharges_model extends CI_Model {

	
	const TABLE_NAME = "toll_charge";

	public function __construct(){
		parent::__construct();
	}

	public function addTollCharges($data)
	{		
		$this->db->insert(self::TABLE_NAME, $data);
		return $this->db->insert_id();
	}

	public function getTollChargesDetails($user_id)
	{
		$data = array();
		$result = $this->db->select('b.tc_id,b.tc_name,b.tc_location')->where('a.assigned_id',$user_id)->join('toll_center as b','b.tc_id=a.tc_id')->group_by('b.tc_name')->get(self::TABLE_NAME.' as a')->result_array();
		if(count($result))
			$data = $result;
		return $data;
	}

	public function listAllBankRelatedTolls($user_id)
	{
		$data = array();
		$result = $this->db->select('a.tc_id,a.tc_name,a.tc_location')->where('b.assigned_id',$user_id)->join('toll_charge as b','b.tc_id = a.tc_id')->group_by('a.tc_location')->get('toll_center as a')->result_array();
		echo $this->db->last_query();exit;
		if(count($result))
			$data = $result;
		return $data;
	}

	public function getSpecificTollCharges($tc_id,$vehical_type_id)
	{
		$data = array();
		$result = $this->db->select('*')->where(array('tc_id'=>$tc_id,'type_id'=>$vehical_type_id))->get(self::TABLE_NAME)->result_array();
		if(count($result))
			$data= $result[0];
		return $data;
	}
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */