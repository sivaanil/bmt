<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto R2DDM; UFiRC: goto jQmdi; goto HdtcG; j0e4V: if (isset($JNJz0) && !empty($JNJz0)) { goto G6Q3H; } goto RsDLu; RsDLu: ?>
      <tr><td colspan="4">No Records Found</td></tr>
      <?php  goto UFiRC; wFFKg: echo $this->YpJyb->UZwZr("\145\162\x72\x6f\x72\x6d\163\147"); goto ahgWd; uejXv: ?>
</span>
            <span id="error_message" class="text-center won_error"><?php  goto wFFKg; ahgWd: ?>
</span>
            <span class="text-center"><?php  goto QlwCY; xzquW: jQmdi: goto A0C0e; QiLAk: ?>
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
      "url"  : "<?php  goto yug6l; HdtcG: G6Q3H: goto OnECj; kYDnF: echo ksfh8("\x74\x6f\x6c\154\x63\145\x6e\164\x65\x72\x2f\144\x65\154\x65\x74\145\137\x6f\160\145\162\x61\164\157\162"); goto uUwZo; OnECj: foreach (@$JNJz0 as $V7w_c => $UoEr0) { goto Qsjqw; gRjBj: ?>
</td>
            <td id="email_<?php  goto xl4IL; zMSE1: echo @$UoEr0->ZoBQz; goto McGkl; HXN5X: echo $UoEr0->VF6bB; goto a7Tf8; K0YwO: echo "\101\x63\164\151\166\x65"; goto rpJUc; E00ir: if (!(isset($UoEr0->oqEhs) && $UoEr0->oqEhs == 0)) { goto g_s2e; } goto wV13x; E4XQ0: echo $UoEr0->VF6bB; goto AAbNv; NBkg8: if (!($UoEr0->oqEhs == 0)) { goto DCxHR; } goto BbpPh; a7Tf8: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">view</button>
              <?php  goto NBkg8; Mo2Tz: ?>
              <button type="button"  onclick='edit_semiadmin("<?php  goto E4XQ0; xl4IL: echo $UoEr0->VF6bB; goto f5Mf8; BbpPh: DCxHR: goto Mo2Tz; rpJUc: JfjHC: goto qH0fD; T4G0Q: ?>
"><?php  goto mhiuw; ROmuV: if (!(isset($UoEr0->oqEhs) && $UoEr0->oqEhs == 1)) { goto JfjHC; } goto K0YwO; A9NAi: ?>
"><?php  goto zMSE1; qH0fD: ?>
</a></button>
            </td>
          </tr>
        <?php  goto DjZug; qnoCy: g_s2e: goto ROmuV; AAbNv: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
              <button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><a href="javascript:void(0);" onclick="delete_semiadmin('<?php  goto NdysO; wV13x: echo "\111\x6e\141\143\x74\151\x76\145"; goto qnoCy; EUhem: echo $UoEr0->VF6bB; goto T4G0Q; BeQow: ?>
')"><?php  goto E00ir; Qsjqw: ?>
          <tr>
            <td id="name_<?php  goto EUhem; WpFbn: echo @$UoEr0->gF1ME; goto skdRj; NdysO: echo $UoEr0->VF6bB; goto BeQow; f5Mf8: ?>
"><?php  goto WpFbn; ac9lm: echo $UoEr0->VF6bB; goto A9NAi; DjZug: tR48p: goto HDFRj; McGkl: ?>
</td>
            <?php  goto y8lHG; mhiuw: echo @$UoEr0->kgb2c . "\40" . $UoEr0->bOI2x; goto gRjBj; y8lHG: ?>
           <!--  <td><?php  goto qklRL; skdRj: ?>
</td>
            <td id="mn_<?php  goto ac9lm; qklRL: ?>
</td> -->
            <td>
              <button type="button"  onclick='view_semiadmin("<?php  goto HXN5X; HDFRj: } goto oByE_; yug6l: echo KsfH8("\164\x6f\154\x6c\x63\x65\x6e\x74\145\x72\57\x67\x65\164\137\x73\151\x6e\147\154\x65\137\163\x65\155\x69\141\x64\155\x69\x6e\x5f\166\x69\145\x77"); goto e1ctA; HhfxW: echo QYo48(); goto uejXv; QlwCY: echo $this->YpJyb->uZWZR("\x6d\x73\x67"); goto pqQ1H; R2DDM: ?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addsemiadmin" name="addsemiadmin" action="<?php  goto V5G9I; e1ctA: ?>
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
  alertify.confirm("Are you sure, You want to Delete?", function (e) {
  if (e) {
            window.location.href = "<?php  goto kYDnF; oByE_: e8f7m: goto xzquW; Ps1br: echo KsfH8("\x74\x6f\x6c\x6c\x63\145\x6e\x74\145\x72\57\x67\x65\164\x5f\163\151\156\x67\154\x65\x5f\163\x65\x6d\151\141\144\155\x69\156"); goto QiLAk; pqQ1H: ?>
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
          <th>Name</th>
          <th>Email</th>
          <th>Mobile Number</th>
          <!-- <th>Role</th> -->
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php  goto j0e4V; UY3VC: ?>
">
    
    <div class="row">
      <h4 style="padding-left: -1px !important; font-weight:normal;">Staff Details
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
            <span style="color:red;"><?php  goto HhfxW; V5G9I: echo ksfH8("\x74\x6f\x6c\x6c\x63\x65\x6e\x74\145\x72\x2f\x61\x64\x64\164\157\x6c\x6c\x6f\x70\145\162\141\164\157\162"); goto UY3VC; A0C0e: ?>
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
  
$(document).ready(function(){
    $('#addsemiadmin').validate({
      rules:{
        first_name:{required: true,minlength:1,maxlength:30},
        last_name:{required: true,minlength:1,maxlength:20},
        roll:{required: true},
        eamil:{required: true,email:true,minlength:1,maxlength:100},
        mobile_number:{required: true,digits:true,minlength:10,maxlength:10},
        password:{required: true,minlength:1,maxlength:29},
      },
      messages:{
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
      "url"  : "<?php  goto Ps1br; uUwZo: ?>
/"+id;
        }
    });
}
</script>
