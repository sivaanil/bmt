<div class="container-fluid inner-page-body">
   <div class="row">
    <?php if($this->role_id == 1 && ($this->uri->segment(1) == 'tollcenter' || $this->uri->segment(1) == 'issues'))
    {
      ?>
      <div class="col-md-3 left_menu">
           <ul>
           <a href="<?php echo base_url('tollcenter');?>"><li>Toll Center Details<i class="fa fa-angle-right pull-right"></i></li></a>
           <a href="<?php echo base_url('tollcenter/addsemiadmin');?>"><li>Semi Admin Details<i class="fa fa-angle-right pull-right"></i></li></a>
           <a href="<?php echo base_url('tollcenter/tollcharges');?>"><li>Toll Charges<i class="fa fa-angle-right pull-right"></i></li></a>
           
           <a href="<?php echo base_url('tollcenter/addbankdetails');?>"><li>Toll Center Bank Details<i class="fa fa-angle-right pull-right"></i></li></a>
           <a href="<?php echo base_url('tollcenter/refundstatus');?>"><li>Refund Status<i class="fa fa-angle-right pull-right"></i><i class="user"></i></li></a>
           <a href="<?php echo base_url('tollcenter/positions');?>"><li>Import Geofence Locations<i class="fa fa-angle-right pull-right"></i></li></a>
<!--            <a href="<?php echo base_url('issues/feedback');?>"><li>Issues <i class="fa fa-angle-right pull-right"></i></li></a>-->
           </ul> 
      </div>
      <?php
    }
    ?>
    <?php if($this->role_id == 3 && $this->uri->segment(1) != 'view')
    {
      ?>
      <div class="col-md-3 left_menu">
        <ul>
          <a href="<?php echo base_url('addtolloperator');?>"><li>Toll Staff Details <i class="fa fa-angle-right pull-right"></i></li></a>
          <a href="<?php echo base_url('lanedetails');?>"><li>BMT Lane Details<i class="fa fa-angle-right pull-right"></i></li></a>
          <a href="<?php echo base_url('issues/feedback');?>"><li>Issues <i class="fa fa-angle-right pull-right"></i></li></a>
        </ul>
      </div>
      <?php
    }
    ?>

  <script>
  $(function() {
   // $( "#datepicker" ).datepicker();

$("#datepicker").datetimepicker({
      format:'Y-m-d',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });
    $('.datepickercls').on('change', function(){
        $('.xdsoft_datetimepicker').hide();
    });
$("#fromdatepicker").datetimepicker({
      format:'Y-m-d',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });
$("#todatepicker").datetimepicker({
      format:'Y-m-d',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });
$("#filter_date").datetimepicker({
      format:'Y-m-d',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });
$("#filter_from_date").datetimepicker({
      format:'Y-m-d',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });
$("#filter_to_date").datetimepicker({
      format:'Y-m-d',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });
  });
  function getDate(date){
    //alert(date);
    if(date){
      document.forms["myform"].submit();
    }
   /* $.ajax({
          "url"  : "<?php echo base_url('tolloperator/getDateHistory');?>",
          "type" : "POST",
          "data" : ({'date':date}),
          success:function(response){
            alert(response);
            // $("#pop_view").text("");
             //$("#pop_view").append(response);            
          }
        });*/
  }
  </script>
<?php if($this->role_id == 4){?>
        <div class="col-md-3 left_menu">
                   <ul>
        <?php
                    $uri=$this->uri->segment(2);
                    
                        if($uri!='dialyoperations' && $uri!='history' && $uri!='getDateHistory' && $uri!='getPeriodHistory'){
                    ?>               
                  <a href="<?php echo base_url('tolloperator/dialyoperations');?>"><li>Daily Transactions<i class="fa fa-angle-right pull-right"></i></li></a>  
                    <a href="<?php echo base_url('issues/feedback');?>"><li>Issues <i class="fa fa-angle-right pull-right"></i></li></a>
                        <?php }else if($uri=='history' || $uri=='getDateHistory' || $uri=='getPeriodHistory'){?>      
                     <a href="#"><li>Consolidated Report <i class="fa fa-angle-right pull-right"></i></li></a>
                    
                     <table class="table" style="margin-top:5%; margin-bottom:5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <td><strong>Day Report</strong></td>
          <td colspan="2"> 
          <form action="<?php echo base_url('tolloperator/getDateHistory');?>" method="post" id="myform">
          <input type="text" id="datepicker" name="date_wise" style="color:#000;" onchange="getDate(this.value);" class="datepickercls"> 
          </form>
          </td>
          
         
        </tr>
      </thead>
      <tbody>

      <form action="<?php echo base_url('tolloperator/getPeriodHistory');?>" method="post" id="myform">
        <tr>
          <td scope="row"><strong>Period Report</strong></td>
          <td>From</td>
          <td><input type="text" style="color:#000;" id="fromdatepicker" name="from_date" class="datepickercls"></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td>To</td>
          <td><input type="text" style="color:#000;" id="todatepicker" name="to_date" class="datepickercls"> </td>
        </tr>
        <tr>
        <td colspan="3">
          <input type="submit" value="submit Period" name="submit" style="color:#000;float:right;">
        </td>
        </tr>
        </form>

        <tr>
          <td scope="row"><strong>Export</strong></td>
          <td><i style="color:#09F;" class="fa fa-file-word-o"></i></td>
          <td></td>
        </tr>
        <tr>
          <td scope="row"><strong>Email</strong></td>
          <td colspan="2" class="text-right"><input type="text" class="form-control" /></td>
        </tr>
      </tbody>
    </table> 
                   <a href="#"><li>Reports based on filters<i class="fa fa-angle-right pull-right"></i></li></a>
    <table class="table" style="margin-top:5%; margin-bottom:5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <td><strong>Day Report</strong></td>
          <td colspan="2"> 
         <input type="text" style="color:#000;" id="filter_date" name="filter_date">
          </td>          
        </tr>
        <tr>
         <td scope="row"><strong>Period Report</strong></td>
          <td>From</td>
          <td><input type="text" style="color:#000;" id="filter_from_date" name="filter_from_date" class="datepickercls"></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td>To</td>
          <td><input type="text" style="color:#000;" id="filter_to_date" name="filter_to_date" class="datepickercls"> </td>
        </tr>
      </thead>
      <tbody>
      
                       
                  <tr>  
                      <td colspan="3"> 
                   <select class="history-select" name="vtype" id="vtype" onchange="getTypesHistory(this.value);">
                   <option value="">Vehicle Type</option>
                   <?php if(!empty($vehicle_types)){ //echo "<pre>"; print_r($vehicle_types);
                       foreach($vehicle_types->response as $each){
                       ?>
                   <option value="<?php echo $each->type_id;?>"><?php echo $each->type_name;?></option>
                       <?php }}?>
                   
                   </select> 
                      </td>
                  </tr>  
                   <tr>  
                       <td colspan="3"> 
                   <select class="history-select">
                   <option>User Registration Type</option>
                   <option value="m">M</option>
                   <option value="w">W</option>
                   <option value="all">All</option>
                   </select>
                        </td>
                   </tr>  
                   
<!--                   <tr>  
                       <td colspan="2"> 
                   <select class="history-select">
                   <option>Lane wise</option>
                   <option>M</option>
                   <option>W</option>
                   <option>All</option>
                   </select>
                  </td>
                  </tr>  -->
                  <tr>  
                          <td colspan="3">
                              <input type="text" value="" placeholder="Enter Specific Vehicle Number" name="spv" id="spv">
                 
                         </td>
                  </tr>  
         
                    </tbody>
                    </table>
                        <?php }?>        
                       
                       </ul>
            </div>
<?php } if($this->role_id == 1){?>
  <div class="col-md-3 left_menu">

                   <ul>
        <?php
                  $uri=$this->uri->segment(1);
                    
                    ?>               
                
                        <?php  if($uri=='staffhistory'){?>      
                     <a href="#"><li>Consolidated Report <i class="fa fa-angle-right pull-right"></i></li></a>
                    
                     <table class="table" style="margin-top:5%; margin-bottom:5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <td><strong>Day Report</strong></td>
          <td colspan="2"> 
          <form action="<?php echo base_url('staffhistory/getDateHistory');?>" method="post" id="myform">
             
              <input type="text" id="datepicker" name="date_wise" style="color:#000;" onchange="getDate(this.value);" class="datepickercls"> 
          </form>
          </td>
          
         
        </tr>
      </thead>
      <tbody>

      <form action="<?php //echo base_url('staffhistory/getPeriodHistory');?>" method="post">
        <tr>
          <td scope="row"><strong>Period Report</strong></td>
          <td>From</td>
          <td><input type="text" style="color:#000;" id="fromdatepicker" name="from_date"  class="datepickercls"></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td>To</td>
          <td><input type="text" style="color:#000;" id="todatepicker" name="to_date"  class="datepickercls"> </td>
        </tr>
        <tr>
        <td colspan="3">
          <input type="submit" value="submit Period" name="submit" style="color:#000;float:right;">
        </td>
        </tr>
        </form>

        <tr>
          <td scope="row"><strong>Export</strong></td>
          <td><i style="color:#09F;" class="fa fa-file-word-o"></i></td>
          <td></td>
        </tr>
        <tr>
          <td scope="row"><strong>Email</strong></td>
          <td colspan="2" class="text-right"><input type="text" class="form-control" /></td>
        </tr>
      </tbody>
    </table> 
                   <a href="#"><li>Reports based on filters<i class="fa fa-angle-right pull-right"></i></li></a>
    <table class="table" style="margin-top:5%; margin-bottom:5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <td><strong>Day Report</strong></td>
          <td colspan="2"> 
         <input type="text" style="color:#000;" id="filter_date" name="filter_date">
          </td>          
        </tr>
        <tr>
         <td scope="row"><strong>Period Report</strong></td>
          <td>From</td>
          <td><input type="text" style="color:#000;" id="filter_from_date" name="filter_from_date"></td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td>To</td>
          <td><input type="text" style="color:#000;" id="filter_to_date" name="filter_to_date"> </td>
        </tr>
      </thead>
      <tbody>
      
                       
                  <tr>  
                      <td colspan="3"> 
                   <select class="history-select" name="vtype" id="vtype" onchange="getTypesHistory(this.value);">
                   <option value="">Vehicle Type</option>
                   <?php if(!empty($vehicle_types)){ //echo "<pre>"; print_r($vehicle_types);
                       foreach($vehicle_types->response as $each){
                       ?>
                   <option value="<?php echo $each->type_id;?>"><?php echo $each->type_name;?></option>
                       <?php }}?>
                   
                   </select>        </td>
                  </tr>  
                   <tr>  
                       <td colspan="3"> 
                   <select class="history-select">
                   <option>User Registration Type</option>
                   <option value="m">M</option>
                   <option value="w">W</option>
                   <option value="all">All</option>
                   </select>
                        </td>
                   </tr>  
                   
<!--                   <tr>  
                       <td colspan="2"> 
                   <select class="history-select">
                   <option>Lane wise</option>
                   <option>M</option>
                   <option>W</option>
                   <option>All</option>
                   </select>
                  </td>
                  </tr>  -->
                  <tr>  
                          <td colspan="3">
                              <input type="text" value="" placeholder="Enter Specific Vehicle Number" name="spv" id="spv">
                 
                         </td>
                  </tr>  
         
                    </tbody>
                    </table>
                        <?php }?>        
                       
                       </ul>
            </div>
<?php }?>
 <script type="text/javascript">
      function getTypesHistory(vid){
         // alert(vid);
          
      }
      </script>