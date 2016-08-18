
         <div class="row">
             <?php 
            //echo "<pre>"; print_r($mobileinfo); var_dump($webinfo);
             
             ?>
              <div class="col-md-6 left_menu" style="text-align:center;">
                   <h1>Non Smart Phone Users</h1> 
<!--                   <div style="font-size:12px;color:#339900;font-weight: bold;text-transform: capitalize;"><?php if($this->session->flashdata('mbmsg')){echo $this->session->flashdata('mbmsg');}?></div>-->
                   <table class="table" style="margin:0 auto; border: 1px #DDD solid; margin-bottom:10px;">
      <thead>
      <tr>
      <td colspan="8" style="padding:0;"><form class="form-horizontal">
                     <div class="form-group" style="margin-bottom: -1px;">
                     <input placeholder="Search Vehicle Number" style="width:90%; margin:0 auto;" type="text" id="mvnum" name="mvnum" class="form-control">
                     <div id="list"></div>
                     </div>
                   </form></td>
      </tr>
        <tr>
          <th>S.No</th>
          <th>Vehicle No </th>
          <th>Type</th>
          <th>Make</th>
          <th>Model</th>
          <th>Amount</th>
          <th>Paid</th>
          <th>Allow</th>
        </tr>
      </thead>
      <tbody id="majaxsus">
          <?php 
          //print_r($mobileinfo);
           if(isset($mobileinfo) && !empty($mobileinfo)){
          $i=1;
          foreach($mobileinfo as $info){
             $tcid=$this->encrypt->encode_my($info->tc_id); 
             $tcname=$this->encrypt->encode_my($info->tc_name); 
             $uid=$this->encrypt->encode_my($info->user_id); 
             $vid=$this->encrypt->encode_my($info->vehicle_id);
             $psts=$this->encrypt->encode_my($info->passing_status);
             $paid=$this->encrypt->encode_my($info->paid_status);
             $vno=$this->encrypt->encode_my($info->vehicle_no);

             $email=$this->encrypt->encode_my($info->email_id);
             $mb=$this->encrypt->encode_my($info->mobile_no);
             $toll=$this->encrypt->encode_my($info->toll_charge);
             $bmt=$this->encrypt->encode_my($info->bmt_charge);
             $tot=$this->encrypt->encode_my($info->total_amount);
              ?>
        <tr>
          <th scope="row"><?php echo $i;?></th>
          <td><?php echo $info->vehicle_no;?></td>
          <td><?php echo $info->type_name;?></td>
          <td><?php echo $info->make_name;?></td>
          <td><?php echo $info->model_name;?></td>
          <td style="text-align:center;"><?php echo $info->total_amount;?></td>
          <td style="text-align:center;"><?php if($info->paid_status==1){echo "Yes";}else{echo "No";}?></td>
          <td style="text-align:center;">
              <input type="hidden" id="psts" name="psts" value="<?php echo $info->passing_status;?>">
              <a href="<?php echo base_url('tolloperator/changeStatus?tcid='.$tcid.'&uid='.$uid.'&vid='.$vid.'&psts='.$psts.'&paid='.$paid.'&email='.$email.'&mb='.$mb.'&toll='.$toll.'&bmt='.$bmt.'&tot='.$tot.'&tcname='.$tcname.'&vno='.$vno);?>" class="btn btn-success common-btn-pass"><?php if($info->passing_status==0){echo "PASS";}?></a>
          </td>
        </tr>
           <?php $i++; }}
           else{
               ?>
        <tr><td colspan="8">No Registered Vehicles Found</td> </tr>
                   <?php
           }
           ?>
       
      </tbody>
    </table> 
              </div>
              <div class="col-md-6 right_menu" style="text-align:center;">
                   <h1 style="font-size:22px; font-weight:normal; margin-top:9px;">Smart Phone Users</h1> 
                   
<!-- <div style="font-size:12px;color:#339900;font-weight: bold;text-transform: capitalize;"><?php if($this->session->flashdata('wbmsg')){echo $this->session->flashdata('wbmsg');}?></div>                  -->
                   
                   <table class="table" style="width:95%; margin:0 auto; border: 1px #DDD solid; margin-bottom:10px;">
      <thead>
      <tr>
      <td colspan="7" style="padding:0;"><form class="form-horizontal">
                     <div class="form-group" style="margin-bottom: -1px;">
                     <input placeholder="Search Vehicle Number" style="width:90%; margin:0 auto;" type="text" id="vnum" name="vnum" class="form-control">
                     <div id="list"></div>
                     </div>
                   </form></td>
      </tr>
        <tr>
          <th>S.No</th>
          <th> Vehicle No </th>
          <th> Type </th>
          <th>Amount</th>
          <!--<th>Charge</th>-->
          <th>Paid</th>
          <th>Allow</th>
        </tr>
      </thead>
      <tbody id="ajaxsus">
          <?php 
         // echo "<pre>"; print_r($webinfo);exit;
          if(isset($webinfo)&& !empty($webinfo)){
          $j=1;
          foreach($webinfo as $info){
             
             $tcid=$this->encrypt->encode_my($info->tc_id); 
             $tcname=$this->encrypt->encode_my($info->tc_name); 
             $uid=$this->encrypt->encode_my($info->user_id); 
             $vid=$this->encrypt->encode_my($info->vehicle_id);

              $vno=$this->encrypt->encode_my($info->vehicle_no);

             $email=$this->encrypt->encode_my($info->email_id);
             $mb=$this->encrypt->encode_my($info->mobile_no);
             $toll=$this->encrypt->encode_my($info->toll_charge);
             $bmt=$this->encrypt->encode_my($info->bmt_charge);
             $tot=$this->encrypt->encode_my($info->total_amount);

             $psts=$this->encrypt->encode_my($info->passing_status);
             $paid=$this->encrypt->encode_my($info->paid_status);
             $deviceid=$info->mobile_device_id;
             if(is_null($deviceid)){
                 $regtype=0; 
             }else{
                 $regtype=$deviceid;  
             }
              ?>
          <?php if($info->paid_status==1){$var= "false";}else{$var= "true";}?>
        <tr>
          <th scope="row"><?php echo $j;?></th>
          <td><?php echo $info->vehicle_no;?></td>
          <td><?php echo $info->type_name;?></td>
          <td><?php echo $info->total_amount;?></td>
          <!--<td><input type="button" id="chanrge" value="Charge" disabled class="btn btn-success right_menu-button-small common-btn-pass"/> </td>-->
          <!--
          <td>
              <input type="button" id="chanrge" name="charge<?php echo $j;?>"  
              onclick="getCharge('<?php echo $info->email_id;?>',<?php echo $info->tc_id;?>,<?php echo $info->user_id;?>,<?php echo $info->type_id;?>,
              <?php echo $info->make_id;?>,<?php echo $info->model_id;?>,<?php echo $info->vehicle_id;?>,'<?php echo $info->vehicle_no;?>',
              <?php echo $info->one_way_charge;?>,<?php echo $info->two_way_charge;?>,<?php echo $info->paid_status;?>,<?php echo $info->passing_status;?>,
                          '<?php echo $regtype;?>');" value="Charge" class="btn btn-success right_menu-button-small common-btn-pass"/>
          </td>-->
          <td><span class="common-btn-pass"><?php if($info->paid_status==1){echo "Yes";}else{echo "No";}?></span></td>

          <td style="text-align:center;">
            <?php if($info->paid_status==1){?>
              <a href="<?php echo base_url('tolloperator/changeStatus?tcid='.$tcid.'&uid='.$uid.'&vid='.$vid.'&psts='.$psts.'&paid='.$paid.'&email='.$email.'&mb='.$mb.'&toll='.$toll.'&bmt='.$bmt.'&tot='.$tot.'&tcname='.$tcname.'&vno='.$vno);?>" class="btn btn-success common-btn-pass"><?php echo "PASS";?></a>
                  <?php }else{?>
            <button type="button" class="btn btn-success common-btn-pass" disabled>PASS</button>
                <?php }?>
          
          </td>
        </tr>
          <?php $j++;}}else{
            echo "<tr><td colspan='7'>No registered Vehicles Found</td></tr>";
            }?>
        
        
        
        
      </tbody>
    </table> 
    
              </div>
         </div>  
<script type="text/javascript">
    function getCharge(email,tcid,uid,typeid,makeid,modelid,vid,vno,amt1,amt2,paidsts,passsts,deviceid){
        //alert(amt);
        $.ajax({
url: "<?php echo base_url('tolloperator/getChargeStatus');?>",
type: 'POST', 
dataType: 'html', 
data: "email="+email+"&tcid="+tcid+"&uid="+uid+"&typeid="+typeid+"&makeid="+makeid+"&modelid="+modelid+"&vid="+vid+"&vno="+vno+"&amt1="+amt1+"&amt2="+amt2+"&paidsts="+paidsts+"&passsts="+passsts+"&deviceid="+deviceid, 
success: function(msg)
 { 
    // alert(msg);
  d = $.parseJSON(msg);	
				if(d.ans=='success') {
                        $('#chargests').html(d.res).fadeIn().delay(3000).fadeOut();
                        // window.location.href="<?php echo base_url('tolloperator/dialyoperations');?>";
                                }else if(d.ans=='failure') {
                    $('#chargestserror').html(d.res).fadeIn().delay(30000).fadeOut();  
                    // window.location.href="<?php echo base_url('tolloperator/dialyoperations');?>";
                                }
 //alert(html);    
 } //whatever you want to do with your return data. 
 });
    }
$("#vnum").keyup(function(){     
        var keyword=$("#vnum").val();
       ///  alert(keyword);
 $.ajax({
url: "<?php echo base_url('tolloperator/getVehiclesData');?>",
type: 'POST', 
dataType: 'html', 
data: "keyword="+keyword, 
success: function(result)
 { 
     $('#ajaxsus').html(result);
 //alert(html);    
 } //whatever you want to do with your return data. 
 });       
}); 
$("#mvnum").keyup(function(){     
        var keyword=$("#mvnum").val();
       ///  alert(keyword);
 $.ajax({
url: "<?php echo base_url('tolloperator/getMobileVehiclesData');?>",
type: 'POST', 
dataType: 'html', 
data: "keyword="+keyword, 
success: function(result)
 { 
     $('#majaxsus').html(result);
 //alert(html);    
 } //whatever you want to do with your return data. 
 });       
}); 

</script>
