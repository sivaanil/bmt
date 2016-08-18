<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserLogin extends CI_Controller
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
    }

    public function index()
    {
    	$this->requestObject = $this->rest->post("request");
        $this->objkeys= array_keys($this->loginObj);
        $this->rest->validateRequestObject($this->objkeys,$this->requestObject);
        $_POST = $this->requestObject;
        $this->form_validation->set_rules('login', 'Eamil', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]|xss_clean');
        if($this->form_validation->run() == false){
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'),CONFLICT_CODE);
            return;
          
        }
        else
        {

          $check_email = is_email($_POST['login']);
           
            if($check_email)
            { 
        
              $data = $this->user_model->login_email($_POST);  
            }
            else{ 
        
               $data = $this->user_model->login_mobile($_POST);    
            }
           // print_r($data);
          // echo "cc=".count($data);exit;
           // $data = $this->user_model->login($_POST);
            if(!empty($data))
            {
               
               header('authtoken:'.$data['auth_token']);
               //unset($data['auth_token']);
               $sessdata=array(
                   'id'=>$data['user_id'],
                   'authtoken'=>$data['auth_token'],
                   'username'=>$data['first_name']
               );
               $UserInfo['UserInfo'] = $sessdata;              
               $this->rest->response(responseObject(SUCCESS_CODE,'',$UserInfo,success,'Login Successfull'),SUCCESS_CODE);
               return; 
            }
            else
            {
                $this->rest->response(responseObject(REGISTER_UNAUTH_CODE,REGISTER_UNAUTHORIZED,'',fail,''),REGISTER_UNAUTH_CODE);
                return; 
            }
            
        }
    }
    public function iospush(){
  $deviceid='73fecf35eaeeac149f8f1f0a101604ba7a8aefb25375ded4cc67f495a4d620a3'  ;
$tHost = 'gateway.sandbox.push.apple.com';

$tPort = 2195;

// Provide the Certificate and Key Data.

$tCert = '/var/www/html/bmtservices/PushNotificationAppCertificateKey.pem';

// Provide the Private Key Passphrase (alternatively you can keep this secrete

// and enter the key manually on the terminal -> remove relevant line from code).

// Replace XXXXX with your Passphrase

$tPassphrase = 'taya@123';

// Provide the Device Identifier (Ensure that the Identifier does not have spaces in it).

// Replace this token with the token of the iOS device that is to receive the notification.

$tToken = '73fecf35eaeeac149f8f1f0a101604ba7a8aefb25375ded4cc67f495a4d620a3';

// The message that is to appear on the dialog.

$tAlert = 'You have a LiveCode APNS Message';

// The Badge Number for the Application Icon (integer >=0).

$tBadge = 8;

// Audible Notification Option.

$tSound = 'default';

// The content that is returned by the LiveCode "pushNotificationReceived" message.

$tPayload = 'APNS Message Handled by LiveCode';

// Create the message content that is to be sent to the device.

$tBody['aps'] = array (

'alert' => $tAlert,

'badge' => $tBadge,

'sound' => $tSound,

);

$tBody ['payload'] = $tPayload;

// Encode the body to JSON.

$tBody = json_encode ($tBody);

// Create the Socket Stream.

$tContext = stream_context_create ();

stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);

// Remove this line if you would like to enter the Private Key Passphrase manually.

stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);

// Open the Connection to the APNS Server.

$tSocket = stream_socket_client ('ssl://'.$tHost.':'.$tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $tContext);

// Check if we were able to open a socket.

if (!$tSocket)
  //  {

exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);
//}else{
   //    exit ("Connection OK\n");
//}

// Build the Binary Notification.

//$payload = json_encode($tBody);

      $msg = chr(0).pack('n',32).pack('H*', str_replace(' ', '', $tToken)).pack('n',strlen($tBody)).$tBody;

      print "sending message :" . $tBody . "\n";

      fwrite($tSocket, $msg);

      fclose($tSocket);
exit;

$tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $tToken) . pack ('n', strlen ($tBody)) . $tBody;

// Send the Notification to the Server.

$tResult = fwrite ($tSocket, $tMsg, strlen ($tMsg));
//echo "<pre>"; print_r($tResult);exit;
if ($tResult)

echo 'Delivered Message to APNS' . PHP_EOL;

else

echo 'Could not Deliver Message to APNS' . PHP_EOL;

// Close the Connection to the Server.

fclose ($tSocket);
}
    public function fblogin(){
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

      //  echo "<pre>";print_r($_POST);
        $this->form_validation->set_rules('email', 'Eamil', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('facebook_id', 'Facebook Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('profile_image', 'Last Name', 'trim|required|xss_clean');


        if($this->form_validation->run() == false){
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'),CONFLICT_CODE);
            return;
          
        }
        else
        {

         $imagename = $this->uploadWebImage($_POST['profile_image'],$_POST['email']);
         if( $imagename!=''){
          $img=$imagename;
         }else{
          $img="";
         }
//echo "ff".$img;exit;
         $data = $this->user_model->fb_register_login($_POST,$img);  
          // echo "<pre>";print_r($data);exit;
          // echo "cc=".count($data);exit;
           // $data = $this->user_model->login($_POST);
            if(!empty($data))
            {
              
               header('authtoken:'.$data['auth_token']);
               //unset($data['auth_token']);
               $sessdata=array(
                   'id'=>$data['user_id'],
                   'authtoken'=>$data['auth_token'],
                   'username'=>$data['first_name'].''.$data['last_name']
               );
               //echo "<pre>";print_r($data);exit; 
               $UserInfo['UserInfo'] = $sessdata;              
               $this->rest->response(responseObject(SUCCESS_CODE,'',$UserInfo,success,'Login Successfull'),SUCCESS_CODE);
               return; 
            }
            else
            {
                $this->rest->response(responseObject(REGISTER_UNAUTH_CODE,REGISTER_UNAUTHORIZED,'',fail,''),REGISTER_UNAUTH_CODE);
                return; 
            }
            
        }
    }
    public function uploadWebImage($image,$email)
    {
        $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($imageDataEncoded);
        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = md5($email).strtotime(date('H:i:s')).".jpg";
        //$name = strtotime(date('H:i:s')).".jpg";
        $imageName = USER_IMG_PATH.$name;
        
        $imageSave = @imagejpeg($rotate,$imageName,100);
        imagedestroy($source);
        $name = base_url().'uploads/'.$name;
        return $name;
    }
public function register()
    {
    //echo "hi";exit;
        $this->requestObject = $this->rest->post("request");
         //$this->load->model('tollstaff_model','tollstaff');
        //$this->load->library('authorization');
        $this->objkeys= array_keys($this->regObj);
        $this->rest->validateRequestObject($this->objkeys,$this->requestObject);
        
        $_POST = $this->requestObject;
       // echo '<pre>';print_r($_POST);exit;
       $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|max_length[30]|is_unique[user_register.email_id]|xss_clean');
       $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
       $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|is_unique[user_register.mobile_no]|xss_clean');
      // $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean|callback_check_password');
       
        if($this->form_validation->run() == false){           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {           
         $returnid = $this->user_model->register($_POST);
            if(count($returnid))
            { 
            
                $otp=random_numbers(4);
              //  $activation_code=$this->encrypt->encode_my($otp);
               // $mobileno='9160606813';
                $mobileno=$_POST['mobile_no'];
                $mesaage='The OTP for the BMT Registration is '.$otp;
                $sugject='User Activation';
                //$to='plexasyslaxmi@gmail.com';
                $to=$_POST['email_id'];
                $msg='your registration was successful cilck this link to activate ur account <a href="http://bookmytoll.com/user/activation?uid='.$returnid.'&&activecode='.$otp.'">clickhere</a>';
                   $smsdata=array(
                       'mobilenumber'=>$mobileno,
                       'message'=>$mesaage
                   );    
               $sms= $this->smscountry->sendSms($smsdata);
               if($sms){
                   updaterecord('user_register',array('user_id'=>$returnid),array('otp'=>$otp));
               }
                    
             $sendmail= send_bmtmail($sugject,$to,$msg);
             if($sendmail){
                   updaterecord('user_register',array('user_id'=>$returnid),array('activation_code'=>$otp));
               }
               $result = $this->db->select('*')->where(array('user_id'=>$returnid))->get('user_register')->result_array();
            //   print_r($result);exit;
               $this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,'Registration Successfull'),SUCCESS_CODE);
               return; 
            }
            else
            {
                $this->rest->response(responseObject(SERVERERROR_CODE,'','',fail,SERVER_ERROR),SERVERERROR_CODE);
                return; 
            }
        }
    }
public function mobileActivation(){
  $this->requestObject = $this->rest->post("request");
  $_POST = $this->requestObject;  
  $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
   if($this->form_validation->run() == false){
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
   }else{
      $data = $this->user_model->verify_otp($_POST); 
      //pd($data);
      //exit;
       if(!empty($data))
            {   
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Registration Successfull'),SUCCESS_CODE);
               return;
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,OTP_ACTIVATION_ERROR,'',fail,''),UNAUTHORIZED_CODE);
                return; 
       }
   }
  
}

public function emailActivation($userid,$activationcode){
   // echo $userid;
    $data = $this->user_model->activate_email($userid,$activationcode);
    if(!empty($data))
            {   
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Account activated Successfull'),SUCCESS_CODE);
               return;
            }
       else{
           //echo $data;exit;
           if($data==0){
               $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,EMAIL_ACTIVATION_ERROR),UNAUTHORIZED_CODE);
                return; 
           }else{
               $this->rest->response(responseObject(SERVERERROR_CODE,'','',fail,SERVER_ERROR),SERVERERROR_CODE);
                return; 
           }
       } 
}
  public function forgotPassword(){
  //  echo "dd";exit;
  $this->requestObject = $this->rest->post("request");
  $_POST = $this->requestObject;  
  
  $this->form_validation->set_rules('email_id', 'Email Id', 'trim|required|valid_email|xss_clean');
  $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');
   if($this->form_validation->run() == false){
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
   }else{
       //pd($_POST);
      // echo "hi";
      $data = $this->user_model->forgot_password($_POST); 
   //echo "hiddf";exit;
    //  exit;
       if($data>0)
            { 
     if($data==1) {   
             $password=generateRandomString(7);
             $sugject='User Forgot Password';
                //$to='plexasyslaxmi@gmail.com';
             $to=$_POST['email_id'];
             $msg='Your Password is <strond>"'.$password.'".</strong> Please login and update your password';
             $sendmail= send_bmtmail($sugject,$to,$msg);
             if($sendmail){
                   updaterecord('user_register',array('email_id'=>$_POST['email_id'],'mobile_no'=>$_POST['mobile_no']),array('password'=>$password));
               }      
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your Password Sent to Your Email Id'),SUCCESS_CODE);
               return;
     }else{
        $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'You are Not a Registered User of BMT'),SUCCESS_CODE);
               return; 
     }
            }
       else{
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
              return; 
       }
   } 
    }


    public function forGetPassword()
    {
      $this->requestObject = $this->rest->post("request");
      $_POST = $this->requestObject; 
      $check_email = is_email($_POST['email']);
      if($check_email)
      { 
        //pd($_POST);
        $table_name = "user_register";
        $where_condition = array('email_id'=>$_POST['email']);
        $num_rows = checkValues($table_name,$where_condition);     
        if($num_rows)
        {
          $verification_code = md5($_POST['email'].time());
          //$link = $_POST['url'].$verification_code;
          $link = "http://bookmytoll.com/user/resetpassword/".$verification_code;
          
          $table_name = "user_register";
          $where_condition = array('email_id'=>$_POST['email']);
          $data = array('activation_code'=>$verification_code);

          if(updaterecord($table_name,$where_condition,$data))
          {
            $to      = $_POST['email'];
            $subject = "URL To Reset Password for BMT Login";
            $data = array('name'=>$link);
            $message = $this->load->view('email/send_link',$data,true);
            sendPassword($message,$to,$subject);
            $data = array('status'=>1);
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Please Check Your Email For Reset Password'),SUCCESS_CODE);
            return;
          }
        }
        else
        {
          $this->rest->response(responseObject(CONFLICT_CODE,"Email Not Registered",'',fail,''),CONFLICT_CODE);
          return; 
        }
      }
      else
      { 
        $otp=random_numbers(4);
        $msg="OTP For Reset Password For BMT, Don't Share It With Any One ".$otp;
        $mobileno = $_POST['email'];
        
        $table_name = "user_register";
        $where_condition = array('mobile_no'=>$_POST['email']);
        $num_rows = checkValues($table_name,$where_condition);     
        if($num_rows)
        {
          $where_condition = array('mobile_no'=>$_POST['email']);
          $data = array('otp'=>$otp);
          updaterecord($table_name,$where_condition,$data);
          $smsdata=array(
             'mobilenumber'=>$mobileno,
             'message'=>$msg
          );    
          $sms= $this->smscountry->sendSms($smsdata);
          if($sms){
            $data = array('status'=>2);
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Plase Enter OTP Number Which is Send To Your Registered Mobile Number'),SUCCESS_CODE);
            return;
          }
          /*if(1)
          {
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Plase Enter OTP Number Which is Send To Your Registered Mobile Number'),SUCCESS_CODE);
            return;
          }*/
          else
          {
            $this->rest->response(responseObject(CONFLICT_CODE,"Try After Some Time.",'',fail,''),CONFLICT_CODE);
            return;
          }
        }
        else
        {
          $this->rest->response(responseObject(CONFLICT_CODE,"Mobile Number Not Registered",'',fail,''),CONFLICT_CODE);
          return; 
        }
      } 

    }

    public function verifyOtp()
    {
      $this->requestObject = $this->rest->post("request");
      $_POST = $this->requestObject;
      $this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|xss_clean');
      $this->form_validation->set_rules('otp', 'Otp', 'trim|required|xss_clean');
      if($this->form_validation->run() == true)
      {
         $table_name = "user_register";
         $where_condition = array('mobile_no'=>$_POST['mobile_no'],'otp'=>$_POST['otp']);
         $num_rows = checkValues($table_name,$where_condition);     
         if($num_rows)
         {
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Enter New Password'),SUCCESS_CODE);
            return;
         }
         else
         {
            $this->rest->response(responseObject(CONFLICT_CODE,"Invalid OTP",'',fail,''),CONFLICT_CODE);
            return;
         }
      }
      else
      {
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
      }
    }

    public function updatePassword()
    {
      $this->requestObject = $this->rest->post("request");
      $_POST = $this->requestObject;
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
      $this->form_validation->set_rules('activation_code', 'Activation', 'trim|required|xss_clean');
      if($this->form_validation->run() == false)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
      }
      else
      {
        $table_name = 'user_register';
        $where_condition =array('activation_code'=>$_POST['activation_code']);
        $data = array('password'=>'');
        updaterecord($table_name,$where_condition,$data);
        //exit;
        $table_name = 'user_register';
        $where_condition =array('activation_code'=>$_POST['activation_code']);
        $data = array('password'=>$_POST['password']);
        if(updaterecordpassword($table_name,$where_condition,$data))
        {
          $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Password Rested Successfully'));
          return;
        }
        else
        {
          $this->rest->response(responseObject(CONFLICT_CODE,"Try After Some Time",'',fail,''),CONFLICT_CODE);
          return;
        }
      }
    }
    public function updatePasswordByMobileNumber()
    {
      $this->requestObject = $this->rest->post("request");
      $_POST = $this->requestObject;
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
      $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|xss_clean');
      if($this->form_validation->run() == false)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'));
        return;
      }
      else
      {
        $table_name = "user_register";
        $where_condition = array('mobile_no'=>$_POST['mobile_no']);
        $num_rows = checkValues($table_name,$where_condition); 
        if(!$num_rows)
        {
          $this->rest->response(responseObject(CONFLICT_CODE,"Invalid Mobile Number",'',fail,''),CONFLICT_CODE);
          return;
        }
        $table_name = 'user_register';
        $where_condition =array('mobile_no'=>$_POST['mobile_no']);
        $data = array('password'=>'');
        updaterecordpassword($table_name,$where_condition,$data);
        $table_name = 'user_register';
        $where_condition =array('mobile_no'=>$_POST['mobile_no']);
        $data = array('password'=>$_POST['password']);
        if(updaterecordpassword($table_name,$where_condition,$data))
        {
          $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Password Rested Successfully'));
          return;
        }
        else
        {
          $this->rest->response(responseObject(CONFLICT_CODE,"Try After Some Time",'',fail,''),CONFLICT_CODE);
          return;
        }
      }
    }

}

#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
