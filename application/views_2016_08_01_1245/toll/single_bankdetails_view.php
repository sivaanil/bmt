<?php 

//$data = @$toll_center_detal->response->TollChargeDetails;

//echo "<pre>";print_r($tollbank_single->type_of_account);exit;
?>
<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">View</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">

  
  <input type="hidden" class="form-control" id="tcn_single" value="<?php echo @$tollbank_single->tc_id?>" name="tcn" placeholder="TCN" >
   <input type="hidden" class="form-control" value="<?php echo @$tollbank_single->bank_id?>" name="bank_id" id="bank_id" placeholder="TCN" >
   <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="account_name_single" name="account_name" value="<?php echo @$tollbank_single->ac_name?>" placeholder="Account Name">
    </div>
  </div>
  <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="bank_name_single" name="bank_name" value="<?php echo @$tollbank_single->bank_name?>" placeholder="Bank Name">
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="bank_address_single" name="bank_address" value="<?php echo @$tollbank_single->bank_address?>" placeholder="Bank Address">
  </div>
  <div class="form-group">
     <select style="color:#0C0C0C;" class="form-control" style="margin-top:0; width:100%;" id="account_type_single" class="form-control" name="account_type">
      <?php
        if(isset($tollbank_single->type_of_account) && $tollbank_single->type_of_account ==1)
        {
          ?>
          <option >Saving</option>
          <?php
        }
        else
        {
          ?>
          <option >Current</option>>
          <?php
        }
      ?>
    </select>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="account_num_single" name="account_num" value="<?php echo @$tollbank_single->ac_number?>" placeholder="Account No">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="ifsc_code_single" name="ifsc_code" value="<?php echo @$tollbank_single->ifsc_code?>" placeholder="IFSC Code (Valid xx digit number)">
  </div>
 <div class="form-group">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_view">Cancel</button>
    
  </div>
</div>
<script type="text/javascript">
 
  $("#cancel_single_view").click(function(){
    location.reload();
  });
</script>