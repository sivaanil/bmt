<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vehicle_model extends CI_Model {

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

	const TABLE_NAME = "vehicles";

	public function __construct(){
		parent::__construct();
	}
    public function get_types()
    {
$this->db->select('vehicle_type.type_id, vehicle_type.type_name');
$this->db->from('vehicle_type');
//$this->db->join('vehicle_make', 'vehicle_make.type_id = vehicle_type.type_id');
//$this->db->join('vehicle_model', 'vehicle_model.type_id = vehicle_type.type_id');
//$this->db->group_by('vehicle_type.type_id');
$sql = $this->db->get();
$result = $sql->result_array();
   //echo $this->db->last_query();exit;     
        
  //  $result = $this->db->select('*')->get('vehicle_type')->result_array();
          //  pd($result);exit;
            if(count($result)){
                  return $result;
            }
    }
    public function get_makes($typeid)
    { /*$this->db->select('vehicle_make.make_id, vehicle_make.make_name');
      $this->db->from('vehicle_make');
      $this->db->join('vehicle_type', 'vehicle_type.type_id = vehicle_make.type_id');
      $this->db->join('vehicle_model', 'vehicle_model.make_id = vehicle_make.make_id');
      $this->db->group_by('vehicle_make.make_id');
      $sql = $this->db->get();*/
      $data = array();
      $result = $this->db->select('*')->where(array('type_id'=>$typeid))->get('vehicle_make')->result_array();
      if(count($result))
      {
        $data = $result;
      }
      return $data;
    }
    public function get_models($makeid)
    {
        $result = $this->db->select('*')->where(array('make_id'=>$makeid))->get('vehicle_model')->result_array();
            if(count($result)){
                  return $result;
            }
    }
    public function getVehicles($uid){
        $result_array=array();
     //  $result = $this->db->select('*')->where(array('user_id'=>$uid))->get(self::TABLE_NAME)->result_array();
        $this->db->select('*');
            $this->db->from(self::TABLE_NAME); 
            $this->db->join('vehicle_model', 'vehicle_model.model_id=vehicles.model_id', 'left');
            $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_model.make_id', 'left');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=vehicle_make.type_id', 'left');
            $this->db->where('vehicles.user_id',$uid);  
            $this->db->where('vehicles.status_flag <>','0'); 
            $query = $this->db->get(); 
       $result= $query->result_array();
      // echo $this->db->last_query();exit;
      // print_r($result);exit;
            if(count($result)){
                $result_array= $result;
               //    $result_array['result']= $result;
                  // $result_array['msg']= 'Vechicles List';
            }else{
                $result_array= 0;
               // $result_array['msg']= 'No Records Found';
            } 
            return $result_array;
    }
    public function get_vehicle($vid,$uid){
        $result_array=array();
        
            $this->db->select('*');
            $this->db->from(self::TABLE_NAME); 
            $this->db->join('vehicle_model', 'vehicle_model.model_id=vehicles.model_id', 'left');
            $this->db->join('vehicle_make', 'vehicle_make.make_id=vehicle_model.make_id', 'left');
            $this->db->join('vehicle_type', 'vehicle_type.type_id=vehicle_make.type_id', 'left');
            $this->db->where('vehicles.vehicle_id',$vid);
            $this->db->where('vehicles.user_id',$uid);         
            $query = $this->db->get(); 
       $result= $query->result_array();
      //  print_r($res);exit;
        
      // $result = $this->db->select('*')->where(array('vehicle_id'=>$vid,'user_id'=>$uid))->get(self::TABLE_NAME)->result_array();
       
            if(count($result)){
                
                   $result_array= $result[0];
                 //  $result_array['msg']= 'Single Vechicle List';
            }else{
                $result_array= false;
               // $result_array['msg']= 'No Record Found';
            } 
            return $result_array;
    }
    public function add_vehicle($data,$uid)
    {
        $this->db->select('*');
        $this->db->where('type_id', $data['type_id']);
        $this->db->where('make_id', $data['make_id']);
        $this->db->where('model_id', $data['model_id']);
        $result = $this->db->get('vehicle_model');
          $count = $result->num_rows();      
        if($count>0){

          $this->db->select('*');        
        $this->db->where('user_id',$uid);
        $result = $this->db->get(self::TABLE_NAME);
        $cnt = $result->num_rows();
        if($cnt==0){
        $default_status='1';
        }else{
        $default_status='0';
      }

       $date=date('Y-m-d H:i:s');
       $inserdata=array('user_id'=>$uid,'model_id'=>$data['model_id'],'vehicle_no'=>$data['vehicle_no'],'default_status'=>$default_status,'created_date'=>$date);
       $this->db->insert(self::TABLE_NAME, $inserdata);
       return $this->db->insert_id();
        }
       else{
          return false; 
       }
    }
    public function check_vehicle_number($vno){
            $this->db->select('*');
            $this->db->from(self::TABLE_NAME);             
            $this->db->where('vehicle_no',$vno);
            $this->db->where('status_flag','1 ');         
            $query = $this->db->get(); 
            return $num=$query->num_rows();
    }
    public function update_vehicle($data,$uid)
    {
        $this->db->select('*');
        $this->db->where('type_id', $data['type_id']);
        $this->db->where('make_id', $data['make_id']);
        $this->db->where('model_id', $data['model_id']);
        $result = $this->db->get('vehicle_model');
           $count = $result->num_rows();    
        if($count>0){  
            $dresult = $this->db->select('*')->where(array('user_id'=>$uid,'default_status'=>'1','status_flag'=>'1'))->get(self::TABLE_NAME)->result_array();
         //   echo PRINT_R($dresult);exit;
            if(count($dresult)>0){
             //   $default=$data['default_status'];
          if($dresult[0]['vehicle_id']==$data['vehicle_id']){
            $updatedata=array('model_id'=>$data['model_id'],'vehicle_no'=>$data['vehicle_no'],'enable_status'=>$data['enable_status'],'default_status'=>$data['default_status']);
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$data['vehicle_id']);
            $this->db->update(self::TABLE_NAME, $updatedata);   
            return $count;
          }  else if($data['default_status']==1) {
              
              return 4;
          }else{
           $updatedata=array('model_id'=>$data['model_id'],'vehicle_no'=>$data['vehicle_no'],'enable_status'=>$data['enable_status'],'default_status'=>$data['default_status']);
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$data['vehicle_id']);
            $this->db->update(self::TABLE_NAME, $updatedata);   
            return $count;
            }
            }
            else{
            $updatedata=array('model_id'=>$data['model_id'],'vehicle_no'=>$data['vehicle_no'],'enable_status'=>$data['enable_status'],'default_status'=>$data['default_status']);
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$data['vehicle_id']);
            $this->db->update(self::TABLE_NAME, $updatedata);   
            return $count;     
            }
        }     
       else{
          return 0; 
       }
    }
    public function deleteVehicles($uid,$vehicle_id){
        $this->db->select('*');        
        $this->db->where('user_id',$uid);
        $this->db->where('vehicle_id',$vehicle_id);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();    
        if($count>0){ 
       
            $updatedata=array('status_flag'=>'0','default_status'=>'0');
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$vehicle_id);
             $this->db->update(self::TABLE_NAME, $updatedata); 
           return $count;   
        }
          else{
          return 0; 
       }
           
    }
public function update_enable($vehicle_id,$userid,$status){
        $this->db->select('*');        
        $this->db->where('user_id',$userid);
        $this->db->where('vehicle_id',$vehicle_id);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();    
        if($count>0){ 
       
            $updatedata=array('enable_status'=>$status);
            $this->db->where('user_id',$userid);
            $this->db->where('vehicle_id',$vehicle_id);
             $this->db->update(self::TABLE_NAME, $updatedata); 
           return $count;   
        }
          else{
          return 0; 
       }
}
       public function update_defalut($vehicle_id,$uid,$status){
        $this->db->select('*');        
        $this->db->where('user_id',$uid);
        $this->db->where('vehicle_id',$vehicle_id);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();    
        if($count>0){  
            $dresult = $this->db->select('*')->where(array('user_id'=>$uid,'default_status'=>'1','status_flag'=>'1'))->get(self::TABLE_NAME)->result_array();
         //   echo PRINT_R($dresult);exit;
            if(count($dresult)>0){
             //   $default=$data['default_status'];
          if($dresult[0]['vehicle_id']==$vehicle_id){
            $updatedata=array('default_status'=>$status);
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$vehicle_id);
             $this->db->update(self::TABLE_NAME, $updatedata); 
           return $count; 
          }  else if($status==1) {
              
              return 4;
          }else{
           $updatedata=array('default_status'=>$status);
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$vehicle_id);
             $this->db->update(self::TABLE_NAME, $updatedata); 
           return $count; 
            }
            }
            else{
            $updatedata=array('default_status'=>$status);
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$vehicle_id);
             $this->db->update(self::TABLE_NAME, $updatedata); 
           return $count;     
            }
        }     
       else{
          return 0; 
       }
}
public function enable_all_vehicles($data,$uid){
$varray= $data['vehicledetails'];
//echo count($varray);

$vids=array();
foreach($varray as $each){
  $vids[]=$each['vehicle_id'];
} 

$result = $this->db->select('*')->where(array('user_id'=>$uid))->get(self::TABLE_NAME)->result_array(); 
foreach($result as $each){
    $vid=$each['vehicle_id'];
 if (in_array($vid, $vids, TRUE))
  {
  //echo "Match found<br>";
            $updatedata=array('enable_status'=>'1');
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$vid);
            $this->db->update(self::TABLE_NAME, $updatedata);
  }
else
  {
    //echo "no";
            $updatedata=array('enable_status'=>'0');
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$vid);
            $this->db->update(self::TABLE_NAME, $updatedata);
  }
}       
//pd($vids);exit;
return true;
}

}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */
