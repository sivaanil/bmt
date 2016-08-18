<?php 
/*echo "<pre>";
print_r( $vehicle_details->response);exit;*/


?>
<div class="modal-header">
  <button type="button" id="close_id_single" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<?php //print_r($vehicle_types->response);exit;?>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="popup_edit_vehicle" id="popup_edit_vehicle">
    <div id="firstdiv" style="float: left; width: 100%;">
  <div class="form-group">
    <select class="form-control" name="vehicle_type_pop" id="vehicle_type_pop">
    <option value="">Vehicle Type</option>  
<?php
    foreach ($vehicle_types->response as $value) {
  ?>
    <option value="<?php echo $value->type_id;?>" <?php if($value->type_id == $vehicle_details->response->type_id){echo "selected";}?>><?php echo $value->type_name;?></option>
   
  <?php 
    } 
  ?>
  
    </select>
  </div>
  <div class="form-group">
      <div id="makedivid_pop">
    <select class="form-control" name="vehicle_make_pop" id="vehicle_make_pop">
    <option value="<?php echo @$vehicle_details->response->make_id; ?>"><?php echo @$vehicle_details->response->make_name; ?></option>
    </select>
          </div>
  </div>
  <div class="form-group">
      <div id="modeldivid_pop">
    <select class="form-control" name="vehicle_model_pop" id="vehicle_model_pop">
    <option value="<?php echo @$vehicle_details->response->model_id; ?>"><?php echo @$vehicle_details->response->model_name; ?></option>
    </select>
          </div>
  </div>
        </div>
    <div id="seconddiv" style="float: left; width: 100%;">
  <div class="form-group">
    <input placeholder="Vehicle No" type="text" name="vehicle_number_pop" class="form-control" id="vehicle_number_pop" value="<?php echo @$vehicle_details->response->vehicle_no; ?>">
  </div>

  <div class="form-group">
    <label>Deafault <input type="checkbox" name="default_pop" value="yes" id="default_pop" 
        <?php if($vehicle_details->response->default_status == 1){echo "checked";}?>  />
    </label>
  </div>
  <div class="form-group">
    <select class="form-control" name="vehicle_status_pop" id="vehicle_status_pop">
      <option value="">Select Status</option>
      <option value="1" <?php if($vehicle_details->response->enable_status == 1){echo "selected";}?>>Enable</option>
      <option value="0" <?php if($vehicle_details->response->enable_status == 0){echo "selected";}?>>Desable</option>
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
        var vehicle_id = "<?php echo $vehicle_details->response->vehicle_id;?>";
        var vehicle_type_pop = $('select[name=vehicle_type_pop]').val();
        var vehicle_make_pop = $('select[name=vehicle_make_pop]').val();
        var vehicle_model_pop = $('select[name=vehicle_model_pop]').val();
        var vehicle_number_pop = $("#vehicle_number_pop").val();
        var vehicle_status_pop = $('select[name=vehicle_status_pop]').val();
        var default_pop = $("#default_pop").is(':checked') ? 1 : 0;

        $.ajax({
          "url"  : "<?php echo base_url('vehicles/edit');?>",
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
        "url"  : "<?php echo base_url('vehicles/get_pop_vehicle_make');?>",
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
          "url"  : "<?php echo base_url('vehicles/get_pop_vehicle_model');?>",
          "type" : "POST",
          "data" : ({'vehicle_make':vehicle_make_pop,'select_type':select_type_pop}),
          success:function(response){
          $('#modeldivid_pop').html(response);
          }
        });
      }
  }
  
</script>