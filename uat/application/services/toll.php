<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Bmt
 *
 * @Class		Toll
 * @Developer	Lokesh
 * @Start Date	23/11/2015
 * @End Date	@todo
 */
class Toll extends CI_Controller {

	private $businessObject = [ "tc_location"             => "",
								"tc_name"                 => "",
								"from_way_location"       => "",
								"from_way_no_of_lanes"    => "",
								"from_way_no_of_bmt_lanes"=> "",
								"to_way_location"         => "",
								"to_way_no_of_lanes"      => "",
								"to_way_no_of_bmt_lanes"  => "",
							  ];

	private $objkeys = [];
	protected $requestObject = NULL;
	private $login_user_details = '';
	public function __construct(){
		parent::__construct();
		$method = $_SERVER['REQUEST_METHOD'];
	    if($method == "OPTIONS") {
	        die();
	    }
	    $this->load->model('Tollcenter_model','toll');
		$this->load->model('tollstaff_model','tollstaff');
		$this->load->model('bankdetails_model','bankdetails');
		$this->load->model('tollcharges_model','chargesdetails');
		$this->load->model('bmtlanes_model','lanes');
		$this->load->library('email');
		$this->objkeys       = array_keys($this->businessObject);
		if($this->rest->request->method ===  "post"){
			$this->requestObject = $this->rest->post("request");
		}
		$this->login_user_details =  getLoginUserId();
		$this->login_user_id      =  @$this->login_user_details['ts_id'];
		$this->login_role_id      =  @$this->login_user_details['roll_id'];
		$this->old_password       =  @$this->login_user_details['password'];
	}

	/**
	 * [addtollcenter description] [Adding Toll center]
	 * @return [type]      [array]
	 * [method]            [Post]
	 * [request]		   [BASE_URL/api/toll/addtollcenter]
	 * [response]		   []
	 */
	public function addTollCenter()
	{
		$this->rest->validateRequestObject($this->objkeys,$this->requestObject);
        $_POST = $this->requestObject;
        //pd($_POST);
        $this->form_validation->set_rules('tc_location', 'Toll Location', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tc_name', 'Toll Name', 'trim|required|callback_checkTollName|max_length[30]');
		$this->form_validation->set_rules('from_way_location', 'Entry From', 'trim|required|max_length[20]');
		//$this->form_validation->set_rules('from_way_beacon_id', 'Becon One', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('from_way_no_of_lanes', 'Number Of Lanes From', 'trim|required|numeric|max_length[9]');
		$this->form_validation->set_rules('from_way_no_of_bmt_lanes', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|max_length[9]|callback_checkNumberOffromLanes');
		$this->form_validation->set_rules('to_way_location', 'Becon One', 'trim|required|max_length[20]');
		//$this->form_validation->set_rules('to_way_beacon_id', 'Becon Two', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('to_way_no_of_lanes', 'Number Of Lanes From', 'trim|required|numeric|max_length[9]');
		$this->form_validation->set_rules('to_way_no_of_bmt_lanes', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|max_length[9]|callback_checkNumberOfToLanes');
		$this->form_validation->set_rules('assigned_id', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if(isset($_POST['from_uuid']))
		{
			$this->form_validation->set_rules('from_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('from_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkFromBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('from_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkFromBeconMinarId|callback_checkBeconMinarId');
		}
		if(isset($_POST['to_uuid']))
		{
			$this->form_validation->set_rules('to_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('to_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('to_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_checkToBeconMinarId|callback_checkBeconMinarId');
		}
		if($this->form_validation->run() == false)
		{
			$this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
		}
		else
		{
        	$image_url = '';
        	if(isset($_POST['image_url']) && !empty($_POST['image_url']) && $_POST['image_url'] != '')
        	{
        		$image_url = $this->uploadDocument($_POST['image_url'],$_POST['tc_name']);
        	}
        	$_POST['tc_created_date'] = date("Y-m-d H:i:s");
        	$_POST['image_url'] = $image_url;
			$tc_id = $this->toll->addTolllocation($_POST);
			if($tc_id)
			{
				$from_lanes = $_POST['from_way_no_of_lanes'];
				for ($i=1; $i <=$from_lanes ; $i++) 
				{
					$fromlane_details[$i] = array('tc_id'=>$tc_id,'way_type'=>1,'lane_number'=>$i,'created_date'=>$_POST['tc_created_date']);
				}
				$to_lanes = $_POST['to_way_no_of_lanes'];
				for ($i=1; $i <=$to_lanes ; $i++) 
				{
					$tolane_details[$i] = array('tc_id'=>$tc_id,'way_type'=>2,'lane_number'=>$i,'created_date'=>$_POST['tc_created_date']);
				}
				$this->lanes->createLanes($fromlane_details);
				$this->lanes->createLanes($tolane_details);
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Toll Center '.CREATEDONE));
               	return; 
			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
                return;
			}
			
		}
	}

	
    /**
	 * [checkTollName description] [Check toll center name is exist or not]
	 * @return [type] [boolean]
	 */
	public function checkTollName($name)
	{
	    $table_name = 'toll_center';
	    $where_condition = array('tc_name'=>$name);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkTollName', "The Toll  Center Name Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}
	/**
	 * [checkFromBeconMajorId description] [Check Major Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function checkFromBeconMajorId($major)
	{
		$table_name = 'beacons';
	    $where_condition = array('major_id'=>$major);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkFromBeconMajorId', "The Major Id $major Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}
	/**
	 * [checkFromBeconMinarId description] [Check minor Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function checkFromBeconMinarId($minor)
	{
		$table_name = 'beacons';
	    $where_condition = array('minor_id'=>$minor);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkFromBeconMinarId', "The Minor Id $minor Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [checkToBeconMajorId description] [Check Major Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function checkToBeconMajorId($major)
	{
		$table_name = 'beacons';
	    $where_condition = array('major_id'=>$major);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkToBeconMajorId', "The Major Id $major Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}
	/**
	 * [checkFromBeconMajorId description] [Check minor Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function checkToBeconMinarId($minor)
	{
		$table_name = 'beacons';
	    $where_condition = array('minor_id'=>$minor);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkToBeconMinarId', "The Minor Id $minor Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [checkBeconMinarId description] [Check minor Beacon ids not same]
	 * @return [type] [boolean]
	 */
	public function checkBeconMinarId()
	{
		
		if((isset($_POST['from_minor_id']) && isset($_POST['to_minor_id'])) && ($_POST['from_minor_id'] == $_POST['to_minor_id']))
		{
	    	$this->form_validation->set_message('checkBeconMinarId', "The Minor Id's Are Same");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [checkBeconMajorId description] [Check minor Beacon ids not same]
	 * @return [type] [boolean]
	 */
	public function checkBeconMajorId()
	{
		
		if((isset($_POST['to_major_id']) && isset($_POST['from_major_id'])) && ($_POST['to_major_id'] == $_POST['from_major_id']))
		{
	    	$this->form_validation->set_message('checkBeconMajorId', "The Major Id's Same");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [checkNumberOffromLanes description] [Check bmt lanes less than the number of total lanes or not]
	 * @return [type] [boolean]
	 */
	public function checkNumberOffromLanes($bmtlanes)
	{
		//echo $bmtlanes;
		if($bmtlanes > $_POST['from_way_no_of_lanes'])
	    {
	    	$this->form_validation->set_message('checkNumberOffromLanes', "Number Of Bmt Lanes Should Be Less Than The Total Number Of Lanes");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    	echo "string";
	    }
		exit;
	}

	/**
	 * [checkNumberOffromLanes description] [Check bmt lanes less than the number of total lanes or not]
	 * @return [type] [boolean]
	 */
	public function checkNumberOfToLanes($to_bmtlanes)
	{
		if($to_bmtlanes > $_POST['to_way_no_of_lanes'])
	    {
	    	$this->form_validation->set_message('checkNumberOfToLanes', "Number Of Bmt Lanes Should Be Less Than The Total Number Of Lanes");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
		exit;
	}

	function uploadDocument($image,$tollname)
    {
        $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($imageDataEncoded);
        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = md5($tollname).strtotime(date('H:i:s')).".jpg";
      
        //$name = strtotime(date('H:i:s')).".jpg";
        $imageName = USER_DOCUMENT_PATH.$name;
        
        $imageSave = imagejpeg($rotate,$imageName,100);
        imagedestroy($source);
        $name = base_url().'uploads/documents/'.$name;
        return $name;
    }

    function uploadNewDocument()
    {
    	$_POST = $this->requestObject;
    	//pd($_POST);
    	//$image_url = $this->uploadDocument($_POST['image_url'],$_POST['tc_id']);
    	$table_name = 'toll_center';
		$where_condition =array('tc_id'=>$_POST['tc_id']);
		$data = array('image_url'=>$_POST['image_url']);
		if(updaterecord($table_name,$where_condition,$data))
		{
			$this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Document Uploaded Successfully'));
            return;
		}
    }

    public function getDocumentUrl($tc_id)
    {
    	$table_name = 'toll_center';
    	$where_condition = array('tc_id'=>$tc_id);
    	$column = 'image_url';
    	$data = getRequireFields($table_name,$where_condition,$column);
    	//pd($data['image_url']);
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data['image_url'],success,'Document URL'));
        return;
    }

	/**
	 * [updateTollCenter description] [Update Toll center]
	 * @return [type]      [array]
	 * [method]            [Post]
	 * [request]		   [BASE_URL/api/toll/updateTollCenter]
	 * [response]		   []
	 */
	public function updateTollCenter()
	{
		$this->rest->validateRequestObject($this->objkeys,$this->requestObject);
        $_POST = $this->requestObject;
		$table = 'toll_center';
        $where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
        $this->form_validation->set_rules('tc_id', 'Toll Location Id', 'trim|required');
        $this->form_validation->set_rules('tc_location', 'Toll Location', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tc_name', 'Toll Name', 'trim|required|callback_updateCheckTollName|max_length[30]');
		$this->form_validation->set_rules('from_way_location', 'Entry From', 'trim|required|max_length[20]');
		//$this->form_validation->set_rules('from_way_beacon_id', 'Becon One', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('from_way_no_of_lanes', 'Number Of Lanes From', 'trim|required|numeric|max_length[9]');
		$this->form_validation->set_rules('from_way_no_of_bmt_lanes', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|max_length[9]|callback_checkNumberOffromLanes');
		$this->form_validation->set_rules('to_way_location', 'Becon One', 'trim|required|max_length[20]');
		//$this->form_validation->set_rules('to_way_beacon_id', 'Becon Two', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('to_way_no_of_lanes', 'Number Of Lanes From', 'trim|required|numeric|max_length[9]');
		$this->form_validation->set_rules('to_way_no_of_bmt_lanes', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|max_length[9]|callback_checkNumberOfToLanes');
		$this->form_validation->set_rules('assigned_id', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		
		if(isset($_POST['from_uuid']))
		{
			$this->form_validation->set_rules('from_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('from_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_updatecheckFromBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('from_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_updatecheckFromBeconMinarId|callback_checkBeconMinarId');
			$this->form_validation->set_rules('from_uuid_id', 'Becon UUID Id', 'trim|required');
		}
		if(isset($_POST['to_uuid']))
		{
			$this->form_validation->set_rules('to_uuid', 'Becon UUID', 'trim|required|max_length[250]');
			$this->form_validation->set_rules('to_major_id', 'Becon Major Id', 'trim|required|max_length[10]|callback_updatecheckToBeconMajorId|callback_checkBeconMajorId');
			$this->form_validation->set_rules('to_minor_id', 'Becon Minor Id', 'trim|required|max_length[10]|callback_updatecheckToBeconMinarId|callback_checkBeconMinarId');
			$this->form_validation->set_rules('to_uuid_id', 'Becon UUID Id', 'trim|required');
		}
		if($this->form_validation->run() == false)
		{
		
			//pd(validation_errors());
			$this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
		}
		else
		{
			$table_name = 'toll_center';
			$where_condition =array('tc_id'=>$_POST['tc_id']);
			$data = array('tc_name'=>$_POST['tc_name'],'tc_location'=>$_POST['tc_location'],'from_way_no_of_lanes'=>$_POST['from_way_no_of_lanes'],'from_way_no_of_bmt_lanes'=>$_POST['from_way_no_of_bmt_lanes'],'from_way_location'=>$_POST['from_way_location'],'to_way_location'=>$_POST['to_way_location'],'to_way_no_of_lanes'=>$_POST['to_way_no_of_lanes'],'to_way_no_of_bmt_lanes'=>$_POST['to_way_no_of_bmt_lanes'],'lng'=>$_POST['lng'],'lat'=>$_POST['lat'],'address'=>$_POST['address']);

			if(updaterecord($table_name,$where_condition,$data))
			{
				if(isset($_POST['from_uuid']))
				{
					//pd($_POST);
					$becon_one = array('uuid'=>$_POST['from_uuid'],'major_id'=>$_POST['from_major_id'],'minor_id'=>$_POST['from_minor_id']);
					$table_name = 'beacons';
					$where_condition = array('beacon_id'=>$_POST['from_uuid_id']);
					updaterecord($table_name,$where_condition,$becon_one);
					//echo "<pre>";print_r($becon_one);
				}
				if(isset($_POST['to_uuid']))
				{
					$becon_two = array('uuid'=>$_POST['to_uuid'],'major_id'=>$_POST['to_major_id'],'minor_id'=>$_POST['to_minor_id']);
					$table_name = 'beacons';
					$where_condition = array('beacon_id'=>$_POST['to_uuid_id']);
					updaterecord($table_name,$where_condition,$becon_two);
					//echo "<pre>";print_r($becon_two);
				}
				$this->lanes->deleteOldRecords($_POST['tc_id']);
				//pd($_POST['tc_id']);
				$_POST['tc_created_date'] = date("Y-m-d H:i:s");
				$from_lanes = $_POST['from_way_no_of_lanes'];
				for ($i=1; $i <=$from_lanes ; $i++) 
				{
					$fromlane_details[$i] = array('tc_id'=>$_POST['tc_id'],'lane_number'=>$i,'way_type'=>1,'created_date'=>$_POST['tc_created_date']);
				}
				$to_lanes = $_POST['to_way_no_of_lanes'];
				for ($i=1; $i <=$to_lanes ; $i++) 
				{
					$tolane_details[$i] = array('tc_id'=>$_POST['tc_id'],'lane_number'=>$i,'way_type'=>2,'created_date'=>$_POST['tc_created_date']);
				}

				$this->lanes->createLanes($fromlane_details);
				$this->lanes->createLanes($tolane_details);

				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Toll Center '.UPDATEDONE));
               	return;

			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
                return;
			}
			
		}
	}

	/**
	 * [updatecheckFromBeconMajorId description] [Check Major Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function updatecheckFromBeconMajorId($major)
	{
		$table_name = 'beacons';
	    $where_condition = array('major_id'=>$major,'beacon_id !='=>$_POST['from_uuid_id']);
	    //pd($where_condition);exit;
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckFromBeconMajorId', "The Major Id $major Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}
	
	/**
	 * [updatecheckToBeconMajorId description] [Check Major Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function updatecheckToBeconMajorId($major)
	{
		$table_name = 'beacons';
	    $where_condition = array('major_id'=>$major,'beacon_id !='=>$_POST['to_uuid_id']);
	    //pd($where_condition);exit;
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckToBeconMajorId', "The Major Id $major Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [updatecheckFromBeconMinarId description] [Check minor Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function updatecheckFromBeconMinarId($minor)
	{
		$table_name = 'beacons';
	    $where_condition = array('minor_id'=>$minor,'beacon_id !='=>$_POST['from_uuid_id']);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckFromBeconMinarId', "The Minor Id $minor Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [updatecheckToBeconMinarId description] [Check minor Beacon id is exist or not]
	 * @return [type] [boolean]
	 */
	public function updatecheckToBeconMinarId($minor)
	{
		$table_name = 'beacons';
	    $where_condition = array('minor_id'=>$minor,'beacon_id !='=>$_POST['to_uuid_id']);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckToBeconMinarId', "The Minor Id $minor Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

    /**
	 * [checkTollName description] [Check toll center name is exist or not]
	 * @return [type] [boolean]
	 */
	public function updateCheckTollName($name)
	{
	    $table_name = 'toll_center';
	    $where_condition = array('tc_name'=>$name,'tc_id !=' =>$_POST['tc_id']);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updateCheckTollName', "The Toll  Center Name Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [checkNumberOffromLanes description] [Check bmt lanes less than the number of total lanes or not]
	 * @return [type] [boolean]
	 */
	public function updateCheckNumberOffromLanes($bmtlanes)
	{
		if($bmtlanes > $_POST['from_way_no_of_lanes'])
	    {
	    	$this->form_validation->set_message('updateCheckNumberOffromLanes', "Number Of Bmt Lanes Should Be Less Than The Total Number Of Lanes");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    	echo "string";
	    }
		exit;
	}

	/**
	 * [checkNumberOffromLanes description] [Check bmt lanes less than the number of total lanes or not]
	 * @return [type] [boolean]
	 */
	public function updateCheckNumberOfToLanes($to_bmtlanes)
	{
		if($to_bmtlanes > $_POST['to_way_no_of_lanes'])
	    {
	    	$this->form_validation->set_message('updateCheckNumberOfToLanes', "Number Of Bmt Lanes Should Be Less Than The Total Number Of Lanes");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
		exit;
	}

	public function getTollNameForBank()
	{
		$_POST =  $this->requestObject;
		$data = $this->bankdetails->getBankTollNames($this->login_user_id,$_POST['tc_location']);	
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;	
	}

	public function getTollNameForCharge()
	{
		$_POST =  $this->requestObject;
		$data = $this->toll->getTollNamesForCharge($this->login_user_id,$_POST['tc_location']);	
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;	
	}

	/**
	 * [listTollCenterLocations description] [Listing Toll center]
	 * @return [type]      [object]
	 * [method]            [Get]
	 * [request]		   [BASE_URL/api/toll/listTollCenterLocations]
	 * [response]		   []
	 */
	public function listTollCenterLocations()
	{
		$data = $this->toll->listTollCenters($this->login_user_id);
		$result['TollCcenterDetails'] = $data;
		$this->rest->response(responseObject(SUCCESS_CODE,'',$result,success,''));
        return;
	}

	/**
	 * [listTollCenterLocations description] [Listing Toll center]
	 * @return [type]      [object]
	 * [method]            [Get]
	 * [request]		   [BASE_URL/api/toll/listTollCenterLocations]
	 * [response]		   []
	 */
	public function deleteTollLoacation($toll_id,$get_status)
	{
		//echo "ff=".$toll_id;exit;
		$table = 'toll_center';
        $where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$toll_id);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
            return;
        }

        $table = 'toll_center';
		$where_condition = array('tc_id'=>$toll_id);
        $status = getStatus($table,$where_condition);
       	if($status == $get_status)
       	{
       		$this->rest->response(responseObject(CONFLICT_CODE,"Invalid Operation",'',fail,''));
            return;
       	}
       	if($get_status == 0)
       	{
       		$table_name = 'toll_staff';
			$where_condition = array('tc_id'=>$toll_id,'status_flag'=>1,'roll_id'=>3);
       		$number_records = getNumberOfRecords($table_name,$where_condition);
       		if($number_records > 1)
       		{
       			$this->rest->response(responseObject(CONFLICT_CODE,"There Are Other Users In Inactive State With This Location",'',fail,''));
           		return;
       		}
       		$table_name = 'toll_center';
			$where_condition = array('tc_id'=>$toll_id);
			$data = array('status_flag'=>0);
			if(updaterecord($table_name,$where_condition,$data))
			{
				$table_name = 'toll_staff';
				$where_condition = array('tc_id'=>$toll_id);
				$data = array('status_flag'=>0);
				updaterecord($table_name,$where_condition,$data);
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"Toll Center Activated Successfully"));
	           	return; 
			}
       	}
       	else
       	{
       		$table_name = 'toll_center';
			$where_condition = array('tc_id'=>$toll_id);
			$data = array('status_flag'=>1);
			if(updaterecord($table_name,$where_condition,$data))
			{
				$table_name = 'toll_staff';
				$where_condition = array('tc_id'=>$toll_id);
				$data = array('status_flag'=>1);
				updaterecord($table_name,$where_condition,$data);
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"Toll Center Inactivated Successfully"));
	           	return; 
			}	
       	}
      /*
       	if($status == 0)
        {
        	$flag = 1;
        	$message = "Inactivated Successfully";
        }
        else
        {
        	$flag = 0;
        	$message = "Activated Successfully";	
        }
		//echo $flag;exit;
        $table_name = 'toll_center';
		$where_condition = array('tc_id'=>$toll_id);
		$data = array('status_flag'=>$flag);
		$table_name = 'toll_center';
		$where_condition = array('tc_id'=>$toll_id);
		$data = array('status_flag'=>1);
		if(updaterecord($table_name,$where_condition,$data))
		{
			if($flag == 1)
			{
				$table_name = 'toll_staff';
				$where_condition = array('tc_id'=>$toll_id);
				updaterecord($table_name,$where_condition,$data);
			}
			$table_name = 'toll_staff';
			$where_condition = array('tc_id'=>$toll_id);
			$data = array('status_flag'=>1);
			updaterecord($table_name,$where_condition,$data);
			$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"Toll Center Inactivated Successfully"));
           	return; 
		}
		else
		{
			$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
            return;
		}*/
	}

	/**
	 * [getSpecificTollDetails description] [Get specific toll location details]
	 * @return [type]      [object]
	 * [method]            [Get]
	 * [request]		   [BASE_URL/api/toll/getSpecificTollDetails]
	 * [response]		   []
	 */
	public function getSpecificTollDetails($toll_id)
	{
		$table = 'toll_center';
        $where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$toll_id);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
            return;
        }
		$data = $this->toll->getSpecificTollDetails($toll_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	/**
	 * [getTollLocations description] [Get  toll location]
	 * @return [type]      [object]
	 * [method]            [Get]
	 * [request]		   [BASE_URL/api/toll/getTollLocations]
	 * [response]		   []
	 */
	public function getTollLocations()
	{
		$data = $this->toll->tollLocations($this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	/**
	 * [getTollName description] [Get  toll name]
	 * @return [type]      [object]
	 * [method]            [Get]
	 * [request]		   [BASE_URL/api/toll/getTollName]
	 * [response]		   []
	 */
	public function getTollName()
	{
		$_POST = $this->requestObject;
		//pd($_POST['tc_location']);
		$data = $this->toll->tollName($_POST['tc_location'],$this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	/**
	 * [getTollLocationId description] [Get  toll location id]
	 * @return [type]      [object]
	 * [method]            [Get]
	 * [request]		   [BASE_URL/api/toll/getTollLocationId]
	 * [response]		   []
	 */
	public function getTollLocationId()
	{
		$_POST = $this->requestObject;
		$data = $this->toll->tollLocationId($_POST['tc_name'],$this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	/**
	 * [addSemiAdmin description] [Create Semi admin]
	 * @return [type]      [object]
	 * [method]            [Post]
	 * [request]		   [BASE_URL/api/toll/addSemiAdmin]
	 * [response]		   []
	 */
	public function addSemiAdmin()
	{
		$_POST = $this->requestObject;
		if($this->login_role_id != 3)
		{
			$table = 'toll_center';
	        $where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
	        if(checkBelongsTo($table,$where_condition))
	        {
				$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
	                return;
	        }
		}
		else
		{
			$table = 'toll_staff';
	        $where_condition = array('ts_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
	        if(checkBelongsTo($table,$where_condition))
	        {
				$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
	                return;
	        }
		}
		if($this->login_role_id != 3)
		$this->form_validation->set_rules('tc_id', 'Toll Center Name', 'trim|required|callback_checkTollLocationExisting');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('roll_id', 'Roll', 'trim|required|xss_clean|numeric|max_length[1]');
		$this->form_validation->set_rules('email_id', 'Emai', 'trim|required|valid_email|max_length[100]|callback_checkEnailExisting');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|numeric|max_length[10]|callback_checkMobileExisting');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
		//$this->form_validation->set_rules('otp', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if($this->form_validation->run() == false)
		{
			$this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
		}
		else
		{
			if($_POST['roll_id'] == 2)
				$role_name = "Admin";
			else if($_POST['roll_id'] == 3)
				$role_name = "Semi Admin";
			else
				$role_name = "Toll Staff";
			$_POST['assigned_id']  = $this->login_user_id;
			$_POST['created_date'] = date("Y-m-d H:i:s");
			$last_inserted_id = $this->tollstaff->createSemiAdmin($_POST);
			if($last_inserted_id )
			{
				if($this->login_role_id == 1)
				{
					/*update Toll center as active*/
					$table_name = 'toll_center';
					$where_condition = array('tc_id'=>$_POST['tc_id']);
					$data = array('status_flag'=>0);
					updaterecord($table_name,$where_condition,$data);

					/*Update Previous Staff to toll center if any staff exist*/
					$table_name = 'toll_staff';
					$where_condition = array('tc_id'=>$_POST['tc_id'],'roll_id'=>4);
					$data = array('status_flag'=>0,'assigned_id'=>$last_inserted_id);
					updaterecord($table_name,$where_condition,$data);
				}

				$table = 'toll_staff';
				$where_condition = array('ts_id'=>$last_inserted_id );
				$data = getUserDetails($table,$where_condition);
				$to      = $data['email_id'];
                $subject = "Your Password for BMT Login";
                $data = array('email' => $to,'password'=>$data['password']);
                $message = $this->load->view('email/email_password',$data,true);
				sendPassword($message,$to,$subject);
				

                $this->rest->response(responseObject(SUCCESS_CODE,'','',success,"$role_name ".CREATEDONE));
               	return; 
			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
                return;
			}
		}
	}

	
	/**
	 * [checkTollLocationExisting description] [Check Toll location is already assigned or not]
	 * @return [type] [boolean]
	 */

	public function checkTollLocationExisting($location_id)
	{
		//echo "dd".$location_id; 
		$data = $this->toll->checksemi($location_id);
//exit;
		//$table_name = 'toll_center';
	   // $where_condition = array('tc_id'=>$location_id);
	  //  if(getStatus($table_name,$where_condition))
       if($data)
	    {
	    	return true;
	    }
	    else
	    {
	    	$this->form_validation->set_message('checkTollLocationExisting', "The Toll Location Is Already Assigned");
	    	return false;
	    }
	}

	/**
	 * [checkEnailExisting description] [Check Email is already exist or not]
	 * @return [type] [boolean]
	 */
	public function checkEnailExisting($email)
	{
		$table_name = 'toll_staff';
	    $where_condition = array('email_id'=>$email);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkEnailExisting', "The Email Is Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [checkMobileExisting description] [Check Email is already exist or not]
	 * @return [type] [boolean]
	 */
	public function checkMobileExisting($mobile)
	{
		$table_name = 'toll_staff';
	    $where_condition = array('mobile_no'=>$mobile);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkMobileExisting', "The Mobile Number Is Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [updateSemiAdmin description] [Update Semi admin]
	 * @return [type]      [object]
	 * [method]            [Post]
	 * [request]		   [BASE_URL/api/toll/addSemiAdmin]
	 * [response]		   []
	 */
	public function updateSemiAdmin()
	{
		$_POST = $this->requestObject;

        if($this->login_role_id != 3)
		{
			$table = 'toll_center';
			$where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
	        if(checkBelongsTo($table,$where_condition))
	        {
				$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
	                return;
	        }
		}
		else
		{
			$table = 'toll_staff';
	        $where_condition = array('ts_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
	        if(checkBelongsTo($table,$where_condition))
	        {
				$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
	                return;
	        }
		}
        $this->form_validation->set_rules('ts_id', 'Toll Staff Id', 'trim|required|max_length[20]');
       	if($this->login_role_id != 3)
        $this->form_validation->set_rules('tc_id', 'Toll Center Name', 'trim|required|callback_updatecheckTollLocationExisting');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('roll_id', 'Roll', 'trim|required|xss_clean|numeric|max_length[1]');
		$this->form_validation->set_rules('email_id', 'Emai', 'trim|required|valid_email|max_length[100]|callback_updatecheckEnailExisting');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|numeric|max_length[10]|callback_updatecheckMobileExisting');
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]');
		//$this->form_validation->set_rules('otp', 'Number Of Lanes From Bmt', 'trim|required|xss_clean|numeric');
		if($this->form_validation->run() == false)
		{
			$this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
		}
		else
		{
			if($_POST['roll_id'] == 2)
				$role_name = "Admin";
			else if($_POST['roll_id'] == 3)
				$role_name = "Semi Admin";
			else $role_name = "Toll Staff";
			$ts_id = $_POST['ts_id'];

			$table = 'toll_staff';
			$where_condition = array('ts_id'=>$ts_id);
			$user_previous_data = getUserDetails($table,$where_condition);
			$fla_email = 0;
			if($user_previous_data['email_id'] != $_POST['email_id'])
				$fla_email = 1;
			$flag_pwd = 0;
			unset($_POST['ts_id']);
			$table_name = 'toll_staff';
			$where_condition = array('ts_id'=>$ts_id);
			$data = $_POST;
			if($fla_email == 1)
			{
				$to      = $data['email_id'];
                $subject = "Your Password for BMT Login";
                $data_send = array('email' => $to,'password'=>$data['password']);
                $message = $this->load->view('email/email_password',$data_send,true);
				sendPassword($message,$to,$subject);
			}
			if(updaterecord($table_name,$where_condition,$data))
			{
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"$role_name ".UPDATEDONE));
               	return; 
			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
                return;
			}
		}
	}

	
	/**
	 * [updatecheckTollLocationExisting description] [Check Toll location is already assigned or not]
	 * @return [type] [boolean]
	 */

	public function updatecheckTollLocationExisting($location_id)
	{
		$table_name = 'toll_staff';
	    $where_condition = array('tc_id'=>$location_id,'ts_id !='=>$_POST['ts_id'],'roll_id'=>3,'status_flag'=>0);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckTollLocationExisting', "The Toll Location Is Already Assigned");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [updatecheckEnailExisting description] [Check Email is already exist or not]
	 * @return [type] [boolean]
	 */
	public function updatecheckEnailExisting($email)
	{
		$table_name = 'toll_staff';
	    $where_condition = array('email_id'=>$email,'ts_id !='=>$_POST['ts_id']);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckEnailExisting', "The Email Is Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	/**
	 * [updatecheckMobileExisting description] [Check Email is already exist or not]
	 * @return [type] [boolean]
	 */
	public function updatecheckMobileExisting($mobile)
	{
		$table_name = 'toll_staff';
	    $where_condition = array('mobile_no'=>$mobile,'ts_id !='=>$_POST['ts_id']);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckMobileExisting',"The Mobile Number Is Already Exist");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	public function listSemiAdmins()
	{
		$data = $this->tollstaff->listSemiAdmins($this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	public function listTollOperator()
	{
		$data = $this->tollstaff->listTollOperator($this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	public function getSpecificSemiadmindetails($user_id)
	{
		$table = 'toll_staff';
		$where_condition = array('assigned_id'=>$this->login_user_id,'ts_id'=>$user_id);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
		$data = $this->tollstaff->getSpecificSemiadmindetails($user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	public function activrOrInactiveAdmin($user_id,$status)
	{
		$table = 'toll_staff';
		$where_condition = array('assigned_id'=>$this->login_user_id,'ts_id'=>$user_id);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
            return; 
        }

        $table_name = 'toll_staff';
        $where_condition = array('ts_id'=>$user_id);
        $user_details = getUserDetails($table,$where_condition);
        $tc_id = $user_details['tc_id'];
        if($status == 0)
        {
	        $tc_id_of_user_id_status = $this->toll->getTcIdByUserid($user_id);
	       	if($tc_id_of_user_id_status == 0)
	        {
	        	$this->rest->response(responseObject(409,'The Toll Is Assigned To Some Other Else','',fail,''));
	            return;
	        }
	        /*$table_name = 'toll_center';
			$where_condition = array('tc_id'=>$tc_id);
			$data = array('status_flag'=>0);
			updaterecord($table_name,$where_condition,$data);*/

        	$table_name = 'toll_staff';
			$where_condition = array('ts_id'=>$user_id);
			$data = array('status_flag'=>0);
			if(updaterecord($table_name,$where_condition,$data))
			{
				$table_name = 'toll_staff';
				$where_condition = array('assigned_id'=>$user_id);
				$data = array('status_flag'=>0);
				updaterecord($table_name,$where_condition,$data);
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"Activated Successfully"));
	           	return; 
			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
	            return;
			}
        }
        else
        {
			/*$table_name = 'toll_center';
			$where_condition = array('tc_id'=>$tc_id);
			$data = array('status_flag'=>1);
			updaterecord($table_name,$where_condition,$data);*/

        	$table_name = 'toll_staff';
			$where_condition = array('ts_id'=>$user_id);
			$data = array('status_flag'=>1);
			//pd($data);
			if(updaterecord($table_name,$where_condition,$data))
			{
				$table_name = 'toll_staff';
				$where_condition = array('assigned_id'=>$user_id);
				$data = array('status_flag'=>1);
				updaterecord($table_name,$where_condition,$data);
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"Inactivated Successfully"));
	           	return; 
			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
	            return;
			}
        }
        
	}

	public function addBankDetails()
	{
		$_POST = $this->requestObject;
		$table = 'toll_center';
		$where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
		$this->form_validation->set_rules('tc_id', 'Toll Location', 'trim|required|callback_checkTcBankExisting');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('bank_address', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('type_of_account', 'Account Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ac_name', 'Account Name', 'trim|required');
		$this->form_validation->set_rules('ac_number', 'Account Number', 'trim|required|numeric|callback_checkTcBankNumberExisting');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|');
		if($this->form_validation->run() == false)
		{
			$this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
		}
		else
		{
			
			$_POST['created_date'] = date("Y-m-d H:i:s");
			$_POST['assigned_id'] = $this->login_user_id;
			if($this->bankdetails->createBankDetails($_POST))
			{
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Bank Details '.CREATEDONE));
               	return; 
			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
                return;
			}
		}
	}

	public function checkTcBankExisting($tc_id)
	{
		$table_name = 'bmt_bank_details';
	    $where_condition = array('tc_id'=>$tc_id);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkTcBankExisting', "Bank Details For Toll Location Is Already Existing");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}
	public function checkTcBankNumberExisting($acnum)
	{
		$table_name = 'bmt_bank_details';
	    $where_condition = array('ac_number'=>$acnum);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkTcBankNumberExisting', "Bank Number Is Already Assigned To Another Toll Location");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	public function updateBankDetails()
	{
		$_POST = $this->requestObject;
		$table = 'toll_center';
		$where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
        //pd($_POST);
		$this->form_validation->set_rules('tc_id', 'Toll Location', 'trim|required|callback_updatecheckTcBankExisting');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('bank_address', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('type_of_account', 'Account Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ac_name', 'Account Name', 'trim|required');
		$this->form_validation->set_rules('ac_number', 'Account Number', 'trim|required|callback_updatecheckTcBankNumberExisting');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|');
		if($this->form_validation->run() == false)
		{
			$this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
		}
		else
		{
			
			$table_name = 'bmt_bank_details';
			$where_condition = array('bank_id'=>$_POST['bank_id']);
			unset($_POST['bank_id']);
			unset($_POST['tc_id']);
			if(updaterecord($table_name,$where_condition,$_POST))
			{
				$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"Bank Details  ".UPDATEDONE));
               	return; 
			}
			else
			{
				$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
                return;
			}
		}
	}

	public function updatecheckTcBankExisting($tc_id)
	{
		/*pd($_POST);
		$table_name = 'bmt_bank_details';
	    $where_condition = array('tc_id'=>$tc_id);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckTcBankExisting', "Bank Details For Toll Location Is Already Existing");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }*/
	}
	public function updatecheckTcBankNumberExisting($acnum)
	{
		$table_name = 'bmt_bank_details';
	    $where_condition = array('ac_number'=>$acnum,'tc_id !='=>$_POST['tc_id']);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('updatecheckTcBankNumberExisting', "Bank Number Is Already Assigned To Another Toll Location");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
	}

	public function getALLBankRelatedTolls()
	{
		$data = $this->bankdetails->getBankDetails($this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
	}

	public function getSpecificBankDetails($tc_id)
	{
		$table = 'toll_center';
		$where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$tc_id);
        if(checkBelongsTo($table,$where_condition))
        {
        	$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
        $data = $this->bankdetails->getSpecificBankDetails($tc_id);
        $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function getVehicalTypes()
    {
    	$data = $this->toll->getVehicalTypes();
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function addTollCharges()
    {
    	$_POST = $this->requestObject;
		$table = 'toll_center';
		$where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
    	$this->form_validation->set_rules('tc_id', 'Toll Center Id', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('type_id', 'Vehical Type', 'trim|required|numeric|callback_checkTollChargesAdding|xss_clean');
		$this->form_validation->set_rules('one_way_charge', 'Last Name', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('two_way_charge', 'Account Type', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('multi_way_charge', 'Account Number', 'trim|required|numeric|xss_clean');
		if($this->form_validation->run() == false)
		{
			$this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
		}
		else
		{
    		$_POST['tcharge_created_date'] = date("Y-m-d H:i:s");
    		$_POST['assigned_id'] = $this->login_user_id;
    		if($this->chargesdetails->addTollCharges($_POST))
    		{
    			$this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Toll Charges '.CREATEDONE));
        		return;
    		}
    		else
    		{
    			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
    		}
    	}
    }

    public function checkTollChargesAdding($type_id)
    {
    	$table_name = 'toll_charge';
	    $where_condition = array('tc_id'=>$_POST['tc_id'],'type_id'=>$type_id);
	    if(checkValues($table_name,$where_condition))
	    {
	    	$this->form_validation->set_message('checkTollChargesAdding', "Toll Charges For That Vehical Type Already Assigned");
	    	return false;
	    }
	    else
	    {
	    	return true;
	    }
    }

    public function listTollChargesDEtails()
    {
		$data = $this->chargesdetails->getTollChargesDetails($this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function listAllBankRelatedTolls()
    {
    	$data = $this->chargesdetails->listAllBankRelatedTolls($this->login_user_id);
		$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function getSpecificTollCharges($tc_id=NULL,$vehical_type_id=NULL)
    {
    	$table = 'toll_center';
		$where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$tc_id);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
    	$data = $this->chargesdetails->getSpecificTollCharges($tc_id,$vehical_type_id);
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function updateTollCharges()
    {
    	$_POST = $this->requestObject;
    	$table = 'toll_center';
		$where_condition = array('assigned_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
                return;
        }
        $vehical_type =  $_POST['vehical_type'];
        $tc_id =  $_POST['tc_id'];
        unset($_POST['vehical_type']);
        unset($_POST['tc_id']);
        $table_name = 'toll_charge';
		$where_condition =array('tc_id'=>$tc_id,'type_id'=>$vehical_type);
		$data = $_POST;
		if(updaterecord($table_name,$where_condition,$data))
		{
			$this->rest->response(responseObject(SUCCESS_CODE,'','',success,"Toll Charges ".UPDATEDONE));
           	return; 
		}
		else
		{
			$this->rest->response(responseObject(SERVERERROR_CODE,SERVER_ERROR,'',fail,''));
            return;
		}
        
    }
    
    public function superAdminView()
    {
    	$data = $this->toll->superAdminView($this->login_user_id);
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function bankTypes()
    {
    	$data= $this->bankdetails->accountTypes();
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function getLoginUserTollName()
    {
    	$data = $this->toll->getLoginUserTollName($this->login_user_id);
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function getLaneDetails()
    {
    	$data = $this->toll->getLaneDetails($this->login_user_id);
    	$data['maped_lane_details_from'] = $this->lanes->getMappedLanesFrom($this->login_user_id);
    	$data['maped_lane_details_to'] = $this->lanes->getMappedLanesTo($this->login_user_id);
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function updateLaneDetails()
    {
    	$_POST = $this->requestObject;
    	$table = 'toll_staff';
		$where_condition = array('ts_id'=>$this->login_user_id,'tc_id'=>$_POST['tc_id']);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
            return;
        }
        $table_name = 'bmt_lanes';
        $where_condition = array('tc_id'=>$_POST['tc_id']);
        $data = array('status_flag'=>1);
        updaterecord($table_name,$where_condition,$data);
        if(isset($_POST['from_lanes']) && !empty($_POST['from_lanes']))
        {
        	foreach ($_POST['from_lanes'] as $key => $value) {
        		$table_name = 'bmt_lanes';
		        $where_condition = array('tc_id'=>$_POST['tc_id'],'lane_number'=>$value,'way_type'=>1);
		        $data = array('status_flag'=>0);
		        updaterecord($table_name,$where_condition,$data);
        	}
        }
        if(isset($_POST['to_lanes']) && !empty($_POST['to_lanes']))
        {
        	foreach ($_POST['to_lanes'] as $key => $value) {
        		$table_name = 'bmt_lanes';
		        $where_condition = array('tc_id'=>$_POST['tc_id'],'lane_number'=>$value,'way_type'=>2);
		        $data = array('status_flag'=>0);
		        updaterecord($table_name,$where_condition,$data);
        	}
        }

        $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Lanes '.UPDATEDONE));
        return;
        
    }

    public function activeOrInactiveOperator($user_id)
    {
    	$table = 'toll_staff';
		$where_condition = array('assigned_id'=>$this->login_user_id,'ts_id'=>$user_id);
        if(checkBelongsTo($table,$where_condition))
        {
			$this->rest->response(responseObject(UNAUTHORIZED_CODE,UNAUTHORIZED,'',fail,''));
            return;
        }
    	$table = 'toll_staff';
    	$where_condition = array('ts_id'=>$user_id);
    	$user_status = getStatus($table,$where_condition);
    	if($user_status == 0)
    	{
    		$flag = 1;
    		$msg = "Operator Is Inactivated";
    	}
    	else
    	{
    		$flag = 0;
    		$msg="Oprator Is Activated";
    	}
    	$table = 'toll_staff';
		$where_condition = array('assigned_id'=>$this->login_user_id,'ts_id'=>$user_id);
		$data = array('status_flag'=>$flag);
		updaterecord($table,$where_condition,$data);
		$this->rest->response(responseObject(SUCCESS_CODE,'','',success,$msg));
        return;
    }

    public function tollNamesForCharges()
    {
    	$_POST = $this->requestObject;
    	$data = $this->toll->tollNameForCharges($_POST['tc_location'],$this->login_user_id);
    	$this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''));
        return;
    }

    public function changePassword()
    {
      $_POST = $this->requestObject;
      $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|max_length[30]');
      $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|max_length[30]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
      $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|max_length[30]|callback_checkToBeconMinarId|callback_checkBeconMinarId');
      if($this->form_validation->run() == false)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
              return;
      }
      if($_POST['oldpassword'] != $this->old_password)
      {
        $this->rest->response(responseObject(CONFLICT_CODE,'Incorrect Old Password','',fail,'Incorrect Old Password'));
            return;
      }
      if($_POST['newpassword'] != $_POST['confirmpassword'])
      {
        $this->rest->response(responseObject(CONFLICT_CODE,'New Password And Confirm Password Not Matched','',fail,'New Password And Confirm Password Not Matched'));
            return;
      }
      $table_name = 'toll_staff';
      $where_condition =array('ts_id'=>$this->login_user_id);
      $data = array('password'=>$_POST['newpassword']);
      updaterecord($table_name,$where_condition,$data);
      $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Password Changed Successfully'));
        return;
    }

    public function getUserSpecificDetails()
    {
    	$this->rest->response(responseObject(SUCCESS_CODE,'',getLoginUserId(),success,'Password Changed Successfully'));
        return;
    }

}

/* End of file toll.php */
/* Location: ./application/controllers/api/toll.php */
