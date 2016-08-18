<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tollcenter_model extends CI_Model {

    const TABLE_NAME = "toll_center";

    public function __construct() {
        parent::__construct();
    }

    public function addTolllocation($data) {
        $tollType = $data['toll_type'];
        $tollTypeId = '';
        if ($tollType == 'nh') {
            $tollTypeId = 1;
        } else {
            $tollTypeId = 2;
        }
        if ($tollType == 'orr') {
            $cityId = $data['city_id'];
        }
        //	echo '<pre>';
        //print_r($data);
        //exit;
        $tc_data = array('assigned_id' => $data['assigned_id'],'city_id'=>$cityId, 'tc_name' => $data['tc_name'], 'tc_location' => $data['tc_location'], 'from_way_no_of_lanes' => $data['from_way_no_of_lanes'],
            'from_way_no_of_bmt_lanes' => $data['from_way_no_of_bmt_lanes'], 'to_way_no_of_lanes' => $data['to_way_no_of_lanes'], 'to_way_no_of_bmt_lanes' => $data['to_way_no_of_bmt_lanes'],
            'tc_created_date' => $data['tc_created_date'], 'from_way_location' => $data['from_way_location'], 'to_way_location' => $data['to_way_location'], 'orr_from_way_location' => $data['orr_from_way_location'],
            'orr_to_way_location' => $data['orr_to_way_location'], 'image_url' => $data['image_url'], 'lat' => $_POST['latone'], 'lng' => $_POST['lngone'], 'address' => $_POST['address'], 'to_lat' => $_POST['lattwo'], 'to_lag' => $_POST['lngtwo'], 'toll_type_id' => $tollTypeId,
            'orr_from_way_no_of_lanes' => $data['orr_from_way_no_of_lanes'], 'orr_from_way_no_of_bmt_lanes' => $data['orr_from_way_no_of_bmt_lanes'],
            'orr_to_way_no_of_lanes' => $data['orr_to_way_no_of_lanes'], 'orr_to_way_no_of_bmt_lanes' => $data['orr_to_way_no_of_bmt_lanes']);

        $this->db->insert(self::TABLE_NAME, $tc_data);

        $tc_id = $this->db->insert_id();
        if (isset($data['from_uuid'])) {
            $becon_one = array('tc_id' => $tc_id, 'uuid' => $data['from_uuid'], 'major_id' => $data['from_major_id'], 'minor_id' => $data['from_minor_id'], 'entry_type' => strtoupper($data['nh_type1']));
            $this->db->insert('beacons', $becon_one);
            $table_name = 'toll_center';
            $where_condition = array('tc_id' => $tc_id);
            $becon_data_one = array('from_way_beacon_id' => $this->db->insert_id());
            //echo "<pre>";print_r($becon_data_one);
            updaterecord($table_name, $where_condition, $becon_data_one);
        }
        if (isset($data['to_uuid'])) {
            $becon_two = array('tc_id' => $tc_id, 'uuid' => $data['to_uuid'], 'major_id' => $data['to_major_id'], 'minor_id' => $data['to_minor_id'], 'entry_type' => strtoupper($data['nh_type2']));
            $this->db->insert('beacons', $becon_two);
            $table_name = 'toll_center';
            $where_condition = array('tc_id' => $tc_id);
            $beacon_data_two = array('to_way_beacon_id' => $this->db->insert_id());
            //echo "<pre>";print_r($beacon_data_two);
            updaterecord($table_name, $where_condition, $beacon_data_two);
        }
        if (!empty($data['orr_from_uuid']) && isset($data['orr_from_uuid'])) {
            $becon_three = array('tc_id' => $tc_id, 'uuid' => $data['orr_from_uuid'], 'major_id' => $data['orr_from_major_id'], 'minor_id' => $data['orr_from_minor_id'], 'entry_type' => strtoupper($data['orr_type1']));
            $this->db->insert('beacons', $becon_three);
             $table_name = 'toll_center';
            $where_condition = array('tc_id' => $tc_id);
            $beacon_data_three = array('orr_from_way_beacon_id' => $this->db->insert_id());
            //echo "<pre>";print_r($beacon_data_two);
            updaterecord($table_name, $where_condition, $beacon_data_three);
        }
        if (!empty($data['orr1_to_uuid']) && isset($data['orr1_to_uuid'])) {
            $becon_four = array('tc_id' => $tc_id, 'uuid' => $data['orr1_to_uuid'], 'major_id' => $data['orr1_to_major_id'], 'minor_id' => $data['orr1_to_minor_id'], 'entry_type' => strtoupper($data['orr_type2']));
            $this->db->insert('beacons', $becon_four);
             $table_name = 'toll_center';
            $where_condition = array('tc_id' => $tc_id);
            $beacon_data_four = array('orr_to_way_beacon_id' => $this->db->insert_id());
            //echo "<pre>";print_r($beacon_data_two);
            updaterecord($table_name, $where_condition, $beacon_data_four);
        }
        $from_way_coordinates = array('tc_id' => $tc_id, 'lat' => $_POST['latone'], 'lng' => $_POST['lngone'], 'way' => 1);
        $this->db->insert('latlng', $from_way_coordinates);
        $to_way_coordinates = array('tc_id' => $tc_id, 'lat' => $_POST['lattwo'], 'lng' => $_POST['lngtwo'], 'way' => 2);
        $this->db->insert('latlng', $to_way_coordinates);
        return $tc_id;
    }

    public function listTollCenters($superadmin_id) {
        $result = array();
        $data = $this->db->select('tc_id,tc_name,tc_location,status_flag,image_url')->where(array('assigned_id' => $superadmin_id))->get(self::TABLE_NAME)->result_array();
        //  echo $this->db->last_query();exit;
        if (count($data)) {
            $result = $data;
            return $result;
        } else {
            return $result;
        }
    }

    public function getListTollOfCenters($superadmin_id) {
        $result = array();
        $query = "select toll_staff.tc_id from toll_staff WHERE toll_staff.ts_id = $superadmin_id";
        $data = $this->db->query($query)->result_array();

        $query1 = "SELECT toll_center.tc_id,toll_center.tc_name,toll_center.tc_location,toll_center.toll_type_id,city.city from toll_center"
                 . " left join city on toll_center.city_id = city.id"
                 . " where toll_center.tc_id in (" . $data[0]['tc_id'] . ")"
                 . " order by city.city,tc_location Asc";
//        $query1 = "SELECT toll_center.tc_id,toll_center.tc_name,toll_center.tc_location,toll_center.toll_type_id FROM toll_center where toll_center.tc_id in (" . $data[0]['tc_id'] . ")";
        $data1 = $this->db->query($query1)->result_array();
//          echo $this->db->last_query();exit;
        if (count($data1)) {
            $result = $data1;
            return $result;
        } else {
            return $result;
        }
    }

    public function getSpecificTollDetails($toll_id) {
        $data = array();
        $data['becon_details'] = array();
        $query = $this->db->select('*')->where('tc_id', $toll_id)->get(self::TABLE_NAME)->result_array();
        // echo $this->db->last_query(); exit;
        if (count($query)) {
            $becon_data = array();
            $becon_data = $this->db->select('*')->where('tc_id', $toll_id)->get('beacons')->result_array();
            $query['beacon_data'] = $becon_data;
            $data = $query[0];
            $becon_details = $this->db->where('tc_id', $query[0]['tc_id'])->get('beacons')->result_array();
            if (count($becon_details)) {
                $from_becon_id = $data['from_way_beacon_id'];
                $to_becon_id = $data['to_way_beacon_id'];
                foreach ($becon_details as $key => $value) {
                    if ($from_becon_id == $value['beacon_id']) {
                        $data['becon_details']['from_beacon'] = $value;
                    } elseif ($to_becon_id == $value['beacon_id']) {
                        $data['becon_details']['to_beacon'] = $value;
                    } else {
                        $data['becon_details']['orr_becon_details'][] = $value;
                    }
                }
            } else
                $data['becon_details'] = array();
        }
        $city = $this->db->query('select * from toll_center tc join city c on tc.city_id = c.id where tc.tc_id = ' . ($toll_id))->result_array();
        $data['city'] = $city;

        return $data;
    }

    public function TollLocations($login_user_id) {
        $data = array();
        /* $command = "SELECT tc_name  FROM toll_center  WHERE assigned_id = login_user_id AND tc_id NOT IN (SELECT tc_id FROM toll_staff where assigned_id = login_user_id) group by tc_location";
          $query = $this->db->query($command)->result_array(); */
        $query = $this->db->select('tc_id,tc_location')->where('assigned_id', $login_user_id)->group_by('tc_location')->get(self::TABLE_NAME)->result_array();
        //pd($query);
        if (count($query)) {
            $data = $query;
        }
        return $data;
    }

    public function tollName($tc_location, $user_id) {
        $data = array();
        $query = $this->db->select('tc_name')->where(array('assigned_id' => $user_id, 'tc_id' => $tc_location, 'status_flag' => 0))->get(self::TABLE_NAME)->result_array();
        //echo $this->db->last_query();exit;
        if (count($query)) {
            $data = $query;
        }
        return $data;
    }

    public function checksemi($location_id, $ts_id = '') {
//        $query = $this->db->select('*')->where(array('tc_id' => $location_id, 'roll_id' => 3, 'status_flag' => 0))->get('toll_staff')->result_array();
//        echo $this->db->last_query();exit;

        if ($ts_id != '')
            $query = "SELECT * FROM (`toll_staff`) WHERE (FIND_IN_SET($location_id,`tc_id`)) AND ts_id != $ts_id AND `roll_id` =  3 AND `status_flag` =  0";
        else
            $query = "SELECT * FROM (`toll_staff`) WHERE (FIND_IN_SET($location_id,`tc_id`)) AND `roll_id` =  3 AND `status_flag` =  0";
        $data = $this->db->query($query)->result_array();
//        echo $this->db->last_query();//exit;
//        echo "<pre>";print_r($data);echo "</pre>";exit;
        if (count($data)) {
            return false;
        } else {
            return true;
        }
    }

    public function tollLocationId($tc_name, $user_id) {
        $data = array();
        $query = $this->db->select('tc_id')->where(array('assigned_id' => $user_id, 'tc_name' => $tc_name))->get(self::TABLE_NAME)->result_array();
        if (count($query)) {
            $data = $query[0];
        }
        return $data;
    }

    public function getTcIdByUserid($user_id) {

        $query = "SELECT toll_center.status_flag  FROM toll_center,toll_staff  WHERE toll_staff.ts_id = $user_id ANd toll_staff.tc_id = toll_center.tc_id";
        $data = $this->db->query($query)->result_array();
        //echo $this->db->last_query();exit;
        return $data[0]['status_flag'];
    }

    public function getTcIdByUseridNew($user_id, $tc_id) {

        $tc_ids = explode(',', $tc_id);
        $return['status'] = 1;
        $return['TollCenters'] = '';
        foreach ($tc_ids as $key => $value) {
            $query = "SELECT * FROM (`toll_center`) WHERE tc_id = $value";
            $data = $this->db->query($query)->result_array();
//            echo "<pre>";print_r($data);echo "</pre>";exit;
            if ($data[0]['status_flag'] == 0) {
                $return['TollCenters'] .= $data[0]['tc_name'] . ' - ' . $data[0]['tc_location'] . ", ";
                $return['status'] = 0;
            }
        }
        $return['TollCenters'] = trim($return['TollCenters'], ', ');
//        echo "<pre>";print_r($return);echo "</pre>";exit;
        return $return;
    }

    public function getTollDataById($tc_id) {
        $query = "SELECT * FROM (`toll_center`) WHERE tc_id = $tc_id";
        $data = $this->db->query($query)->result_array();
        return $data;
    }

    public function getVehicalTypes() {
        $data = array();
        $query = $this->db->select('*')->get('vehicle_type')->result_array();
        if (count($query))
            $data = $query;
        return $data;
    }

    public function superAdminView($user_id) {
        $result = array();
        $query = "SELECT toll_center.tc_name,toll_center.tc_id,toll_center.tc_location,toll_staff.first_name,toll_staff.last_name,toll_staff.email_id,toll_staff.mobile_no,bmt_bank_details.ac_number,bmt_bank_details.bank_name,bmt_bank_details.bank_address,bmt_bank_details.ac_name FROM toll_center,toll_staff,bmt_bank_details WHERE toll_center.assigned_id=$user_id  AND (toll_staff.roll_id = 3 OR toll_staff.roll_id = 2) AND toll_center.tc_id= toll_staff.tc_id AND bmt_bank_details.tc_id= toll_center.tc_id";
        $data = $this->db->query($query)->result_array();
        //echo $this->db->last_query();exit;
        if (count($data))
            $result = $data;
        //pd($result);
        return $result;
    }

    public function getLoginUserTollName($login_user_id, $tc_id = '') {
        $result = array();
        if ($tc_id != '')
            $query = "SELECT toll_center.tc_name,toll_center.tc_id,toll_center.tc_location,toll_center.toll_type_id FROM toll_center WHERE toll_center.tc_id= $tc_id";
        else
            $query = "SELECT toll_center.tc_name,toll_center.tc_id,toll_center.tc_location,toll_center.toll_type_id FROM toll_center,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND toll_center.tc_id= toll_staff.tc_id";
        $data = $this->db->query($query)->result_array();
        if (count($data)) {
            $result = $data[0];
        }
        return $result;
    }

    public function getLaneDetails($login_user_id, $tc_id = '') {
        $result = $lanes = $orrs = array();
        if ($tc_id != '')
            $query = "SELECT toll_center.tc_id,toll_center.from_way_beacon_id,toll_center.to_way_beacon_id,toll_center.from_way_location,toll_center.to_way_location,toll_center.from_way_no_of_bmt_lanes,toll_center.to_way_no_of_bmt_lanes,toll_center.from_way_no_of_lanes,toll_center.to_way_no_of_lanes,toll_center.orr_from_way_no_of_lanes,toll_center.orr_from_way_no_of_bmt_lanes,toll_center.orr_to_way_no_of_lanes,toll_center.orr_to_way_no_of_bmt_lanes,toll_center.orr_from_way_location,toll_center.orr_to_way_location,toll_center.toll_type_id FROM toll_center WHERE toll_center.tc_id= $tc_id";
        else
            $query = "SELECT toll_center.tc_id,toll_center.from_way_beacon_id,toll_center.to_way_beacon_id,toll_center.from_way_location,toll_center.to_way_location,toll_center.from_way_no_of_bmt_lanes,toll_center.to_way_no_of_bmt_lanes,toll_center.from_way_no_of_lanes,toll_center.to_way_no_of_lanes,toll_center.orr_from_way_no_of_lanes,toll_center.orr_from_way_no_of_bmt_lanes,toll_center.orr_to_way_no_of_lanes,toll_center.orr_to_way_no_of_bmt_lanes,toll_center.orr_from_way_location,toll_center.orr_to_way_location,toll_center.toll_type_id FROM toll_center,toll_staff WHERE toll_staff.ts_id=$login_user_id  AND toll_center.tc_id= toll_staff.tc_id";
        $data = $this->db->query($query)->result_array();
        //~ echo '<pre>';
        //~ print_r($data);
        //~ exit;
        if (count($data)) {
            $result['beacon_details'] = $data[0];
            $from_way_lane_id = '';
            $to_way_lane_id = '';
            $from_way_lane_name = array();
            $to_way_lane_name = array();
            $from_way_lane_id = $data[0]['from_way_beacon_id'];
            $to_way_lane_id = $data[0]['to_way_beacon_id'];
            $lanes = array($from_way_lane_id, $to_way_lane_id);
            $tc_id = $data[0]['tc_id'];

            if ($from_way_lane_id != '') {
                $from_lane_query = "SELECT beacons.uuid from beacons,toll_center where beacons.beacon_id=$from_way_lane_id and beacons.beacon_id=toll_center.from_way_beacon_id";
                $from_way_lane_details = $this->db->query($from_lane_query)->result_array();
            }

            if ($to_way_lane_id != '') {
                $to_lane_query = "SELECT beacons.uuid from beacons,toll_center where beacons.beacon_id=$to_way_lane_id and beacons.beacon_id=toll_center.to_way_beacon_id";
                $to_way_lane_details = $this->db->query($to_lane_query)->result_array();
            }

            if (!empty($from_way_lane_details)) {
                $result['from_way_lane_name'] = $from_way_lane_details[0];
            }
            if (!empty($to_way_lane_details)) {
                $result['to_way_lane_name'] = $to_way_lane_details[0];
            }
            if ($data['0']['toll_type_id'] == 2) {
                $notOrr = implode("', '", $lanes);
                $orr_from_lane_query = "SELECT beacons.uuid from beacons where beacon_id NOT IN ('$notOrr') AND tc_id='$tc_id'";
                //echo $orr_from_lane_query; exit;
                $orr_from_way_lane_details = $this->db->query($orr_from_lane_query);
                foreach ($orr_from_way_lane_details->result() as $row) {
                    $orrs[] = $row->uuid;
                }
                $result['orr_lane_names'] = $orrs;
            }
        }
        return $result;
    }

    public function getTollNamesForCharge($login_user_id, $tc_location) {
        $result = array();

        //Below query is for get the vehical type which is not charged
        $queryfor_vehical_type = "select type_id from vehicle_type where type_id NOT IN (select type_id from toll_charge where tc_id in(SELECT `tc_id` FROM `toll_center` WHERE `tc_location`='$tc_location'))";
        $data = $this->db->query($queryfor_vehical_type)->result_array();
        if (empty($data))
            return $result;
        $query = "SELECT tc_name FROM toll_center WHERE tc_location='$tc_location' AND tc_id NOT IN (SELECT toll_charge.tc_id from toll_charge,toll_center WHERE toll_center.tc_id = toll_charge.tc_id AND toll_center.tc_location = '$tc_location' AND toll_charge.type_id NOT IN (SELECT type_id from vehicle_type))";
        $data = $this->db->query($query)->result_array();
        echo $this->db->last_query();
        pd($data);
    }

    public function tollNameForCharges($tc_location, $user_id) {
        $data = array();
        $query = $this->db->select('tc_name')->where(array('assigned_id' => $user_id, 'tc_location' => $tc_location))->get(self::TABLE_NAME)->result_array();
        if (count($query)) {
            $data = $query;
        }
        return $data;
    }

    public function refund_users() {
        $date = date('Y-m-d H:i:s');

        $this->db->select('toll_center.tc_name,toll_center.tc_location,transactions.tc_id,transactions.type_id,transactions.user_id,vehicle_type.type_name,vehicle_make.make_name,vehicle_model.model_name,'
                . 'user_register.email_id,user_register.mobile_no,user_register.mobile_device_id,transactions.vehicle_id,'
                . 'transactions.vehicle_no,transactions.toll_charge,transactions.bmt_charge,transactions.total_amount,transactions.paid_status,
                    transactions.passing_status,transactions.transaction_date');
        $this->db->from('transactions');
        $this->db->join('toll_center', 'toll_center.tc_id=transactions.tc_id');
        $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
        $this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
        $this->db->join('vehicle_model', 'vehicle_model.model_id=transactions.model_id');
        $this->db->join('vehicles', 'vehicles.vehicle_id=transactions.vehicle_id');
        $this->db->join('user_register', 'user_register.user_id=transactions.user_id');
        $this->db->where('transactions.paid_status', 1);
        $this->db->where('transactions.passing_status', 0);
        //$this->db->where('transactions.transaction_date <=',timestampadd( HOUR , -24,  date('Y-m-d H:i:s')));
//$query = $this->db->get();
        $query = $this->db->query("SELECT `toll_center`.`tc_name`, `toll_center`.`tc_location`, `transactions`.`tc_id`, `transactions`.`type_id`, `transactions`.`user_id`, `vehicle_type`.`type_name`, `vehicle_make`.`make_name`, `vehicle_model`.`model_name`, `user_register`.`email_id`, `user_register`.`mobile_no`, `user_register`.`mobile_device_id`, `transactions`.`vehicle_id`, `transactions`.`vehicle_no`, `transactions`.`toll_charge`, `transactions`.`bmt_charge`, `transactions`.`total_amount`, `transactions`.`paid_status`, `transactions`.`passing_status`, `transactions`.`transaction_date`
FROM (`transactions`)
JOIN `toll_center` ON `toll_center`.`tc_id`=`transactions`.`tc_id`
JOIN `vehicle_type` ON `vehicle_type`.`type_id`=`transactions`.`type_id`
JOIN `vehicle_make` ON `vehicle_make`.`make_id`=`transactions`.`make_id`
JOIN `vehicle_model` ON `vehicle_model`.`model_id`=`transactions`.`model_id`
JOIN `vehicles` ON `vehicles`.`vehicle_id`=`transactions`.`vehicle_id`
JOIN `user_register` ON `user_register`.`user_id`=`transactions`.`user_id`
WHERE `transactions`.`paid_status` =  1
AND `transactions`.`passing_status` =  0
AND `transaction_date` <= timestampadd( HOUR , -24, now()) 
  ");
//echo $this->db->last_query();exit;
        $result = $query->result_array();
        if (count($result) > 0) {
            return $result;
        } else {
            return 4;
        }
    }

// Start History
    public function current_date($loginid) {
//$date= $data['date_wise'];
        $mainarray = array();
//$date= date('Y-m-d');
        $date = '2016-03-15';
        $semiadminresults = $this->db->query("SELECT ts_id,tc_id,first_name, last_name FROM `toll_staff` where assigned_id=$loginid")->result_array();
//$mainarray['semiadmins']=$semiadminresults;
//echo "<pre>"; print_r($semiadminresults);
        $a = 0;

        foreach ($semiadminresults as $each) {
            $mainarray['semiadmin'][$a] = array();
            $mainarray['semiadmin'][$a]['semi_name'] = $each['first_name'];
            $assignedid = $each['ts_id'];
            $tolloperatorsresults = $this->db->query("SELECT ts_id,tc_id, first_name, last_name FROM `toll_staff` where assigned_id=$assignedid")->result_array();
//echo $this->db->last_query();
//echo "<pre>"; print_r($tolloperatorsresults);
            $b = 0;

            foreach ($tolloperatorsresults as $each) {
                $mainarray['semiadmin'][$a][$b] = array();
                $stafid = $each['ts_id'];
                $tcid = $each['tc_id'];
                $mainarray['semiadmin'][$a][$b]['op_id'] = $stafid;
                $mainarray['semiadmin'][$a][$b]['op_name'] = $each['last_name'] . ' ' . $each['first_name'];
                $mainarray['semiadmin'][$a][$b]['tc_id'] = $each['tc_id'];

                $sql1 = $this->db->query("SELECT tc_name,tc_location FROM `toll_center` where tc_id=$tcid");
                $res1 = $sql1->row();
//echo "<pre>"; print_r($res1);exit;
                $mainarray['semiadmin'][$a][$b]['tc_name'] = $res1->tc_name;
                $mainarray['semiadmin'][$a][$b]['tc_location'] = $res1->tc_location;
                $mainarray['semiadmin'][$a][$b]['date'] = $date;
                $mainarray['semiadmin'][$a][$b]['second'] = array();
//total amou start
                $totsql = "SELECT SUM(total_amount) as tot FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' 
     AND `transactions`.`tc_id` =  '$tcid' AND  `transactions`.`transaction_date`  LIKE '%" . $date . "%'";
                $tots = $this->db->query($totsql);
                $totr = $tots->result();
                $mainarray['semiadmin'][$a][$b]['second']['totalamt'] = $totr[0]->tot;
                //total amount end
                $this->db->select('vehicle_type.type_id,vehicle_type.type_name');
                $this->db->from('transactions');
                $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
                //$this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
                //$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
                //$this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                $this->db->where('transactions.ts_id', $stafid);
                $this->db->where('transactions.tc_id', $tcid);
                $this->db->like('transactions.transaction_date', $date);
                $this->db->group_by('transactions.type_id');
                $s = $this->db->get();
//echo $this->db->last_query();
                $r = $s->result();
                $mainarray['semiadmin'][$a][$b]['second']['types'] = $r;
//print_r($r);
                $i = 0;
                foreach ($r as $each) {
                    $typeid = $each->type_id;
                    $typename = $each->type_name;

                    $this->db->select('vehicle_make.make_id,vehicle_make.make_name');
                    $this->db->from('transactions');
                    $this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
                    $this->db->where('transactions.ts_id', $stafid);
                    $this->db->where('transactions.tc_id', $tcid);
                    $this->db->where('transactions.type_id', $typeid);
                    $this->db->like('transactions.transaction_date', $date);

                    $this->db->group_by('vehicle_make.make_id');
                    $s1 = $this->db->get();
                    // echo $this->db->last_query();
                    $r1 = $s1->result();
// print_r($r1);
                    //$mainarray[$i]['makes']= $r1;
                    $mainarray['semiadmin'][$a][$b]['second'][$i]['makes'] = $r1;
                    $j = 0;
                    foreach ($r1 as $each) {
                        $makeid = $each->make_id;
                        $makename = $each->make_name;
                        $query = "SELECT SUM(total_amount) as total,reg_type FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' AND `transactions`.`tc_id` =  '$tcid' AND `transactions`.`type_id` =  '$typeid' AND `transactions`.`make_id` =  '$makeid' AND  `transactions`.`transaction_date`  LIKE '%" . $date . "%' GROUP BY `transactions`.`reg_type`";
                        $s2 = $this->db->query($query);
                        $r2 = $s2->result();
//print_r($r2);

                        $mainarray['semiadmin'][$a][$b]['second'][$i][$j]['amounts'] = $r2;
                        $j++;
                    }
                    $i++;
//$mainarray['amounts']= $r2; 
                }//
                $b++;
            }
            $a++;
        }

//$mainarray=array();
//echo "<pre>";print_r($mainarray);exit;
//if(count($mainarray)>0){
        return $mainarray;
//}
//print_r($mainarray);exit;
    }

    public function day_wise($data, $loginid) {
        //echo "<pre>"; print_r($data);exit;
        $date = $data['date_wise'];
        $mainarray = array();
//$date= date('Y-m-d');
        //$date= '2016-03-15';
        $semiadminresults = $this->db->query("SELECT ts_id,tc_id,first_name, last_name FROM `toll_staff` where assigned_id=$loginid")->result_array();
//$mainarray['semiadmins']=$semiadminresults;
//echo "<pre>"; print_r($semiadminresults);
        $a = 0;

        foreach ($semiadminresults as $each) {
            $mainarray['semiadmin'][$a] = array();
            $mainarray['semiadmin'][$a]['semi_name'] = $each['first_name'];
            $assignedid = $each['ts_id'];
            $tolloperatorsresults = $this->db->query("SELECT ts_id,tc_id, first_name, last_name FROM `toll_staff` where assigned_id=$assignedid")->result_array();
//echo "<pre>"; print_r($tolloperatorsresults);
            $b = 0;

            foreach ($tolloperatorsresults as $each) {
                $mainarray['semiadmin'][$a][$b] = array();
                $stafid = $each['ts_id'];
                $tcid = $each['tc_id'];
                $mainarray['semiadmin'][$a][$b]['op_id'] = $stafid;
                $mainarray['semiadmin'][$a][$b]['op_name'] = $each['last_name'] . ' ' . $each['first_name'];
                $mainarray['semiadmin'][$a][$b]['tc_id'] = $each['tc_id'];


                $sql1 = $this->db->query("SELECT tc_name,tc_location FROM `toll_center` where tc_id=$tcid");
                $res1 = $sql1->row();
                $mainarray['semiadmin'][$a][$b]['tc_name'] = $res1->tc_name;
                $mainarray['semiadmin'][$a][$b]['tc_location'] = $res1->tc_location;
                $mainarray['semiadmin'][$a][$b]['date'] = $date;
                $mainarray['semiadmin'][$a][$b]['second'] = array();
//total amou start
                $totsql = "SELECT SUM(total_amount) as tot FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' 
     AND `transactions`.`tc_id` =  '$tcid' AND  `transactions`.`transaction_date`  LIKE '%" . $date . "%'";
                $tots = $this->db->query($totsql);
                $totr = $tots->result();
                $mainarray['semiadmin'][$a][$b]['second']['totalamt'] = $totr[0]->tot;
                //total amount end
                $this->db->select('vehicle_type.type_id,vehicle_type.type_name');
                $this->db->from('transactions');
                $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
                //$this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
                //$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
                //$this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                $this->db->where('transactions.ts_id', $stafid);
                $this->db->where('transactions.tc_id', $tcid);
                $this->db->like('transactions.transaction_date', $date);
                $this->db->group_by('transactions.type_id');
                $s = $this->db->get();
//echo $this->db->last_query();
                $r = $s->result();
                $mainarray['semiadmin'][$a][$b]['second']['types'] = $r;
//print_r($r);
                $i = 0;
                foreach ($r as $each) {
                    $typeid = $each->type_id;
                    $typename = $each->type_name;

                    $this->db->select('vehicle_make.make_id,vehicle_make.make_name');
                    $this->db->from('transactions');
                    $this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
                    $this->db->where('transactions.ts_id', $stafid);
                    $this->db->where('transactions.tc_id', $tcid);
                    $this->db->where('transactions.type_id', $typeid);
                    $this->db->like('transactions.transaction_date', $date);

                    $this->db->group_by('vehicle_make.make_id');
                    $s1 = $this->db->get();
                    // echo $this->db->last_query();
                    $r1 = $s1->result();
// print_r($r1);
                    //$mainarray[$i]['makes']= $r1;
                    $mainarray['semiadmin'][$a][$b]['second'][$i]['makes'] = $r1;
                    $j = 0;
                    foreach ($r1 as $each) {
                        $makeid = $each->make_id;
                        $makename = $each->make_name;
                        $query = "SELECT SUM(total_amount) as total,reg_type FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' AND `transactions`.`tc_id` =  '$tcid' AND `transactions`.`type_id` =  '$typeid' AND `transactions`.`make_id` =  '$makeid' AND  `transactions`.`transaction_date`  LIKE '%" . $date . "%' GROUP BY `transactions`.`reg_type`";
                        $s2 = $this->db->query($query);
                        $r2 = $s2->result();
//print_r($r2);

                        $mainarray['semiadmin'][$a][$b]['second'][$i][$j]['amounts'] = $r2;
                        $j++;
                    }
                    $i++;
//$mainarray['amounts']= $r2; 
                }//
                $b++;
            }
            $a++;
        }

//$mainarray=array();
//echo "<pre>";print_r($mainarray);exit;
//if(count($mainarray)>0){
        return $mainarray;
//}
//print_r($mainarray);exit;
    }

    public function period_wise($data, $stafid) {

//$date= $data['date_wise'];
        $fromdate = date('Y-m-d', strtotime($data['from_date']));
        $todate = date('Y-m-d', strtotime($data['to_date']));

//$mainarray=array();
        $mainarray['first'] = array();
        $mainarray['second'] = array();
        $sql = $this->db->query("SELECT tc_id,first_name, last_name FROM `toll_staff` where ts_id=$stafid");
        $res = $sql->row();
        $tcid = $res->tc_id;
        $mainarray['first']['tc_id'] = $res->tc_id;
        $mainarray['first']['name'] = $res->last_name . ' ' . $res->first_name;

        $sql1 = $this->db->query("SELECT tc_name,tc_location FROM `toll_center` where tc_id=$tcid");
        $res1 = $sql1->row();
        $mainarray['first']['tc_name'] = $res1->tc_name;
        $mainarray['first']['tc_location'] = $res1->tc_location;
        $mainarray['first']['date'] = $fromdate;
        $mainarray['first']['todate'] = $todate;

        $datesql = "SELECT DATE_FORMAT(`transaction_date`,'%Y-%m-%d') as tdate FROM `transactions` 
    WHERE (DATE_FORMAT(`transaction_date`,'%Y-%m-%d')>= '$fromdate' AND DATE_FORMAT(`transaction_date`,'%Y-%m-%d')<='$todate') 
    GROUP BY DATE_FORMAT(`transaction_date`,'%Y-%m-%d')";
        $dates = $this->db->query($datesql);
        $dater = $dates->result();
//echo "<pre>"; print_r($dater);exit;
        $z = 0;
        foreach ($dater as $eachdate) {
//total amou start

            $date = $eachdate->tdate;
            $mainarray['second'][$z]['datewise'] = $date;
            $totsql = "SELECT SUM(total_amount) as tot FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' 
     AND `transactions`.`tc_id` =  '$tcid' AND  `transactions`.`transaction_date`  LIKE '%" . $date . "%'";
            $tots = $this->db->query($totsql);
            $totr = $tots->result();
            $mainarray['second'][$z]['totalamt'] = $totr[0]->tot;

            $this->db->select('vehicle_type.type_id,vehicle_type.type_name');
            $this->db->from('transactions');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            //$this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
            //$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            //$this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->where('transactions.ts_id', $stafid);
            $this->db->where('transactions.tc_id', $tcid);
            $this->db->like('transactions.transaction_date', $date);
            $this->db->group_by('transactions.type_id');
            $s = $this->db->get();
//echo $this->db->last_query();
            $r = $s->result();
            $mainarray['second'][$z]['types'] = $r;
//print_r($r);
            $i = 0;
            foreach ($r as $each) {
                $typeid = $each->type_id;
                $typename = $each->type_name;

                $this->db->select('vehicle_make.make_id,vehicle_make.make_name');
                $this->db->from('transactions');
                $this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
                $this->db->where('transactions.ts_id', $stafid);
                $this->db->where('transactions.tc_id', $tcid);
                $this->db->where('transactions.type_id', $typeid);
                $this->db->like('transactions.transaction_date', $date);

                $this->db->group_by('vehicle_make.make_id');
                $s1 = $this->db->get();
                // echo $this->db->last_query();
                $r1 = $s1->result();
// print_r($r1);
                //$mainarray[$i]['makes']= $r1;
                $mainarray['second'][$z][$i]['makes'] = $r1;
                $j = 0;
                foreach ($r1 as $each) {
                    $makeid = $each->make_id;
                    $makename = $each->make_name;
                    $query = "SELECT SUM(total_amount) as total,reg_type FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' AND `transactions`.`tc_id` =  '$tcid' AND `transactions`.`type_id` =  '$typeid' AND `transactions`.`make_id` =  '$makeid' AND  `transactions`.`transaction_date`  LIKE '%" . $date . "%' GROUP BY `transactions`.`reg_type`";
                    $s2 = $this->db->query($query);
                    $r2 = $s2->result();
//print_r($r2);

                    $mainarray['second'][$z][$i][$j]['amounts'] = $r2;
                    $j++;
                }
                $i++;
//$mainarray['amounts']= $r2; 
            }
//if(count($mainarray)>0){
//return $mainarray;
//}

            $z++;
        }
        return $mainarray;
//print_r($mainarray);exit;   
    }

    public function gettollcenternames($toll_type_id) {

        $data = array();
        $query = $this->db->select('tc_id,tc_location,tc_name')->where(array('toll_type_id' => $toll_type_id))->get(self::TABLE_NAME)->result();
        if (count($query)) {
            $data = $query;
        }
        return $data;
    }
    
    public function gettollcenternamesNew($toll_type_id) {

        
        $datesql = "SELECT tc_id,tc_location,tc_name,city.city from toll_center"
                 . " left join city on toll_center.city_id = city.id"
                 . " where toll_center.toll_type_id = $toll_type_id"
                 . " order by city.city,tc_location Asc";
        $dates = $this->db->query($datesql);
        $data = $dates->result();
        return $data;
    }
    
    public function getallcities() {

        $data = array();
        $query = $this->db->select('*')->get('city')->result();
        if (count($query)) {
            $data = $query;
        }
        return $data;
    }

}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */
