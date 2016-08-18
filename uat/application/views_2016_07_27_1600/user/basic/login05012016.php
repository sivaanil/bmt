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
        <div class="container-fluid">
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/user/img/logo.png')?>" alt="" /></a>
                <div class="bs-example pull-right">
                     <!-- /pills -->
                </div>
        </div>
    </header>
<header class="intro-header login-main-page">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/main-banner-2.jpg")?>')" data-holder-rendered="true">
        </div>
        <div class="item">
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/main-banner-2.jpg")?>')" data-holder-rendered="true">
        </div>
        <div class="item">
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/main-banner-2.jpg")?>')" data-holder-rendered="true">
        </div>
        <div class="item">
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/main-banner-2.jpg")?>')" data-holder-rendered="true">
        </div>
      </div>
      <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-6 col-md-offset-1 pull-right main-banner-text">
                    <div class="post-heading">
                        <h2>WELCOME TO</h2>
                        <h1 class="subheading">BOOK MY TOOL</h1>
                        <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-default">LOG IN</button>
                            <button type="submit" class="btn btn-default">REGISTER</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
      
      
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="post-heading">
                    <h2 style="color: #ffa800;">WELCOME TO</h2>
                    <h1 class="subheading">BOOK MY TOLL</h1>
                    
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            <form id="contactForm" method="post" action="<?php echo base_url('user/login')?>" name="userlogin">
                <h1>LOGIN</h1>
              <?php if($this->session->flashdata('susmsg')){?>
                <div style="color:green;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('susmsg'); ?>. Please Login.</div>
              <?php }?>
                <?php if($this->session->flashdata('errormsg')){?>
                <div style="color:red;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('errormsg'); ?>. Please Login.</div>
              <?php }?>
                <div class="row control-group common-form">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label><i class="fa fa-envelope-o"></i> Email Address</label>
                        <input type="text" name="email" class="form-control " placeholder="Email / Mobile">
                    </div>
                </div>
                <div class="row control-group common-form">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label><i class="fa fa-lock"></i> Password</label>
                        <input type="password"  name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="row control-group common-form">
                <span style="padding-right: 6%;color:#ffa800;" class="pull-right"><a style="color:#ffa800;" href="<?php echo base_url('user/forgetpassword');?>">FORGOT PASSWORD ?</a></span>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12" style="margin-bottom:0;  text-align:center;">
                        <button id="login" style="width:90% !important;" type="submit" class="btn btn-default login_btn common-form">Sign IN</button>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-12" style="margin-bottom:0;  text-align:center;">
                        <a href="<?php if (@$login_url)  echo $login_url ?>" id="login" style="width:90% !important; background:#4D7BB7; margin-top:10px; text-transform: capitalize;" 
                        type="submit" class="btn btn-default login_btn common-form">
                        <img height="20" src="<?php echo base_url('assets/user/img/facebook29.png');?>" >
                         Login With Facebook</a>
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
                <span class="text-center"><a style="color:#ffa800;" href="<?php echo base_url('user/registration');?>">New User ? Register</a></span>
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
</header>
<!-- Footer -->
    <footer>
        <div class="container">
            <div class="row text-center">
            
                <div class="col-md-offset-4 col-md-4 col-sm-14">
                    <ul class="list-inline">
                        <li>FOLLOW US : </li>
                        <li>
                            <a href="#" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-facebook"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-twitter"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-google-plus"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-linkedin"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-pinterest"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>
<script type="text/javascript">
$(document).ready(function(){
    $('#contactForm').validate({
      rules:{
        email:{required: true,maxlength:30},
        password:{required: true,maxlength:20},
      },
      messages:{
                email:{
                    required:"Please Enter Login",
                    maxlength:"Enter Maximum 30 Characters"
               },
      password:{
                required:"Please Enter Password"
               },
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
});
</script>

