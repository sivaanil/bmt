<html>
<head>
<title> Custom Form Kit </title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 
//echo "ggg";exit;
	error_reporting(0);
 $merchant_id='85930';  // Merchant id(also User_Id) 
 $amount='10.00';            // your script should substitute the amount here                        in the quotes provided here
 $order_id='123654789';        //your script should substitute the order   description here in the quotes provided here
 $url="http://bookmytoll.com/payment/my/ccavResponseHandler.php";         //your redirect URL where your customer will be redirected after authorisation from CCAvenue
 $billing_cust_name='Charli';
 $billing_cust_address='Room no 1101, near Railway station Ambad';
 $billing_cust_country='India';
 $billing_cust_state='MH';
 $billing_city='Indore';
 $billing_zip='425001';
 $billing_cust_tel='9999999999';
 $billing_cust_email='test@test.com';
 $delivery_cust_name='Chaplin';
 $delivery_cust_address='room no.701 near bus stand';
 $delivery_cust_country='India';
 $delivery_cust_state='Andhra';
 $delivery_city='Hyderabad';
 $delivery_zip='425001';
 $delivery_cust_tel='5555555555';
 $delivery_cust_notes='notes';

$merchant_data=    'Merchant_Id='.$merchant_id.'&Amount='.$amount.'&Order_Id='.$order_id.'&Redirect_Url='.$url.'&billing_cust_name='.$billing_cust_name.'
&billing_cust_address='.$billing_cust_address.'&billing_cust_country='.$billing_cust_country.'&billing_cust_state='.$billing_cust_state.'&billing_cust_city='.$billing_city.'
&billing_zip_code='.$billing_zip.'&billing_cust_tel='.$billing_cust_tel.'&billing_cust_email='.$billing_cust_email.'&delivery_cust_name='.$delivery_cust_name.'
&delivery_cust_address='.$delivery_cust_address.'&delivery_cust_country='.$delivery_cust_country.'&delivery_cust_state='.$delivery_cust_state.'
&delivery_cust_city='.$delivery_city.'&delivery_zip_code='.$delivery_zip.'&delivery_cust_tel='.$delivery_cust_tel.'&billing_cust_notes='.$delivery_cust_notes;


	//$merchant_data='85930';
	$working_key='AVIY08CL00BR59YIRB';//Shared by CCAVENUES
	$access_code='989262C50960DD181D2BDAEFB9BDA993';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.urlencode($value).'&';
	}

 $encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
        //exit;

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 

<input type="hidden" name="encRequest" value="<?php echo $encrypted_data; ?>">
<input type="hidden" name="access_code" value="<?php echo $access_code; ?>">

</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

