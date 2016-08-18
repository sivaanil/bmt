<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tollcenter extends CI_Controller {

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
		$toll_center_details = $this->rest->get("toll/listTollCenterLocations");
		chackStatus($toll_center_details);
		//echo "<pre>";print_r($toll_center_details->response);exit;
		//$this->rest->debug();exit;
		$this->form_validation->set_rules('toll_location', 'Toll Location', 'trim|required');
		$this->form_validation->set_rules('toll_name', 'Toll Name', 'trim|required');
		$this->form_validation->set_rules('entry_from', 'Entry From', 'trim|required');
		//$this->form_validation->set_rules('becon1', 'Becon One', 'trim|required');
		$this->form_validation->set_rules('number_landes_from', 'Number Of Lanes From', 'trim|required|numeric');
		$this->form_validation->set_rules('number_landes_from_bmt', 'Number Of Lanes From Bmt', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('entry_from2', 'Becon One', 'trim|required');
		//$this->form_validation->set_rules('becon2', 'Becon Two', 'trim|required');
		$this->form_validation->set_rules('number_landes_from2', 'Number Of Lanes From', 'trim|required|numeric');
		$this->form_validation->set_rules('number_landes_from_bmt2', 'Number Of Lanes From Bmt', 'trim|required|numeric|xss_clean');
		if(isset($_POST['from_uuid']) && !empty($_POST['from_uuid']))
		{
			$this->form_validation->set_rules('from_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('from_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkFromBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('from_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkFromBeconMinarId|callback_checkBeconMinarId');
		}
		if(isset($_POST['to_id']) && !empty($_POST['to_id']))
		{
			$this->form_validation->set_rules('to_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('to_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('to_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkToBeconMinarId|callback_checkBeconMinarId');
		}
		//$this->form_validation->set_rules('address', 'Address', 'trim|required');
		if($this->form_validation->run() == true)
		{
			$lat = '';
			$lng = '';
			
			/*First Method*/
			//$strasse = $_POST['address'];
		    /*$inhalt = simplexml_load_file('http://maps.googleapis.com/maps/api/geocode/xml?'.
		                              'address='.rawurlencode($strasse).'&sensor=true');

		    $geo['lat'] = $inhalt->result->geometry->location->lat;
		    $geo['lon'] = $inhalt->result->geometry->location->lng;

		    print_r($inhalt->result->geometry->location->lat);*/

		    /*Second Method*/
		    /*$address = $_POST['address']; // Google HQ
			$prepAddr = str_replace(' ','+',$address);
			 
			$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
			 
			$output= json_decode($geocode);
			 
			$latt = @$output->results[0]->geometry->location->lat;
			$long = @$output->results[0]->geometry->location->lng;

			if($latt != '')
				$lat = $latt;
			if($long != '')
				$lng = $long;*/
			if($_POST['lat'] != '')
				$lat = $_POST['lat'];
			if($_POST['lng'] != '')
				$lng = $_POST['lng'];

			/*if($latt == '' && $long == '')
			{
				$message = "Invalid Address";
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter');
				exit;
			}*/

			$image_url = '';
			if($_FILES['document']['name'] != '')
				$document_url = $this->uploadbankdetails();
			$this->requestobj['lng']  = $lng;
			$this->requestobj['lat']  = $lat;
			$this->requestobj['address']  = $_POST['address'];
			$this->requestobj['image_url']  = @$document_url['file_path'];
			$this->requestobj['tc_location']  = $this->input->post('toll_location');
			$this->requestobj['tc_name']  = $this->input->post('toll_name');
			$this->requestobj['from_way_location']  = $this->input->post('entry_from');
			$this->requestobj['from_way_no_of_lanes']  = $this->input->post('number_landes_from');
			$this->requestobj['from_way_no_of_bmt_lanes']  = $this->input->post('number_landes_from_bmt');
			$this->requestobj['to_way_location']  = $this->input->post('entry_from2');
			$this->requestobj['to_way_no_of_lanes']  = $this->input->post('number_landes_from2');
			$this->requestobj['to_way_no_of_bmt_lanes']  = $this->input->post('number_landes_from_bmt2');
			$this->requestobj['assigned_id'] = $this->user_id;
			if(isset($_POST['from_uuid']) && !empty($_POST['from_uuid']))
			{
				$this->requestobj['from_uuid']  = $this->input->post('from_uuid');
				$this->requestobj['from_major_id']  = $this->input->post('from_major_id');
				$this->requestobj['from_minor_id']  = $this->input->post('from_minor_id');
			}
			if(isset($_POST['to_uuid']) && !empty($_POST['to_uuid']))
			{
				$this->requestobj['to_uuid']  = $this->input->post('to_uuid');
				$this->requestobj['to_major_id']  = $this->input->post('to_major_id');
				$this->requestobj['to_minor_id']  = $this->input->post('to_minor_id');
			}
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('toll/addTollCenter',$jsonObject);
			chackStatus($response);
			//echo "<pre>";print_r($response->statusMessage);exit;
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				unlink(@$document_url['image_local_path']);
				$message = @$response->successMessage;
				$this->session->set_flashdata("msg",@$message);
				redirect('tollcenter');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter');
			}
			
		}
		else
		{
			$views = array('toll/addtollcenter');
			$data = array('views'=>$views,'toll_center_details'=>@$toll_center_details->response->TollCcenterDetails);
			$this->load->view('toll/template/template',$data);
		}
	}

	public function uploadbankdetails()
	{
		
		$config['upload_path']   = 'uploads/members/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']		 = 5120;
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$this->upload->initialize($config);

		if (! $this->upload->do_upload('document'))
		{
			header('HTTP/1.1 409 Unauthorized', true, 409);
			$error = $this->upload->display_errors('error');
			//print_r($error);
			$this->session->set_flashdata("errormsg",@$error);
			redirect('tollcenter');
		}
		else
		{
			$image_local_path = 0;
			$upload_data = $upload_data = $this->upload->data();
			$image_local_path = $upload_data['full_path'];
			$file_type = $upload_data['file_type'];
			$file_path = base_url('/uploads/members/'.(str_replace(" ","_",$_FILES['document']['name'])));

			
			$image_details = array('file_path'=>$file_path,'image_local_path'=>$image_local_path);
			return $image_details;
		}
	}

	public function uploaddocument()
	{
		$config['upload_path']   = 'uploads/documents/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|bmp|doc|docx';
		//$new_name = time().$_FILES["upload_document_img"]['name'];
		$new_name = time().'doc'.substr($_FILES["upload_document_img"]['name'],stripos($_FILES["upload_document_img"]['name'], '.'));
		$config['file_name'] =$new_name;
		//$config['max_size']		 = 5120;
		$this->upload->initialize($config);

		if (! $this->upload->do_upload('upload_document_img'))
		{
			header('HTTP/1.1 409 Unauthorized', true, 409);
			$error = $this->upload->display_errors('error');
			//print_r($error);
			$this->session->set_flashdata("errormsg",@$error);
			redirect('tollcenter');
		}
		else
		{
			$image_local_path = 0;
			$upload_data = $upload_data = $this->upload->data();
			$image_local_path = $upload_data['full_path'];
			$file_type = $upload_data['file_type'];
			$file_path = base_url('/uploads/documents/'.str_replace(" ","_",$new_name));
			
			$this->requestobj['tc_id']  = $_POST['tollcation_id_hidden'];
			$this->requestobj['image_url']  = $file_path;
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$response = $this->rest->post('toll/uploadNewDocument',$jsonObject);
			chackStatus($response);
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				//unlink(@$image_local_path);
				$message = @$response->successMessage;
				$this->session->set_flashdata("msg",@$message);
				redirect('tollcenter');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter');
			}
			
		}
	}

	public function downloaddocument()
	{
		$response = $this->rest->get('toll/getDocumentUrl/'.$this->uri->segment(3));
		chackStatus($response);
		$forward_position = @strripos($response->response,'/');
		//echo substr($response->response,$forward_position+1);
		//pd($response->response);
		$this->load->helper('download');
		$data = file_get_contents($response->response); // Read the file's contents
		$name = substr($response->response,$forward_position+1);

		force_download($name, $data);
		//$this->rest->debug();exit;
	}

	public function addsemiadmin()
	{
		$response = $this->rest->get('toll/getTollLocations');
		chackStatus($response);
		//$this->rest->debug();exit;
		$toll_location = @$response->response;
		$this->rest->header("Authtoken",$this->auth_token);
		$toll_staff_details = $this->rest->get("toll/listSemiAdmins");
		chackStatus($toll_staff_details);
		//echo "<pre>";print_r($toll_staff_details->response);exit;
		//$this->rest->debug();exit;
		 
		
		$this->form_validation->set_rules('toll_center_loaction', 'Toll Location', 'trim|required');
		$this->form_validation->set_rules('toll_center_name', 'Toll Name', 'trim|required');
		$this->form_validation->set_rules('tcn', 'Toll Center Name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('roll', 'Roll', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('eamil', 'Emai', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|');
		//$this->form_validation->set_rules('otp', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['first_name']  = $this->input->post('first_name');
			$this->requestobj['last_name']  = $this->input->post('last_name');
			$this->requestobj['email_id']  = $this->input->post('eamil');
			$this->requestobj['password']  = $this->input->post('password');
			$this->requestobj['mobile_no']  = $this->input->post('mobile_number');
			$this->requestobj['roll_id']  = $this->input->post('roll');
			$this->requestobj['tc_id']  = $this->input->post('tcn');
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('toll/addSemiAdmin',$jsonObject);
			chackStatus($response);
			//echo "<pre>";print_r($response->statusMessage);exit;
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				$message = @$response->successMessage;
				$this->session->set_flashdata("msg",@$message);
				redirect('tollcenter/addsemiadmin');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter/addsemiadmin');
			}
			
		}
		else
		{
			$views = array('toll/addsemiadmin');
			$data = array('views'=>$views,'toll_location'=>@$toll_location,'toll_staff_details'=>@$toll_staff_details->response);
			$this->load->view('toll/template/template',$data);
		}
	}

	public function gettollcentername()
	{
		$toll_location = $this->input->post('location_id');
		//$toll_location = 'dsfsfs';
		$toll_names    = '';
		$this->requestobj['tc_location'] = $toll_location;
		$jsonObject = $this->bmt->user_params($this->requestobj);
		//echo $jsonObject;exit;
		$response = $this->rest->POST('toll/getTollName',$jsonObject);
		chackStatus($response);
		//$this->rest->debug();exit;
		if(@$response->statuscode == 200)
		{
			//pd($response);
			$count_tollnames = 0;
			$response_names = @$response->response;
			$toll_names .= "<option value=''>Toll Center Name</option>";
			foreach ($response_names as $key => $value) {
				$toll_names .= "<option value='$value->tc_name'>$value->tc_name</option>";
				$count_tollnames++;
			}
			if($count_tollnames == 0)
				$toll_names .= '<option value="">Toll Center is InActive</option>';
		}
		else{
			$toll_names .= '<option value="">Toll Center is InActive</option>';
		}
		echo $toll_names;
	}

	public function gettollcenternameforcharges()
	{
		$toll_location = $this->input->post('location_id');
		//$toll_location = 'dsfsfs';
		$toll_names    = '';
		$this->requestobj['tc_location'] = $toll_location;
		$jsonObject = $this->bmt->user_params($this->requestobj);
		//echo $jsonObject;exit;
		$response = $this->rest->POST('toll/tollNamesForCharges',$jsonObject);
		chackStatus($response);
		if(@$response->statuscode == 200)
		{
			//pd($response);
			$count_tollnames = 0;
			$response_names = @$response->response;
			$toll_names .= "<option value=''>Toll Center Name</option>";
			foreach ($response_names as $key => $value) {
				$toll_names .= "<option value='$value->tc_name'>$value->tc_name</option>";
				$count_tollnames++;
			}
			if($count_tollnames == 0)
				$toll_names .= '<option value="">No Toll Center Names</option>';
		}
		else{
			$toll_names .= '<option value="">No Toll Center Names</option>';
		}
		echo $toll_names;
	}

	public function gettollcenternameBank()
	{
		$toll_location = $this->input->post('location_id');
		//$toll_location = 'dsfsfs';
		$toll_names    = '';
		$this->requestobj['tc_location'] = $toll_location;
		$jsonObject = $this->bmt->user_params($this->requestobj);
		//echo $jsonObject;exit;
		$response = $this->rest->POST('toll/getTollNameForBank',$jsonObject);
		chackStatus($response);
		if(@$response->statuscode == 200)
		{
			//pd($response);
			$count_tollnames = 0;
			$response_names = @$response->response;
			$toll_names .= "<option value=''>Toll Center Name</option>";
			foreach ($response_names as $key => $value) {
				$toll_names .= "<option value='$value->tc_name'>$value->tc_name</option>";
				$count_tollnames++;
			}
			if($count_tollnames == 0)
				$toll_names .= '<option value="">No Toll Center Names</option>';
		}
		else{
			$toll_names .= '<option value="">No Toll Center Names</option>';
		}
		echo $toll_names;
	}

	public function gettcn()
	{
		$toll_center_name = $this->input->post('toll_center_name');
		$tcn    = '';
		$this->requestobj['tc_name'] = $toll_center_name;
		$jsonObject = $this->bmt->user_params($this->requestobj);
		//echo $jsonObject;exit;
		$response = $this->rest->post('toll/getTollLocationId',$jsonObject);
		chackStatus($response);
		//$this->rest->debug();exit;
		//pd($response);
		echo json_encode($response);
	}

	public function addbankdetails()
	{
		$response = $this->rest->get('toll/getTollLocations');
		//$this->rest->debug();exit;
		$toll_location = @$response->response;
		$this->rest->header("Authtoken",$this->auth_token);
		$bank_list = $this->rest->get('toll/getALLBankRelatedTolls');
		chackStatus($bank_list);
		//pd($bank_list);
		$this->rest->header("Authtoken",$this->auth_token);
		$bank_types = $this->rest->get('toll/bankTypes');
		chackStatus($bank_types);
		//pd($bank_types->response);
		$this->form_validation->set_rules('toll_center_loaction', 'Toll Location', 'trim|required');
		$this->form_validation->set_rules('toll_center_name', 'Toll Name', 'trim|required');
		$this->form_validation->set_rules('tcn', 'Toll Center Name', 'trim|required');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('bank_address', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('account_type', 'Account Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('account_num', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('account_name', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|');
		//$this->form_validation->set_rules('otp', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['bank_name']  = $this->input->post('bank_name');
			$this->requestobj['bank_address']  = $this->input->post('bank_address');
			$this->requestobj['ac_number']  = $this->input->post('account_num');
			$this->requestobj['ifsc_code']  = $this->input->post('ifsc_code');
			$this->requestobj['ac_name']  = $this->input->post('account_name');
			$this->requestobj['type_of_account']  = $this->input->post('account_type');
			$this->requestobj['tc_id']  = $this->input->post('tcn');
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('toll/addBankDetails',$jsonObject);
			chackStatus($response);
			//echo "<pre>";print_r($response->statusMessage);exit;
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				$message = @$response->successMessage;
				$this->session->set_flashdata("msg",@$message);
				redirect('tollcenter/addbankdetails');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter/addbankdetails');
			}
			
		}
		else
		{
			$views = array('toll/addbankdetails');
			$data = array('views'=>$views,'bank_list'=>@$bank_list->response,'toll_location'=>@$toll_location,'bank_types'=>@$bank_types->response);
			$this->load->view('toll/template/template',$data);
		}
	}

	public function updatebankdetails()
	{
		$this->form_validation->set_rules('tcn', 'Toll Center Id', 'trim|required');
		$this->form_validation->set_rules('bank_id', 'Bank Id', 'trim|required');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('bank_address', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('type_of_account', 'Account Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ac_number', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('ac_name', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|');
		//$this->form_validation->set_rules('otp', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		//pd($_POST);
		if($this->form_validation->run() == true)
		{
			$this->requestobj['bank_name']  = $this->input->post('bank_name');
			$this->requestobj['bank_address']  = $this->input->post('bank_address');
			$this->requestobj['ac_number']  = $this->input->post('ac_number');
			$this->requestobj['ifsc_code']  = $this->input->post('ifsc_code');
			$this->requestobj['ac_name']  = $this->input->post('ac_name');
			$this->requestobj['type_of_account']  = $this->input->post('type_of_account');
			$this->requestobj['tc_id']  = $this->input->post('tcn');
			$this->requestobj['bank_id']  = $this->input->post('bank_id');
			//pd($this->requestobj);
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$response = $this->rest->post('toll/updateBankDetails',$jsonObject);
			chackStatus($response);
			//echo "<pre>";print_r($response->statusMessage);exit;
			//$this->rest->debug();exit;
			echo json_encode($response);
			
		}
		else
		{
			echo html_entity_decode(validation_errors());
		}
	}

	public function get_single_bank()
	{
		$id = $this->input->post('id');
		$response_details = $this->rest->get("toll/getSpecificBankDetails/$id");
		chackStatus($response_details);
		$this->rest->header("Authtoken",$this->auth_token);
		$bank_types = $this->rest->get('toll/bankTypes');
		chackStatus($bank_types);
		$data['tollbank_single'] = @$response_details->response;
		$data['bank_types'] = @$bank_types->response;
		echo $this->load->view('toll/single_bankdetails',$data);
	}

	public function get_single_bank_view()
	{
		$id = $this->input->post('id');
		$response_details = $this->rest->get("toll/getSpecificBankDetails/$id");
		chackStatus($response_details);
		$this->rest->header("Authtoken",$this->auth_token);
		$bank_types = $this->rest->get('toll/bankTypes');
		chackStatus($bank_types);
		$data['tollbank_single'] = @$response_details->response;
		$data['bank_types'] = @$bank_types->response;
		echo $this->load->view('toll/single_bankdetails_view',$data);
	}

	public function tollcharges()
	{
		$response = $this->rest->get('toll/getTollLocations');
		chackStatus($response);
		//$this->rest->debug();exit;
		$toll_location = @$response->response;
		$this->rest->header("Authtoken",$this->auth_token);
		$vehical_types = @$this->rest->get('toll/getVehicalTypes');
		chackStatus($vehical_types);
		$this->rest->header("Authtoken",$this->auth_token);
		$response_charges_list = @$this->rest->get('toll/listTollChargesDEtails');
		//$this->rest->debug();exit;
		$this->form_validation->set_rules('toll_center_loaction', 'Toll Location', 'trim|required|xss_clean');
		$this->form_validation->set_rules('toll_center_name', 'Toll Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tcn', 'Toll Center Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('vehical_type', 'Vehical Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('one_way', 'One Way', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('two_way', 'Two Way', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('multi_way', 'Multi Way', 'trim|required|numeric|xss_clean');
		//$this->form_validation->set_rules('otp', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['type_id']  = $this->input->post('vehical_type');
			$this->requestobj['one_way_charge']  = $this->input->post('one_way');
			$this->requestobj['multi_way_charge']  = $this->input->post('multi_way');
			$this->requestobj['two_way_charge']  = $this->input->post('two_way');
			$this->requestobj['tc_id']  = $this->input->post('tcn');
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('toll/addTollCharges',$jsonObject);
			chackStatus($response);
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				$message = @$response->successMessage;
				//echo $message;exit;
				$this->session->set_flashdata("msg",@$message);
				redirect('tollcenter/tollcharges');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter/tollcharges');
			}
			
		}
		else
		{
			$views = array('toll/tollcharges');
			$data = array('views'=>$views,'response_charges_list'=>@$response_charges_list->response,'toll_location'=>@$toll_location,'vehical_type_list'=>@$vehical_types->response);
			$this->load->view('toll/template/template',$data);
		}
	}

	public function get_single_tollcenter_details()
	{
		$id = $this->input->post('id');
		$data['toll_center_detal'] = $this->rest->get("toll/getSpecificTollDetails/$id");
		chackStatus($data['toll_center_detal']);
		//$this->rest->debug();exit;
		echo $this->load->view('toll/single_tollcenter',@$data);
	}

	public function get_single_tollcenter_details_view()
	{
		$id = $this->input->post('id');
		$data['toll_center_detal'] = $this->rest->get("toll/getSpecificTollDetails/$id");
		chackStatus($data['toll_center_detal']);
		//$this->rest->debug();exit;
		echo $this->load->view('toll/single_tollcenter_view',@$data);
	}

	public function updatetoll($id = NULL)
	{
		if($id != NULL)
		{
			$data['toll_center_detal'] = $this->rest->get("toll/getSpecificTollDetails/$id");
			//$this->rest->debug();exit;
			chackStatus($data['toll_center_detal']);
		}
		//pd($data);
		$this->form_validation->set_rules('toll_location', 'Toll Location', 'trim|required');
		$this->form_validation->set_rules('toll_name', 'Toll Name', 'trim|required');
		$this->form_validation->set_rules('entry_from', 'Entry From', 'trim|required');
		$this->form_validation->set_rules('number_landes_from', 'Number Of Lanes From', 'trim|required|numeric');
		$this->form_validation->set_rules('number_landes_from_bmt', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('entry_from2', 'Becon One', 'trim|required');
		$this->form_validation->set_rules('number_landes_from2', 'Number Of Lanes From', 'trim|required|numeric');
		$this->form_validation->set_rules('number_landes_from_bmt2', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if(isset($_POST['from_uuid']) && !empty($_POST['from_uuid']))
		{
			$this->form_validation->set_rules('from_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('from_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkFromBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('from_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkFromBeconMinarId|callback_checkBeconMinarId');
		}
		if(isset($_POST['to_uuid']) && !empty($_POST['to_uuid']))
		{
			$this->form_validation->set_rules('to_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('to_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('to_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkToBeconMinarId|callback_checkBeconMinarId');
		}
		//$this->form_validation->set_rules('address', 'Address', 'trim|required');
		if($this->form_validation->run() == true)
		{
			//pd($_POST);
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];
			$address = $_POST['address'];
			
			$this->requestobj['lng']  = $lng;
			$this->requestobj['lat']  = $lat;
			$this->requestobj['address']  = $address;	

			$this->requestobj['tc_location']  = $this->input->post('toll_location');
			$this->requestobj['tc_name']  = $this->input->post('toll_name');
			$this->requestobj['from_way_location']  = $this->input->post('entry_from');
			$this->requestobj['from_way_no_of_lanes']  = $this->input->post('number_landes_from');
			$this->requestobj['from_way_no_of_bmt_lanes']  = $this->input->post('number_landes_from_bmt');
			$this->requestobj['to_way_location']  = $this->input->post('entry_from2');
			$this->requestobj['to_way_no_of_lanes']  = $this->input->post('number_landes_from2');
			$this->requestobj['to_way_no_of_bmt_lanes']  = $this->input->post('number_landes_from_bmt2');
			$this->requestobj['assigned_id'] = $this->user_id;
			$this->requestobj['tc_id'] =$this->input->post('toll_id');
			if(isset($_POST['from_uuid']) && !empty($_POST['from_uuid']))
			{
				$this->requestobj['from_uuid']  = $this->input->post('from_uuid');
				$this->requestobj['from_major_id']  = $this->input->post('from_major_id');
				$this->requestobj['from_minor_id']  = $this->input->post('from_minor_id');
				$this->requestobj['from_uuid_id']  = $this->input->post('from_uuid_id');
			}
			if(isset($_POST['to_uuid']) && !empty($_POST['to_uuid']))
			{
				$this->requestobj['to_uuid']  = $this->input->post('to_uuid');
				$this->requestobj['to_major_id']  = $this->input->post('to_major_id');
				$this->requestobj['to_minor_id']  = $this->input->post('to_minor_id');
				$this->requestobj['to_uuid_id']  = $this->input->post('to_uuid_id');
			}
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$response = $this->rest->post('toll/updateTollCenter',$jsonObject);
			chackStatus($response);
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				$message = @$response->successMessage;
				$this->session->set_flashdata("msg",@$message);
				redirect('tollcenter');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter');
			}
		}
		else
		{
			$views = array('toll/updatetoll');
			$data = array('views'=>$views,'data'=>@$data['toll_center_detal']);
			$this->load->view('toll/template/template',$data);
		}
	}

	public function updatetollcenterdetails()
	{
		$this->form_validation->set_rules('toll_location', 'Toll Location', 'trim|required');
		$this->form_validation->set_rules('toll_name', 'Toll Name', 'trim|required');
		$this->form_validation->set_rules('entry_from', 'Entry From', 'trim|required');
		$this->form_validation->set_rules('number_landes_from', 'Number Of Lanes From', 'trim|required|numeric');
		$this->form_validation->set_rules('number_landes_from_bmt', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('entry_from2', 'Becon One', 'trim|required');
		$this->form_validation->set_rules('number_landes_from2', 'Number Of Lanes From', 'trim|required|numeric');
		$this->form_validation->set_rules('number_landes_from_bmt2', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if(isset($_POST['from_uuid']) && !empty($_POST['from_uuid']))
		{
			$this->form_validation->set_rules('from_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('from_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkFromBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('from_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkFromBeconMinarId|callback_checkBeconMinarId');
		}
		if(isset($_POST['to_uuid']) && !empty($_POST['to_uuid']))
		{
			$this->form_validation->set_rules('to_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('to_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('to_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkToBeconMinarId|callback_checkBeconMinarId');
		}
		//$this->form_validation->set_rules('address', 'Address', 'trim|required');
		if($this->form_validation->run() == true)
		{
			$lat = 0;
			$lng = 0;
			$address = '';
			/*First Method*/
			//$strasse = $_POST['address'];
		    /*$inhalt = simplexml_load_file('http://maps.googleapis.com/maps/api/geocode/xml?'.
		                              'address='.rawurlencode($strasse).'&sensor=true');

		    $geo['lat'] = $inhalt->result->geometry->location->lat;
		    $geo['lon'] = $inhalt->result->geometry->location->lng;

		    print_r($inhalt->result->geometry->location->lat);*/

		    /*Second Method*/
		    $address = @$_POST['address']; // Google HQ
			$prepAddr = str_replace(' ','+',$address);
			 
			$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
			 
			$output= json_decode($geocode);
			 
			$latt = @$output->results[0]->geometry->location->lat;
			$long = @$output->results[0]->geometry->location->lng;

			if($latt != '')
				$lat = $latt;
			if($long != '')
				$lng = $long;

			if($address !='' && ($latt == '' && $long == ''))
			{
				$response = array('response'=>'','statuscode'=>409,'error'=>'Invalid Address');
				echo json_encode($response);
				/*$message = "Invalid Address";
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter');*/
				exit;
			}

			$this->requestobj['lng']  = $lng;
			$this->requestobj['lat']  = $lat;
			$this->requestobj['address']  = $address;	

			$this->requestobj['tc_location']  = $this->input->post('toll_location');
			$this->requestobj['tc_name']  = $this->input->post('toll_name');
			$this->requestobj['from_way_location']  = $this->input->post('entry_from');
			$this->requestobj['from_way_no_of_lanes']  = $this->input->post('number_landes_from');
			$this->requestobj['from_way_no_of_bmt_lanes']  = $this->input->post('number_landes_from_bmt');
			$this->requestobj['to_way_location']  = $this->input->post('entry_from2');
			$this->requestobj['to_way_no_of_lanes']  = $this->input->post('number_landes_from2');
			$this->requestobj['to_way_no_of_bmt_lanes']  = $this->input->post('number_landes_from_bmt2');
			$this->requestobj['assigned_id'] = $this->user_id;
			$this->requestobj['tc_id'] =$this->input->post('toll_id');
			if(isset($_POST['from_uuid']) && !empty($_POST['from_uuid']))
			{
				$this->requestobj['from_uuid']  = $this->input->post('from_uuid');
				$this->requestobj['from_major_id']  = $this->input->post('from_major_id');
				$this->requestobj['from_minor_id']  = $this->input->post('from_minor_id');
				$this->requestobj['from_uuid_id']  = $this->input->post('from_uuid_id');
			}
			if(isset($_POST['to_uuid']) && !empty($_POST['to_uuid']))
			{
				$this->requestobj['to_uuid']  = $this->input->post('to_uuid');
				$this->requestobj['to_major_id']  = $this->input->post('to_major_id');
				$this->requestobj['to_minor_id']  = $this->input->post('to_minor_id');
				$this->requestobj['to_uuid_id']  = $this->input->post('to_uuid_id');
			}
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$response = $this->rest->post('toll/updateTollCenter',$jsonObject);
			chackStatus($response);
			//$this->rest->debug();exit;
			echo json_encode($response);
		}
		else
		{
			echo html_entity_decode(validation_errors());
		}

	}

	public function delete_tollcenter($toll_id = NULL,$status = NULL)
	{
		if($status == 0)
			$status =1;
		else
			$status =0;
		$response = $this->rest->get("toll/deleteTollLoacation/$toll_id/$status");
		chackStatus($response);
		//$this->rest->debug();exit;
		if($response->statuscode == 200)
		{	
			$this->session->set_flashdata('msg',@$response->successMessage);
		}
		else{
			$this->session->set_flashdata('errormsg',@$response->error[0]);
		}
			redirect('tollcenter');
	}

	public function get_single_semiadmin()
	{
		$id = $this->input->post('id');
		$response = $this->rest->get('toll/getTollLocations');
		chackStatus($response);
		//pd($response);
		$this->rest->header("Authtoken",$this->auth_token);
		$response_semi_details = $this->rest->get("toll/getSpecificSemiadmindetails/$id");
		chackStatus($response_semi_details);
		//pd($response_semi_details);
		//$this->rest->debug();exit;
		//echo "<pre>";print_r($response_semi_details->response->TollStaffInfo);
		$data['tollLocations_single'] = @$response->response;
		$data['semiadmin_details'] = @$response_semi_details->response;
		//echo "<pre>";print_r($data);
		echo $this->load->view('toll/single_semiadmin',$data);
	}


	public function get_single_semiadmin_view()
	{
		$id = $this->input->post('id');
		$response = $this->rest->get('toll/getTollLocations');
		chackStatus($response);
		$this->rest->header("Authtoken",$this->auth_token);
		$response_semi_details = $this->rest->get("toll/getSpecificSemiadmindetails/$id");
		chackStatus($response_semi_details);
		//pd($response_semi_details);
		//$this->rest->debug();exit;
		//echo "<pre>";print_r($response_semi_details->response->TollStaffInfo);
		$data['tollLocations_single'] = @$response->response;
		$data['semiadmin_details'] = @$response_semi_details->response;
		//echo "<pre>";print_r($data);
		echo $this->load->view('toll/single_semiadmin_view',$data);
	}

	public function updasemiadmindetails()
	{
		if($this->role_id == 1)
		{
			$this->form_validation->set_rules('toll_center_loaction', 'Toll Location', 'trim|required');
			$this->form_validation->set_rules('toll_center_name', 'Toll Name', 'trim|required');
			$this->form_validation->set_rules('tcn', 'Toll Center Name', 'trim|required');
			$this->form_validation->set_rules('roll', 'Roll', 'trim|required|xss_clean|numeric');
		}
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('eamil', 'Emai', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|numeric');
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|');
		$this->form_validation->set_rules('user_id_update', 'User Id', 'trim|required|');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['first_name']   = $this->input->post('first_name');
			$this->requestobj['last_name']    = $this->input->post('last_name');
			$this->requestobj['email_id']     = $this->input->post('eamil');
			$this->requestobj['mobile_no']    = $this->input->post('mobile_number');
			if($this->role_id == 1)
			{
				$this->requestobj['roll_id']  = $this->input->post('roll');
				$this->requestobj['tc_id']    = $this->input->post('tcn');
			}
			if($this->role_id == 3)
			{
				$this->requestobj['roll_id']  = 4;
				$this->requestobj['tc_id']    = $this->tc_id;
			}
			$this->requestobj['ts_id']  = $this->input->post('user_id_update');
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$response = $this->rest->post('toll/updateSemiAdmin',$jsonObject);
			chackStatus($response);
			//pd($response);
			//$this->rest->debug();
			echo json_encode($response);
		}
		else
		{
			echo html_entity_decode(validation_errors());
		}
	}

	public function delete_semiadmin($semiadmin_id = NULL,$status = NULL)
	{
		if($status == 0)
			$status = 1;
		else
			$status = 0;
		$response = $this->rest->get("toll/activrOrInactiveAdmin/$semiadmin_id/$status");
		chackStatus($response);
		//$this->rest->debug();exit;
		if($response->statuscode == 200)
		{	
			$this->session->set_flashdata('msg',@$response->successMessage);
		}
		else{
			$this->session->set_flashdata('errormsg',@$response->error[0]);
		}
			redirect('tollcenter/addsemiadmin');
	}

	public function delete_operator($operator_id = NULL)
	{
		//http://192.168.1.67:9091/BmtRestService/rest/BMT/TollStaff/deleteSemiAdmin?superadmin_id=2&&semiadmin_id=33&&role_id=1&&auth_token=MDE0NDc5MzAwMDE3MDc=

		$response = $this->rest->get("toll/activeOrInactiveOperator/$operator_id");
		chackStatus($response);
		//$this->rest->debug();exit;
		if($response->statuscode == 200)
		{	
			$this->session->set_flashdata('msg',@$response->successMessage);
		}
		else{
			$this->session->set_flashdata('errormsg',@$response->error[0]);
		}
			redirect('addtolloperator');
	}

	public function get_single_charge_details()
	{
		$id = $this->input->post('id');
		$vehical_types = @$this->rest->get('toll/getVehicalTypes');
		chackStatus($vehical_types);
		$data['vehical_types'] = @$vehical_types->response;
		$data['tc_id'] = @$id;
		echo $this->load->view('toll/single_tollcharges',$data);
	}

	public function get_single_charge_details_for_view()
	{
		$id = $this->input->post('id');
		$vehical_types = @$this->rest->get('toll/getVehicalTypes');
		chackStatus($vehical_types);
		$data['vehical_types'] = @$vehical_types->response;
		$data['tc_id'] = @$id;
		echo $this->load->view('toll/single_tollcharges_view',$data);
	}

	public function updatecharegedetails()
	{
		$this->form_validation->set_rules('tcn_no', 'Toll Center Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('vehical_type', 'Vehical Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('oneway_charge', 'One Way', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('twoway_charge', 'Two Way', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('multiway_charge', 'Multi Way', 'trim|required|numeric|xss_clean');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['vehical_type']  = $this->input->post('vehical_type');
			$this->requestobj['one_way_charge']  = $this->input->post('oneway_charge');
			$this->requestobj['multi_way_charge']  = $this->input->post('multiway_charge');
			$this->requestobj['two_way_charge']  = $this->input->post('twoway_charge');
			$this->requestobj['tc_id']  = $this->input->post('tcn_no');
			$jsonObject = $this->bmt->user_params($this->requestobj);
			$response = $this->rest->post('toll/updateTollCharges',$jsonObject);
			chackStatus($response);
			//echo $jsonObject;exit;
			//$this->rest->debug();exit;
			echo json_encode($response);
		}
		else
		{
			echo html_entity_decode(validation_errors());
		}

	}

	public function  getSpecificTollCharges()
	{
		//pd($_POST);
		$location_id = $_POST['location_id'];
		$vehical_type_id = $_POST['vehical_type'];
		$response = @$this->rest->get("toll/getSpecificTollCharges/$location_id/$vehical_type_id");
		chackStatus($response);
		//$this->rest->debug();
		echo json_encode($response);
	}

	public function addtolloperator()
	{
		$toll_staff_details = $this->rest->get("toll/listTollOperator");
		chackStatus($toll_staff_details);
		//echo "<pre>";print_r($response);exit;
		//$this->rest->debug();exit;
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('eamil', 'Emai', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|');
		//$this->form_validation->set_rules('otp', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if($this->form_validation->run() == true)
		{
			$this->requestobj['first_name'] = $this->input->post('first_name');
			$this->requestobj['last_name']  = $this->input->post('last_name');
			$this->requestobj['email_id']   = $this->input->post('eamil');
			$this->requestobj['password']   = $this->input->post('password');
			$this->requestobj['mobile_no']  = $this->input->post('mobile_number');
			$this->requestobj['roll_id']    = 4;
			$this->requestobj['tc_id']      = $this->tc_id;
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('toll/addSemiAdmin',$jsonObject);
			chackStatus($response);
			//echo "<pre>";print_r($response->statusMessage);exit;
			//$this->rest->debug();exit;
			if($response->statuscode == 200)
			{
				$message = @$response->successMessage;
				$this->session->set_flashdata("msg",@$message);
				redirect('tollcenter/addtolloperator');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('tollcenter/addtolloperator');
			}
			
		}
		else
		{
			$views = array('toll/addtolloperator');
			$data = array('views'=>$views,'toll_staff_details'=>@$toll_staff_details->response);
			$this->load->view('toll/template/template',$data);
		}
	}

	public function view()
	{
		if($this->role_id == 1){
			$response = $this->rest->get('toll/superAdminView');
			chackStatus($response);
		}
		$views = array('toll/superadmin_view');
		$data = array('views'=>$views,'data'=>@$response->response);
		$this->load->view('toll/template/template',$data);
	}

	public function lanedetails()
	{
		$toll_data = $this->rest->get('toll/getLoginUserTollName');
		chackStatus($toll_data);
		$this->rest->header("Authtoken",$this->auth_token);
		$lane_details = $this->rest->get('toll/getLaneDetails');
		$from_way_total_lanes = @$lane_details->response->beacon_details->from_way_no_of_lanes;
		$to_way_total_lanes = @$lane_details->response->beacon_details->to_way_no_of_lanes;
		$from_way_total_lanes_bmt = @$lane_details->response->beacon_details->from_way_no_of_bmt_lanes;
		$to_way_total_lanes_bmt = @$lane_details->response->beacon_details->to_way_no_of_bmt_lanes;
		//pd($lane_details->response);
		//$this->rest->debug();exit;
		$from_lanes_mapped = array();
		$to_lanes_mapped = array();
		if(!empty($lane_details->response->maped_lane_details_from))
		{
			foreach ($lane_details->response->maped_lane_details_from as $key => $value) {
				$from_lanes_mapped[$value->lane_number] = array('status_flag'=>$value->status_flag);
			}
		}
		if(!empty($lane_details->response->maped_lane_details_to))
		{
			foreach ($lane_details->response->maped_lane_details_to as $key => $value) {
				$to_lanes_mapped[$value->lane_number] = array('status_flag'=>$value->status_flag);
			}
		}
		//pd($to_lanes_mapped);
		//$this->rest->debug();exit;
		$views = array('toll/lane_details');
		$data = array('views'=>$views,'toll_data'=>@$toll_data->response,'lane_details'=>@$lane_details->response,'from_lanes_mapped'=>@$from_lanes_mapped,'to_lanes_mapped'=>@$to_lanes_mapped,'from_way_total_lanes'=>@$from_way_total_lanes,'to_way_total_lanes'=>@$to_way_total_lanes,'from_way_total_lanes_bmt'=>@$from_way_total_lanes_bmt,'to_way_total_lanes_bmt'=>@$to_way_total_lanes_bmt);
		$this->load->view('toll/template/template',$data);
	}

	public function updatelanedetails()
	{
		if(count($_POST['from']) > $_POST['from_way_total_lanes_bmt'])
		{
			$lane_count = $_POST['from_way_total_lanes_bmt'];
			$this->session->set_flashdata("errormsg","You are Able To Check Only $lane_count Lanes From First Entry");
			redirect('lanedetails');
			exit;
		}
		if(count($_POST['to']) > $_POST['to_way_total_lanes_bmt']){
			$lane_count = $_POST['to_way_total_lanes_bmt'];
			$this->session->set_flashdata("errormsg","You are Able To Check Only $lane_count Lanes From Second Entry");
			redirect('lanedetails');
			exit;
		}
		$this->requestobj['from_lanes'] = $this->input->post('from');
		$this->requestobj['to_lanes']   = $this->input->post('to');
		$this->requestobj['tc_id']   = @$this->tc_id;
		$jsonObject = $this->bmt->user_params($this->requestobj);
		//echo $jsonObject;exit;
		$response = $this->rest->post('toll/updateLaneDetails',$jsonObject);
		chackStatus($response);
		//$this->rest->debug();
		if($response->statuscode == 200)
		{
			$message = @$response->successMessage;
			$this->session->set_flashdata("msg",@$message);
			redirect('lanedetails');
		}
		else
		{
			$message = @$response->error[0];
			$this->session->set_flashdata("errormsg",@$message);
			redirect('lanedetails');
		}

		/*Below Code is usefull when there is condition like at least one BMT toll is required*/

		/*if(!empty($_POST['from'])  || !empty($_POST['to'][0]))
		{
			$this->requestobj['from_lanes'] = $this->input->post('from');
			$this->requestobj['to_lanes']   = $this->input->post('to');
			$this->requestobj['tc_id']   = @$this->tc_id;
			$jsonObject = $this->bmt->user_params($this->requestobj);
			//echo $jsonObject;exit;
			$response = $this->rest->post('toll/updateLaneDetails',$jsonObject);
			//$this->rest->debug();
			if($response->statuscode == 200)
			{
				$message = @$response->successMessage;
				$this->session->set_flashdata("msg",@$message);
				redirect('lanedetails');
			}
			else
			{
				$message = @$response->error[0];
				$this->session->set_flashdata("errormsg",@$message);
				redirect('lanedetails');
			}
		}
		else
		{
			$this->session->set_flashdata("errormsg","Please Check Atleast One Lane");
			redirect('lanedetails');
		}*/
	}


	public function changepassword()
	{
		$this->form_validation->set_rules('old_password',"Old Password",'trim|required|xss_clean');
		$this->form_validation->set_rules('new_password',"New Password",'trim|required|xss_clean');
		$this->form_validation->set_rules('confirm_password',"Confirm Password",'trim|required|xss_clean');
		if($this->form_validation->run() == false)
		{
			echo html_entity_decode(validation_errors());
			exit;
		}
		else
		{

			$this->requestobj['oldpassword'] = $this->input->post('old_password');
			$this->requestobj['newpassword'] = $this->input->post('new_password');
			$this->requestobj['confirmpassword'] = $this->input->post('confirm_password');
			$_POST = $this->requestobj;
			$jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject;exit;
			//$this->rest->header("Authtoken",$this->auth_token);
			$response = $this->rest->post('toll/changePassword',$jsonObject);
			//$this->rest->debug();
			//exit;
			echo json_encode($response);			
			exit;	
		}
	}
	public function refundstatus(){

		$refund_details = $this->rest->get("toll/refundStatus");
		//echo $this->rest->debug();exit;
//echo "<pre>"; print_r($refund_details->response);exit;
		$views = array('toll/refund');
		if($refund_details->response!=4){
        $data = array('views'=>$views,'refunds'=>$refund_details->response);
		}else{
		$data = array('views'=>$views);	
		}
		
		$this->load->view('toll/template/template',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */