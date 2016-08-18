<?php //pd($data);?>
<table class="table" style="width:90%; margin-left:5%; border: 1px #DDD solid;">
  <thead>
    <tr>
      <th>Toll Location</th>
      <th>Toll Name</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>A/C Number</th>
      <th>Bank Name</th>
      <th>Bank Address</th>
      <th>A/C Name</th>
      <th>View</th>
    </tr>
  </thead>
    <tbody>
    	<?php
    	if(isset($data) && !empty($data))
    	{
    		foreach ($data as $key => $value) 
    		{
    			?>
    				<tr>
    					<td><?php echo @$value->tc_location?></td>
    					<td><?php echo @$value->tc_name?></td>
    					<td><?php echo @$value->first_name.' '.$value->last_name?></td>
    					<td><?php echo @$value->email_id?></td>
    					<td><?php echo @$value->mobile_no?></td>
    					<td><?php echo @$value->bank_name?></td>
    					<td><?php echo @$value->ac_number?></td>
    					<td><?php echo @$value->bank_address?></td>
    					<td><?php echo @$value->ac_name?></td>
    					<td>
    						<button type="button"  onclick='edit_charger_details("<?php echo @$value->tc_id?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Charges</button>
    					</td>
    				</tr>
    			<?php
    		}
    	}
    	?>
    </tbody>
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

<script>
function edit_charger_details(id)
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
</script>