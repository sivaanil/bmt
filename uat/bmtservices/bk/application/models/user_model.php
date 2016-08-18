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
public function update_profile_image($uid,$imagename){
    
        $this->db->select('*');        
        $this->db->where('user_id',$uid);
        $result = $this->db->get(self::TABLE_NAME);
        $count = $result->num_rows();    
        if($count>0){ 
       $data=array('profile_image'=>$imagename);
       $this->db->where('user_id',$userid);
       $this->db->update(self::TABLE_NAME,$data);  
         return $count;
        }else{
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
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */