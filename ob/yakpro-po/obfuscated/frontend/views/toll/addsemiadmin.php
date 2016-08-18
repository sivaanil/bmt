<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:43              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto ewKM0; F3zF1: echo Ksfh8("\164\x6f\154\154\x63\x65\x6e\x74\145\162\x2f\147\x65\x74\x74\x63\156"); goto ZHKFY; NdRl5: goto hTozd; goto x77HJ; tFgm1: if (isset($I1jpU) && !empty($I1jpU)) { goto JdU72; } goto sZe9O; QzG2b: foreach (@$JNJz0 as $V7w_c => $UoEr0) { goto l7Aei; L_Fpr: MtS96: goto NDut0; nYPzg: ?>
              <a href="javascript:void(0);" onclick="delete_semiadmin('<?php  goto fLnfy; cyJPD: if (!($UoEr0->ZyMsC == 3)) { goto MtS96; } goto p9ejB; l7Aei: ?>
          <tr>
            <td><?php  goto SrlM3; TkSHi: echo $UoEr0->VF6bB; goto s6gCo; EATsJ: $tIuha = "\101\144\155\x69\x6e"; goto fA9nE; wMpl1: JuZaB: goto VI_wp; eAp7F: wLT1S: goto Cc_eD; SrlM3: echo @$UoEr0->HIkuN; goto wa_XV; NDut0: if (!($UoEr0->ZyMsC == 2)) { goto UOLzC; } goto EATsJ; tFXUU: echo "\x41\143\164\151\166\141\164\145"; goto zQdNK; KR8E5: Fu0hY: goto nYPzg; zvWSz: ?>
</td>
            <td>
              <button type="button"  onclick='view_semiadmin("<?php  goto VPXUB; XUQuc: ?>
              <button type="button"  onclick='edit_semiadmin("<?php  goto mwcV0; LXv_5: echo $UoEr0->VF6bB; goto COc_i; lto1D: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
                <?php  goto KR8E5; oo6sJ: echo @$tIuha; goto zvWSz; SzEEl: if (!(isset($UoEr0->oqEhs) && $UoEr0->oqEhs == 0)) { goto wLT1S; } goto ueRIY; g4H8V: ?>
</button></a>
            </td>
          </tr>
        <?php  goto wMpl1; p9ejB: $tIuha = "\123\x65\155\151\x20\101\144\x6d\151\x6e"; goto L_Fpr; fLnfy: echo $UoEr0->VF6bB . "\x2c" . $UoEr0->oqEhs; goto R9TPD; mwcV0: echo $UoEr0->VF6bB; goto lto1D; HOY2Q: echo @$UoEr0->Nb6y_; goto Eud70; ueRIY: echo "\111\156\141\x63\x74\151\x76\141\x74\x65"; goto eAp7F; s6gCo: ?>
"><?php  goto oo6sJ; VPXUB: echo $UoEr0->VF6bB; goto CwQsw; fA9nE: UOLzC: goto Ufgs7; zQdNK: W7Igm: goto g4H8V; Eud70: ?>
</td>
            <td id="name_<?php  goto LXv_5; R9TPD: ?>
')"><button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><?php  goto SzEEl; COc_i: ?>
"><?php  goto wQyD2; wQyD2: echo @$UoEr0->kgb2c . "\x20" . $UoEr0->bOI2x; goto OuD3G; Cc_eD: if (!(isset($UoEr0->oqEhs) && $UoEr0->oqEhs == 1)) { goto W7Igm; } goto tFXUU; CwQsw: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <?php  goto UQgAU; UQgAU: if (!($UoEr0->oqEhs == 0)) { goto Fu0hY; } goto XUQuc; Ufgs7: ?>
            <td id="role_<?php  goto TkSHi; OuD3G: ?>
</td>
            <?php  goto cyJPD; wa_XV: ?>
</td>
            <td><?php  goto HOY2Q; VI_wp: } goto Fc89u; puJfw: goto vLMN5; goto nyfUN; t22eX: ?>
">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_loaction" name="toll_center_loaction" onchange="getcentername()">
        <option value="">Toll Center Location</option>
        <?php  goto tFgm1; enuab: ?>
",
      "type" : "POST",
      "data" : ({'id':id}),
      success:function(response){
        console.log(response);
         $("#pop_view").text("");
       // var data = $.parseJSON(response);
        //console.log(response);return false;
        $("#pop_view").append(response);
        
      }
    });
  }
}
function view_semiadmin(id)
{
  if(id !='')
  {
    $.ajax({
      "url"  : "<?php  goto rX77q; TRobg: ?>
        </select>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_name" name="toll_center_name" onchange="gettcn()">
            <option value="">Toll Center Name</option>
          </select>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="hidden" class="form-control" id="tcn" name="tcn" placeholder="TCN" readonly="off">
        </div>
      </div>
    </div>
    <div class="row">
      <h4 style="padding-left: -1px !important; font-weight:normal;">Semi Admin Details
      </h4>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
        </div>
      </div>
      <!-- <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="" placeholder="Profile Effective Date">
        </div>
      </div> -->
    </div>
      
    <div class="row">
      
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <!-- <input type="text" class="form-control" id="inputtext3" placeholder="Role"> -->
           <select style="margin-top:0; width:100%;" class="form-control" id="roll" name="roll">
            <option value="">Select Role</option>
            <option value="3">Semi Admin</option>
            <option value="2">Admin</option>
          </select>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="eamil" name="eamil" placeholder="Email ID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number">
        </div>
      </div>
    </div>
    <div class="row">
     <div class="col-md-4 col-sm-4">
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      </div>
      
    </div>
    <div class="row">
      <div class="form-group">
        <div class="col-sm-9">
          <div class="row">
           <div class="col-md-6 col-sm-6">
          <button type="submit" class="btn save_changes common-btn-pass">Submit</button>
          </div>
          <div class="col-md-6 col-sm-6 text-left" style="color:#090; font-size:12px;">
            <span style="color:red;"><?php  goto dEYvA; zSa4R: echo $this->YpJyb->uZWzR("\145\162\162\157\x72\155\x73\147"); goto Q3iF5; CWsep: echo KSfH8("\x74\x6f\x6c\x6c\x63\145\156\164\x65\x72\57\144\145\x6c\145\x74\x65\137\163\x65\x6d\x69\141\x64\x6d\151\156"); goto UcZ5L; x77HJ: b1Y7H: goto QzG2b; qGAtO: i20jJ: goto m2512; Q3iF5: ?>
</span>
            <span class="text-center"><?php  goto Ju47S; Ju47S: echo $this->YpJyb->uZWZr("\155\x73\147"); goto G_s4T; dCyi7: echo KSFh8("\x74\157\154\154\143\x65\156\164\145\x72\57\141\144\144\163\x65\155\x69\x61\x64\155\x69\156"); goto t22eX; UZnvx: foreach ($I1jpU as $V7w_c => $UoEr0) { goto n_E2m; tg8Mi: ?>
"><?php  goto PQa_c; UevTB: echo @$UoEr0->q9pm2; goto tg8Mi; n_E2m: ?>
            <option value="<?php  goto UevTB; PQa_c: echo @$UoEr0->HIkuN; goto SSDeB; p0nRN: gv87z: goto WMqBC; SSDeB: ?>
</option>
            <?php  goto p0nRN; WMqBC: } goto qGAtO; rX77q: echo ksFh8("\164\157\154\154\x63\145\x6e\x74\x65\162\57\147\145\x74\x5f\x73\151\x6e\147\154\145\x5f\x73\x65\155\x69\x61\144\155\x69\x6e\x5f\x76\151\145\167"); goto zunW3; m2512: vLMN5: goto TRobg; ST5RB: ?>
      <tr><td colspan="5">No Records Found</td></tr>
      <?php  goto NdRl5; jChpA: echo KsfH8("\164\157\154\154\x63\x65\156\164\145\x72\x2f\147\x65\164\137\163\x69\x6e\x67\154\145\137\x73\145\155\151\141\144\155\151\x6e"); goto enuab; ykxTq: ?>
</span>
            <span id="error_message" class="text-center won_error"><?php  goto zSa4R; Wp1R5: hTozd: goto bY1r9; zunW3: ?>
",
      "type" : "POST",
      "data" : ({'id':id}),
      success:function(response){
        console.log(response);
         $("#pop_view").text("");
       // var data = $.parseJSON(response);
        //console.log(response);return false;
        $("#pop_view").append(response);
        
      }
    });
  }
}
function delete_semiadmin(id)
{
  var res = id.split(",");
  var id = res[0];
  var status = res[1];
  alertify.confirm("Are You Sure ,You Want To Change The Status?", function (e) {
  if (e) {
            window.location.href = "<?php  goto CWsep; rky6q: ?>
",
            "type" : "POST",
            "data" :({'location_id':location_id}),
            success:function(response){
              $("#toll_center_name").append(response);
            }
           });
    }
    else{
      $("#toll_center_name").append('<option value="">Toll Center is InActive</option>');
    }

    // body...
  }

  function gettcn(){
    $("#tcn").val('');
    var toll_center_name = $("#toll_center_name").val();
    //alert(toll_center_name);
    $.ajax({
            "url":"<?php  goto F3zF1; sZe9O: ?>
          <option value="">NO Toll Center Location</option>
          <?php  goto puJfw; dXR_A: if (isset($JNJz0) && !empty($JNJz0)) { goto b1Y7H; } goto ST5RB; G_s4T: ?>
</span>
            
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row text-center" style="color:#090;"></div>
   </form>
    
  <div class="row">
    <table class="table" style="width:90%; margin-left:5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <th>Toll Center Location</th>
          <th>Toll Center Name</th>
          <th>Name</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php  goto dXR_A; nyfUN: JdU72: goto UZnvx; Fc89u: eT3E5: goto Wp1R5; ewKM0: ?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addsemiadmin" name="addsemiadmin" action="<?php  goto dCyi7; mKUqV: echo kSFH8("\x74\x6f\154\154\143\145\x6e\x74\145\x72\57\x67\145\x74\164\157\x6c\154\x63\x65\x6e\x74\145\162\156\x61\155\x65"); goto rky6q; ZHKFY: ?>
",
            "type" : "POST",
            "data" :({'toll_center_name':toll_center_name}),
            success:function(response){
              var obj = $.parseJSON(response);
              if( obj.statuscode == 200 )
              {
               $("#tcn").val(obj.response.tc_id);
              }
              else{
                $("#error_message").text(obj.error[0]);
              }
            }
          });
  }

$(document).ready(function(){
    $('#addsemiadmin').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:20},
        first_name:{required: true,minlength:1,maxlength:30},
        last_name:{required: true,minlength:1,maxlength:20},
        roll:{required: true},
        eamil:{required: true,email:true,minlength:1,maxlength:100},
        mobile_number:{required: true,digits:true,minlength:10,maxlength:10},
        password:{required: true,minlength:1,maxlength:29},
        tcn:{required: true},
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
                    maxlength:"Enter Maximum 10 Digits",
                    minlength:"Enter Minimum 10 Digits"
               },
               password:{
                    required:"Please Enter Password",
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
});
function edit_semiadmin(id)
{
  if(id !='')
  {
    $.ajax({
      "url"  : "<?php  goto jChpA; bY1r9: ?>
      </tbody>
    </table>
  </div>              
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="pop_view" style="color:#000; font-weight:normal;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
      </div>
      
    </div>
  </div>
</div>

<script>
  function getcentername() {
    var location_id = $("#toll_center_loaction").val();
    $("#tcn").val('');
    $("#toll_center_name").html('');
    if(location_id != '')
    {
      $.ajax({
            "url":"<?php  goto mKUqV; dEYvA: echo Qyo48(); goto ykxTq; UcZ5L: ?>
/"+id+"/"+status;
        }
    });
}
</script>
