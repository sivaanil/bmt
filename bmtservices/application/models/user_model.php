<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model {

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

    const TABLE_NAME = "user_register";

    public function __construct(){
        parent::__construct();
    }

//	public function login($data)
//	{
//		$result_array = array();
//                $password=$data['password'];
//                $login=$data['login'];
//
//                if($login){
//                 $sql = "select * from  user_register where  email_id='$login' and password='$password' and email_flag =1)";
//                }else{
//                 $sql = "select * from  user_register where  mobile_no ='$login' and password='$password'  and otp_flag=1 )";
//                }
//		//$result = $this->db->select('*')->where(array('email_id'=>$data['email_id'],'password'=>$data['password']))->get(self::TABLE_NAME)->result_array();
//
//                $query = $this->db->query($sql);
//                $result=$query->result_array();
//		if(count($result)){
//			$authtoken = generate_authToken($result[0]);
//			updaterecord(self::TABLE_NAME,array('user_id'=>$result[0]['user_id']),array('auth_token'=>$authtoken));
//			$result[0]['auth_token'] = $authtoken;
//			$result_array = $result[0];
//		}
//		return $result_array;
//	}
    public function fb_register_login($data,$img){
//echo "<pre>"; print_r($data);echo $img;
        $result = $this->db->select('*')->where(array('email_id'=>$data['email'],'facebook_id'=>$data['facebook_id']))->get(self::TABLE_NAME)->result_array();
//print_r($result);exit;
        if(empty($result)){
            $fname=$data['first_name'];
            $lname=$data['last_name'];
            $email=$data['email'];
            $date=date('Y-m-d H:i:s');
            $fbid=$data['facebook_id'];
            /*$insertdata = array(
             'first_name'=>$data['first_name'],
             'last_name'=>$data['last_name'],
             'email_id'=>$data['email'],
             'profile_image'=>$img,
             'created_date'=>date('Y-m-d H:i:s'),
             'email_flag'=>1,
             'facebook_id'=>$data['facebook_id'],
          );*/
//$this->db->insert('user_register', $insertdata);
            $authtoken = generate_authToken(array('email_id'=>$data['email']));
            $sql = "INSERT INTO `user_register`(`first_name`, `last_name`, `email_id`, `profile_image`, `created_date`,`auth_token`, `email_flag`, `facebook_id`) 
VALUES ('".$fname."','".$lname."','".$email."','".$img."','".$date."','".$authtoken."',1,'".$fbid."')";
            $result = $this->db->query($sql);

            $id=$this->db->insert_id();

            return $myarray=array('user_id'=>$id,'first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'auth_token'=> $authtoken);
        }else{
            // print_r($result);exit;
            $authtoken = generate_authToken(array('email_id'=>$data['email']));
            updaterecord(self::TABLE_NAME,array('user_id'=>$result[0]['user_id']),array('auth_token'=>$authtoken));
            return $myarray=array('user_id'=>$result[0]['user_id'],'first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'auth_token'=> $authtoken);
        }



        $result_array = array();
        $result = $this->db->select('*')->where(array('email_id'=>$data['login'],'password'=>$data['password']))->get(self::TABLE_NAME)->result_array();
        //print_r($result);exit;
        if(count($result)){
            $authtoken = generate_authToken($result[0]);
            updaterecord(self::TABLE_NAME,array('user_id'=>$result[0]['user_id']),array('auth_token'=>$authtoken));
            $result[0]['auth_token'] = $authtoken;
            $result_array = $result[0];
        }else{
            $result_array=0;
        }
        return $result_array;
    }
    public function login_email($data){
        $result_array = array();
        $result = $this->db->select('*')->where(array('email_id'=>$data['login'],'password'=>$data['password']))->get(self::TABLE_NAME)->result_array();
        //print_r($result);exit;
        if(count($result)){
            $authtoken = generate_authToken($result[0]);
            updaterecord(self::TABLE_NAME,array('user_id'=>$result[0]['user_id']),array('auth_token'=>$authtoken));
            $result[0]['auth_token'] = $authtoken;
            $result_array = $result[0];
        }else{
            $result_array=0;
        }
        return $result_array;
    }
    public function login_mobile($data){
        $result_array = array();
        $result = $this->db->select('*')->where(array('mobile_no'=>$data['login'],'password'=>$data['password'],'otp_flag'=>1))->get(self::TABLE_NAME)->result_array();
        // print_r($result);exit;
        if(count($result)){
            $authtoken = generate_authToken($result[0]);
            updaterecord(self::TABLE_NAME,array('user_id'=>$result[0]['user_id']),array('auth_token'=>$authtoken));
            $result[0]['auth_token'] = $authtoken;
            $result_array = $result[0];
        }else{
            $result_array=0;
        }
        return $result_array;
    }
    public function verify_otp($data){
// pd($data);
        $result = $this->db->select('*')->where(array('user_id'=>$data['user_id'],'otp'=>$data['otp']))->get(self::TABLE_NAME)->result_array();
        if(count($result)){
            updaterecord(self::TABLE_NAME,array('user_id'=>$result[0]['user_id']),array('otp'=>0,'otp_flag'=>1));
            $result_array = $result[0];
        }else
        {
            $result_array=0;
        }
        return $result_array;

    }
    public function verifymobile_otp($data,$userid){
        //pd($data);exit;
        $result = $this->db->select('*')->where(array('user_id'=>$userid,'otp'=>$data['otp']))->get(self::TABLE_NAME)->result_array();
        if(count($result)){
            updaterecord(self::TABLE_NAME,array('user_id'=>$userid),array('mobile_no'=>$data['mobile_no'],'otp'=>0,'otp_flag'=>1));
            $result_array = $result[0];
        }else
        {
            $result_array=0;
        }
        return $result_array;

    }
    public function activate_email($userid,$activationcode){
        $result = $this->db->select('*')->where(array('user_id'=>$userid,'activation_code'=>$activationcode))->get(self::TABLE_NAME)->result_array();
        if(count($result)){
            updaterecord(self::TABLE_NAME,array('user_id'=>$result[0]['user_id']),array('activation_code'=>'','email_flag'=>1));
            $result_array = $result[0];
        }else
        {
            $result_array=0;
        }
        return $result_array;
    }
    public function register($data)
    {
//pd($data);exit;
        $data['created_date']=date('Y-m-d H:i:s');
        $this->db->insert('user_register', $data);
        return $this->db->insert_id();
    }
    public function getProfile($userid){
        $result = $this->db->select('`first_name`, `last_name`, `email_id`,`mobile_no`,`profile_image`')->where(array('user_id'=>$userid))->get(self::TABLE_NAME)->result_array();
        if(count($result)){
            $result_array = $result[0];
        }
        return $result_array;
    }
    public function updateProfile($data,$userid){
        $this->db->select('*');
        $this->db->where('user_id',$userid);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();
        if($count>0){
//$data['profile_image']=$imagename;
            //print_r($data);exit;
            $this->db->where('user_id',$userid);
            $this->db->update(self::TABLE_NAME,$data);
            return $count;
        }else{
            return 0;
        }
    }
    public function updateWebProfile($data,$userid,$imagename){
        $this->db->select('*');
        $this->db->where('user_id',$userid);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();
        if($count>0){
            $data['profile_image']=$imagename;
            //print_r($data);exit;
            $this->db->where('user_id',$userid);
            $this->db->update(self::TABLE_NAME,$data);
            return $count;
        }else{
            return 0;
        }
    }
    public function update_profile_image($uid,$imagename){

        $this->db->select('*');
        $this->db->where('user_id',$uid);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();
        if($count>0){
            //echo $imagename; exit;
            $data=array('profile_image'=>$imagename);
            $this->db->where('user_id',$uid);
            $this->db->update(self::TABLE_NAME,$data);
            //  echo $this->db->last_query();exit;
            return $count;
        }else{
            // echo "dsfsf"; exit;
            return 0;
        }
    }
    public function isExistMobile($mobile_no,$userid){
        $result_array=array();
        $this->db->select('*');
        $this->db->where('user_id',$userid);
        $this->db->where('mobile_no', $mobile_no);
        $query = $this->db->get(self::TABLE_NAME);
        return $count = $query->num_rows();

        // echo $this->db->last_query();
        // exit;
        //pd($result);exit;
    }
    public function change_password($data,$userid){
        $this->db->select('*');
        $this->db->where('user_id',$userid);
        $this->db->where('password',$data['old_password']);
        $query = $this->db->get(self::TABLE_NAME);
        $count = $query->num_rows();
        if($count>0){
            $data=array('password'=>$data['new_password']);
            $this->db->where('user_id',$userid);
            $this->db->update(self::TABLE_NAME,$data);
            return $count;
        }  else {
            return 4;
        }
    }
    public function forgot_password($data){
        $this->db->select('*');
        $this->db->where('email_id',$data['email_id']);
        $this->db->where('mobile_no',$data['mobile_no']);
        $query = $this->db->get(self::TABLE_NAME);
        $count = $query->num_rows();
        if($count>0){
            return $count;
        }  else {
            return 4;
        }
    }
    public function history_info($uid){
        $this->db->select('toll_center.tc_name,toll_center.tc_location,transactions.vehicle_id,transactions.vehicle_no,transactions.total_amount,
    transactions.passing_status,transactions.paid_status,transactions.transaction_date');
        $this->db->from('transactions');
        $this->db->join('toll_center', 'toll_center.tc_id=transactions.tc_id');
        $this->db->join('vehicles', 'vehicles.vehicle_id=transactions.vehicle_id');
        // $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
        $this->db->where('transactions.user_id',$uid);
        $q = $this->db->get();
        //  echo $this->db->last_query();exit;
        $res=$q->result_array();
        //echo count($res);
        //echo "<pre>"; print_r($res);exit;
        if(count($res)>0){
            return $res;
        }else{
            return 4;
        }
    }
    public function day_wise($data,$uid){
        $date= date('Y-m-d',strtotime($data['date_wise']));
        $this->db->select('toll_center.tc_name,toll_center.tc_location,transactions.vehicle_id,transactions.vehicle_no,transactions.total_amount,
    transactions.passing_status,transactions.paid_status,transactions.transaction_date');
        $this->db->from('transactions');
        $this->db->join('toll_center', 'toll_center.tc_id=transactions.tc_id');
        $this->db->join('vehicles', 'vehicles.vehicle_id=transactions.vehicle_id');
        // $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
        $this->db->where('transactions.user_id',$uid);
        $this->db->like('transactions.transaction_date',$date);
        $q = $this->db->get();
        // echo $this->db->last_query();exit;
        $res=$q->result_array();
        //echo count($res);
        // echo "<pre>"; print_r($res);exit;
        if(count($res)>0){
            return $res;
        }else{
            return 4;
        }
    }
    public function period_wise($data,$uid){

//$date= $data['date_wise'];
        $fromdate= date('Y-m-d',strtotime($data['from_date']));
        $todate= date('Y-m-d',strtotime($data['to_date']));

        $mainarray=array();
        $datesql="SELECT DATE_FORMAT(`transaction_date`,'%Y-%m-%d') as tdate FROM `transactions` 
    WHERE (DATE_FORMAT(`transaction_date`,'%Y-%m-%d')>= '$fromdate' AND DATE_FORMAT(`transaction_date`,'%Y-%m-%d')<='$todate') AND user_id=$uid
    GROUP BY DATE_FORMAT(`transaction_date`,'%Y-%m-%d')";
        $dates= $this->db->query($datesql);
        $dater= $dates->result();
        $z=0;
        foreach($dater as $eachdate){
//total amou start

            $date=$eachdate->tdate;
            $mainarray[$z]['datewise']=$date;

            $this->db->select('toll_center.tc_name,toll_center.tc_location,transactions.vehicle_id,transactions.vehicle_no,transactions.total_amount,
    transactions.passing_status,transactions.paid_status,transactions.transaction_date');
            $this->db->from('transactions');
            $this->db->join('toll_center', 'toll_center.tc_id=transactions.tc_id');
            $this->db->join('vehicles', 'vehicles.vehicle_id=transactions.vehicle_id');
            // $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            $this->db->where('transactions.user_id',$uid);
            $this->db->like('transactions.transaction_date',$date);
            $q = $this->db->get();
            // echo $this->db->last_query();
            $res=$q->result_array();
            $mainarray[$z]['history']= $res;
            //echo count($res);
            // echo "<pre>"; print_r($res);exit;
            $z++;}
        //echo "<pre>"; print_r($mainarray);exit;
        if(count($mainarray)>0){
            return $mainarray;
        }else{
            return 4;
        }

    }
    public function update_token($data,$uid){
        $mobile_device_id=$data['mobile_device_id'];
        $device_type=$data['device_type'];
        $sql1 = $this->db->query("SELECT * FROM `user_register` where user_id=$uid");
        $res1 = $sql1->result();
        $num = $sql1->num_rows();
        if($num>0){
            $sql = $this->db->query("UPDATE user_register SET mobile_device_id = '".$mobile_device_id."',device_type = '".$device_type."' WHERE user_id=".$uid."");
            return $num;
        }
        else{
            return 0;
        }
    }
    public function beacon($data,$uid){
        $deviceres = $this->db->select('*')->where(array('user_id'=>$uid))->get('user_register')->result_array();
        $deviceid=$deviceres[0]['mobile_device_id'];
        $this->db->select('*');
        $this->db->where('uuid',$data['uuid']);
        $this->db->where('major_id',$data['major_id']);
        $this->db->where('minor_id',$data['minor_id']);
        $query = $this->db->get('beacons');
        $res=$query->result_array();
        //print_r($res);
        $count = $query->num_rows();
        if($count>0){
            $date1=date('Y-m-d 00:00:01');
            $date2=date('Y-m-d 23:59:59');
            $tcid=$res[0]['tc_id'];
            $beaconid=$res[0]['beacon_id'];

            $fromwayres = $this->db->select('`tc_name`, `tc_location`,`from_way_beacon_id`')->where(array('tc_id'=>$tcid,'from_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
            //echo "<pre>"; print_r($fromwayres);
            $towayres = $this->db->select('`tc_name`, `tc_location`,`to_way_beacon_id`')->where(array('tc_id'=>$tcid,'to_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
            // echo "<pre>"; print_r(count($towayres));
            if(count($fromwayres)>0){
                $way_type=1;
                $tc_name=$fromwayres [0]['tc_name'];
                $tc_location=$fromwayres [0]['tc_location'];

            }
            if(count($towayres)>0){
                $way_type=2;
                $tc_name=$towayres [0]['tc_name'];
                $tc_location=$towayres [0]['tc_location'];
            }
            $msg =  "Welcome to ".$tc_name. " Tollcenter.";
            echo $push=pushNote($deviceid,$msg);exit;

        }else{

        }
    }

    public function becon_paid1($data,$uid){
        //echo $onedate=date('Y-m-d 01:00:00');exit;
        // pd($data);
        $deviceres = $this->db->select('*')->where(array('user_id'=>$uid))->get('user_register')->result_array();
        $deviceid=$deviceres[0]['mobile_device_id'];
        //echo  pushNote($deviceid,'dff');exit;

        $this->db->select('*');
        $this->db->where('uuid',$data['uuid']);
        $this->db->where('major_id',$data['major_id']);
        $this->db->where('minor_id',$data['minor_id']);
        $query = $this->db->get('beacons');
        $res=$query->result_array();
        //print_r($res);
        $count = $query->num_rows();
        if($count>0){

            $date1=date('Y-m-d 00:00:01');
            $date2=date('Y-m-d 23:59:59');
            $tcid=$res[0]['tc_id'];
            $beaconid=$res[0]['beacon_id'];

            $fromwayres = $this->db->select('`tc_name`, `tc_location`,`from_way_beacon_id`')->where(array('tc_id'=>$tcid,'from_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
            //echo "<pre>"; print_r($fromwayres);
            $towayres = $this->db->select('`tc_name`, `tc_location`,`to_way_beacon_id`')->where(array('tc_id'=>$tcid,'to_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
            // echo "<pre>"; print_r(count($towayres));
            if(count($fromwayres)>0){
                $way_type=1;
                $tc_name=$fromwayres [0]['tc_name'];
                $tc_location=$fromwayres [0]['tc_location'];

            }else if(count($towayres)>0){
                $way_type=2;
                $tc_name=$towayres [0]['tc_name'];
                $tc_location=$towayres [0]['tc_location'];
            }
//echo $way_type."==".$tc_name."==".$tc_location;



            // print_r($data);
            $lastonehour=date('Y-m-d H:i:s', strtotime('-1 hour'));
            $ts="select transaction_id from transactions where `transaction_date` >= '".$lastonehour."' AND tc_id=".$tcid." AND user_id=".$uid." ";

            $tq=$this->db->query($ts);
//echo $this->db->last_query();
            $tc = $tq->num_rows();
//print_r($tc);exit;
//if($tc>0){
            /* $msg1 =  "Welcome to ".$tc_name. " Tollcenter.";
           $push=pushNote($deviceid,$msg1);

           $msg="Already Done Transaction.";
           pushNote($deviceid,$msg);*/
//}//end if($tc>0){
//else{
//}
            if($tc==0){

                $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=1";
                $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                $pushcount = $pushsql->num_rows();
                if($pushcount==0){
                    $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>1,'date_sent'=>date('Y-m-d H:i:s'));
                    $this->db->insert('push_status',$insertarr);
                    $msg1 =  "Welcome to ".$tc_name. " Tollcenter.";
                    $push=pushNote($deviceid,$msg1);
                }
//exit;

//sleep(60);
                $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                    . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                    . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
                $this->db->from('toll_charge');
                $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
                $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
                $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
                $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
                $this->db->where('toll_charge.tc_id',$tcid);
                $this->db->where('user_register.user_id',$uid);
                $this->db->where('vehicles.default_status','1');
                $this->db->where('vehicles.status_flag','1');
                $this->db->where('vehicles.paid_status','0');
                $this->db->where('vehicles.passing_status','0');
                $this->db->where('user_register.mobile_device_id IS NOT NULL');
                $cq = $this->db->get();
                // echo $this->db->last_query();exit;
                $cres=$cq->result_array();
                $vehiclenum = $cq->num_rows();
                //  echo "<pre>";print_r($cres);
                if($vehiclenum>0){

                    $q=$this->db->query("select * from transactions where (`transaction_date` BETWEEN '".$date1."' AND '".$date2."') AND tc_id=".$tcid." AND user_id=".$uid."") ;
                    $c = $q->num_rows();
                    //print_r($c);
                    if($c>0){ $toll_charge=$cres[0]['two_way_charge']; }else{ $toll_charge=$cres[0]['one_way_charge']; }

                    $bmtcharge=1;
                    $total=$toll_charge+$bmtcharge;

                    $data1=$cres[0];
                    $vid=$data1['vehicle_id'];

                    $sql1 = $this->db->query("SELECT * FROM `wallet` where user_id=".$uid."");
                    $res1 = $sql1->result();
                    $num = $sql1->num_rows();
//print_r($num);exit;
                    if($num>0){

                        $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>$way_type,'status_flag'=>0,'user_selsect_status'=>0))->get('bmt_lanes')->result_array();
                        //  echo $this->db->last_query();exit;
                        // print_r($laneres);exit;
                        if(count($laneres)>0){

                            $laneidarray=array();
                            foreach($laneres as $each){
                                $laneidarray[]=$each['lane_id'];
                            }
//print_r($laneidarray);exit;
                            $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
                            $this->db->from('bmt_lane_mapping');
                            $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
                            $this->db->where('bmt_lane_mapping.tc_id',$tcid);
                            $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
                            $re=$this->db->get();
                            // echo $this->db->last_query();
                            $lanemapres = $re->result_array();
                            //  print_r($lanemapres);exit;
                            if(count($lanemapres)>0){

                                $tcnamesql = $this->db->select('`tc_name`, `tc_location`')->where(array('tc_id'=>$tcid))->get('toll_center')->result_array();
//print_r($tcnamesql);exit;

                                $laneno=$lanemapres[0]['lane_number'];
                                $laneid=$lanemapres[0]['lane_id'];
                                $tsid=$lanemapres[0]['ts_id'];
                                //print_r($lanemapres);
                                //send lane no ($laneno)to mobile through push notifications
                                $msg =  "Your Lane is ".$laneno;
                                pushNote($deviceid,$msg);
                                $sql = $this->db->query("UPDATE wallet SET wallet_amount = wallet_amount - $total WHERE user_id=".$uid."");
                                $vsql = $this->db->query("UPDATE vehicles SET paid_status = '1',passing_status='0' WHERE vehicle_id=".$vid." AND user_id=".$uid."");
                                $insertarr=array(
                                    'ts_id'=>$tsid,
                                    'tc_id'=>$tcid,
                                    'user_id'=>$uid,
                                    'type_id'=>$data1['type_id'],
                                    'make_id'=>$data1['make_id'],
                                    'model_id'=>$data1['model_id'],
                                    'vehicle_id'=>$data1['vehicle_id'],
                                    'vehicle_no'=>$data1['vehicle_no'],
                                    'lane_id'=>$laneid,
                                    'email_id'=>$data1['email_id'],
                                    'reg_type'=>$data1['mobile_device_id'],
                                    'toll_charge'=>$toll_charge,
                                    'bmt_charge'=>$bmtcharge,
                                    'total_amount'=>$total,
                                    'passing_status'=>0,
                                    'paid_status'=>1,
                                    'transaction_date'=>date('Y-m-d H:i:s')
                                );
                                //  return 1;
                                //  pd($insertarr);exit;
                                $this->db->insert('transactions',$insertarr);
                                //echo $this->db->last_query();
                                //  return $id = $this->db->insert_id();
                                $msg="Transaction Completed.";
                                pushNote($deviceid,$msg);

                            }//end if(count($lanemapres)
                            else{

                                $msg="There is no BMT lanes.";
                                pushNote($deviceid,$msg);
                            }//end else (count($lanemapres)
                        }//end  if(count($laneres)
                        else{
                            $msg="There is no BMT lanes.";
                            pushNote($deviceid,$msg);
                        }//end else (count($laneres)


                    }//end if($num>0)
                    else{
                        $msg="No Sufficient points in your wallet.";
                        pushNote($deviceid,$msg);
                    }//end else($num>0)
                }//end if(vnum>0)
                else{
                    $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                    $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=2";
                    $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                    $pushcount = $pushsql->num_rows();
                    if($pushcount==0){
                        $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>2,'date_sent'=>date('Y-m-d H:i:s'));
                        $this->db->insert('push_status',$insertarr);
                        $msg="You Donn't have vehicle OR Not set yet default";
                        pushNote($deviceid,$msg);
                    }


                }//end else vno>0
            }//end ellse($tc>0){
            exit;
        }//end if($count>0){



    }

    public function becon_paid($data,$uid){
        //echo $onedate=date('Y-m-d 01:00:00');exit;
        // pd($data);

        $deviceres = $this->db->select('*')->where(array('user_id'=>$uid))->get('user_register')->result_array();
        $deviceid=$deviceres[0]['mobile_device_id'];
        //echo  pushNote($deviceid,'dff');exit;

        $this->db->select('*');
        $this->db->where('uuid',$data['uuid']);
        $this->db->where('major_id',$data['major_id']);
        $this->db->where('minor_id',$data['minor_id']);
        $query = $this->db->get('beacons');
        $res=$query->result_array();
        //print_r($res);
        $count = $query->num_rows();
        if($count>0){

            $date1=date('Y-m-d 00:00:01');
            $date2=date('Y-m-d 23:59:59');
            $tcid=$res[0]['tc_id'];
            $beaconid=$res[0]['beacon_id'];

            $fromwayres = $this->db->select('`tc_name`, `tc_location`,`from_way_beacon_id`')->where(array('tc_id'=>$tcid,'from_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
            //echo "<pre>"; print_r($fromwayres);
            $towayres = $this->db->select('`tc_name`, `tc_location`,`to_way_beacon_id`')->where(array('tc_id'=>$tcid,'to_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
            // echo "<pre>"; print_r(count($towayres));
            if(count($fromwayres)>0){
                $way_type=1;
                $tc_name=$fromwayres [0]['tc_name'];
                $tc_location=$fromwayres [0]['tc_location'];

            }
            if(count($towayres)>0){
                $way_type=2;
                $tc_name=$towayres [0]['tc_name'];
                $tc_location=$towayres [0]['tc_location'];
            }
            echo $way_type."==".$tc_name."==".$tc_location;



            exit;








            $s="select * from transactions where (`transaction_date` BETWEEN '".$date1."' AND '".$date2."') AND tc_id=".$tcid." AND user_id=".$uid."" ;
            $q=$this->db->query($s);

            $c = $q->num_rows();
            // print_r($c);exit;
            if($c>0){

                $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>2,'status_flag'=>0,'user_selsect_status'=>0))->get('bmt_lanes')->result_array();
                //  echo $this->db->last_query();exit;
                // print_r($laneres);exit;
                if(count($laneres)>0){

                    $laneidarray=array();
                    foreach($laneres as $each){
                        $laneidarray[]=$each['lane_id'];
                    }
//print_r($laneidarray);exit;
                    $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
                    $this->db->from('bmt_lane_mapping');
                    $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
                    $this->db->where('bmt_lane_mapping.tc_id',$tcid);
                    $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
                    $re=$this->db->get();
                    // echo $this->db->last_query();
                    $lanemapres = $re->result_array();
                    //  print_r($lanemapres);exit;
                    if(count($lanemapres)>0){

                        $tcnamesql = $this->db->select('`tc_name`, `tc_location`')->where(array('tc_id'=>$tcid))->get('toll_center')->result_array();
//print_r($tcnamesql);exit;

                        $msg =  "Welcome to ".$tcnamesql[0]['tc_name']. " Tollcenter.";
                        $push=pushNote($deviceid,$msg);
                        sleep(10);


                        $laneno=$lanemapres[0]['lane_number'];
                        $laneid=$lanemapres[0]['lane_id'];
                        $tsid=$lanemapres[0]['ts_id'];
                        //print_r($lanemapres);
                        //send lane no ($laneno)to mobile through push notifications
                        $message2 =  "Your Lane is ".$laneno;
                        $deviceid2="fJzkl-ddaN4:APA91bFjgp1oPFzoFx2_T5W5Il6NoAniEk4ivEzVcNydcxVsoGH_LXWYG5GPCpHHgpKWB_DBG_p9sJdNyMYX9hwUFfdrt_1kyHuJKQ_E8LgMC2cpgHcU33gAh9EmlXGyfK4_cP_xIItJ";
//$sts=sendPushNotification($deviceid,$message);

//print_r($tcnamesql);exit;

                        $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                            . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                            . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
                        $this->db->from('toll_charge');
                        $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
                        $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
                        $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
                        $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                        $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
                        $this->db->where('toll_charge.tc_id',$tcid);
                        $this->db->where('user_register.user_id',$uid);
                        $this->db->where('vehicles.default_status','1');
                        $this->db->where('vehicles.status_flag','1');
                        $this->db->where('vehicles.paid_status','0');
                        $this->db->where('vehicles.passing_status','0');
                        $this->db->where('user_register.mobile_device_id IS NOT NULL');
                        $cq = $this->db->get();
                        // echo $this->db->last_query();exit;
                        $cres=$cq->result_array();
                        //print_r($cres);exit;
                        $toll_charge=$cres[0]['two_way_charge'];
                        $bmtcharge=1;
                        $total=$toll_charge+$bmtcharge;
                        $data1=$cres[0];
                        $vid=$data1['vehicle_id'];
                        // print_r($data);
                        $lastonehour=date('Y-m-d H:i:s', strtotime('-1 hour'));
                        $ts="select transaction_id from transactions where `transaction_date` >= ".$lastonehour." AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id= ".$vid."";

                        $tq=$this->db->query($ts);
                        $tc = $tq->num_rows();
//print_r($tc);exit;
                        if($tc>0){
                            $message5="Already Done Transaction.";
                            $regId1=array($deviceid);
                            $url1 = 'https://android.googleapis.com/gcm/send';
                            $fields5 = array(
                                'registration_ids' => $regId1,
                                'data' => array( "title"=>"Book My Toll","message" => $message5 ),
                            );

                            $headers1 = array(
                                'Authorization: key=' . GOOGLE_API_KEY,
                                'Content-Type: application/json'
                            );
                            // Open connection
                            $ch5 = curl_init();

                            // Set the url, number of POST vars, POST data
                            curl_setopt($ch5, CURLOPT_URL, $url1);

                            curl_setopt($ch5, CURLOPT_POST, true);
                            curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers1);
                            curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);

                            // Disabling SSL Certificate support temporarly
                            curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, false);

                            curl_setopt($ch5, CURLOPT_POSTFIELDS, json_encode($fields5));

                            // Execute post
                            $result5 = curl_exec($ch5);
                            if ($result5 === FALSE) {
                                die('Curl failed: ' . curl_error($ch5));
                            }
                            curl_close($ch5);
                            sleep(10);
                            exit;
//echo $msg= "Already Done Transaction.";exit;

                        }else{
                            $sql1 = $this->db->query("SELECT * FROM `wallet` where user_id=$uid");
                            $res1 = $sql1->result();
                            $num = $sql1->num_rows();
//print_r($num);exit;
                            if($num>0){

                                $regId2=array($deviceid);
                                $url2 = 'https://android.googleapis.com/gcm/send';
                                $fields2 = array(
                                    'registration_ids' => $regId2,
                                    'data' => array( "title"=>"Book My Toll","message" => $message2 ),
                                );

                                $headers2 = array(
                                    'Authorization: key=' . GOOGLE_API_KEY,
                                    'Content-Type: application/json'
                                );
                                // Open connection
                                $ch2 = curl_init();

                                // Set the url, number of POST vars, POST data
                                curl_setopt($ch2, CURLOPT_URL, $url2);

                                curl_setopt($ch2, CURLOPT_POST, true);
                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

                                // Disabling SSL Certificate support temporarly
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);

                                curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($fields2));

                                // Execute post
                                $result2 = curl_exec($ch2);
                                if ($result2 === FALSE) {
                                    die('Curl failed: ' . curl_error($ch2));
                                }
                                curl_close($ch2);
                                sleep(10);
                                // $sql = $this->db->query("UPDATE wallet SET wallet_amount = wallet_amount - $total WHERE user_id=".$uid."");
                                // $vsql = $this->db->query("UPDATE vehicles SET paid_status = '1',passing_status='0' WHERE vehicle_id=".$vid." AND user_id=".$uid."");
                                $insertarr=array(
                                    'ts_id'=>$tsid,
                                    'tc_id'=>$tcid,
                                    'user_id'=>$uid,
                                    'type_id'=>$data1['type_id'],
                                    'make_id'=>$data1['make_id'],
                                    'model_id'=>$data1['model_id'],
                                    'vehicle_id'=>$data1['vehicle_id'],
                                    'vehicle_no'=>$data1['vehicle_no'],
                                    'lane_id'=>$laneid,
                                    'email_id'=>$data1['email_id'],
                                    'reg_type'=>$data1['mobile_device_id'],
                                    'toll_charge'=>$toll_charge,
                                    'bmt_charge'=>$bmtcharge,
                                    'total_amount'=>$total,
                                    'passing_status'=>0,
                                    'paid_status'=>1,
                                    'transaction_date'=>date('Y-m-d H:i:s')
                                );
                                //  return 1;
                                //  pd($insertarr);exit;
                                $this->db->insert('transactions',$insertarr);
                                //echo $this->db->last_query();
                                //  return $id = $this->db->insert_id();
                                $message3="Transaction Completed.";
                                $regId1=array($deviceid);
                                $url1 = 'https://android.googleapis.com/gcm/send';
                                $fields3 = array(
                                    'registration_ids' => $regId1,
                                    'data' => array( "title"=>"Book My Toll","message" => $message3 ),
                                );

                                $headers1 = array(
                                    'Authorization: key=' . GOOGLE_API_KEY,
                                    'Content-Type: application/json'
                                );
                                // Open connection
                                $ch3 = curl_init();

                                // Set the url, number of POST vars, POST data
                                curl_setopt($ch3, CURLOPT_URL, $url1);

                                curl_setopt($ch3, CURLOPT_POST, true);
                                curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers1);
                                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);

                                // Disabling SSL Certificate support temporarly
                                curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);

                                curl_setopt($ch3, CURLOPT_POSTFIELDS, json_encode($fields3));

                                // Execute post
                                $result3 = curl_exec($ch3);
                                if ($result3 === FALSE) {
                                    die('Curl failed: ' . curl_error($ch3));
                                }
                                curl_close($ch3);
                                sleep(10);
                                exit;

//echo $msg="Transaction Completed.";exit;

                            }else{
                                $message4="No Sufficient points in your wallet.";
                                $regId1=array($deviceid);
                                $url1 = 'https://android.googleapis.com/gcm/send';
                                $fields4 = array(
                                    'registration_ids' => $regId1,
                                    'data' => array( "title"=>"Book My Toll","message" => $message4 ),
                                );

                                $headers1 = array(
                                    'Authorization: key=' . GOOGLE_API_KEY,
                                    'Content-Type: application/json'
                                );
                                // Open connection
                                $ch4 = curl_init();

                                // Set the url, number of POST vars, POST data
                                curl_setopt($ch4, CURLOPT_URL, $url1);

                                curl_setopt($ch4, CURLOPT_POST, true);
                                curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers1);
                                curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);

                                // Disabling SSL Certificate support temporarly
                                curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

                                curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($fields4));

                                // Execute post
                                $result4 = curl_exec($ch4);
                                if ($result4 === FALSE) {
                                    die('Curl failed: ' . curl_error($ch4));
                                }
                                curl_close($ch4);
                                sleep(10);
                                exit;
                                // echo  $msg= "No Sufficient in your wallet.";exit;
                            }

                        }//endif($tc>0)
                    }else{
                        $message4="There is no BMT lanes.";
                        $regId1=array($deviceid);
                        $url1 = 'https://android.googleapis.com/gcm/send';
                        $fields4 = array(
                            'registration_ids' => $regId1,
                            'data' => array( "title"=>"Book My Toll","message" => $message4 ),
                        );

                        $headers1 = array(
                            'Authorization: key=' . GOOGLE_API_KEY,
                            'Content-Type: application/json'
                        );
                        // Open connection
                        $ch4 = curl_init();

                        // Set the url, number of POST vars, POST data
                        curl_setopt($ch4, CURLOPT_URL, $url1);

                        curl_setopt($ch4, CURLOPT_POST, true);
                        curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers1);
                        curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);

                        // Disabling SSL Certificate support temporarly
                        curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

                        curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($fields4));

                        // Execute post
                        $result4 = curl_exec($ch4);
                        if ($result4 === FALSE) {
                            die('Curl failed: ' . curl_error($ch4));
                        }
                        curl_close($ch4);
                        sleep(10);
                        exit;
                        // echo $msg="There is no Toll Operator";
                    }
                } else{
                    $message4="There is no BMT lanes.";
                    $regId1=array($deviceid);
                    $url1 = 'https://android.googleapis.com/gcm/send';
                    $fields4 = array(
                        'registration_ids' => $regId1,
                        'data' => array( "title"=>"Book My Toll","message" => $message4 ),
                    );

                    $headers1 = array(
                        'Authorization: key=' . GOOGLE_API_KEY,
                        'Content-Type: application/json'
                    );
                    // Open connection
                    $ch4 = curl_init();

                    // Set the url, number of POST vars, POST data
                    curl_setopt($ch4, CURLOPT_URL, $url1);

                    curl_setopt($ch4, CURLOPT_POST, true);
                    curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers1);
                    curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);

                    // Disabling SSL Certificate support temporarly
                    curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

                    curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($fields4));

                    // Execute post
                    $result4 = curl_exec($ch4);
                    if ($result4 === FALSE) {
                        die('Curl failed: ' . curl_error($ch4));
                    }
                    curl_close($ch4);
                    sleep(10);
                    exit;
                    // echo $msg="There is no BMT lanes";
                }
                // echo "2way";
            }  else{

                $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>1,'status_flag'=>0,'user_selsect_status'=>0))->get('bmt_lanes')->result_array();
                //  echo $this->db->last_query();exit;
                // print_r($laneres);exit;
                if(count($laneres)>0){

                    $laneidarray=array();
                    foreach($laneres as $each){
                        $laneidarray[]=$each['lane_id'];
                    }
//print_r($laneidarray);exit;
                    $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
                    $this->db->from('bmt_lane_mapping');
                    $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
                    $this->db->where('bmt_lane_mapping.tc_id',$tcid);
                    $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
                    $re=$this->db->get();
                    // echo $this->db->last_query();
                    $lanemapres = $re->result_array();
                    //  print_r($lanemapres);exit;
                    if(count($lanemapres)>0){


                        $tcnamesql = $this->db->select('`tc_name`, `tc_location`')->where(array('tc_id'=>$tcid))->get('toll_center')->result_array();
//print_r($tcnamesql);exit;

                        $message1 =  "Welcome to ".$tcnamesql[0]['tc_name']. " Tollcenter.";
                        $deviceid1="fJzkl-ddaN4:APA91bFjgp1oPFzoFx2_T5W5Il6NoAniEk4ivEzVcNydcxVsoGH_LXWYG5GPCpHHgpKWB_DBG_p9sJdNyMYX9hwUFfdrt_1kyHuJKQ_E8LgMC2cpgHcU33gAh9EmlXGyfK4_cP_xIItJ";
//echo $sts=sendPushNotification($deviceid1,$message1);exit;
                        $regId1=array($deviceid);
                        $url1 = 'https://android.googleapis.com/gcm/send';
                        $fields1 = array(
                            'registration_ids' => $regId1,
                            'data' => array( "title"=>"Book My Toll","message" => $message1 ),
                        );

                        $headers1 = array(
                            'Authorization: key=' . GOOGLE_API_KEY,
                            'Content-Type: application/json'
                        );
                        // Open connection
                        $ch1 = curl_init();
                        // Set the url, number of POST vars, POST data
                        curl_setopt($ch1, CURLOPT_URL, $url1);

                        curl_setopt($ch1, CURLOPT_POST, true);
                        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

                        // Disabling SSL Certificate support temporarly
                        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);

                        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields1));

                        // Execute post
                        $result1 = curl_exec($ch1);
                        if ($result1 === FALSE) {
                            die('Curl failed: ' . curl_error($ch1));
                        }
                        curl_close($ch1);
//print_r($tcnamesql);exit;
                        sleep(10);


                        $laneno=$lanemapres[0]['lane_number'];
                        $laneid=$lanemapres[0]['lane_id'];
                        $tsid=$lanemapres[0]['ts_id'];

                        $message2 =  "Your Lane is ".$laneno;
                        $deviceid2="fJzkl-ddaN4:APA91bFjgp1oPFzoFx2_T5W5Il6NoAniEk4ivEzVcNydcxVsoGH_LXWYG5GPCpHHgpKWB_DBG_p9sJdNyMYX9hwUFfdrt_1kyHuJKQ_E8LgMC2cpgHcU33gAh9EmlXGyfK4_cP_xIItJ";
//$sts=sendPushNotification($deviceid,$message);

//print_r($tcnamesql);exit;

                        $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                            . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                            . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
                        $this->db->from('toll_charge');
                        $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
                        $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
                        $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
                        $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                        $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
                        $this->db->where('toll_charge.tc_id',$tcid);
                        $this->db->where('user_register.user_id',$uid);
                        $this->db->where('vehicles.default_status','1');
                        $this->db->where('vehicles.status_flag','1');
                        $this->db->where('vehicles.paid_status','0');
                        $this->db->where('vehicles.passing_status','0');
                        $this->db->where('user_register.mobile_device_id IS NOT NULL');
                        $cq = $this->db->get();
                        // echo $this->db->last_query();exit;
                        $cres=$cq->result_array();
                        //print_r($cres);exit;
                        $toll_charge=$cres[0]['one_way_charge'];
                        $bmtcharge=1;
                        $total=$toll_charge+$bmtcharge;
                        $data1=$cres[0];
                        $vid=$data1['vehicle_id'];
                        // print_r($cres);exit;
                        $lastonehour=date('Y-m-d H:i:s', strtotime('-1 hour'));
                        $ts="select transaction_id from transactions where `transaction_date` >= ".$lastonehour." AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id= ".$vid."";
                        //echo $ts;exit;
                        $tq=$this->db->query($ts);
                        $tc = $tq->num_rows();
//print_r($tc);exit;
                        if($tc>0){
                            $message5="Already Done Transaction.";
                            $regId1=array($deviceid);
                            $url1 = 'https://android.googleapis.com/gcm/send';
                            $fields5 = array(
                                'registration_ids' => $regId1,
                                'data' => array( "title"=>"Book My Toll","message" => $message5 ),
                            );

                            $headers1 = array(
                                'Authorization: key=' . GOOGLE_API_KEY,
                                'Content-Type: application/json'
                            );
                            // Open connection
                            $ch5 = curl_init();

                            // Set the url, number of POST vars, POST data
                            curl_setopt($ch5, CURLOPT_URL, $url1);

                            curl_setopt($ch5, CURLOPT_POST, true);
                            curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers1);
                            curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);

                            // Disabling SSL Certificate support temporarly
                            curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, false);

                            curl_setopt($ch5, CURLOPT_POSTFIELDS, json_encode($fields5));

                            // Execute post
                            $result5 = curl_exec($ch5);
                            if ($result5 === FALSE) {
                                die('Curl failed: ' . curl_error($ch5));
                            }
                            curl_close($ch5);
                            sleep(10);
                            exit;
//echo $msg= "Already Done Transaction.";exit;

                        }else{
                            $sql1 = $this->db->query("SELECT * FROM `wallet` where user_id=$uid");
                            $res1 = $sql1->result();
                            $num = $sql1->num_rows();
//print_r($num);exit;
                            if($num>0){

                                $regId2=array($deviceid);
                                $url2 = 'https://android.googleapis.com/gcm/send';
                                $fields2 = array(
                                    'registration_ids' => $regId2,
                                    'data' => array( "title"=>"Book My Toll","message" => $message2 ),
                                );

                                $headers2 = array(
                                    'Authorization: key=' . GOOGLE_API_KEY,
                                    'Content-Type: application/json'
                                );
                                // Open connection
                                $ch2 = curl_init();

                                // Set the url, number of POST vars, POST data
                                curl_setopt($ch2, CURLOPT_URL, $url2);

                                curl_setopt($ch2, CURLOPT_POST, true);
                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

                                // Disabling SSL Certificate support temporarly
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);

                                curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($fields2));

                                // Execute post
                                $result2 = curl_exec($ch2);
                                if ($result2 === FALSE) {
                                    die('Curl failed: ' . curl_error($ch2));
                                }
                                curl_close($ch2);
                                sleep(10);
                                // $sql = $this->db->query("UPDATE wallet SET wallet_amount = wallet_amount - $total WHERE user_id=".$uid."");
                                // $vsql = $this->db->query("UPDATE vehicles SET paid_status = '1',passing_status='0' WHERE vehicle_id=".$vid." AND user_id=".$uid."");
                                $insertarr=array(
                                    'ts_id'=>$tsid,
                                    'tc_id'=>$tcid,
                                    'user_id'=>$uid,
                                    'type_id'=>$data1['type_id'],
                                    'make_id'=>$data1['make_id'],
                                    'model_id'=>$data1['model_id'],
                                    'vehicle_id'=>$data1['vehicle_id'],
                                    'vehicle_no'=>$data1['vehicle_no'],
                                    'lane_id'=>$laneid,
                                    'email_id'=>$data1['email_id'],
                                    'reg_type'=>$data1['mobile_device_id'],
                                    'toll_charge'=>$toll_charge,
                                    'bmt_charge'=>$bmtcharge,
                                    'total_amount'=>$total,
                                    'passing_status'=>0,
                                    'paid_status'=>1,
                                    'transaction_date'=>date('Y-m-d H:i:s')
                                );
                                //  return 1;
                                //  pd($insertarr);exit;
                                $this->db->insert('transactions',$insertarr);
                                //echo $this->db->last_query();
                                //  return $id = $this->db->insert_id();
                                $message3="Transaction Completed.";
                                $regId1=array($deviceid);
                                $url1 = 'https://android.googleapis.com/gcm/send';
                                $fields3 = array(
                                    'registration_ids' => $regId1,
                                    'data' => array( "title"=>"Book My Toll","message" => $message3 ),
                                );

                                $headers1 = array(
                                    'Authorization: key=' . GOOGLE_API_KEY,
                                    'Content-Type: application/json'
                                );
                                // Open connection
                                $ch3 = curl_init();

                                // Set the url, number of POST vars, POST data
                                curl_setopt($ch3, CURLOPT_URL, $url1);

                                curl_setopt($ch3, CURLOPT_POST, true);
                                curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers1);
                                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);

                                // Disabling SSL Certificate support temporarly
                                curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);

                                curl_setopt($ch3, CURLOPT_POSTFIELDS, json_encode($fields3));

                                // Execute post
                                $result3 = curl_exec($ch3);
                                if ($result3 === FALSE) {
                                    die('Curl failed: ' . curl_error($ch3));
                                }
                                curl_close($ch3);
                                sleep(10);
                                exit;

//echo $msg="Transaction Completed.";exit;

                            }else{
                                $message4="No Sufficient points in your wallet.";
                                $regId1=array($deviceid);
                                $url1 = 'https://android.googleapis.com/gcm/send';
                                $fields4 = array(
                                    'registration_ids' => $regId1,
                                    'data' => array( "title"=>"Book My Toll","message" => $message4 ),
                                );

                                $headers1 = array(
                                    'Authorization: key=' . GOOGLE_API_KEY,
                                    'Content-Type: application/json'
                                );
                                // Open connection
                                $ch4 = curl_init();

                                // Set the url, number of POST vars, POST data
                                curl_setopt($ch4, CURLOPT_URL, $url1);

                                curl_setopt($ch4, CURLOPT_POST, true);
                                curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers1);
                                curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);

                                // Disabling SSL Certificate support temporarly
                                curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

                                curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($fields4));

                                // Execute post
                                $result4 = curl_exec($ch4);
                                if ($result4 === FALSE) {
                                    die('Curl failed: ' . curl_error($ch4));
                                }
                                curl_close($ch4);
                                sleep(10);
                                exit;
                                // echo  $msg= "No Sufficient in your wallet.";exit;
                            }

                        }//endif($tc>0)544



                    }//endif(count($lanemapres)511
                    else{
                        // return 4;
                        $message4="There is no BMT lanes.";
                        $regId1=array($deviceid);
                        $url1 = 'https://android.googleapis.com/gcm/send';
                        $fields4 = array(
                            'registration_ids' => $regId1,
                            'data' => array( "title"=>"Book My Toll","message" => $message4 ),
                        );

                        $headers1 = array(
                            'Authorization: key=' . GOOGLE_API_KEY,
                            'Content-Type: application/json'
                        );
                        // Open connection
                        $ch4 = curl_init();

                        // Set the url, number of POST vars, POST data
                        curl_setopt($ch4, CURLOPT_URL, $url1);

                        curl_setopt($ch4, CURLOPT_POST, true);
                        curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers1);
                        curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);

                        // Disabling SSL Certificate support temporarly
                        curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

                        curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($fields4));

                        // Execute post
                        $result4 = curl_exec($ch4);
                        if ($result4 === FALSE) {
                            die('Curl failed: ' . curl_error($ch4));
                        }
                        curl_close($ch4);
                        sleep(10);
                        exit;
                        //$msg="There is no BMT lanes";
                    }

                } //endif(count($laneres)>0)
                else{
                    //return 4;
                    $message4="There is no BMT lanes.";
                    $regId1=array($deviceid);
                    $url1 = 'https://android.googleapis.com/gcm/send';
                    $fields4 = array(
                        'registration_ids' => $regId1,
                        'data' => array( "title"=>"Book My Toll","message" => $message4 ),
                    );

                    $headers1 = array(
                        'Authorization: key=' . GOOGLE_API_KEY,
                        'Content-Type: application/json'
                    );
                    // Open connection
                    $ch4 = curl_init();

                    // Set the url, number of POST vars, POST data
                    curl_setopt($ch4, CURLOPT_URL, $url1);

                    curl_setopt($ch4, CURLOPT_POST, true);
                    curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers1);
                    curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);

                    // Disabling SSL Certificate support temporarly
                    curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

                    curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($fields4));

                    // Execute post
                    $result4 = curl_exec($ch4);
                    if ($result4 === FALSE) {
                        die('Curl failed: ' . curl_error($ch4));
                    }
                    curl_close($ch4);
                    sleep(10);
                    exit;
                    //$msg="There is no BMT lanes";
                }
            }//end if 2way


        }
        else{
            return false;
        }



    }
    /*public function becon_identify($data,$uid){

        $this->db->select('*');
        $this->db->where('uuid',$data['uuid']);
        $this->db->where('major_id',$data['major_id']);
        $this->db->where('minor_id',$data['minor_id']);
        $query = $this->db->get('beacons');
        $res=$query->result_array();
       //print_r($res);exit;
        $count = $query->num_rows();
        if($count>0){
           $date1=date('Y-m-d 00:00:01');
           $date2=date('Y-m-d 23:59:59');
           $tcid=$res[0]['tc_id'] ;

    //    $this->db->select('*');
    //    $this->db->where('uuid',$data['uuid']);
    //    $this->db->where('major_id',$data['major_id']);
    //    $this->db->where('minor_id',$data['minor_id']);
    //    $lanequery = $this->db->get('toll_charge');
    //    $laneres=$query->result_array();



         $s="select * from transactions where (`transaction_date` BETWEEN '".$date1."' AND '".$date2."') AND tc_id=".$tcid." AND user_id=".$uid."" ;
         $q=$this->db->query($s);
         // print_r($q);
        $c = $q->num_rows();
         if($c>0){
             $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>2,'status_flag'=>0,'user_selsect_status'=>0))->get('bmt_lanes')->result_array();
         // print_r($laneres);exit;
          if(count($laneres)>0){

            $laneidarray=array();
    foreach($laneres as $each){
    $laneidarray[]=$each['lane_id'];
    }

          $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
          $this->db->from('bmt_lane_mapping');
          $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
          $this->db->where('bmt_lane_mapping.tc_id',$tcid);
          $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
          $re=$this->db->get();
          // echo $this->db->last_query();
          $lanemapres = $re->result_array();

           if(count($lanemapres)>0){
          $laneno=$lanemapres[0]['lane_number'];
          $laneid=$lanemapres[0]['lane_id'];
          $tsid=$lanemapres[0]['ts_id'];
          //print_r($lanemapres);
          //send lane no ($laneno)to mobile through push notifications
           $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                       . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                       . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
                $this->db->from('toll_charge');
                $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
                $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
                $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
                $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
                $this->db->where('toll_charge.tc_id',$tcid);
                $this->db->where('user_register.user_id',$uid);
               // $this->db->where('vehicles.default_status','1');
                $this->db->where('vehicles.status_flag','1');
                $this->db->where('vehicles.paid_status','0');
                $this->db->where('vehicles.passing_status','0');
                $this->db->where('user_register.mobile_device_id IS NOT NULL');
                $cq = $this->db->get();
                //echo $this->db->last_query();exit;
                $cres=$cq->result_array();
                echo count($cres);
                if(count($cres)>0){
                $toll_charge=$cres[0]['two_way_charge'];
                $bmtcharge=1;
                $total=$toll_charge+$bmtcharge;
                $data1=$cres[0];
                $vid=$data1['vehicle_id'];
               // print_r($data);
                $insertarr=array(
                       'ts_id'=>$tsid,
                       'tc_id'=>$tcid,
                       'user_id'=>$uid,
                       'type_id'=>$$data1['type_id'],
                       'make_id'=>$data1['make_id'],
                       'model_id'=>$data1['model_id'],
                       'vehicle_id'=>$data1['vehicle_id'],
                       'vehicle_no'=>$data1['vehicle_no'],
                       'lane_id'=>$laneid,
                       'email_id'=>$data1['email_id'],
                       'reg_type'=>$data1['mobile_device_id'],
                       'toll_charge'=>$toll_charge,
                       'bmt_charge'=>$bmtcharge,
                       'total_amount'=>$total,
                       'passing_status'=>'0',
                       'paid_status'=>'1',
                       'transaction_date'=>date('Y-m-d H:i:s')
                   );
                 //pd($insertarr);exit;
                    $this->db->insert('transactions',$insertarr);
                   // echo $this->db->last_query();
                       $id = $this->db->insert_id();
    $myarray=array('total_amount'=>$total);
    return $myarray;


    }else{
      return 5;
    }
         }else{
             return 4;
             //$msg="There is no BMT lanes";
         }
          } else{
              return 4;
             //$msg="There is no BMT lanes";
          }
            // echo "2way";
         }  else{
              $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>1,'status_flag'=>0,'user_selsect_status'=>0))->get('bmt_lanes')->result_array();
       //  echo $this->db->last_query();exit;
         // print_r($laneres);exit;
          if(count($laneres)>0){

          $laneidarray=array();
    foreach($laneres as $each){
    $laneidarray[]=$each['lane_id'];
    }
    //print_r($laneidarray);exit;
          $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
          $this->db->from('bmt_lane_mapping');
          $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
          $this->db->where('bmt_lane_mapping.tc_id',$tcid);
          $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
          $re=$this->db->get();
          // echo $this->db->last_query();
          $lanemapres = $re->result_array();
         //print_r($lanemapres);exit;
         if(count($lanemapres)>0){
          $laneno=$lanemapres[0]['lane_number'];
          $laneid=$lanemapres[0]['lane_id'];
          $tsid=$lanemapres[0]['ts_id'];
          //print_r($lanemapres);exit;
          //send lane no ($laneno)to mobile through push notifications
           $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                       . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                       . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
                $this->db->from('toll_charge');
                $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
                $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
                $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
                $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
                $this->db->where('toll_charge.tc_id',$tcid);
                $this->db->where('user_register.user_id',$uid);
                //$this->db->where('vehicles.default_status','1');
                $this->db->where('vehicles.status_flag','1');
                $this->db->where('vehicles.paid_status','0');
                $this->db->where('vehicles.passing_status','0');
                $this->db->where('user_register.mobile_device_id IS NOT NULL');
                $cq = $this->db->get();
               // echo $this->db->last_query();exit;
                $cres=$cq->result_array();
                //echo $cnt=count($cres);exit;
                if(count($cres)>0){
               // print_r($cres);exit;
                $toll_charge=$cres[0]['one_way_charge'];
                $bmtcharge=1;
                $total=$toll_charge+$bmtcharge;
                $data1=$cres[0];
                $vid=$data1['vehicle_id'];
               // print_r($data);

            $insertarr=array(
                       'ts_id'=>$tsid,
                       'tc_id'=>$tcid,
                       'user_id'=>$uid,
                       'type_id'=>$data1['type_id'],
                       'make_id'=>$data1['make_id'],
                       'model_id'=>$data1['model_id'],
                       'vehicle_id'=>$data1['vehicle_id'],
                       'vehicle_no'=>$data1['vehicle_no'],
                       'lane_id'=>$laneid,
                       'email_id'=>$data1['email_id'],
                       'reg_type'=>$data1['mobile_device_id'],
                       'toll_charge'=>$toll_charge,
                       'bmt_charge'=>$bmtcharge,
                       'total_amount'=>$total,
                        'passing_status'=>'0',
                       'paid_status'=>'1',
                       'transaction_date'=>date('Y-m-d H:i:s')
                   );
             //  return 1;
                // pd($insertarr);exit;
                    $this->db->insert('transactions',$insertarr);
                   // echo $this->db->last_query();
                       $id = $this->db->insert_id();
    $myarray=array('total_amount'=>$total);
    return $myarray;

    }else{

      return 5;
    }

         }else{
             return 4;
             //$msg="There is no BMT lanes";
         }
          } else{
              return 4;
             //$msg="There is no BMT lanes";
          }
                  }


        }
        else{
            return false;
        }



    }*/
    public function becon_identify($uid){
        return 3;
    }
    public function getWallet($uid){

        return 100;
        /* $this->db->select('wallet_amount');
         $this->db->from('wallet');
         $this->db->where('user_id',$uid);
         $re=$this->db->get();

         // echo $this->db->last_query();
         $res = $re->result_array();
         //pd($res);exit;
         if(count($res)>0){
            return $res[0];
         }else{
           return 4;
         }*/
    }
//with out wallet becon and web payment method integration
//start both devices(ios,android)push notifications in one service
    public function beacon_service($data,$uid){
        /*Writen Ramesh for Ringroad service*/
        $delete_data= array(
            'user_id' => $uid
        );
        $this->db->delete('ringroad',$delete_data);
        /*************END**************/
        //  $deviceid='cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e'  ;
        //$msg="Welcome to Taya";
// iosPushNote($deviceid,$msg);
//exit;
        $myarray=array();
        $innerarray=array();
        //echo $onedate=date('Y-m-d 01:00:00');exit;
        // pd($data);exit;
        $deviceres = $this->db->select('*')->where(array('user_id'=>$uid))->get('user_register')->result_array();
        $deviceid=$deviceres[0]['mobile_device_id'];
        $devicetype=$deviceres[0]['device_type'];
        //  $msg="hi how are you";
        //echo  sendNotification($deviceid,$msg, $devicetype);exit;
        $this->db->select('*');
        $this->db->where('uuid',$data['uuid']);
        $this->db->where('major_id',$data['major_id']);
        $this->db->where('minor_id',$data['minor_id']);
        $query = $this->db->get('beacons');
        $res=$query->result_array();
        // print_r($res);exit;
        $count = $query->num_rows();
        if($count>0){
            // $date1=date('Y-m-d 00:00:01');
            // $date2=date('Y-m-d 23:59:59');
            $tcid1=$res[0]['tc_id'];
            $beaconid1=$res[0]['beacon_id'];
            $entrytype=$res[0]['entry_type'];
            if($entrytype=='in'){
                // $url="http://54.255.128.130/demo/bmtservices/uploads/voice/voicemsg.amr";
                //return $returnarray=array('msgcode'=>200);

//   To fetch all reamining beacons with out status
                $this->db->select('*');
                //$this->db->where('uuid !=',$data['uuid']);
                //$this->db->where('major_id !=',$data['major_id']);
                //$this->db->where('minor_id !=',$data['minor_id']);
                $this->db->where('tc_id',$tcid1);
                $this->db->where('beacon_id !=',$beaconid1);
                $this->db->where('entry_type','out');
                $query11 = $this->db->get('beacons');
                //echo $this->db->last_query();exit;
                $res11=$query11->result_array();
                //print_r($res11);exit;
                $count11 = $query11->num_rows();
                if($count11>0){
                    $date1=date('Y-m-d 00:00:01');
                    $date2=date('Y-m-d 23:59:59');
                    $tcid=$res11[0]['tc_id'];
                    $beaconid=$res11[0]['beacon_id'];
                    $entrytype1=$res11[0]['entry_type'];


                    $fromwayres = $this->db->select('`tc_name`, `tc_location`,`from_way_beacon_id`')->where(array('tc_id'=>$tcid,'from_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
                    //echo $this->db->last_query();echo "<br>";
                    //echo "<pre>"; print_r($fromwayres);
                    $towayres = $this->db->select('`tc_name`, `tc_location`,`to_way_beacon_id`')->where(array('tc_id'=>$tcid,'to_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
                    //  echo $this->db->last_query();exit;
                    //echo "<pre>"; print_r(count($towayres));exit;
                    if(count($fromwayres)>0){
                        $way_type=1;
                        $tc_name=$fromwayres[0]['tc_name'];
                        $tc_location=$fromwayres [0]['tc_location'];

                    }else if(count($towayres)>0){
                        $way_type=2;
                        $tc_name=$towayres [0]['tc_name'];
                        $tc_location=$towayres [0]['tc_location'];
                    }
//echo $way_type."==".$tc_name."==".$tc_location;exit;



                    // print_r($data);
                    $lastonehour=date('Y-m-d H:i:s', strtotime('-1 hour'));


//sleep(60);
                    $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                        . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                        . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
                    $this->db->from('toll_charge');
                    $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
                    $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
                    $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
                    $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
                    $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
                    $this->db->where('toll_charge.tc_id',$tcid);
                    $this->db->where('user_register.user_id',$uid);
                    $this->db->where('vehicles.default_status','1');
                    $this->db->where('vehicles.status_flag','1');
                    $this->db->where('vehicles.paid_status','0');
                    $this->db->where('vehicles.passing_status','0');
                    $this->db->where('user_register.mobile_device_id IS NOT NULL');
                    $cq = $this->db->get();
                    //echo $this->db->last_query();exit;
                    $cres=$cq->result_array();
                    $vehiclenum = $cq->num_rows();
                    //echo "<pre>";print_r($cres);exit;
                    if($vehiclenum>0){
                        $q=$this->db->query("select * from transactions where (`transaction_date` BETWEEN '".$date1."' AND '".$date2."') AND tc_id=".$tcid." AND user_id=".$uid." AND paid_status=1") ;
                        $c = $q->num_rows();
                        //print_r($c);
                        if($c>0){ $toll_charge=$cres[0]['two_way_charge']; }else{ $toll_charge=$cres[0]['one_way_charge']; }

                        $bmtcharge=1;
                        $total=$toll_charge+$bmtcharge;

                        $data1=$cres[0];
                        $vid=$data1['vehicle_id'];

                        $ts="select transaction_id from transactions where `transaction_date` >= '".$lastonehour."' AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id=".$vid." AND way_type=".$way_type." AND paid_status=1 ";

                        $tq=$this->db->query($ts);
//echo $this->db->last_query();exit;
                        $tc = $tq->num_rows();

                        if($tc==0){

                            $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                            $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=1";
                            $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                            $pushcount = $pushsql->num_rows();
                            if($pushcount==0){
                                $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>1,'date_sent'=>date('Y-m-d H:i:s'));
                                $this->db->insert('push_status',$insertarr);
                                $msg1 =  "Welcome to ".ucfirst($tc_name). " Tollcenter.";
                                //return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg1 ,'inner'=>$innerarray);
                                // echo "<pre>"; print_r($myarray);exit;
                                $push=sendNotification($deviceid,$msg1, $devicetype);
                                return $returnarray=array('msgcode'=>400);
                            }
//exit;
//beacon map update start
//$beaconsql="select * from beacon_mapping where beacon_id=$beaconid AND mobile_device_id=$deviceid AND entry_type=$entrytype";
                            /*$beres=$this->db->select('*')->where(array('beacon_id'=>$beaconid,'mobile_device_id'=>$deviceid))->get('beacon_mapping')->result_array();
                              print_r($beres);exit;
                            if(count($beres)>0){
                              $this->db->query("UPDATE beacon_mapping SET entry_type = 'in' WHERE beacon_id=".$beaconid." AND mobile_device_id=".$deviceid."");
                            }else{
                            $bearr=array(
                                               'beacon_id'=>$beaconid,
                                               'mobile_device_id'=>$deviceid,
                                               'entry_type'=>$entrytype,
                                               'added_date'=>date('Y-m-d H:i:s')
                                           );
                            $this->db->insert('beacon_mapping',$bearr);
                            }*/
//beacon map update end
                            $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>$way_type,'status_flag'=>0,'user_selsect_status'=>1))->get('bmt_lanes')->result_array();
                            // echo $this->db->last_query();exit;
                            //  print_r($laneres);exit;
                            if(count($laneres)>0){

                                $laneidarray=array();
                                foreach($laneres as $each){
                                    $laneidarray[]=$each['lane_id'];
                                }
//print_r($laneidarray);exit;
                                $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
                                $this->db->from('bmt_lane_mapping');
                                $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
                                $this->db->where('bmt_lane_mapping.tc_id',$tcid);
                                $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
                                $re=$this->db->get();
                                // echo $this->db->last_query();
                                $lanemapres = $re->result_array();
                                // print_r($lanemapres);exit;
                                if(count($lanemapres)>0){

//print_r($tcnamesql);exit;

                                    $laneno=$lanemapres[0]['lane_number'];
                                    $laneid=$lanemapres[0]['lane_id'];
                                    $tsid=$lanemapres[0]['ts_id'];
                                    //print_r($lanemapres);
                                    //send lane no ($laneno)to mobile through push notifications
                                    //   $msg =  "Your Lane is ".$laneno;
                                    //  pushNote($deviceid,$msg);

                                    //$sql = $this->db->query("UPDATE wallet SET wallet_amount = wallet_amount - $total WHERE user_id=".$uid."");
// $vsql = $this->db->query("UPDATE vehicles SET paid_status = '1',passing_status='0' WHERE vehicle_id=".$vid." AND user_id=".$uid."");
                                    $vid=$data1['vehicle_id'];
                                    $typeid=$data1['type_id'];
                                    //echo "select transaction_id from transactions where ts_id=".$tsid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND
                                    // vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0";

                                    $insertarr=array(
                                        'ts_id'=>$tsid,
                                        'tc_id'=>$tcid,
                                        'user_id'=>$uid,
                                        'type_id'=>$data1['type_id'],
                                        'make_id'=>$data1['make_id'],
                                        'model_id'=>$data1['model_id'],
                                        'vehicle_id'=>$data1['vehicle_id'],
                                        'vehicle_no'=>$data1['vehicle_no'],
                                        'lane_id'=>$laneid,
                                        'email_id'=>$data1['email_id'],
                                        'reg_type'=>$data1['mobile_device_id'],
                                        'toll_charge'=>$toll_charge,
                                        'bmt_charge'=>$bmtcharge,
                                        'total_amount'=>$total,
                                        'passing_status'=>0,
                                        'paid_status'=>0,
                                        'transaction_date'=>date('Y-m-d H:i:s')
                                    );
//echo "<pre>"; print_r($data);exit;
                                    $tsq=$this->db->query("select transaction_id from transactions where ts_id=".$tsid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND
      vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0") ;
                                    $tsc = $tsq->result_array();
                                    if(count($tsc)>0)
                                    {
                                        $this->db->query('delete from push_status where user_id = '.$uid.' AND tc_id = '.$tcid.' AND msg_type=6');
                                        $id=$tsc[0]['transaction_id'];
                                    }else{
                                        $this->db->query('delete from push_status where user_id = '.$uid.' AND tc_id = '.$tcid.' AND msg_type=6');
                                        $this->db->insert('transactions',$insertarr);
                                        //echo $this->db->last_query();
                                        $id = $this->db->insert_id();
                                    }

                                    // echo "<pre>"; print_r($tsc);exit;
                                    if($entrytype1=='out'){
                                        $pushlast1=date('Y-m-d H:i:s', strtotime('1 hour'));
                                        $pushquery1="select id from push_status where `date_sent` <= '".$pushlast1."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=6";
                                        $pushsql1=$this->db->query($pushquery1);
//echo $this->db->last_query();
                                        $pushcount1 = $pushsql1->num_rows();

                                        if($pushcount1==0)
                                        {
                                            $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>6,'date_sent'=>date('Y-m-d H:i:s'));
                                            $this->db->insert('push_status',$insertarr);
                                            return $returnarray=array('transaction_id'=>$id,'total_amount'=>$total,'lane_number'=>$laneno,'msgcode'=>200);
                                        }
                                    }

                                    //echo "<pre>"; print_r($myarray);exit;
                                    //  return 1;
                                    //  pd($insertarr);exit;
                                    //    $this->db->insert('transactions',$insertarr);
                                    //echo $this->db->last_query();
                                    //  return $id = $this->db->insert_id();
                                    //   $msg="Transaction Completed.";
                                    //  pushNote($deviceid,$msg);

                                }//end if(count($lanemapres)
                                else{
                                    $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                                    $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=3";
                                    $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                                    $pushcount = $pushsql->num_rows();

                                    if($pushcount==0)
                                    {
                                        $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>3,'date_sent'=>date('Y-m-d H:i:s'));
                                        $this->db->insert('push_status',$insertarr);
                                        $msg="There is no BMT lanes.";
                                        //pushNote($deviceid,$msg);
                                        sendNotification($deviceid,$msg, $devicetype);
                                        //return $myarray=array('user_id'=>$uid);
                                    }
                                    return $returnarray=array('msgcode'=>400);
                                    /*else{
                                     $msg='';
                                   }
                                   return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg ,'inner'=>$innerarray);*/
                                    //echo "<pre>"; print_r($myarray);exit;
                                    // $msg="There is no BMT lanes.";
                                    // pushNote($deviceid,$msg);
                                }//end else (count($lanemapres)
                            }//end  if(count($laneres)
                            else{
                                $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                                $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=3";
                                $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                                $pushcount = $pushsql->num_rows();
                                if($pushcount==0)
                                {
                                    $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>3,'date_sent'=>date('Y-m-d H:i:s'));
                                    $this->db->insert('push_status',$insertarr);
                                    $msg="No toll operators available. Please pay manually.";
                                    //pushNote($deviceid,$msg);
                                    sendNotification($deviceid,$msg, $devicetype);
                                    //return $myarray=array('user_id'=>$uid);
                                }
                                return $returnarray=array('msgcode'=>400);
                                /*else{
                                 $msg='';
                               }
                               return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg ,'inner'=>$innerarray);*/
                                //echo "<pre>"; print_r($myarray);exit;

                                //pushNote($deviceid,$msg);
                            }//end else (count($laneres)
                        }//end ellse($tc>0){
                        else{

                            $msg="You have already done transaction in this way. Try after 24 hours.";
                            //pushNote($deviceid,$msg);
                            sendNotification($deviceid,$msg, $devicetype);
                            //return $myarray=array('inner'=>'','msg'=>$msg);
                        }//end else($tc==0)
                        return $returnarray=array('msgcode'=>400);


                    }//end if(vnum>0)
                    else{
                        // echo "fff"; exit;
                        $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                        $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=2";
                        $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                        $pushcount = $pushsql->num_rows();
                        if($pushcount==0){
                            $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>2,'date_sent'=>date('Y-m-d H:i:s'));
                            $this->db->insert('push_status',$insertarr);
                            $msg="You Donn't have vehicle OR Not set yet default";
//pushNote($deviceid,$msg);
                            sendNotification($deviceid,$msg, $devicetype);
                            // return $myarray=array('user_id'=>$uid);
//pushNote($deviceid,$msg);
                        }
                        return $returnarray=array('msgcode'=>400);
                        /*else{
                          $msg='';
                        }
                        return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg ,'inner'=>$innerarray);*/
//  echo "<pre>"; print_r($myarray);exit;
                    }//end else vno>0
                }//end if($count1>0){
                else{
                    return $returnarray=array('msgcode'=>400);
                }//end ifelse($count1>0){
            }//end if($count>0){
        }//in end
        else{
            // return false;
            return $returnarray=array('msgcode'=>400);
            //echo "<pre>"; print_r($myarray);exit;
        }//end else $count>0
    }
//end both devices(ios,android)push notifications in one service
    public function beacon_method($data,$uid){
		$myarray = $data1 = $innerarray = $finalArray = $finalArray1 = $res = array();
        $catchTollCenterId = $id = $url = "";
        $checkUser = $this->db->query("select * from user_register where user_id='$uid'")->result();
        $authToken = $checkUser['0']->auth_token;
        if(isset($data['major_id']) && isset($data['minor_id'])){
			$this->db->select('*');
            //$this->db->where('uuid',$data['uuid']);
            $this->db->where('major_id',$data['major_id']);
            $this->db->where('minor_id',$data['minor_id']);
            $query = $this->db->get('beacons');
            $res=$query->result_array();
            $count = $query->num_rows();

        }
        else{
			$userId = $data['user_id'];
			if(count($checkUser)== 0){
                $this->rest->response(responseObject(CONFLICT_CODE,'User not exists','',fail,''),CONFLICT_CODE);
            }
            $tollCenterDetails = $this->db->query('select * from toll_center where tc_id ='.$data['toll_id'])->result_array();
            if(count($tollCenterDetails) > 0){
				$tcName = $tollCenterDetails['0']['tc_name'];
            }
            else{
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Cannot detect the road'),CONFLICT_CODE);
            return;
            }
            $count = count($tollCenterDetails);
        }
        //echo $count; exit;
        if($count>0)
        {
            $date1=date('Y-m-d 00:00:01');
            //$date2=date('Y-m-d 23:59:59');
            $date2=date('Y-m-d 00:10:00');
            if(array_key_exists("major_id",$data) && array_key_exists("minor_id",$data)){
                $tcid=$res[0]['tc_id'];
                $beaconid=$res[0]['beacon_id'];
                $fromwayres = $this->db->select('`tc_name`, `tc_location`,`from_way_beacon_id`')->where(array('tc_id'=>$tcid,'from_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
                $towayres = $this->db->select('`tc_name`, `tc_location`,`to_way_beacon_id`')->where(array('tc_id'=>$tcid,'to_way_beacon_id'=>$beaconid))->get('toll_center')->result_array();
                //exit("sds");
                //echo $this->db->last_query();
                //exit;
            }else{
				$tcid=$data['toll_id'];
                $date1=date('Y-m-d 00:00:01');
                //$date2=date('Y-m-d 23:59:59');
                $date2=date('Y-m-d 00:10:00');
                $fromwayres['0']['tc_name'] = $tollCenterDetails['0']['tc_name'];
                $fromwayres['0']['tc_location'] = $tollCenterDetails['0']['tc_location'];
                $fromwayres['0']['from_way_beacon_id'] = $tollCenterDetails['0']['from_way_beacon_id'];
                $towayres['0']['tc_name'] = $tollCenterDetails['0']['tc_name'];
                $towayres['0']['tc_location'] = $tollCenterDetails['0']['tc_location'];
                $towayres['0']['to_way_beacon_id'] = $tollCenterDetails['0']['to_way_beacon_id'];
            }
            if(count($fromwayres)>0)
            {
			    $way_type=1;
                $tc_name=$fromwayres [0]['tc_name'];
                $tc_location=$fromwayres [0]['tc_location'];

            }
            else if(count($towayres)>0)
            {
			    $way_type=2;
                $tc_name=$towayres [0]['tc_name'];
                $tc_location=$towayres [0]['tc_location'];
            }
			//echo $way_type; exit;
            $lastonehour=date('Y-m-d H:i:s', strtotime('-1 hour'));
            // To check whether default vehicle exists or not and to bring toll charge

            $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
            $this->db->from('toll_charge');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
            //$this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
            //$this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
            $this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
            $this->db->where('toll_charge.tc_id',$tcid);
            $this->db->where('user_register.user_id',$uid);
            $this->db->where('vehicles.default_status','1');
            /* $this->db->where('vehicles.status_flag','1');
             $this->db->where('vehicles.paid_status','0');
             $this->db->where('vehicles.passing_status','0'); */
            $this->db->where('user_register.mobile_device_id IS NOT NULL');
            $cq = $this->db->get();
            $cres=$cq->result_array();
            $vehiclenum = $cq->num_rows();
            //echo $this->db->last_query();  
            //echo $vehiclenum; exit;
            if($vehiclenum>0)
            {
				// to check whether the transaction has been made before 10 min or not
                $q=$this->db->query("select * from transactions where transaction_date > date_sub(now(), interval 2 minute) AND tc_id=".$tcid." AND user_id=".$uid." AND paid_status=1");
                $c = $q->num_rows();

                // For original purpose
                /*if($c>0)
                {
                  $toll_charge=$cres[0]['two_way_charge']-$cres[0]['one_way_charge'];
                }
                else
                {
                  $toll_charge=$cres[0]['one_way_charge'];
                }*/


                $toll_charge=$cres[0]['one_way_charge'];
                $total=$toll_charge+BMT_CHARGE;
                $data1=$cres[0];
                $vid=$data1['vehicle_id'];
                //echo $total; exit;
                // To check whether the payment has made in same way if payment had not done in the previous step

                //$ts="select transaction_id from transactions where `transaction_date` >= '".$lastonehour."' AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id=".$vid." AND way_type=".$way_type." AND paid_status=1 ";
                $ts="select transaction_id from transactions where `transaction_date` >= date_sub(now(), interval 1 minute) AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id=".$vid." AND way_type=".$way_type." AND paid_status=1 ";
                $tq=$this->db->query($ts);
                $tc = $tq->num_rows();
                //echo $tc; exit;
                if($tc==0)
                {
                    // To check whether toll operator is logged in or not in the lane that user is travelling

                    $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>$way_type,'status_flag'=>0,'user_selsect_status'=>1))->get('bmt_lanes')->result_array();
                   //echo $this->db->last_query(); exit;
                    if(count($laneres)>0)
                    {
                        $laneidarray=array();
                        foreach($laneres as $each)
                        {
                            $laneidarray[]=$each['lane_id'];
                        }

                        $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
                        $this->db->from('bmt_lane_mapping');
                        $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
                        $this->db->where('bmt_lane_mapping.tc_id',$tcid);
                        $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
                        $re=$this->db->get();

                        $lanemapres = $re->result_array();
                       //echo $this->db->last_query();
                        //~ echo count($lanemapres); 
                       // exit;
                        if(count($lanemapres)>0)
                        {
							// Main testing do here
                            // To insert data if user not exists in transactions table

                            $laneno=$lanemapres[0]['lane_number'];
                            $laneid=$lanemapres[0]['lane_id'];
                            $order_id = rand('123456', '999999');
                            $tsid=$lanemapres[0]['ts_id'];
                            $vid=$data1['vehicle_id'];
                            $typeid=$data1['type_id'];
                            $insertarr=array(
                                'ts_id'=>$tsid,
                                'tc_id'=>$tcid,
                                'user_id'=>$uid,
                                'type_id'=>$data1['type_id'],
                                'make_id'=>$data1['make_id'],
                                'model_id'=>$data1['model_id'],
                                'vehicle_id'=>$data1['vehicle_id'],
                                'vehicle_no'=>$data1['vehicle_no'],
                                'lane_id'=>$laneid,
                                'email_id'=>$data1['email_id'],
                                'reg_type'=>$data1['mobile_device_id'],
                                'toll_charge'=>$toll_charge,
                                'bmt_charge'=>BMT_CHARGE,
                                'total_amount'=>$total,
                                'passing_status'=>0,
                                'paid_status'=>0,
                                'way_type'=>$way_type,
                                'transaction_date'=>date('Y-m-d H:i:s')
                            );
                            //~ $tsq=$this->db->query("select transaction_id from transactions where ts_id=".$tsid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0") ;
                            //~ $tsc = $tsq->result_array();
                            //echo $this->db->last_query(); exit;
                            //~ if(count($tsc)==0)
                            //~ {
								$this->db->query('delete from push_status where user_id = '.$uid.' AND tc_id = '.$tcid.' AND msg_type=6');
                                $this->db->insert('transactions',$insertarr);
                                $id = $this->db->insert_id();
							//~ }else{
								//~ $q = $this->db->query("select * from transactions where user_id=".$uid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0")->result_array();
								//~ $id = $q['0']['transaction_id'];
							//~ }
                        }
                        else
                        {
                                $msg="No toll operators available. Please pay manually.";
                                return $msg;

                        }//end else (count($lanemapres)
                        $url = 'http://bookmytoll.com/payment?total_amount='.$total.'&transaction_id='.$id.'&user_id='.$uid.'&lane_number=1&Authtoken='.$authToken;
                        return $returnarray=array('transaction_id'=>$id,'total_amount'=>$total,'lane_number'=>$laneno,
                                'html_content'=>$url,'payment_flag'=>true,'msgcode'=>200);
                        
                    }//end  if(count($laneres)
                    else
                    {
                        $msg="No toll operators available. Please pay manually.";
                        return $msg;
                    }
                }
                else
                {
                    /*Checkin for trasation is done with in last 10 min are not*/
                    // Main testing do here
                    $ts="select transaction_id from transactions where `transaction_date` >= date_sub(now(), interval 1 minute) AND `transaction_date` < now() AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id=".$vid." AND way_type=".$way_type." AND paid_status=1";
                    $tq=$this->db->query($ts);
                    $tc = $tq->num_rows();
                    if($tc)
                    {
                        $msg="You have already done transaction in this way. Try after 1 Minutes.";
                        return $msg;
                    }

                }//end else($tc==0)
                $msg = "123";
                return $returnarray=array('msgcode'=>MY_CODE,'msg'=>$msg);
            }//end if(vnum>0)
            else
            {
                $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=2";
                $pushsql=$this->db->query($pushquery);

                $pushcount = $pushsql->num_rows();
                if($pushcount==0)
                {
                    $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>2,'date_sent'=>date('Y-m-d H:i:s'));
                    $this->db->insert('push_status',$insertarr);
                    $msg="You Don't have vehicle OR Not set yet default";
                    pushNote($deviceid,$msg);
                }
                return $returnarray=array('msgcode'=>400);
            }//end else vno>0

        }//end if($count>0){
        else
        {
            return $returnarray=array('msgcode'=>400);
        }
    }
//becon paid end
    public function latlong_method($data,$uid){
        $center_lat=$data['latitude'];
        $center_lng=$data['longitude'];
        $radius=0.5;//500 meters
        $myarray=array();
        $innerarray=array();
        //echo $onedate=date('Y-m-d 01:00:00');exit;
        //pd($data);exit;
        $deviceres = $this->db->select('*')->where(array('user_id'=>$uid))->get('user_register')->result_array();
        $deviceid=$deviceres[0]['mobile_device_id'];
        // echo  pushNote($deviceid,'dff');exit;
        // To get in miles 3959
        // To get in kilometers 6371
        $fromsql = sprintf("SELECT tc_id, tc_name,tc_location, lat, lng, "
            . "( 6371 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) "
            . "AS distance FROM toll_center HAVING distance < '%s' ORDER BY distance",
            mysql_real_escape_string($center_lat),
            mysql_real_escape_string($center_lng),
            mysql_real_escape_string($center_lat),
            mysql_real_escape_string($radius));
//$result = mysql_query($query);

        /* $fromsql=  "SELECT tc_id,tc_name,lat, lng, SQRT(
          POW(69.1 * (lat - ".$center_lat."), 2) +
          POW(69.1 * (".$center_lng." - lng) * COS(lat / 57.3), 2)) AS distance
      FROM toll_center HAVING distance < 0.5 ORDER BY distance;";   */
        $fromsqlquery = sprintf($fromsql);
        $fromquery=$this->db->query($fromsqlquery);
        $fromres = $fromquery->result_array();
        // $count=count($res);
        // echo $this->db->last_query();
        //echo "<pre>";print_r($fromres);


        $tosql=  sprintf("SELECT tc_id, tc_name,tc_location, to_lat, to_lag, "
            . "( 6371 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) "
            . "AS distance FROM toll_center HAVING distance < '%s' ORDER BY distance",
            mysql_real_escape_string($center_lat),
            mysql_real_escape_string($center_lng),
            mysql_real_escape_string($center_lat),
            mysql_real_escape_string($radius));

        $tosqlquery = sprintf($tosql);
        $toquery=$this->db->query($tosqlquery);
        $tores = $toquery->result_array();
        // $count=count($res);
        //echo $this->db->last_query();
        //echo "<pre>";print_r($tores);exit;
        if(count($fromres)>0){
            $count=count($fromres);
            $tcid=$fromres[0]['tc_id'];
            $tc_name=$fromres[0]['tc_name'];
            $tc_location=$fromres[0]['tc_location'];
            $lat=$fromres[0]['lat'];
            $lang=$fromres[0]['lng'];
        }else if(count($tores)>0){
            $count=count($tores);
            $tcid=$tores[0]['tc_id'];
            $tc_name=$tores[0]['tc_name'];
            $tc_location=$tores[0]['tc_location'];
            $lat=$tores[0]['to_lat'];
            $lang=$tores[0]['to_lag'];
        } else{
            $count=0;
        }
//   echo $tcid;
        // echo $count;exit;
        /*
        $this->db->select('*');
        $this->db->where('uuid',$data['uuid']);
        $this->db->where('major_id',$data['major_id']);
        $this->db->where('minor_id',$data['minor_id']);
        $query = $this->db->get('beacons');
        $res=$query->result_array();
       //print_r($res);exit;*/
        //echo  $count = $query->num_rows();exit;
        if($count>0){

            $date1=date('Y-m-d 00:00:01');
            $date2=date('Y-m-d 23:59:59');
            //$tcid=$res[0]['tc_id'];
            //$beaconid=$res[0]['beacon_id'];

            $fromwayres = $this->db->select('way')->where('tc_id',$tcid)->like('lat',$lat)->like('lng',$lang) ->get('latlng')->result_array();
            // echo $this->db->last_query();
            //  echo "<pre>"; print_r($fromwayres);
            $towayres = $this->db->select('way')->where('tc_id',$tcid)->like('lat',$lat)->like('lng',$lang) ->get('latlng')->result_array();
            // echo "<pre>"; print_r(count($towayres));exit;
            if(count($fromwayres)>0){
                $way_type=$fromwayres[0]['way'];

            }else if(count($towayres)>0){
                $way_type=$towayres[0]['way'];
            }
//echo $way_type."==".$tc_name."==".$tc_location;exit;



            // print_r($data);
            $lastonehour=date('Y-m-d H:i:s', strtotime('-1 hour'));


//sleep(60);
            $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
                . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
            $this->db->from('toll_charge');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
            $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
            $this->db->where('toll_charge.tc_id',$tcid);
            $this->db->where('user_register.user_id',$uid);
            $this->db->where('vehicles.default_status','1');
            $this->db->where('vehicles.status_flag','1');
            $this->db->where('vehicles.paid_status','0');
            $this->db->where('vehicles.passing_status','0');
            $this->db->where('user_register.mobile_device_id IS NOT NULL');
            $cq = $this->db->get();
            //echo $this->db->last_query();exit;
            $cres=$cq->result_array();
            $vehiclenum = $cq->num_rows();
            /// echo "<pre>";print_r($cres);exit;
            if($vehiclenum>0){


                $q=$this->db->query("select * from transactions where (`transaction_date` BETWEEN '".$date1."' AND '".$date2."') AND tc_id=".$tcid." AND user_id=".$uid." AND paid_status=1") ;
                $c = $q->num_rows();
                //print_r($c);
                if($c>0){ $toll_charge=$cres[0]['two_way_charge']; }else{ $toll_charge=$cres[0]['one_way_charge']; }

                $bmtcharge=1;
                $total=$toll_charge+$bmtcharge;

                $data1=$cres[0];
                $vid=$data1['vehicle_id'];

                $ts="select transaction_id from transactions where `transaction_date` >= '".$lastonehour."' AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id=".$vid." AND way_type=".$way_type." AND paid_status=1 ";

                $tq=$this->db->query($ts);
//echo $this->db->last_query();exit;
                $tc = $tq->num_rows();

                if($tc==0){

                    $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                    $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=1";
                    $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                    $pushcount = $pushsql->num_rows();
                    if($pushcount==0){
                        $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>1,'date_sent'=>date('Y-m-d H:i:s'));
                        $this->db->insert('push_status',$insertarr);
                        $msg1 =  "Welcome to ".$tc_name. " Tollcenter.";
                        //return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg1 ,'inner'=>$innerarray);
                        // echo "<pre>"; print_r($myarray);exit;
                        $push=pushNote($deviceid,$msg1);
                    }
//exit;

                    $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>$way_type,'status_flag'=>0,'user_selsect_status'=>1))->get('bmt_lanes')->result_array();
                    // echo $this->db->last_query();exit;
                    // print_r($laneres);exit;
                    if(count($laneres)>0){

                        $laneidarray=array();
                        foreach($laneres as $each){
                            $laneidarray[]=$each['lane_id'];
                        }
//print_r($laneidarray);exit;
                        $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
                        $this->db->from('bmt_lane_mapping');
                        $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
                        $this->db->where('bmt_lane_mapping.tc_id',$tcid);
                        $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
                        $re=$this->db->get();
                        // echo $this->db->last_query();
                        $lanemapres = $re->result_array();
                        //  print_r($lanemapres);exit;
                        if(count($lanemapres)>0){


//print_r($tcnamesql);exit;

                            $laneno=$lanemapres[0]['lane_number'];
                            $laneid=$lanemapres[0]['lane_id'];
                            $tsid=$lanemapres[0]['ts_id'];
                            //print_r($lanemapres);
                            //send lane no ($laneno)to mobile through push notifications
                            //   $msg =  "Your Lane is ".$laneno;
                            //  pushNote($deviceid,$msg);

                            //$sql = $this->db->query("UPDATE wallet SET wallet_amount = wallet_amount - $total WHERE user_id=".$uid."");
// $vsql = $this->db->query("UPDATE vehicles SET paid_status = '1',passing_status='0' WHERE vehicle_id=".$vid." AND user_id=".$uid."");
                            $vid=$data1['vehicle_id'];
                            $typeid=$data1['type_id'];
                            //echo "select transaction_id from transactions where ts_id=".$tsid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND
                            // vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0";


                            $insertarr=array(
                                'ts_id'=>$tsid,
                                'tc_id'=>$tcid,
                                'user_id'=>$uid,
                                'type_id'=>$data1['type_id'],
                                'make_id'=>$data1['make_id'],
                                'model_id'=>$data1['model_id'],
                                'vehicle_id'=>$data1['vehicle_id'],
                                'vehicle_no'=>$data1['vehicle_no'],
                                'lane_id'=>$laneid,
                                'email_id'=>$data1['email_id'],
                                'reg_type'=>$data1['mobile_device_id'],
                                'toll_charge'=>$toll_charge,
                                'bmt_charge'=>$bmtcharge,
                                'total_amount'=>$total,
                                'passing_status'=>0,
                                'paid_status'=>0,
                                'transaction_date'=>date('Y-m-d H:i:s')
                            );
                            $tsq=$this->db->query("select transaction_id from transactions where ts_id=".$tsid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND
      vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0") ;
                            $tsc = $tsq->result_array();
                            if(count($tsc)>0)
                            {
                                $this->db->query('delete from push_status where user_id = '.$uid.' AND tc_id = '.$tcid.' AND msg_type=6');
                                $id=$tsc[0]['transaction_id'];
                            }else{
                                $this->db->query('delete from push_status where user_id = '.$uid.' AND tc_id = '.$tcid.' AND msg_type=6');
                                $this->db->insert('transactions',$insertarr);
                                //echo $this->db->last_query();
                                $id = $this->db->insert_id();
                            }

                            $pushlast1=date('Y-m-d H:i:s', strtotime('1 hour'));
                            $pushquery1="select id from push_status where `date_sent` <= '".$pushlast1."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=6";
                            $pushsql1=$this->db->query($pushquery1);
//echo $this->db->last_query();
                            $pushcount1 = $pushsql1->num_rows();

                            if($pushcount1==0)
                            {
                                $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>6,'date_sent'=>date('Y-m-d H:i:s'));
                                $this->db->insert('push_status',$insertarr);
                                return $returnarray=array('transaction_id'=>$id,'total_amount'=>$total,'lane_number'=>$laneno);
                            }


                            //echo "<pre>"; print_r($myarray);exit;
                            //  return 1;
                            //  pd($insertarr);exit;
                            //    $this->db->insert('transactions',$insertarr);
                            //echo $this->db->last_query();
                            //  return $id = $this->db->insert_id();
                            //   $msg="Transaction Completed.";
                            //  pushNote($deviceid,$msg);

                        }//end if(count($lanemapres)
                        else{
                            $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                            $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=3";
                            $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                            $pushcount = $pushsql->num_rows();

                            if($pushcount==0)
                            {
                                $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>3,'date_sent'=>date('Y-m-d H:i:s'));
                                $this->db->insert('push_status',$insertarr);
                                $msg="There is no BMT lanes.";
                                pushNote($deviceid,$msg);
                                //return $myarray=array('user_id'=>$uid);
                            }
                            /*else{
                             $msg='';
                           }
                           return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg ,'inner'=>$innerarray);*/
                            //echo "<pre>"; print_r($myarray);exit;
                            // $msg="There is no BMT lanes.";
                            // pushNote($deviceid,$msg);
                        }//end else (count($lanemapres)
                    }//end  if(count($laneres)
                    else{
                        $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                        $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=3";
                        $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                        $pushcount = $pushsql->num_rows();
                        if($pushcount==0)
                        {
                            $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>3,'date_sent'=>date('Y-m-d H:i:s'));
                            $this->db->insert('push_status',$insertarr);
                            $msg="No toll operators available. Please pay manually.";
                            pushNote($deviceid,$msg);
                            //return $myarray=array('user_id'=>$uid);
                        }
//exit;
                        /*else{
                         $msg='';
                       }
                       return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg ,'inner'=>$innerarray);*/
                        //echo "<pre>"; print_r($myarray);exit;

                        //pushNote($deviceid,$msg);
                    }//end else (count($laneres)
                }//end ellse($tc>0){
                else{

                    $msg="You have already done transaction in this way. Try after 24 hours.";
                    pushNote($deviceid,$msg);
                    //return $myarray=array('inner'=>'','msg'=>$msg);
                }//end else($tc==0)

            }//end if(vnum>0)
            else{
                // echo "fff"; exit;
                $pushlast=date('Y-m-d H:i:s', strtotime('1 hour'));
                $pushquery="select id from push_status where `date_sent` <= '".$pushlast."' AND tc_id=".$tcid." AND user_id=".$uid." AND msg_type=2";
                $pushsql=$this->db->query($pushquery);
//echo $this->db->last_query();
                $pushcount = $pushsql->num_rows();
                if($pushcount==0){
                    $insertarr=array('tc_id'=>$tcid,'user_id'=>$uid,'msg_type'=>2,'date_sent'=>date('Y-m-d H:i:s'));
                    $this->db->insert('push_status',$insertarr);
                    $msg="You Donn't have vehicle OR Not set yet default";
                    pushNote($deviceid,$msg);
                    // return $myarray=array('user_id'=>$uid);
//pushNote($deviceid,$msg);
                }
                /*else{
                  $msg='';
                }
                return $myarray=array('number'=>1,'deviceid'=>$deviceid,'msg'=>$msg ,'inner'=>$innerarray);*/
//  echo "<pre>"; print_r($myarray);exit;
            }//end else vno>0

        }//end if($count>0){
        else{
            // pushNote($deviceid,'hi');
            return 4;
            //echo "<pre>"; print_r($myarray);exit;
        }//end else $count>0



    }
//start web payment
    public function get_tollcenter($userid){
        $result = $this->db->select('`tc_id`, `tc_name`, `tc_location`')->where(array('status_flag'=>0))->get('toll_center')->result_array();
        // pd($result);
        if(count($result)){
            $result_array = $result;
        }else{
            $result_array=4;
        }
        return $result_array;
    }
    public function get_wayt_ypes_tc($data,$userid){
        $tcid=$data['tc_id'];

        $result = $this->db->select('`tc_id`, `from_way_location`, `to_way_location`')->where(array('status_flag'=>0,'tc_id'=>$tcid))->get('toll_center')->result_array();
        if(count($result)){
            $result_array = $result;
        }
        return $result_array;
    }

    public function get_lanes_by_toll($data,$uid){
        // echo "<pre>"; print_r($data);exit;
        $myarray=array();
        $date1=date('Y-m-d 00:00:01');
        $date2=date('Y-m-d 23:59:59');
        $tcid=$data['tc_id'];
        $way_type=$data['way_type'];
        $lastonehour=date('Y-m-d H:i:s', strtotime('-1 hour'));
        /*$ts="select transactions.transaction_id from transactions JOIN bmt_lanes ON bmt_lanes.tc_id = transactions.tc_id where
          transactions.transaction_date >= '".$lastonehour."' AND transactions.tc_id=".$tcid." AND transactions.user_id=".$uid." AND bmt_lanes.way_type=".$way_type."
              AND transactions.paid_status=1";*/

        $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
            . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,'
            . 'toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
        $this->db->from('toll_charge');
        $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
        $this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
        $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
        $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
        $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
        $this->db->where('toll_charge.tc_id',$tcid);
        $this->db->where('user_register.user_id',$uid);
        $this->db->where('vehicles.default_status','1');
        $this->db->where('vehicles.status_flag','1');
        //$this->db->where('vehicles.paid_status','0');
        //$this->db->where('vehicles.passing_status','0');
        //$this->db->where('user_register.mobile_device_id IS NULL', null, false);
        $cq = $this->db->get();
        //echo $this->db->last_query();exit;
        $cres=$cq->result_array();
        $vehiclenum = $cq->num_rows();
        //echo "<pre>";print_r($vehiclenum);exit;
        if($vehiclenum>0){
            $data1=$cres[0];
            $vid=$data1['vehicle_id'];

            $q=$this->db->query("select * from transactions where (`transaction_date` BETWEEN '".$date1."' AND '".$date2."') AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id=".$vid." AND way_type=".$way_type." AND paid_status=1") ;
            //echo $this->db->last_query();exit;
            $c = $q->num_rows();

            if($c>0){ $toll_charge=$cres[0]['two_way_charge']; }else{ $toll_charge=$cres[0]['one_way_charge']; }

            $bmtcharge=1;
            $total=$toll_charge+$bmtcharge;



            $ts="select transaction_id from transactions where `transaction_date` >= '".$lastonehour."' AND tc_id=".$tcid." AND user_id=".$uid." AND vehicle_id=".$vid." AND way_type=".$way_type." AND paid_status=1";
            $tq=$this->db->query($ts);
//echo $this->db->last_query();exit;
            $tc = $tq->num_rows();

            if($tc==0){

                $laneres = $this->db->select('*')->where(array('tc_id'=>$tcid,'way_type'=>$way_type,'status_flag'=>0,'user_selsect_status'=>1))->get('bmt_lanes')->result_array();
                //  echo $this->db->last_query();exit;
                // print_r($laneres);exit;
                if(count($laneres)>0){

                    $laneidarray=array();
                    foreach($laneres as $each){
                        $laneidarray[]=$each['lane_id'];
                    }
//print_r($laneidarray);exit;
                    $this->db->select('bmt_lane_mapping.ts_id,bmt_lane_mapping.lane_id,bmt_lanes.lane_number');
                    $this->db->from('bmt_lane_mapping');
                    $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
                    $this->db->where('bmt_lane_mapping.tc_id',$tcid);
                    $this->db->where_in('bmt_lane_mapping.lane_id', $laneidarray);
                    $re=$this->db->get();
                    // echo $this->db->last_query();exit;
                    $lanemapres = $re->result_array();
                    //  print_r($lanemapres);exit;
                    if(count($lanemapres)>0){
//print_r($tcnamesql);exit;
                        $laneno=$lanemapres[0]['lane_number'];
                        $laneid=$lanemapres[0]['lane_id'];
                        $tsid=$lanemapres[0]['ts_id'];
                        $vid=$data1['vehicle_id'];
                        $typeid=$data1['type_id'];
                        //echo "select transaction_id from transactions where ts_id=".$tsid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND
                        // vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0";


                        $insertarr=array(
                            'ts_id'=>$tsid,
                            'tc_id'=>$tcid,
                            'user_id'=>$uid,
                            'type_id'=>$data1['type_id'],
                            'make_id'=>$data1['make_id'],
                            'model_id'=>$data1['model_id'],
                            'vehicle_id'=>$data1['vehicle_id'],
                            'vehicle_no'=>$data1['vehicle_no'],
                            'lane_id'=>$laneid,
                            'way_type'=>$way_type,
                            'email_id'=>$data1['email_id'],
                            'reg_type'=>$data1['mobile_device_id'],
                            'toll_charge'=>$toll_charge,
                            'bmt_charge'=>$bmtcharge,
                            'total_amount'=>$total,
                            'passing_status'=>0,
                            'paid_status'=>0,
                            'transaction_date'=>date('Y-m-d H:i:s')
                        );
                        $tsq=$this->db->query("select transaction_id from transactions where ts_id=".$tsid." AND tc_id=".$tcid." AND user_id=".$uid." AND type_id=".$typeid." AND
      vehicle_id=".$vid." AND lane_id=".$laneid." AND total_amount=".$total." AND paid_status=0") ;
                        $tsc = $tsq->result_array();
                        if(count($tsc)>0)
                        {
                            $id=$tsc[0]['transaction_id'];
                        }else{
                            $this->db->insert('transactions',$insertarr);
                            //echo $this->db->last_query();
                            $id = $this->db->insert_id();
                        }

                        $returnarray=array('transaction_id'=>$id,'total_amount'=>$total,'lane_number'=>$laneno);
                        $msg =  "Your Lane is ".$laneno;
                        return $myarray=array('inner'=>$returnarray,'msg'=>$msg);
                        //echo "<pre>"; print_r($myarray);exit;
                    }//end if(count($lanemapres)
                    else{
                        $msg="There is no BMT lanes.";
                        return $myarray=array('inner'=>'','msg'=>$msg);
                    }//end else (count($lanemapres)
                }//end  if(count($laneres)
                else{

                    $msg="No toll operators available. Please pay manually.";
                    return $myarray=array('inner'=>'','msg'=>$msg);
                }//end else (count($laneres)
            }  //end if($tc==0)
            else{

                $msg="You have already done transaction in this way. Try after 24 hours.";
                return $myarray=array('inner'=>'','msg'=>$msg);
            }//end else($tc==0)

        }//end if($vehiclenum>0)
        else{
            $msg="You Donn't have vehicle OR Not set yet default";
            return $myarray=array('inner'=>'','msg'=>$msg);
        }//end else vno>0


    }//end get_lanes_by_toll
    
    public function insert_order($data,$uid){
        $orderid=$data['order_id'];
        $date=date('Y-m-d H:i:s');

        $q=$this->db->query("select * from transactions where transaction_id=".$orderid." or reference_id=".$orderid."  AND paid_status=0") ;
        $r = $q->result_array();
        $c = $q->num_rows();
        $vid=$r[0]['vehicle_id'];
        if($orderid == $r['0']['reference_id']){
            $orderid = $r['0']['transaction_id'];
        }

        if($c>0){
            $tsql=$this->db->query("UPDATE transactions SET paid_status=1, transaction_date='".$date."' WHERE transaction_id=".$orderid." AND user_id=".$uid."");
            $vsql = $this->db->query("UPDATE vehicles SET paid_status = '1', passing_status='0' WHERE vehicle_id=".$vid." AND user_id=".$uid."");
            $insertarr=array(
                'order_id'=>$data['order_id'],
                'user_id'=>$uid,
                'tracking_id'=>$data['tracking_id'],
                'order_status'=>$data['order_status'],
                'amount'=>$data['amount'],
                'transaction_date'=>$date
            );

            $this->db->insert('orders',$insertarr);
            $id = $this->db->insert_id();
            $this->db->query("delete from ringroad where user_id=".$uid) ;
            return $id;

        }

    }


    public function ringroad($data,$uid)
    {
        $deviceres = $this->db->select('*')->where(array('user_id'=>$uid))->get('user_register')->result_array();
        $deviceid=$deviceres[0]['mobile_device_id'];
        $devicetype=$deviceres[0]['device_type'];
        $m1 = $m2 = $existUser = array();
        $enterdCityId = $exitCityId = '';
        if(array_key_exists("major_id",$data) && array_key_exists("minor_id",$data)){
			$user = $this->db->select('*')->where('user_id',$uid)->get('ringroad')->num_rows();
			$major = $data['major_id'];
			$minor = $data['minor_id'];
			$where_data1 = array(
				'user_id' => $uid,
				'status' => 0
			);
			$outCount = $this->db->select('*')->where($where_data1)->get('ringroad')->result_array();
			if(count($query1) == 0 && $query['0']['entry_type'] == 'OUT'){
				return $msg = "User entry not detected";
			}
	//   To check whether entry type is already inserted or not
			$where_data = array(
				'major =' => $data['major_id'],
				'minor =' => $data['minor_id'],
				'user_id' => $uid
			);
			$existUser = $this->db->select('*')->where($where_data)->get('ringroad')->result_array();
			$CI =& get_instance();
			$tollCenterDetails = $CI->db->select('*');
			$CI->db->from('beacons');
			$CI->db->where('major_id', $data['major_id']);
			$CI->db->where('minor_id', $data['minor_id']);
			$query = $CI->db->get()->result_array();
			
			if($query['0']['entry_type'] == 'OUT'){
				$status = 0;
			}else{
				$status = 1;
			}
			
			// To check whether entry to that particular is detected or not and update timestamp if already detected and when entry not detected
			
			
			$isEntryDetected = $CI->db->select('*');
			$CI->db->from('ringroad');
			$CI->db->where('user_id', $uid);
			$CI->db->where('status', 1);
			$query1 = $CI->db->get()->result_array();
			if(count($query1) > 0  && $query['0']['entry_type'] != 'OUT'){
				$insert_data = array(
					'major' => $data['major_id'],
					'minor' => $data['minor_id']
				);
				$this->db->where('id',$query1['0']['id']);
				$this->db->set('created_on', date('Y-m-d H:i:s'));
			  //  $this->db->update('ringroad',$insert_data);
				 //~ $tollCenterLocation = $this->db->query('select * from beacons b join toll_center tc on b.tc_id = tc.tc_id
		//~ where b.major_id ="'.$major.'" AND b.minor_id="'.$minor.'"')->result();
				//~ $data['msg'] = "Welcome to ".$tollCenterLocation['0']->tc_location." Ringroad";
				//~ return $data;
				
			}
			
			if(count($query1) == 0 && $query['0']['entry_type'] == 'OUT'){
				return $msg = "User entry not detected";
			}
			
	// To insert entry type
			if($user==0)
			{

				$insert_data = array(
					'major' => $data['major_id'],
					'minor' => $data['minor_id'],
					'user_id' => $uid,
					'status' => $status
				);
				$this->db->insert('ringroad', $insert_data);

				// To fetch tollgate name

				$tollCenterLocation = $this->db->query('select * from beacons b join toll_center tc on b.tc_id = tc.tc_id
		where b.major_id ="'.$major.'" AND b.minor_id="'.$minor.'"')->result();
				$data['msg'] = "Welcome to ".$tollCenterLocation['0']->tc_location." Ringroad";
				return $data;

			}
			
			if($user> 0 && $query['0']['entry_type'] == 'OUT' && count($outCount) == 0 ){
					$eToll = $this->db->query('select * from ringroad where status=1 AND user_id='.$uid)->result_array();
				
				$eTollCenterDetails = $CI->db->select('*');
			$CI->db->from('beacons');
			$CI->db->where('major_id', $eToll['0']['major']);
			$CI->db->where('minor_id', $eToll['0']['minor']);
			$query4 = $CI->db->get()->result_array();
			$eTollId = $query4['0']['tc_id'];
			$exTollId = $query['0']['tc_id'];
			if($eTollId != $exTollId){
				
	//   	 TO insert exit type
				if($query['0']['entry_type'] == 'OUT'){
					$status = 0;
				}else{
					$status = 1;
				}
				
				
				$where_data1 = array(
					'user_id' => $uid,
					'status' => 0

				);
				$insertStatus = $this->db->select('*')->where($where_data1)->get('ringroad')->result_array();
				if(empty($insertStatus)){
					$insert_data = array(
						'major' => $data['major_id'],
						'minor' => $data['minor_id'],
						'user_id' => $uid,
						'status' => $status
					);
					$this->db->insert('ringroad', $insert_data);

					// 	To fetch entry type
					$CI =& get_instance();
					$tollCenterDetails = $CI->db->select('*');
					$CI->db->from('ringroad');
					$CI->db->join('beacons','ringroad.major = beacons.major_id');
					$CI->db->where(array('user_id'=> $uid,'status'=>'1'));
					$query1 = $CI->db->get()->result_array();
					
					if(count($query1) == 0){
						$CI =& get_instance();
						$tollCenterDetails = $CI->db->select('*');
						$CI->db->from('ringroad');	
						$CI->db->where(array('user_id'=> $uid,'status'=>'1'));
						$query1 = $CI->db->get()->result_array();
					}
					$enterdTollGateId = $query1['0']['tc_id'];
					// 	To send payment charges in response
					if($enterdTollGateId){
						$vehicle_id = $data['vehicle_id'];
						$from_tc_id =  $enterdTollGateId;
						$to_tc_id = $query[0]['tc_id'];
						$table_name = 'outerringroad_charge orrc';
						$fromTcInterchangeNumber = $this->db->query("
						select otc.orr_toll_center_id,otc.interchange_number,otc.interchange_name,otc.city_id as toll_city_id,tc.*  from orr_toll_center otc
						join toll_center tc on otc.interchange_name = tc.tc_location where tc.tc_id=$from_tc_id
						")->result_array();
						
						//echo $this->db->last_query();
						$toTcInterchangeNumber = $this->db->query("
						select otc.orr_toll_center_id,otc.interchange_number,otc.interchange_name,otc.city_id as toll_city_id,tc.* from orr_toll_center otc
						join toll_center tc on otc.interchange_name = tc.tc_location where tc.tc_id=$to_tc_id
						")->result_array();
						//echo $this->db->last_query();
						//exit;
						$entryCity = $this->db->query("
						select * from toll_center tc
						join city c on tc.city_id = c.id where tc.tc_id=$from_tc_id
						")->result_array();
						
						$exitCity = $this->db->query("
						select * from toll_center tc
						join city c on tc.city_id = c.id where tc.tc_id=$to_tc_id
						")->result_array();
						
						$fromInterChangeNumber = $fromTcInterchangeNumber['0']['interchange_number'];
						$toInterChangeNumber = $toTcInterchangeNumber['0']['interchange_number'];
						
						$enteredTollCityId = $fromTcInterchangeNumber['0']['toll_city_id'];
						$exitTollCityId = $toTcInterchangeNumber['0']['toll_city_id'];
						$entryCityId = $entryCity['0']['city_id'];
						$exitCityId = $exitCity['0']['city_id'];
                        if(($enteredTollCityId == $entryCityId) && ($exitCityId == $exitTollCityId) && ($enteredTollCityId == $exitTollCityId)){
								//~ $charges = $this->db->query('select * from outerringroad_charge orrc join vehicle_model vm on orrc.type_of_vehicle_id = vm.type_id
							//~ join vehicles v on vm.model_id = v.model_id where v.vehicle_id ="'.$vehicle_id.'" AND orrc.from_tc_id="'.$from_tc_id.'" AND orrc.to_tc_id="'.$to_tc_id.'"')->result();
							$charges = $this->db->query('select * from outerringroad_charge orrc 
							join vehicle_model vm on orrc.type_of_vehicle_id = vm.type_id
							join vehicles v on vm.model_id = v.model_id
							where orrc.city_id="'.$exitTollCityId.'"AND vehicle_id ="'.$vehicle_id.'" AND 
							orrc.from_tc_id="'.$fromInterChangeNumber.'" AND 
							orrc.to_tc_id="'.$toInterChangeNumber.'"')->result();
							//~ echo $this->db->last_query();
							//~ echo '<pre>';
							//~ print_r($charges);
							 //~ exit;
							 if(count($charges)>0){
								return $charges;
							}else{
								$msg = "Toll charges not mapped properly";
								return $msg;
							}
						}else{
							$msg = "Entry and Exit cities are not same";
							return $msg;
						}

						
					}
				}else{

					$msg = "User already detected";
					return $msg;

				}
			}else{
					 /* -------------- Helpful for debugging purpose-------------------- */
                        $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Entry & Exit Toll Centers are same')";
                        $result1 = $this->db->query($sql1);
                        /* -------------- Helpful for debugging purpose ends-------------------- */
			}


			}
			else
			{

				$msg = "User already detected";
				return $msg;

			}
		
		}else{
			$user = $this->db->select('*')->where('user_id',$uid)->get('ringroad')->num_rows();
			$where_data1 = array(
			'tc_id' => $data['toll_id'],
			'user_id' => $uid,
			'status' => 0
			);
			$outCount = $this->db->select('*')->where($where_data1)->get('ringroad')->result_array();
			
			//   To check whether entry type is already inserted or not
			$where_data = array(
				'tc_id' => $data['toll_id'],
				'user_id' => $uid
			);
			$existUser = $this->db->select('*')->where($where_data)->get('ringroad')->result_array();
			
			if(count($existUser) > 0 && $existUser['0']['tc_id'] == $data['toll_id']){
				$msg = "User already detected";
				return $msg;
			}
			if(count($existUser)>0){
				$status = 0;
			}else{
				$status = 1;
			}
			//echo $status; exit;
			$CI =& get_instance();
			$isEntryDetected = $CI->db->select('*');
			$CI->db->from('ringroad');
			$CI->db->where('user_id', $uid);
			$CI->db->where('status', 1);
			$query1 = $CI->db->get()->result_array();
		
			
	// To insert entry type
			if($user==0)
			{
				$tc_id  = $data['toll_id'];
				$insert_data = array(
					'tc_id' => $data['toll_id'],
					'user_id' => $uid,
					'status' => $status
				);
				$this->db->insert('ringroad', $insert_data);
				// To fetch tollgate name
				$tollCenterLocation = $this->db->query('select * from toll_center r where r.tc_id ='.$tc_id)->result();
				$data['msg'] = "Welcome to ".$tollCenterLocation['0']->tc_name." Ringroad";
				return $data;

			}
			
			if($user> 0 && count($outCount) == 0){
	//   	 TO insert exit type
				$where_data1 = array(
					'user_id' => $uid,
					'status' => 0
				);
				$insertStatus = $this->db->select('*')->where($where_data1)->get('ringroad')->result_array();
				if(empty($insertStatus)){
					$insert_data = array(
						'tc_id' => $data['toll_id'],
						'user_id' => $uid,
						'status' => 0
					);
					$this->db->insert('ringroad', $insert_data);

					// 	To fetch entry type
					$CI =& get_instance();
					$tollCenterDetails = $CI->db->select('*');
					$CI->db->from('ringroad');
					$CI->db->where(array('user_id'=> $uid,'status'=>'1'));
					$query1 = $CI->db->get()->result_array();
					$m1 = $query1['0']['major'];
					$m2 = $query1['0']['minor'];
					if($query1['0']['tc_id'] != ''){
							$enterdTollGateId = $query1['0']['tc_id'];
					}else{
						 $CI = & get_instance();
						$table_name = 'beacons';
						$tollCenterDetails = $CI->db->select('*');
						$CI->db->from('beacons');
						$CI->db->join('toll_center', 'beacons.tc_id = toll_center.tc_id');
						$CI->db->where('beacons.major_id', $m1);
						$CI->db->where('beacons.minor_id', $m2);
						$query = $CI->db->get()->result_array();
						$enterdTollGateId = $query['0']['tc_id'];
					}
					

					$CI =& get_instance();
					$tollCenterDetails1 = $CI->db->select('*');
					$CI->db->from('ringroad');
					$CI->db->where(array('user_id'=> $uid,'status'=>'0'));
					$query2 = $CI->db->get()->result_array();
					if($query2['0']['tc_id'] !=''){
						$exitTollGateId = $query2['0']['tc_id'];
					}else{
						$CI = & get_instance();
						$table_name = 'beacons';
						$tollCenterDetails = $CI->db->select('*');
						$CI->db->from('beacons');
						$CI->db->join('toll_center', 'beacons.tc_id = toll_center.tc_id');
						$CI->db->where('beacons.major_id', $m1);
						$CI->db->where('beacons.minor_id', $m2);
						$query = $CI->db->get()->result_array();
						//~ echo '<pre>';
						//~ echo $this->db->last_query(); 
						//~ print_r($query); exit;
						$exitTollGateId = $query['0']['tc_id'];	
					}
					

					// 	To send payment charges in response
					if($enterdTollGateId){
						$vehicle_id = $data['vehicle_id'];
						$from_tc_id = $enterdTollGateId;
						$to_tc_id = $exitTollGateId;
						$table_name = 'outerringroad_charge orrc';
						$fromTcInterchangeNumber = $this->db->query("
						select otc.orr_toll_center_id,otc.interchange_number,otc.interchange_name,otc.city_id as toll_city_id,tc.*  from orr_toll_center otc
						join toll_center tc on otc.interchange_name = tc.tc_location where tc.tc_id=$from_tc_id
						")->result_array();
						//echo $this->db->last_query();
						$toTcInterchangeNumber = $this->db->query("
						select otc.orr_toll_center_id,otc.interchange_number,otc.interchange_name,otc.city_id as toll_city_id,tc.* from orr_toll_center otc
						join toll_center tc on otc.interchange_name = tc.tc_location where tc.tc_id=$to_tc_id
						")->result_array();
						//echo $this->db->last_query();
						//exit;
						$entryCity = $this->db->query("
						select * from toll_center tc
						join city c on tc.city_id = c.id where tc.tc_id=$from_tc_id
						")->result_array();
						
						$exitCity = $this->db->query("
						select * from toll_center tc
						join city c on tc.city_id = c.id where tc.tc_id=$to_tc_id
						")->result_array();
						
						
						
						$fromInterChangeNumber = $fromTcInterchangeNumber['0']['interchange_number'];
						$toInterChangeNumber = $toTcInterchangeNumber['0']['interchange_number'];
						
						$enteredTollCityId = $fromTcInterchangeNumber['0']['toll_city_id'];
						$exitTollCityId = $toTcInterchangeNumber['0']['toll_city_id'];
						$entryCityId = $entryCity['0']['city_id'];
						$exitCityId = $exitCity['0']['city_id'];
                        if(($enteredTollCityId == $entryCityId) && ($exitCityId == $exitTollCityId) && ($enteredTollCityId == $exitTollCityId)){
							$charges = $this->db->query('select * from outerringroad_charge orrc 
							join vehicle_model vm on orrc.type_of_vehicle_id = vm.type_id
							join vehicles v on vm.model_id = v.model_id
							where orrc.city_id="'.$exitTollCityId.'"AND vehicle_id ="'.$vehicle_id.'" AND 
							orrc.from_tc_id="'.$fromInterChangeNumber.'" AND 
							orrc.to_tc_id="'.$toInterChangeNumber.'"')->result();
							//echo $this->db->last_query(); exit;
								//~ echo '<pre>';
								//~ print_r($charges);
							//exit;
								 if(count($charges)>0){
									return $charges;
								}else{
									$msg = "Toll charges not mapped properly";
									return $msg;
								}
						}
						//~ $charges = $this->db->query('select * from outerringroad_charge orrc join vehicle_model vm on orrc.type_of_vehicle_id = vm.type_id
					//~ join vehicles v on vm.model_id = v.model_id where v.vehicle_id ="'.$vehicle_id.'" AND orrc.from_tc_id="'.$from_tc_id.'" AND orrc.to_tc_id="'.$to_tc_id.'"')->result();
					else{
							$msg = "Entry and Exit cities are not same";
							return $msg;
						}
						
					}
				}else{

					$msg = "User already detected";
					return $msg;

				}



			}
			else
			{
				
				$msg = "User already detected";
				return $msg;

			}	
		}
        
    }


//end web payment
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */
