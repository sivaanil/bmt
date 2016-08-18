<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TollOperator extends CI_Controller
{
    private $loginObj = [
                            'login'     => NULL,
                            'password'  => NULL,
                        ];

    private $objKeys = [];    
    
    private $regObj = [
                            'first_name' => NULL,
                            'last_name'  => NULL,
                            'email_id'   => NULL,
                            'password'  => NULL,
                            'mobile_no' => NULL,
                        ];
 
    protected $requestObject = NULL;

	public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Expose-Headers: Authtoken');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, Authtoken, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        parent::__construct();
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        
        $this->requestObject = $this->rest->post("request");
        $this->load->model('tolloperator_model');
        
                $this->login_user_details =  getLoginUserId();
		$this->login_user_id      = 	$this->login_user_details['ts_id'];
        
    } 
    public function getTypes()
    {  
    $data = $this->tolloperator_model->get_types();
    if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Vehicle Types List'),SUCCESS_CODE);
               return;
        }
       else
       {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       }  
    }
public function getProfile(){   
   // echo "sds";exit;
  //  echo $this->login_user_id;exit;
    $data = $this->tolloperator_model->getProfile($this->login_user_id);
   // pd($data);exit;
    if(!empty($data))
            {  // pd($data);exit;
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Profile List'),SUCCESS_CODE);
               return;
            }
       else{   //pd($data);exit;      
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
           }  
}
public function editWebProfile(){
    
//        $this->login_user_details =  getWebLoginUserId();
//        $this->login_user_id      =  $this->login_user_details['user_id'];
        //echo 'dshjf';exit;
    $this->requestObject = $this->rest->post("request");
     $_POST = $this->requestObject;
     
    //   echo "hi";exit;
       $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');
       $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');
     //echo "hi";exit;
       //if($this->requestObject['profile_image']==''){
       //   $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');  
       // }
       // echo "hiff";exit;
      if($this->form_validation->run() == false){           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {  
         if($_POST['profile_img']!=''){
               $imagename = $this->uploadWebImage($_POST['profile_img'],$_POST['email_id']); 
             }else{
               $imagename='';   
             }    
          
            
       $data = $this->tolloperator_model->updateWebProfile($_POST,$this->login_user_id,$imagename);
       // echo "ggg";exit;
      if($data>0)
            { 
             
             $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Profile Updated Successfully.'),SUCCESS_CODE);
                return;  
            }
       else{         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return;           
           } 
         }
   
  
      }

function uploadWebImage($image,$email)
    {
        $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($imageDataEncoded);
        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = md5($email).strtotime(date('H:i:s')).".jpg";
        //$name = strtotime(date('H:i:s')).".jpg";
        $imageName = USER_IMG_PATH.$name;
        
        $imageSave = imagejpeg($rotate,$imageName,100);
        imagedestroy($source);
        $name = base_url().'uploads/'.$name;
        return $name;
    }
    public function beacon()
    {
        //echo "exit;"; exit;
        $data = $this->tolloperator_model->getDetailsOfBeacon1($this->login_user_id);
        
    if(!empty($data))
        {   
        if($data==4){
           $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Records Found'),SUCCESS_CODE);
               return;
       }else{
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Beacon Users List'),SUCCESS_CODE);
               return;
        }
        }
     else {        
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
    }
    public function beacon1()
    {
        //echo "exit;"; exit;
        $data = $this->tolloperator_model->getDetailsOfBeacon1($this->login_user_id);
        
    if(!empty($data))
        {   
        if($data==4){
           $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Records Found'),SUCCESS_CODE);
               return;
       }else{
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Beacon Users List'),SUCCESS_CODE);
               return;
        }
        }
     else {        
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
    }
    public function nonBeacon()
    {       
        $data = $this->tolloperator_model->getDetailsOfNonBeacon1($this->login_user_id);
       // print_r($data);exit;
        if($data==4){
           $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Records Found'),SUCCESS_CODE);
               return;
       }
    
       else if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Non Beacon Users List'),SUCCESS_CODE);
               return;
        }else{
               
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
    }
    public function nonBeacon1()
    {       
        $data = $this->tolloperator_model->getDetailsOfNonBeacon1($this->login_user_id);
       // print_r($data);exit;
        if($data==4){
           $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Records Found'),SUCCESS_CODE);
               return;
       }
    
       else if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Non Beacon Users List'),SUCCESS_CODE);
               return;
        }else{
               
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
    }
     public function getWays(){
      $data = $this->tolloperator_model->get_ways($this->login_user_id);
    if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Lane Locations'),SUCCESS_CODE);
               return;
        }
       else
       {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       }   
    }
    public function getLanes(){
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        //pd($_POST);
       $this->form_validation->set_rules('tc_id', 'Toll Cnter Number', 'trim|required|xss_clean');
       $this->form_validation->set_rules('way_type', 'Way Type', 'trim|required|xss_clean'); 
       if($this->form_validation->run() == false)
        {           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        { 
             $data = $this->tolloperator_model->get_lanes($_POST,$this->login_user_id); 
             if(!empty($data)){
                 if($data==4){
                     $this->rest->response(responseObject(SUCCESS_CODE,'','',fail,'No Available Lanes For this Way'),SUCCESS_CODE);
               return;
                 }else{
                  $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Lane List'),SUCCESS_CODE);
                  return;
                 } 
             }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
        }
    }
    public function searchVehicles(){

      $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        
       $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|xss_clean'); 
        if($this->form_validation->run() == false)
        {           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        { 
      $data = $this->tolloperator_model->getDetailsOfNonBeaconSearch($_POST,$this->login_user_id);
      //print_r($data);exit;

    if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Non Beacon Users Vehicles List'),SUCCESS_CODE);
               return;
        }
       else if($data==4){
           $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Records Found'),SUCCESS_CODE);
               return;
       }else{
               
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
     }
    }
    public function searchMobileVehicles(){
      //echo "gg";

      $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
       // print_r($_POST);exit;
       $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|xss_clean'); 

        if($this->form_validation->run() == false)
        {           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        { 

      $data = $this->tolloperator_model->getDetailsOfBeaconSearch($_POST,$this->login_user_id);
    if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Beacon Users Vehicles List'),SUCCESS_CODE);
               return;
        }
       else if($data==4){
           $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Records Found'),SUCCESS_CODE);
               return;
       }else{
               
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
     }
    }
    public function mapLanes(){
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        
       $this->form_validation->set_rules('tc_id', 'Toll Cnter Number', 'trim|required|xss_clean');
       $this->form_validation->set_rules('way_type', 'Way Type', 'trim|required|xss_clean'); 
       $this->form_validation->set_rules('lane_id', 'Lane', 'trim|required|xss_clean'); 
        if($this->form_validation->run() == false)
        {           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        { 
             $data = $this->tolloperator_model->store_lane($_POST,$this->login_user_id); 
             if($data>0){
                
                  $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Lane Mapping Succussfully'),SUCCESS_CODE);
                  return;
                  
             }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
        }
    }
public function deleteLaneFromTolloperator(){

        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        
       $this->form_validation->set_rules('tc_id', 'Toll Cnter Number', 'trim|required|xss_clean');
       $this->form_validation->set_rules('way_type', 'Way Type', 'trim|required|xss_clean'); 
       $this->form_validation->set_rules('lane_id', 'Lane', 'trim|required|xss_clean'); 
        if($this->form_validation->run() == false)
        {           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        { 
             $data = $this->tolloperator_model->delete_lane_maping($_POST,$this->login_user_id); 
             if($data>0){
                
                  $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Lane Mapping deleted'),SUCCESS_CODE);
                  return;
                  
             }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       } 
        }
  
}
    public function paidTransaction()
    {       
       $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
      //  pd($_POST);
       $this->form_validation->set_rules('ts_id', 'Toll Staff', 'trim|required|xss_clean');
       $this->form_validation->set_rules('tc_id', 'Toll Center', 'trim|required|xss_clean');
       $this->form_validation->set_rules('user_id', 'User', 'trim|required|xss_clean');
       $this->form_validation->set_rules('type_id', 'Type Name', 'trim|required|xss_clean');
       $this->form_validation->set_rules('make_id', 'Make Name', 'trim|required|xss_clean');
       $this->form_validation->set_rules('model_id', 'MOdel Name', 'trim|required|xss_clean');
       $this->form_validation->set_rules('vehicle_id', 'Vehicle Number', 'trim|required|xss_clean');    
       $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|xss_clean'); 
       $this->form_validation->set_rules('email_id', 'Email', 'trim|required|xss_clean');
       $this->form_validation->set_rules('reg_type', 'Registration Type', 'trim|required|xss_clean');
       $this->form_validation->set_rules('one_way_charge', 'One Way Charge', 'trim|required|xss_clean');
       $this->form_validation->set_rules('two_way_charge', 'Two Way Charge', 'trim|required|xss_clean');
       $this->form_validation->set_rules('bmt_charge', 'BMT Charge', 'trim|required|xss_clean');    
       $this->form_validation->set_rules('paid_status', 'Paid Status', 'trim|required|xss_clean');
       $this->form_validation->set_rules('passing_status', 'Passing Status', 'trim|required|xss_clean');
       
         //$this->form_validation->set_rules('lane_id', 'Vehicle Number', 'trim|required|xss_clean');
       //$this->form_validation->set_rules('total_amount', 'Totl Amount', 'trim|required|xss_clean');
      // $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean|callback_check_password');
      
        if($this->form_validation->run() == false)
        {       
           // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {          
          $returnid = $this->tolloperator_model->paid($_POST,$this->login_user_id);
        if($returnid>0)
        {    //pd($returnid);exit;
            if($returnid==4){
            $this->rest->response(responseObject(SUCCESS_CODE,'','fail',success,'There is no sufficient amount in your wallet'),SUCCESS_CODE);  
            return;           
            }else{
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'You Paid Successfull'),SUCCESS_CODE);
            return;           
            }
           
        }
        else
        {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
        }
      }
    }
 public function passTransaction()
    {       
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
       // pd($_POST);exit;
       $this->form_validation->set_rules('tc_id', 'Toll Center', 'trim|required|xss_clean');
       $this->form_validation->set_rules('tc_name', 'Toll Center Name', 'trim|required|xss_clean');
       $this->form_validation->set_rules('user_id', 'User', 'trim|required|xss_clean');
       $this->form_validation->set_rules('role_id', 'Role', 'trim|required|xss_clean');
       $this->form_validation->set_rules('vehicle_id', 'Vehicle Id', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|xss_clean'); 

       $this->form_validation->set_rules('email_id', 'Email', 'trim|required|xss_clean');
       $this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|xss_clean');
       $this->form_validation->set_rules('toll_charge', 'Toll Charge', 'trim|required|xss_clean');
       $this->form_validation->set_rules('bmt_charge', 'BMT Charge', 'trim|required|xss_clean');
       $this->form_validation->set_rules('total_amount', 'Total Amount', 'trim|required|xss_clean');

       $this->form_validation->set_rules('passing_status', 'Status', 'trim|required|xss_clean');
       $this->form_validation->set_rules('paid_status', 'Status', 'trim|required|xss_clean');
      
        if($this->form_validation->run() == false)
        {       
           // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {  
                $mobileno=$_POST['mobile_no'];
                $vno=$_POST['vehicle_no'];
                $tcname=$_POST['tc_name'];
                $toll=$_POST['toll_charge'];
                $bmt=$_POST['bmt_charge'];
                $tot=$_POST['total_amount'];
           //     $mesaage='Your Vehicle No '.$vno.' has just passed through the '.$tcname.' TOLL CENTRE. The toll amount is TOLL AMOUNT Rs.'.$toll.' BMT SERVICE CHARGE Rs.'.$bmt.' TOTAL AMOUNT Rs.'.$tot;
$msg='Your Vehicle No '.$vno.' has just passed through the '.$tcname.' TOLL CENTRE. The toll amount is TOLL AMOUNT Rs.'.$toll.' BMT SERVICE CHARGE Rs.'.$bmt.' TOTAL AMOUNT Rs.'.$tot;
                $smsdata=array(
                       'mobilenumber'=>$mobileno,
                       'message'=>$msg
                   ); 
          $sms= $this->smscountry->sendSms($smsdata);
            
          $returnid = $this->tolloperator_model->pass($_POST,$this->login_user_id);
        if($returnid>0)
        {   // pd($returnid);exit;
            if($returnid==4){
            $this->rest->response(responseObject(SUCCESS_CODE,'','fail',success,'There is no sufficient amount in your wallet'),SUCCESS_CODE);  
            return;
            
            }else{

            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Transaction Successfull'),SUCCESS_CODE);
            return;
            
            }
           
        }
        else
        {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
        }
      }
    }
    public function consolldatedByCurrentDate(){
//echo "dfsf";exit;
         
        
          $data = $this->tolloperator_model->current_date($this->login_user_id);
         // pd($data);exit;
          if(count($data)>0){
           // pd($data);exit;
                  $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Date Wise History'),SUCCESS_CODE);
                  return;
          }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
          }

 }
 public function consolldatedByDate(){
//echo "dfsf";exit;
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
       // pd($_POST);exit;
       $this->form_validation->set_rules('date_wise', 'Date', 'trim|required|xss_clean');

        if($this->form_validation->run() == false)
        {       
           // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {  
        
          $data = $this->tolloperator_model->day_wise1($_POST,$this->login_user_id);
         // pd($data);exit;
          if(count($data)>0){
           // pd($data);exit;
                  $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Date Wise History'),SUCCESS_CODE);
                  return;
          }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
          }
}
 }
 public function consolldatedByPeriod(){

        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
       // pd($_POST);exit;
       $this->form_validation->set_rules('from_date', 'From Date', 'trim|required|xss_clean');
       $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|xss_clean');

        if($this->form_validation->run() == false)
        {       
           // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {  
        
          $data = $this->tolloperator_model->period_wise($_POST,$this->login_user_id);
          //pd($data);exit;
          if(count($data)>0){
            //pd($data);exit;
                  $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Period Wise History'),SUCCESS_CODE);
                  return;
          }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
          }
}
 }
 public function getLoginLaneMapping(){
    // echo "hi";exit;
    //echo $this->login_user_id;exit;
     $data = $this->tolloperator_model->getLanMapping($this->login_user_id);
   // pd($data);exit;
    if(!empty($data))
            {  // pd($data);exit;
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Profile List'),SUCCESS_CODE);
               return;
            }
       else{   //pd($data);exit;      
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
           }  
 }
 
}

#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
