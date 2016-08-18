<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toll extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	
	public function index()
	{
		//echo "string";exit;
		/*$views = array('toll/test');
		$data = array('views'=>$views);
		$this->load->view('toll/template/template',$data);*/
		$this->load->view('toll/login/login');
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Eamil', 'trim|required|valid_email|max_length[30]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if($this->form_validation->run() == true)
		{
			//echo "string";exit;
			$this->requestobj['email']  = $this->input->post('email');
			$this->requestobj['password']  = $this->input->post('password');

			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			$response = $this->rest->post('superadminlogin/userlogin',$jsonObject);
			//echo "<pre>";print_r($response);exit;
			//echo $jsonObject;exit;
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				$userdata['user_data'] = $response->response->TollStaffInfo;
				//$userdata['auth_token']  = '';

				$this->session->set_userdata($userdata);
				//echo $this->session->userdata['user_data']->roll_id;exit;
				if($this->session->userdata['user_data']->roll_id == 1)
					redirect('tollcenter');
				else if($this->session->userdata['user_data']->roll_id == 3)
					redirect('addtolloperator');
                                 else if($this->session->userdata['user_data']->roll_id == 4)
					redirect('tolloperator/dialyoperations');
			}
			else
			{
				$message = @$response->error[0];
				//echo "<pre>";print_r($response);
				//echo $message;exit;
				$this->session->set_flashdata("msg",@$message);
				redirect('toll');
			}
		}
		else
		{
	
			redirect('toll','refresh');
		}
	}

	public function fogetpassword()
	{
		$this->form_validation->set_rules('email', 'Eamil', 'trim|required|valid_email|max_length[30]|xss_clean');
		if($this->form_validation->run() == true)
		{
		//echo "string";exit;
			//echo "string";exit;
			$this->requestobj['email']  = $this->input->post('email');
			
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject;exit;
			$response = $this->rest->post('superadminlogin/foretPassword',$jsonObject);
			//echo "<pre>";print_r($response);exit;
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				$message = @$response->successMessage;
				$this->session->set_flashdata("msgsuccess",@$message);
				redirect('toll');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("msg",@$message);
				redirect('toll/fogetpassword');
			}
		}
		else
		{
			$this->load->view('toll/login/foget_password');			
		}
	}


	public function logout()
	{

/*$this->load->helper('cookie');
$cookie = array(
    'name'   => 'set_value',
    'value'  => '',
    'expire' => '0'
    );

     delete_cookie($cookie);*/
if($this->session->userdata['user_data']->roll_id == 4){
    $all=$this->session->all_userdata();

//print_r($this->session->all_userdata());
$authtoken=$this->session->userdata['user_data']->auth_token;
$roleid=$this->session->userdata['user_data']->roll_id;


     $this->requestobj['tc_id']  = $all['tc_id'];
     $this->requestobj['way_type']  = $all['way_type'];
     $this->requestobj['lane_id']  = $all['lane_id'];
			
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject;exit;
     $this->rest->header("Authtoken",$authtoken);
     $response = $this->rest->post('tolloperator/deleteLaneFromTolloperator',$jsonObject);
//echo $this->rest->debug();exit;
//exit;
 }
		$this->session->sess_destroy(); 
		//echo "<pre>";print_r($this->session->userdata['user_data']);exit; 
		redirect('toll', 'refresh');

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
