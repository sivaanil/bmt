
              <div class="col-md-9 right_menu">
           
              <?php //echo "<pre>"; print_r($user);?>
               <?php //echo "<pre>";print_r($user);
           
              if(@$user->profile_img!=''){
                  $pimg=$user->profile_img;
              }else{
               $pimg=base_url('assets/user').'/img/profile.png';
              }
              if(isset($msg)){
                  echo "<span style='color: #13CC13;margin-left: 24%;'>".$msg."</span>";
              }
            
                 ?>
            <form name="imageUpload" class="form-horizontal" style="width:80%; margin:0 auto;" method="post" action="<?php echo base_url('tolloperator/profile_update');?>" method="post" id="multiform" enctype="multipart/form-data">
                  <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Profile Picture</label>
          <div class="col-sm-9">
            <span><img src="<?php echo $pimg;?>" /></span>  
            <input type="hidden" id="getimg" name="getimg" value="<?php if(@$user->profile_img!=''){echo $pimg=$user->profile_img;}?>">
	 <input type="file" name="profilepic" readonly class="filestyle" data-icon="false" id="filestyle-1" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group" style="display:inline-block; width:25%;"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-1" class="btn btn-default upload_btn"><span class="buttonText">Upload</span></label></span><span style="font-size:13px; padding: 0 0 0 6%;">Size 80x80</span></div>
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
            <input type="text" class="form-control" name="mobile_no" id="mobile" value="<?php echo @$user->mobile_no;?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <div class="row">
             <div class="col-md-5 col-sm-5" id="btnid">
            <button type="button" class="btn save_changes" onclick="removeReadonly()">Edit</button>
            </div>
     
            <div class="col-md-7 col-sm-7">
              <button type="button" style="background:none;" class="btn btn-warning right_menu-button" data-toggle="modal" data-target="#exampleModal2" data-whatever="@getbootstrap"><i class="fa fa-key"></i> Change Password</button>
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
            <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_password">Cancel</button>
            <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn save_changes pull-right common-btn-pass" id="change_password">Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 
</div>
<script type="text/javascript">
   $("#cancel_single_password").click(function(){
    location.reload();
  });
      function removeReadonly(){
        //alert(document.getElementsByTagName("input").length-1);
       for(var i=0; i < document.getElementsByTagName("input").length-1;i++)
       {document.getElementsByTagName("input")[i].removeAttribute('readonly');}
 $('#btnid').html('<button type="submit" class="btn save_changes" onclick="submitForm();">Update</button>');
          }
</script>

<script type="text/javascript">

$("#change_password").click(function(){
  //alert("hiii");
   $("#success_password").text('');
   $("#fail_password").text('');
  $('#change_password_form').validate({
      rules:{       
        old_password:{required: true},  
        new_password:{required: true},
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
            "url":"<?php echo base_url('tollcenter/changepassword');?>",
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
</script>