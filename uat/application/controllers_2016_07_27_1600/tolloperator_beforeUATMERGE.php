<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tolloperator extends CI_Controller {

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
		//$this->rest->header("Authtoken",$this->auth_token);
	}
public function index()
	{
		$views = array('toll/tolloperator/home');
		$data = array('views'=>$views);
		$this->load->view('toll/template/template',$data);
	}
	public function dialyoperations()
	{

   /* $this->load->helper('cookie');
    $cookie = array(
'name'   => 'set_value',
'value'  => 1,
'expire' => time()+86500,
);
 
set_cookie($cookie);
*/
            
           $this->rest->header("Authtoken",$this->auth_token);
           $locations = $this->rest->get('tolloperator/getWays');
           //echo '<pre>';
           // print_r($locations);exit;
            //print_r($this->session->userdata['user_data']->roll_id);
           $this->rest->header("Authtoken",$this->auth_token);
           $mobileinfo = $this->rest->get('tolloperator/beacon');
              // $this->rest->debug();
           $this->rest->header("Authtoken",$this->auth_token);
           $webinfo = $this->rest->get('tolloperator/nonBeacon');
           //$this->rest->debug();
           // echo "<pre>";
		//print_r($webinfo);	
		//exit;
           $this->rest->header("Authtoken",$this->auth_token);
           $laneinfodropdown = $this->rest->get('tolloperator/getLoginLaneMapping');
           //$this->rest->debug();exit;

		$views = array('toll/tolloperator/dialyoperations');
		$data = array('views'=>$views,'mobileinfo'=>$mobileinfo->response,'webinfo'=>$webinfo->response,'locations'=>$locations->response,'dropdown'=>$laneinfodropdown->response);
		$this->load->view('toll/template/template',$data);  

	}
        public function get_lane_way(){
            //echo"<pre>"; print_r($_POST);
                $this->requestobj['tc_id']  = $this->input->post('tcid');
	        $this->requestobj['way_type']  = $this->input->post('way');
                
                $_POST = $this->requestobj;
	       $jsonObject = $this->bmt->user_params($_POST);
                        //print_r($jsonObject);
               $this->rest->header("Authtoken",$this->auth_token);
	       $response = $this->rest->post('tolloperator/getLanes',$jsonObject);
              // $this->rest->debug();exit;
             //  echo"<pre>"; print_r($response); 
               //echo count($response->response);
                $html='';
                if(isset($response->response) && !empty($response->response)){
                $html.='<select class="form-control" name="lane" id="lane">';
                $html .='<option value="">Select Lane</option>';
                foreach($response->response as $val){
                $html .='<option value="'.$val->lane_id.'">'.$val->lane_number.'</option>';    
                }
                $html.='</select>';
                }else{
                 $html.='<select class="form-control" name="lane" id="lane">';
                 $html.='<option value="" selected>There is no BMT Lanes</option>';   
                 $html.='</select>';
                }
                $html.='';
                echo $html;
        }
        public function store_lanes(){
            //echo"<pre>"; print_r($_POST);
                $this->requestobj['tc_id']  = $this->input->post('tcid');
	        $this->requestobj['way_type']  = $this->input->post('way');
                $this->requestobj['lane_id']  = $this->input->post('lane');
                
                $_POST = $this->requestobj;
	       $jsonObject = $this->bmt->user_params($_POST);
                        //print_r($jsonObject);
               $this->rest->header("Authtoken",$this->auth_token);
	       $response = $this->rest->post('tolloperator/mapLanes',$jsonObject);
         $lanpam=$_POST;
         $this->session->set_userdata($lanpam);
             //  echo $this->rest->debug();
             // echo"<pre>"; print_r($response); exit;
              echo $response->successMessage;
        }

        public function operations(){
            $views = array('toll/tolloperator/operations');
            $data = array('views'=>$views);
            $this->load->view('toll/template/template',$data);
        }
        public function issues(){
            $views = array('toll/tolloperator/issues');
            $data = array('views'=>$views);
            $this->load->view('toll/template/template',$data);
        }
        public function changeStatus(){
           // echo "<pre>";print_r($_GET);exit;
            $this->requestobj['tc_id']  = $this->encrypt->decode_my($this->input->get('tcid'));
              $this->requestobj['tc_name']  = $this->encrypt->decode_my($this->input->get('tcname'));
            $this->requestobj['user_id']  = $this->encrypt->decode_my($this->input->get('uid'));
	    $this->requestobj['role_id']  = $this->role_id;
	    $this->requestobj['vehicle_id']  = $this->encrypt->decode_my($this->input->get('vid'));	 
       $this->requestobj['vehicle_no']  = $this->encrypt->decode_my($this->input->get('vno')); 

      $this->requestobj['email_id']  = $this->encrypt->decode_my($this->input->get('email'));
      $this->requestobj['mobile_no']  = $this->encrypt->decode_my($this->input->get('mb'));
      $this->requestobj['toll_charge']  = $this->encrypt->decode_my($this->input->get('toll'));
      $this->requestobj['bmt_charge']  = $this->encrypt->decode_my($this->input->get('bmt'));
      $this->requestobj['total_amount']  = $this->encrypt->decode_my($this->input->get('tot'));

	    $this->requestobj['passing_status']  = 1;
      $this->requestobj['paid_status']  = $this->encrypt->decode_my($this->input->get('paid'));



			$_GET = $this->requestobj;
            $jsonObject = $this->bmt->user_params($_GET);
			//echo "<pre>";
			//echo $jsonObject;exit;
            $this->rest->header("Authtoken",$this->auth_token);
	    $response = $this->rest->post('tolloperator/passTransaction',$jsonObject);
          //  $this->rest->debug();exit;
			//echo "<pre>";
			//print_r($response);exit;
            if($response->statuscode == 200)
		{	
                $message = @$response->successMessage;
                $type=@$response->reg_type;
               // if($type=='MRU'){
			$this->session->set_flashdata('msg',$message);
                //}else if($type=='WRU'){
                //    $this->session->set_flashdata('wbmsg',$message);
               // }
                        redirect('tolloperator/dialyoperations');
		}
                else{
                    $message = @$response->error[0];
		    $this->session->set_flashdata("msg",@$message);
                    redirect('tolloperator/dialyoperations');
                }
        }
        public function getVehiclesData(){

           $this->requestobj['vehicle_no']  = $this->input->post('keyword');
                
                $_POST = $this->requestobj;
         $jsonObject = $this->bmt->user_params($_POST);

//echo "<pre>";print_r($jsonObject);exit;
            $this->rest->header("Authtoken",$this->auth_token); 
            $response = $this->rest->post('tolloperator/searchVehicles',$jsonObject);
          //$this->rest->debug();exit;
	//echo "<pre>";print_r($response);exit;
             
        if($response->statuscode == 200)
		{
            $webinfo=$response->response;
            //echo count($webinfo);
            if($webinfo!=4){
            $j=1;
           $html='';

          foreach($webinfo as $info){
             $tc_id=$this->encrypt->encode_my($info->tc_id); 
             $u_id=$this->encrypt->encode_my($info->user_id); 
             $vid=$this->encrypt->encode_my($info->vehicle_id);


             $psts=$this->encrypt->encode_my($info->passing_status);
             $paid=$this->encrypt->encode_my($info->paid_status);


             if($info->paid_status==1){$sts='Yes';}else{$sts='No';}

             $deviceid=$info->mobile_device_id;
             if(is_null($deviceid)){
                 $regtype=0; 
             }else{
                 $regtype='"'.$deviceid.'"';  
             }

              $amt=$info->one_way_charge+1;

            $email='"'.$info->email_id.'"';
            $tcid=$info->tc_id;
            $uid=$info->user_id;
            $typeid=$info->type_id;
            $makeid=$info->make_id;
            $modelid=$info->model_id;
            $vid=$info->vehicle_id;
            $vno='"'.$info->vehicle_no.'"';
            $oneway=$info->one_way_charge;
            $twoway=$info->two_way_charge;
            $paid=$info->paid_status;
            $pass=$info->passing_status;

$values="".$email.",".$tcid.",".$uid.",".$typeid.",".$makeid.",".$modelid.",".$vid.",".$vno.",".$oneway.",".$twoway.",".$paid.",".$pass.",".$regtype."";

             $html.='<tr>';
          $html.='<th scope="row">'.$j.'</th>';
          $html.='<td>'.$info->vehicle_no.'</td>';
          $html.='<td>'.$info->type_name.'</td>';
          $html.='<td>'.$amt.'</td>';
          $html.="<td>
          <input type='button' id='chanrge' name='charge' 
onclick='getCharge(".$values.");' value='Charge' class='btn btn-success right_menu-button-small common-btn-pass'/>
                </td>";
          $html.='<td><span class="btn-danger common-btn-pass">'.$sts.'</span></td>';
          $html.='<td style="text-align:center;">';
          if($info->paid_status==1){
            $html.='<a href="'.base_url('tolloperator/changeStatus?tcid='.$tc_id.'&uid='.$u_id.'&vid='.$vid.'&psts='.$psts.'&paid='.$paid).'" class="btn btn-success common-btn-pass">PASS</a>';
                  }else{
            $html.='<button type="button" class="btn btn-success common-btn-pass" disabled>PASS</button>';
                 }          
         $html.=' </td>';
        $html.='</tr>';
         $j++;
         }
          echo  $html; 
        }
        else{
           echo "<tr><td colspan='8'>".$message = $response->successMessage."</td></tr>";
        }
                }else{
                    // $html='';
                   echo "<tr><td colspan='8'>".$message = $response->error[0]."</td></tr>";
                // echo   $html='<tr>'.$message.'</tr>';
                    
                }
         
        }
        public function getMobileVehiclesData(){

           $this->requestobj['vehicle_no']  = $this->input->post('keyword');
                
                $_POST = $this->requestobj;
         $jsonObject = $this->bmt->user_params($_POST);

//echo "<pre>";print_r($jsonObject);exit;
            $this->rest->header("Authtoken",$this->auth_token); 
            $response = $this->rest->post('tolloperator/searchMobileVehicles',$jsonObject);
           // $this->rest->debug();
  //echo "<pre>";print_r($response);exit;
             
        if($response->statuscode == 200)
    {
            $mobileinfo=$response->response;
            //echo count($webinfo);
            if($mobileinfo!=4){
            $j=1;
           $html='';

          foreach($mobileinfo as $info){
            $tcid=$this->encrypt->encode_my($info->tc_id); 
             $uid=$this->encrypt->encode_my($info->user_id); 
             $vid=$this->encrypt->encode_my($info->vehicle_id);
             $psts=$this->encrypt->encode_my($info->passing_status);
             $paid=$this->encrypt->encode_my($info->paid_status);
             if($info->paid_status==1){$sts='Yes';}else{$sts='No';}

             $deviceid=$info->mobile_device_id;
             if(is_null($deviceid)){
                 $regtype=0; 
             }else{
                 $regtype='"'.$deviceid.'"';  
             }

              $amt=$info->one_way_charge+1;

             $html.='<tr>';
          $html.='<th scope="row">'.$j.'</th>';
          $html.='<td>'.$info->vehicle_no.'</td>';
          $html.='<td>'.$info->type_name.'</td>';
          $html.='<td>'.$info->make_name.'</td>';
          $html.='<td>'.$info->model_name.'</td>';
          $html.='<td>'.$amt.'</td>';          
          $html.='<td><button type="button" class="btn btn-danger common-btn-pass">'.$sts.'</button></td>';
          $html.='<td style="text-align:center;">';
          if($info->paid_status==1){
            $html.='<a href="'.base_url('tolloperator/changeStatus?tcid='.$tcid.'&uid='.$uid.'&vid='.$vid.'&psts='.$psts.'&paid='.$paid).'" class="btn btn-success common-btn-pass">PASS</a>';
                  }else{
            $html.='<button type="button" class="btn btn-success common-btn-pass" disabled>PASS</button>';
                 }          
         $html.=' </td>';
        $html.='</tr>';
         $j++;
         }
          echo  $html; 
        }
        else{
           echo $message = "<tr><td colspan='8'>".$response->successMessage.'</td></tr>';
        }
                }else{
                    // $html='';
                   echo "<tr><td colspan='8'>".$message = $response->error[0].'</td></tr>';
                // echo   $html='<tr>'.$message.'</tr>';
                    
                }
         
        }
        public function getChargeStatus(){
           // echo "<pre>"; print_r($_POST);       
            $totalamt=$this->input->post('amt');
            $tollamt=$totalamt-1;
            $bmtcharge=1;
                       
	          $this->requestobj['ts_id']  = $this->user_id;
            $this->requestobj['tc_id']  = $this->input->post('tcid');
            $this->requestobj['user_id']  = $this->input->post('uid');
            $this->requestobj['type_id']  = $this->input->post('typeid');
            $this->requestobj['make_id']  = $this->input->post('makeid');
            $this->requestobj['model_id']  = $this->input->post('modelid');
            $this->requestobj['vehicle_id']  = $this->input->post('vid');
            $this->requestobj['vehicle_no']  = $this->input->post('vno');
            $this->requestobj['email_id']  = $this->input->post('email');
            $this->requestobj['reg_type']  = $this->input->post('deviceid');
            $this->requestobj['one_way_charge']  = $this->input->post('amt1');
            $this->requestobj['two_way_charge']  = $this->input->post('amt2');            
            $this->requestobj['bmt_charge']  = $bmtcharge;           
            $this->requestobj['paid_status']  = $this->input->post('paidsts');
            $this->requestobj['passing_status']  = $this->input->post('passsts');
               $_POST = $this->requestobj;
            $jsonObject = $this->bmt->user_params($_POST);
			//echo "<pre>";
			// print_r($jsonObject);exit;
            
            // $this->requestobj['lane_id']  = $totalamt;
	    //$this->requestobj['role_id']  = $this->role_id;
            //$this->requestobj['toll_charge']  = $tollamt;
            //$this->requestobj['total_amount']  = $totalamt;
	             
            
         
            $this->rest->header("Authtoken",$this->auth_token);
	    $response = $this->rest->post('tolloperator/paidTransaction',$jsonObject);           
            //$this->rest->debug();
	//echo "<pre>";print_r($response);exit;
        if($response->statuscode == 200)
		{
            $message = @$response->successMessage;
            $msg="Amount Rs. 30 will be debited from User PayTm wallet.";
            $arr = array('ans' => 'success', 'res' => $msg);
               echo json_encode($arr);

		}
                else{
                   $message = @$response->error[0];
                   $arr = array('ans' => 'failure', 'res' => $message);
                   echo json_encode($arr);

                }
        
        }

        public function profile(){
           $this->rest->header("Authtoken",$this->auth_token);
           $userinfo = $this->rest->get('tolloperator/getProfile');
           //$this->rest->debug();exit;
            $views = array('toll/tolloperator/profile');
            $data = array('views'=>$views,'user'=>$userinfo->response);
            $this->load->view('toll/template/template',$data);
        }
        public function profile_update(){ 
            
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
                        $this->requestobj['profile_img']  = $file_path;
                       // print_r($this->requestobj);exit;
                        
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//print_r($jsonObject);
                        $this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('tolloperator/editWebProfile',$jsonObject);
			//echo $this->rest->debug();     exit;                  
                      //  echo "<br/>"; print_r($response);exit;
                     
			if($response->statuscode == 200)
			{  
                $this->rest->header("Authtoken",$this->auth_token);
                $presponse = $this->rest->get("tolloperator/getProfile");  
                //echo "<br/>"; print_r($presponse);exit;
                $views = array('toll/tolloperator/profile');
		$data = array('views'=>$views,'user'=>$presponse->response,"msg"=>$response->successMessage);
		$this->load->view('toll/template/template',$data);
                
                            
                            
			}
			else{
                        
                            $data['error']=@$response->error;
                           // print_r($response->error);
                           // exit;
                           // $this->load->view('profile',$data);
                             $this->rest->header("Authtoken",$this->auth_token);
                $presponse = $this->rest->get("tolloperator/getProfile");
                
                $views = array('toll/tolloperator/profile');
		$data = array('views'=>$views,'user'=>$presponse->response,"msg"=>$response->error);
		$this->load->view('toll/template/template',$data);
			}
		}
		else
		{
                    redirect('tolloperator/profile');
		}      
            

        }
         public function history(){

      $this->rest->header("Authtoken",$this->auth_token);
      $response = $this->rest->get('tolloperator/consolldatedByCurrentDate');
     $this->rest->header("Authtoken",$this->auth_token);
      $vehicle_types = $this->rest->get('tolloperator/getTypes');
      //echo $this->rest->debug();                     
      //echo "<br/>"; print_r($vehicle_types);exit;
                     
      if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  

            $views = array('toll/tolloperator/history');
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



            //$views = array('toll/tolloperator/history');
//$data = array('views'=>$views);
//$this->load->view('toll/template/template',$data);           
        }

         public function views(){
            $views = array('toll/tolloperator/views');
            $data = array('views'=>$views);
            $this->load->view('toll/template/template',$data);
        }
public function getDateHistory()
 {
    $this->rest->header("Authtoken",$this->auth_token);
     $vehicle_types = $this->rest->get('vehicle/getTypes');
  //echo "<pre>"; print_r($_POST);
      $this->requestobj['date_wise']  = $this->input->post('date_wise');
      $_POST = $this->requestobj;
      $jsonObject = $this->bmt->user_params($_POST);
     // print_r($jsonObject);
      $this->rest->header("Authtoken",$this->auth_token);
      $response = $this->rest->post('tolloperator/consolldatedByDate',$jsonObject);
      //echo $this->rest->debug();                     
      //echo "<br/>"; print_r($response);exit;
                     
      if($response->statuscode == 200)
      {  //echo "<br/>"; print_r($response->response);exit;
                              //$userid = @$response->response[0]->user_id;  

            $views = array('toll/tolloperator/history');
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
public function refresh(){
          $this->rest->header("Authtoken",$this->auth_token);
           $mobileinfo = $this->rest->get('tolloperator/beacon');
              // $this->rest->debug();
           $this->rest->header("Authtoken",$this->auth_token);
           $webinfo = $this->rest->get('tolloperator/nonBeacon');

           $data['mobileinfo']=$mobileinfo->response;
           $data['webinfo']=$webinfo->response;
            $this->load->view('toll/tolloperator/refresh',$data);
}

public function clearLanes(){
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
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
