<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tolloperator_model extends CI_Model {

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
  public function getProfile($stafid){
   
          $result = $this->db->select('`first_name`, `last_name`, `email_id`,`mobile_no`,`profile_img`')->where(array('ts_id'=>$stafid))->get(self::TABLE_NAME)->result_array();
            if(count($result)){               
                $result_array = $result[0];
            }
            return $result_array;  
} 
public function updateWebProfile($data,$stafid,$imagename){
        $this->db->select('*');        
        $this->db->where('ts_id',$stafid);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();    
        if($count>0){
$data['profile_img']=$imagename;  
   //print_r($data);exit;
$this->db->where('ts_id',$stafid);
 $this->db->update(self::TABLE_NAME,$data);
return $count;
}else{
 return 0;   
     }
}
        public function getDetailsOfBeacon($stafid){
            
//           "select uvd.id,uvd.user_id,tcd.tcn_no,tcd.oneway_charge,vtype.type_value,uvd.vehicle_num,uvd.user_id,u.emailid,uvd.paid_status,uvd.passing_status  "
//     +"from bookmytoll.toll_charge_details tcd,bookmytoll.reg_user_details u ,"
//     +"bookmytoll.user_vehicle_details uvd,bookmytoll.toll_staff_details tsd, bookmytoll.vehicle_model vmodel,"
//     +"bookmytoll.vehicle_type vtype "
//     +"where tsd.id=? "
//            . "and tsd.tcn_no=tcd.tcn_no "
//                   . "and uvd.model_id=vmodel.model_id and "
//     +"vtype.type_id=vmodel.type_id "
//                   . "AND tcd.vehicletype_id=vtype.type_id and "
//     +"uvd.defalt=1 and u.id=uvd.user_id and uvd.reg_type='WRU' "

            //$this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_name,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,(toll_charge.one_way_charge)+1 as one_way_charge,(toll_charge.two_way_charge)+1 as two_way_charge,vehicles.paid_status,vehicles.passing_status');
            $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,
              vehicle_make.make_id,vehicle_make.make_name,vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,
              vehicles.vehicle_id,vehicles.vehicle_no,toll_charge.one_way_charge,toll_charge.two_way_charge,
              vehicles.paid_status,vehicles.passing_status');
            $this->db->from('toll_staff'); 
            $this->db->join('toll_charge', 'toll_charge.tc_id=toll_staff.tc_id');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
            $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
          
            $this->db->where('toll_staff.ts_id',$stafid);
            $this->db->where('toll_staff.roll_id',4); 
            $this->db->where('vehicles.default_status','1');
            $this->db->where('vehicles.paid_status','1');
           $this->db->where('vehicles.passing_status','0');
            $this->db->where('user_register.mobile_device_id IS NOT NULL');
           $query = $this->db->get(); 
            // echo $this->db->last_query();exit;
             $result= $query->result_array();
             if(count($result)>0){
               return $result;              
           }else{
              return 4; 
           }
        }
        public function getDetailsOfBeacon1($stafid){
            
//           "select uvd.id,uvd.user_id,tcd.tcn_no,tcd.oneway_charge,vtype.type_value,uvd.vehicle_num,uvd.user_id,u.emailid,uvd.paid_status,uvd.passing_status  "
//     +"from bookmytoll.toll_charge_details tcd,bookmytoll.reg_user_details u ,"
//     +"bookmytoll.user_vehicle_details uvd,bookmytoll.toll_staff_details tsd, bookmytoll.vehicle_model vmodel,"
//     +"bookmytoll.vehicle_type vtype "
//     +"where tsd.id=? "
//            . "and tsd.tcn_no=tcd.tcn_no "
//                   . "and uvd.model_id=vmodel.model_id and "
//     +"vtype.type_id=vmodel.type_id "
//                   . "AND tcd.vehicletype_id=vtype.type_id and "
//     +"uvd.defalt=1 and u.id=uvd.user_id and uvd.reg_type='WRU' "

            //$this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_name,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,vehicles.vehicle_no,(toll_charge.one_way_charge)+1 as one_way_charge,(toll_charge.two_way_charge)+1 as two_way_charge,vehicles.paid_status,vehicles.passing_status');
            $this->db->select('toll_center.tc_name,toll_center.tc_location,transactions.tc_id,transactions.type_id,transactions.user_id,vehicle_type.type_name,vehicle_make.make_name,vehicle_model.model_name,'
                    . 'user_register.email_id,user_register.mobile_no,user_register.mobile_device_id,transactions.vehicle_id,'
                    . 'transactions.vehicle_no,transactions.toll_charge,transactions.bmt_charge,transactions.total_amount,transactions.paid_status,transactions.passing_status');
            $this->db->from('transactions'); 
            $this->db->join('toll_center', 'toll_center.tc_id=transactions.tc_id');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
            $this->db->join('vehicle_model', 'vehicle_model.model_id=transactions.model_id');
            $this->db->join('vehicles', 'vehicles.vehicle_id=transactions.vehicle_id');
            $this->db->join('user_register', 'user_register.user_id=transactions.user_id');          
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.paid_status',1);
            $this->db->where('transactions.passing_status',0);
            $this->db->where('user_register.mobile_device_id IS NOT NULL');
           $query = $this->db->get(); 
            // echo $this->db->last_query();exit;
             $result= $query->result_array();
             if(count($result)>0){
               return $result;              
           }else{
              return 4; 
           }
        }
        public function getDetailsOfNonBeacon($stafid){
            $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                    . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_no,user_register.mobile_device_id,vehicles.vehicle_id,'
                    . 'vehicles.vehicle_no,toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
            $this->db->from('toll_staff'); 
            $this->db->join('toll_charge', 'toll_charge.tc_id=toll_staff.tc_id');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
            $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');          
            $this->db->where('toll_staff.ts_id',$stafid);
            $this->db->where('toll_staff.roll_id',4); 
            $this->db->where('vehicles.default_status','1');
            $this->db->where('vehicles.paid_status','1');
            $this->db->where('vehicles.passing_status','0');
            $this->db->where('user_register.mobile_device_id IS NULL', null, false);
           $query = $this->db->get(); 
          //   echo $this->db->last_query();exit; 
           $result= $query->result_array();
          // echo "<pre>"; print_r($result);
           if(count($result)>0){
               return $result;
               
           }else{
              return 4; 
           }
        }
        public function getDetailsOfNonBeacon1($stafid){

            $this->db->select('toll_center.tc_name,toll_center.tc_location,transactions.tc_id,transactions.type_id,transactions.user_id,vehicle_type.type_name,'
                    . 'user_register.email_id,user_register.mobile_no,user_register.mobile_device_id,transactions.vehicle_id,'
                    . 'transactions.vehicle_no,transactions.toll_charge,transactions.bmt_charge,transactions.total_amount,transactions.paid_status,transactions.passing_status');
            $this->db->from('transactions'); 
            $this->db->join('toll_center', 'toll_center.tc_id=transactions.tc_id');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            $this->db->join('vehicles', 'vehicles.vehicle_id=transactions.vehicle_id');
            $this->db->join('user_register', 'user_register.user_id=transactions.user_id');          
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.paid_status',1);
            $this->db->where('transactions.passing_status',0);
            $this->db->where('transactions.reg_type IS NULL', null, false);
           $query = $this->db->get(); 
            // echo $this->db->last_query();exit; 
           $result= $query->result_array();
          // echo "<pre>"; print_r($result);
           if(count($result)>0){
               return $result;
               
           }else{
              return 4; 
           }
        }
        /* Beacon Recognized by vechicles Search (mobile)*/
        public function getDetailsOfBeaconSearch($data,$stafid){
          $vno=$data['vehicle_no'];
            $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                    . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,'
                    . 'vehicles.vehicle_no,toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
            $this->db->from('toll_staff'); 
            $this->db->join('toll_charge', 'toll_charge.tc_id=toll_staff.tc_id');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
            $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
          
            $this->db->where('toll_staff.ts_id',$stafid);
            $this->db->where('toll_staff.roll_id',4); 
            $this->db->where('vehicles.default_status','1');
            $this->db->where('vehicles.paid_status','1');
            $this->db->where('vehicles.passing_status','0');
            $this->db->where('user_register.mobile_device_id IS NOT NULL');
            $this->db->like('vehicles.vehicle_no',$vno);
           $query = $this->db->get(); 
            // echo $this->db->last_query();exit; 
           $result= $query->result_array();
          // echo "<pre>"; print_r($result);
           if(count($result)>0){
               return $result;
               
           }else{
              return 4; 
           }
        }
        /* Non Beacon Recognized by vechicles Search (web)*/
        public function getDetailsOfNonBeaconSearch($data,$stafid){
          $vno=$data['vehicle_no'];
            $this->db->select('toll_charge.tc_id,vehicle_type.type_id,vehicles.user_id,vehicle_type.type_name,vehicle_make.make_id,vehicle_make.make_name,'
                    . 'vehicle_model.model_id,vehicle_model.model_name,user_register.email_id,user_register.mobile_device_id,vehicles.vehicle_id,'
                    . 'vehicles.vehicle_no,toll_charge.one_way_charge,toll_charge.two_way_charge,vehicles.paid_status,vehicles.passing_status');
            $this->db->from('toll_staff'); 
            $this->db->join('toll_charge', 'toll_charge.tc_id=toll_staff.tc_id');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=toll_charge.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_type.type_id');
            $this->db->join('vehicle_model', 'vehicle_model.type_id=vehicle_type.type_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->join('user_register', 'user_register.user_id=vehicles.user_id');
          
            $this->db->where('toll_staff.ts_id',$stafid);
            $this->db->where('toll_staff.roll_id',4); 
           // $this->db->where('vehicles.default_status','1');
            $this->db->where('vehicles.paid_status','0');
            $this->db->where('vehicles.passing_status','0');
            $this->db->where('user_register.mobile_device_id IS NULL', null, false);
            $this->db->like('vehicles.vehicle_no',$vno);
           $query = $this->db->get(); 
            // echo $this->db->last_query();exit; 
           $result= $query->result_array();
           if(count($result)>0){
               return $result;
               
           }else{
              return 4; 
           }
        }
        public function  get_ways($stafid){
            $this->db->select('toll_center.tc_id,toll_center.from_way_location,toll_center.to_way_location');
            $this->db->from('toll_staff'); 
            $this->db->join('toll_center', 'toll_center.tc_id=toll_staff.tc_id');
            $this->db->where('toll_staff.ts_id',$stafid);
            $this->db->where('toll_staff.roll_id',4);
            $query = $this->db->get();
            $result= $query->result_array();  
            if(count($result)){
                return $result[0];
            }else{
                return false;
            }
       //  print_r($result);exit;
        }

 public function  get_lanes($data,$stafid){
            $this->db->select('lane_id,lane_number');
            $this->db->from('bmt_lanes'); 
            $this->db->where('tc_id',$data['tc_id']);
            $this->db->where('way_type',$data['way_type']);
            $this->db->where('status_flag',0);
            $this->db->where('user_selsect_status',0);
            $query = $this->db->get();
           // echo $this->db->last_query();exit;
            $result= $query->result_array();  
            if(count($result)){
                return $result;
            }else{
                return 4;
            }
       //  print_r($result);exit;
        }
        public function store_lane($data,$stafid){
             $insertarr=array(
                   'ts_id'=>$stafid,
                   'tc_id'=>$data['tc_id'],
                   'lane_id'=>$data['lane_id'],
                   'way_type'=>$data['way_type']
               );
             $tcid=$data['tc_id'];
             $laneid=$data['lane_id'];
             $waytype=$data['way_type'];

                $this->db->insert('bmt_lane_mapping',$insertarr);
                $id = $this->db->insert_id();
                if($id>0){
                   $sql = $this->db->query("UPDATE bmt_lanes SET user_selsect_status  = 1  WHERE tc_id=".$tcid." AND lane_id=".$laneid." AND way_type=".$waytype."");
                  return $id;
                }
        }
public function delete_lane_maping($data,$stafid)
{
             $tcid=$data['tc_id'];
             $laneid=$data['lane_id'];
             $waytype=$data['way_type'];

            $this->db->select('*');
            $this->db->from('bmt_lanes'); 
            $this->db->where('tc_id',$tcid);
            $this->db->where('lane_id',$laneid);
            $this->db->where('way_type',$waytype);
            $sql = $this->db->get();
           $num=$sql->num_rows();
          if($num>0){
 $sql = $this->db->query("UPDATE bmt_lanes SET user_selsect_status  = 0  WHERE tc_id=".$tcid." AND lane_id=".$laneid." AND way_type=".$waytype."");
 $sql1 = $this->db->query("DELETE FROM bmt_lane_mapping  WHERE ts_id= ".$stafid." AND tc_id=".$tcid." AND lane_id=".$laneid." AND way_type=".$waytype."");
 return $num;

          }


}
        public function paid($data,$stafid)
        {    
            
            $uid=$data['user_id'];
            $vid=$data['vehicle_id'];
            $oneway=$data['one_way_charge'];
            $twoway=$data['two_way_charge'];
            $bmtcharge=$data['bmt_charge'];
            $onetot=$oneway+$bmtcharge;
            $twotot=$twoway+$bmtcharge;
            $tsid=$data['ts_id'];
            $tcid=$data['tc_id'];
            // pd($_POST);exit;
            $this->db->select('bmt_lanes.lane_id,bmt_lanes.lane_number');
            $this->db->from('bmt_lane_mapping'); 
            $this->db->join('bmt_lanes', 'bmt_lanes.lane_id=bmt_lane_mapping.lane_id');
            $this->db->where('bmt_lane_mapping.ts_id',$tsid);
            $this->db->where('bmt_lane_mapping.tc_id',$tcid);
             $sql = $this->db->get();
            $res= $sql->result(); 
            $laneid=$res[0]->lane_id;
            //echo "SELECT * FROM `wallet` where user_id=$uid";
                 $sql1 = $this->db->query("SELECT * FROM `wallet` where user_id=$uid");
                 $res1 = $sql1->result();
                 $num = $sql1->num_rows();
                 if($num>0){
                 $walletamt=$res1[0]->wallet_amount;
                 }else{
                  $walletamt=0;   
                 }
            
       //$sql = $this->db->query("SELECT * FROM `bmt_lane_mapping` where ts_id=$tsid AND tc_id=$tcid");
     //  $res = $sql->result_array();
      //  pd($res);exit;
      // echo "select * from transactions where `transaction_date` < DATE_SUB(NOW() , INTERVAL 1 DAY) AND vehicle_id=$vid";
        $query = $this->db->query("select * from transactions where `transaction_date` < DATE_SUB(NOW() , INTERVAL 1 DAY) AND vehicle_id=$vid");
        $result = $query->result_array();  
      // echo count($result);exit;
        //   pd($result);exit;
            if(count($result)>0){
                if($walletamt>$twotot){ //echo "rr";exit;
                    $sql = $this->db->query("UPDATE wallet SET wallet_amount = wallet_amount - $twotot WHERE user_id=$uid");
                    $sql = $this->db->query("UPDATE vehicles SET paid_status = 1,passing_status=0 WHERE vehicle_id=$vid AND user_id=$uid");
               $updatearr=array(
                   'ts_id'=>$data['ts_id'],
                   'tc_id'=>$data['tc_id'],
                   'user_id'=>$data['user_id'],
                   'type_id'=>$data['type_id'],
                   'make_id'=>$data['make_id'],
                   'model_id'=>$data['model_id'],
                   'vehicle_id'=>$data['vehicle_id'],
                   'vehicle_no'=>$data['vehicle_no'],
                   'lane_id'=>$laneid,
                   'email_id'=>$data['email_id'],
                   'reg_type'=>$data['reg_type'],
                   'toll_charge'=>$twoway,
                   'bmt_charge'=>$bmtcharge,
                   'total_amount'=>$twotot,
                   'passing_status'=>0,
                   'paid_status'=>1,                   
                   'transaction_date'=>date('Y-m-d H:i:s')
               );                  
                   $this->db->insert('transactions' ,$updatearr);
                  return $id = $this->db->insert_id();
                }else{
                    return 4;
                }
            }else{
                // echo $walletamt;
               //  echo $onetot;exit;
                if($walletamt>$onetot){
                   // echo "UPDATE wallet SET wallet_amount = wallet_amount - $onetot WHERE user_id=$uid";exit;
                    $sql = $this->db->query("UPDATE wallet SET wallet_amount = wallet_amount - $onetot WHERE user_id=$uid");
                    $sql = $this->db->query("UPDATE vehicles SET paid_status = '1',passing_status='0' WHERE vehicle_id=$vid AND user_id=$uid");
                $insertarr=array(
                   'ts_id'=>$data['ts_id'],
                   'tc_id'=>$data['tc_id'],
                   'user_id'=>$data['user_id'],
                   'type_id'=>$data['type_id'],
                   'make_id'=>$data['make_id'],
                   'model_id'=>$data['model_id'],
                   'vehicle_id'=>$data['vehicle_id'],
                   'vehicle_no'=>$data['vehicle_no'],
                   'lane_id'=>$laneid,
                   'email_id'=>$data['email_id'],
                   'reg_type'=>$data['reg_type'],
                   'toll_charge'=>$oneway,
                   'bmt_charge'=>$bmtcharge,
                   'total_amount'=>$onetot,
                   'passing_status'=>0,
                   'paid_status'=>1,                  
                   'transaction_date'=>date('Y-m-d H:i:s')
               );  
           //  pd($insertarr);exit;
                $this->db->insert('transactions',$insertarr);
                //echo $this->db->last_query();exit;
                  return $id = $this->db->insert_id();
                }
                else{
                    return 4;
                }
            }  
        }

        public function  pass($data,$stafid){
            //pd($data);
            $vid=$data['vehicle_id'];
            $uid=$data['user_id'];
            $this->db->select('*');
            $this->db->from('transactions'); 
            $this->db->where('ts_id',$stafid);
            $this->db->where('tc_id',$data['tc_id']);
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('vehicle_id',$data['vehicle_id']);
            $this->db->where('paid_status',$data['paid_status']);
             $sql = $this->db->get();
            // echo $this->db->last_query();exit;
            $res= $sql->result();   
            //print_r($res);exit; 
            $num = $sql->num_rows();
                 if($num>0){
  $update=array('passing_status'=>1);  
            $this->db->where('ts_id',$stafid);
            $this->db->where('tc_id',$data['tc_id']);
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('vehicle_id',$data['vehicle_id']);
            $this->db->update('transactions' ,$update);
            $this->db->query("UPDATE vehicles SET passing_status='1' WHERE vehicle_id=$vid AND user_id=$uid");
  return $num;
               
                 }  else {
                     return false;
                 }
            
            

  
        }

public function day_wise($data,$stafid){
$date= date('Y-m-d',strtotime($data['date_wise']));
$mainarray=array();
$sql = $this->db->query("SELECT tc_id,first_name, last_name FROM `toll_staff` where ts_id=$stafid");
$res = $sql->row();
$tcid=$res->tc_id;
$mainarray['tc_id']=$res->tc_id;
$mainarray['name']=$res->last_name.' '.$res->first_name;
//print_r($res);

$sql1 = $this->db->query("SELECT tc_name,tc_location FROM `toll_center` where tc_id=$tcid");
$res1 = $sql1->row();

$mainarray['tc_name']=$res1->tc_name;
$mainarray['tc_location']=$res1->tc_location;
$mainarray['date']=$date;
print_r($mainarray);
            $this->db->select('vehicle_type.type_id,vehicle_type.type_name');
            $this->db->from('transactions'); 
            $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            // $this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
            //$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            //$this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->like('transactions.transaction_date',$date);
            $this->db->group_by('vehicle_type.type_id');
            $s = $this->db->get();
//echo $this->db->last_query();
            $r= $s->result();    
//print_r($r);
foreach($r as $each){
$typeid=$each->type_id;
$typename=$each->type_name;
            $this->db->select('vehicle_make.make_id,vehicle_make.make_name,vehicles.vehicle_id');
            $this->db->from('vehicle_make');
            $this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->where('vehicle_make.type_id',$typeid);
 $s1 = $this->db->get();
            $r1= $s1->result();
//print_r($r1);
foreach($r1 as $each){
$makeid=$each->make_id;
echo$makename=$each->make_name;
echo $vid=$each->vehicle_id;

//SELECT class, sum( mark ) as total_mark FROM`student` GROUP BY class

/*$this->db->select('vehicle_id');
$this->db->from('transactions'); 
$this->db->where('vehicle_id',$vid);
$ss1 = $this->db->get();
$rr1= $s1->result();
print_r($rr1);*/

 $query="SELECT SUM(total_amount) as total,reg_type FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' AND `transactions`.`tc_id` =  '$tcid' AND `transactions`.`type_id` =  '$typeid' AND  `transactions`.`transaction_date`  LIKE '%2015-12-04%' GROUP BY `transactions`.`reg_type`";
$s2= $this->db->query($query);
//$r2 = $sql->row();

          /*  $this->db->select('transactions.vehicle_id,transactions.reg_type,transactions.total_amount');
//$this->db->select_sum('transactions.total_amount');
            $this->db->from('transactions'); 
           // $this->db->join('vehicles', 'vehicles.vehicle_id=transactions.vehicle_id');
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->where('transactions.type_id',$typeid);
            $this->db->where('transactions.vehicle_id',$vid);
            $this->db->like('transactions.transaction_date',$date);
echo $this->db->last_query();
 $s2 = $this->db->get();*/
 $r2= $s2->result();
print_r($r2);
}


/*
$this->db->select('vehicle_make.make_id,vehicle_make.make_name');
            $this->db->from('transactions'); 
            //$this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            $this->db->join('vehicle_make', 'vehicle_make.type_id=transactions.type_id');
            $this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->where('transactions.type_id',$typeid);
            $this->db->like('transactions.transaction_date',$date);
           // $this->db->group_by('transactions.vehicle_id');
$this->db->group_by('vehicle_make.make_id');
            $s1 = $this->db->get();
            $r1= $s1->result();
echo $this->db->last_query();
print_r($r1);
foreach($r1 as $each){
$makeid=$each->make_id;
$makename=$each->make_name;


//,transactions.vehicle_id,transactions.reg_type,transactions.total_amount
$this->db->select('vehicle_make.make_id,vehicle_make.make_name,transactions.vehicle_id,transactions.reg_type,transactions.total_amount');
$this->db->from('transactions');
$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            $this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->where('transactions.type_id',$typeid);
            $this->db->like('transactions.transaction_date',$date);
 $s2 = $this->db->get();
 $r2= $s2->result();

}*/

}

}
public function day_wise1($data,$stafid){
//$date= $data['date_wise'];
$date= date('Y-m-d',strtotime($data['date_wise']));
//$mainarray=array();
$mainarray['first']=array();
$mainarray['second']=array();

$sql = $this->db->query("SELECT tc_id,first_name, last_name FROM `toll_staff` where ts_id=$stafid");
$res = $sql->row();
$tcid=$res->tc_id;
$mainarray['first']['tc_id']=$res->tc_id;
$mainarray['first']['name']=$res->last_name.' '.$res->first_name;

$sql1 = $this->db->query("SELECT tc_name,tc_location FROM `toll_center` where tc_id=$tcid");
$res1 = $sql1->row();
$mainarray['first']['tc_name']=$res1->tc_name;
$mainarray['first']['tc_location']=$res1->tc_location;
$mainarray['first']['date']=$date;

//total amou start
$totsql="SELECT SUM(total_amount) as tot FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' 
     AND `transactions`.`tc_id` =  '$tcid' AND  `transactions`.`transaction_date`  LIKE '%".$date."%'";
 $tots= $this->db->query($totsql);
 $totr= $tots->result();
 $mainarray['second']['totalamt']=$totr[0]->tot;
 //total amount end
$this->db->select('vehicle_type.type_id,vehicle_type.type_name');
            $this->db->from('transactions'); 
            $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            //$this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
            //$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            //$this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->like('transactions.transaction_date',$date);
            $this->db->group_by('transactions.type_id');
            $s = $this->db->get();
//echo $this->db->last_query();
            $r= $s->result();  
$mainarray['second']['types']= $r; 
//print_r($r);
$i=0;
foreach($r as $each){
$typeid=$each->type_id;
$typename=$each->type_name;

$this->db->select('vehicle_make.make_id,vehicle_make.make_name');
$this->db->from('transactions');
$this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
$this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->where('transactions.type_id',  $typeid);
            $this->db->like('transactions.transaction_date',$date);
            
            $this->db->group_by('vehicle_make.make_id');
            $s1 = $this->db->get();
           // echo $this->db->last_query();
             $r1= $s1->result();  
// print_r($r1);

            //$mainarray[$i]['makes']= $r1;
             $mainarray['second'][$i]['makes']= $r1;
            $j=0; 
foreach($r1 as $each){
$makeid=$each->make_id;
$makename=$each->make_name; 
 $query="SELECT SUM(total_amount) as total,reg_type FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' AND `transactions`.`tc_id` =  '$tcid' AND `transactions`.`type_id` =  '$typeid' AND `transactions`.`make_id` =  '$makeid' AND  `transactions`.`transaction_date`  LIKE '%".$date."%' GROUP BY `transactions`.`reg_type`";
 $s2= $this->db->query($query);
 $r2= $s2->result();
//print_r($r2);

$mainarray['second'][$i][$j]['amounts']= $r2; 
$j++;
}
$i++;
//$mainarray['amounts']= $r2; 
}
 
//print_r($totr);exit;
//if(count($mainarray)>0){
return $mainarray;
//}

//print_r($mainarray);exit;
}
//public function day_wise1($data,$stafid){
////$date= $data['date_wise'];
//$date= date('Y-m-d',strtotime($data['date_wise']));
//$mainarray['first']=array();
//$mainarray['second']=array();
////$mainarray['third']=array();
////$firstarray[]=$mainarray['first'];
//
//$sql = $this->db->query("SELECT tc_id,first_name, last_name FROM `toll_staff` where ts_id=$stafid");
//$res = $sql->row();
//$tcid=$res->tc_id;
//$mainarray['first']['tc_id']=$res->tc_id;
//$mainarray['first']['name']=$res->last_name.' '.$res->first_name;
//
//$sql1 = $this->db->query("SELECT tc_name,tc_location FROM `toll_center` where tc_id=$tcid");
//$res1 = $sql1->row();
//$mainarray['first']['tc_name']=$res1->tc_name;
//$mainarray['first']['tc_location']=$res1->tc_location;
//$mainarray['first']['date']=$date;
//
//$this->db->select('vehicle_type.type_id,vehicle_type.type_name');
//            $this->db->from('transactions'); 
//            $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
//            //$this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
//            //$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
//            //$this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
//            $this->db->where('transactions.ts_id',$stafid);
//            $this->db->where('transactions.tc_id',$tcid);
//            $this->db->like('transactions.transaction_date',$date);
//            $this->db->group_by('transactions.type_id');
//            $s = $this->db->get();
////echo $this->db->last_query();
//            $r= $s->result_array();  
////$mainarray['types']= $r; 
////print_r($r);
//$i=0;
////$mainarray['second']['type_name']=array();
//foreach($r as $each){
//$typeid=$each['type_id'];
//$typename=$each['type_name'];
//
////$mainarray['second']['type_name'][$i]=$typename;
////$mainarray['second']['make_name']=array();
//
//$this->db->select('vehicle_make.make_id,vehicle_make.make_name');
//$this->db->from('transactions');
//$this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
//$this->db->where('transactions.ts_id',$stafid);
//            $this->db->where('transactions.tc_id',$tcid);
//            $this->db->where('transactions.type_id',  $typeid);
//            $this->db->like('transactions.transaction_date',$date);
//            
//            $this->db->group_by('vehicle_make.make_id');
//            $s1 = $this->db->get();
//           // echo $this->db->last_query();
//             $r1= $s1->result_array(); 
//             
//// print_r($r1);
//
//            //$mainarray[$i]['makes']= $r1;
//            // $mainarray[$i]['makes']= $r1;
//            $j=0; 
//            
//         $mainarray['second'][$i]['type_name']=$typename;  
//foreach($r1 as $each){
//$makeid=$each['make_id'];
//$makename=$each['make_name']; 
// 
////$mainarray['second']['make_name'][$j]=$makename;
// $query="SELECT SUM(total_amount) as total,reg_type FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' 
//     AND `transactions`.`tc_id` =  '$tcid' AND `transactions`.`type_id` =  '$typeid' AND `transactions`.`make_id` =  '$makeid' 
//         AND `transactions`.`transaction_date`  LIKE '%".$date."%' GROUP BY `transactions`.`reg_type`";
//$s2= $this->db->query($query);
// $r2= $s2->result_array();
// $r2['make_name']=$makename;
// $mainarray['second'][$i][$j]=$r2;
////print_r($r2);
////$mainarray[$i][$j]['amounts']= $r2; 
//$j++;
//}
//
////$mainarray['second'][$i]=$r1;
//$i++;
////$mainarray['amounts']= $r2; 
//}
////echo "<pre>"; print_r($mainarray);
////exit;
////if(count($mainarray)>0){
//return $mainarray;
////}
//
////print_r($mainarray);exit;
//}
public function period_wise($data,$stafid){

//$date= $data['date_wise'];
 $fromdate= date('Y-m-d',strtotime($data['from_date']));
 $todate= date('Y-m-d',strtotime($data['to_date']));

//$mainarray=array();
$mainarray['first']=array();
$mainarray['second']=array();
$sql = $this->db->query("SELECT tc_id,first_name, last_name FROM `toll_staff` where ts_id=$stafid");
$res = $sql->row();
$tcid=$res->tc_id;
$mainarray['first']['tc_id']=$res->tc_id;
$mainarray['first']['name']=$res->last_name.' '.$res->first_name;

$sql1 = $this->db->query("SELECT tc_name,tc_location FROM `toll_center` where tc_id=$tcid");
$res1 = $sql1->row();
$mainarray['first']['tc_name']=$res1->tc_name;
$mainarray['first']['tc_location']=$res1->tc_location;
$mainarray['first']['date']=$fromdate;
$mainarray['first']['todate']=$todate;

 $datesql="SELECT DATE_FORMAT(`transaction_date`,'%Y-%m-%d') as tdate FROM `transactions` 
    WHERE (DATE_FORMAT(`transaction_date`,'%Y-%m-%d')>= '$fromdate' AND DATE_FORMAT(`transaction_date`,'%Y-%m-%d')<='$todate') 
    GROUP BY DATE_FORMAT(`transaction_date`,'%Y-%m-%d')";
$dates= $this->db->query($datesql);
$dater= $dates->result();
//echo "<pre>"; print_r($dater);exit;
$z=0;
foreach($dater as $eachdate){
//total amou start
    
    $date=$eachdate->tdate;
   $mainarray['second'][$z]['datewise']=$date;
$totsql="SELECT SUM(total_amount) as tot FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' 
     AND `transactions`.`tc_id` =  '$tcid' AND  `transactions`.`transaction_date`  LIKE '%".$date."%'";
 $tots= $this->db->query($totsql);
 $totr= $tots->result();
 $mainarray['second'][$z]['totalamt']=$totr[0]->tot;
 
$this->db->select('vehicle_type.type_id,vehicle_type.type_name');
            $this->db->from('transactions'); 
            $this->db->join('vehicle_type', 'vehicle_type.type_id=transactions.type_id');
            //$this->db->join('vehicle_make', 'vehicle_make.type_id=vehicle_type.type_id');
            //$this->db->join('vehicle_model', 'vehicle_model.make_id=vehicle_make.make_id');
            //$this->db->join('vehicles', 'vehicles.model_id=vehicle_model.model_id');
            $this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->like('transactions.transaction_date',$date);
            $this->db->group_by('transactions.type_id');
            $s = $this->db->get();
//echo $this->db->last_query();
            $r= $s->result();  
$mainarray['second'][$z]['types']= $r; 
//print_r($r);
$i=0;
foreach($r as $each){
$typeid=$each->type_id;
$typename=$each->type_name;

$this->db->select('vehicle_make.make_id,vehicle_make.make_name');
$this->db->from('transactions');
$this->db->join('vehicle_make', 'vehicle_make.make_id=transactions.make_id');
$this->db->where('transactions.ts_id',$stafid);
            $this->db->where('transactions.tc_id',$tcid);
            $this->db->where('transactions.type_id',  $typeid);
            $this->db->like('transactions.transaction_date',$date);
            
            $this->db->group_by('vehicle_make.make_id');
            $s1 = $this->db->get();
           // echo $this->db->last_query();
             $r1= $s1->result();  
// print_r($r1);

            //$mainarray[$i]['makes']= $r1;
            $mainarray['second'][$z][$i]['makes']= $r1;
            $j=0; 
foreach($r1 as $each){
$makeid=$each->make_id;
$makename=$each->make_name; 
 $query="SELECT SUM(total_amount) as total,reg_type FROM `transactions`  WHERE `transactions`.`ts_id` =  '$stafid' AND `transactions`.`tc_id` =  '$tcid' AND `transactions`.`type_id` =  '$typeid' AND `transactions`.`make_id` =  '$makeid' AND  `transactions`.`transaction_date`  LIKE '%".$date."%' GROUP BY `transactions`.`reg_type`";
 $s2= $this->db->query($query);
 $r2= $s2->result();
//print_r($r2);

$mainarray['second'][$z][$i][$j]['amounts']= $r2; 
$j++;
}
$i++;
//$mainarray['amounts']= $r2; 
}
//if(count($mainarray)>0){
//return $mainarray;
//}

$z++;}
return $mainarray;
//print_r($mainarray);exit;
}

}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */