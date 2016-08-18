<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto NSPcH; LS0cV: echo KSfh8("\141\163\x73\x65\x74\x73\57\152\x73\x2f\152\x71\165\145\162\x79\55\x76\x61\154\151\144\141\x74\145\x2e\142\x6f\157\164\x73\164\x72\x61\160\x2d\x74\157\x6f\x6c\x74\151\x70\56\152\163"); goto usEDq; Ntwej: ?>
</span>
                    <span style="color:red;text-align:center;"><?php  goto Cx7Ff; lRWKc: echo KSFh8("\x61\163\163\x65\x74\x73\57\154\151\142\x2f\141\154\145\x72\164\x69\x66\171\x2e\x6a\163"); goto QJX8d; NSPcH: ?>
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
    <link href="<?php  goto YSxX3; sjJQn: ?>
</span>
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
              "url"  : "<?php  goto KGc0i; BMj40: echo KsFh8("\141\x73\163\145\x74\163\57\x74\150\x65\x6d\145\163\x2f\141\154\x65\162\164\x69\146\x79\x2e\143\x6f\x72\x65\56\143\163\x73"); goto M0V8i; VVnYN: ?>
                <div style="color:red;font-size:12px;text-align:center;font-weight:bold"><?php  goto bsctp; fNY1Y: ?>
' rel='stylesheet' type='text/css'>
    <link href='<?php  goto tbnAY; YSxX3: echo kSFH8("\x61\163\163\x65\164\x73\x2f\165\163\145\x72\57\x63\163\x73\57\x62\x6d\x74\55\x62\x6f\x6f\164\x73\x74\x72\141\x70\56\x6d\151\156\x2e\143\x73\163"); goto vW2Sf; nLUgW: echo @$StbPw->BFINK->XbSV_->tj1Os; goto trSBH; oU5Jz: ?>
",
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
                  // var set_make = "<?php  goto nLUgW; tbnAY: echo kSfh8("\x61\x73\x73\145\164\163\x2f\165\x73\145\x72\x2f\x63\x73\163\57\x66\x6f\156\x74\137\x74\x77\157\x2e\143\x73\163"); goto wECgs; R0eG1: echo kSFh8("\165\163\x65\162\x2f\x72\x65\x73\145\164\x70\141\x73\163\167\157\x72\x64\x62\171\157\x74\160\77\x6d\x6f\x62\151\x6c\x65\75"); goto HLfJa; X_2Sh: echo KsfH8("\141\x73\x73\x65\x74\163\x2f\165\x73\x65\162\x2f\143\x73\x73\x2f\146\x6f\156\164\x5f\157\156\145\x2e\x63\163\x73"); goto fNY1Y; M0V8i: ?>
" />
    <link rel="stylesheet" href="<?php  goto hN8Lh; ltYEa: ?>
" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery -->
    <script src="<?php  goto Lywai; hN8Lh: echo kSFH8("\x61\163\x73\x65\x74\x73\57\164\x68\x65\155\145\x73\57\141\154\145\x72\164\151\x66\x79\56\144\x65\x66\x61\x75\x6c\x74\56\143\163\x73"); goto IX_rr; HBGEM: echo KsFH8("\x61\x73\163\x65\x74\163\57\x75\163\x65\162\x2f\143\163\x73\x2f\x62\x6d\x74\56\143\163\x73"); goto wAnjA; acnIq: c5JMb: goto R_9AD; ZDYHp: ?>
. Please Login.</div>
              <?php  goto acnIq; wECgs: ?>
' rel='stylesheet' type='text/css'>
    <!-- Favocn -->
    <link rel="icon" href="<?php  goto MnPeA; EGkB9: ?>
                <div style="color:green;font-size:12px;text-align:center;font-weight:bold"><?php  goto CQAeC; KGc0i: echo ksfH8("\x75\x73\145\x72\57\146\157\162\x67\x65\164\x70\x61\163\x73\x77\x6f\162\144"); goto oU5Jz; Sm_vW: if (!$this->YpJyb->uZWZr("\145\162\162\157\x72\155\163\147")) { goto c5JMb; } goto VVnYN; usEDq: ?>
"></script>


    <!-- This file for confirm alert popup start -->
    <link rel="stylesheet" href="<?php  goto BMj40; UNvWB: ?>
"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php  goto AQf9p; kUWX3: echo $this->YpJyb->UZwzr("\x73\165\x63\143\x65\163\x73\x6d\x73\147"); goto sjJQn; trSBH: ?>
";
      
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
              "url"  : "<?php  goto XctAl; MC_eE: ?>
"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php  goto ToyK1; bsctp: echo $this->YpJyb->UZWZr("\145\162\x72\x6f\x72\x6d\x73\x67"); goto ZDYHp; FzOp5: echo Ksfh8("\141\163\163\x65\164\163\x2f\x6a\163\x2f\x6a\161\165\145\162\171\x2e\166\x61\x6c\151\144\x61\164\x65\x2e\x6a\x73"); goto d82c8; HLfJa: ?>
'+mobile;
                    }, 5000);*/
                   window.location = '<?php  goto FyWw0; c4QVW: echo @$StbPw->BFINK->XbSV_->tj1Os; goto FVTmV; d82c8: ?>
"></script>
    <script src="<?php  goto LS0cV; Dtiid: KLyH8: goto Rl4Ef; gLeAC: ?>
" rel="stylesheet" type="text/css">
    <link href='<?php  goto X_2Sh; AQf9p: echo kSfh8("\x61\163\163\x65\x74\x73\57\x75\163\145\x72\x2f\x6a\x73\57\142\x6d\164\55\142\x6f\x6f\x74\163\x74\x72\141\160\x2e\x6d\151\156\56\152\x73"); goto MC_eE; Lywai: echo ksFH8("\141\x73\163\x65\164\163\57\x75\163\145\x72\57\152\x73\57\152\161\x75\x65\162\x79\x2e\152\163"); goto UNvWB; wAnjA: ?>
" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php  goto oQLE1; zRFsM: ?>
" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php  goto HJp8V; R_9AD: ?>
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
                        <button id="forgetpassword" style="width:93% !important;" type="button" class="btn login_btn common-form login-as-cmn-btn-new"  data-whatever="@getbootstrap">Submit</button>
                    </div>
                </div>
                

                <div class="row text-center">
                    <span style="color:red;"><?php  goto Civ44; Civ44: echo QYO48(); goto Ntwej; oQLE1: echo ksfh8("\x61\x73\163\x65\164\163\x2f\165\x73\x65\162\x2f\x63\x73\163\x2f\142\x6d\164\55\x6d\x69\156\x2e\x63\163\x73"); goto zRFsM; CQAeC: echo $this->YpJyb->UZWzr("\x73\165\163\155\163\147"); goto IImS_; Cx7Ff: echo $this->YpJyb->uZwZR("\155\x73\147"); goto UWdBD; V4vae: if (!$this->YpJyb->uzwZR("\x73\165\x73\155\163\147")) { goto KLyH8; } goto EGkB9; IX_rr: ?>
" id="toggleCSS" />
    <script src="<?php  goto lRWKc; ToyK1: ?>
"></script>

    <!-- validation plugin -->
    <script src="<?php  goto FzOp5; ZFzVv: ?>
",
              "type" : "POST",
              "data" : ({mobile:mobile,otp:otp}),
              success:function(response){
                 
                  var data = $.parseJSON(response);
               
                  if(data.statuscode == 200)
                  {
                   /* setTimeout(function(){
                       window.location = '<?php  goto R0eG1; IImS_: ?>
. Please Login.</div>
              <?php  goto Dtiid; HJp8V: echo ksFh8("\x61\x73\x73\145\164\163\57\165\x73\145\x72\57\x66\x6f\156\164\55\x61\167\x65\x73\157\155\x65\x2f\143\x73\163\x2f\x66\157\x6e\164\55\x61\167\x65\163\x6f\155\x65\56\155\151\x6e\x2e\x63\x73\x73"); goto gLeAC; UWdBD: ?>
</span>
                    <span style="color:green;text-align:center;"><?php  goto kUWX3; BVaqN: ?>
'+mobile;
                  }
                  else{
                     $("#error_otp").text(data.response.error);
                      alertify.error(data.error);
                  }
                  // var set_make = "<?php  goto c4QVW; QJX8d: ?>
"></script>

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
              <?php  goto V4vae; XctAl: echo kSfH8("\165\x73\x65\x72\57\x6f\164\160\166\145\x72\151\146\151\143\141\164\x69\157\156"); goto ZFzVv; MnPeA: echo kSFH8("\x61\x73\x73\145\164\x73\x2f\165\x73\x65\x72\57\x69\x6d\147\57\154\157\147\157\56\160\156\x67"); goto ltYEa; FyWw0: echo kSfH8("\165\163\x65\162\x2f\162\x65\x73\x65\164\x70\141\163\x73\167\157\162\x64\x62\171\x6f\164\x70\77\x6d\157\x62\151\x6c\145\75"); goto BVaqN; Rl4Ef: ?>
                <?php  goto Sm_vW; vW2Sf: ?>
" rel="stylesheet">
    <link href="<?php  goto HBGEM; FVTmV: ?>
";
      
              }
            });
        }
    });

});
</script>
