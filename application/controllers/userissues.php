<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *@Class		User
 * @Developer	Ramesh
 * @Start Date	27/10/2015
 * @End Date	@todo
 */
class Userissues extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//echo "<pre>";print_r($this->session->userdata['user_data']);exit; 
		$this->user_id = $this->session->userdata['user_data']->id;
		$this->auth_token = $this->session->userdata['user_data']->authtoken;
                $this->username = $this->session->userdata['user_data']->username;
		//$this->phonenumber = $this->session->userdata['user_data']->mobile_no;
	}

	public function feedback()
	{
		if(isset($_POST['submit'])){
		//	echo "<pre>"; print_r($_POST);exit;

      $this->requestobj['subject']  = $this->input->post('subject');
      $this->requestobj['feedback']  = $this->input->post('feedback');

      $_POST = $this->requestobj;
      $jsonObject = $this->bmt->user_params($_POST);
      //print_r($jsonObject);
      $this->rest->header("Authtoken",$this->auth_token);
      $response = $this->rest->post('user/feedback',$jsonObject);
     // echo $this->rest->debug();     exit;                
      //echo "<br/>"; print_r($response);exit;
                     
      if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  
        $sus=$response->successMessage;
        $views = array('user/issue/issues');
		$data = array('views'=>$views,'sus'=> $sus);
		$this->load->view('user/template/template',$data);
                          //  $this->session->set_flashdata('phno',$phno);
                           // $data['userid']=$userid;
//$this->load->view('user/basic/otp',$data);  
        //redirect('user/otp');
      }
      else{
               //echo "<br/>"; print_r($response->error);exit;        
                          //  $data['error']=@$response->error;
                           // print_r($response->error);
                           // exit;
                          //  $this->load->view('user/basic/registration',$data);
        $views = array('user/issue/issues');
		$data = array('views'=>$views,'error'=>$response->error);
		$this->load->view('user/template/template',$data);
      }

			}else{
        $views = array('user/issue/issues');
		$data = array('views'=>$views);
		$this->load->view('user/template/template',$data);

			}
	}

}

/* End of file vehicles.php */
/* Location: ./application/controllers/vehicles.php */