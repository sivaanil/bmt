<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ewallet extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->load->library('CryptAES');
		$this->user_id = $this->session->userdata['user_data']->id;
		$this->auth_token = $this->session->userdata['user_data']->authtoken;
        $this->username = $this->session->userdata['user_data']->username;
	}
	
	public function index()
	{
		//echo "string";exit;

		$views = array('user/ewallet/ewallet');
		$data = array('views'=>$views);
		$this->load->view('user/template/template',$data);

		//$this->load->view('user/ewallet/ewallet');
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */