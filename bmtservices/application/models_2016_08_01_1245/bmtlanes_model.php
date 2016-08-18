<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bmtlanes_model extends CI_Model {

	
	const TABLE_NAME = "bmt_lanes";

	public function __construct(){
		parent::__construct();
	}

	public function createLanes($lane_ids)
	{
		$this->db->insert_batch(self::TABLE_NAME,$lane_ids);
	}

	public function getMappedLanesFrom($login_user_id)
	{
		$result = array();
		$query = "SELECT bmt_lanes.* FROM bmt_lanes,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND bmt_lanes.tc_id= toll_staff.tc_id AND bmt_lanes.way_type = 1";
		//echo $query; exit;
		$data = $this->db->query($query)->result_array();

		if(count($data))
		{
			$result= $data;
		}
		return $result;
	}

	public function getMappedLanesTo($login_user_id)
	{
		$result = array();
		$query = "SELECT bmt_lanes.* FROM bmt_lanes,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND bmt_lanes.tc_id= toll_staff.tc_id AND bmt_lanes.way_type = 2";
		$data = $this->db->query($query)->result_array();

		if(count($data))
		{
			$result= $data;
		}
		return $result;
	}
	public function getMappedLanesOrrFrom($login_user_id)
	{
		$result = array();
		$query = "SELECT bmt_lanes.* FROM bmt_lanes,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND bmt_lanes.tc_id= toll_staff.tc_id AND bmt_lanes.way_type = 3";
		$data = $this->db->query($query)->result_array();

		if(count($data))
		{
			$result= $data;
		}
		return $result;
	}
	public function getMappedLanesOrrTo($login_user_id)
	{
		$result = array();
		$query = "SELECT bmt_lanes.* FROM bmt_lanes,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND bmt_lanes.tc_id= toll_staff.tc_id AND bmt_lanes.way_type = 4";
		$data = $this->db->query($query)->result_array();

		if(count($data))
		{
			$result= $data;
		}
		return $result;
	}


	public function deleteOldRecords($tc_id)
	{
		$this->db->where('tc_id',$tc_id);
		$this->db->delete(self::TABLE_NAME);
	}
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */
