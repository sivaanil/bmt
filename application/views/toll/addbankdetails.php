<?php //echo "<pre>"; print_r($bank_list);exit;?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addbankdetails" name="addbankdetails" action="<?php echo base_url('tollcenter/addbankdetails');?>">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_loaction" name="toll_center_loaction" onchange="getcentername()">
        <option value="">Toll Center Location</option>
        <?php
        $count = 0;
        foreach ($toll_location as $key => $value) {
          ?>
          <option value="<?php echo $value->tc_location;?>"><?php echo $value->tc_location?></option>
          <?PHP
          $count++;
        }
        if($count == 0)
        {
          ?>
          <option value="">NO Toll Center Location</option>
          <?php
        }
        ?>
        </select>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_name" name="toll_center_name" onchange="gettcn()">
            <option value="">Toll Center Name</option>
          </select>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="hidden" class="form-control" id="tcn" name="tcn" placeholder="TCN" readonly="off">
        </div>
      </div>
    </div>
    <div class="row">
        <h4 style="padding-left: -1px !important; font-weight:normal;">Bank Details
        </h4>
    </div>
      
      
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name">
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
              <input type="text" class="form-control" id="bank_address" name="bank_address" placeholder="Bank Address">
          </div>
        </div>
      
      </div>
      
      <div class="row">
      
        <div class="col-md-4 col-sm-4">
          <div class="form-group" style="padding-left:15px;">
              <select style="margin-top:0; width:100%;" class="form-control" name="account_type">
                <option value="">ACCOUNT TYPE</option>
                <?php
                if(isset($bank_types) && !empty($bank_types))
                {
                  foreach ($bank_types as $key => $value) 
                  {
                    ?>
                    <option value="<?php echo $value->id;?>"><?php echo $value->ac_type?></option>
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
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="account_num" name="account_num" placeholder="Account No">
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code (Valid xx digit number)">
          </div>
        </div>
      </div>
    <div class="row">
      <div class="form-group">
        <div class="col-sm-9">
          <div class="row">
           <div class="col-md-6 col-sm-6">
          <button type="submit" class="btn save_changes common-btn-pass">Submit</button>
          </div>
          <div class="col-md-6 col-sm-6 text-left" style="color:#090; font-size:12px;">
            <span style="color:red;"><?php echo validation_errors(); ?></span>
            <span id="error_message" class="text-center won_error"><?php echo $this->session->flashdata('errormsg');?></span>
            <span class="text-center"><?php echo $this->session->flashdata('msg');?></span>
            
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row text-center" style="color:#090;"></div>
  </form>
    
  <div class="row text-center">
    <div class="col-md-12">
      <!-- <button type="button" class="btn btn-primary common-btn-small">Add</button> -->
      <!-- <button type="button" class="btn btn-success common-btn-pass">Edit</button>
      <button type="button" class="btn btn-danger common-btn-pass">Delete</button> -->
    </div>
  </div>

  <div class="row">
      <table class="table" style="width:93%; margin-left:3.5%; border: 1px #DDD solid;">
      <thead>
      <tr>
      <th>Toll Location</th>
      <th>Toll Name</th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
      if(isset($bank_list) && !empty($bank_list))
      {
      foreach (@$bank_list as $key => $value) 
        {
          ?>
         <tr>
            <td><?php echo @$value->tc_location?></td>
            <td><?php echo @$value->tc_name?></td>
            <td>
              <button type="button"  onclick='view_bankdetails("<?php echo @$value->tc_id; ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <button type="button"  onclick='edit_bankdetails("<?php echo @$value->tc_id; ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
              <!-- <button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><a href="javascript:void(0);" onclick="delete_vehicle('<?php //echo  $value->id;?>')"> Delete</a></button> -->
            </td>
          </tr>
         <?php 
         }
      }?>
      </table>
      
          
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content" id="pop_view" style="color:#000; font-weight:normal;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
          </div>
        </div>
      </div>
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