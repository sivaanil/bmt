<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto AwkyN; VQcen: ?>
",
            "type" : "POST",
            "data" :({'location_id':location_id,'vehical_type':vehica_type_id}),
            success:function(response){
              var data = $.parseJSON(response);
              if(data.statuscode == 200)
              {
               /* if(data.response.multi_way_charge != '')
                  $("#one_way_single").val(data.response.multi_way_charge);*/
                  if(data.response != '')
                  {
                    $("#multi_way_single").val(data.response.multi_way_charge);
                    $("#one_way_single").val(data.response.one_way_charge);
                    $("#two_way_single").val(data.response.two_way_charge);
                    $("#toll_charge_id").val(data.response.tcharge_id);
                  }
                  else{
                    $("#error_message").text("Charges Not Added For This Vehical Type");
                      alertify.error("Charges Not Added For This Vehical Type");
                  }

                console.log(data.response);
              }
              else{
                 //$("#fail").text(data.error);
                alertify.error(data.error);
              }
            }
           });
    }
    else{
      $("#toll_center_name_single").append('<option value="">No Toll Center Names</option>');
    }

    // body...
  }

  
  $("#save_toll_charges").click(function(){
      
    $('#update_charges').validate({
      rules:{
        vehical_type:{required: true,minlength:1,maxlength:19},
        one_way:{required: true,minlength:1,maxlength:9,number:true},
        two_way:{required: true,minlength:1,maxlength:9,number:true},
        multi_way:{required: true,minlength:1,maxlength:9,number:true},
        tcn:{required: true,minlength:1,maxlength:19},
     },
      messages:{
                vehical_type:{
                    required:"Please Select Vehicle Type",
                    maxlength:"Enter Maximum 19 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               one_way:{
                    required:"Please Enter One Way RS",
                    number:"Enter Only Number",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               two_way:{
                    required:"Please Enter Two Way RS",
                    number:"Enter Only Number",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               multi_way:{
                    required:"Please Enter Multiple Trips RS",
                    number:"Enter Only Number",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               tcn:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 19 Digits",
                    minlength:"Enter Minimum 1 Digits"
               },
               
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if( $('#update_charges').valid()){
        //$("#save_toll_venter").attr("disabled",true);
        $.ajax({
          "url"  : "<?php  goto i_62g; obdZz: echo @$StbPw->BFINK->XbSV_->tj1Os; goto lJ4vo; Q_eFY: WyM_n: goto mNzvf; N_hhK: echo KSfH8("\x74\x6f\x6c\x6c\143\x65\156\x74\145\162\x2f\x67\x65\164\x53\x70\145\x63\x69\146\151\x63\x54\x6f\154\154\x43\x68\141\162\147\145\x73"); goto VQcen; FDe73: ?>
          <option value="">NO Toll Center Location</option>
          <?php  goto bFF8y; l_fL9: echo @$IoUr_; goto Vw1fa; Vw1fa: ?>
"  id="tcn_single" name="tcn">
        <input type="hidden" class="form-control" value=""  id="toll_charge_id" name="toll_charge_id">
    </div>
  </div>
  <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="one_way_single" name="one_way" value="" placeholder="One Way - Rs : ">
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="two_way_single" name="two_way" value="" placeholder="Two Way - Rs : ">
  </div>
 
  <div class="form-group">
    <input type="text" class="form-control" id="multi_way_single" name="multi_way" value="" placeholder="Multiple Trips - RS : ">
  </div>
  <div class="form-group" id="error_message">
    <span ></span>
  </div>
  <div class="modal-footer">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_edit">Cancel</button>
    <button type="button" id="save_toll_charges" class="btn save_changes pull-right common-btn-pass" style="padding:8px 20px; font-size:12px; font-weight:normal;">Submit</button>
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
  function getchargedetails() {
    $("#one_way_single").val('');
    $("#multi_way_single").val('');
    $("#two_way_single").val('');
    $("#toll_charge_id").val('');
    $("#error_message").html("");
    $(".tooltip-arrow").html("");
    $(".tooltip-inner").html("");
    $(".tooltip").html("");
    var location_id = $("#tcn_single").val();
    var vehica_type_id = $("#vehical_type_single").val();
    if(vehica_type_id != '')
    {
      $.ajax({
            "url":"<?php  goto N_hhK; i_62g: echo KSfh8("\164\157\x6c\x6c\143\x65\156\164\x65\x72\x2f\165\x70\144\141\164\x65\x63\x68\141\x72\x65\x67\145\144\x65\x74\x61\x69\154\163"); goto l9gDI; rfeuU: foreach (@$snVlL as $V7w_c => $UoEr0) { goto nTOyQ; XQLBq: ?>
</option>
            <?php  goto Og8uz; nTOyQ: ?>
            <option value="<?php  goto L3KJv; Og8uz: O3ZJN: goto y_p2H; L3KJv: echo $UoEr0->RRv3j; goto vMp3m; kNX3U: echo @$UoEr0->RgQ87; goto XQLBq; vMp3m: ?>
"><?php  goto kNX3U; y_p2H: } goto Q_eFY; bFF8y: goto dv5xK; goto rpPe0; WBa8H: echo @$N_MOk->VF6bB; goto p0y3j; rpPe0: QtSJq: goto rfeuU; mNzvf: dv5xK: goto qZ8lt; qZ8lt: ?>
    </select>
  </div>
  
  <div class="form-group">
    <div class="form-group">
        <input type="hidden" class="form-control" value="<?php  goto l_fL9; p0y3j: ?>
">
  <div class="form-group">
    <select  style="color:#0C0C0C;" class="form-control" id="vehical_type_single" name="vehical_type" onchange="getchargedetails()">
      <option value="">Select Vehicle Type</option>
      <?php  goto zEhHS; zEhHS: if (isset($snVlL) && !empty($snVlL)) { goto QtSJq; } goto FDe73; AwkyN: ?>
<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="update_charges" id="update_charges">
  <input type="hidden" name="update_id" id="update_id" value="<?php  goto WBa8H; l9gDI: ?>
",
          "type" : "POST",
          "data" : ({'vehical_type':$("#vehical_type_single").val(),'oneway_charge':$("#one_way_single").val(),'multiway_charge':$("#multi_way_single").val(),'twoway_charge':$("#two_way_single").val(),'tcn_no':$("#tcn_single").val()}),
          success:function(response){
            //console.log(response);return false;
              var data = $.parseJSON(response);
             //console.log(data.statuscode);
              if(data.statuscode == 200)
              {
                //$("#save_toll_venter").attr("disabled",false);
               //alertify.success(data.successMessage);
               $('#exampleModal').modal('hide');
               alertify.success(data.successMessage);
              }
              else{
                 //$("#fail").text(data.error);
                alertify.error(data.error);
              }
              // var set_make = "<?php  goto obdZz; lJ4vo: ?>
";
  
          }
        });
    }
});
    
</script>
