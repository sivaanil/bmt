<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto I3sYB; PB0NY: ?>
",
            "type" : "POST",
            "data" :({'location_id':location_id}),
            success:function(response){
              $("#toll_center_name").append(response);
            }
           });
    }
    else{
      $("#toll_center_name").append('<option value="">No Toll Center Names</option>');
    }

    // body...
  }

  function gettcn(){
    $("#tcn").val('');
    var toll_center_name = $("#toll_center_name").val();
    $.ajax({
            "url":"<?php  goto p5lya; QSAA3: echo kSfH8("\x74\x6f\154\154\x63\x65\156\164\145\x72\57\x61\x64\144\x62\141\x6e\x6b\144\x65\164\x61\x69\x6c\x73"); goto fGWu0; GVOVt: fDoud: goto ramT1; YDJ5H: foreach ($I1jpU as $V7w_c => $UoEr0) { goto h6CaF; s25Rf: ?>
"><?php  goto m7iHa; idsV7: bGdTr: goto zs5vO; m7iHa: echo $UoEr0->HIkuN; goto UucvU; uXgA7: echo $UoEr0->HIkuN; goto s25Rf; h6CaF: ?>
          <option value="<?php  goto uXgA7; UucvU: ?>
</option>
          <?php  goto vNqDZ; vNqDZ: $wO_Vt++; goto idsV7; zs5vO: } goto hgIgP; oYRHT: echo $this->YpJyb->uZwZR("\x6d\x73\147"); goto yoARX; ewwci: clD62: goto DL3d7; le2KG: echo kSFH8("\164\157\154\154\x63\x65\x6e\x74\145\162\57\x67\x65\164\137\x73\x69\x6e\x67\x6c\145\x5f\142\x61\156\153\x5f\166\x69\x65\x77"); goto YKUNE; hUlsC: ?>
              </select>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="account_num" name="account_num" placeholder="Account No">
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code (Valid xx digit number)">
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
            <span style="color:red;"><?php  goto PyNWe; eazQG: ?>
</span>
            <span class="text-center"><?php  goto oYRHT; YKUNE: ?>
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

  function getcentername() {
    $("#tcn").val('');
    var location_id = $("#toll_center_loaction").val();
    $("#toll_center_name").html('');
    if(location_id != '')
    {
      $.ajax({
            "url":"<?php  goto uiL8Q; O7PpL: if (!(isset($YglUf) && !empty($YglUf))) { goto uzYvG; } goto sY26u; p5lya: echo Ksfh8("\164\x6f\x6c\x6c\143\x65\156\x74\x65\162\57\147\x65\164\x74\x63\156"); goto shOJE; N56VM: goto knnGh; goto GXiEk; vxp_W: echo $this->YpJyb->uzwZR("\x65\x72\x72\x6f\x72\155\x73\147"); goto eazQG; mySV_: ?>
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
        <h4 style="padding-left: -1px !important; font-weight:normal;">Bank Details
        </h4>
    </div>
      
      
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
              <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name">
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
              <input type="text" class="form-control" id="bank_address" name="bank_address" placeholder="Bank Address">
          </div>
        </div>
      
      </div>
      
      <div class="row">
      
        <div class="col-md-4 col-sm-4">
          <div class="form-group" style="padding-left:15px;">
              <select style="margin-top:0; width:100%;" class="form-control" name="account_type">
                <option value="">ACCOUNT TYPE</option>
                <?php  goto k5j5L; sY26u: foreach (@$YglUf as $V7w_c => $UoEr0) { goto fR9X6; Q6g7K: ?>
</td>
            <td>
              <button type="button"  onclick='view_bankdetails("<?php  goto Mm3Xq; YoM4A: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
              <!-- <button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><a href="javascript:void(0);" onclick="delete_vehicle('<?php  goto USzwL; tYj9l: ?>
</td>
            <td><?php  goto dKefp; dKefp: echo @$UoEr0->Nb6y_; goto Q6g7K; Y9B2A: echo @$UoEr0->q9pm2; goto YoM4A; Mm3Xq: echo @$UoEr0->q9pm2; goto wyXz1; USzwL: ?>
')"> Delete</a></button> -->
            </td>
          </tr>
         <?php  goto fJjMn; wyXz1: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <button type="button"  onclick='edit_bankdetails("<?php  goto Y9B2A; fR9X6: ?>
         <tr>
            <td><?php  goto Qdsay; Qdsay: echo @$UoEr0->HIkuN; goto tYj9l; fJjMn: LN1eX: goto oPGpK; oPGpK: } goto ewwci; hgIgP: Ww55_: goto MsD1E; u2VVH: ?>
                  <option value="">NO Bank Types</option>
                  <?php  goto N56VM; uiL8Q: echo KSFh8("\x74\x6f\154\x6c\143\x65\x6e\164\145\162\x2f\147\x65\x74\164\x6f\154\154\143\145\156\x74\x65\x72\156\x61\155\145\x42\x61\156\x6b"); goto PB0NY; F85rB: echo ksFh8("\x74\x6f\x6c\x6c\x63\x65\156\164\145\162\57\147\145\x74\137\163\x69\156\x67\154\x65\137\x62\x61\156\x6b"); goto DE05x; PyNWe: echo QyO48(); goto zraIz; T6GJV: foreach ($QO1QY as $V7w_c => $UoEr0) { goto MuR5f; NN_QO: echo $UoEr0->id; goto mII1X; mII1X: ?>
"><?php  goto YJYG6; YrrUb: eFsIX: goto rYq46; MuR5f: ?>
                    <option value="<?php  goto NN_QO; YJYG6: echo $UoEr0->PH_7v; goto i0qiD; i0qiD: ?>
</option>
                    <?php  goto YrrUb; rYq46: } goto GVOVt; yoARX: ?>
</span>
            
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row text-center" style="color:#090;"></div>
  </form>
    
  <div class="row text-center">
    <div class="col-md-12">
      <!-- <button type="button" class="btn btn-primary common-btn-small">Add</button> -->
      <!-- <button type="button" class="btn btn-success common-btn-pass">Edit</button>
      <button type="button" class="btn btn-danger common-btn-pass">Delete</button> -->
    </div>
  </div>

  <div class="row">
      <table class="table" style="width:93%; margin-left:3.5%; border: 1px #DDD solid;">
      <thead>
      <tr>
      <th>Toll Location</th>
      <th>Toll Name</th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php  goto O7PpL; I3sYB: ?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addbankdetails" name="addbankdetails" action="<?php  goto QSAA3; GXiEk: CibOa: goto T6GJV; A5qn3: $wO_Vt = 0; goto YDJ5H; zraIz: ?>
</span>
            <span id="error_message" class="text-center won_error"><?php  goto vxp_W; DE05x: ?>
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

  function view_bankdetails(id)
  {
    //alert(id);return false;
    if(id !='')
    {
      $.ajax({
        "url"  : "<?php  goto le2KG; RfFif: ?>
      </table>
      
          
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
  </div>
                   
</div>

<script>
function edit_bankdetails(id)
  {
    //alert(id);return false;
    if(id !='')
    {
      $.ajax({
        "url"  : "<?php  goto F85rB; i0qjw: IUeG5: goto mySV_; fGWu0: ?>
">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_loaction" name="toll_center_loaction" onchange="getcentername()">
        <option value="">Toll Center Location</option>
        <?php  goto A5qn3; MsD1E: if (!($wO_Vt == 0)) { goto IUeG5; } goto y66vJ; ramT1: knnGh: goto hUlsC; k5j5L: if (isset($QO1QY) && !empty($QO1QY)) { goto CibOa; } goto u2VVH; y66vJ: ?>
          <option value="">NO Toll Center Location</option>
          <?php  goto i0qjw; DL3d7: uzYvG: goto RfFif; shOJE: ?>
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
    $('#addbankdetails').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:30},
        bank_name:{required: true,minlength:1,maxlength:30},
        bank_address:{required: true,minlength:1,maxlength:50},
        account_type:{required: true},
        account_num:{required: true,minlength:1,maxlength:20,digits:true},
        account_name:{required: true,minlength:1,maxlength:20},
        ifsc_code:{required: true,minlength:1,maxlength:20},
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
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
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
                    digits:"Enter Only Digits",
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
});

</script>
