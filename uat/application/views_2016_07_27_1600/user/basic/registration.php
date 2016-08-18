<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book My Toll</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/user/css/bmt-bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/user/css/bmt.css')?>" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/user/css/bmt-min.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/user/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <link href='<?php echo base_url('assets/user/css/font_one.css')?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo base_url('assets/user/css/font_two.css')?>' rel='stylesheet' type='text/css'>
    <!-- Favocn -->
    <link rel="icon" href="<?php echo base_url('assets/user/img/logo.png')?>" type="image/png">
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

</head>

<body>
    <header class="top-header">
        <div class="container text-center">
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/user/img/logo.png')?>" alt="" /></a>
                <div class="bs-example pull-right">
                     <!-- /pills -->
                </div>
        </div>
    </header>
<header class="intro-header">
    <div class="container">
        <div class="row">
                <div class="post-heading" style="padding: 30px 0 0 0;">
                    <h2 style="color: #ffa800;">REGISTRATION</h2>
                </div>
        </div>
        <div class="row register_form">
           
            <form id="contactForm_1" novalidate name="registrationform" method="post" action="<?php echo base_url('user/registration');?>">
                <div class="col-md-12 col-sm-12">
                    <div class="row control-group common-form">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label><i class="fa fa-envelope-o"></i> First Name</label>
                            <input type="text" name="first_name" value="<?php echo set_value('first_name');?>" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="row control-group common-form">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label><i class="fa fa-envelope-o"></i> Last Name</label>
                            <input type="text" name="last_name"  value="<?php echo set_value('last_name');?>" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row control-group common-form">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label><i class="fa fa-lock"></i> E-mail</label>
                            <input type="text" name="email_id"  value="<?php echo set_value('email_id');?>" class="form-control" placeholder="E-mail">
                        </div>
                    </div>
                    
                
                </div>
                
                <div class="col-md-12 col-sm-12">
                    
                    <div class="row control-group common-form">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label><i class="fa fa-lock"></i> Mobile Number</label>
                            <input type="text" name="mobile_no" value="<?php echo set_value('mobile_no');?>"  class="form-control" placeholder="Mobile Number">
                        </div>
                    </div>
                     <div class="row control-group common-form">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label><i class="fa fa-lock"></i> Password</label>
                            <input type="password" id="password" name="password"  value="<?php echo set_value('password');?>" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="row control-group common-form">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label><i class="fa fa-lock"></i> Confirm Password</label>
                            <input type="password" name="confirmpassword"  value="<?php echo set_value('confirmpassword');?>" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
<!--                   <div class="form-group col-xs-12">                   
                     <span style="margin: 5% 0 0 0%; padding:0; float:right;">OTP : <input style="border: 1px #89898a solid; background:none; min-height:40px; padding-left:5px;" type="text" /></span>                    
                    </div>-->

                    <span style="color:red;"><?php echo validation_errors(); ?></span>
                    <div class="row">
                            <?php if(isset($error)){?><div class="form-group col-xs-12" style="margin-top: 30px;color: rgb(207, 0, 0);font-size: 15px;font-weight: bold;padding-top: 0;text-align: center; text-transform: capitalize;">
                <?php // echo "<pre>"; print_r($error);exit;
              echo implode(', ',$error);
                ?>
            </div><?php }?>
                        </div>
                        <div class="form-group col-xs-12">
                            <button style="text-align:center; margin: 5% 0 0 3.5%;" type="submit" class="login_btn common-form btn btn-success common-btn-pass pull-right">SUBMIT</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</header>
<!-- Footer -->
    
<?php if(isset($userid)){?>
 <div class="modal fade bs-example-modal-lg in" id="otp_popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: block; padding-right: 17px; background: rgba(0, 0, 0, 0.54);">
                  <div class="row register_form modal-dialog modal-content" style="margin: 0 auto; width: 25%; margin-top: 5%; padding-bottom:10px;">
            <h1 class="text-center modal-header">OTP Verification</h1>
            <form id="otpcontactForm_1" novalidate name="otpform" method="post" action="">
                   <?php if(isset($error)){?><div class="form-group col-xs-12" style="color: rgb(207, 0, 0);font-size: 15px;font-weight: bold;padding-top: 0;text-align: center; text-transform: capitalize;">
                <?php  //echo "<pre>"; print_r($error);
              echo implode(', ',$error);
                ?>
            </div><?php }?>
                <div id="otpsus" style="color: green; font-size: 12px; font-weight: bold;text-align: center;"></div>
                 <div id="otpsus_error" style="color: red; font-size: 12px; font-weight: bold;text-align: center;"></div>
<!--                <input type="text" name="pno" id="pno" value="<?php if($this->session->flashdata('phno')){echo $this->session->flashdata('phno');}else{echo set_value('pno');}?>">-->
                 <input type="hidden" name="userid" id="userid" value="<?php if(isset($userid)){echo $userid;}?>">
                 <!--<input type="hidden" name="userid" id="userid" value="6">-->

                <div class="col-md-12 col-sm-12">                   
                    <div class="form-group col-xs-12 floating-label-form-group">
                        <span style="margin: 5% 0 0 0%; padding:0;"> 
                            <input placeholder="OTP" name="otp" id="otp" style="border: 1px #89898a solid; background:none; min-height:40px; padding-left:5px; width:100%; margin-top:10px; margin-bottom:10px;" type="text" />
                        </span>
                    </div>
                      <div class="row control-group common-form modal-footer">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                       
                      
                        

                            <button type="submit" class="btn save_changes pull-right common-btn-pass">Submit</button>
                          <button style="margin-right:5px;" type="button" class="btn btn-danger pull-right common-btn-pass pull-right" id="top_cancel">Cancel</button>
                      
                            
                        </div>
                     
                    </div>
                    <span style="color:red;"><?php echo validation_errors(); ?></span>
                </div>
                
            </form>
        </div>  
              </div>

<?php }?>
</body>

</html>

<script type="text/javascript">

 $("#top_cancel").click(function(){
    $("#otp_popup").hide();
  });

 $("#otpcontactForm_1").submit(function(e) {
    // alert(1);
    e.preventDefault();
var otp=$('#otp').val();
//alert(otp);
if(otp==''){
   $('#otpsus_error').html('Please Enter OTP'); 
   $('#otp').val('');
   return false;
}else{
   $('#otpsus_error').html('');  
}
    $.ajax({
           type: "POST",
           url: "<?php echo base_url('user/ajaxotp');?>",
           data: $("#otpcontactForm_1").serialize(), // serializes the form's elements.
           success: function(msg)
           {
             // alert(msg); // show response from the php script.
               d = $.parseJSON(msg);    
                if(d.ans=='success') {
                        $('#otpsus').html(d.res).fadeIn().delay(1000).fadeOut();
                         window.location.href="<?php echo base_url('user/login');?>";
                                }else if(d.ans=='failure') {
                    
                    if(d.res=='Please Enter Correct OTP'){
                        $('#otpsus_error').html(d.res).fadeIn().delay(30000).fadeOut();
                        return false;
                    }else{
                        $('#otpsus_error').html(d.res).fadeIn().delay(10000).fadeOut();
                        return false;
                         //window.location.href="<?php echo base_url('user/registration');?>";
                    }
                   
                                }
               
           }
         });

 // avoid to execute the actual submit of the form.
});   
//$(document).ready(function(){
//    $('#contactForm_1').validate({
//      rules:{
//        otp:{required:true}
//      },
//      messages:{       
//       otp:{
//                required:"Please Enter OTP"            
//       }
//        },
//       tooltip_options: {
//        _all_: {placement:'bottom',html:true,trigger:'focus'}
//      }
//    });
//});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#contactForm_1').validate({
      rules:{
        first_name:{required: true,maxlength:20,minlength:3},
        last_name:{required: true,maxlength:20,minlength:1},
        email_id:{required: true,email:true,maxlength:30},
        mobile_no:{required: true,digits:true,minlength:10,maxlength:10},
        password:{required: true},
        confirmpassword:{required: true,equalTo: "#password"},
        otp:{required:true,maxlength:5,minlength:5}
      },
      messages:{
        first_name:{
            required:"Please Enter First Name",
            minlength:"Enter Minimum 3 Characters",
            maxlength:"Enter Maximum 30 Characters"
       },
       last_name:{
                required:"Please Enter Last Name",
                minlength:"Enter Minimum 3 Characters",
                maxlength:"Enter Maximum 30 Characters"
               },
       
       email_id:{
                required:"Please Enter Email Id",
                email:"Enter Valid Email",
                maxlength:"Enter Maximum 30 Characters"
               },
       
       mobile_no:{
                required:"Please Enter Mobile Number",
                digits:"Enter Only Digits",
                minlength:"Enter Minimum 10 Digits",
                maxlength:"Enter Maximum 10 Digits",
               },
      
       password:{
                required:"Please Enter Password"                
               },
       confirmpassword:{
                required:"Please Enter Confirm Password",
                equalTo:"Both password and confirmpassword should be same"
               },
       otp:{
                required:"Please Enter OTP",
                minlength:"You Entered Worng OTP",
                maxlength:"You Entered Worng OTP"
       }
        },
       tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
});
</script>