<?php //echo "<pre>"; print_r($bank_list);exit;?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addbankdetails" name="addbankdetails" action="<?php echo base_url('tollcenter/addbankdetails');?>">
    
    <div class="row">
        <h4 style="padding-left: -1px !important; font-weight:normal;">History
        </h4>
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