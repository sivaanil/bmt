<?php 
 /* echo "<pre>";
  print_r($saved_vehicles->response->vehicleDetails);exit;*/
  //$saved_vehicles->response->vehicleDetails = "";
?>
<!-- body start here -->
<div class="container-fluid inner-page-body">
  <div class="row">             
    <div class="col-md-9 right_menu">

      <?php if(validation_errors()==true){?>
          <div  class="notification_msg text-center">
          <?php echo validation_errors('<li><span  style="color:red; padding: 0 0 0 8px;">', '</span></li>'); ?>
          </div> 
          <?php } ?>
          <?php  if(($failure_message) !=''){?>
            <div class="text-center" style="color:red;">
              <?php echo $failure_message;?>
            </div>                
      <?php }?>  
       <?php  if(($this->session->flashdata('msg')) !=''){?>
            <div class="text-center" style="color:green;">
          <?php echo $this->session->flashdata('msg');?>
          </div>                
       <?php }  //print_r($vehicle_types->response);exit;?>

      <div class="col-md-12">
        <form id="contactForm_1" action="<?php echo base_url('vehicles');?>" method="POST">
          <div class="col-md-3 col-sm-4">
          <div class="row control-group common-form">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <select class="form-control" name="vehicle_type" id="vehicle_type">
                <option value="">Vehicle Type</option>
                  <?php
                 
                    foreach ($vehicle_types->response as $value) {
                  ?>
                    <option value="<?php echo $value->type_id;?>"><?php echo $value->type_name;?></option>
                  <?php 
                    } 
                  ?>
              </select>
            </div>
          </div>
         
        </div>
        <div class="col-md-3 col-sm-4">         
          <div class="row control-group common-form">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <div id="makedivid">
              <select class="form-control" name="vehicle_make" id="vehicle_make">
              <option>Vehicle Make</option>
              </select>
                </div>
            </div>
          </div>
<!--          <div class="row control-group common-form">
            <div class="col-xs-12" style="border-bottom: 1px #C2C2C2 solid; padding-left: 23px; border-bottom:0px;">
              <label style="font-weight: normal; font-size: 13px; text-transform: uppercase;">Deafualt</label> <input class="pull-right" name="default" type="checkbox" value="yes" />
            </div>
          </div>         -->
        </div>

        <div class="col-md-3 col-sm-4">         
            <div class="row control-group common-form">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                  <div id="modeldivid">
                <select class="form-control" name="vehicle_model" id="vehicle_model">
                  <option>Vehicle Model</option>
                </select>
                  </div>
              </div>
            </div>

<!--            <div class="row control-group common-form">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                <select class="form-control" name="vehicle_status">
                  <option value="0">Enable</option>
                  <option value="1">Disable</option>
                </select>
              </div>
            </div>-->
          
        </div>
        <div class="col-md-3 col-sm-4">         
            <div class="row control-group common-form">
              <div class="form-group col-xs-12 floating-label-form-group controls">                 
              <input style="padding-left: 9px;" type="text" name="vehicle_number" id="vehicle_number" class="form-control" placeholder="Vehicle No" />           
              </div>
            </div>          
        </div>
        </div>
        <div class="col-md-12 text-right">
              <button type="submit" class="btn save_changes common-btn-pass" style="margin:15px; margin-right:29px;">Add</button>
              </div>
              
      </form>
        
        
      <br>
      <div class="col-md-12">
          
         <?php if(@$saved_vehicles->response && !empty($saved_vehicles->response)) {?>
      <form action="<?php echo base_url('vehicles/enable_vehicles')?>" method="POST">
      <table class="table" style="width:92%; margin-left:4%; border: 1px #DDD solid;">
      <thead>
      <tr>
      <th>Vechile Type</th>
      <th>Vechile Make</th>
      <th>Vechile Model</th>
      <th>Vechile No </th>
      <th>Enable/Disable</th>
      <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <?php 
     // print_r(@$saved_vehicles->response);exit;
      foreach (@$saved_vehicles->response as $value) {
      //  echo  $value->enable_status;
         $default=$value->default_status;
         if($default=='1'){
         $bgcolor="style='background:#585858'";
     }else{
      $bgcolor="";
     }
          ?>
      <tr <?php echo $bgcolor;?>>
      <td scope="row"><?php echo @$value->type_name?></td>
      <td scope="row"><?php echo @$value->make_name?></td>
      <td scope="row"><?php echo @$value->model_name?></td>
      <td><?php echo @$value->vehicle_no?>  </td>
      <td><input value="<?php echo @$value->vehicle_id;?>" type="checkbox" name="checked_vehicle[]" <?php if($value->enable_status == '1'){echo "checked";}else{echo "";}?> /></td>
      <td><button type="button"  onclick='edit_vehicle("<?php echo @$value->vehicle_id; ?>")' class="btn btn-success right_menu-button-small common-btn-pass" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
           <button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small common-btn-pass" onClick="deleteVehicle(<?php echo  $value->vehicle_id;?>)">
               Delete
           </button>
      </td>
      </tr>
      <?php }?>
      </table>

    <div class="col-md-12 text-right">
        <button style="margin:15px; margin-right:14px; margin-top:0px;" type="submit" id="enablesave" 
        value="Enable" class="btn btn-success right_menu-button-small common-btn-pass" >Update</button>
      </div>
      </form>
      <?php }else{?>
      <div class="row text-center" style="color:rgb(245, 47, 47);">No Vehicles are not created......</div>
      <?php }?>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content" id="pop_view">
        </div>
      </div>
    </div>
    </div>
    </div>


  </div>
</div>  
</div>


<!-- body end here -->
<script type="text/javascript">
/*$("#enablesave").on('click',function(){
  alert(1);

  });

   */          
  function edit_vehicle(id)
  {
    if(id !='')
      {
        $.ajax({
          "url"  : "<?php echo base_url('vehicles/get_single_vehicle');?>",
          "type" : "POST",
          "data" : ({'id':id}),
          success:function(response){
             $("#pop_view").text("");
             $("#pop_view").append(response);            
          }
        });
      }
  }
 
  function deleteVehicle(vehicle_id)
{//alert(vehicle_id);
  alertify.confirm("Are you sure, You want to Delete this Vehicle?", function (e) {
  if (e) {
          window.location.href = "<?php echo base_url('vehicles/delete_vehicle')?>/"+vehicle_id;
        }
    });
}

jQuery.validator.addMethod("validate_vehicle", function(value, element) {
      return this.optional( element ) || /^[a-z A-Z]{2}[ -][0-9]{1,2}(?: [a-z A-Z])?(?: [a-z A-Z]*)? [0-9]{4}$/.test( value ) || /^[0-9]{10,10}$/.test(value);
    }, 'Please Enter valid vehicle number(EX: AP 12 HY 1234).');

  $(document).ready(function(){
    $('#contactForm_1').validate({
      rules:{
        vehicle_type:{required: true},
        vehicle_number:{required: true,validate_vehicle:true},
        vehicle_make:{required: true},
        vehicle_model:{required: true}
      },
      messages:{
        vehicle_type:{
            required:"Please select vehicle type."
       },
       vehicle_number:{
                required:"Please Enter vehicle number."
               },
       
       vehicle_make:{
                required:"Please select vehicle make."
               },
       
       vehicle_model:{
                required:"Please select vehicle model."
               }
       
        },
       tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
});
  $("#vehicle_type").on('change',function(){
    $('#vehicle_make').text('');
    $('#vehicle_model').text('');
    var select_type =  this.value;
    if(select_type !='')
    {
      $.ajax({
        "url"  : "<?php echo base_url('vehicles/get_vehicle_make');?>",
        "type" : "POST",
        "data" : ({'select_type':select_type}),
        success:function(response){
            $('#makedivid').html(response);
//          var data = $.parseJSON(response);
//          alert(data);
//          console.log(data.response.vehicleMake);
//          $('#vehicle_make').append('<option value="">Vehicle Make</option');
//          $.each(data, function (i, item) {
//              alert(i);
//            console.log(i);
//              $('#vehicle_make').append($('<option value='+i+'>'+item+'</option>'));
//          });
        }
      });
    }
  });
 
//  $("#vehicle_make").on('change',function(){
//      $('#vehicle_model').text('');
//      var select_type = $("#vehicle_type").val();
//      var vehicle_make =  this.value;
//      alert(vehicle_make);
//      if(vehicle_make !='')
//      {
//        $.ajax({
//          "url"  : "<?php echo base_url('vehicles/get_vehicle_model');?>",
//          "type" : "POST",
//          "data" : ({'vehicle_make':vehicle_make,'select_type':select_type}),
//          success:function(response){
//              $('#modeldivid').html(response);
////            var data = $.parseJSON(response);
////            //console.log(data.response.vehicleModel);return false;
////            $('#vehicle_model').append('<option value="">Vehicle Model</option');
////            $.each(data.response.vehicleModel, function (i, item) {
////                $('#vehicle_model').append($('<option value='+i+'>'+item+'</option>'));
////            });
//          }
//        });
//      }
//  });
   function getModel(){
 // alert($('#vehicle_make').val());
   $('#vehicle_model').text('');
      var select_type = $("#vehicle_type").val();
      var vehicle_make = $('#vehicle_make').val();
     // alert(vehicle_make);
      if(vehicle_make !='')
      {
        $.ajax({
          "url"  : "<?php echo base_url('vehicles/get_vehicle_model');?>",
          "type" : "POST",
          "data" : ({'vehicle_make':vehicle_make,'select_type':select_type}),
          success:function(response){
              $('#modeldivid').html(response);
//            var data = $.parseJSON(response);
//            //console.log(data.response.vehicleModel);return false;
//            $('#vehicle_model').append('<option value="">Vehicle Model</option');
//            $.each(data.response.vehicleModel, function (i, item) {
//                $('#vehicle_model').append($('<option value='+i+'>'+item+'</option>'));
//            });
          }
        });
      }
  }
</script>

