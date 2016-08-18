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
<header class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="post-heading">
                    <h2 style="color: #ffa800;">WELCOME TO</h2>
                    <h1 class="subheading" style="color:#000;">BOOK MY TOLL</h1>
                    
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            <form id="contactForm" method="post" action="<?php echo base_url('user/resetpassword/'.$this->uri->segment(3))?>" name="userlogin" class="toll-login">
                <h1>CHANGE PASSWORD</h1>
              <?php if($this->session->flashdata('susmsg')){?>
                <div style="color:green;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('susmsg'); ?>. Please Login.</div>
              <?php }?>
                <?php if($this->session->flashdata('errormsg')){?>
                <div style="color:red;font-size:12px;text-align:center;font-weight:bold"><?php echo $this->session->flashdata('errormsg'); ?>. Please Login.</div>
              <?php }?>
                <div class="row control-group common-form">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label><i class="fa fa-envelope-o"></i>Password</label>
                        <input type="password" name="password" id="password" class="form-control " placeholder="Password">
                    </div>

                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label><i class="fa fa-envelope-o"></i>Confirm Password</label>
                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control " placeholder="Cofirm Password">
                    </div>
                </div>
               
                <div class="row control-group common-form">
                <span style="padding-right: 6%;" class="pull-right"></span>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12" style="margin-bottom:0;  text-align:center;">
                        <button id="login" style="width:90% !important;" type="submit" class="btn btn-default login_btn common-form">Submit</button>
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

    jQuery.validator.addMethod("validpassword", function(value, element) {
     
        var pwd = $("#password").val();
        var cpwd= $("#confirmpassword").val();
        if(pwd != cpwd)
            return false;
        else
            return true;
    }, 'Passwords Not Matched');

    $('#contactForm').validate({
      rules:{
           password:{
            required:true,
            minlength:1,
            maxlength:20
           
          },
          confirmpassword:{
            required:true,
            equalTo: "#password",
           
            minlength:1,
            maxlength:20
          }
      },
      messages:{
              password:
              {
                required: "Please Enter New Password ",
                minlength: "Enter Minimum 1 characters",
                maxlength:"Enter Maximum 20 characters"
              },
              confirmpassword:
              {
                required: "Please Enter Confirm Password",
                minlength: "Enter Minimum 1 Characters",
                equalTo:"Passwords Do Not Match",
                maxlength:"Enter Maximum 20 characters"
              }
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
});
</script>

