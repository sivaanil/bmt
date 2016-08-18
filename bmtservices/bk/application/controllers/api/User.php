<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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

     
    }  
public function getProfile(){   
    //echo "sds";
    $data = $this->user_model->getProfile($this->login_user_id);
    //pd($data);
    if(!empty($data))
            {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Profile List'),SUCCESS_CODE);
               return;
            }
       else{         
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
       $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
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
                $mobileno='9160606813';
                $mesaage=$otp.' Your Dynmic OTP for BMT Registration';
                $smsdata=array(
                       'mobilenumber'=>$mobileno,
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
            $this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,'Profile Updated Successfuly'),SUCCESS_CODE);
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
             $this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,'Profile Updated Successfuly'),SUCCESS_CODE);
                return;  
            }
       else{         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
                return;           
           } 
         }
   
  
      }
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
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your OTP Verified Successfull'),SUCCESS_CODE);
               return;
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,OTP_ACTIVATION_ERROR),UNAUTHORIZED_CODE);
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
  
  if($this->requestObject['profile_image']==''){
          $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');  
        }
        
   if($this->form_validation->run() == false){
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
   }else{      
    $imagename = $this->uploadMobileImage($this->requestObject['profile_image']);    
    $data = $this->user_model->update_profile_image($this->login_user_id,$imagename);
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
 public function uploadMobileImage($imageDataEncoded)
    {
      //  $imageDataEncoded = base64_encode(file_get_contents($image));
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
}

#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
