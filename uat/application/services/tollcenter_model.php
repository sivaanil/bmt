<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tollcenter_model extends CI_Model {

	
	const TABLE_NAME = "toll_center";

	public function __construct(){
		parent::__construct();
	}

	public function addTolllocation($data)
	{
		if($_POST['lat']==''){$lat=0.0;}else{$lat=$_POST['lat'];}
		if($_POST['lng']==''){$lng=0.0;}else{$lng=$_POST['lng'];}

		$tc_data = array('assigned_id'=>$data['assigned_id'],'tc_name'=>$data['tc_name'],'tc_location'=>$data['tc_location'],'from_way_no_of_lanes'=>$data['from_way_no_of_lanes'],
			'from_way_no_of_bmt_lanes'=>$data['from_way_no_of_bmt_lanes'],'to_way_no_of_lanes'=>$data['to_way_no_of_lanes'],'to_way_no_of_bmt_lanes'=>$data['to_way_no_of_bmt_lanes'],
			'tc_created_date'=>$data['tc_created_date'],'from_way_location'=>$data['from_way_location'],'to_way_location'=>$data['to_way_location'],'image_url'=>$data['image_url'],
			'lat'=>$lat,'lng'=>$lng,'address'=>$_POST['address']);
		$this->db->insert(self::TABLE_NAME, $tc_data);
		//echo $this->db->last_query();exit;
		$tc_id = $this->db->insert_id();
		if(isset($data['from_uuid']))
		{
			$becon_one = array('tc_id'=>$tc_id,'uuid'=>$data['from_uuid'],'major_id'=>$data['from_major_id'],'minor_id'=>$data['from_minor_id']);
			$this->db->insert('beacons', $becon_one);
			$table_name = 'toll_center';
			$where_condition =array('tc_id'=>$tc_id);
			$becon_data_one = array('from_way_beacon_id'=>$this->db->insert_id());
			//echo "<pre>";print_r($becon_data_one);
			updaterecord($table_name,$where_condition,$becon_data_one);
		}
		if(isset($data['to_uuid']))
		{
			$becon_two = array('tc_id'=>$tc_id,'uuid'=>$data['to_uuid'],'major_id'=>$data['to_major_id'],'minor_id'=>$data['to_minor_id']);
			$this->db->insert('beacons', $becon_two);
			$table_name = 'toll_center';
			$where_condition =array('tc_id'=>$tc_id);
			$beacon_data_two = array('to_way_beacon_id'=>$this->db->insert_id());
			//echo "<pre>";print_r($beacon_data_two);
			updaterecord($table_name,$where_condition,$beacon_data_two);
		}
		return $tc_id;
	}

	public function listTollCenters($superadmin_id)
	{
		$result = array();
		$data = $this->db->select('tc_id,tc_name,tc_location,status_flag,image_url')->where(array('assigned_id'=>$superadmin_id))->get(self::TABLE_NAME)->result_array();
		if(count($data))
		{
			$result = $data;
			return $result;
		}
		else
		{
			return $result;
		}
	}
	public function getSpecificTollDetails($toll_id)
	{
		$data = array();
		$data['becon_details'] = array();
		$query = $this->db->select('*')->where('tc_id',$toll_id)->get(self::TABLE_NAME)->result_array();
		if(count($query))
		{
			$becon_data = array();
			$becon_data = $this->db->select('*')->where('tc_id',$toll_id)->get('beacons')->result_array();
			$query['beacon_data'] = $becon_data;
			$data = $query[0];
			$becon_details = $this->db->where('tc_id',$query[0]['tc_id'])->get('beacons')->result_array();
			if(count($becon_details))
			{
				$from_becon_id = $data['from_way_beacon_id'];
				$to_becon_id = $data['to_way_beacon_id'];
				foreach ($becon_details as $key => $value) {
					if($from_becon_id == $value['beacon_id']){
						$data['becon_details']['from_beacon'] = $value;
					}
					else
					{
						$data['becon_details']['to_beacon'] = $value;
					}
				}
			}
			else
				$data['becon_details'] = array();
		}
		return $data;
	}

	public function TollLocations($login_user_id)
	{
		$data = array();
		/*$command = "SELECT tc_name  FROM toll_center  WHERE assigned_id = login_user_id AND tc_id NOT IN (SELECT tc_id FROM toll_staff where assigned_id = login_user_id) group by tc_location";
		$query = $this->db->query($command)->result_array();*/
		$query = $this->db->select('tc_id,tc_location')->where('assigned_id',$login_user_id)->group_by('tc_location')->get(self::TABLE_NAME)->result_array();
		//pd($query);
		if(count($query))
		{
			$data = $query;
		}
		return $data;
	}

	public function tollName($tc_location,$user_id)
	{
		$data = array();
		$query = $this->db->select('tc_name')->where(array('assigned_id'=>$user_id,'tc_id'=>$tc_location,'status_flag'=>0))->get(self::TABLE_NAME)->result_array();
		//echo $this->db->last_query();exit;
		if(count($query))
		{
			$data = $query;
		}
		return $data;
	}
public function checksemi($location_id){
	$query = $this->db->select('*')->where(array('tc_id'=>$location_id,'roll_id'=>3,'status_flag'=>0))->get('toll_staff')->result_array();
		//echo $this->db->last_query();exit;
	if(count($query))
		{
			return false;
		}else{
           return true;
		}

}
	public function tollLocationId($tc_name,$user_id)
	{
		$data = array();
		$query = $this->db->select('tc_id')->where(array('assigned_id'=>$user_id,'tc_name'=>$tc_name))->get(self::TABLE_NAME)->result_array();
		if(count($query))
		{
			$data = $query[0];
		}
		return $data;
	}

	public function getTcIdByUserid($user_id)
	{

		$query = "SELECT toll_center.status_flag  FROM toll_center,toll_staff  WHERE toll_staff.ts_id = $user_id ANd toll_staff.tc_id = toll_center.tc_id";
		$data = $this->db->query($query)->result_array();
		//echo $this->db->last_query();exit;
		return $data[0]['status_flag'];
	}

	public function getVehicalTypes()
	{
		$data = array();
		$query = $this->db->select('*')->get('vehicle_type')->result_array();
		if(count($query))
			$data = $query;
		return $data;
	}

	public function superAdminView($user_id)
	{
		$result = array();
		$query = "SELECT toll_center.tc_name,toll_center.tc_id,toll_center.tc_location,toll_staff.first_name,toll_staff.last_name,toll_staff.email_id,toll_staff.mobile_no,bmt_bank_details.ac_number,bmt_bank_details.bank_name,bmt_bank_details.bank_address,bmt_bank_details.ac_name FROM toll_center,toll_staff,bmt_bank_details WHERE toll_center.assigned_id=$user_id  AND (toll_staff.roll_id = 3 OR toll_staff.roll_id = 2) AND toll_center.tc_id= toll_staff.tc_id AND bmt_bank_details.tc_id= toll_center.tc_id";
		$data = $this->db->query($query)->result_array();
		//echo $this->db->last_query();exit;
		if(count($data))
			$result = $data;
		//pd($result);
		return $result;
	}

	public function getLoginUserTollName($login_user_id)
	{
		$result = array();
		$query = "SELECT toll_center.tc_name,toll_center.tc_id,toll_center.tc_location FROM toll_center,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND toll_center.tc_id= toll_staff.tc_id";
		$data = $this->db->query($query)->result_array();
		if(count($data))
		{
			$result = $data[0];
		}
		return $result;
	}

	public function getLaneDetails($login_user_id)
	{
		$result = array();
		$query = "SELECT toll_center.from_way_beacon_id,toll_center.to_way_beacon_id,toll_center.from_way_location,toll_center.to_way_location,toll_center.from_way_no_of_bmt_lanes,toll_center.to_way_no_of_bmt_lanes,toll_center.from_way_no_of_lanes,toll_center.to_way_no_of_lanes FROM toll_center,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND toll_center.tc_id= toll_staff.tc_id";
		$data = $this->db->query($query)->result_array();
		if(count($data))
		{
			$result['beacon_details'] = $data[0];
			$from_way_lane_id = '';
			$to_way_lane_id = '';
			$from_way_lane_name = array();
			$to_way_lane_name   = array();
			$from_way_lane_id = $data[0]['from_way_beacon_id'];
			$to_way_lane_id = $data[0]['to_way_beacon_id'];
			
			if($from_way_lane_id != '')
			{
				$from_lane_query = "SELECT beacons.uuid from beacons,toll_center where beacons.beacon_id=$from_way_lane_id and beacons.beacon_id=toll_center.from_way_beacon_id";
				$from_way_lane_details = $this->db->query($from_lane_query)->result_array();
			}
			
			if($to_way_lane_id != '')
			{
				$to_lane_query = "SELECT beacons.uuid from beacons,toll_center where beacons.beacon_id=$to_way_lane_id and beacons.beacon_id=toll_center.to_way_beacon_id";
				$to_way_lane_details = $this->db->query($to_lane_query)->result_array();
			}
			
			if(!empty($from_way_lane_details))
			{
				$result['from_way_lane_name'] = $from_way_lane_details[0];
			}
			if(!empty($to_way_lane_details))
			{
				$result['to_way_lane_name'] = $to_way_lane_details[0];
			}
		}
		return $result;
	}

	public function getTollNamesForCharge($login_user_id,$tc_location)
	{
		$result = array();
		
		//Below query is for get the vehical type which is not charged
		$queryfor_vehical_type = "select type_id from vehicle_type where type_id NOT IN (select type_id from toll_charge where tc_id in(SELECT `tc_id` FROM `toll_center` WHERE `tc_location`='$tc_location'))";
		$data = $this->db->query($queryfor_vehical_type)->result_array();
		if(empty($data))
			return $result;
		$query = "SELECT tc_name FROM toll_center WHERE tc_location='$tc_location' AND tc_id NOT IN (SELECT toll_charge.tc_id from toll_charge,toll_center WHERE toll_center.tc_id = toll_charge.tc_id AND toll_center.tc_location = '$tc_location' AND toll_charge.type_id NOT IN (SELECT type_id from vehicle_type))";
		$data = $this->db->query($query)->result_array();
		echo $this->db->last_query();
		pd($data);
	}

	public function tollNameForCharges($tc_location,$user_id)
	{
		$data = array();
		$query = $this->db->select('tc_name')->where(array('assigned_id'=>$user_id,'tc_location'=>$tc_location))->get(self::TABLE_NAME)->result_array();
		if(count($query))
		{
			$data = $query;
		}
		return $data;
	}
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */