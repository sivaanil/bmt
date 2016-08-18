<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php');?>
<?php 
	error_reporting(0);
	
	$merchant_data='';
	$working_key='989262C50960DD181D2BDAEFB9BDA993';//Shared by CCAVENUES
	$access_code='AVIY08CL00BR59YIRB';//Shared by CCAVENUES
	$merchant_id= 85930;
	$_POST['merchant_id'] = $merchant_id;
	$_POST['order_id'] = 'bmt1234';
	$_POST['currency'] = 'INR';
	$_POST['amount'] = 100;
	$_POST['redirect_url'] = 'http://bookmytoll.com/payment/ccavResponseHandler.php';
	$_POST['cancel_url'] = 'http://bookmytoll.com/payment/ccavResponseHandler.php';
	$_POST['language'] = 'en';
	$_POST['billing_name'] = 'Lokesh';
	$_POST['billing_email'] = 'lokesht@tayatech.com';

	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	//echo $encrypted_data;exit;

?>
<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 

<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
//echo "<input type=hidden name=merchant_id value=$merchant_id>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

