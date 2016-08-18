<?php 
  //echo "<pre>";print_r($semiadmin_details);exit;
//echo $this->role_id;exit;
?>
<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">View</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
  <input type="hidden" name="update_id" id="update_id" value="<?php echo @$semiadmin_details->ts_id;?>">
  <div class="form-group">
    <?php
    if($this->role_id == 1)
    {
    ?>
    <select  style="color:#0C0C0C;" class="form-control" id="toll_center_loaction_single" name="toll_center_loaction" onchange="getcentername_single()">
     <option value="<?php echo $semiadmin_details->tc_location;?>"><?php echo @$semiadmin_details->tc_location?></option>
    </select>
    <?php }?>
  </div>
  <div class="form-group">
  <?php
  if($this->role_id == 1)
  {
  ?>
    <select style="color:#0C0C0C;" class="form-control" id="toll_center_name_single" name="toll_center_name" onchange="gettcn_single()">
      <option value="<?php echo @$semiadmin_details->tc_name?>"><?php echo $semiadmin_details->tc_name?></option>
    </select>
  <?php  
  } 
  ?>
  </div>
  <div class="form-group">
    <div class="form-group">
        <input type="hidden" class="form-control" value="<?php echo @$semiadmin_details->tc_id?>"  id="tcn_single" name="tcn" placeholder="TCN" style="background-color: #FFFFFF;" readonly="off">
  </div>
  <div class="form-group">
    <div class="form-group">
      <input type="text" class="form-control" id="first_name_single" name="first_name" value="<?php echo @$semiadmin_details->first_name?>" placeholder="First Name">
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="last_name_single" name="last_name" value="<?php echo @$semiadmin_details->last_name?>" placeholder="Last Name">
  </div>
  <?php
  if($this->role_id == 1)
  {
  ?>
  <div class="form-group">
    <select style="color:#0C0C0C;" class="form-control" id="roll_single" name="roll">
      <?php if(isset($semiadmin_details->roll_id) && @$semiadmin_details->roll_id == 3)
      {
        ?>
        <option value="3">Semi Admin</option>
        <?php
      }
      ?>
      <?php if(isset($semiadmin_details->roll_id) && @$semiadmin_details->roll_id == 2)
      {
        ?>
        <option value="2">Admin</option>
        <?php
      }
      ?>
    </select>
  </div>
  <?php  
  } 
  ?>
  <div class="form-group">
    <input type="text" class="form-control" id="eamil_single" name="eamil" value="<?php echo @$semiadmin_details->email_id?>" placeholder="Email ID">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="mobile_number_single" name="mobile_number" value="<?php echo @$semiadmin_details->mobile_no?>" placeholder="Mobile Number">
  </div>
  <!-- <div class="form-group">
        <input type="text" class="form-control" id="password_single" name="password" value="<?php //echo @$semiadmin_details->password?>" placeholder="Password">
      </div> -->
 <div class="form-group">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_view">Cancel</button>
    
  </div>
</div>
<script type="text/javascript">
 
  $("#cancel_single_view").click(function(){
    location.reload();
  });
</script>