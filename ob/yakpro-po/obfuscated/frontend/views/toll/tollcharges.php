<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto X3muQ; taqM1: echo kSFH8("\164\157\x6c\x6c\143\145\156\x74\145\x72\x2f\x74\x6f\154\x6c\143\x68\141\162\x67\x65\x73"); goto UefDu; DK2cp: if (count($LKjn1) && !empty($LKjn1)) { goto TREpD; } goto PkDqL; uvQIs: Xja1k: goto QF34f; xlXrK: ?>
</span>
            
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row text-center" style="color:#090;"></div>
  </form>
    
 <!--  <div class="row text-center">
    <div class="col-md-12">
      <button type="button" class="btn btn-primary common-btn-pass">Add</button>
      <button type="button" class="btn btn-success common-btn-pass">Edit</button>
      <button type="button" class="btn btn-danger common-btn-pass">Delete</button>
    </div>
  </div> -->

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
      <?php  goto jKff9; QF34f: Nf4J6: goto EZP6W; ZHAZ3: ?>
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

  function view_charger_details(id)
  {
    if(id !='')
    {
      $.ajax({
        "url"  : "<?php  goto j_YAJ; aeDVe: SMxf0: goto Yw9KX; jKff9: if (isset($LCMDA) && count($LCMDA)) { goto K9xC9; } goto sKxn8; Yw9KX: kpMfA: goto ZwEaB; HD9nF: goto kpMfA; goto kDcmF; MAnRc: K9xC9: goto xz7qH; kDcmF: TREpD: goto NXL_J; OCR3Y: echo KSfH8("\x74\x6f\x6c\x6c\x63\145\x6e\164\x65\x72\57\x67\x65\164\x5f\163\x69\156\147\154\x65\x5f\143\x68\x61\x72\147\x65\x5f\144\145\164\141\151\154\x73"); goto ZHAZ3; ICdj5: ?>
",
            "type" : "POST",
            "dataType":"json",
            "data" :({'tolltype_id':tolltype_id}),
            success:function(data){
               $("#toll_center_loaction").append(data.responseText);
            },
            error:function(err){
               $("#toll_center_loaction").append(err.responseText);
            }
           });
    }
    else{
      $("#toll_center_loaction").append('<option value="">No Toll Center Locations</option>');
    }
  } 
  function getcentername() {
    $("#tcn").val('');
    var location_id = $("#toll_center_loaction").val();
    $("#toll_center_name").html('');
    if(location_id != '')
    {
      $.ajax({
            "url":"<?php  goto EjeEm; Q_YiI: ?>
</span>
            <span class="text-center"><?php  goto Lu2Ng; PkDqL: ?>
            <option value="">NO Vehical Types</option>
            <?php  goto HD9nF; EjeEm: echo kSfh8("\x74\x6f\154\154\x63\145\x6e\x74\145\162\57\x67\x65\164\164\x6f\x6c\x6c\143\x65\x6e\x74\145\x72\156\141\x6d\145\146\157\x72\143\x68\x61\162\147\x65\x73"); goto eDpy2; X3muQ: ?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="tollcharges" name="tollcharges" action="<?php  goto taqM1; RQJ07: echo QyO48(); goto H4ZdM; H4ZdM: ?>
</span>
            <span id="error_message" class="text-center won_error"><?php  goto Q3g6O; sKxn8: ?>
        <tr>
          <td colspan="3">No Records Found</td>
        </tr>
        <?php  goto SurzM; EZP6W: ?>
      
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
  function getTollCenterLocation(){
  	var tolltype_id = $("#tolltype").val();
  	$("#toll_center_loaction").html('');
  	if(tolltype_id==2){
  		$('#fororr').show();
  		$('#fornh').hide();

  	}
    if(tolltype_id != '')
    {
      $.ajax({
            "url":"<?php  goto pLFZx; Lu2Ng: echo $this->YpJyb->UzWzR("\155\163\x67"); goto xlXrK; xz7qH: foreach ($LCMDA as $V7w_c => $UoEr0) { goto ZpvEz; h2GnJ: ?>
</td>
            <td>
              <button type="button"  onclick='view_charger_details("<?php  goto q1Omx; oFzcl: echo @$UoEr0->q9pm2; goto kpL0j; kpL0j: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
              <!-- <button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><a href="javascript:void(0);" onclick="delete_vehicle('<?php  goto ImicQ; ImicQ: ?>
')"> Delete</a></button> -->
            </td>
          </tr>
          <?php  goto K3yi0; K3yi0: ct52r: goto rKF3a; gFFKn: echo @$UoEr0->Nb6y_; goto h2GnJ; okGbc: echo @$UoEr0->HIkuN; goto Nu5R4; Nu5R4: ?>
</td>
            <td><?php  goto gFFKn; ZpvEz: ?>
          <tr>
            <td><?php  goto okGbc; lp_JN: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <button type="button"  onclick='edit_charger_details("<?php  goto oFzcl; q1Omx: echo @$UoEr0->q9pm2; goto lp_JN; rKF3a: } goto uvQIs; SurzM: goto Nf4J6; goto MAnRc; UefDu: ?>
">
    <div class="row">
    	<div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" id="tolltype" name="tolltype" onchange="getTollCenterLocation()">
        <option value="">Toll Type</option>
        <option value="1">National Highway</option>
        <option value="2">Outer Ring Road</option>
        </select>
      	</div>
      <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_loaction" name="toll_center_loaction" onchange="getcentername()">
        <option value="">Toll Center Location</option>
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
      <h4 style="padding-left: -1px !important; font-weight:normal;">Toll Charges
      </h4>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" name="vehical_type" id="vehical_type">
        <option value="">Vehicle Type</option>
         <?php  goto DK2cp; ZwEaB: ?>
        </select>
      </div>
      <!-- <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control">
          <option>Model</option>
        </select>
      </div> -->
    </div>
    <div class="row" id="fornh">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="one_way" name="one_way" placeholder="One Way - Rs : ">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="two_way" name="two_way" placeholder="Two Way - Rs : ">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="multi_way" name="multi_way" placeholder="Multiple Trips - RS : ">
        </div>
      </div>
    </div>
    
    <div class="row" id="fororr" style="display: none">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_charges" name="orr_charges" placeholder="Charges - Rs : ">
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
            <span style="color:red;"><?php  goto RQJ07; Q3g6O: echo $this->YpJyb->UzWzr("\x65\x72\x72\x6f\x72\x6d\x73\147"); goto Q_YiI; NXL_J: foreach ($LKjn1 as $V7w_c => $UoEr0) { goto k5WXq; WcZqr: ?>
</option>
              <?php  goto CzbDt; VQPR3: echo $UoEr0->RgQ87; goto WcZqr; qNRoZ: ?>
"><?php  goto VQPR3; k5WXq: ?>
              <option value="<?php  goto Pw_Ae; Pw_Ae: echo $UoEr0->RRv3j; goto qNRoZ; CzbDt: V1AUj: goto UkWTB; UkWTB: } goto aeDVe; pLFZx: echo kSfh8("\164\157\154\x6c\143\x65\156\164\x65\x72\x2f\x67\x65\164\164\x6f\x6c\154\143\x65\x6e\164\x65\162\x6e\141\x6d\x65\x73"); goto ICdj5; j_YAJ: echo KSfh8("\164\x6f\154\154\x63\145\156\164\x65\162\x2f\x67\x65\x74\137\x73\x69\156\147\x6c\x65\x5f\x63\150\x61\162\x67\145\x5f\x64\145\164\141\x69\x6c\163\137\146\157\x72\x5f\166\151\x65\167"); goto UhSHe; y8hpu: ?>
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

  function edit_charger_details(id)
  {
    if(id !='')
    {
      $.ajax({
        "url"  : "<?php  goto OCR3Y; rc1od: echo kSfh8("\x74\157\x6c\x6c\x63\145\156\164\145\162\x2f\147\145\x74\x74\143\156"); goto y8hpu; eDpy2: ?>
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
            "url":"<?php  goto rc1od; UhSHe: ?>
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

$(document).ready(function(){
    $('#tollcharges').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:19},
        toll_center_name:{required: true,minlength:1,maxlength:19},
        vehical_type:{required: true,minlength:1,maxlength:19},
        one_way:{required: true,minlength:1,maxlength:9,number:true},
        tcn:{required: true,minlength:1,maxlength:19},
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
                    number:"Enter Only Number",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               multi_way:{
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
});

</script>
