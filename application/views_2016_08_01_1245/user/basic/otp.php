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
<header class="intro-header" style="background-image: url('<?php echo base_url("assets/user/img/main-banner-2.jpg")?>')">
    <div class="container">
        <div class="row">
                <div class="post-heading" style="padding: 75px 0 0 0;">
                    <h2 style="color: #ffa800;">WELCOME TO</h2>
                    <h1 class="subheading">BOOK MY TOLL</h1>
                    
                </div>
        </div>
        <div class="row register_form">
            <h1>OTP Verification</h1>
            <form id="contactForm_1" novalidate name="otpform" method="post" action="">
                   <?php if(isset($error)){?><div class="form-group col-xs-12" style="color: rgb(207, 0, 0);font-size: 15px;font-weight: bold;padding-top: 0;text-align: center; text-transform: capitalize;">
                <?php  //echo "<pre>"; print_r($error);
              echo implode(', ',$error);
                ?>
            </div><?php }?>
                <div id="otpsus" style="color: green; font-size: 12px; font-weight: bold;text-align: center;"></div>
                 <div id="otpsus_error" style="color: red; font-size: 12px; font-weight: bold;text-align: center;"></div>
<!--                <input type="text" name="pno" id="pno" value="<?php if($this->session->flashdata('phno')){echo $this->session->flashdata('phno');}else{echo set_value('pno');}?>">-->
                 <input type="hidden" name="userid" id="userid" value="<?php if(isset($userid)){echo $userid;}?>">
                <div class="col-md-6 col-sm-6">                   
                    <div class="form-group col-xs-12">
                        <span style="margin: 5% 0 0 0%; padding:0; float:right;">OTP : 
                            <input name="otp" id="otp" style="border: 1px #89898a solid; background:none; min-height:40px; padding-left:5px;" type="text" />
                        </span>
                    </div>
                      <div class="row">
                        <div class="form-group col-xs-6">
                            <button style="width:40% !important; margin: 1% 1% 1% 155%;" type="submit" class="btn btn-default login_btn common-form">SUBMIT</button>
                        </div>
                     
                    </div>
                    <span style="color:red;"><?php echo validation_errors(); ?></span>
                </div>
                
            </form>
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
 $("#contactForm_1").submit(function(e) {
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
           data: $("#contactForm_1").serialize(), // serializes the form's elements.
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
                    }else{
                        $('#otpsus_error').html(d.res).fadeIn().delay(10000).fadeOut();
                         window.location.href="<?php echo base_url('user/registration');?>";
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