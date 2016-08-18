<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
		//$this->load->library('CryptAES');
       $this->load->library('session');
		
	}
	
	public function index()
	{
		//echo "hi";exit;
		
		$data['total_amount']=$_GET['total_amount'];
		$data['transaction_id']=$_GET['transaction_id'];
        $data['user_id']=$_GET['user_id'];
        if(isset($_GET['lane_number'])){
			$data['lane_number']=$_GET['lane_number'];
			$laneno=$_GET['lane_number'];
			$this->session->set_userdata('lane_number', $laneno);
		}
        
        $data['Authtoken']=$_GET['Authtoken'];
        $auth=$_GET['Authtoken'];
        
       $this->session->set_userdata('Authtoken', $auth);
    	$this->load->view('user/payment/form',$data);
	}
	 public function paynow(){
           // echo "<pre>";print_r($_POST);exit;
            if(isset($_POST['amount'])){
        $merchant_data='';
	$working_key='989262C50960DD181D2BDAEFB9BDA993';//Shared by test CCAVENUES
	$access_code='AVIY08CL00BR59YIRB';//Shared by test CCAVENUES
	$currency = 'INR';
        
        foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	// echo "<pre>";print_r($encrypted_data);exit;

	$production_url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
        
$data['production_url']=$production_url;
$this->load->view('user/payment/paynow',$data);

                
            }else{
            	redirect('payment');
            }
        
        }//end paynow
        public function response(){
    $workingKey='989262C50960DD181D2BDAEFB9BDA993';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status=$successMsg="";
	$msg = "";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
$all=$this->session->all_userdata();
$Authtoken=$all['Authtoken'];
if(isset($all['lane_number']) && $all['lane_number'] != ''){
	$laneno=$all['lane_number'];
	$successMsg = "<br>Thank you. Your transaction is successful. Please go through the lane Nember <strong>".$laneno."</strong>";
	}else{
	$successMsg = "<br>Thank you. Your transaction is successful.";
	}

	echo "<center>";
//echo "<pre>"; print_r($all);
//echo "<pre>"; print_r($decryptValues);exit;
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{
			$order=explode('=',$decryptValues[0]);
			$orderid=$order[1];
			$tracking=explode('=',$decryptValues[1]);
			$trackingid=$tracking[1];
			$orderstatus=explode('=',$decryptValues[3]);
			$status=$orderstatus[1];
			$amount=explode('=',$decryptValues[10]);
			$amt=$amount[1];

            $this->rest->header("Authtoken",$Authtoken);
            
            $this->requestobj['order_id']  = $orderid;
            $this->requestobj['tracking_id']  = $trackingid;
            $this->requestobj['order_status']  = $status;
            $this->requestobj['amount']  = $amt;

            $_POST = $this->requestobj;
            $jsonObject = $this->bmt->user_params($_POST);
			//echo $jsonObject; exit;
            $response = $this->rest->post('user/storeOrder',$jsonObject);
            //~ echo '<pre>';
            //~ print_r($response);
            //~ exit;
           
			$msg= $successMsg;
		
		
	}
	else if($order_status==="Aborted")
	{
		$msg= "<br>Thank you. We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		$msg= "<br>Thank you.However,the transaction has been declined.";
	}
	else
	{
		$msg= "<br>Security Error. Illegal access detected";
	
	}
	echo $msg; exit;
}


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
