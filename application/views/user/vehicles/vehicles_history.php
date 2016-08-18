
<!-- body start here -->
<div class="container-fluid inner-page-body">
  <div class="row">
    <div class="col-md-3 left_menu">
  </div>
  <div class="col-md-9 right_menu">
   
    <div class="register-container">
      <?php //print_r($history); 
      if(@$history->Historyinfo && !empty((array)$history->Historyinfo)) {?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Date</th>
            <th>Toll Center</th>
            <th>Amount</th>
            <th>Vehicle Number</th>
            <th>Payment status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($history->Historyinfo as $key => $value) {
            if(@$value->paid_status==1){
              $status = "SUCCESSFULL";
              $class = "text-success";
              }
              else{
                $status="UNSUCCESSFULL";
                $class = "text-danger";
              }            
            ?>
          <tr>
            <td scope="row"><?php echo @$value->date;?></th>
            <td><?php echo @$value->tollcenter;?></td>
            <td><?php echo @$value->amount;?></td>
            <td><?php echo @$value->vehiclenum;?></td>
            <td class="<?php echo @$class;?>"><?php echo @$status;?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
      <?php }else{?>
      <div class="row text-center" style="color:rgb(245, 47, 47);">No History Found......</div>
      <?php }?>
    </div>
  </div>
</div>  
</div>


    <!-- body end here -->