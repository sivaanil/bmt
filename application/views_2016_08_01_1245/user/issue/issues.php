<?php 
 /* echo "<pre>";
  print_r($saved_vehicles->response->vehicleDetails);exit;*/
  //$saved_vehicles->response->vehicleDetails = "";
?>
<!-- body start here -->
<div class="container-fluid inner-page-body">
<div class="row col-md-9">
  <form name="imageUpload" class="form-horizontal" style="width:80%; margin:0 auto;" method="post" action="<?php echo base_url('userissues/feedback');?>" method="post" id="multiform" enctype="multipart/form-data">          

    <div class="col-md-9 right_menu">
<span style="color:green;font-size:14px;"><?php if(isset($sus)) echo $sus;?></span>
      <div class="form-group">

          <label for="inputPassword3" class="col-sm-3 control-label">Subject</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="subject" id="subject" value="" >
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Your Feedback</label>
          <div class="col-sm-9">
            <textarea class="form-control" rows="10" name="feedback" id="feedback"></textarea>
          </div>
        </div>
      <div class="form-group text-right">
             <div id="btnid">
            <button style="margin-right: 3%;" type="submit" class="btn save_changes common-btn-pass" name="submit">Send Feedback</button>
            </div>
        </div>

        <span style="color:red;font-size:14px;">
<?php if(isset($error)){   //print_r($error);
  echo implode(',',$error);}?>
        <?php echo validation_errors(); ?></span>
      
    </div>
  </div>
  </form>
  </div>
</div>



