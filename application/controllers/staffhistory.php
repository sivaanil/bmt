<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staffhistory extends CI_Controller {



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
	
	public function index()
	{
    $response = $this->rest->get('toll/superConsolldatedByCurrentDate');
    //echo $this->rest->debug();exit;
    $vehicle_types = $this->rest->get('tolloperator/getTypes');
            
 if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  
                $views = array('toll/history_super_admin');
		$data = array('views'=>$views,'datewise'=>$response->response,'vehicle_types'=>$vehicle_types);
		$this->load->view('toll/template/template',$data);            
      }
      else{
                        
                            $data['error']=@$response->error;
                           // print_r($response->error);
                           // exit;
                          //  $this->load->view('user/basic/registration',$data);
                $views = array('toll/history_super_admin');
		$data = array('views'=>$views,'vehicle_types'=>$vehicle_types);
		$this->load->view('toll/template/template',$data);                
      }		
	
	}
public function getDateHistory()
 {
 
     $vehicle_types = $this->rest->get('vehicle/getTypes');
  //echo "<pre>"; print_r($_POST);
      $this->requestobj['date_wise']  = $this->input->post('date_wise');
      $_POST = $this->requestobj;
      $jsonObject = $this->bmt->user_params($_POST);
     // print_r($jsonObject);
$this->rest->header("Authtoken",$this->auth_token);
      $response = $this->rest->post('toll/consolldatedByDate',$jsonObject);
     // echo $this->rest->debug();  exit;                   
      //echo "<br/>"; print_r($response);exit;
                     
      if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  

            $views = array('toll/history_super_admin');
            $data = array('views'=>$views,'datewise'=>$response->response,'vehicle_types'=>$vehicle_types);
            $this->load->view('toll/template/template',$data);
                          //  $this->session->set_flashdata('phno',$phno);
                           // $data['userid']=$userid;
//$this->load->view('user/basic/otp',$data);  
        //redirect('user/otp');
      }
      else{
                        
                            $data['error']=@$response->error;
                           // print_r($response->error);
                           // exit;
                          //  $this->load->view('user/basic/registration',$data);
            $views = array('toll/history_super_admin');
            $data = array('views'=>$views,'vehicle_types'=>$vehicle_types);
            $this->load->view('toll/template/template',$data);
      }
 }
public function getPeriodHistory()
 {
    $this->rest->header("Authtoken",$this->auth_token);
     $vehicle_types = $this->rest->get('vehicle/getTypes');
 // echo "<pre>"; print_r($_POST);
      $this->requestobj['from_date']  = $this->input->post('from_date');
      $this->requestobj['to_date']  = $this->input->post('to_date');

      $_POST = $this->requestobj;
      $jsonObject = $this->bmt->user_params($_POST);
     // print_r($jsonObject);
      $this->rest->header("Authtoken",$this->auth_token);
      $response = $this->rest->post('tolloperator/consolldatedByPeriod',$jsonObject);
     // echo $this->rest->debug();     exit;                
      //echo "<br/>"; print_r($response);exit;
                     
      if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  

            $views = array('toll/tolloperator/history-con-period');
            $data = array('views'=>$views,'datewise'=>$response->response,'vehicle_types'=>$vehicle_types);
            $this->load->view('toll/template/template',$data);
                          //  $this->session->set_flashdata('phno',$phno);
                           // $data['userid']=$userid;
//$this->load->view('user/basic/otp',$data);  
        //redirect('user/otp');
      }
      else{
                        
                            $data['error']=@$response->error;
                           // print_r($response->error);
                           // exit;
                          //  $this->load->view('user/basic/registration',$data);
            $views = array('toll/tolloperator/history');
            $data = array('views'=>$views,'vehicle_types'=>$vehicle_types);
            $this->load->view('toll/template/template',$data);
      }
 
 
 
}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */