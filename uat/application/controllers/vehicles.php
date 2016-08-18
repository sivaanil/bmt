<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *@Class		User
 * @Developer	Ramesh
 * @Start Date	27/10/2015
 * @End Date	@todo
 */
class Vehicles extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//echo "<pre>";print_r($this->session->userdata['user_data']);exit; 
		$this->user_id = $this->session->userdata['user_data']->id;
		$this->auth_token = $this->session->userdata['user_data']->authtoken;
                $this->username = $this->session->userdata['user_data']->username;
		//$this->phonenumber = $this->session->userdata['user_data']->mobile_no;
	}
	public function index()
	{
              
                $this->rest->header("Authtoken",$this->auth_token);
		$failure_message = '';
		$vehicle_types = $this->rest->get('vehicle/getTypes');
            //  print_r($vehicle_types);
		$this->rest->header("Authtoken",$this->auth_token);
		$saved_vehicles = $this->rest->get('vehicle/getVehicleDetails');
               //  print_r($saved_vehicles);
		//exit;
                  
		check_user_authorization($this->rest->status());
                // echo  $this->auth_token;exit;
		if($_POST)
		{
			$this->form_validation->set_rules('vehicle_type', 'vehicle type', 'trim|required');
			$this->form_validation->set_rules('vehicle_number', 'vehicle number', 'trim|required');
			$this->form_validation->set_rules('vehicle_make', 'vehicle make', 'trim|required');
			$this->form_validation->set_rules('vehicle_model', 'vehicle model', 'trim|required');
			
			if($this->form_validation->run() == true)
			{
                            
                          //  {"request":{"type_id":"1","make_id":"1","model_id":"1","vehicle_no":"1234rqr231412"}}

				$this->requestobj['type_id']  = $this->input->post('vehicle_type');
				$this->requestobj['make_id']  = $this->input->post('vehicle_make');
				$this->requestobj['model_id']  = $this->input->post('vehicle_model');
				$this->requestobj['vehicle_no']  = $this->input->post('vehicle_number');
				//$this->requestobj['enabledisable']  = $this->input->post('vehicle_status');
				//$this->requestobj['user_id'] = $this->user_id;
				//$this->requestobj['auth_token'] = $this->auth_token;
//				if(isset($_POST['default']))
//				{
//					$this->requestobj['defalt']=1;
//				}
//				else
//				{
//					$this->requestobj['defalt']=0;
//				}

				$_POST = $this->requestobj;
				$jsonObject = $this->bmt->user_params($_POST);
                       //  echo $this->auth_token;     
                      //  print_r($jsonObject);
				$this->rest->header("Authtoken",$this->auth_token);
				$response_obj = $this->rest->post('vehicle/addVehicle',$jsonObject);
                //echo $this->rest->debug(); exit;
				check_user_authorization($this->rest->status());
				if($response_obj->statuscode == 200)
				{
					$this->session->set_flashdata('msg',@$response_obj->successMessage);
					redirect('vehicles/');
				}
				else{
					$failure_message = @$response_obj->error[0];					
				}
			}			
		}
               //  echo  $this->auth_token;exit;
		$views = array('user/vehicles/vehicles_details');
		$data = array('views'=>$views,'vehicle_types'=>$vehicle_types,'saved_vehicles'=>$saved_vehicles,'failure_message'=>$failure_message);
		$this->load->view('user/template/template',$data);
	}
	public function edit()
	{
		$this->form_validation->set_rules('vehicle_type', 'vehicle type', 'trim|required');
		$this->form_validation->set_rules('vehicle_number', 'vehicle number', 'trim|required');
		$this->form_validation->set_rules('vehicle_make', 'vehicle make', 'trim|required');
		$this->form_validation->set_rules('vehicle_model', 'vehicle model', 'trim|required');
		$this->form_validation->set_rules('vehicle_status', 'vehicle status', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == true)
		{
                    

			$this->requestobj['vehicle_id']  = $this->input->post('vehicle_id');
			$this->requestobj['type_id']  = $this->input->post('vehicle_type');
			$this->requestobj['make_id']  = $this->input->post('vehicle_make');
			$this->requestobj['model_id']  = $this->input->post('vehicle_model');
			$this->requestobj['vehicle_no']  = $this->input->post('vehicle_number');
			$this->requestobj['enable_status']  = $this->input->post('vehicle_status');
			$this->requestobj['default_status']  = $this->input->post('default');

			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
                        //print_r($jsonObject);
                        $this->rest->header("Authtoken",$this->auth_token);
			$response_obj = $this->rest->post('vehicle/editVehicle',$jsonObject);
                        
			echo json_encode($response_obj);			
		}			
		
	}
	public function get_vehicle_make()
	{
		$select_type = $this->input->post('select_type');
		$url = str_replace(" ", "", $select_type);
                 $this->rest->header("Authtoken",$this->auth_token);
		$response = $this->rest->get('vehicle/getMakes/'.$url);
		//echo $this->rest->debug();exit;
               // print_r($response->response);exit;
                $html='';
                $html.='<select class="form-control" name="vehicle_make" id="vehicle_make" onchange="getModel()">';
               
                if($response->statuscode == 200)
		{ 
			 $html .='<option value="">Vehicle Make</option>';
                foreach($response->response as $val){
                $html .='<option value="'.$val->make_id.'">'.$val->make_name.'</option>';    
                }
            }else{
            $html .='<option value="">No Vehicle Make</option>';   	
            }
                $html.='';
                echo $html;
		//echo json_encode($response->response);
		
	}
        public function get_pop_vehicle_make()
	{
		$select_type = $this->input->post('select_type');
		$url = str_replace(" ", "", $select_type);
                 $this->rest->header("Authtoken",$this->auth_token);
		$response = $this->rest->get('vehicle/getMakes/'.$url);
               // print_r($response->response);exit;
                $html='';
                $html.='<select class="form-control" name="vehicle_make_pop" id="vehicle_make_pop" onchange="getPopModel()">';
                if($response->statuscode == 200)
		{ 
                $html .='<option value="">Vehicle Make</option>';
                foreach($response->response as $val){
                $html .='<option value="'.$val->make_id.'">'.$val->make_name.'</option>';    
                }
        }else{
            $html .='<option value="">No Vehicle Model</option>';   	
            }
                $html.='';
                echo $html;
		//echo json_encode($response->response);
		
	}
	public function get_single_vehicle()
	{
            $this->rest->header("Authtoken",$this->auth_token);
            $data['vehicle_types']  = $this->rest->get('vehicle/getTypes');
		//$data['vehicle_types'] = $this->rest->get('vehicleType?');
		$id = $this->input->post('id');
                 $this->rest->header("Authtoken",$this->auth_token);
		 $response= $this->rest->get('vehicle/displayVehicle/'.$id);
                if($response->statuscode == 200)
		{   
                    $data['vehicle_details']=$response;
                    echo $this->load->view('user/vehicles/single_vehicle',$data);
                
		}
                else{
                        $data['failure_message'] = @$response_obj->error[0];
                        echo $this->load->view('user/vehicles/single_vehicle',$data);
                       // redirect('vehicles/');
                }
              //  print_r($this->rest->get('vehicle/displayVehicle/'.$id));exit;
		
		
	}
	public function get_vehicle_model()
	{
		$select_type = $this->input->post('select_type');
		$vehicle_make = $this->input->post('vehicle_make');
		$select_type = str_replace(" ", "", $select_type);
                 $this->rest->header("Authtoken",$this->auth_token);
		$response = $this->rest->get("vehicle/getModels/".$vehicle_make);
                // print_r($response);exit;
		//echo count($response->response);
		if($response->statuscode == 200)
		{   
                $html='';
                $html.='<select class="form-control" name="vehicle_model" id="vehicle_model">';
                $html .='<option value="">Vehicle Model</option>';               
                foreach($response->response as $val){
                $html .='<option value="'.$val->model_id.'">'.$val->model_name.'</option>';    
                }
                $html.='</select>';
                echo $html;
            }else{
$html='';
$html.='<select class="form-control" name="vehicle_model" id="vehicle_model">';
$html .='<option value="" selected>No Model For Selected Make</option>';   
$html.='</select>';
echo $html;
            }
		//echo json_encode($response);
	}
         public function get_pop_vehicle_model()
	{
		$select_type = $this->input->post('select_type');
		$vehicle_make = $this->input->post('vehicle_make');
		$select_type = str_replace(" ", "", $select_type);
                 $this->rest->header("Authtoken",$this->auth_token);

		$response = $this->rest->get("vehicle/getModels/".$vehicle_make);
                // print_r($response);exit;
		if($response->statuscode == 200)
		{
                 $html='';
                $html.='<select class="form-control" name="vehicle_model_pop" id="vehicle_model_pop">';
                $html .='<option value="">Vehicle Model</option>';
                foreach($response->response as $val){
                $html .='<option value="'.$val->model_id.'">'.$val->model_name.'</option>';    
                }
                $html.='';
                echo $html;
                }else{
$html='';
$html.='<select class="form-control" name="vehicle_model" id="vehicle_model">';
$html .='<option value="" selected>No Model For Selected Make</option>';   
$html.='</select>';
echo $html;
            }
		//echo json_encode($response);
	}
	public function history()
	{
		$from_date = '';
		$to_date = '';
		$failure_message = '';
		$history = '';
		if($_POST)
		{
			$this->form_validation->set_rules("from","From Date","required");
			$this->form_validation->set_rules("to","To Date","required");
			if($this->form_validation->run() == true)
			{				
				$from_date = date('m/d/Y', strtotime($this->input->post('from')));
				$to_date = date('m/d/Y', strtotime($this->input->post('to')));
				if ((strtotime($from_date)) <= (strtotime($to_date))) {		
					$history = $this->rest->get('historyByFromToDate?from_date='.$from_date."&&to_date=".$to_date."&&user_id=".$this->user_id."&&auth_token=".$this->auth_token);
				}
				else
				{	
					$failure_message = 'To Date should be greater than From Date.';					
					$history = $this->rest->get('historyInfo?user_id='.$this->user_id."&&auth_token=".$this->auth_token);			
				}
					$from_date = date('d-m-Y', strtotime(@$from_date));
					$to_date = date('d-m-Y', strtotime(@$to_date));
			}
		}
		else
		{
			$history = $this->rest->get('historyInfo?user_id='.$this->user_id."&&auth_token=".$this->auth_token);			
		}
		
		check_user_authorization($this->rest->status());
		$views = array('user/vehicles/vehicles_history');
		$data = array('views'=>$views,"history"=>$history->response,'from_date'=>$from_date,'to_date'=>$to_date,'failure_message'=>$failure_message);
		$this->load->view('user/template/template',$data);
	}
	public function download($from_date=NULL,$to_date=NULL)
	{
		if($from_date != '' && $to_date != '')
		{	
			$from_date = date('m/d/Y', strtotime(@$from_date));
			$to_date = date('m/d/Y', strtotime(@$to_date));		
			$history = $this->rest->get('historyByFromToDate?from_date='.$from_date."&&to_date=".$to_date."&&user_id=".$this->user_id."&&auth_token=".$this->auth_token);			
		}
		else{
			$history = $this->rest->get('historyInfo?user_id='.$this->user_id."&&auth_token=".$this->auth_token);	
		}
		$data_export = $history->response->Historyinfo;
		$this->excel->setActiveSheetIndex(0);
		foreach ($data_export as $key => $value) {

			$data[$key] = $value;
		}
       if(count($data) != 0)
       {
        $this->excel->stream('download.xls',$data); 
       }
       else
       {
        $data[0] = array('Information'=>"No Records Found");
        $this->excel->stream('download.xls',$data); 
       }
	}
	public function delete_vehicle($vehicle_id = NULL)
	{
               $this->rest->header("Authtoken",$this->auth_token);
		$response = $this->rest->get('vehicle/deleteVechicle/'.$vehicle_id);
		check_user_authorization($this->rest->status());
		if($response->statuscode == 200)
		{	
			$this->session->set_flashdata('msg',@$response->successMessage);
		}
		else{
			$this->session->set_flashdata('msg',@$response->error[0]);
		}
			redirect('vehicles/');
	}
	public function enable_vehicles()
	{		
		//print_r($_POST);exit;
		$final_vehicledetails =array();
		$vehicledetails = array();
                if(isset($_POST['checked_vehicle'])){
		foreach ($_POST['checked_vehicle'] as $key => $value) {
			$vehicledetails['vehicle_id']=$value;
			$vehicledetails['status']=1;
			$final_vehicledetails[] = $vehicledetails;			
		}
                }else{
                    $vehicledetails['vehicle_id']=0;
		    $vehicledetails['status']=0;
                    $final_vehicledetails[]=$vehicledetails;
                }
		$this->requestobj['vehicledetails'] = $final_vehicledetails;
		$_POST = $this->requestobj;
		$jsonObject = $this->bmt->user_params($_POST);
               // echo "<pre>"; print_r($jsonObject);exit;
                $this->rest->header("Authtoken",$this->auth_token);
		$response = $this->rest->post('vehicle/enableVehicles',$jsonObject);
               // $this->rest->debug();exit;
		check_user_authorization($this->rest->status());
		if($response->statuscode == 200)
		{
			$this->session->set_flashdata('msg',@$response->successMessage);
			redirect('vehicles/');
		}
		else{
			$this->session->set_flashdata('msg',@$response->error[0]);
			redirect('vehicles');					
		}
	}
}

/* End of file vehicles.php */
/* Location: ./application/controllers/vehicles.php */