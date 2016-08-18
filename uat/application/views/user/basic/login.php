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

</head>

<body class="cmn-login-bg">
    
<header class="intro-header login-main-page">

    <div class="container">
        <div class="row">
            
            <div class="col-md-4 col-sm-4 col-md-offset-4">
            <div class="center-block login-as text-center">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/user/img/logo.png')?>" alt=""></a>
          <div class="focused-view-subtitle uppercase center border-center">
             <span>
             Sign In
             </span>
          </div> 
            <form style="margin-top:0;" id="contactForm" method="post" action="<?php echo base_url('user/login')?>" name="userlogin">
            <div class="row">
                    <div class="form-group col-xs-12" style="margin-bottom:0;  text-align:center;">
                        <a href="<?php if (@$login_url)  echo $login_url ?>" id="login" style="background:#3B5998; text-transform: capitalize; color:#fff;" 
                        type="submit" class="btn login_btn common-form login-as-cmn-btn">
                        <img height="45" style="float:left;" src="<?php echo base_url('assets/user/img/facebook-login.png');?>" >
                         Login With Facebook</a>
                    </div>
                </div>
                <div class="focused-view-subtitle uppercase center border-center">
             <span>
             or use email
             </span>
          </div> 
              <?php if($this->session->flashdata('susmsg')){?>
                <div style="color:green;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('susmsg'); ?>. Please Login.</div>
              <?php }?>
                <?php if($this->session->flashdata('errormsg')){?>
                <div style="color:red;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('errormsg'); ?>. Please Login.</div>
              <?php }?>
                <div class="row control-group common-form">
                    <div class="form-group floating-label-form-group controls push-tiny--top flush--bottom">
                        <input style="border-bottom-right-radius: 0 !important; border-bottom-left-radius: 0 !important;" type="text" name="email" class="form-control text-input square--bottom " placeholder="Email / Mobile">
                    </div>
                </div>
                <div class="row control-group common-form">
                    <div class="form-group floating-label-form-group controls">
                        <input type="password"  name="password" class="form-control text-input square--top " placeholder="Password">
                    </div>
                </div>
                <div class="row control-group common-form">
                <span style="padding-right: 6%;color:#ffa800;" class="pull-right"><a style="color:#FFAA00;" href="<?php echo base_url('user/forgetpassword');?>">Forgot your password?</a></span>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12" style="margin-bottom:0;  text-align:center;">
                        <button id="login" style="text-transform:capitalize;" type="submit" class="btn btn-default login_btn common-form login-as-cmn-btn-new">Sign in</button>
                    </div>
                </div>

                
               <!--  <div class="row">
                    <div class="form-group col-xs-12" style="margin-bottom:0;  text-align:center;">                       
                <a href="<?php if (@$login_url)  echo $login_url ?>" class="btn" role="button" style="padding:15px 19px !important;">
                <img src="<?php echo base_url('assets/user/img/login with fb.jpg');?>" >
                </a>
                    </div>
                </div>-->
                <div class="row control-group" style="text-align:center;">
                <span class="text-center"><a style="color:#FFAA00;" href="<?php echo base_url('user/registration');?>">New User ? Register</a></span>
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
    


</body>

</html>
<script type="text/javascript">
$(document).ready(function(){
    $('#contactForm').validate({
      rules:{
        email:{required: true,maxlength:30},
        password:{required: true,maxlength:20,minlength:8},
      },
      messages:{
                email:{
                    required:"Please Enter Login",
                    maxlength:"Enter Maximum 30 Characters"
               },
      password:{
                required:"Please Enter Password",
                minlength:"Enter Maximum 8 Characters",
               },
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
});
</script>

