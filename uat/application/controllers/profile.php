<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *@Class		User
 * @Developer	Lokesh
 * @Start Date	27/10/2015
 * @End Date	@todo
 */
class Profile extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata['user_data']->id;
		$this->auth_token = $this->session->userdata['user_data']->authtoken;
                $this->username = $this->session->userdata['user_data']->username;
	}
	public function index()
	{
           // print_r($this->session->userdata['user_data']);
            $this->rest->header("Authtoken",$this->auth_token);
            $response = $this->rest->get("user/getProfile");
             //    print_r($response->response);exit;
            //$this->rest->debug();exit;
		check_user_authorization($this->rest->status());
		//pd($response->response);
		$views = array('user/basic/profile');
		$data = array('views'=>$views,"user"=>$response->response);
		$this->load->view('user/template/template',$data);
	}
        public function profile_update(){ 
        //echo$this->auth_token;	echo "hi";exit;
          //  $this->rest->header("Authtoken",$this->auth_token);
            //$this->rest->header("Authtoken",$this->auth_token);
           // echo "<pre>";print_r($_POST);
       $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[20]|xss_clean');
       $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');
       $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');     
            
      if($this->form_validation->run() == true)
		{
          if($_FILES['profilepic']['name']!=''){
                $config['upload_path']   = 'uploads/resize/';
		$config['allowed_types'] = 'jpg|png|gif|jpeg';
		$config['max_size']		 = 5120;
		$this->upload->initialize($config);
      if (! $this->upload->do_upload('profilepic'))
		{
			header('HTTP/1.1 409 Unauthorized', true, 409);
			$error = $this->upload->display_errors('error');
			print_r($error);
		}
		else
		{
			$image_local_path = 0;
			$upload_data = $upload_data = $this->upload->data();
			$image_local_path = $upload_data['full_path'];
			$file_type = $upload_data['file_type'];
			$file_path = base_url('/uploads/members/'.$_FILES['profilepic']['name']);
			$folder    = 'members';
			$file_path = resizeImage($image_local_path,$folder);
                }
          }else{
              $file_path=$this->input->post('getimg');
          }
                    
			$this->requestobj['first_name']  = $this->input->post('first_name');
			$this->requestobj['last_name']  = $this->input->post('last_name');
			$this->requestobj['email_id']  = $this->input->post('email_id');
			$this->requestobj['mobile_no']  = $this->input->post('mobile_no');
                        $this->requestobj['profile_image']  = $file_path;
                      //  print_r($this->requestobj);exit;
                        
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//print_r($jsonObject);
			$this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('user/editWebProfile',$jsonObject);
			//echo $this->rest->debug();   exit;                    
                        //echo "<br/>"; print_r($response);exit;
                     
			if($response->statuscode == 200)
			{  //echo "<br/>"; print_r($response);exit;
                              $mstatus = @$response->response[0];  
                          //  $this->session->set_flashdata('phno',$phno);
                            $data['mstatus']=$mstatus;
                           // $this->load->view('profile',$data);  
				//redirect('user/otp');
                $this->rest->header("Authtoken",$this->auth_token);
                $presponse = $this->rest->get("user/getProfile");  
               // echo "<br/>"; print_r($presponse);exit;
        $views = array('user/basic/profile');
		$data = array('views'=>$views,"user"=>$presponse->response,'mstatus'=>$mstatus);
		$this->load->view('user/template/template',$data);
                            
                            
			}
			else{
                        
                            $data['error']=@$response->error;
                           // print_r($response->error);
                           // exit;
                            $this->load->view('profile',$data);				
			}
		}
		else
		{
		 $error= html_entity_decode(validation_errors());

		 $this->rest->header("Authtoken",$this->auth_token);
            $response = $this->rest->get("user/getProfile");
            check_user_authorization($this->rest->status());
			//print_r($response);exit;
		$views = array('user/basic/profile');
		$data = array('views'=>$views,"error"=>$error,"user"=>$response->response);
		$this->load->view('user/template/template',$data);
                  //  redirect('profile');
		}      
            

        }
        public function ajaxotp(){
          $this->rest->header("Authtoken",$this->auth_token);
                //   $response = $this->rest->get('checkRegisterotp?phonenumber='.$this->input->post('pno').'&&otp='.$this->input->post('otp'));
                       // echo $this->rest->debug();exit;
                        $this->requestobj['mobile_no']  = $this->input->post('mobile_no');
			$this->requestobj['otp']  = $this->input->post('otp');
                        
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//print_r($jsonObject);
			$response = $this->rest->post('user/updateMobileOTP',$jsonObject);
                        //echo $this->rest->debug();exit;
                        //echo "<pre>"; print_r($response);exit;
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
        public function updateotp(){
                $this->rest->header("Authtoken",$this->auth_token);
               
		$this->load->view('otpupdate');
            
        }
        public function imageUpload(){
            
    $image_local_path = 0;
   $upload_data = $upload_data = $this->upload->data();
   $image_local_path = $upload_data['full_path'];
   $file_type = $upload_data['file_type'];
   $file_path = base_url('/uploads/members/'.$_FILES['member_image']['name']);
   $folder    = 'members';
   $file_path = resizeImage($image_local_path,$folder);
   
   $this->requestobj['image_data']      = @$file_path;
   $this->requestobj['image_file_type'] = @$file_type;
   $initialize_variables = array('userID'=>$this->login_userid,'roleID'=>$this->roleId,'businessID'=>$this->business_id);
   $jsonObject = $this->mipproprerties->user_params($this->requestobj,$initialize_variables);
   $data = $this->rest->post('user/uploadProfilepic',$jsonObject);
            
            
            echo "<pre>";print_r($_POST);
            $config = array(
            'upload_path' => base_url('/uploads'),
            'allowed_types' => "jpg|jpeg|gif|png");
        $config['encrypt_name'] = TRUE;
        // echo $_FILES['file']['name'];exit;
        $this->load->library('upload', $config); //loading the upload library
        if (!$this->upload->do_upload("file")) {
            echo $this->upload->display_errors();
            //echo "error";
        } else {
            $image_data = $this->upload->data();
            $error = $image_data['file_name'];
            echo '<img src="' . base_url() . 'uploads/' . $image_data['file_name'] . '" width="313px" height="331px" alt=""/>';
            echo '<input type="hidden" name="upimg" id="upimg" value="' . $image_data['file_name'] . '">';
            
        }
        exit;
        }
        public function change_mobilenumber()
	{
		$this->form_validation->set_rules('new_number',"New Mobile Number",'trim|required|min_length[10]|max_length[10]|numeric|xss_clean');
		$this->form_validation->set_rules('old_number',"Old Mobile Number",'trim|required|min_length[10]|max_length[10]|numeric|xss_clean');
		if($this->form_validation->run() == false)
		{
			echo html_entity_decode(validation_errors());
			exit;
		}
		else{
			$this->requestobj['user_id']     = $this->user_id;
			$this->requestobj['newphonenumber'] = $this->input->post('new_number');
			$this->requestobj['oldphonenumber'] = $this->input->post('old_number');
			$this->requestobj['auth_token']  = $this->auth_token;
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			@$response = $this->rest->post('changePhoneNumber?',$jsonObject);
			echo json_encode($response);			
		}
	}
	public function change_email()
	{
		$this->form_validation->set_rules('new_email',"New Email",'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('old_email',"Old Email",'trim|required|valid_email|xss_clean');
		if($this->form_validation->run() == false)
		{
			echo html_entity_decode(validation_errors());
			exit;
		}
		else{
			$this->requestobj['newemail'] = $this->input->post('new_email');
			$this->requestobj['oldemail'] = $this->input->post('old_email');
			$this->requestobj['user_id'] = $this->user_id;
			$this->requestobj['auth_token'] = $this->auth_token;
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			@$response = $this->rest->post('changeEmail?',$jsonObject);
			echo json_encode($response);			
			exit;	
		}
	}	
	public function change_password()
	{
		$this->form_validation->set_rules('old_password',"Old Password",'trim|required|xss_clean');
		$this->form_validation->set_rules('new_password',"New Password",'trim|required|min_length[8]|max_length[19]|xss_clean');
		$this->form_validation->set_rules('confirm_password',"Confirm Password",'trim|required|xss_clean');
		if($this->form_validation->run() == false)
		{
			echo html_entity_decode(validation_errors());
			exit;
		}
		else{

			$this->requestobj['oldpassword'] = $this->input->post('old_password');
			$this->requestobj['newpassword'] = $this->input->post('new_password');
			$this->requestobj['confirmpassword'] = $this->input->post('confirm_password');

			$this->requestobj['user_id'] = $this->user_id;
			$this->requestobj['auth_token'] = $this->auth_token;
			$_POST = $this->requestobj;
			
			$jsonObject = $this->bmt->user_params($_POST);
			$this->rest->header("Authtoken",$this->auth_token);
			@$response = $this->rest->post('user/changePassword',$jsonObject);
			//$this->rest->debug();exit;
			echo json_encode($response);			
			exit;	
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/profile.php */