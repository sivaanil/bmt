<div class="col-md-3 left_menu">
     <!--<h1>OUR SERVICES</h1> -->
     <ul>
	     <a href="<?php echo base_url('profile');?>"><li>My Profile <i class="fa fa-angle-right pull-right"></i></li></a>
	     <a href="<?php echo base_url('vehicles');?>"><li>Vehicle Details <i class="fa fa-angle-right pull-right"></i></li></a>
	     <a href="#"><li>E-Wallet <i class="fa fa-angle-right pull-right"></i></li></a>     
	     <a href="#"><li>Isuue Status<i class="fa fa-angle-right pull-right"></i></li></a>
	     <a href="<?php echo base_url('vehicles/history');?>"><li>History <i class="fa fa-angle-right pull-right"></i></li></a>
     </ul> 
     <?php
     $seg1 = $this->uri->segment(1);
     $seg2 = $this->uri->segment(2);
     if($seg1 == "vehicles" && $seg2 == "history"){
     ?>
       <form action="<?php echo base_url('vehicles');?>" method="GET" name="reports" id="reports">
     <table class="table" style="margin-top:5%; margin-bottom:5%; border: 2px #DDD solid;">
      <thead>
        <tr>
          <td><strong>Day Report</strong></td>
          <td>
            <div class="input-group date" id="bs-datepicker-component-1">
              <input type="text" class="form-control" id="current_date" name="current_date" value="<?php if(isset($_GET['current_date'])) echo $_GET['current_date']?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </td>
          <td></td>         
        </tr>
      </thead>
    
      <tbody>
          <tr>
            <td scope="row"><strong>Report Period</strong></td>
            <td>From</td>
            <td>
              <div class="input-group date" id="bs-datepicker-component-1">
                <input type="text" class="form-control" id="from" name="from" value="<?php if(isset($_GET['from'])) echo $_GET['from']?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </td>
          </tr>
          <tr>
            <td scope="row"></td>
            <td>To</td>
            <td>
              <div class="input-group date" id="bs-datepicker-component">                  
                <input type="text" class="form-control" id="to" name="to" value="<?php if(isset($_GET['to'])) echo $_GET['to']?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </td>
          </tr>
          <tr>
            <td scope="row"><strong></strong></td>
            <td><div>
          <button type="submit" class="btn btn-danger right_menu-button-small common-btn-pass">Search</button>
          </div></td>
            <td></td>
          </tr>
       
        <tr>
          <td scope="row"><strong>Export</strong></td>
          <td><i style="color:#09F;" class="fa fa-file-word-o"></i></td>
          <td></td>
        </tr>
        <tr>
          <td scope="row"><strong>Email</strong></td>
          <td colspan="2">
          
            <input type="text" placeholder="Email ID" class="form-control"></td>

        </tr>
      </tbody>
    </table>
          </form>
<?php }?>
</div>
<script type="text/javascript">
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
      maxDate:'-1970/01/02',
      onShow:function( ct ){
       this.setOptions({
        maxDate:jQuery('#to').val()?jQuery('#to').val():false
       })
      }
    });

    $('#from').on('change', function(){
      $('.xdsoft_datetimepicker').hide();
    });
    $("#to").datetimepicker({
      format:'d-m-Y',
      timepicker:false,
      scrollInput:false,
      maxDate:'-1970/01/02',
      onShow:function( ct ){
       this.setOptions({
        minDate:jQuery('#from').val()?jQuery('#from').val():true
       })
      }
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
        _all_: {placement:'left',html:true,trigger:'focus'}
      }
    });

    
  });
</script>