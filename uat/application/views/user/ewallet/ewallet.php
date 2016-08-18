
<div class="container-fluid inner-page-body">
  <div class="row">             
    <div class="col-md-9 right_menu">
        
        <form name="imageUpload" class="form-horizontal" style="width:80%; margin:0 auto;" method="post" action="" method="post" id="multiform" enctype="multipart/form-data">          
           <div class="form-group">

          <label for="inputPassword3" class="col-sm-3 control-label">Current Balance</label>
          <div class="col-sm-9">
         <button class="btn btn-warning right_menu-button cmn-full-w-btn" style="background:none;width:20% !important;padding: 0 !important;" type="button"> Rs. 100</button>
          </div>
        </div>
            
             <div class="form-group text-right">
             <div id="btnid">
            <button onClick="getamt();" style="margin-right: 3%; margin-left: 245px;float:left;" type="button" class="btn save_changes common-btn-pass" name="submit">Trigger</button>
            </div>
        </div>
            
            </form>
 <script type="text/javascript">
     function getamt(){
         alert("Amount Rs.30 will be debited from User Wallet");
     }
     </script>
     
<!--      <div class="row">
      

          <?php

              //echo "timesmoney";
              ini_set("display_errors","on");

              //requestparam Testing - TOML 
              $requestParameter  ="200904281000001|DOM|IND|INR|10|unique_10005|others|http://54.255.128.130/paymentSuccess.php|http://54.255.128.130/paymentFailure.php|TOML";
              //echo 'Requestparameter:- '.$requestParameter.'<br/>';
              //Billingdetails
              $billingDtls ="TestUser|Mumbai|Mumbai|Maharashtra|400001|IN|91|022|28000000|9820000000|testuser@gmail.com |test transaction for direcpay";

              //Shippingdetails
              $shippingDtls ="TestUser|Mumbai|Mumbai|Maharashtra|400234|IN|91|022|28000000|9920000000";

              //encryption
              $key = "qcAHa6tt8s0l5NN7UWPVAQ==";

              $aes = new CryptAES();
              $aes->set_key(base64_decode($key));
              $aes->require_pkcs5();

              $requestParameter = $aes->encrypt($requestParameter);
              $billingDtls  = $aes->encrypt($billingDtls);
              $shippingDtls  = $aes->encrypt($shippingDtls);
              //echo 'Encrypted Requestparameter:- '.$requestParameter;
              //echo "<br/>Action URL:https://test.timesofmoney.com/direcpay/secure/dpMerchantPayment.jsp"; 


              ?>

              <form name="ecom"  method="post" action="https://test.timesofmoney.com/direcpay/secure/dpMerchantPayment.jsp" onSubmit="encodeTxnRequest();">
              <input type="hidden" name="requestparameter" value="<?php echo $requestParameter; ?>">
              <input type="hidden" name="billingDtls" value="<?php echo $billingDtls; ?>">
              <input type="hidden" name="shippingDtls" value="<?php echo $shippingDtls; ?>">
              <input type="hidden" name="merchantId" value ="200904281000001"/>
              <input class="btn btn-success common-btn-pass" type="submit" name="submit" value="Trigger" style="margin-left: 44px;">
              </form>




      </div>-->
    </div>
      <br>
  </div>


</div>

<!--
<script src="dpEncodeRequest.js"></script> 
<script> function encodeTxnRequest() {  
    document.ecom.requestparameter.value = encodeValue(document.ecom.requestparameter.value); 
    document.ecom.submit(); 
    } 
</script>-->