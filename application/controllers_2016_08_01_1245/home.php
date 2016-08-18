<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('user/basic/landing');
	}
  public function login()
	{
		$this->load->view('user/basic/home');
	}
	public function aboutus()
	{
		$this->load->view('user/aboutus');
	}
	public function howtouse()
	{
		$this->load->view('user/howtouse');
	}
	public function locations()
	{
		$this->load->view('user/locations');
	}
	public function contactus()
	{
		$this->load->view('user/contactus');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */