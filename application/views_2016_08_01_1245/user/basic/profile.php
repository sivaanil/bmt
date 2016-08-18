 <!-- body start here -->
 <?php 
 /*echo "<pre>";
print_r($user);exit;*/

 ?>
<div class="container-fluid inner-page-body">
  <div class="row col-md-9">       
    
      <form name="imageUpload" class="form-horizontal" style="width:80%; margin:0 auto;" method="post" action="<?php echo base_url('profile/profile_update');?>" method="post" id="multiform" enctype="multipart/form-data">
          
          <div class="col-md-9 right_menu">
              <?php //echo "<pre>";print_r($user);
              
              if(isset($mstatus)){
                // echo "<pre>"; print_r($mstatus);
                  $ms=$mstatus->mstatus;
                 if($ms==1){
                     $mobile_no=$mstatus->mobile_no;
                 ?>
              <div class="modal fade bs-example-modal-lg in" id="otp_popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: block; padding-right: 17px; background: rgba(0, 0, 0, 0.54);">
                  <div class="row register_form" style="margin: 0 auto; width: 50%; margin-top: 5%;">
            <h1 class="text-center">OTP Verification</h1>
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
                  <input type="hidden" name="mobile_no" id="mobile_no" value="<?php if(isset($mobile_no)){echo $mobile_no;}?>">
                <div class="col-md-12 col-sm-12 text-center">                   
                    <div class="form-group col-xs-12"></br>
                        <span>OTP : 
                            <input name="otp" id="otp" style="border: 1px #89898a solid; background:none; min-height:40px; padding-left:5px;" type="text" />
                        </span>
                    </div>
                      <div class="row">
                          <div class="form-group text-center" style="width: 15%; margin: 0 auto;">
                           
                              <button type="button" class="btn save_changes common-form common-btn-pass" style="margin: 0 auto;" onClick="getOtp(<?php echo $mobile_no;?>);">SUBMIT</button>
                              <button type="button" id="top_cancel" class="btn btn-danger common-form common-btn-pass" style="margin: 0 auto;">Cancel</button>
                          </div></br>
                     
                    </div>
                    <span style="color:red;"><?php echo validation_errors(); ?></span>
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
           url: "<?php echo base_url('profile/ajaxotp');?>",
           data: 'otp='+otp+'&mobile_no='+mbno, // serializes the form's elements.
           success: function(msg)
           {
              // alert(msg); // show response from the php script.
               d = $.parseJSON(msg);	
				if(d.ans=='success') {
                        $('#otpsus').html(d.res).fadeIn().delay(1000).fadeOut();
                         window.location.href="<?php echo base_url('profile');?>";
                                }else if(d.ans=='failure') {
                    
                    if(d.res=='Invalid OTP'){
                        $('#otpsus_error').html(d.res).fadeIn().delay(50000).fadeOut();
                    }else{
                        $('#otpsus_error').html(d.res).fadeIn().delay(50000).fadeOut();
                         window.location.href="<?php echo base_url('profile');?>";
                    }
                   
                                }
               
           }
         });
                  }
                  </script>
              <?php }?>
          <?php   //    $mb=$mstatus->mobile_no;
              }
              if(isset($error)){
                 // echo "hi";
                echo "<span style='color:red;font-size:13px;'>".$error."</span>";
                 //echo "<pre>"; print_r($error);
              }
              
              ?>
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Profile Picture</label>
          <div class="col-sm-9">
            <span>
<?php if(@$user->profile_image!=''){
                  $pimg=$user->profile_image;?>
                    <img height="100" width="100" src="<?php echo $pimg;?>" /> 
       <?php        }else{
               $pimg=base_url('assets/user').'/img/profile.png';?>

               <i class="fa fa-user" style="font-size: 30px;"></i>
               
        <?php      }?>
         

            </span>  
            <input type="hidden" id="getimg" name="getimg" value="<?php if(@$user->profile_image!=''){echo $user->profile_image;}?>">
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
            <input type="text" class="form-control" name="first_name" id="firstname" value="<?php echo @$user->first_name;?>" readonly>
          </div>
        </div>
       <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="last_name" id="lastname" value="<?php echo @$user->last_name;?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Email Address</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="email_id" id="email"  value="<?php echo @$user->email_id;?>" readonly>
          </div>
        </div>      
                <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Mobile Number</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="mobile_no" id="mobile" value="<?php echo @$user->mobile_no;?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <div class="row">
             <div class="col-md-5 col-sm-5" id="btnid">
            <button type="button" class="btn save_changes common-btn-pass" onclick="removeReadonly()">Edit</button>
            </div>
     
            <div class="col-md-7 col-sm-7">
            <button type="button" style="background:none; color: #ffa800;" class="btn btn-warning right_menu-button cmn-full-w-btn" data-toggle="modal" data-target="#exampleModal2" data-whatever="@getbootstrap">
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
//            url: "<?php echo base_url('profile/imageupload'); ?>keymaster/selfyUpload",
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
//            $('#targetimg').html('<input type="hidden" name="upimg" id="upimg" value="0"><div>Please Upload Selfie</div><img src="<?php echo base_url();?>themes/stow/images/person-image.jpg" alt="person" />');
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
            <input type="text" class="form-control" id="lastname" value="<?php echo @$user->LastName;?>">
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
                  <input placeholder="Old Number" name="old_number" type="text" class="form-control" id="old_number" value="<?php echo @$user->MobileNumber;?>" readonly="off">
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
                  <input placeholder="Old Email Id" type="text" name="old_email" class="form-control" id="old_email" value="<?php echo @$user->EmailID;?>">
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
            "url":"<?php echo base_url('profile/change_password');?>",
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
            "url":"<?php echo base_url('profile/change_mobilenumber');?>",
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
            "url":"<?php echo base_url('profile/change_email');?>",
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
