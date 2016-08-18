<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto AXFSQ; hzkbv: foreach ($I1jpU as $V7w_c => $UoEr0) { goto JIuH0; lHJDY: ?>
</option>
            <?php  goto YiFpx; YiFpx: QFIlH: goto Q5gAB; n0Yle: ?>
"><?php  goto bKXWS; JIuH0: ?>
            <option value="<?php  goto w9IKH; w9IKH: echo @$UoEr0->q9pm2; goto n0Yle; bKXWS: echo @$UoEr0->HIkuN; goto lHJDY; Q5gAB: } goto b0NLC; BUwbS: ?>
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
      "url"  : "<?php  goto JFDzi; B_VF0: echo KsfH8("\x74\x6f\x6c\154\143\145\x6e\x74\x65\x72\57\x67\145\x74\164\157\x6c\x6c\143\145\x6e\164\145\x72\156\x61\x6d\145"); goto WxN6N; EwxTq: ?>
">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_loaction" name="toll_center_loaction" onchange="getcentername()">
        <option value="">Toll Center Location</option>
        <?php  goto mCO8O; B3zGb: ?>
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
      "url"  : "<?php  goto yzBZI; wRU6c: echo qyo48(); goto kK11q; Xoox4: ?>
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
            window.location.href = "<?php  goto UnxAA; mCO8O: if (isset($I1jpU) && !empty($I1jpU)) { goto NKsx6; } goto sZoKh; AXFSQ: ?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addsemiadmin" name="addsemiadmin" action="<?php  goto G2qtl; x5akc: foreach (@$JNJz0 as $V7w_c => $UoEr0) { goto PF0Z3; gsx_5: echo @$tIuha; goto sL3rs; q31_R: $tIuha = "\x53\145\155\x69\40\101\x64\x6d\151\156"; goto z28Sg; pWEY1: ?>
</td>
            <td><?php  goto lEz1Z; aeSgx: ?>
</td>
            <?php  goto P38YR; c_X0z: ?>
              <a href="javascript:void(0);" onclick="delete_semiadmin('<?php  goto z5Gbp; It5jy: echo @$UoEr0->Nb6y_; goto pWEY1; ZHTdX: ?>
')"><button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><?php  goto c7clr; Wmpwi: ?>
            <td><?php  goto gsx_5; JSKyg: echo $UoEr0->VF6bB; goto kNNfd; JKfsq: if (!(isset($UoEr0->oqEhs) && $UoEr0->oqEhs == 1)) { goto H8vrX; } goto JyvM2; XNEyM: if (!($UoEr0->ZyMsC == 2)) { goto Eu5LP; } goto h2GqL; z28Sg: rYtms: goto XNEyM; h2GqL: $tIuha = "\101\x64\155\x69\156"; goto HoCGM; vcOF9: H8vrX: goto u_Vo9; ZqTy6: ?>
</td>
            <td><?php  goto It5jy; PF0Z3: ?>
          <tr>
            <td><?php  goto lbK0c; JyvM2: echo "\x41\143\164\x69\166\145"; goto vcOF9; c7clr: if (!(isset($UoEr0->oqEhs) && $UoEr0->oqEhs == 0)) { goto TdsZd; } goto XAKqu; ZPUsA: if (!($UoEr0->oqEhs == 0)) { goto TjTlK; } goto TDVHE; HoCGM: Eu5LP: goto Wmpwi; P38YR: if (!($UoEr0->ZyMsC == 3)) { goto rYtms; } goto q31_R; sL3rs: ?>
</td>
            <td>
              <button type="button"  onclick='view_semiadmin("<?php  goto nNZtX; u_Vo9: ?>
</button></a>
            </td>
          </tr>
        <?php  goto QVWsG; XAKqu: echo "\111\x6e\141\x63\164\151\166\145"; goto e6W1e; S7ZKu: TjTlK: goto c_X0z; e6W1e: TdsZd: goto JKfsq; z5Gbp: echo $UoEr0->VF6bB . "\54" . $UoEr0->oqEhs; goto ZHTdX; kNNfd: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
                <?php  goto S7ZKu; nNZtX: echo $UoEr0->VF6bB; goto kGdTz; lbK0c: echo @$UoEr0->HIkuN; goto ZqTy6; TDVHE: ?>
              <button type="button"  onclick='edit_semiadmin("<?php  goto JSKyg; lEz1Z: echo @$UoEr0->kgb2c . "\40" . $UoEr0->bOI2x; goto aeSgx; QVWsG: e2EDA: goto zWD_g; kGdTz: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <?php  goto ZPUsA; zWD_g: } goto Md_Km; WxN6N: ?>
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
            "url":"<?php  goto lhwLX; iH27v: JiROg: goto U1KVt; HOj3s: goto J6D4S; goto NtvXz; Md_Km: mg6kq: goto tFdev; G2qtl: echo ksfh8("\164\x6f\154\x6c\x63\x65\156\164\x65\x72\57\141\144\144\x73\145\x6d\x69\141\144\x6d\151\156"); goto EwxTq; tFdev: J6D4S: goto QUWA3; UnxAA: echo KsFh8("\164\x6f\x6c\x6c\143\x65\x6e\x74\x65\162\57\x64\145\154\145\x74\145\x5f\x73\145\x6d\151\141\144\x6d\x69\x6e"); goto TMOPA; U1KVt: ?>
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
            <span style="color:red;"><?php  goto wRU6c; GB9nn: if (isset($JNJz0) && !empty($JNJz0)) { goto mz59d; } goto bGXZi; VuQI6: ?>
</span>
            <span class="text-center"><?php  goto FNxtW; QlMI5: NKsx6: goto hzkbv; sZoKh: ?>
          <option value="">NO Toll Center Location</option>
          <?php  goto aMETl; kK11q: ?>
</span>
            <span id="error_message" class="text-center won_error"><?php  goto ZOSbM; b0NLC: EhWVu: goto iH27v; QUWA3: ?>
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
            "url":"<?php  goto B_VF0; JFDzi: echo KsfH8("\x74\157\154\x6c\143\145\156\164\145\162\57\147\145\x74\137\x73\151\x6e\x67\x6c\145\137\x73\145\x6d\x69\x61\x64\155\151\156\137\x76\151\x65\x77"); goto Xoox4; ZOSbM: echo $this->YpJyb->UzWzR("\x65\162\162\157\x72\x6d\163\x67"); goto VuQI6; NtvXz: mz59d: goto x5akc; bV96S: ?>
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
      <?php  goto GB9nn; lhwLX: echo kSFH8("\x74\x6f\154\154\143\145\156\164\145\162\x2f\147\145\164\x74\x63\x6e"); goto B3zGb; aMETl: goto JiROg; goto QlMI5; yzBZI: echo KSfH8("\x74\157\154\x6c\x63\145\x6e\x74\145\x72\x2f\x67\145\164\137\163\x69\156\147\x6c\145\137\x73\145\x6d\x69\x61\144\x6d\x69\156"); goto BUwbS; FNxtW: echo $this->YpJyb->uzWZr("\x6d\x73\147"); goto bV96S; bGXZi: ?>
      <tr><td colspan="5">No Records Found</td></tr>
      <?php  goto HOj3s; TMOPA: ?>
/"+id+"/"+status;
        }
    });
}
</script>
