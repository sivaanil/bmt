<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto XFqzx; XrRFa: ?>
                <div style="color:green;font-size:12px;text-align:center;font-weight:bold"><?php  goto UZzGn; r54lb: ?>
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
                  // var set_make = "<?php  goto EJx28; wxHgf: if (!$this->YpJyb->UzWZr("\x65\162\162\157\162\x6d\x73\x67")) { goto zV0hi; } goto layx4; GbXZN: ?>
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
              "url"  : "<?php  goto a7UZF; LlCkN: ?>
" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php  goto tJiOs; strqg: echo KSfH8("\141\x73\163\145\164\163\57\154\x69\x62\57\141\154\145\162\x74\x69\x66\x79\56\152\163"); goto JqI5O; wf4Md: echo QYo48(); goto bvNxj; Li7mq: ?>
                <div class="row control-group common-form">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label><i class="fa fa-envelope-o"></i> Email Address</label>
                        <input type="text" id="email" name="email" class="form-control " placeholder="Email">
                    </div>
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label><i class="fa fa-envelope-o"></i>Mobile Number</label>
                        <input type="text" id="mobile" name="mobile" class="form-control " placeholder="Mobile Number">
                    </div>
                </div>
               
                <div class="row control-group common-form">
                <span style="padding-right: 6%;" class="pull-right"></span>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12" style="margin-bottom:0;  text-align:center;">
                        <button id="forgetpassword" style="width:90% !important;" type="button" class="btn btn-default login_btn common-form"  data-whatever="@getbootstrap">Submit</button>
                    </div>
                </div>
                

                <div class="row text-center">
                    <span style="color:red;"><?php  goto wf4Md; cRL9A: ?>
'+mobile;
                  }
                  else{
                     $("#error_otp").text(data.response.error);
                      alertify.error(data.error);
                  }
                  // var set_make = "<?php  goto ZctCo; TJ30q: ?>
"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php  goto M_qm3; vdind: ?>
" type="image/png">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery -->
    <script src="<?php  goto ImZoD; r8qr6: ?>
' rel='stylesheet' type='text/css'>
    <link href='<?php  goto qdVDa; GB_Pu: echo kSfH8("\x61\163\163\x65\x74\163\x2f\165\163\145\162\57\143\163\163\57\146\x6f\156\x74\x5f\157\x6e\145\x2e\143\x73\163"); goto r8qr6; Ql6pa: echo KSfH8("\141\x73\x73\145\x74\x73\x2f\165\163\x65\162\57\143\163\163\57\142\155\x74\55\142\157\x6f\x74\x73\164\x72\x61\x70\56\x6d\151\x6e\x2e\143\x73\x73"); goto IJnFM; WDjgG: echo $this->YpJyb->UZWZr("\x73\165\x63\x63\145\x73\x73\155\163\x67"); goto lDC6B; IJnFM: ?>
" rel="stylesheet">
    <link href="<?php  goto Y_W0O; wO0NU: echo $this->YpJyb->uZWZr("\x65\x72\x72\157\x72\x6d\x73\x67"); goto ne43E; tJiOs: echo KSFH8("\141\x73\x73\x65\x74\163\x2f\165\x73\145\x72\57\x63\x73\163\x2f\x62\x6d\164\x2d\x6d\x69\156\x2e\143\x73\x73"); goto vk7Wt; ZM33o: echo Ksfh8("\x61\x73\x73\145\164\x73\57\x6a\163\57\152\161\x75\145\162\171\56\166\x61\x6c\x69\x64\x61\164\145\56\152\x73"); goto bG4xy; Y_W0O: echo ksFH8("\141\163\x73\x65\164\163\x2f\165\x73\x65\x72\57\x63\x73\163\x2f\142\x6d\164\x2e\x63\163\163"); goto LlCkN; bvNxj: ?>
</span>
                    <span style="color:red;text-align:center;"><?php  goto ItC_D; RHPmy: ?>
" rel="stylesheet" type="text/css">
    <link href='<?php  goto GB_Pu; qzQaw: echo kSfH8("\141\x73\163\145\164\163\x2f\x75\x73\145\162\x2f\x69\155\147\57\x6d\x61\151\156\55\x62\x61\x6e\156\145\162\55\62\x2e\x6a\x70\x67"); goto YZ6Co; j00wF: echo KSFH8("\141\163\x73\145\164\163\x2f\x6a\163\57\152\x71\165\x65\162\171\55\166\141\x6c\x69\x64\141\164\145\x2e\142\157\x6f\x74\163\x74\162\x61\x70\x2d\x74\x6f\x6f\x6c\x74\x69\x70\x2e\x6a\163"); goto qtY9Q; b5SlS: Nt2Xi: goto Mo30V; rrHSV: if (!$this->YpJyb->UZwzR("\163\165\163\155\x73\x67")) { goto Nt2Xi; } goto XrRFa; XFqzx: ?>
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
    <link href="<?php  goto Ql6pa; UZzGn: echo $this->YpJyb->UZWzr("\x73\165\163\155\x73\x67"); goto KllXO; ImZoD: echo KSFh8("\x61\163\x73\145\164\x73\57\x75\x73\x65\x72\x2f\x6a\x73\x2f\152\161\165\145\162\171\x2e\x6a\163"); goto TJ30q; lDC6B: ?>
</span>
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
              "url"  : "<?php  goto Ymo1r; a7UZF: echo kSfH8("\x75\x73\145\x72\57\157\x74\160\166\x65\x72\x69\x66\x69\143\141\164\x69\x6f\156"); goto IIA8P; Pldu8: zV0hi: goto Li7mq; r7hHL: echo ksfH8("\141\163\163\x65\164\x73\x2f\165\x73\145\162\57\146\x6f\x6e\164\55\x61\167\x65\163\x6f\x6d\145\57\x63\x73\163\57\146\x6f\156\x74\55\x61\x77\x65\x73\157\155\x65\x2e\x6d\151\x6e\56\x63\x73\x73"); goto RHPmy; ne43E: ?>
. Please Login.</div>
              <?php  goto Pldu8; M_qm3: echo ksFh8("\141\163\x73\x65\x74\163\x2f\165\x73\x65\162\x2f\x6a\163\x2f\142\x6d\164\55\142\x6f\157\x74\x73\164\x72\x61\160\56\155\x69\156\x2e\x6a\163"); goto KfD2P; TdNWf: ?>
'+mobile;
                    }, 5000);*/
                   window.location = '<?php  goto J70jm; xZN9v: echo kSFh8(); goto UGD87; cbocU: echo Ksfh8("\141\x73\163\145\164\x73\x2f\164\150\x65\x6d\145\163\57\x61\x6c\x65\162\164\x69\146\171\56\x63\157\x72\145\x2e\143\163\163"); goto iXv76; J70jm: echo KsFH8("\165\x73\145\x72\57\x72\x65\163\145\x74\160\x61\x73\163\x77\x6f\x72\144\142\x79\x6f\x74\160\77\155\157\142\x69\x6c\145\x3d"); goto cRL9A; PTtN0: ?>
" id="toggleCSS" />
    <script src="<?php  goto strqg; IIA8P: ?>
",
              "type" : "POST",
              "data" : ({mobile:mobile,otp:otp}),
              success:function(response){
                 
                  var data = $.parseJSON(response);
               
                  if(data.statuscode == 200)
                  {
                   /* setTimeout(function(){
                       window.location = '<?php  goto E1PoR; KfD2P: ?>
"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php  goto ZQois; ItC_D: echo $this->YpJyb->UzwZr("\155\x73\147"); goto qAwsa; ZctCo: echo @$StbPw->BFINK->XbSV_->tj1Os; goto HlR4I; u4WG2: echo KSfH8("\141\163\x73\x65\164\163\x2f\165\x73\145\x72\57\x69\x6d\147\x2f\x6c\x6f\147\x6f\x2e\x70\156\147"); goto vdind; vk7Wt: ?>
" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php  goto r7hHL; kYuK7: echo KSfh8("\x61\x73\163\145\164\x73\57\x74\150\x65\x6d\x65\163\57\x61\x6c\145\x72\164\151\x66\171\56\x64\145\x66\x61\x75\154\x74\56\x63\163\163"); goto PTtN0; UGD87: ?>
"><img src="<?php  goto l38kd; YZ6Co: ?>
')">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="post-heading">
                    <h2 style="color: #ffa800;">WELCOME TO</h2>
                    <h1 class="subheading">BOOK MY TOLL</h1>
                    
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            <form id="contactForm" method="post"  name="userlogin">
                <h1>FORGET PASSWORD</h1>
              <?php  goto rrHSV; qdVDa: echo KSfh8("\x61\163\x73\145\164\163\57\165\163\x65\x72\x2f\x63\x73\163\x2f\146\157\156\x74\137\x74\167\x6f\56\143\x73\163"); goto dwGSC; ZQois: ?>
"></script>

    <!-- validation plugin -->
    <script src="<?php  goto ZM33o; l38kd: echo ksFh8("\x61\x73\163\x65\164\163\57\x75\163\145\162\x2f\151\155\x67\57\x6c\x6f\x67\157\x2e\x70\x6e\x67"); goto oh4jI; E1PoR: echo KsfH8("\165\163\x65\x72\57\x72\x65\x73\x65\x74\160\141\x73\163\x77\x6f\x72\x64\142\171\157\x74\x70\77\x6d\x6f\x62\151\x6c\x65\x3d"); goto TdNWf; layx4: ?>
                <div style="color:red;font-size:12px;text-align:center;font-weight:bold"><?php  goto wO0NU; qAwsa: ?>
</span>
                    <span style="color:green;text-align:center;"><?php  goto WDjgG; Ymo1r: echo kSfH8("\x75\163\145\x72\57\x66\157\x72\147\x65\x74\x70\x61\x73\163\x77\x6f\x72\144"); goto r54lb; iXv76: ?>
" />
    <link rel="stylesheet" href="<?php  goto kYuK7; dwGSC: ?>
' rel='stylesheet' type='text/css'>
    <!-- Favocn -->
    <link rel="icon" href="<?php  goto u4WG2; EJx28: echo @$StbPw->BFINK->XbSV_->tj1Os; goto GbXZN; Mo30V: ?>
                <?php  goto wxHgf; oh4jI: ?>
" alt="" /></a>
                <div class="bs-example pull-right">
                     <!-- /pills -->
                </div>
        </div>
    </header>
<header class="intro-header" style="background-image: url('<?php  goto qzQaw; KllXO: ?>
. Please Login.</div>
              <?php  goto b5SlS; bG4xy: ?>
"></script>
    <script src="<?php  goto j00wF; JqI5O: ?>
"></script>

</head>

<body>
    <header class="top-header">
        <div class="container-fluid">
                <a href="<?php  goto xZN9v; qtY9Q: ?>
"></script>


    <!-- This file for confirm alert popup start -->
    <link rel="stylesheet" href="<?php  goto cbocU; HlR4I: ?>
";
      
              }
            });
        }
    });

});
</script>
