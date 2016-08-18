 <!-- body start here -->
 <?php 
 /*echo "<pre>";
print_r($user);exit;*/

 ?>
<div class="container-fluid inner-page-body">
   
    
     

          
          <div class="col-md-9 right_menu">
           <div class="row">
              
              <div class="col-md-12 col-sm-12 new-row">
              Select the period of report to be generated
              </div>
              </div>
              <div class="row">
              <div class="col-md-12 col-sm-12 new-row">
              Consolldated Report for User List
              </div>
              </div>
          <?php //echo "<pre>"; print_r($historyinfo);exit;?>
            <div class="row">
                   <div class="col-md-16 col-sm-16">
                   <table class="table" style="width:90%; margin:0 auto; border: 1px #DDD solid;">
      <thead>
        <tr>
         <th>SNo</th>
          <th>Toll Center</th>
          <th>Vehicle Number</th>
          <th>Amount</th>
          <th>Paid Status</th>
          <th>Pass Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>

<?php $i=1;
//echo "<pre>"; print_r($historyinfo);exit;
if(!empty($historyinfo)){ 
foreach($historyinfo as $each){
?>
    <tr>
          <td scope="row"><?php echo $i;?></td>
          <td><?php echo $each->tc_location;?></td>
          <td><?php echo $each->vehicle_no;?></td>
          <td><?php echo $each->total_amount;?></td>
          
          <td><?php if($each->paid_status==0)echo "No";else echo "Yes";?></td>
          <td><?php if($each->passing_status==0)echo "No";else echo "Yes";?></td>
          <td><?php echo $each->transaction_date;?></td>
        </tr>
	<?php $i++;}}else{ //echo "gg";?>

       <tr>
          <td colspan="7"><?php echo "No Transactions for selected date";?></td>
      </tr>
  <?php }?>

        
        
        
      </tbody>
    </table>

        </div>  <!--right menu end-->
             
      

  </div>  
</div>
</div>

