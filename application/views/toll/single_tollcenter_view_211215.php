<?php 
$data = @$toll_center_detal->response;
//pd($data);
?>
<div class="modal-header">
  <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">View</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">

<input type="hidden" name="toll_id" id="toll_id" value="<?php echo @$data->tc_id?>">
  <div class="form-group">
    <input type="text" class="form-control" id="toll_location_single" name="toll_location" value="<?php echo @$data->tc_location?>"  placeholder="Toll Centre Location">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="toll_name_single" name="toll_name" value="<?php echo @$data->tc_name?>"  placeholder="Toll Centre Name">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="entry_from_single" name="entry_from" value="<?php echo @$data->from_way_location?>"  placeholder="Entry From">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from_single" name="number_landes_from" value="<?php echo @$data->from_way_no_of_lanes?>" placeholder="No. of Lanes">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from_bmt_single" name="number_landes_from_bmt" value="<?php echo @$data->from_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
  </div>
  <div class="form-group">
  <?php
   if(!empty($data->becon_details))
   {
    foreach ($data->becon_details as $key => $value) 
    {
     if($value->beacon_id == $data->from_way_beacon_id)
     { 
      ?>
      <input class="form-control" type="hidden" name="from_uuid_id_single" id="from_uuid_id_single" value="<?php echo @$value->beacon_id?>">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_uuid_single" name="from_uuid" value="<?php echo @$value->uuid?>"  placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_major_id_single" name="from_major_id" value="<?php echo @$value->major_id?>"  placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_minor_id_single" name="from_minor_id" value="<?php echo @$value->minor_id?>"  placeholder="Beacon Minor Id">
        </div>
      <?php
     }
    }
   }
   ?>
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="entry_from2_single" name="entry_from2" value="<?php echo @$data->to_way_location?>" placeholder="Entry From">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from2_single" name="number_landes_from2" value="<?php echo @$data->to_way_no_of_lanes?>" placeholder="No. of Lanes">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from_bmt2_single" name="number_landes_from_bmt2" value="<?php echo @$data->to_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
  </div>
  <div class="form-group">
  <?php
   if(!empty($data->becon_details))
   {
    foreach ($data->becon_details as $key => $value) 
    {
     if($value->beacon_id == $data->to_way_beacon_id)
     { 
      ?>
      <input class="form-control" type="hidden" name="to_uuid_id_single" id="to_uuid_id_single" value="<?php echo @$value->beacon_id?>">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_uuid_single" name="to_uuid" value="<?php echo @$value->uuid?>"  placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_major_id_single" name="to_major_id" value="<?php echo @$value->major_id?>"  placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_minor_id_single" name="to_minor_id" value="<?php echo @$value->minor_id?>"  placeholder="Beacon Minor Id">
        </div>
      </div>
      <?php
     }
    }
   }
   ?>
   </div>
  
  

</div>
