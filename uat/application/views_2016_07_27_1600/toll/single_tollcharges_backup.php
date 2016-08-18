<?php 

//$data = @$toll_center_detal->response->TollChargeDetails;

 //echo "<pre>";print_r($toll_charges);exit;
?>
<div class="modal-header">
  <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="update_toll_charges" id="update_toll_charges">
  <div class="form-group">
    <input type="text" class="form-control" id="toll_center_loaction_single"  value="<?php echo @$value->toll_location?>" name="toll_center_loaction" placeholder="Toll Center Location">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="toll_center_name_single"  value="<?php echo @$value->toll_name?>" name="toll_center_name" placeholder="Toll Center Name">
  </div>
  <div class="form-group">
    <div class="form-group">
        <input type="text" style="background-color: #FFFFFF;" class="form-control" value="<?php echo 3/*@$value->tcn_no*/?>" id="tcn_single" name="tcn" placeholder="TCN" readonly="off">
  </div>
  <?php
  foreach (@$toll_charges as $key => $value) 
  {?>
    <?php
   if(@$value->vehicletype_id == 1)
   {
    ?>
    <div class="form-group">
      <div class="form-group">
        <span>2 wheeler</span>
        <input type="hidden" name="two_wheel_id" id="two_wheel_id" value="<?php echo @$value->id?>">
        <input type="text" class="form-control" value="<?php echo @$value->oneway_charge;?>" id="twowheeleroneway" name="twowheeleroneway" placeholder="One Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->twoway_charge;?>" id="twowheelertwoway" name="twowheelertwoway" placeholder="Two Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->multiway_charge;?>" id="twowheelermulway" name="twowheelermulway" placeholder="Multiple Trips - Rs">
      </div>
    </div>
    <?php
   }
   else if(@$value->vehicletype_id == 2)
   {
    ?>
    <div class="form-group">
      <div class="form-group">
        <span>3 wheeler</span>
        <input type="hidden" name="three_wheel_id" id="three_wheel_id" value="<?php echo @$value->id?>">
        <input type="text" class="form-control" value="<?php echo @$value->oneway_charge;?>" id="threewheeleroneway" name="threewheeleroneway" placeholder="One Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->twoway_charge;?>" id="threewheelertwoway" name="threewheelertwoway" placeholder="Two Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->multiway_charge;?>" id="threewhellermul" name="threewhellermul" placeholder="Multiple Trips - Rs">
      </div>
    </div>
    <?php
   }
   else if(@$value->vehicletype_id == 3)
   {
    ?>
    <div class="form-group">
      <div class="form-group">
        <span>4 wheeler</span>
        <input type="hidden" name="four_wheel_id" id="four_wheel_id" value="<?php echo @$value->id?>">
        <input type="text" class="form-control" value="<?php echo @$value->oneway_charge?>" id="fourwheeleroneway" name="fourwheeleroneway" placeholder="One Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->twoway_charge?>" id="fourwheelertwoway" name="fourwheelertwoway" placeholder="Two Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->multiway_charge?>" id="fourwheelermul" name="fourwheelermul" placeholder="Multiple Trips - Rs">
      </div>
    </div>
    <?php
   }
   else if(@$value->vehicletype_id == 4)
   {
    ?>
    <div class="form-group">
      <div class="form-group">
        <span>>4 wheeler</span>
        <input type="hidden" name="grate_four_wheel_id" id="grate_four_wheel_id" value="<?php echo @$value->id?>">
        <input type="text" class="form-control" value="<?php echo @$value->oneway_charge?>" id="four_otheroneway" name="four_otheroneway" placeholder="One Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->twoway_charge?>" id="four_othertwoway" name="four_othertwoway" placeholder="Two Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->multiway_charge?>" id="four_othermul" name="four_othermul" placeholder="Multiple Trips - Rs">
      </div>
    </div>
    <?php
   }
   else if(@$value->vehicletype_id == 5)
   {
    ?>
    <div class="form-group">
      <div class="form-group">
        <span>Others</span>
        <input type="hidden" name="other_wheel_id" id="other_wheel_id" value="<?php echo @$value->id?>">
        <input type="text" class="form-control" value="<?php echo @$value->oneway_charge?>" id="other_wheeler_one_way" name="other_wheeler_one_way" placeholder="One Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->twoway_charge?>" id="other_wheeler_two_way" name="other_wheeler_two_way" placeholder="Two Way - Rs">
        <input type="text" class="form-control" value="<?php echo @$value->multiway_charge?>" id="other_wheeler_multiple" name="other_wheeler_multiple" placeholder="Multiple Trips - Rs">
      </div>
    </div>
    <?php
   }
  }
  ?>
  <div class="col-md-6 col-sm-6">
    <button type="button" id="save_toll_charges" class="btn save_changes common-btn-pass">Submit</button>
  </div>
  
 </form>
</div>

<script type="text/javascript">
  $("#close_id").click(function(){
    location.reload();
  });
  
  
  
  $("#save_toll_charges").click(function(){
      
    $('#update_toll_charges').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:20},
        tcn:{required: true},
        twowheeleroneway:{required: true,minlength:1,maxlength:9,digits:true},
        twowheelertwoway:{required: true,minlength:1,maxlength:9,digits:true},
        twowheelermulway:{required: true,minlength:1,maxlength:9,digits:true},
        threewheeleroneway:{required: true,minlength:1,maxlength:9,digits:true},
        threewheelertwoway:{required: true,minlength:1,maxlength:9,digits:true},
        threewhellermul:{required: true,minlength:1,maxlength:9,digits:true},
        fourwheeleroneway:{required: true,minlength:1,maxlength:9,digits:true},
        fourwheelertwoway:{required: true,minlength:1,maxlength:9,digits:true},
        fourwheelermul:{required: true,minlength:1,maxlength:9,digits:true},
        four_otheroneway:{required: true,minlength:1,maxlength:9,digits:true},
        four_othertwoway:{required: true,minlength:1,maxlength:9,digits:true},
        four_othermul:{required: true,minlength:1,maxlength:9,digits:true},
        other_wheeler_one_way:{required: true,minlength:1,maxlength:9,digits:true},
        other_wheeler_two_way:{required: true,minlength:1,maxlength:9,digits:true},
        other_wheeler_multiple:{required: true,minlength:1,maxlength:9,digits:true},
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
               tcn:{
                    required:"Please Enter Toll Center Number",
                    maxlength:"Enter Maximum 19 Characters",
               },
               twowheeleroneway:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               twowheelertwoway:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               twowheelermulway:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               fourwheeleroneway:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               fourwheelertwoway:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               fourwheelermul:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               four_otheroneway:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               four_othertwoway:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               four_othermul:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               other_wheeler_one_way:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
               other_wheeler_two_way:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },
              other_wheeler_multiple:{
                    required:"Please Enter One Way",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Digits",
                    minlength:"Enter Minimum 1 Digits",
               },    
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if( $('#update_toll_charges').valid()){
        $.ajax({
          "url"  : "<?php echo base_url('tollcenter/updatetollcenterdetails');?>",
          "type" : "POST",
          "data" : ({'toll_location':$("#toll_center_loaction_single").val(),'toll_name':$("#toll_center_name_single").val(),'tcn_single':$("#tcn_single").val(),'two_wheel_id':$("#two_wheel_id").val(),'twowheeleroneway':$("#twowheeleroneway").val(),'twowheelertwoway':$("#twowheelertwoway").val(),'twowheelermulway':$("#twowheelermulway").val(),'three_wheel_id':$("#three_wheel_id").val(),'threewheeleroneway':$("#threewheeleroneway").val(),'threewheelertwoway':$("#threewheelertwoway").val(),'threewhellermul':$("#threewhellermul").val(),'four_wheel_id':$("#four_wheel_id").val(),'fourwheeleroneway':$("#fourwheeleroneway").val(),'fourwheelertwoway':$("#fourwheelertwoway").val(),'fourwheelermul':$("#fourwheelermul").val(),'grate_four_wheel_id':$("#grate_four_wheel_id").val(),'four_otheroneway':$("#four_otheroneway").val(),'four_othertwoway':$("#four_othertwoway").val(),'four_othermul':$("#four_othermul").val(),'other_wheel_id':$("#other_wheel_id").val(),'other_wheeler_one_way':$("#other_wheeler_one_way").val(),'other_wheeler_two_way':$("#other_wheeler_two_way").val(),'other_wheeler_multiple':$("#other_wheeler_multiple").val()}),
          success:function(response){
            //console.log(response);return false;
              var data = $.parseJSON(response);
             console.log(data.statuscode);
              if(data.statuscode == 200)
              {
               //alertify.success(data.successMessage);
               alertify.success(data.successMessage);
              }
              else{
                 //$("#fail").text(data.error);
                alertify.error(data.error);
              }
              // var set_make = "<?php echo @$vehicle_details->response->vehicleDetails->vehiclemake;?>";
  
          }
        });
    }
});
    
</script>