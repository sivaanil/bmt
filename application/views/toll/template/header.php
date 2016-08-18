<!DOCTYPE html>
<?php //pd($this->session->userdata['user_data']);
$roll_id = @$this->session->userdata['user_data']->roll_id;
if($roll_id == 1)
{
$role_name = "Super Admin";
$url=base_url('tollcenter');
}
else if(isset($roll_id) && $roll_id == 2){
    $role_name = "Admin";
$url=base_url();
}
else if(isset($roll_id) && $roll_id == 3){
    $role_name = "Semi Admin";
$url=base_url('addtolloperator');
}
else if(isset($roll_id) && $roll_id == 4){
    $role_name = "Toll Operator";
$url=base_url('tolloperator/dialyoperations');
}
else {
    $role_name = "Toll User";
$url=base_url('profile');
}

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book My Toll</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/toll');?>/css/bmt-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/toll');?>/css/bmt.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/toll');?>/css/bmt-min.css" rel="stylesheet">

   
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
    <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>

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

       <!-- Datepicke Files Start-->
      <link href="<?php echo base_url('assets/user/css/jquery.datetimepicker.css')?>" rel="stylesheet">
      <script src="<?php echo base_url('assets/user/js/jquery.datetimepicker.js')?>"></script>
    <!-- Datepicke Files End-->

</head>

<?php //echo "string";exit;
if($this->uri->segment(2) != 'feedback')
$this->rest->header("Authtoken",$this->auth_token);
$response = $this->rest->get('toll/getUserSpecificDetails');
//$this->rest->debug();exit;
$image_url = @$response->response->profile_img;
?>
<body>

    <header class="top-header">
         <div class="container-fluid">
              <a href="<?php echo $url;?>"><img src="<?php echo base_url('assets/user');?>/img/logo.png" alt="" /></a>
    <div class="bs-example pull-right">
    <ul class="nav nav-pills" role="tablist">
      
      <li role="presentation" class="dropdown">
        <a id="drop5" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          WELCOME <?php echo @$this->session->userdata['user_data']->first_name.' '.@$this->session->userdata['user_data']->last_name?>

          <span> 
          <?php if(isset($image_url) && $image_url != '') {?>
        
<img class="login_icon" src="<?php  echo $image_url; ?>" alt="" />
      <?php    }else{ ?>
<i class="fa fa-user" style="font-size: 20px;"></i>
      <?php
          
//$img= base_url('assets/user/img/profile_icon.png');
    }
        ?>
          
          </span>
          <span class="caret"></span><br>

          <span class="login-role">Role : <?php echo @$role_name;?></span>
          
        </a>
        
        <ul id="menu2" class="dropdown-menu" aria-labelledby="drop5">
          <li><a href="#">Help</a></li>
          <li><a href="#">User Guide Lines</a></li>
          <li><a href="<?php echo base_url('toll/logout');?>">Logout</a></li>
        </ul>
      </li>
      
    </ul> <!-- /pills -->
  </div>
         </div>
    </header>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
 <?php 
// print_r($this->session->userdata['user_data']->roll_id);
 if($this->session->userdata['user_data']->roll_id==4){   
                $home=base_url('tolloperator');
                $op=base_url('tolloperator/operations');
                $profile=base_url('tolloperator/profile');
                $hs=base_url('tolloperator/history');
                $views=base_url('tolloperator/views');
                }
 else if($this->session->userdata['user_data']->roll_id==1){ 
                $home = base_url('home');
                $op=base_url('tollcenter');
                $profile=base_url('tolloperator/profile');
                $hs=base_url('staffhistory');
                $views=base_url('view');  
                    
 }
 else if($this->session->userdata['user_data']->roll_id==3){ 
                $home=base_url('home');
                $op=base_url('addtolloperator');
                $profile=base_url('tolloperator/profile');
                $hs='#';
                $views=base_url('view');  
                    
 }
 ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    
                    <li>
                        <a href="<?php echo $op;?>">OPERATIONS</a>
                    </li>
                    <?php 
                    if($roll_id != 1)
                    {
                    ?>
                    <li>
                        <a href="<?php echo $profile;?>">PROFILE</a>
                    </li>
                     <?php
                    }
                    ?>
                    <li>
                        <a href="<?php echo $hs;?>">HISTORY</a>
                    </li>
                    <?php 
                    if($roll_id == 1)
                    {
                    ?>
                    <li>
                        <a href="<?php echo $views;?>">VIEW</a>
                    </li>
                    <?php
                    }
                    ?>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    
    

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->