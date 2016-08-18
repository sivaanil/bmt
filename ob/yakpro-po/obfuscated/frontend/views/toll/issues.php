<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto t4CV1; pFbo4: echo KSFh8("\164\x6f\x6c\x6c\143\x65\156\164\145\x72\57\x67\x65\x74\137\163\x69\156\147\x6c\x65\x5f\x62\141\x6e\x6b"); goto HA2OU; QGBWW: echo ksFh8("\x74\157\154\x6c\143\145\x6e\164\x65\162\x2f\x67\x65\x74\164\143\156"); goto d0NRY; amKVf: echo $this->YpJyb->uzWzR("\x6d\163\147"); goto DcYg6; A1Y_J: echo Ksfh8("\x74\157\154\154\143\145\x6e\x74\x65\x72\x2f\x67\145\164\x74\157\x6c\x6c\143\145\x6e\164\x65\162\x6e\x61\155\x65\102\141\x6e\153"); goto P5oR3; t4CV1: ?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addbankdetails" name="addbankdetails" action="<?php  goto E3DNg; vCwGo: ?>
</span>
            <span id="error_message" class="text-center won_error"><?php  goto LeGn9; LeGn9: echo $this->YpJyb->uzwzR("\x65\162\162\157\x72\x6d\163\x67"); goto rK3IM; DcYg6: ?>
</span>
            
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

  
                   
</div>

<script>
function edit_bankdetails(id)
  {
    //alert(id);return false;
    if(id !='')
    {
      $.ajax({
        "url"  : "<?php  goto pFbo4; rK3IM: ?>
</span>
            <span class="text-center"><?php  goto amKVf; NFTN0: echo QyO48(); goto vCwGo; nuhza: ?>
">
    
    <div class="row">
        <h4 style="padding-left: -1px !important; font-weight:normal;">Issues
        </h4>
    </div>
      
      
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Subject">
          </div>
        </div>
       
      
      </div>
      
      <div class="row">
      
        
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="account_num" name="account_num" placeholder="Description">
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
            <span style="color:red;"><?php  goto NFTN0; P5oR3: ?>
",
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
            "url":"<?php  goto QGBWW; jY6t1: echo ksFH8("\x74\x6f\154\154\x63\145\156\164\x65\x72\x2f\147\x65\164\x5f\163\151\x6e\x67\154\145\x5f\142\141\156\153\137\x76\x69\x65\167"); goto V930R; HA2OU: ?>
",
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
        "url"  : "<?php  goto jY6t1; V930R: ?>
",
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
            "url":"<?php  goto A1Y_J; E3DNg: echo ksFH8("\x74\x6f\x6c\x6c\143\145\156\164\x65\162\57\141\144\144\142\x61\x6e\153\x64\x65\164\x61\x69\154\163"); goto nuhza; d0NRY: ?>
",
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
