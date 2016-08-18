<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto DffCS; XkHyl: foreach ($QO1QY as $V7w_c => $UoEr0) { goto NhQog; Qlo4q: if (!(isset($t13sn->oPN9U) && $t13sn->oPN9U == $UoEr0->id)) { goto Dv8Gr; } goto Gmbg5; tXFfq: echo $UoEr0->PH_7v; goto uyKPT; NhQog: ?>
            <option value="<?php  goto myrau; uoqqi: Dv8Gr: goto SdfGO; uyKPT: ?>
</option>
            <?php  goto Y8lzH; myrau: echo $UoEr0->id; goto qMMnp; Y8lzH: nbrgQ: goto EDKAH; SdfGO: ?>
><?php  goto tXFfq; qMMnp: ?>
"<?php  goto Qlo4q; Gmbg5: echo "\x73\145\154\145\143\164\145\x64"; goto uoqqi; EDKAH: } goto EJM7a; T4UZA: ?>
" placeholder="Bank Address">
  </div>
  <div class="form-group">
     <select style="color:#0C0C0C;" class="form-control" style="margin-top:0; width:100%;" id="account_type_single" class="form-control" name="account_type">
      <?php  goto pcI41; mLwtA: echo @$t13sn->dE3K5; goto J8pKu; ag14D: Tijc9: goto hRZBZ; Eki4S: coNSt: goto XkHyl; HC1WT: ?>
" name="bank_id" id="bank_id" placeholder="TCN" >
   <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="account_name_single" name="account_name" value="<?php  goto UDXj4; J8pKu: ?>
" placeholder="IFSC Code (Valid xx digit number)">
  </div>
  
  <div class="modal-footer">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_edit">Cancel</button>
    <button type="button" id="save_bankdetails_single" class="btn save_changes pull-right common-btn-pass" style="padding:8px 20px; font-size:12px; font-weight:normal;">Submit</button>
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
            "url":"<?php  goto eBKlx; DffCS: ?>
<div class="modal-header">
  <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="update_semiadmin_single" id="update_semiadmin_single">
  
  <input type="hidden" class="form-control" id="tcn_single" value="<?php  goto XWXGC; u2r3V: echo @$t13sn->mV0jP; goto HC1WT; iEux8: ?>
" name="tcn" placeholder="TCN" >
   <input type="hidden" class="form-control" value="<?php  goto u2r3V; pcI41: if (isset($QO1QY) && !empty($QO1QY)) { goto coNSt; } goto z_SbP; khJn9: echo @$t13sn->D_pUB; goto hkRip; hRZBZ: ?>
    </select>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="account_num_single" name="account_num" value="<?php  goto khJn9; hkRip: ?>
" placeholder="Account No">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="ifsc_code_single" name="ifsc_code" value="<?php  goto mLwtA; eBKlx: echo KSfh8("\x74\x6f\x6c\x6c\x63\145\x6e\x74\145\x72\57\147\145\x74\x5f\163\x69\156\x67\x6c\145\x5f\x62\141\x6e\x6b"); goto uyJrn; ZwjIA: echo kSfh8("\164\x6f\154\x6c\143\145\156\x74\145\x72\x2f\147\145\164\x74\x63\156"); goto Ur1q0; E3g85: goto Tijc9; goto Eki4S; EJM7a: opNAk: goto ag14D; Ur1q0: ?>
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
  
  $("#save_bankdetails_single").click(function(){
      
    $('#update_semiadmin_single').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:30},
        bank_name:{required: true,minlength:1,maxlength:30},
        bank_address:{required: true,minlength:1,maxlength:50},
        account_type:{required: true},
        account_num:{required: true,minlength:1,maxlength:20},
        account_name:{required: true,minlength:1,maxlength:20},
        ifsc_code:{required: true,minlength:1,maxlength:20},
        tcn:{required: true},
      },
      messages:{
               bank_name:{
                    required:"Please Enter Bank Name",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               bank_address:{
                    required:"Please Enter Bank Address",
                    maxlength:"Enter Maximum 50 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               account_type:{
                    required:"Please Select Acount Type",
               },
               account_num:{
                    required:"Please Enter Account Number",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               account_name:{
                    required:"Please Enter Account Name",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               ifsc_code:{
                    required:"Please Enter IFSC Code",
                    maxlength:"Enter Maximum 20 Characters",
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
    if($('#update_semiadmin_single').valid()){
      //alert($("#toll_id").val());return;
        var toll_location = $("#toll_location").val();
        $.ajax({
          "url"  : "<?php  goto NejdV; CX9CT: echo @$StbPw->BFINK->XbSV_->tj1Os; goto FvBWs; XWXGC: echo @$t13sn->q9pm2; goto iEux8; IWfQX: ?>
",
          "type" : "POST",
          "data" : ({'tcn':$("#tcn_single").val(),'bank_id':$("#bank_id").val(),'bank_name':$("#bank_name_single").val(),'bank_address':$("#bank_address_single").val(),'type_of_account':$("#account_type_single").val(),'ac_number':$("#account_num_single").val(),'ifsc_code':$("#ifsc_code_single").val(),'ac_name':$("#account_name_single").val()}),
          success:function(response){
            //console.log(response);return false;
              var data = $.parseJSON(response);
              console.log(data.statuscode);
              if(data.statuscode == 200)
              {
               //alertify.success(data.successMessage);
               $('#exampleModal').modal('hide');
               alertify.success(data.successMessage);
              }
              else{
                 //$("#fail").text(data.error);
                alertify.error(data.error);
              }
              // var set_make = "<?php  goto CX9CT; TnKWL: ?>
" placeholder="Account Name">
    </div>
  </div>
  <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="bank_name_single" name="bank_name" value="<?php  goto OAwhd; NejdV: echo KsfH8("\164\x6f\154\154\143\x65\x6e\x74\x65\x72\x2f\x75\160\144\x61\164\145\x62\x61\x6e\153\x64\x65\164\141\x69\x6c\163"); goto IWfQX; UDXj4: echo @$t13sn->HzHN0; goto TnKWL; bnO7C: echo @$t13sn->xQR75; goto T4UZA; z_SbP: ?>
          <option value="">NO Bank Types</option>
          <?php  goto E3g85; uyJrn: ?>
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
            "url":"<?php  goto ZwjIA; dphBi: ?>
" placeholder="Bank Name">
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="bank_address_single" name="bank_address" value="<?php  goto bnO7C; OAwhd: echo @$t13sn->fZ_YZ; goto dphBi; FvBWs: ?>
";
  
          }
        });
    }
});
    
</script>
