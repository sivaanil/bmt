<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto E24yY; ZR3Wh: ydW08: goto ivwJ5; b0Mv9: ?>
"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
<?php  goto f5XH0; c7zOw: ?>
"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </td>
          </tr>
          <tr>
            <td scope="row"></td>
            <td>To</td>
            <td>
              <div class="input-group date" id="bs-datepicker-component">                  
                <input type="text" class="form-control" id="to" name="to" value="<?php  goto AXCZY; sz3o9: if (!isset($_GET["\146\162\x6f\155"])) { goto aDchK; } goto kCeI7; w14G6: echo $_GET["\x74\x6f"]; goto Mte8n; ipO9Q: echo KsFH8("\x76\145\x68\x69\143\154\x65\163"); goto TP3pK; ivwJ5: ?>
"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                <input type="text" class="form-control" id="from" name="from" value="<?php  goto sz3o9; qIb4O: echo kSfH8("\x76\145\150\x69\143\x6c\x65\x73\57\150\151\x73\x74\157\162\x79"); goto hKB1E; kCeI7: echo $_GET["\x66\162\157\155"]; goto Ku9Tj; JveBh: if (!($XFq9t == "\x76\x65\150\x69\x63\x6c\145\163" && $jLmhh == "\x68\151\x73\x74\157\x72\171")) { goto Pw3gF; } goto cNF6m; xBitY: if (!isset($_GET["\x63\x75\x72\x72\145\156\x74\137\144\x61\164\145"])) { goto ydW08; } goto piH2G; AXCZY: if (!isset($_GET["\x74\x6f"])) { goto zrGh9; } goto w14G6; pBlO_: echo KsfH8("\x70\162\157\x66\x69\x6c\145"); goto GgIBP; GgIBP: ?>
"><li>My Profile <i class="fa fa-angle-right pull-right"></i></li></a>
	     <a href="<?php  goto A2Bxn; Ku9Tj: aDchK: goto c7zOw; Mte8n: zrGh9: goto b0Mv9; TP3pK: ?>
" method="GET" name="reports" id="reports">
     <table class="table" style="margin-top:5%; margin-bottom:5%; border: 2px #DDD solid;">
      <thead>
        <tr>
          <td><strong>Day Report</strong></td>
          <td>
            <div class="input-group date" id="bs-datepicker-component-1">
              <input type="text" class="form-control" id="current_date" name="current_date" value="<?php  goto xBitY; ZxwSR: $XFq9t = $this->WQA4O->uPnwj(1); goto Obqyy; f5XH0: Pw3gF: goto luzjU; Obqyy: $jLmhh = $this->WQA4O->UPnWJ(2); goto JveBh; A2Bxn: echo KSfh8("\166\145\150\151\143\154\145\x73"); goto omg3q; cNF6m: ?>
       <form action="<?php  goto ipO9Q; piH2G: echo $_GET["\143\x75\162\162\145\x6e\164\x5f\144\141\x74\145"]; goto ZR3Wh; E24yY: ?>
<div class="col-md-3 left_menu">
     <!--<h1>OUR SERVICES</h1> -->
     <ul>
	     <a href="<?php  goto pBlO_; omg3q: ?>
"><li>Vehicle Details <i class="fa fa-angle-right pull-right"></i></li></a>
	     <a href="#"><li>E-Wallet <i class="fa fa-angle-right pull-right"></i></li></a>     
	     <a href="#"><li>Isuue Status<i class="fa fa-angle-right pull-right"></i></li></a>
	     <a href="<?php  goto qIb4O; hKB1E: ?>
"><li>History <i class="fa fa-angle-right pull-right"></i></li></a>
     </ul> 
     <?php  goto ZxwSR; luzjU: ?>
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
