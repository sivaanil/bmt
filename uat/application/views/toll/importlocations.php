<?php 
//echo "<pre>";print_r($listTollCenterLocations);echo "</pre>";exit;
?>
<div class="col-md-9 right_menu">
<?php 
if($errors == 1){?>
	<span style="color:red;align='center'">Sorry! only csv files are allowed to upload</span>
<?php }if($errors == 2){?>
	<span style="color:green;align='center'">File Upload Successfully</span>
<?php } ?>

<br/>
<form name="import" method="post" enctype="multipart/form-data" action="<?php echo base_url('tollcenter/positions');?>">
<input type="file" name="importlocations" style="display:inline">
<input type="submit" name="submit" value="Upload">
</form>
<a href='/php_csv_export.php' style="color:blue;align='center'" target="_blank">Download sample file</a>

<div class="row">
    <table class="table" style="width:90%; margin-left:5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Toll Center</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      if(isset($listTollCenterLocations->TollCcenterDetails) && !empty($listTollCenterLocations->TollCcenterDetails))
      {
        foreach (@$listTollCenterLocations->TollCcenterDetails as $key => $value) 
        {
          //pd($value);
         ?>
          <tr>
              <td><?php echo  @$value->tc_id; ?></td>
            <td><?php echo  @$value->tc_name.' - '.$value->tc_location?></td>
          </tr>
        <?php 
        }
      }
      else
      {
      ?>
      <tr><td colspan="4">No Records Found</td></tr>
      <?php
      }
      ?>
      </tbody>
    </table>
  </div>  
</div>