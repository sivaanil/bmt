<?php //echo "<pre>"; print_r($bank_list);exit;?>
<div class="col-md-9 right_menu">
 <?php //if(isset($refunds)){
//echo "<pre>"; print_r($refunds);
  ?>
 
                   <h1 style="font-size:22px; font-weight:normal; margin-top:9px;margin-left:23px;">Refund Transactions</h1> 
                   
<!-- <div style="font-size:12px;color:#339900;font-weight: bold;text-transform: capitalize;"><?php if($this->session->flashdata('wbmsg')){echo $this->session->flashdata('wbmsg');}?></div>                  -->
                   
                   <table class="table" style="width:95%; margin:0 auto; border: 1px #DDD solid; margin-bottom:10px;">
      <thead>
      
        <tr>
          <th>S.No</th>
          <th>User Id</th>
          <th>Vehicle No</th>
          <th>Type</th>
          <th>Amount</th>
          <th>Paid</th>
          <th>Pass</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody id="ajaxsus">
          <?php 
         // echo "<pre>"; print_r($webinfo);exit;
          if(isset($refunds) && !empty($refunds)){
          $j=1;
          foreach($refunds as $info){
             
             $tcid=$this->encrypt->encode_my($info->tc_id); 
             $tcname=$this->encrypt->encode_my($info->tc_name); 
             $uid=$this->encrypt->encode_my($info->user_id); 
             $vid=$this->encrypt->encode_my($info->vehicle_id);

              $vno=$this->encrypt->encode_my($info->vehicle_no);

             $email=$this->encrypt->encode_my($info->email_id);
             $mb=$this->encrypt->encode_my($info->mobile_no);
             $toll=$this->encrypt->encode_my($info->toll_charge);
             $bmt=$this->encrypt->encode_my($info->bmt_charge);
             $tot=$this->encrypt->encode_my($info->total_amount);

             $psts=$this->encrypt->encode_my($info->passing_status);
             $paid=$this->encrypt->encode_my($info->paid_status);
             $deviceid=$info->mobile_device_id;
             if(is_null($deviceid)){
                 $regtype=0; 
             }else{
                 $regtype=$deviceid;  
             }
              ?>
          <?php if($info->paid_status==1){$var= "false";}else{$var= "true";}?>
        <tr>
          <th scope="row"><?php echo $j;?></th>
          <td><?php echo $info->user_id;?></td>
          <td><?php echo $info->vehicle_no;?></td>
          <td><?php echo $info->type_name;?></td>
          <td><?php echo $info->total_amount;?></td>
          
          <!--
          <td>
              <input type="button" id="chanrge" name="charge<?php echo $j;?>"  
              onclick="getCharge('<?php echo $info->email_id;?>',<?php echo $info->tc_id;?>,<?php echo $info->user_id;?>,<?php echo $info->type_id;?>,
              <?php echo $info->make_id;?>,<?php echo $info->model_id;?>,<?php echo $info->vehicle_id;?>,'<?php echo $info->vehicle_no;?>',
              <?php echo $info->one_way_charge;?>,<?php echo $info->two_way_charge;?>,<?php echo $info->paid_status;?>,<?php echo $info->passing_status;?>,
                          '<?php echo $regtype;?>');" value="Charge" class="btn btn-success right_menu-button-small common-btn-pass"/>
          </td>-->
          <td><span class="common-btn-pass"><?php if($info->paid_status==1){echo "Yes";}else{echo "No";}?></span></td>
<td><span class="common-btn-pass"><?php if($info->passing_status==1){echo "Yes";}else{echo "No";}?></span></td>
    <td><?php echo $info->transaction_date;?></td>      
        </tr>
          <?php $j++;}}else{
            echo "<tr><td colspan='7'>No Refund Vehicles Found</td></tr>";
            }?>
        
        
        
        
      </tbody>
    </table> 
              

    <?php //}?>
  <div class="row text-center">
    <div class="col-md-12">
      <!-- <button type="button" class="btn btn-primary common-btn-small">Add</button> -->
      <!-- <button type="button" class="btn btn-success common-btn-pass">Edit</button>
      <button type="button" class="btn btn-danger common-btn-pass">Delete</button> -->
    </div>
  </div>

  
                   
</div>

<script>
function edit_bankdetails(id)
  {
    //alert(id);return false;
    if(id !='')
    {
      $.ajax({
        "url"  : "<?php echo base_url('tollcenter/get_single_bank');?>",
        "type" : "POST",
        "data" : ({'id':id}),
        success:function(response){
          console.log(response);
           $("#pop_view").text("");
         // var data = $.parseJSON(response);
          //console.log(response);return false;
          $("#pop_view").append(response);
          
        }
      });
    }
  }

  function view_bankdetails(id)
  {
    //alert(id);return false;
    if(id !='')
    {
      $.ajax({
        "url"  : "<?php echo base_url('tollcenter/get_single_bank_view');?>",
        "type" : "POST",
        "data" : ({'id':id}),
        success:function(response){
          console.log(response);
           $("#pop_view").text("");
         // var data = $.parseJSON(response);
          //console.log(response);return false;
          $("#pop_view").append(response);
          
        }
      });
    }
  }

  function getcentername() {
    $("#tcn").val('');
    var location_id = $("#toll_center_loaction").val();
    $("#toll_center_name").html('');
    if(location_id != '')
    {
      $.ajax({
            "url":"<?php echo base_url('tollcenter/gettollcenternameBank');?>",
            "type" : "POST",
            "data" :({'location_id':location_id}),
            success:function(response){
              $("#toll_center_name").append(response);
            }
           });
    }
    else{
      $("#toll_center_name").append('<option value="">No Toll Center Names</option>');
    }

    // body...
  }

  function gettcn(){
    $("#tcn").val('');
    var toll_center_name = $("#toll_center_name").val();
    $.ajax({
            "url":"<?php echo base_url('tollcenter/gettcn');?>",
            "type" : "POST",
            "data" :({'toll_center_name':toll_center_name}),
            success:function(response){
              var obj = $.parseJSON(response);
              if( obj.statuscode == 200 )
              {
               $("#tcn").val(obj.response.tc_id);
              }
              else{
                $("#error_message").text(obj.error[0]);
              }
            }
          });
  }

$(document).ready(function(){
    $('#addbankdetails').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:30},
        bank_name:{required: true,minlength:1,maxlength:30},
        bank_address:{required: true,minlength:1,maxlength:50},
        account_type:{required: true},
        account_num:{required: true,minlength:1,maxlength:20,digits:true},
        account_name:{required: true,minlength:1,maxlength:20},
        ifsc_code:{required: true,minlength:1,maxlength:20},
        tcn:{required: true},
      },
      messages:{
                toll_center_loaction:{
                    required:"Please Enter Toll Center Location",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               toll_center_name:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
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
                    digits:"Enter Only Digits",
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
});

</script>