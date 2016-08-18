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
    $result = $this->db->select('*')->get('vehicle_type')->result_array();
          //  pd($result);exit;
            if(count($result)){
                  return $result;
            }
    }
    public function get_makes($typeid)
    {
        $result = $this->db->select('*')->where(array('type_id'=>$typeid))->get('vehicle_make')->result_array();
            if(count($result)){
                  return $result;
            }
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
       $result = $this->db->select('*')->where(array('user_id'=>$uid))->get(self::TABLE_NAME)->result_array();
       
            if(count($result)){
                   $result_array['result']= $result;
                   $result_array['msg']= 'Vechicles List';
            }else{
                $result_array['result']= false;
                $result_array['msg']= 'No Records Found';
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
       $date=date('Y-m-d H:i:s');
       $inserdata=array('user_id'=>$uid,'model_id'=>$data['model_id'],'vehicle_no'=>$data['vehicle_no'],'created_date'=>$date);
       $this->db->insert(self::TABLE_NAME, $inserdata);
       return $this->db->insert_id();
        }
       else{
          return false; 
       }
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
$updatedata=array('model_id'=>$data['model_id'],'vehicle_no'=>$data['vehicle_no'],'enable_status'=>$data['enable_status'],'default_status'=>$data['default_status']);
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$data['vehicle_id']);
            $this->db->update(self::TABLE_NAME, $updatedata);   
         return $count;
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
       
            $updatedata=array('status_flag'=>'0');
            $this->db->where('user_id',$uid);
            $this->db->where('vehicle_id',$vehicle_id);
             $this->db->update(self::TABLE_NAME, $updatedata); 
           return $count;   
        }
          else{
          return 0; 
       }
           
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
public function login_email($data){
$result_array = array();             
    $result = $this->db->select('*')->where(array('email_id'=>$data['login'],'password'=>$data['password']))->get(self::TABLE_NAME)->result_array();
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
public function updateProfile($data,$userid,$imagename){
    
}
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */