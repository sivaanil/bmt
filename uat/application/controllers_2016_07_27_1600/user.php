<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @Class		User
 * @Developer	Ramesh
 * @Start Date	27/10/2015
 * @End Date	@todo
 */
class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * [index description] [Redirect to Launching screen of User]
	 * @return [type]      []
	 * [request method]    []
	 * [request]		   [BASE_URL/user]
	 * [response]		   []
	 */	
	public function index()
	{
		//$this->load->view('user/basic/launchscreen');
		$this->load->library('facebook');
        $user = $this->facebook->getUser();
	
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('user/fblogin'), 
                'scope' => array("email") // permissions here
            ));
        
	
			$this->load->view('user/basic/login',$data);
	}

	public function login()
	{		
		$this->form_validation->set_rules('email', 'Eamil', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]|xss_clean');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['login']  = $this->input->post('email');
			$this->requestobj['password']  = $this->input->post('password');

			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			
			$response = $this->rest->post('userlogin',$jsonObject);
			//$this->rest->debug();exit;
            if($response->statuscode == 200)
			{
                         // print_r($response->response->UserInfo);exit;
				$userdata['user_data'] = $response->response->UserInfo;
				$this->session->set_userdata($userdata);
                                //echo "ff";exit;
				//echo "<pre>";print_r($this->session->all_userdata());exit; 
				redirect('profile');
                                
			}
			else
			{  //print_r($response);exit;
				$message = @$response->error[0];
				$this->session->set_flashdata("msg",@$message);
				redirect('user/login');
			}
		}
		else
		{
	
			$this->load->library('facebook');
        $user = $this->facebook->getUser();
	
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('user/fblogin'), 
                'scope' => array("email") // permissions here
            ));
        
	
			$this->load->view('user/basic/login',$data);
		}
	}
public function fblogin(){
	        $this->load->library('facebook');
			$user = $this->facebook->getUser();
	     if ($user) {
            try {
                //$data['user_profile'] = $this->facebook->api('/me?fields=picture,email,first_name,last_name');
              $fbdata=  $this->facebook->api('/me?fields=picture,email,first_name,last_name');
              $img=$fbdata['picture']['data']['url'];
               //echo "<pre>";print_r($fbdata);


            $this->requestobj['email']  = $fbdata['email'];
			$this->requestobj['first_name']  = $fbdata['first_name'];
			$this->requestobj['last_name']  = $fbdata['last_name'];
			$this->requestobj['facebook_id']  = $fbdata['id'];
			$this->requestobj['profile_image']  = $img;

			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
//echo "<pre>";print_r($jsonObject);
			$response = $this->rest->post('userlogin/fblogin',$jsonObject);
			//$this->rest->debug();exit;
			  if($response->statuscode == 200)
			{
                         // print_r($response->response->UserInfo);exit;
				$userdata['user_data'] = $response->response->UserInfo;
				$this->session->set_userdata($userdata);
                                //echo "ff";exit;
				//echo "<pre>";print_r($this->session->all_userdata());exit; 
				redirect('profile');
                                
			}
			else
			{  //print_r($response);exit;
				$message = @$response->error[0];
				$this->session->set_flashdata("msg",@$message);
				redirect('user/login');
			}
   

            } catch (FacebookApiException $e) {
                $user = null;
               // echo "ff";exit;
            }
        }

}
	public function registration()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean|callback_check_password');
		//$this->form_validation->set_rules('otp', 'OTP', 'trim|required|min_length[8]|max_length[20]|xss_clean');
		if($this->form_validation->run() == true)
		{
                    
			$this->requestobj['first_name']  = $this->input->post('first_name');
			$this->requestobj['last_name']  = $this->input->post('last_name');
			$this->requestobj['email_id']  = $this->input->post('email_id');
			$this->requestobj['password']  = $this->input->post('password');
			$this->requestobj['mobile_no']  = $this->input->post('mobile_no');
                        
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//print_r($jsonObject);
			$response = $this->rest->post('userlogin/register',$jsonObject);
			//echo $this->rest->debug();  exit;                     
                        //echo "<br/>"; print_r($response);exit;
                
			if($response->statuscode == 200)
			{  //echo "<br/>"; print_r($response);
                              $userid = @$response->response[0]->user_id;  
                          //  $this->session->set_flashdata('phno',$phno);
                            $data['userid']=$userid;
                            //$this->load->view('user/basic/otp',$data);  
                             $this->load->view('user/basic/registration',$data);
				//redirect('user/otp');
			}
			else{
                        
                            $data['error']=@$response->error;
                           // print_r($response->error);
                           // exit;
                            $this->load->view('user/basic/registration',$data);				
			}
		}
		else
		{

			$this->load->view('user/basic/registration');
		}
	}
        public function otp(){
             $this->load->view('user/basic/otp');  
        }
        
        public function ajaxotp(){
          
                //   $response = $this->rest->get('checkRegisterotp?phonenumber='.$this->input->post('pno').'&&otp='.$this->input->post('otp'));
                       // echo $this->rest->debug();exit;
                        $this->requestobj['user_id']  = $this->input->post('userid');
			$this->requestobj['otp']  = $this->input->post('otp');
                        
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//print_r($jsonObject);
			$response = $this->rest->post('userlogin/mobileActivation',$jsonObject);
            // $this->rest->debug();exit;           
                        if($response->statuscode == 200)
			{
            $message = @$response->successMessage;
            $arr = array('ans' => 'success', 'res' => $message);
            echo json_encode($arr);
			}
			else{
                       $message = @$response->error[0];
                   $arr = array('ans' => 'failure', 'res' => $message);
                   echo json_encode($arr);
				
			}  
                }
  public function activation(){
      $uid=$_GET['uid'];
      $activecode=$_GET['activecode'];      
      $response = $this->rest->get('userlogin/emailActivation/'.$uid.'/'.$activecode.'/');    
              if($response->statuscode == 200)
			{
              $regsus = @$response->successMessage;    
            $this->session->set_flashdata('susmsg',$regsus);
            redirect('user/login');
			}
			else{
                       $message = @$response->error[0];
                       $this->session->set_flashdata('errormsg',$message);
                   redirect('user/login');				
			}
  }              
        
//        public function otp(){
//            
//            $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
//            if($this->form_validation->run() == true)
//		{
//                   $response = $this->rest->get('checkRegisterotp?phonenumber='.$this->input->post('pno').'&&otp='.$this->input->post('otp'));
//                        echo $this->rest->debug();exit;
//                        if($response->statuscode == 200)
//			{
//                             $msg= @$response->successMessage;  
//                            $this->session->set_flashdata('susmsg',$msg);
//                            //$data['pno']=$pno;
//                           // $this->load->view('user/basic/otp',$data);  
//				redirect('user/login');
//			}
//			else{
//                        
//                            $data['error']=@$response->error;
//                            $this->load->view('user/basic/otp',$data);				
//			}
//                     //$this->load->view('user/basic/otp');    
//                }
//                else{                   
//             $this->load->view('user/basic/otp');
//                }
//        }
	public function logout()
	{
		$this->load->library('facebook');
        $this->facebook->destroySession();
		$this->session->userdata['user_data'] = "";
		$this->session->set_flashdata('msg', $this->session->flashdata('msg'));	
		redirect('user/login');
	}

	public function forgetpassword()
	{
		
		$this->form_validation->set_rules('email', 'Email/Mobile Number', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == true)
		{
            $this->requestobj['email']  = $this->input->post('email');
			$this->requestobj['url']  = base_url().'user/resetpassword/';
			$_POST = $this->requestobj;
			//pd($_POST);
			$jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject;exit;
			$response = $this->rest->post('userlogin/forGetPassword',$jsonObject);
			//echo $this->rest->debug(); 
			//exit;
			//echo json_encode($response);
           
			if(filter_var($this->requestobj['email'], FILTER_VALIDATE_EMAIL)) 
			{
				$data['type'] = 1;
				$data['response'] = $response;
				echo json_encode($data);
			} 
			else 
			{
				$data['type'] = 2;
				$data['response'] = $response;
				echo json_encode($data);
			}
          
		}
		else
		{

			$this->load->view('user/basic/forgetpassword');
		}
	}

	public function resetpassword()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == true)
		{
            $this->requestobj['password']  = $this->input->post('password');
            $this->requestobj['activation_code']  = $this->uri->segment(3);
			$_POST = $this->requestobj;
			
			$jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject;exit;
			$response = $this->rest->post('userlogin/updatePassword',$jsonObject);
			//echo $this->rest->debug(); 
			//exit;
            if($response->statuscode == 200)
			{  
				$message = @$response->successMessage;
				$this->session->set_flashdata("successmsg",@$message);
				redirect('user/login');
            }
			else
			{
                $message = @$response->error[0];
				$this->session->set_flashdata("msg",@$message);
				redirect('user/resetpassword/'.$this->uri->segment(3));	
			}
		}
		else
		{

			$this->load->view('user/basic/reset');
		}
	}

	public function otpverification()
	{
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean');
		$this->form_validation->set_rules('otp', 'Otp', 'trim|required|xss_clean');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['mobile_no']  = $_POST['mobile'];
            $this->requestobj['otp']  = $_POST['otp'];
			$_POST = $this->requestobj;
			
			$jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject;exit;
			$response = $this->rest->post('userlogin/verifyOtp',$jsonObject);
			//$this->rest->debug();exit;
			//pd($response);
			echo json_encode($response);
		}
	}

	public function resetpasswordbyotp()
	{
		//echo "dsfsdf";exit;
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if($this->form_validation->run() == true)
		{
            $this->requestobj['password']  = $this->input->post('password');
            $this->requestobj['mobile_no']  = $_GET['mobile'];
			$_POST = $this->requestobj;
			
			$jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject;exit;
			$response = $this->rest->post('userlogin/updatePasswordByMobileNumber',$jsonObject);
			//echo $this->rest->debug(); 
			//exit;
            if($response->statuscode == 200)
			{  
				$message = @$response->successMessage;
				$this->session->set_flashdata("successmsg",@$message);
				redirect('user/login');
            }
			else
			{
                $message = @$response->error[0];
				$this->session->set_flashdata("msg",@$message);
				redirect("user/resetpasswordbyotp?mobile=".$_GET['mobile']);			
			}
		}
		else
		{
			$this->load->view('user/basic/reset_otp');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/user.php */
