<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto VBcop; Fqv7Y: ?>
>Desable</option>
    </select>
  </div>
 </div>
  <div class="modal-footer">
  <span class="pull-left text-danger" style="font-size:13px;" id="fail"></span>
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_vehicle">Cancel</button>
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn save_changes pull-right common-btn-pass" id="save_edit_vehicle">Submit</button>
  </div>
 </form>
</div>

<script type="text/javascript">
$("#close_id_single").click(function(){
  location.reload();
});


$("#cancel_vehicle").click(function(){
  location.reload();
});
jQuery.validator.addMethod("validate_vehicle", function(value, element) {
       return this.optional( element ) || /^[a-z A-Z]{2}[ -][0-9]{1,2}(?: [a-z A-Z])?(?: [a-z A-Z]*)? [0-9]{4}$/.test( value ) || /^[0-9]{10,10}$/.test(value);
    }, 'Please Enter valid vehicle number(EX: AP 12 HY 1234).');

  $("#save_edit_vehicle").click(function(){
    $('#popup_edit_vehicle').validate({
      rules:{
        vehicle_type_pop:{required: true},
        vehicle_number_pop:{required: true, validate_vehicle:true},
        vehicle_make_pop:{required: true},
        vehicle_model_pop:{required: true}
      },
      messages:{
        vehicle_type_pop:{
            required:"Please select vehicle type."
       },
       vehicle_number_pop:{
                required:"Please Enter vehicle number."
               },
       
       vehicle_make_pop:{
                required:"Please select vehicle make."
               },
       
       vehicle_model_pop:{
                required:"Please select vehicle model."
               }
        },
       tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if( $('#popup_edit_vehicle').valid()){
        var vehicle_id = "<?php  goto y0wDI; XX6kP: if (!($StbPw->BFINK->aY4v9 == 1)) { goto WZe1U; } goto jvUxv; Ji8Ul: echo @$StbPw->BFINK->u0KjP; goto sjgw9; SeE6n: ?>
";
        var vehicle_type_pop = $('select[name=vehicle_type_pop]').val();
        var vehicle_make_pop = $('select[name=vehicle_make_pop]').val();
        var vehicle_model_pop = $('select[name=vehicle_model_pop]').val();
        var vehicle_number_pop = $("#vehicle_number_pop").val();
        var vehicle_status_pop = $('select[name=vehicle_status_pop]').val();
        var default_pop = $("#default_pop").is(':checked') ? 1 : 0;

        $.ajax({
          "url"  : "<?php  goto d8BYV; d8BYV: echo KsFh8("\x76\x65\150\x69\x63\154\145\x73\x2f\x65\144\x69\164"); goto SHD9m; wHoTc: echo "\163\x65\x6c\x65\x63\x74\x65\144"; goto orVGG; mkNA1: ek2FD: goto YhDGB; DRMF1: if (!($StbPw->BFINK->jbg7g == 1)) { goto mIcT5; } goto zYZl6; orVGG: mJUwN: goto Fqv7Y; cCwBp: WZe1U: goto fBEMU; gqXj8: ?>
  />
    </label>
  </div>
  <div class="form-group">
    <select class="form-control" name="vehicle_status_pop" id="vehicle_status_pop">
      <option value="">Select Status</option>
      <option value="1" <?php  goto XX6kP; ZZz8S: echo kSfH8("\x76\x65\x68\151\x63\154\x65\163\x2f\147\x65\x74\137\x70\x6f\160\x5f\166\145\x68\151\143\x6c\145\x5f\155\x6f\144\x65\x6c"); goto cZWfS; r0R_1: echo @$StbPw->BFINK->E7eb5; goto jPsLI; fBEMU: ?>
>Enable</option>
      <option value="0" <?php  goto hvNHc; y0wDI: echo $StbPw->BFINK->LfSSw; goto SeE6n; zYZl6: echo "\143\150\x65\143\x6b\145\x64"; goto D4Ia3; cPenS: ?>
</option>
    </select>
          </div>
  </div>
        </div>
    <div id="seconddiv" style="float: left; width: 100%;">
  <div class="form-group">
    <input placeholder="Vehicle No" type="text" name="vehicle_number_pop" class="form-control" id="vehicle_number_pop" value="<?php  goto f47js; SHD9m: ?>
",
          "type" : "POST",
          "data" : ({'vehicle_id':vehicle_id,'vehicle_type':vehicle_type_pop,'vehicle_make':vehicle_make_pop,'vehicle_model':vehicle_model_pop,'vehicle_number':vehicle_number_pop,'vehicle_status':vehicle_status_pop,'default':default_pop}),
          success:function(response){
            console.log(response);
              var data = $.parseJSON(response);
             // console.log(data.statuscode);
              if(data.statuscode == 200)
              {
               alertify.success(data.successMessage);
                 location.reload();

              }
              else{
                alertify.error(data.error);
              }
          }
        });
    }
  });
//  function getMake(select_type_pop){
//  alert(select_type_pop);
//  }
  $("#vehicle_type_pop").on('change',function(){//alert(1);
    $('#vehicle_make_pop').text('');
    $('#vehicle_model_pop').text('');
    var select_type_pop =  this.value;

    if(select_type_pop !='')
    {
      $.ajax({
        "url"  : "<?php  goto CyibG; XUCb8: echo @$StbPw->BFINK->jR7Z3; goto x0hjE; jPsLI: ?>
"><?php  goto wHBEI; pmHfL: ?>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="popup_edit_vehicle" id="popup_edit_vehicle">
    <div id="firstdiv" style="float: left; width: 100%;">
  <div class="form-group">
    <select class="form-control" name="vehicle_type_pop" id="vehicle_type_pop">
    <option value="">Vehicle Type</option>  
<?php  goto SIWGv; x0hjE: ?>
</option>
    </select>
          </div>
  </div>
  <div class="form-group">
      <div id="modeldivid_pop">
    <select class="form-control" name="vehicle_model_pop" id="vehicle_model_pop">
    <option value="<?php  goto r0R_1; GAvZl: ?>
">
  </div>

  <div class="form-group">
    <label>Deafault <input type="checkbox" name="default_pop" value="yes" id="default_pop" 
        <?php  goto DRMF1; T4DtZ: ?>
",
        "type" : "POST",
        "data" : ({'select_type':select_type_pop}),
        success:function(response){
          $('#makedivid_pop').html(response);
        }
      });
    }
  });
  function getPopModel(){
    $('#vehicle_model_pop').text('');
      var select_type_pop = $("#vehicle_type_pop").val();
      var vehicle_make_pop =  $("#vehicle_make_pop").val();
      if(vehicle_make_pop !='')
      {
        $.ajax({
          "url"  : "<?php  goto ZZz8S; YhDGB: ?>
  
    </select>
  </div>
  <div class="form-group">
      <div id="makedivid_pop">
    <select class="form-control" name="vehicle_make_pop" id="vehicle_make_pop">
    <option value="<?php  goto Ji8Ul; sjgw9: ?>
"><?php  goto XUCb8; SIWGv: foreach ($UvePZ->BFINK as $UoEr0) { goto TlSvV; QbFxp: if (!($UoEr0->RRv3j == $StbPw->BFINK->RRv3j)) { goto DpyCe; } goto GxcyJ; Df1JR: sAqO6: goto kpU1z; TlSvV: ?>
    <option value="<?php  goto qCJaB; Rz8PC: ?>
><?php  goto SxS2O; RPt7J: DpyCe: goto Rz8PC; uokeD: ?>
</option>
   
  <?php  goto Df1JR; GxcyJ: echo "\163\x65\154\145\x63\x74\145\144"; goto RPt7J; qCJaB: echo $UoEr0->RRv3j; goto LobEz; LobEz: ?>
" <?php  goto QbFxp; SxS2O: echo $UoEr0->RgQ87; goto uokeD; kpU1z: } goto mkNA1; hvNHc: if (!($StbPw->BFINK->aY4v9 == 0)) { goto mJUwN; } goto wHoTc; f47js: echo @$StbPw->BFINK->UAEm2; goto GAvZl; VBcop: ?>
<div class="modal-header">
  <button type="button" id="close_id_single" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<?php  goto pmHfL; jvUxv: echo "\x73\x65\154\x65\x63\164\145\x64"; goto cCwBp; CyibG: echo Ksfh8("\x76\145\150\151\x63\x6c\145\x73\x2f\x67\x65\x74\137\x70\x6f\x70\x5f\166\x65\150\x69\x63\154\145\x5f\155\x61\x6b\x65"); goto T4DtZ; D4Ia3: mIcT5: goto gqXj8; wHBEI: echo @$StbPw->BFINK->lMAAR; goto cPenS; cZWfS: ?>
",
          "type" : "POST",
          "data" : ({'vehicle_make':vehicle_make_pop,'select_type':select_type_pop}),
          success:function(response){
          $('#modeldivid_pop').html(response);
          }
        });
      }
  }
  
</script>
