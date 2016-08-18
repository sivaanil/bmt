<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller
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
        $this->load->model('user_model');
        
      $this->login_user_details =  getWebLoginUserId();
      $this->login_user_id      =  $this->login_user_details['user_id'];
      $this->old_password       =  @$this->login_user_details['password'];

     
    } 
    
   
    public function getProfile(){   
    //echo "sds";
    $data = $this->user_model->getProfile($this->login_user_id);
    //pd($data);
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
public function editProfile(){
    
//        $this->login_user_details =  getWebLoginUserId();
//        $this->login_user_id      =  $this->login_user_details['user_id'];
    
    $this->requestObject = $this->rest->post("request");
     $_POST = $this->requestObject;
     
    //   echo "hi";exit;
       $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');
       $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');
     //echo "hi";exit;
//       if($this->requestObject['profile_image']==''){
//          $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');  
//        }
       // echo "hiff";exit;
      if($this->form_validation->run() == false){           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {  
          $mobile_no=$_POST['mobile_no']; 
          $mobilecount = $this->user_model->isExistMobile($mobile_no,$this->login_user_id);
         if($mobilecount==0){
               //echo $mobile;exit;
                $otp=random_numbers(4);             
               // $mobileno='9160606813';
                $mesaage='The OTP for the Mobile Update is '.$otp;
                $smsdata=array(
                       'mobilenumber'=>$mobile_no,
                       'message'=>$mesaage
                   );    
               $sms= $this->smscountry->sendSms($smsdata);
               if($sms){
                   $updata=array('first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'email_id'=>$_POST['email_id'],'otp'=>$otp,'otp_flag'=>0);
                   updaterecord('user_register',array('user_id'=>$this->login_user_id),$updata);                  
               }
           $result =array();
           $result[0]['mobile_no']= $mobile_no;
           $result[0]['mstatus']=1;           
           // pd($result);
            $this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,'Profile Updated Successfully.'),SUCCESS_CODE);
                return;   
         }else{   
            // echo "fff";
   // $imagename = $this->uploadImage($this->requestObject['profile_image'],$_POST['email_id']);    
       $data = $this->user_model->updateProfile($_POST,$this->login_user_id);
       // echo "ggg";exit;
      if($data>0)
            { 
             $result =array();
             $result[0]['mstatus']=0;
             $this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,'Profile Updated Successfully.'),SUCCESS_CODE);
                return;  
            }
       else{         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return;           
           } 
         }
   
  
      }
}
public function editWebProfile(){
    
//        $this->login_user_details =  getWebLoginUserId();
//        $this->login_user_id      =  $this->login_user_details['user_id'];
        //echo 'dshjf';exit;
    $this->requestObject = $this->rest->post("request");
     $_POST = $this->requestObject;
     
//echo "<pre>";print_r($_POST);exit;
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
         if($_POST['profile_image']!=''){
               $imagename = $this->uploadWebImage($_POST['profile_image'],$_POST['email_id']); 
             }else{
               $imagename='';   
             }    
            
          $mobile_no=$_POST['mobile_no']; 
          $mobilecount = $this->user_model->isExistMobile($mobile_no,$this->login_user_id);
         if($mobilecount==0){
               //echo $mobile;exit;
                $otp=random_numbers(4);             
               // $mobileno='9160606813';
                $mesaage='The OTP for the Mobile Update is '.$otp;
                $smsdata=array(
                       'mobilenumber'=>$mobile_no,
                       'message'=>$mesaage
                   );    
               $sms= $this->smscountry->sendSms($smsdata);
               if($sms){
                   $updata=array('first_name'=>$_POST['first_name'],
                       'last_name'=>$_POST['last_name'],
                       'email_id'=>$_POST['email_id'],
                       'profile_image'=>$imagename,
                       'otp'=>$otp,'otp_flag'=>0);
                   updaterecord('user_register',array('user_id'=>$this->login_user_id),$updata);                  
               }
           $result =array();
           $result[0]['mobile_no']= $mobile_no;
           $result[0]['mstatus']=1;           
           // pd($result);
            $this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,'Profile Updated Successfully.'),SUCCESS_CODE);
                return;   
         }else{   
            // echo "fff";
            
       $data = $this->user_model->updateWebProfile($_POST,$this->login_user_id,$imagename);
       // echo "ggg";exit;
      if($data>0)
            { 
             $result =array();
             $result[0]['mstatus']=0;
             $this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,'Profile Updated Successfully.'),SUCCESS_CODE);
                return;  
            }
       else{         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return;           
           } 
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
public function updateMobileOTP(){
  $this->requestObject = $this->rest->post("request");
  $_POST = $this->requestObject;  
  
  $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
  $this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|xss_clean');
   if($this->form_validation->run() == false){
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
   }else{
       //pd($_POST);
      // echo "hi";
      $data = $this->user_model->verifymobile_otp($_POST,$this->login_user_id); 
   //echo "hiddf";exit;
    //  exit;
       if(!empty($data))
            {   
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your OTP Verified Successfully.'),SUCCESS_CODE);
               return;
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,OTP_ACTIVATION_ERROR,'',fail,''),UNAUTHORIZED_CODE);
                return; 
       }
   }
  
}
public function updateWebProfileImage(){
  $this->requestObject = $this->rest->post("request");
  $_POST = $this->requestObject;  
  
  if($this->requestObject['profile_image']==''){
          $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');  
        }
        
   if($this->form_validation->run() == false){
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
   }else{      
    $imagename = $this->uploadMobileImage($this->requestObject['profile_image']);    
    $data = $this->user_model->uploadImage($this->login_user_id,$imagename);
    if(!empty($data))
            {            
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Profile Image Updated Successfully'),SUCCESS_CODE);
               return;
            }
       else{         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return;           
           }
   }   
}
public function updateMobileProfileImage(){
  $this->requestObject = $this->rest->post("request");
  $_POST = $this->requestObject;  
  //if($_POST['profile_image']==''){
          $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');  
        ///}
        
   if($this->form_validation->run() == false){
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
   }else{   
      // print_r($_POST['profile_image']);
   $imagename = $this->uploadMobileImage($_POST['profile_image']);    
  
    $data = $this->user_model->update_profile_image($this->login_user_id,$imagename);
    if($data>0)
            {   
            //$data=array('image_data'=>$imagename);
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Profile Image Updated Successfully'),SUCCESS_CODE);
               return;
            }
       else{         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return;           
           }
   }   
}
public function uploadImage($image)
    {
        $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($imageDataEncoded);
        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = strtotime(date('H:i:s')).".jpg";
        //$name = strtotime(date('H:i:s')).".jpg";
         $imageName = USER_IMG_PATH.$name;
        
        $imageSave = imagejpeg($rotate,$imageName,100);
        imagedestroy($source);
        $name = base_url().'uploads/'.$name;
        return $name;
    }
 public function uploadMobileImage($image)
    {
      //$data = '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';
    
      //  $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($image);
       
        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = strtotime(date('H:i:s')).".jpg";
   //    $name = strtotime(date('H:i:s')).".jpg";
         $imageName = USER_IMG_PATH.$name;
      // print_r($image);exit;  
        $imageSave = imagejpeg($rotate,$imageName,100);
        imagedestroy($source);
        $name = base_url().'uploads/'.$name;
        return $name;
    }

    public function changePassword()
    {
      $_POST = $this->requestObject;

      $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|max_length[30]');
      $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|max_length[30]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
      $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|max_length[30]|callback_checkToBeconMinarId|callback_checkBeconMinarId');
      if($this->form_validation->run() == false)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
              return;
      }
      if($_POST['oldpassword'] != $this->old_password)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,'Incorrect Old Password','',fail,'Incorrect Old Password'));
            return;
      }
      if($_POST['newpassword'] != $_POST['confirmpassword'])
      {
        $this->rest->response(responseObject(CONFLICT_CODE,'New Password And Confirm Password Not Matched','',fail,'New Password And Confirm Password Not Matched'));
            return;
      }
      $table_name = 'user_register';
      $where_condition =array('user_id'=>$this->login_user_id);
      $data = array('password'=>$_POST['newpassword']);
      updaterecord($table_name,$where_condition,$data);
      $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Password Changed Successfully'));
        return;
    }


    public function changePasswordMobile()
    {
      $_POST = $this->requestObject;

      $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|max_length[30]');
      $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|max_length[30]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
      if($this->form_validation->run() == false)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
              return;
      }
      if($_POST['old_password'] != $this->old_password)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,'Incorrect Old Password','',fail,'Incorrect Old Password'),CONFLICT_CODE);
            return;
      }
     
      $table_name = 'user_register';
      $where_condition =array('user_id'=>$this->login_user_id);
      $data = array('password'=>$_POST['new_password']);
      updaterecord($table_name,$where_condition,$data);
      $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Password Changed Successfully'));
        return;
    }




public function changePassword_old(){
  //  echo "dd";exit;
  $this->requestObject = $this->rest->post("request");
  $_POST = $this->requestObject;  
  
  $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
  $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean');
   if($this->form_validation->run() == false){
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
   }else{
       //pd($_POST);
      // echo "hi";
      $data = $this->user_model->change_password($_POST,$this->login_user_id); 
   //echo "hiddf";exit;
    //  exit;
       if($data>0)
            { 
     if($data==1) {     
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your Password Updated Successfull.'),SUCCESS_CODE);
               return;
     }else{
        $this->rest->response(responseObject(CONFLICT_CODE,'','',success,'Old Password is Incorrect.'),CONFLICT_CODE);
               return; 
     }
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
   } 
    }
public function feedback(){
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
       // pd($_POST);exit;
       $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
       $this->form_validation->set_rules('feedback', 'Feedback Comment', 'trim|required|xss_clean');

        if($this->form_validation->run() == false)
        {       
           // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {  
          // pd($_POST);
                $mesaage=$_POST['feedback'];
                $sugject=$_POST['subject'];
                $to='plexasyslaxmi@gmail.com';
                //$to=$_POST['email_id'];
                $sendmail= send_bmtmail($sugject,$to,$mesaage);
             if($sendmail){
                $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your feedback submitted successfuly'),SUCCESS_CODE);
               return;   
               }else{
                 $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
               }
        
      }
}
public function historyInfo(){
  $data = $this->user_model->history_info($this->login_user_id); 
//echo "<pre>"; print_r($data);exit;
   if(!empty($data)) {  
    if($data==4){
          $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Trasactions'),SUCCESS_CODE);
               return;
            
     }else{
        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'User History'),SUCCESS_CODE);
               return;
     }
   }else{
      $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
   }

}

public function consolldatedByDate()
{
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
        
          $data = $this->user_model->day_wise($_POST,$this->login_user_id);
         // pd($data);exit;
          if(count($data)>0){
           // pd( if($data==4){
    if($data==4){
          $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Trasactions'),SUCCESS_CODE);
               return;
            
     }else{
        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'User Day History'),SUCCESS_CODE);
               return;
     }
          }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
          }
      }
}
public function consolldatedByPeriod()
{
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
        
          $data = $this->user_model->period_wise($_POST,$this->login_user_id);
         // pd($data);exit;
          if(count($data)>0){
           // pd( if($data==4){
    if($data==4){
          $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'No Trasactions'),SUCCESS_CODE);
               return;
            
     }else{
        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'User Period History'),SUCCESS_CODE);
               return;
     }
          }else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
          }
      }
}
public function updateDeviceId(){//echo "hii";exit;
	$this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
      // pd($_POST);exit;
       $this->form_validation->set_rules('mobile_device_id', 'Mobile Token', 'trim|required|xss_clean');
       $this->form_validation->set_rules('device_type', 'Device Type', 'trim|required|xss_clean');
       

        if($this->form_validation->run() == false)
        {       
           // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {  
         $data = $this->user_model->update_token($_POST,$this->login_user_id); 
         if($data>0)
            { 
               $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Updated Successfully'),SUCCESS_CODE);
               return;
            }
            else{
            	$this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return; 
            }
        }

}
public function beaconPaid1(){
   // echo somefun();exit;
    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
    
    $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
    $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');
    
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
        $data = $this->user_model->beacon($_POST,$this->login_user_id); 
            if($data>0)
            { 
     if($data==4) {  
          $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'There is no BMT lanes'),SUCCESS_CODE);
               return;
            
     }else{
        $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your Transaction Completed'),SUCCESS_CODE);
               return;
     }
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
} 
/*public function beaconPaid(){
   // echo somefun();exit;
    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
    
    $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
    $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');
    
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
        $data = $this->user_model->becon_paid1($_POST,$this->login_user_id); 
            if($data>0)
            { 
     if($data==4) {  
          $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'There is no BMT lanes'),SUCCESS_CODE);
               return;
            
     }else{
        $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your Transaction Completed'),SUCCESS_CODE);
               return;
     }
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
} */ 
public function iospush(){
  $deviceid='7ae6050b455da4b81e8999691ecf314439e78be1a681f696664cf40e1454ee4a'  ;
  $msg="Welcome to Taya";
echo iosPushNote($deviceid,$msg);
}
public function push(){
      //$push_message = $_POST['push_message'];

      $push_message='hidh';

    if(!empty($push_message))
    {
      echo "df";
        // Create a new Amazon SNS client
        $sns = SnsClient::factory(array(
            'key'    => 'AKIAJLC2IMZWW7HSIYZA',
            'secret' => 'ADRDf+ZZVBmI9htCCv3A3b2BYOnHCDd0hi9/rvqB',
            'region' => 'ap-southeast-1'
            ));

        // region code samples: us-east-1, ap-northeast-1, sa-east-1, ap-southeast-1, ap-southeast-2, us-west-2, us-gov-west-1, us-west-1, cn-north-1, eu-west-1

       // $iOS_AppArn = "<iOS app's Application ARN>";
        $android_AppArn = "arn:aws:sns:ap-southeast-1:030821119767:app/GCM/BMT-S";

        // Get the application's endpoints
       // $iOS_model = $sns->listEndpointsByPlatformApplication(array('PlatformApplicationArn' => $iOS_AppArn));
        $android_model = $sns->listEndpointsByPlatformApplication(array('PlatformApplicationArn' => $android_AppArn));

        // Display all of the endpoints for the iOS application
       /* foreach ($iOS_model['Endpoints'] as $endpoint)
        {
            $endpointArn = $endpoint['EndpointArn'];
            echo $endpointArn;
        }

        // Display all of the endpoints for the android application
        foreach ($android_model['Endpoints'] as $endpoint)
        {
            $endpointArn = $endpoint['EndpointArn'];
            echo $endpointArn;
        }

        // iOS: Send a message to each endpoint
        foreach ($iOS_model['Endpoints'] as $endpoint)
        {*/
//$endpointArn = $endpoint['EndpointArn'];
          echo "hfcfi";exit;
$endpointArn='arn:aws:sns:ap-southeast-1:030821119767:endpoint/GCM/BMT-S/b2bd5729-7191-4054-a309-7f2c5d576d0c';

            try
            {
                $sns->publish(array('Message' => $push_message,
                    'TargetArn' => $endpointArn));

                echo "<strong>Success:</strong> ".$endpointArn."<br/>";
            }
            catch (Exception $e)
            {
                echo "<strong>Failed:</strong> ".$endpointArn."<br/><strong>Error:</strong> ".$e->getMessage()."<br/>";
            }
       /* }

        // android: Send a message to each endpoint
        foreach ($android_model['Endpoints'] as $endpoint)
        {
            $endpointArn = $endpoint['EndpointArn'];

            try
            {
                $sns->publish(array('Message' => $push_message,
                    'TargetArn' => $endpointArn));

                echo "<strong>Success:</strong> ".$endpointArn."<br/>";
            }
            catch (Exception $e)
            {
                echo "<strong>Failed:</strong> ".$endpointArn."<br/><strong>Error:</strong> ".$e->getMessage()."<br/>";
            }
        }*/
    }
    }
    //for beta version services
public function walletAmount(){   
    //echo "sds";
    $data = $this->user_model->getWallet($this->login_user_id);
   // pd($data);
    if($data>0)
            {  
            // pd($data);exit;
              $some=array('wallet_amount'=>100);

            $this->rest->response(responseObject(SUCCESS_CODE,'',$some,success,'User mobile detected by the device at the tollcenter'),SUCCESS_CODE);
               return;
            }
       else{   //pd($data);exit;      
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
           }  
}
 public function beaconIndentification(){

$data = $this->user_model->becon_identify($this->login_user_id);  
        if($data>0){

//$tot=$data['total_amount'];
      $msg="Amount Rs. 30 will be debited from User PayTm wallet.";

        $this->rest->response(responseObject(SUCCESS_CODE,'','',success,$msg),SUCCESS_CODE);
               return;  

        } else{
        $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
        } 

   // echo "ff";exit;
   /* $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
   // print_r($_POST);exit;
    $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
    $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');
    
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {}*/
}

  public function getUserSpecificData()
  {
    $this->rest->response(responseObject(SUCCESS_CODE,'',getWebLoginUserId(),success,''),SUCCESS_CODE);
    return;
  }
public function sendPushNotification(){


   // if (isset($_GET["regId"]) && isset($_GET["message"])) {
   // $regId = $_GET["regId"];
   // $message = $_GET["message"];
    // $regId="dP_mDsLe_WM:APA91bFdHduRIbua_Tpltg37wnJI-foszUkCRhJhkaQlAFOhsQCPSvFhMZ2B4OIzLoQ4hcnK6RrbSgczNtY0DBylzga5CRtvMom45HdBNSyAYUDIlbO9Epnu6aLArLY6DVotoIYLmSzy";
     $message =  "sai";
    //include_once './GCM.php';
  
     $regId=array(
     	"dP_mDsLe_WM:APA91bFdHduRIbua_Tpltg37wnJI-foszUkCRhJhkaQlAFOhsQCPSvFhMZ2B4OIzLoQ4hcnK6RrbSgczNtY0DBylzga5CRtvMom45HdBNSyAYUDIlbO9Epnu6aLArLY6DVotoIYLmSzy"

     	);
//print_r($regId);exit;
   // $gcm = new GCM();
   // $registatoin_ids = $regId;
   // $message1 = array("price" => $message);
    
  /*  $registatoin_ids = array($regId);
    $message1 = array("price" => $message);

*/
    $url = 'https://android.googleapis.com/gcm/send';

$registrationIDs = array( "reg id1","reg id2");

    // Message to be sent
    $message = "hi Shailesh";

    // Set POST variables
    //$url = 'https://android.googleapis.com/gcm/send';

    $fields = array(
        'registration_ids' => $regId,
        'data' => array( "message" => $message ),
    );





      /*  $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message1,
        );*/

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
       // echo $result;
print_r($result);exit;
//    $registatoin_ids = array($regId);
//    $message = array("price" => $message);
//
//    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
//}
}
//start payment integration with out wallet
public function beaconPaid(){
   // echo somefun();exit;

    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
    
    $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
    $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');
   // pd($_POST);exit;
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
       // $data = $this->user_model->beacon_method($_POST,$this->login_user_id); 
         $data = $this->user_model->beacon_service($_POST,$this->login_user_id); 
      //  pd($data);exit;

            if(!empty($data)){
//pd($data);exit;
               
if($data['msgcode']==400){
    //echo $data['msgcode'];exit;
    $this->rest->response(responseObject(CONFLICT_CODE,'','',nocontent,'No content returns empty results'),CONFLICT_CODE);
               return;
}else{
        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Your Transaction Amount'),SUCCESS_CODE);
               return;
}
     
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
} 
public function testbeaconPaid(){
   // echo somefun();exit;

    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
    
    $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
    $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');
   // pd($_POST);exit;
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
        $data = $this->user_model->beacon_service($_POST,$this->login_user_id); 
      //  pd($data);exit;

            if(!empty($data)){
//pd($data);exit;
               
if($data['msgcode']==400){
    //echo $data['msgcode'];exit;
    $this->rest->response(responseObject(CONFLICT_CODE,'','',nocontent,'No content returns empty results'),CONFLICT_CODE);
               return;
}else{
        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Your Transaction Amount'),SUCCESS_CODE);
               return;
}
     
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
} 
public function latLagPaid(){
   // echo somefun();exit;
    //echo $this->login_user_id;exit;
   
    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
   //$this->rest->response(responseObject(SUCCESS_CODE,'',$_POST,success,'Your Transaction Amount'),SUCCESS_CODE);
            //   return;
    $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|xss_clean');
    $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|xss_clean');
   // echo "<pre>"; print_r($_POST['latitude']);exit;
    //pd($_POST);exit;
    if($this->form_validation->run() == false)
        {       
          // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
        $data = $this->user_model->latlong_method($_POST,$this->login_user_id); 
      // pd($data);exit;
            if(!empty($data)){
if($data==4){
    $this->rest->response(responseObject(NO_CONTENT,'','',nocontent,'No content returns empty results'),NO_CONTENT);
               return;
}else{
        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Transaction Completed.'),SUCCESS_CODE);
               return;
}
     
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
}  
public function getTollcenter(){   
    //echo "sds";
    $data = $this->user_model->get_tollcenter($this->login_user_id);
  //  pd($data);exit;
    if(!empty($data))
            {  // pd($data);exit;
             
                $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Toocenter List'),SUCCESS_CODE);
               return;
             // }
            
            }
       else{   //pd($data);exit;      
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
           }  
}

public function getWayTypes(){
   // echo somefun();exit;
    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
    
    $this->form_validation->set_rules('tc_id', 'Tollcenter', 'trim|required|xss_clean');
    
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
        $data = $this->user_model->get_wayt_ypes_tc($_POST,$this->login_user_id); 
      //  pd($data);exit;

            if(!empty($data)){

        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Your Transaction Amount'),SUCCESS_CODE);
               return;
     
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
}
public function getLanesByToll(){
   // echo somefun();exit;
    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
    
    $this->form_validation->set_rules('tc_id', 'Tollcenter', 'trim|required|xss_clean');
    $this->form_validation->set_rules('way_type', 'Way', 'trim|required|xss_clean');
    
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
        $data = $this->user_model->get_lanes_by_toll($_POST,$this->login_user_id); 
      //  pd($data);exit;

            if(!empty($data)){

        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Your Transaction Amount'),SUCCESS_CODE);
               return;
     
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
}
public function storeOrder(){
   // echo somefun();exit;
    $this->requestObject = $this->rest->post("request");
    $_POST = $this->requestObject;
    
    $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('tracking_id', 'Tracking Id', 'trim|required|xss_clean');
    $this->form_validation->set_rules('order_status', 'Order Status', 'trim|required|xss_clean');
    $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
    
    if($this->form_validation->run() == false)
        {       
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {
        $data = $this->user_model->insert_order($_POST,$this->login_user_id); 
      //  pd($data);exit;

            if(!empty($data)){

        $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'your transaction is successful.'),SUCCESS_CODE);
               return;
     
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
            
        }
}
//end without wallet
}

#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
