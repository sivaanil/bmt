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

<body>
    <header class="top-header">
                <div class="container">
                     <div class="row">
                          <div class="col-md-4">
                               <span><i class="fa fa-phone-square"></i> +91 95508 5199</span><br>
                               <span><i class="fa fa-envelope"></i> info@malolainnovations.com</span>
                          </div>
                          <div class="col-md-4 text-center">
                                <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/user/img/logo.png')?>" alt="" /></a>
                         </div>
                         <div class="col-md-4 text-right headerlinks">
                              <a href="<?php echo base_url('home/login');?>" class="btn btn-default" >LOG IN</a>
                              <a href="<?php echo base_url('user/registration');?>" class="btn btn-default">SIGN UP</a>
                         </div>
                <div class="bs-example pull-right">
                     <!-- /pills -->
                </div>
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
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/slide1.jpg");?>" data-holder-rendered="true">
          <div class="carousel-caption">
    <h1>Welcome to</h3>
    <h1>Book My Toll</h1>
  </div>
        </div>
        <div class="item">
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/slide2.jpg");?>" data-holder-rendered="true">
          <div class="carousel-caption">
    <h1>Hassle free Toll Collection</h1>
    <h1>Toll Payment</h1>
  </div>
        </div>
        <div class="item">
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/slide3.jpg");?>" data-holder-rendered="true">
          <div class="carousel-caption">
    <h1>Automating the Toll</h1>
    <h1>payments</h1>
  </div>
        </div>
        <div class="item">
          <img alt="Third slide [900x500]" width="100%" src="<?php echo base_url("assets/user/img/slide4.jpg");?>" data-holder-rendered="true">
          <div class="carousel-caption">
    <h1>Innovations for improving</h1>
    <h1>Quality of life</h1>
  </div>
        </div>
      </div>
      
      
      
    </div>
    
</header>
<!-- Footer -->
    <footer>
        <div class="container">
            <div class="row text-center">
            <div class="col-md-8 col-sm-8">
                 <ul class="list-inline">
                    <li>
                        <a href="<?php echo base_url();?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('aboutus');?>">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('howtouse');?>">How to Use</a>
                    </li>
                    <li>
                        <a href="#">BMT Network</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('locations');?>">Locations</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('contactus');?>">Contact Us</a>
                    </li>
                </ul>
                </div>
            
                <div class="col-md-4 col-sm-4">
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

