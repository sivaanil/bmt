<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto hc060; GgrZe: ?>
  <div class="form-group">
    <input type="text" class="form-control" id="eamil_single" name="eamil" value="<?php  goto iN3sU; ypaCj: echo @$StbPw->BFINK->XbSV_->tj1Os; goto diz0G; AQ78U: ?>
" placeholder="Last Name">
  </div>
  <?php  goto olCka; yj3WB: ?>
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
          "url"  : "<?php  goto Y79CL; MN31n: ?>
">
  <div class="form-group">
    <?php  goto eUD5r; CWGio: ?>
  <div class="form-group">
          <!-- <input type="text" class="form-control" id="inputtext3" placeholder="Role"> -->
     <select style="color:#0C0C0C;" class="form-control" id="roll_single" name="roll">
      <option value="3"<?php  goto Pawc3; EVyRo: echo @$N_MOk->Nb6y_; goto Vjym1; w1S3e: echo $this->kPg0h; goto cj14f; iXIrw: ?>
    <select style="color:#0C0C0C;" class="form-control" id="toll_center_name_single" name="toll_center_name" onchange="gettcn_single()">
      <option value="<?php  goto EVyRo; TyOjb: echo @$N_MOk->kgb2c; goto gw8bA; lP20y: OjzKb: goto zOxkI; EQ9ih: echo $N_MOk->HIkuN; goto o2p9D; eUD5r: if (!($this->kPg0h == 1)) { goto vzpNW; } goto p0eh9; zOxkI: ?>
>Semi Admin</option>
      <option value="2" <?php  goto blM5m; Pawc3: if (!(isset($N_MOk->ZyMsC) && @$N_MOk->ZyMsC == 3)) { goto OjzKb; } goto UF85K; ivKi9: echo @$N_MOk->VF6bB; goto MN31n; TVR_P: ?>
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
                var login_role_id = "<?php  goto w1S3e; Wrkze: echo @$N_MOk->bOI2x; goto AQ78U; Vjym1: ?>
"><?php  goto hxQ3q; B5Bmg: echo @$N_MOk->q9pm2; goto SH8Cu; A96Nj: echo @$N_MOk->HIkuN; goto YBZFj; EKJr_: ?>
" placeholder="Email ID">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="mobile_number_single" name="mobile_number" value="<?php  goto gX9ri; iN3sU: echo @$N_MOk->gF1ME; goto EKJr_; Pxduw: ?>
  </div>
  <div class="form-group">
  <?php  goto yF6kr; xU0vb: ?>
  </div>
  <div class="form-group">
    <div class="form-group">
        <input type="hidden" class="form-control" value="<?php  goto B5Bmg; o2p9D: ?>
"><?php  goto A96Nj; p0eh9: ?>
    <select  style="color:#0C0C0C;" class="form-control" id="toll_center_loaction_single" name="toll_center_loaction" onchange="getcentername_single()">
      <option value="<?php  goto EQ9ih; SH8Cu: ?>
"  id="tcn_single" name="tcn" placeholder="TCN" style="background-color: #FFFFFF;" readonly="off">
  </div>
  <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="first_name_single" name="first_name" value="<?php  goto TyOjb; k21oN: rgFxw: goto xU0vb; YIAXD: ?>
" placeholder="Mobile Number">
  </div>
  <!-- <div class="form-group">
        <input type="text" class="form-control" id="password_single" name="password" value="<?php  goto mfixr; blM5m: if (!(isset($N_MOk->ZyMsC) && @$N_MOk->ZyMsC == 2)) { goto x9sDb; } goto vWlpO; P9ORn: echo kSfH8("\x74\157\x6c\x6c\143\145\156\x74\145\x72\57\147\x65\x74\164\143\x6e"); goto yj3WB; UF85K: echo "\x73\x65\154\145\x63\x74\145\x64"; goto lP20y; vookb: NfHc0: goto GgrZe; olCka: if (!($this->kPg0h == 1)) { goto NfHc0; } goto CWGio; cj14f: ?>
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
              // var set_make = "<?php  goto ypaCj; yF6kr: if (!($this->kPg0h == 1)) { goto rgFxw; } goto iXIrw; scBpx: x9sDb: goto Ajfi7; Ajfi7: ?>
>Admin</option>
    </select>
  </div>
  <?php  goto vookb; gX9ri: echo @$N_MOk->ZoBQz; goto YIAXD; Y79CL: echo ksFh8("\x74\x6f\154\154\x63\x65\156\164\x65\162\57\165\x70\144\x61\163\x65\x6d\151\x61\144\155\x69\x6e\144\145\164\x61\x69\x6c\163"); goto TVR_P; hxQ3q: echo $N_MOk->Nb6y_; goto mPL9j; mfixr: ?>
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
            "url":"<?php  goto WETIj; YBZFj: ?>
</option>
    </select>
    <?php  goto MR_eB; VUZtk: ?>
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
            "url":"<?php  goto P9ORn; WETIj: echo KsFh8("\x74\157\x6c\154\143\x65\x6e\x74\145\162\57\x67\x65\x74\x74\157\154\x6c\143\x65\x6e\164\x65\162\x6e\x61\155\145"); goto VUZtk; mPL9j: ?>
</option>
    </select>
  <?php  goto k21oN; vWlpO: echo "\163\145\x6c\145\x63\x74\145\x64"; goto scBpx; MR_eB: vzpNW: goto Pxduw; gw8bA: ?>
" placeholder="First Name">
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="last_name_single" name="last_name" value="<?php  goto Wrkze; hc060: ?>
<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="update_semiadmin" id="update_semiadmin">
  <input type="hidden" name="update_id" id="update_id" value="<?php  goto ivKi9; diz0G: ?>
";
  
          }
        });
    }
});
    
</script>
