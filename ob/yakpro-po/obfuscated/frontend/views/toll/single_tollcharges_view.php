<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto YYxpN; UVA1E: echo @$StbPw->BFINK->XbSV_->tj1Os; goto Lpza2; q4aME: if (isset($snVlL) && !empty($snVlL)) { goto HUD4v; } goto uOM72; XMz4F: ?>
    </select>
  </div>
  
  <div class="form-group">
    <div class="form-group">
        <input type="hidden" class="form-control" value="<?php  goto pcjUz; YYxpN: ?>
<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">View</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="update_charges" id="update_charges">
  <input type="hidden" name="update_id" id="update_id" value="<?php  goto ay7Ex; sgODv: ?>
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
                    //$("#error_message").text("Charges Not Added For This Vehical Type");
                      alertify.error("Charges Not Added For This Vehicle Type");
                  }

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

  /*
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
                    required:"Please Select Vehical Type",
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
          "url"  : "<?php  goto Im9jL; HS3Fv: foreach (@$snVlL as $V7w_c => $UoEr0) { goto bsDiX; S73QE: tGEnQ: goto dXlf9; bxoZb: ?>
</option>
            <?php  goto S73QE; bsDiX: ?>
            <option value="<?php  goto nEoaY; xsdSe: echo @$UoEr0->RgQ87; goto bxoZb; nEoaY: echo $UoEr0->RRv3j; goto IbYxt; IbYxt: ?>
"><?php  goto xsdSe; dXlf9: } goto ADDKP; mXODN: ?>
">
  <div class="form-group">
    <select  style="color:#0C0C0C;" class="form-control" id="vehical_type_single" name="vehical_type" onchange="getchargedetails()">
      <option value="">Select Vehicle Type</option>
      <?php  goto q4aME; DKo2k: NPojV: goto XMz4F; KPWbb: ?>
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
               alertify.success(data.successMessage);
              }
              else{
                 //$("#fail").text(data.error);
                alertify.error(data.error);
              }
              // var set_make = "<?php  goto UVA1E; PoOpi: ?>
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
  <!-- <div class="col-md-6 col-sm-6">
    <button type="button" id="save_toll_charges" class="btn save_changes common-btn-pass">Submit</button>
  </div> -->
  <div class="form-group">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_view">Cancel</button>
    
  </div>
 </form>
</div>

<script type="text/javascript">
 /* $("#close_id").click(function(){
    location.reload();
  });*/
  $("#cancel_single_view").click(function(){
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
            "url":"<?php  goto YaZjD; uOM72: ?>
          <option value="">NO Toll Center Location</option>
          <?php  goto E0NO2; YaZjD: echo ksFh8("\x74\x6f\154\154\x63\145\156\164\x65\162\x2f\x67\x65\x74\123\x70\x65\x63\151\146\151\143\124\157\154\154\103\150\x61\x72\147\145\163"); goto sgODv; uHoWL: HUD4v: goto HS3Fv; ADDKP: zoeRU: goto DKo2k; ay7Ex: echo @$N_MOk->VF6bB; goto mXODN; Im9jL: echo KsfH8("\x74\x6f\154\x6c\x63\x65\x6e\164\x65\162\57\165\x70\144\x61\164\145\x63\150\141\x72\145\147\x65\144\x65\x74\x61\151\154\x73"); goto KPWbb; E0NO2: goto NPojV; goto uHoWL; pcjUz: echo @$IoUr_; goto PoOpi; Lpza2: ?>
";
  
          }
        });
    }
});*/
    
</script>
