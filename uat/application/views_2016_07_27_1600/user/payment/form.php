<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed|Cuprum' rel='stylesheet' type='text/css'>

<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
<style>
body{
	font-family: 'Cuprum', sans-serif !important;
    zoom:100% important;
}
.form-group {
    display: inherit;
    float: left;
    text-align: center;
    width: 100%;
}
.form-group label{
float: left;
    width: 100%;
}
.inputcls{
    float: left;
    width: 100%;
}
</style>
</head>

<body>
<div style="text-align:center">
<form method="post" name="customerData" action="<?php echo base_url('payment/paynow');?>" class="form-horizontal" style="width:80%; margin:0 auto;">
		<input type="hidden" name="tid" id="tid" readonly />
                <input type="hidden" name="merchant_id" value="85930"/>
                <input type="hidden" name="order_id" value="<?php if(isset($transaction_id))echo $transaction_id;?>"/>
                <input type="hidden" name="amount" value="<?php if(isset($total_amount))echo $total_amount;?>"/>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label" style="font-size:20px;">Your Charge</label>
          <div class="inputcls">
         <button class="btn btn-warning right_menu-button cmn-full-w-btn" style="background:#ffa611;width:100% !important; height:40px; padding: 0 !important; border:0; margin-top:10px; margin-bottom:10px; font-size:20px;" type="button"> Rs. <?php if(isset($total_amount))echo $total_amount;?></button>
          </div>
        </div>
                <input type="hidden" name="currency" value="INR"/>
                <input type="hidden" name="redirect_url" value="<?php echo base_url('payment/response');?>"/>
                <input type="hidden" name="cancel_url" value="<?php echo base_url('payment/response');?>"/>
                <input type="hidden" name="language" value="EN"/>
                <input type="hidden" name="billing_name" value="Charli"/>
                <input type="hidden" name="billing_address" value="Room no 1101, near Railway station Ambad"/>
                <input type="hidden" name="billing_city" value="Indore"/>
                <input type="hidden" name="billing_state" value="MP"/>
                <input type="hidden" name="billing_zip" value="425001"/>
                <input type="hidden" name="billing_country" value="India"/>
                <input type="hidden" name="billing_tel" value="9876543210"/>
                <input type="hidden" name="billing_email" value="test@test.com"/>
                <input type="hidden" name="delivery_name" value="Chaplin"/>
                <input type="hidden" name="delivery_address" value="room no.701 near bus stand"/>
                <input type="hidden" name="delivery_city" value="Hyderabad"/>
                <input type="hidden" name="delivery_state" value="Andhra"/>
                <input type="hidden" name="delivery_zip" value="425001"/>
                <input type="hidden" name="delivery_country" value="India"/>
                <input type="hidden" name="delivery_tel" value="9876543210"/>
                <input type="hidden" name="merchant_param1" value="additional Info."/>
                <input type="hidden" name="merchant_param2" value="additional Info."/>
                <input type="hidden" name="merchant_param3" value="additional Info."/>
                <input type="hidden" name="merchant_param4" value="additional Info."/>
                <input type="hidden" name="merchant_param5" value="additional Info."/>
                <input type="hidden" name="promo_code" value=""/>
                <input type="hidden" name="customer_identifier" value=""/>
                <input type="hidden" name="integration_type" value="iframe_normal"/>
         <div class="form-group text-right">
          <div id="btnid">
                <button style="width: 100%; background: #000;
  color: #fff;
  padding: 10px;
  margin-bottom: 10px; font-size:20px;" class="btn save_changes common-btn-pass" TYPE="submit">PayNow</button>
          </div>
        </div>
	      </form>
       </div>

	</body>
</html>

