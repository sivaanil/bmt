<?php //echo "<pre>"; print_r($bank_types);exit;
  //echo "<pre>";print_r($response_charges_list);exit;
?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="tollcharges" name="tollcharges" action="<?php echo base_url('tollcenter/tollcharges');?>">
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
         <?php

          if(count($vehical_type_list) && !empty($vehical_type_list))
          {
            foreach ($vehical_type_list as $key => $value) 
            {
              ?>
              <option value="<?php echo $value->type_id;?>"><?php echo $value->type_name?></option>
              <?php
            }
          }
          else
          {
            ?>
            <option value="">NO Vehical Types</option>
            <?php
          }
          ?>
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
            <span style="color:red;"><?php echo validation_errors(); ?></span>
            <span id="error_message" class="text-center won_error"><?php echo $this->session->flashdata('errormsg');?></span>
            <span class="text-center"><?php echo $this->session->flashdata('msg');?></span>
            
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
      <?php 
      if(isset($response_charges_list) && count($response_charges_list))
      {
        foreach ($response_charges_list as $key => $value) 
        {
          ?>
          <tr>
            <td><?php echo @$value->tc_location?></td>
            <td><?php echo @$value->tc_name?></td>
            <td>
              <button type="button"  onclick='view_charger_details("<?php echo @$value->tc_id?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <button type="button"  onclick='edit_charger_details("<?php echo @$value->tc_id?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
              <!-- <button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><a href="javascript:void(0);" onclick="delete_vehicle('<?php //echo @$value->tc_id?>')"> Delete</a></button> -->
            </td>
          </tr>
          <?php
        }
      }
      else
      {
        ?>
        <tr>
          <td colspan="3">No Records Found</td>
        </tr>
        <?php
      }
      ?>
      
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
            "url":"<?php echo base_url('tollcenter/gettollcenternames');?>",
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
            "url":"<?php echo base_url('tollcenter/gettollcenternameforcharges');?>",
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
            "url":"<?php echo base_url('tollcenter/gettcn');?>",
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
        "url"  : "<?php echo base_url('tollcenter/get_single_charge_details');?>",
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
        "url"  : "<?php echo base_url('tollcenter/get_single_charge_details_for_view');?>",
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