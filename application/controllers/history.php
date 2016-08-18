<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {



  public function __construct()
  {
    parent::__construct();
    $this->user_id = $this->session->userdata['user_data']->id;
    $this->auth_token = $this->session->userdata['user_data']->authtoken;
        $this->username = $this->session->userdata['user_data']->username;
  }
  
  public function index()
  {
    //echo "<h1>Coming Soon</h1>";
           $this->rest->header("Authtoken",$this->auth_token);
           $response = $this->rest->get('user/historyInfo');
               //$this->rest->debug();exit;
    $views = array('user/basic/history');
    $data = array('views'=>$views,'historyinfo'=>$response->response);
    $this->load->view('user/template/template',$data);
    

  }
        public function dateWise(){
          //  echo "<pre>"; print_r($_POST);
           // $date=$_POST['current_date'];
          if(isset($_POST['current_date'])){
            $date=$_POST['current_date'];
      $this->requestobj['date_wise']  = $this->input->post('current_date');
      $_POST = $this->requestobj;
      $jsonObject = $this->bmt->user_params($_POST);
     // print_r($jsonObject);
      $this->rest->header("Authtoken",$this->auth_token);
      $response = $this->rest->post('user/consolldatedByDate',$jsonObject);
     // echo $this->rest->debug();          exit;           
      //echo "<br/>"; print_r($response);exit;
                     
      if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  

            $views = array('user/basic/history_day');
            $data = array('views'=>$views,'historyinfo'=>$response->response, 'date'=>$date);
            $this->load->view('user/template/template',$data);
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
            $views = array('user/basic/history');
            $data = array('views'=>$views);
            $this->load->view('user/template/template',$data);
      }
        }
      
      else{
  redirect('history');
} 
}
public function periodWise()
 {
 // echo "<pre>"; print_r($_POST);
  if(isset($_POST['from'])){
            $from=$_POST['from'];
             $to=$_POST['to'];
      $this->requestobj['from_date']  = $this->input->post('from');
      $this->requestobj['to_date']  = $this->input->post('to');

      $_POST = $this->requestobj;
      $jsonObject = $this->bmt->user_params($_POST);
     // print_r($jsonObject);
      $this->rest->header("Authtoken",$this->auth_token);
      $response = $this->rest->post('user/consolldatedByPeriod',$jsonObject);
     // echo $this->rest->debug();     exit;                
      //echo "<br/>"; print_r($response);exit;
                     
      if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  

            $views = array('user/basic/history_period');
            $data = array('views'=>$views,'historyinfo'=>$response->response, 'from'=>$from,'to'=>$to);
            $this->load->view('user/template/template',$data);
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
            $views = array('user/basic/history');
            $data = array('views'=>$views);
            $this->load->view('user/template/template',$data);
      }
    }
    else{
      redirect('history');
    }
 }
  
}//class close

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */