<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {



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
            $this->rest->header("Authtoken",$this->auth_token);
            $response = $this->rest->get("user/getTollcenter");
             //echo '<pre>';    print_r($response);exit;
            //echo $response->response;
          //  $this->rest->debug();exit;

        
		$views = array('user/account/account');
		    if($response->response==4){
            	$data = array('views'=>$views);
            	
            }else{
            	$data = array('views'=>$views,"tolls"=>$response->response);
            }
		$this->load->view('user/template/template',$data);

		//$this->load->view('user/ewallet/ewallet');
	}
	public function getwaytypes(){
		//echo "<pre>"; print_r($_POST);

		$this->rest->header("Authtoken",$this->auth_token);
            
            $this->requestobj['tc_id']  = $this->input->post('tcid');

            $_POST = $this->requestobj;
            $jsonObject = $this->bmt->user_params($_POST);
           // print_r($jsonObject);
            $response = $this->rest->post('user/getWayTypes',$jsonObject);
           // echo "<pre>"; print_r($response->response[0]);exit;
            $html='';
                $html.='<select id="way_type" name="way_type">';
               
                if($response->statuscode == 200)
		{ $val=$response->response[0];
			 $html .='<option value="">Select Way</option>';
             
                $html .='<option value="1"> '.$val->from_way_location.' - '.$val->to_way_location.'</option>';    
                $html .='<option value="2">'.$val->to_way_location.' - '.$val->from_way_location.'</option>';    
                
            }else{
            $html .='<option value="">No ways for this tollcenter</option>';   	
            }
                $html.='';
                echo $html;
	}
        public function payment(){
          //  echo "<pre>"; print_r($_POST);
            if(isset($_POST['tc_id'])){
            $this->rest->header("Authtoken",$this->auth_token);
            
            $this->requestobj['tc_id']  = $this->input->post('tc_id');
            $this->requestobj['way_type']  = $this->input->post('way_type');

            $_POST = $this->requestobj;
            $jsonObject = $this->bmt->user_params($_POST);
           // print_r($jsonObject);
            $response = $this->rest->post('user/getLanesByToll',$jsonObject);
            //$this->rest->debug();exit;
            
                $views = array('user/account/payment');
		$data = array('views'=>$views,"info"=>$response->response);
		$this->load->view('user/template/template',$data);
            }
            else{
                redirect('account');
            }
        }
        public function paynow(){
           //echo "<pre>";print_r($_POST);exit;
            if(isset($_POST['amount'])){
        $merchant_data='';
	$working_key='989262C50960DD181D2BDAEFB9BDA993';//Shared by test CCAVENUES
	$access_code='AVIY08CL00BR59YIRB';//Shared by test CCAVENUES
        
        foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	//  echo "<pre>";print_r($encrypted_data);exit;

	$production_url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
        
                $views = array('user/account/paynow');
		$data = array('views'=>$views,"production_url"=>$production_url);
		$this->load->view('user/template/template',$data);
            }else{
                redirect('account');
            }
        
        }
        public function response(){
           $workingKey='989262C50960DD181D2BDAEFB9BDA993';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	//echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{

		//echo "<br><br>";
$order=explode('=',$decryptValues[0]);
$orderid=$order[1];
$tracking=explode('=',$decryptValues[1]);
$trackingid=$tracking[1];
$orderstatus=explode('=',$decryptValues[3]);
$status=$orderstatus[1];
$amount=explode('=',$decryptValues[10]);
$amt=$amount[1];

            $this->rest->header("Authtoken",$this->auth_token);
            
            $this->requestobj['order_id']  = $orderid;
            $this->requestobj['tracking_id']  = $trackingid;
            $this->requestobj['order_status']  = $status;
            $this->requestobj['amount']  = $amt;

            $_POST = $this->requestobj;
            $jsonObject = $this->bmt->user_params($_POST);
            //print_r($jsonObject);
            $response = $this->rest->post('user/storeOrder',$jsonObject);
           // $this->rest->debug();exit;
		if($response->statuscode == 200)
			{
                         // print_r($response->response->UserInfo);exit;
			$msg= "<br>Thank you. Your transaction is successful.";
                                
			}
			else
			{  //print_r($response);exit;
				$msg = @$response->error[0];
				
			}

		
	}
	else if($order_status==="Aborted")
	{
		$msg= "<br>Thank you.We will keep you posted regarding the status of your transaction through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		$msg= "<br>Thank you.However,the transaction has been declined.";
	}
	else
	{
		$msg= "<br>Security Error. Illegal access detected";
	
	}

	    $views = array('user/account/response');
		$data = array('views'=>$views,"response"=>$msg);
		$this->load->view('user/template/template',$data);

//	echo "<table cellspacing=4 cellpadding=4>";
//	for($i = 0; $i < $dataSize; $i++) 
//	{
//		$information=explode('=',$decryptValues[$i]);
//	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
//	}
//
//	echo "</table><br>";
//	echo "</center>"; 
        }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
