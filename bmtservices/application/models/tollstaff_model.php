<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tollstaff_model extends CI_Model {

    const TABLE_NAME = "toll_staff";

    public function __construct() {
        parent::__construct();
    }

    public function login($data) {
        $result_array = array();
        $result = $this->db->select('*')->where(array('email_id' => $data['email'], 'password' => $data['password']))->get(self::TABLE_NAME)->result_array();
        if (count($result)) {
            if ($result[0]['roll_id'] != 1) {
                $table = 'toll_center';
                $tc_ids = explode(',', $result[0]['tc_id']);
                foreach ($tc_ids as $key => $value) {
                    $where_condition = array('tc_id' => $value);
                    $toll_status = getStatus($table, $where_condition);
                    $login_user_status = $result[0]['status_flag'];
                    if ($toll_status == 1 || $login_user_status == 1) {
                        $result_array = array('status' => 401, 'auth_token' => '');
                        return $result_array;
                    }
                }
            }
            $authtoken = generate_authToken($result[0]);
            updaterecord(self::TABLE_NAME, array('ts_id' => $result[0]['ts_id']), array('auth_token' => $authtoken));
            $result[0]['auth_token'] = $authtoken;
            $result_array = $result[0];
        }
        return $result_array;
    }

    public function createSemiAdmin($data) {
        $this->db->insert(self::TABLE_NAME, $data);
        return $this->db->insert_id();
    }

    public function listSemiAdmins($user_id) {
        $data = array();
        $query = "SELECT toll_staff.*,toll_center.tc_name,toll_center.tc_location  FROM toll_staff,toll_center  WHERE toll_staff.assigned_id IN (SELECT toll_staff.ts_id FROM toll_staff WHERE toll_staff.ts_id = $user_id) ANd toll_staff.tc_id = toll_center.tc_id AND toll_staff.created_date IN (SELECT MAX(created_date) FROM toll_staff where roll_id = 3 GROUP BY tc_id)";
        $result = $this->db->query($query)->result_array();
        //echo $this->db->last_query();exit;
        if (count($result)) {
            $data = $result;
        }
        return $data;
    }

    public function listSemiAdminsNew($user_id) {
        $data = array();
        $query = "select toll_staff.* FROM toll_staff as toll_staff WHERE toll_staff.assigned_id = $user_id AND toll_staff.roll_id = 3 ";
        $result = $this->db->query($query)->result_array();

        foreach ($result as $key => $value) {
            $query1 = "SELECT group_concat(`tc_name`,'@^') as name,group_concat(`tc_location`,'@^') as location FROM `toll_center` WHERE `tc_id` in(" . $value['tc_id'] . ")";
            $result1 = $this->db->query($query1)->result_array();

            $result[$key]['tc_name'] = trim(str_replace('@^,', ',<br>', $result1[0]['name']), '@^');
            $result[$key]['tc_location'] = trim(str_replace('@^,', ',<br>', $result1[0]['location']), '@^');
        }
        //echo $this->db->last_query();exit;
        if (count($result)) {
            $data = $result;
        }
        return $data;
    }

    public function listTollOperator($login_user_id) {
        $data = array();
        $result = $this->db->select('*')->where('assigned_id', $login_user_id)->get(self::TABLE_NAME)->result_array();
        if (count($result))
            $data = $result;
        return $data;
    }

    public function listTollOperatorsWithTollCenters($login_user_id) {
        $data = array();
//        $result = $this->db->select('*')->where('assigned_id', $login_user_id)->get(self::TABLE_NAME)->result_array();
        $query = "SELECT ts.*,tc.tc_name,tc.tc_location,tc.toll_type_id,c.city  FROM toll_staff as ts "
                . "left join toll_center as tc on ts.tc_id = tc.tc_id "
                . "left join city as c on tc.city_id = c.id "
                . "WHERE ts.assigned_id = $login_user_id";
//        $query = "SELECT toll_staff.*,toll_center.tc_name,toll_center.tc_location,toll_center.toll_type_id  FROM toll_staff,toll_center  WHERE toll_staff.assigned_id = $login_user_id ANd toll_staff.tc_id = toll_center.tc_id";
        //$query = $this->db->select('*')->where('ts_id',$user_id)->get(self::TABLE_NAME)->result_array();
        $result = $this->db->query($query)->result_array();
//        echo $this->db->last_query();exit;
        if (count($result))
            $data = $result;
        return $data;
    }

    public function getSpecificSemiadmindetails($user_id) {
        $data = array();
        $query = "SELECT toll_staff.*,toll_center.tc_name,toll_center.tc_location,toll_center.toll_type_id  FROM toll_staff,toll_center  WHERE toll_staff.ts_id = $user_id ANd toll_staff.tc_id = toll_center.tc_id";
        //$query = $this->db->select('*')->where('ts_id',$user_id)->get(self::TABLE_NAME)->result_array();
        $result = $this->db->query($query)->result_array();
        if (count($result)) {
            $data = $result[0];
            $query1 = "SELECT tc_id,tc_location,tc_name,toll_type_id,city.city from toll_center"
                    . " left join city on toll_center.city_id = city.id"
                    . " where toll_center.toll_type_id = 2"
                    . " order by city.city,tc_location Asc";
//            $query1 = "SELECT * FROM `toll_center` where toll_type_id = 2";
            $result1 = $this->db->query($query1)->result_array();
            $data['TollCenterData'] = $result1;
        }
        return $data;
    }

}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */