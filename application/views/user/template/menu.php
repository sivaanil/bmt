<div class="col-md-3 left_menu">
     <!--<h1>OUR SERVICES</h1> -->
     <ul>
       <a href="<?php echo base_url('profile');?>"><li>My Profile <i class="fa fa-angle-right pull-right"></i></li></a>
       <a href="<?php echo base_url('vehicles');?>"><li>Vehicle Details <i class="fa fa-angle-right pull-right"></i></li></a>
<!--       <a href="<?php echo base_url('ewallet');?>"><li>E-Wallet <i class="fa fa-angle-right pull-right"></i></li></a>     -->
       <a href="<?php echo base_url('account');?>"><li>Account <i class="fa fa-angle-right pull-right"></i></li></a> 
       <a href="<?php echo base_url('userissues/feedback');?>"><li>Issue Status<i class="fa fa-angle-right pull-right"></i></li></a>
       <a href="<?php echo base_url('history');?>"><li>History <i class="fa fa-angle-right pull-right"></i></li></a>
     </ul> 
     <?php
      $seg1 = $this->uri->segment(1);
     $seg2 = $this->uri->segment(2);
     if($seg1 == "history"){
     ?>
     <div class="col-md-12 left_menu">
         <?php if(validation_errors()==true){?>
          <div  class="notification_msg text-center">
          <?php echo validation_errors('<li><span  style="color:red; padding: 0 0 0 8px;">', '</span></li>'); ?>
          </div> 
          <?php } ?>
          <?php  if((@$failure_message) !=''){?>
            <div class="text-center" style="color:red;">
              <?php echo $failure_message;?>
            </div>                
      <?php }?>  
       <?php  if(($this->session->flashdata('msg')) !=''){?>
            <div class="text-center" style="color:green;">
          <?php echo $this->session->flashdata('msg');?>
          </div>                
       <?php }?>

     </div>
       <!--<form action="<?php echo base_url('vehicles/history');?>" method="POST" name="reports" id="reports">-->
     <table class="table" style="margin-top:5%; margin-bottom:5%; border: 2px #DDD solid;">
      <thead>
        <tr>
          <td><strong>Day Report</strong></td>
          <td colspan="2">
            <div class="input-group date" id="bs-datepicker-component-1">
                <form method="post" action="<?php echo base_url('history/dateWise');?>" id="myform">
              <input type="text" class="form-control" id="current_date" name="current_date" 
                     value="<?php if(isset($_GET['current_date'])) echo $_GET['current_date']?>" onchange="getDate(this.value);">
              <?php //onchange="getDate(this.value);"?>
              </form>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </td>
        </tr>
      </thead> 
</table>
      
      <div id="periodform">
       <form method="post" action="<?php echo base_url('history/periodWise');?>">
        <table class="table" style="margin-top:5%; margin-bottom:5%; border: 2px #DDD solid;">
        <tbody>
          <tr>
            <td scope="row"><strong>Report Period</strong></td>
            <td colspan="2">
            <label>From</label>
              <div class="input-group date" id="bs-datepicker-component-1">
                <input type="text" class="form-control" id="from" name="from" value="<?php if(isset($from_date)) echo @$from_date;?>" autocomplete="off"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </td>
          </tr>
          <tr>
            <td scope="row"></td>
            <td colspan="2">
            <label>To</label>
              <div class="input-group date" id="bs-datepicker-component">                  
                <input type="text" class="form-control" id="to" name="to" value="<?php if(isset($to_date)) echo @$to_date;?>" autocomplete="off"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </td>
          </tr>
          <tr>
            <td scope="row"><strong></strong></td>
            <td>
            <div>
             <button type="submit" class="btn btn-success right_menu-button-small common-btn-pass">Search</button>
            </div>
            
          </td>
            <td><div><a href="<?php echo base_url('history');?>">
              <button type="button" class="btn btn-danger right_menu-button-small common-btn-pass">Reset</button>
            </a></div></td>
          </tr>
       
        <!-- <tr>
          <td scope="row"><strong>Export</strong></td>
          <td>
            <i style="color:#09F;" class="fa fa-file-word-o"></i>
             <button type="button" class="btn btn-info right_menu-button-small common-btn-pass" id="export">Export</button>
          </td>
          <td></td>
        </tr>
        <tr>
          <td scope="row"><strong>Email</strong></td>
          <td colspan="2">
          
            <input type="text" placeholder="Email ID" class="form-control"></td>

        </tr> -->
       
      </tbody>
    </table>
         </form>
        </div>  
<?php }?>
</div>
<script type="text/javascript">
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
  $(document).ready(function(){
    $("#current_date").datetimepicker({
      format:'d-m-Y',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });

    $('#current_date').on('change', function(){
      $('.xdsoft_datetimepicker').hide();
    });

    $("#from").datetimepicker({
      format:'d-m-Y',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    });

    $('#from').on('change', function(){
      $('.xdsoft_datetimepicker').hide();
    });
    $("#to").datetimepicker({
      format:'d-m-Y',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02'
    }); 

    $('#to').on('change', function(){
      $('.xdsoft_datetimepicker').hide();
    });

    jQuery.validator.addMethod("mydate", function(value, element) { 
       return this.optional(element) || /^(\d{2})-(\d{2})-(\d{4})$/.test(value); 
    }, "Please specify the date in DD-MM-YYYY format");
    

    $('#reports').validate({
      rules:{
        from:{required: true},
        to:{required: true}
       
      },
      messages:{
        from:{
              required:"Please select From Date."
            },
       to:{
            required:"Please select To Date."
          }
        },
       tooltip_options: {
        _all_: {placement:'top',html:true,trigger:'focus'}
      }
    });
  });
$("#export").click(function(){
  var start_date = $("#from").val();
  var end_date = $("#to").val();
  window.location.href = "<?php echo base_url('vehicles/download')?>/"+start_date+"/"+end_date;
});
</script>