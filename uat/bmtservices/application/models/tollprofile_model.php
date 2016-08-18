<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tollprofile_model extends CI_Model {

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
}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model_model.php */