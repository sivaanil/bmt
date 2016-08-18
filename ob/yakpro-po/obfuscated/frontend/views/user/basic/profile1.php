<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto o0DZH; mz9Fv: echo ksFh8("\x70\162\157\x66\x69\x6c\x65\x2f\151\155\x61\x67\x65\x75\160\x6c\x6f\x61\x64"); goto qMQzD; O4g1X: echo ksfH8(); goto QDhNc; JepTd: if (!($ZR33l == 1)) { goto xEn9T; } goto m2y_u; pDTZz: ?>
">-->
                 <input type="hidden" name="userid" id="userid" value="<?php  goto yz1ox; kFvDB: if (!(@$QSUAR->jXPGH != '')) { goto fLo2y; } goto p0SqX; hxt07: roUok: goto l3ff_; mFEhP: if (!isset($lui6w)) { goto UpPmE; } goto N9_7v; d19J4: ?>
">
          </div>
        </div>
        
        
      <h4 style="color: #FFA800; font-weight:normal;">Modify</h4>
      <button type="button" style="background:none;" class="btn btn-primary right_menu-button" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-phone-square"></i> Mobile No</button>
      <button type="button" style="background:none;" class="btn btn-success right_menu-button" data-toggle="modal" data-target="#exampleModal1" data-whatever="@getbootstrap"><i class="fa fa-envelope-o"></i> Email ID</button>
      <button type="button" style="background:none;" class="btn btn-warning right_menu-button" data-toggle="modal" data-target="#exampleModal2" data-whatever="@getbootstrap"><i class="fa fa-key"></i> Password</button>
   
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Modify Mobile No</h4>
            <span style="color:green;font-size:12px;" id="success_mobile"></span>
            <span style="color:red;font-size:12px;" id="fail_mobile"></span>
            </div>
            <div class="modal-body">
              <form id="change_mobile_form" name="change_mobile_form">
                <div class="form-group">
                  <input placeholder="Old Number" name="old_number" type="text" class="form-control" id="old_number" value="<?php  goto hdaAb; RiujM: echo "\x3c\163\160\x61\156\x20\163\x74\171\x6c\145\75\x27\x63\157\x6c\x6f\x72\x3a\x72\145\144\73\x66\157\x6e\x74\55\x73\x69\172\x65\72\x31\x33\x70\170\x3b\47\76" . $B2hiq . "\74\57\163\x70\x61\156\76"; goto f1VSd; hdaAb: echo @$QSUAR->rghu2; goto juD8U; MPlD7: ?>
",
            "type" : "POST",
            "data" :({'new_password':new_password,'old_password':old_password,'confirm_password':confirm_password}),
            success:function(response){     
              var obj = $.parseJSON(response);
              //console.log(obj);return false;
              if( obj.statuscode == 200 )
              {
                $("#success_password").text(obj.successMessage);
                $("#old_password").val('');
                $("#new_password").val('');
                $("#confirm_password").val('');
              }
              else{
                $("#fail_password").text(obj.error[0]);
              }

            }
           });
    }
    else{
      return false;
    }

});
$("#change_number").click(function(){
  //alert("hiii");
   $("#success_mobile").text('');
   $("#fail_mobile").text('');
  $('#change_mobile_form').validate({
      rules:{       
        old_number:{required: true,digits:true},  
        new_number:{required: true,digits:true},     
        },
      messages:{
       old_number:{
                required:"Please Enter Mobile Number",
                digits:"Enter Only Digits"                
               },
        new_number:{
                required:"Please Enter Mobile Number",
                digits:"Enter Only Digits"
               }
        },
       tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if($('#change_mobile_form').valid()){
            var new_number = $("#new_number").val();
            var old_number = $("#old_number").val();           

           $.ajax({
            "url":"<?php  goto pwG_i; v0wg7: ?>
">
                </div>
                <div class="form-group">
                  <input placeholder="New Email Id" type="text" name="new_email" class="form-control" id="new_email">
                </div>                
                <div class="modal-footer">
                  <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn save_changes " id="change_email">Change</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Change Password</h4>
              <span style="color:green;font-size:12px;" id="success_password"></span>
              <span style="color:red;font-size:12px;" id="fail_password"></span>
            </div>
            <div class="modal-body">
              <form id="change_password_form">
                <div class="form-group">
                  <input placeholder="Old Password" name="old_password" id="old_password" type="password" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <input placeholder="New Password" name="new_password" id="new_password" type="password" class="form-control" id="recipient-name">
                </div>  
                <div class="form-group">
                  <input placeholder="Confirm Password" name="confirm_password" id="confirm_password" type="password" class="form-control" id="recipient-name">
                </div>                
                <div class="modal-footer">
                  <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn save_changes" id="change_password">Change</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>-->
  </div>  
</div>

<script type="text/javascript">

$("#change_password").click(function(){
  //alert("hiii");
   $("#success_password").text('');
   $("#fail_password").text('');
  $('#change_password_form').validate({
      rules:{       
        old_password:{required: true},  
        new_password:{required: true,maxlength:19,minlength:8},
        confirm_password:{required: true,equalTo: "#new_password"}     
        },
      messages:{
       old_password:{
                required:"Please Enter Old Password."           
               },
        new_password:{
                required:"Please Enter New Password."       
               },
        confirm_password:{
                required:"Please Enter Confirm Password.",
                equalTo:"Both New password and confirm Password should be same."       
               }
        },
       tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if($('#change_password_form').valid()){
            var new_password = $("#new_password").val();
            var old_password = $("#old_password").val(); 
            var confirm_password = $("#confirm_password").val();           
           $.ajax({
            "url":"<?php  goto cjyxk; fSsSD: ?>
            </div><?php  goto C41qo; KMtoF: ?>
",
           data: 'otp='+otp+'&mobile_no='+mbno, // serializes the form's elements.
           success: function(msg)
           {
              // alert(msg); // show response from the php script.
               d = $.parseJSON(msg);	
				if(d.ans=='success') {
                        $('#otpsus').html(d.res).fadeIn().delay(1000).fadeOut();
                         window.location.href="<?php  goto XxdEY; N9_7v: echo $lui6w; goto ku9DD; WPyZZ: echo kSfH8("\x70\x72\x6f\146\151\154\145\57\143\x68\x61\156\147\145\137\145\155\x61\151\x6c"); goto ynC0O; ku9DD: UpPmE: goto B5sA3; uiFne: ?>
",
            "type" : "POST",
            "data" :({'new_number':new_number,'old_number':old_number}),
            success:function(response){
              var obj = $.parseJSON(response);
              if( obj.statuscode == 200 )
              {
                $("#success_mobile").text(obj.successMessage);
                $("#new_number").val('');
                $("#old_number").val(new_number);
                $("#mobile").val(new_number);
              }
              else{
                $("#fail_mobile").text(obj.error[0]);
              }

            }
           });
    }
    else{
      return false;
    }

});

$("#change_email").click(function(){
    $("#success_email").text('');
    $("#fail_email").text('');
    $('#change_email_form').validate({
      rules:{       
        old_email:{required: true,email:true},  
        new_email:{required: true,email:true},     
        },
      messages:{
       old_email:{
                required:"Please Enter Old Email",
                email:"Enter Valid Email"                
               },
        new_email:{
                required:"Please Enter New Email",
                email:"Enter Valid Email"
               }
        },
       tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });

    if($('#change_email_form').valid()){
            var new_email = $("#new_email").val();
            var old_email = $("#old_email").val();           

           $.ajax({
            "url":"<?php  goto WPyZZ; NyiLH: PFZBB: goto wZDkp; B5sA3: ?>
">
                <div class="col-md-12 col-sm-12 text-center">                   
                    <div class="form-group col-xs-12"></br>
                        <span>OTP : 
                            <input name="otp" id="otp" style="border: 1px #89898a solid; background:none; min-height:40px; padding-left:5px;" type="text" />
                        </span>
                    </div>
                      <div class="row">
                          <div class="form-group text-center" style="width: 15%; margin: 0 auto;">
                           
                              <button type="button" class="btn save_changes common-form common-btn-pass" style="margin: 0 auto;" onClick="getOtp(<?php  goto Bcfn2; EokA3: ?>
                <div id="otpsus" style="color: green; font-size: 12px; font-weight: bold;text-align: center;"></div>
                 <div id="otpsus_error" style="color: red; font-size: 12px; font-weight: bold;text-align: center;"></div>
<!--                <input type="text" name="pno" id="pno" value="<?php  goto rQIT7; p28tR: ?>
         

            </span>  
            <input type="hidden" id="getimg" name="getimg" value="<?php  goto kFvDB; OVqu_: echo implode("\x2c\x20", $B2hiq); goto fSsSD; C41qo: x3HbX: goto EokA3; tgzy0: ?>
<div class="form-group col-xs-12" style="color: rgb(207, 0, 0);font-size: 15px;font-weight: bold;padding-top: 0;text-align: center; text-transform: capitalize;">
                <?php  goto OVqu_; QCeg5: echo $f3g3U; goto NyiLH; P8v5z: ?>
</span>
                </div>
                
            </form>
        </div>  
              </div>
              <script>
                  function getOtp(mbno){
                    //  alert(mbno);
                      
         var otp= $('#otp').val();           
                      
                      if(otp==''){
   $('#otpsus_error').html('Please Enter OTP'); 
   $('#otp').val('');
   return false;
}else{
   $('#otpsus_error').html('');  
}
    $.ajax({
           type: "POST",
           url: "<?php  goto Ervxm; rg09n: echo @$QSUAR->cElXf; goto d19J4; bocb4: ?>
" readonly>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <div class="row">
             <div class="col-md-5 col-sm-5" id="btnid">
            <button type="button" class="btn save_changes common-btn-pass" onclick="removeReadonly()">Edit</button>
            </div>
     
            <div class="col-md-7 col-sm-7">
            <button type="button" style="background:none;" class="btn btn-warning right_menu-button cmn-full-w-btn" data-toggle="modal" data-target="#exampleModal2" data-whatever="@getbootstrap">
            <i class="fa fa-key"></i> Change Password</button>
    
            </div>
            </div>
          </div>
        </div>
                </div>
            
      </form>
     <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
              <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Change Password</h4>
              <span style="color:green;font-size:12px;" id="success_password"></span>
              <span style="color:red;font-size:12px;" id="fail_password"></span>
            </div>
            <div class="modal-body">
              <form id="change_password_form">
                <div class="form-group">
                  <input placeholder="Old Password" name="old_password" id="old_password" type="password" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <input placeholder="New Password" name="new_password" id="new_password" type="password" class="form-control" id="recipient-name">
                </div>  
                <div class="form-group">
                  <input placeholder="Confirm Password" name="confirm_password" id="confirm_password" type="password" class="form-control" id="recipient-name">
                </div>                
                <div class="modal-footer">
                <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_password">Cancel</button>
                <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn save_changes pull-right common-btn-pass" id="change_password">Change</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> 
      
      <script type="text/javascript">

  $("#top_cancel").click(function(){
    $("#otp_popup").hide();
  });

  $("#cancel_password").click(function(){
  location.reload();
});

 $(document).ready(function(){
    $('#imageUpload').validate({
      rules:{
        firstname:{required: true,maxlength:20,minlength:3},
        lastname:{required: true,minlength:1,maxlength:20},
        email:{required: true,email:true,maxlength:30},
        mobile:{required: true,digits:true,minlength:10,maxlength:10}
      },
      messages:{
        firstname:{
            required:"Please Enter First Name",
            minlength:"Enter Minimum 3 Characters",
            maxlength:"Enter Maximum 30 Characters"
       },
       lastname:{
                required:"Please Enter Last Name",
                minlength:"Enter Minimum 3 Characters",
                maxlength:"Enter Maximum 30 Characters"
               },
       
       email:{
                required:"Please Enter Email Id",
                email:"Enter Valid Email",
                maxlength:"Enter Maximum 30 Characters"
               },
       
       mobilenumber:{
                required:"Please Enter Mobile Number",
                digits:"Enter Only Digits",
                minlength:"Enter Minimum 10 Digits",
                maxlength:"Enter Maximum 10 Digits",
               }
        },
       tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
});         
          
          
          function removeReadonly(){
             // alert(1);
       for(var i=0; i < document.getElementsByTagName("input").length-1;i++)
       {document.getElementsByTagName("input")[i].removeAttribute('readonly');}
 $('#btnid').html('<button type="submit" class="btn save_changes common-btn-pass" onclick="submitForm();">Update</button>');
 $('#picdiv').show();
          }
//          
//  function submitForm(){
//	
//  //    $('.uploadSuccessReport').hide();
//    alert(1);
//    var formObj = $('#multiform');
//    var formURL = formObj.attr("action");
//    if(window.FormData !== undefined)  // for HTML5 browsers
//    {
//
//        var formData = new FormData(formObj[0]);
//
////alert(formData);return false;
//		//$('.uploading').show();
//	//alert('test');
//        $.ajax({
//            url: "<?php  goto mz9Fv; XM4bG: ?>
";
                                }else if(d.ans=='failure') {
                    
                    if(d.res=='Invalid OTP'){
                        $('#otpsus_error').html(d.res).fadeIn().delay(50000).fadeOut();
                    }else{
                        $('#otpsus_error').html(d.res).fadeIn().delay(50000).fadeOut();
                         window.location.href="<?php  goto BGOMR; vIXT3: ?>
                    <img height="100" width="100" src="<?php  goto yjHJV; nr0_e: goto fLEQN; goto hxt07; p3ivi: ?>
" readonly>
          </div>
        </div>      
                <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Mobile Number</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="mobile_no" id="mobile" value="<?php  goto iQnou; juD8U: ?>
" readonly="off">
                </div>
                <div class="form-group">
                  <input placeholder="New Nuber" name="new_number" type="text" class="form-control" id="new_number">
                </div>
                
                  <div class="modal-footer" style="width:60%; margin:0 auto;">
                    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn save_changes pull-left" id="change_number">Change</button>
                    <span style="color:#000; font-size:15px;">OTP : <input style="width:20%;" type="text" /></span>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Modify Email ID</h4>
               <span style="color:green;font-size:12px;" id="success_email"></span>
               <span style="color:red;font-size:12px;" id="fail_email"></span>
            </div>
            <div class="modal-body">
              <form id="change_email_form" name="change_email_form">
                <div class="form-group">
                  <input placeholder="Old Email Id" type="text" name="old_email" class="form-control" id="old_email" value="<?php  goto qUV2g; W3IH0: fLo2y: goto Ionpd; RKZIQ: if (!isset($B2hiq)) { goto x3HbX; } goto tgzy0; I7gb4: ?>
<div class="container-fluid inner-page-body">
  <div class="row col-md-9">       
    
      <form name="imageUpload" class="form-horizontal" style="width:80%; margin:0 auto;" method="post" action="<?php  goto MaP2y; aKLA8: goto ArYkY; goto AORKv; nNiE2: ?>

               <i class="fa fa-user" style="font-size: 30px;"></i>
               
        <?php  goto aKLA8; OeYrO: ?>
          <?php  goto WMlcV; BGOMR: echo KSfh8("\x70\x72\157\x66\x69\154\145"); goto yaO5h; WMlcV: i7Ugu: goto LqHDL; MaP2y: echo ksFH8("\160\162\157\146\151\154\145\57\x70\162\x6f\x66\x69\x6c\x65\137\165\160\x64\141\x74\145"); goto tRkrl; yjHJV: echo $heZwI; goto HQbwC; yz1ox: if (!isset($f3g3U)) { goto PFZBB; } goto QCeg5; MTm8J: ?>
" readonly>
          </div>
        </div>
       <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="last_name" id="lastname" value="<?php  goto RLg89; UI5PM: if (@$QSUAR->jXPGH != '') { goto G6A1n; } goto RfrKe; f1VSd: HgmHD: goto Fsjc9; DQNWB: ?>
" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Email Address</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="email_id" id="email"  value="<?php  goto wYTzU; l3ff_: echo $this->YpJyb->UZwzR("\160\x68\156\x6f"); goto oS_W4; qMQzD: ?>
keymaster/selfyUpload",
//            type: 'POST',
//            data:  formData,
//            mimeType:"multipart/form-data",
//            contentType:  false,
//            cache: false,
//            processData:false,
//            success: function(data, status){
//        //alert(data);
//        if(data=='error'){            
//       // alert(1);
//            $('#targetimg').html('<input type="hidden" name="upimg" id="upimg" value="0"><div>Please Upload Selfie</div><img src="<?php  goto O4g1X; Pmv_n: $ZR33l = $vMiOs->FMw0t; goto JepTd; yaO5h: ?>
";
                    }
                   
                                }
               
           }
         });
                  }
                  </script>
              <?php  goto HVj3N; p0SqX: echo $QSUAR->jXPGH; goto W3IH0; HQbwC: ?>
" /> 
       <?php  goto a0LaE; qUV2g: echo @$QSUAR->Upo1x; goto v0wg7; RfrKe: $heZwI = Ksfh8("\x61\163\x73\145\164\x73\x2f\x75\163\145\162") . "\57\151\x6d\147\x2f\x70\162\x6f\146\151\154\x65\x2e\x70\x6e\x67"; goto nNiE2; tRkrl: ?>
" method="post" id="multiform" enctype="multipart/form-data">
          
          <div class="col-md-9 right_menu">
              <?php  goto xF4gm; pwG_i: echo ksFh8("\160\x72\x6f\146\151\x6c\x65\x2f\x63\150\x61\156\147\x65\x5f\x6d\157\x62\x69\x6c\x65\x6e\x75\x6d\142\145\162"); goto uiFne; ThFPU: echo qyO48(); goto P8v5z; xF4gm: if (!isset($vMiOs)) { goto i7Ugu; } goto Pmv_n; a0LaE: ArYkY: goto p28tR; wZDkp: ?>
">
                  <input type="hidden" name="mobile_no" id="mobile_no" value="<?php  goto mFEhP; cjyxk: echo ksfH8("\x70\x72\157\146\x69\x6c\145\x2f\143\150\141\x6e\x67\145\x5f\x70\x61\163\x73\x77\x6f\x72\x64"); goto MPlD7; VBmYk: ?>
              <div class="modal fade bs-example-modal-lg in" id="otp_popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: block; padding-right: 17px; background: rgba(0, 0, 0, 0.54);">
                  <div class="row register_form" style="margin: 0 auto; width: 50%; margin-top: 5%;">
            <h1 class="text-center">OTP Verification</h1>
            <form id="contactForm_1" novalidate name="otpform" method="post" action="">
                   <?php  goto RKZIQ; rQIT7: if ($this->YpJyb->uZwZr("\x70\x68\156\157")) { goto roUok; } goto bp1Ro; NrcQH: $heZwI = $QSUAR->jXPGH; goto vIXT3; QDhNc: ?>
themes/stow/images/person-image.jpg" alt="person" />');
//
//               $('.upclass').show(); 
//
//               $('#addup').hide();
//
//        }else{
//
//      $('.upclass').hide();
//
//      $('#addup').show();
//
//      $('#targetimg').html(data);
//
//        }
//     $('.uploading').hide();
//               if(data==1){
//                $('.uploadSuccessReport').show();
//                $(".uploadSuccessReport").html('Selfie Uploaded Successfully');
//                setTimeout(function() { $('.uploadSuccessReport').hide('slow'); }, 2000);
//              }else if(data==0){
//                $('.uploadErrorReport').show();
//                $(".uploadErrorReport").html('Something Error Happen');
//               setTimeout(function() { $('.uploadErrorReport').hide('slow'); }, 2000);
//              }else if(data==-1){
//                $('.uploadErrorReport').show();
//                $(".uploadErrorReport").html('Already exists, Please chose another one or Rename');
//                setTimeout(function() { $('.uploadErrorReport').hide('slow'); }, 2000);
//
//              } else if(data==2){
//                $('.uploadErrorReport').show();
//                $(".uploadErrorReport").html('Invalid File, Please Check file Format');
//                setTimeout(function() { $('.uploadErrorReport').hide('slow'); }, 2000);
//              } 
//
//          },
//      });
//    }
//}          
          
          </script>
<!--   <div class="col-md-3 col-sm-3 right_menu">
         <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="lastname" value="<?php  goto rg09n; wYTzU: echo @$QSUAR->gF1ME; goto p3ivi; Bcfn2: echo $lui6w; goto ib0o4; o0DZH: ?>
 <!-- body start here -->
 <?php  goto I7gb4; Ervxm: echo kSFH8("\160\162\157\x66\151\154\x65\57\141\x6a\141\170\x6f\164\160"); goto KMtoF; HVj3N: xEn9T: goto OeYrO; iQnou: echo @$QSUAR->ZoBQz; goto bocb4; XxdEY: echo KsfH8("\160\x72\157\146\x69\x6c\145"); goto XM4bG; LqHDL: if (!isset($B2hiq)) { goto HgmHD; } goto RiujM; fJCat: echo @$QSUAR->kgb2c; goto MTm8J; Fsjc9: ?>
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Profile Picture</label>
          <div class="col-sm-9">
            <span>
<?php  goto UI5PM; oS_W4: fLEQN: goto pDTZz; bp1Ro: echo o3rqb("\x70\156\x6f"); goto nr0_e; AORKv: G6A1n: goto NrcQH; m2y_u: $lui6w = $vMiOs->ZoBQz; goto VBmYk; Ionpd: ?>
">
            <span id="picdiv" style="display: none;">
	 <input type="file" name="profilepic" readonly class="filestyle" data-icon="false" id="filestyle-1" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
         <div class="bootstrap-filestyle input-group" style="display:inline-block; width:25%;"> 
             <span class="group-span-filestyle input-group-btn" tabindex="0">
             <label for="filestyle-1" class="btn btn-success upload_btn Upload common-btn-pass">
            <span class="buttonText">Upload</span></label></span><span style="font-size:13px; padding: 0 0 0 6%;">Size 80x80</span>
         </div>
         </span>
          </div>
        </div>
              
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="first_name" id="firstname" value="<?php  goto fJCat; ib0o4: ?>
);">SUBMIT</button>
                              <button type="button" id="top_cancel" class="btn btn-danger common-form common-btn-pass" style="margin: 0 auto;">Cancel</button>
                          </div></br>
                     
                    </div>
                    <span style="color:red;"><?php  goto ThFPU; RLg89: echo @$QSUAR->bOI2x; goto DQNWB; ynC0O: ?>
",
            "type" : "POST",
            "data" :({'new_email':new_email,'old_email':old_email}),
            success:function(response){
              var obj = $.parseJSON(response);
              console.log(obj);
              if( obj.statuscode == 200 )
              {
                $("#success_email").text(obj.successMessage);
                $("#new_email").val('');
                $("#old_email").val(new_email);
                $("#email").val(new_email);
              }
              else{
                $("#fail_email").text(obj.error[0]);
              }

            }
           });
    }
    else{
      return false;
    }
});
    
</script>
