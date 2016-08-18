<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto FDo1m; k7Pfi: echo $N_MOk->Nb6y_; goto rwRRH; RU9De: KMO_X: goto UQyVI; XsCm7: ?>
    <select style="color:#0C0C0C;" class="form-control" id="toll_center_name_single" name="toll_center_name" onchange="gettcn_single()">
      <option value="<?php  goto zVSZ0; VhGqA: ?>
    <select  style="color:#0C0C0C;" class="form-control" id="toll_center_loaction_single" name="toll_center_loaction" onchange="getcentername_single()">
      <option value="<?php  goto d5rv_; Gxfb7: ?>
" placeholder="First Name">
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="last_name_single" name="last_name" value="<?php  goto uKh68; Bk3pv: JKP5G: goto TYjOe; r2qTx: ?>
" placeholder="Last Name">
  </div>
  <?php  goto eow2t; t_2I3: ?>
" placeholder="Email ID">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="mobile_number_single" name="mobile_number" value="<?php  goto bUqmT; gEHCB: ?>
  <div class="form-group">
    <input type="text" class="form-control" id="eamil_single" name="eamil" value="<?php  goto im1E2; Gy2Ga: ?>
</option>
    </select>
    <?php  goto Bk3pv; im1E2: echo @$N_MOk->gF1ME; goto t_2I3; yXAsr: echo KSFH8("\164\x6f\154\x6c\x63\145\156\164\x65\162\x2f\x75\160\x64\141\x73\145\155\x69\x61\x64\x6d\x69\156\x64\145\x74\141\x69\x6c\x73"); goto VqbUX; E40Np: echo "\x73\x65\x6c\145\143\164\x65\144"; goto ARwu5; BBwqS: ?>
";
                //alert(tl_val);
               if(r_val == 3)
                 r_val = 'Semi Admin';
               if(r_val == 2)
                 r_val = 'Admin';
               $('#exampleModal').modal('hide');
               $("#name_"+toll_id).text(name);
               $("#role_"+toll_id).text(r_val);
               $("#email_"+toll_id).text(email);
               $("#mn_"+toll_id).text(mobile);
             
                alertify.success(data.successMessage);
              }
              else{
                 //$("#fail").text(data.error);
                 $("#save_toll_venter").attr("disabled",false);
                alertify.error(data.error);
              }
              // var set_make = "<?php  goto qhZak; mgl8o: echo kSFh8("\x74\x6f\154\x6c\x63\x65\x6e\x74\x65\x72\57\x67\145\164\164\x63\x6e"); goto byMFU; wDdcy: ?>
" placeholder="Mobile Number">
  </div>
  <!-- <div class="form-group">
        <input type="text" class="form-control" id="password_single" name="password" value="<?php  goto Pu7Tx; TYjOe: ?>
  </div>
  <div class="form-group">
  <?php  goto G6Dvs; x1y2Z: ?>
"  id="tcn_single" name="tcn" placeholder="TCN" style="background-color: #FFFFFF;" readonly="off">
  </div>
  <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="first_name_single" name="first_name" value="<?php  goto n1IQ0; A0t79: if (!($this->kPg0h == 1)) { goto JKP5G; } goto VhGqA; VqbUX: ?>
",
          "type" : "POST",
          "data" : ({'toll_center_loaction':$("#toll_center_loaction_single").val(),'toll_center_name':$("#toll_center_name_single").val(),'tcn':$("#tcn_single").val(),'first_name':$("#first_name_single").val(),'last_name':$("#last_name_single").val(),'roll':$("#roll_single").val(),'eamil':$("#eamil_single").val(),'mobile_number':$("#mobile_number_single").val(),'password':$("#password_single").val(),'user_id_update':$("#update_id").val()}),
          success:function(response){
            //console.log(response);return false;
              var data = $.parseJSON(response);
             //console.log(data.statuscode);
              if(data.statuscode == 200)
              {
                $("#save_toll_venter").attr("disabled",false);
                var toll_id = $("#update_id").val();
                var f_val  = $("#first_name_single").val();
                var l_val  = $("#last_name_single").val();
                var r_val  = $("#roll_single").val();
                var name   = f_val+' '+l_val;
                var mobile = $("#mobile_number_single").val();
                var email  = $("#eamil_single").val();
                var login_role_id = "<?php  goto DnJD6; n1IQ0: echo @$N_MOk->kgb2c; goto Gxfb7; QLVc3: echo @$N_MOk->HIkuN; goto Gy2Ga; PaY81: if (!(isset($N_MOk->ZyMsC) && @$N_MOk->ZyMsC == 3)) { goto fPvvN; } goto mYG3l; AINgJ: W4Rni: goto gEHCB; dhEnk: ?>
">
  <div class="form-group">
    <?php  goto A0t79; jxtH1: echo @$N_MOk->q9pm2; goto x1y2Z; uKh68: echo @$N_MOk->bOI2x; goto r2qTx; R9LSC: ?>
>Semi Admin</option>
      <option value="2" <?php  goto D2Wk8; vRDXU: ?>
",
            "type" : "POST",
            "data" :({'location_id':location_id}),
            success:function(response){
              $("#toll_center_name_single").append(response);
            }
           });
    }
    else{
      $("#toll_center_name_single").append('<option value="">No Toll Center Names</option>');
    }

    // body...
  }

  function gettcn_single(){
    $("#tcn_single").val('');
    var toll_center_name = $("#toll_center_name_single").val();
    $.ajax({
            "url":"<?php  goto mgl8o; FDo1m: ?>
<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="update_semiadmin" id="update_semiadmin">
  <input type="hidden" name="update_id" id="update_id" value="<?php  goto FUSgi; G6Dvs: if (!($this->kPg0h == 1)) { goto KMO_X; } goto XsCm7; xNKhz: ?>
>Admin</option>
    </select>
  </div>
  <?php  goto AINgJ; eTsor: ?>
  <div class="form-group">
          <!-- <input type="text" class="form-control" id="inputtext3" placeholder="Role"> -->
     <select style="color:#0C0C0C;" class="form-control" id="roll_single" name="roll">
      <option value="3"<?php  goto PaY81; byMFU: ?>
",
            "type" : "POST",
            "data" :({'toll_center_name':toll_center_name}),
            success:function(response){
              var obj = $.parseJSON(response);
              if( obj.statuscode == 200 )
              {
               $("#tcn_single").val(obj.response.tcn_no);
              }
              else{
                $("#error_message").text(obj.error[0]);
              }
            }
          });
  }  
  
  $("#save_toll_venter").click(function(){
      
    $('#update_semiadmin').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:20},
        tcn:{required: true},
        first_name:{required: true,minlength:1,maxlength:30},
        last_name:{required: true,minlength:1,maxlength:20},
        roll:{required: true},
        eamil:{required: true,email:true,minlength:1,maxlength:100},
        mobile_number:{required: true,digits:true,minlength:10,maxlength:10},
        password:{required: true,minlength:1,maxlength:29},
      },
      messages:{
                toll_center_loaction:{
                    required:"Please Enter Toll Center Location",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               toll_center_name:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               first_name:{
                    required:"Please Enter First Name",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               last_name:{
                    required:"Please Enter Last Name",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               roll:{
                    required:"Please Select Role",
               },
               eamil:{
                    required:"Please Enter Email",
                    email:"Enter Valid Email",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               mobile_number:{
                    required:"Please Enter Mobile Number",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 10 Characters",
                    minlength:"Enter Minimum 10 Characters"
               },
               password:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 29 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               tcn:{
                    required:"Please Enter Toll Center Number",
                    maxlength:"Enter Maximum 19 Characters",
               },
              
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if( $('#update_semiadmin').valid()){
        $("#save_toll_venter").attr("disabled",true);
        $.ajax({
          "url"  : "<?php  goto yXAsr; FUSgi: echo @$N_MOk->VF6bB; goto dhEnk; I12Sg: ?>
"><?php  goto QLVc3; qhZak: echo @$StbPw->BFINK->XbSV_->tj1Os; goto wVt2C; UQyVI: ?>
  </div>
  <div class="form-group">
    <div class="form-group">
        <input type="hidden" class="form-control" value="<?php  goto jxtH1; p8Wh7: fPvvN: goto R9LSC; rwRRH: ?>
</option>
    </select>
  <?php  goto RU9De; zVSZ0: echo @$N_MOk->Nb6y_; goto mlMsL; eow2t: if (!($this->kPg0h == 1)) { goto W4Rni; } goto eTsor; ARwu5: ffdUf: goto xNKhz; mYG3l: echo "\x73\145\x6c\145\143\x74\145\x64"; goto p8Wh7; DnJD6: echo $this->kPg0h; goto BBwqS; nK8On: echo KsFh8("\x74\x6f\154\154\143\x65\x6e\164\x65\162\x2f\147\145\x74\164\157\x6c\x6c\143\x65\x6e\x74\145\162\x6e\141\x6d\x65"); goto vRDXU; D2Wk8: if (!(isset($N_MOk->ZyMsC) && @$N_MOk->ZyMsC == 2)) { goto ffdUf; } goto E40Np; bUqmT: echo @$N_MOk->ZoBQz; goto wDdcy; d5rv_: echo $N_MOk->HIkuN; goto I12Sg; Pu7Tx: ?>
" placeholder="Password">
      </div> -->
  <div class="modal-footer">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_edit">Cancel</button>
    <button type="button" id="save_toll_venter" class="btn save_changes pull-right common-btn-pass" style="padding:8px 20px; font-size:12px; font-weight:normal;">Submit</button>
  </div>
  
 </form>
</div>

<script type="text/javascript">
  $("#close_id").click(function(){
    location.reload();
  });
  $("#cancel_single_edit").click(function(){
    location.reload();
  });
  function getcentername_single() {
    $("#tcn_single").val('');
    var location_id = $("#toll_center_loaction_single").val();
    $("#toll_center_name_single").html('');
    if(location_id != '')
    {
      $.ajax({
            "url":"<?php  goto nK8On; mlMsL: ?>
"><?php  goto k7Pfi; wVt2C: ?>
";
  
          }
        });
    }
});
    
</script>
