
<div class="container-fluid inner-page-body">
  <div class="row">             
    <div class="col-md-9 right_menu">
       
        <?php   //echo "<pre>"; print_r($info);exit;  
        if(isset($info)){
           
        if(!empty($info->inner)){
             $inner=$info->inner;
             $orderid=$inner->transaction_id;
        ?>
        <div class="col-sm-9" style="  font-size: 15px; padding: 6px 0; text-align: center;"><?php echo $info->msg;?></div>
        <form method="post" name="customerData" action="<?php echo base_url('account/paynow');?>" class="form-horizontal" style="width:80%; margin:0 auto;">
		<input type="hidden" name="tid" id="tid" readonly />
                <input type="hidden" name="merchant_id" value="85930"/>
                <input type="hidden" name="order_id" value="<?php echo $orderid;?>"/>
                <input type="hidden" name="amount" value="<?php echo $inner->total_amount;?>"/>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Your Charge</label>
          <div class="col-sm-9">
         <button class="btn btn-warning right_menu-button cmn-full-w-btn" style="background:none;width:20% !important;padding: 0 !important;color:#000 !important;" type="button"> Rs. <?php echo $inner->total_amount;?></button>
          </div>
        </div>
                <input type="hidden" name="currency" value="INR"/>
                <input type="hidden" name="redirect_url" value="<?php echo base_url('account/response');?>"/>
                <input type="hidden" name="cancel_url" value="<?php echo base_url('account/response');?>"/>
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
                <button style="margin-right: 3%; margin-left: 245px;float:left;" class="btn save_changes common-btn-pass" TYPE="submit">PayNow</button>
          </div>
        </div>
	      </form>
        <?php }else{?>
        <div class="col-sm-9" style="  font-size: 15px; padding: 6px 0; text-align: center;"><?php echo $info->msg;?></div>
        <?php }}?>
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
  
    </div>
      <br>
  </div>
</div>
