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
<style>
p{
	margin:15px 0;
	}
</style>
<body>
    <header class="top-header">
                <div class="container">
                     <div class="row">
                          <div class="col-md-4">
                               <span><i class="fa fa-phone-square"></i> +91 95508 51999</span><br>
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
<header class="intro-header">
<div class="container">
     
     <div class="row">
          <div class="col-md-8 col-sm-12">
               <h3 class="common_color">HOWTOUSE</h3>
               <h4>Smart Phone users : Install the App from Google Play Store Here </h4>
               <p>Add the Vehicle in the App in Vehicles under Menu
First added vehicle will be the default vehicle. Default vehicle implies that the Mobile is mapped to that vehicle and the payment triggered from the Mobile will be for that vehicle.<br>

User can create login in CcAvenue and map their payment details under that login.<br>

When the user approaches the toll centre with which BookMyToll has made the agreement, a smart device installed before the Toll Centre will detect the Mobile Phone and initiates the payment through CCAvenue payment gateway.<br>

By the time the user reaches the Toll Plaza, his toll is already paid J.<br>

BookMyToll will advise the Lane number of that Toll Centre through which the vehicle need to pass through.<br>

The Payment Information will be sent to the operator who will check the registration number and opens the Toll Gate.<br></p>


          </div>
          <div class="col-md-4 col-sm-12">
          <img src="http://bookmytoll.com/assets/user/img/abt-bmt.jpg" class="img-responsive" alt="" style="margin-top:112px">
          </div>
          
     </div>
     
     <div class="row">
		  <div class="col-md-4 col-sm-12">
          <img src="http://bookmytoll.com/assets/user/img/locations.jpg" class="img-responsive" alt="">
          </div>     	
          <div class="col-md-8 col-sm-12">
               <h4 class="common_color">WebApp Users :</h4>
               <p>The user can register in BookMyToll.com and add the vehicles in the menu.<br>

Before starting the journey, the user can choose the toll centre (with which BookMyToll has made the agreement) through which he will be travelling and makes the payment for that toll centre.<br>

The user will be advised the Lane number through which he has to pass through that toll centre.<br>

When the user approaches the toll centre for which he made the payment, the toll operator checks the vehicle number and if the payment is done, he will pass the vehicle. <br>
 
				</p>
          </div>
          
     </div>
     
     
     
     
     
     
     
</div>
    
</header>
<!-- Footer -->
    <footer style="position:relative;">
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
                            <a href="https://www.facebook.com/Book-My-Toll-568109523339691/" target="_new" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-facebook"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/BookMyToll" target="_new" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-twitter"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/113710679624812583275" target="_new" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-google-plus"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/book-my-toll" target="_new" style="border-right:0; padding:0;">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-linkedin"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://in.pinterest.com/bookmytoll/" target="_new" style="border-right:0; padding:0;">
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

