<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book My Tool</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/user/css/bmt-bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/user/css/bmt.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/user/css/bmt-min.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/user/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <link href='<?php echo base_url('assets/user/css/font_one.css')?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo base_url('assets/user/css/font_two.css')?>' rel='stylesheet' type='text/css'>
    <!-- Favocn -->
    <link rel="icon" href="<?php echo base_url('assets/user/img/logo.png')?>" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery -->
    <script src="<?php echo base_url('assets/user/js/jquery.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/user/js/bmt-bootstrap.min.js')?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php //echo base_url('assets/user/js/bmt-min.js')?>"></script>

    <!-- validation plugin -->
    <script src="<?php echo base_url('assets/js/jquery.validate.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-validate.bootstrap-tooltip.js')?>"></script>


    <!-- This file for confirm alert popup start -->
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/alertify.core.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/alertify.default.css');?>" id="toggleCSS" />
    <script src="<?php echo base_url('assets/lib/alertify.js')?>"></script>

</head>

<body class="cmn-login-bg">
    
<header class="intro-header login-main-page">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 col-sm-4 col-md-offset-4">
            <div class="center-block login-as text-center">
            <a href="http://bookmytoll.com/"><img src="http://bookmytoll.com/assets/user/img/logo.png" alt=""></a>
            <div class="focused-view-subtitle uppercase center border-center">
             <span>
             FORGOT PASSWORD
             </span>
          </div>
            <form id="contactForm" method="post"  name="userlogin" style="margin-top:0;">
              <?php if($this->session->flashdata('susmsg')){?>
                <div style="color:green;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('susmsg'); ?>. Please Login.</div>
              <?php }?>
                <?php if($this->session->flashdata('errormsg')){?>
                <div style="color:red;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('errormsg'); ?>. Please Login.</div>
              <?php }?>
                <div class="row control-group common-form">
                    <div class="form-group floating-label-form-group controls">
                        <input style="border-bottom-right-radius: 0 !important; border-bottom-left-radius: 0 !important;" type="text" id="email" name="email" class="form-control text-input square--bottom" placeholder="Email">
                    </div>
                    <div class="form-group floating-label-form-group controls">
                        <input type="text" id="mobile" name="mobile" class="form-control text-input square--top " placeholder="Mobile Number">
                    </div>
                </div>
               
                <div class="row control-group common-form">
                <span style="padding-right: 6%;" class="pull-right"></span>
                </div>
                <div class="row">
                    <div class="form-group" style="margin-bottom:0;  text-align:center;">
                        <button id="forgetpassword" style="width:93% !important;" type="button" class="btn btn-default login_btn common-form login-as-cmn-btn-new"  data-whatever="@getbootstrap">Submit</button>
                    </div>
                </div>
                

                <div class="row text-center">
                    <span style="color:red;"><?php echo validation_errors(); ?></span>
                    <span style="color:red;text-align:center;"><?php echo $this->session->flashdata('msg');?></span>
                    <span style="color:green;text-align:center;"><?php echo $this->session->flashdata('successmsg');?></span>
                </div>
            </form>
</div>
            </div>
        </div>
    </div>
</header>
<!-- Footer -->
    
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="pop_view" style="color:#000; font-weight:normal;">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> -->
        <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Foget Password</h4>
      </div>
      <div class="modal-body">
          <div style="color:red" id="error"></div>
          <div style="color:green" id="success"></div>
      
      <div class="modal-footer">
          <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass pull-right" id="cancel_password">ok</button>
      </div>
      </div>
      
      <div>
          <span id="please_wait">Please Wait...</span>
      </div>
      <div id="otp_div" style="display:none">
          <form id="otpform" method="post" name="otpform">
                <div class="row control-group common-form">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label><i class="fa fa-envelope-o"></i> OTP</label>
                        <input type="password" id="Otp" name="Otp" class="form-control " placeholder="OTP">
                    </div>
                </div>
                <div>
                    <span id="error_otp"></span>
                </div>
                <div class="modal-body">
                    <div class="modal-footer">
                        <button id="forgetpassword_otp"  type="button" class="btn save_changes pull-right common-btn-pass">Submit</button>
                        <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass pull-right" id="cancel_otp">cancel</button>
                    </div>
                </div>
          </form>
      </div>
    </div>
  </div>
</div>

</body>

</html>
<script type="text/javascript">
 $("#cancel_password").click(function(){
  location.reload();
});

  $("#cancel_otp").click(function(){
  location.reload();
});
$(document).ready(function(){

    //$("#exampleModal").hide();
    jQuery.validator.addMethod("validateusername", function(value, element) {
     
     var email = $("#email").val();
     var mobile= $("#mobile").val();
     if(email != '' && mobile != '')
     {
        return false;
     }
     else
     {
        return true;
     }
        //return false;
    }, 'Enter Only One Option');

    jQuery.validator.addMethod("enterone", function(value, element) {
     
     var email = $("#email").val();
     var mobile= $("#mobile").val();
     if(email == '' && mobile == '')
        return false;
     else
        return true;
    }, 'Enter Atleast  One Option');

    $("#forgetpassword").click(function(){
       
       $("#success").text('');
       $("#error").text('');
       $('#contactForm').validate({
          rules:{
            email:{email:true,maxlength:50,minlength:1,validateusername:true,enterone:true},
            mobile:{minlength:10,maxlength:10,validateusername:true,enterone:true}
          },
          messages:{
                    email:{
                        maxlength:"Enter Maximum 30 Characters",
                        //validateusername:"Enter Only One Option"
                   },
                   mobile:{
                    maxlength:"Enter Maximum 10 Digits",
                    minlength:"Enter Minimum 10 Digits",
                    validateusername:"Enter Only One Option"
                   }
          },
          tooltip_options: {
            _all_: {placement:'bottom',html:true,trigger:'focus'}
          }
        });
        if( $('#contactForm').valid())
        {
            $("#forgetpassword").attr('data-toggle','modal');
            $("#forgetpassword").attr('data-target','#exampleModal');
            var data = '';
            var email = $("#email").val();
            var mobile= $("#mobile").val();
            if(email != '')
                data = email;
            if(mobile != '')
                data = mobile;
            $.ajax({
              "url"  : "<?php echo base_url('user/forgetpassword');?>",
              "type" : "POST",
              "data" : ({email:data}),
              success:function(response){
                $("#please_wait").html('');
                $("#pop_view").show();
                //console.log(response);return false;
                  var data = $.parseJSON(response);
                  //console.log(data.response);
                  if(data.response.statuscode == 200)
                  {
                   if(data.type == 1)
                   {
                    
                    $("#success").text(data.response.successMessage);
                   }
                   if(data.type == 2)
                   {
                       $("#cancel_password").hide();
                        $("#otp_div").show();
                   }
                   //alertify.success(data.successMessage);
                  }
                  else{
                     $("#error").text(data.response.error);
                    //alertify.error(data.response.error);
                  }
                  // var set_make = "<?php echo @$vehicle_details->response->vehicleDetails->vehiclemake;?>";
      
              }
            });
        }
    });

    $("#forgetpassword_otp").click(function(){
        
       
       $('#otpform').validate({
          rules:{
            Otp:{required: true,digits:true,maxlength:4,minlength:4},
           },
          messages:{
                    Otp:{
                    required:"Please Enter OTP",
                    digits:"Please Enter Only Digits",
                    maxlength:"Enter Maximum 4 Digits",
                    minlength:"Enter Minimum 4 Digits",
                   },
                  
          },
          tooltip_options: {
            _all_: {placement:'bottom',html:true,trigger:'focus'}
          }
        });
        if( $('#otpform').valid())
        {
           
            var otp = $("#Otp").val();
            var mobile= $("#mobile").val();
            $.ajax({
              "url"  : "<?php echo base_url('user/otpverification');?>",
              "type" : "POST",
              "data" : ({mobile:mobile,otp:otp}),
              success:function(response){
                 
                  var data = $.parseJSON(response);
               
                  if(data.statuscode == 200)
                  {
                   /* setTimeout(function(){
                       window.location = '<?php echo  base_url("user/resetpasswordbyotp?mobile=")?>'+mobile;
                    }, 5000);*/
                   window.location = '<?php echo  base_url("user/resetpasswordbyotp?mobile=")?>'+mobile;
                  }
                  else{
                     $("#error_otp").text(data.response.error);
                      alertify.error(data.error);
                  }
                  // var set_make = "<?php echo @$vehicle_details->response->vehicleDetails->vehiclemake;?>";
      
              }
            });
        }
    });

});
</script>

