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

    <!-- This file for confirm alert popup start -->
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/alertify.core.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/alertify.default.css');?>" id="toggleCSS" />
    <script src="<?php echo base_url('assets/lib/alertify.js')?>"></script>
    <!-- This file for confirm alert popup End -->
    <!-- Datepicke Files Start-->
      <link href="<?php echo base_url('assets/user/css/jquery.datetimepicker.css')?>" rel="stylesheet">
      <script src="<?php echo base_url('assets/user/js/jquery.datetimepicker.js')?>"></script>
    <!-- Datepicke Files End-->
</head>
<?php //echo "string";exit;
$this->rest->header("Authtoken",$this->auth_token);
$response = $this->rest->get('user/getUserSpecificData');
//$this->rest->debug();exit;
//pd($response->response->profile_image);
$image_url = @$response->response->profile_image;
?>
<body>
       <header class="top-header">
         <div class="container-fluid">
         <?php if(isset($this->session->userdata['user_data']->id)){
$url=base_url('profile');
          }else{
$url=base_url();
            }?>
              <a href="<?php echo $url;?>"><img src="<?php echo base_url('assets/user/');?>/img/logo.png" alt="" /></a>
    <div class="bs-example pull-right">
    <ul class="nav nav-pills" role="tablist">
      
      <li role="presentation" class="dropdown">
        <a id="drop5" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:#ffa800;">
          WELCOME <?php echo $this->username;?><span> <img class="login_icon" src="<?php if(isset($image_url) && $image_url != '') echo $image_url; else echo base_url('assets/user/img/profile_icon.png');?>" alt="" /></span>
          <span class="caret"></span>
        </a>
        <ul id="menu2" class="dropdown-menu" aria-labelledby="drop5">
          <li><a href="<?php echo base_url('help');?>">Help</a></li>
          <li><a href="<?php echo base_url('userguide');?>">User Guide Lines</a></li>
          <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
        </ul>
      </li>
      
    </ul> <!-- /pills -->
  </div>
         </div>
    </header>
