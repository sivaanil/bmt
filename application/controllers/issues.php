
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issues extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
		//echo "<pre>";print_r($this->session->userdata['user_data']);exit; 
		//echo $this->session->userdata['user_data']->id;exit;
		$this->user_id = @$this->session->userdata['user_data']->ts_id;
		$this->tc_id = @$this->session->userdata['user_data']->tc_id;
		$this->role_id = @$this->session->userdata['user_data']->roll_id;
		$this->auth_token = @$this->session->userdata['user_data']->auth_token;
		$this->phonenumber = @$this->session->userdata['user_data']->mobile_no;
		$this->rest->header("Authtoken",$this->auth_token);
		checkSessionForTollStaff();
		$this->output->nocache();
	}
	
	public function feedback()
	{
		$views = array('toll/issues');
		$data = array('views'=>$views);
		$this->load->view('toll/template/template',$data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */