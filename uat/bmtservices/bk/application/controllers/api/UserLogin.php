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
          // echo "cc=".count($data);exit;
           // $data = $this->user_model->login($_POST);
            if(!empty($data))
            {
               header('authtoken:'.$data['auth_token']);
               unset($data['auth_token']);
               $UserInfo['UserInfo'] = $data;
               $this->rest->response(responseObject(SUCCESS_CODE,'',$UserInfo,success,'Login Successfull'),SUCCESS_CODE);
               return; 
            }
            else
            {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,REGISTER_UNAUTHORIZED),UNAUTHORIZED_CODE);
                return; 
            }
        }
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
       $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
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
                $mesaage=$otp.' Your Dynmic OTP for BMT Registration';
                $sugject='User Activation';
                //$to='plexasyslaxmi@gmail.com';
                $to=$_POST['email_id'];
                $msg='your registration was successful cilck this link to activate ur account<a href="http://localhost/bmt/user/activation?uid='.$returnid.'&&activecode='.$otp.'">clickhere</a>';
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
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,OTP_ACTIVATION_ERROR),UNAUTHORIZED_CODE);
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
}

#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
