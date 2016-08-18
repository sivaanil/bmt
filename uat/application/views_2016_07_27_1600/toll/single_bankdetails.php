<?php 

//$data = @$toll_center_detal->response->TollChargeDetails;

//echo "<pre>";print_r($bank_types);exit;
?>
<div class="modal-header">
  <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="update_semiadmin_single" id="update_semiadmin_single">
  
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
        if(isset($bank_types) && !empty($bank_types))
        {
          foreach ($bank_types as $key => $value) 
          {
            ?>
            <option value="<?php echo $value->id;?>"<?php if(isset($tollbank_single->type_of_account) && $tollbank_single->type_of_account == $value->id) echo "selected";?>><?php echo $value->ac_type?></option>
            <?PHP
           
          }
        }
        else
        {
          ?>
          <option value="">NO Bank Types</option>
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
  
  <div class="modal-footer">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_edit">Cancel</button>
    <button type="button" id="save_bankdetails_single" class="btn save_changes pull-right common-btn-pass" style="padding:8px 20px; font-size:12px; font-weight:normal;">Submit</button>
  </div>
  
 </form>
</div>

<script type="text/javascript">
  $("#close_id").click(function(){
    location.reload();
  });
  $("#cancel_single_edit").click(function(){
    location.reload();
  });
  function getcentername_single() {
    $("#tcn_single").val('');
    var location_id = $("#toll_center_loaction_single").val();
    $("#toll_center_name_single").html('');
    if(location_id != '')
    {
      $.ajax({
            "url":"<?php echo base_url('tollcenter/get_single_bank');?>",
            "type" : "POST",
            "data" :({'location_id':location_id}),
            success:function(response){
              $("#toll_center_name_single").append(response);
            }
           });
    }
    else{
      $("#toll_center_name_single").append('<option value="">No Toll Center Names</option>');
    }

    // body...
  }

  function gettcn_single(){
    $("#tcn_single").val('');
    var toll_center_name = $("#toll_center_name_single").val();
    $.ajax({
            "url":"<?php echo base_url('tollcenter/gettcn');?>",
            "type" : "POST",
            "data" :({'toll_center_name':toll_center_name}),
            success:function(response){
              var obj = $.parseJSON(response);
              if( obj.statuscode == 200 )
              {
               $("#tcn_single").val(obj.response.tcn_no);
              }
              else{
                $("#error_message").text(obj.error[0]);
              }
            }
          });
  }  
  
  $("#save_bankdetails_single").click(function(){
      
    $('#update_semiadmin_single').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:30},
        bank_name:{required: true,minlength:1,maxlength:30},
        bank_address:{required: true,minlength:1,maxlength:50},
        account_type:{required: true},
        account_num:{required: true,minlength:1,maxlength:20},
        account_name:{required: true,minlength:1,maxlength:20},
        ifsc_code:{required: true,minlength:1,maxlength:20},
        tcn:{required: true},
      },
      messages:{
               bank_name:{
                    required:"Please Enter Bank Name",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               bank_address:{
                    required:"Please Enter Bank Address",
                    maxlength:"Enter Maximum 50 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               account_type:{
                    required:"Please Select Acount Type",
               },
               account_num:{
                    required:"Please Enter Account Number",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               account_name:{
                    required:"Please Enter Account Name",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               ifsc_code:{
                    required:"Please Enter IFSC Code",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               tcn:{
                    required:"Please Enter Toll Center Number",
                    maxlength:"Enter Maximum 19 Characters",
               },
              
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if($('#update_semiadmin_single').valid()){
      //alert($("#toll_id").val());return;
        var toll_location = $("#toll_location").val();
        $.ajax({
          "url"  : "<?php echo base_url('tollcenter/updatebankdetails');?>",
          "type" : "POST",
          "data" : ({'tcn':$("#tcn_single").val(),'bank_id':$("#bank_id").val(),'bank_name':$("#bank_name_single").val(),'bank_address':$("#bank_address_single").val(),'type_of_account':$("#account_type_single").val(),'ac_number':$("#account_num_single").val(),'ifsc_code':$("#ifsc_code_single").val(),'ac_name':$("#account_name_single").val()}),
          success:function(response){
            //console.log(response);return false;
              var data = $.parseJSON(response);
              console.log(data.statuscode);
              if(data.statuscode == 200)
              {
               //alertify.success(data.successMessage);
               $('#exampleModal').modal('hide');
               alertify.success(data.successMessage);
              }
              else{
                 //$("#fail").text(data.error);
                alertify.error(data.error);
              }
              // var set_make = "<?php echo @$vehicle_details->response->vehicleDetails->vehiclemake;?>";
  
          }
        });
    }
});
    
</script>