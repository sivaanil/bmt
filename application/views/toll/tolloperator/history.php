
              <div class="col-md-9 right_menu">
            <?php if(isset($datewise)){

             //  echo "<pre>"; print_r($datewise);exit;
               $first=$datewise->first;
               $second=$datewise->second;
                //}?>
              <div class="row">
              
              <div class="col-md-12 col-sm-12 new-row">
              Select the period of report to be generated
              </div>
              </div>
              <div class="row">
              <div class="col-md-12 col-sm-12 new-row">
              Consolldated Report for <?php echo $first->date;?>
              </div>
              </div>
                   <div class="row">
                   <div class="col-md-12 col-sm-12">
                    <div class="col-md-4 col-sm-4"><label class="new-label">TCN No : </label><span class="new-span"> <?php echo $first->tc_id;?></span> </div>
                    <div class="col-md-4 col-sm-4"><label class="new-label">Toll Location : </label><span class="new-span"> <?php echo $first->tc_location;?></span> </div>
                    <div class="col-md-4 col-sm-4"><label class="new-label">Toll Ope ID : </label><span class="new-span"> <?php echo $first->name;?></span> </div>
                    </div>
                   </div>
                   
                   <div class="row">
                   <div class="col-md-12 col-sm-12">
                    
                    <div class="col-md-4 col-sm-4"><label class="new-label">Toll Name : </label><span class="new-span"> <?php echo $first->tc_name;?></span> </div>
                    <div class="col-md-4 col-sm-4"><label class="new-label">Date : </label><span class="new-span"> <?php echo $first->date;?></span> </div>
                    </div>
                   </div>
                   <br>


                   <div class="row">
                   <div class="col-md-12 col-sm-12">
                   <table class="table" style="width:90%; margin:0 auto; border: 1px #DDD solid;">
      <thead>
        <tr>
          <th>Vehicle Type</th>
          <th>Vehicle Make</th>
          <th>Registration Type </th>
          <th>Amount Collected(RS.)</th>
        </tr>
      </thead>
<!--      <tbody>
      <?php 
      // echo "<pre>"; print_r($second);exit;
      $i=0;
 foreach($second as $each){
          ?>
        <tr>
          <td scope="row"><?php echo $each->type_name;?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>        
        </tr>
<?php 
$innersecond=$each->$i;
 $cnt=count($innersecond);
//echo "<pre>";print_r($each);

?>
        <tr>
          <td scope="row"></td>
          <td><?php echo $innersecond->make_name;?></td>
          <?php $j=0;foreach($each as $ea){
            // echo "<pre>";print_r($ea); 
              ?>
           <tr>
          <td>&nbsp;</td>
          <td><?php $a=0;$b=1;echo @$ea->make_name;?></td>
          <?php  //$cnt=count($ea);
         // foreach($ea as $e){?>
          <td><?php echo  @$ea->$a->reg_type;?></td>
          <td><?php echo  @$ea->$a->total;?></td>  
          <?php //}?>
          </tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <?php  //$cnt=count($ea);
         // foreach($ea as $e){?>
          <td><?php echo  @$ea->$b->reg_type;?></td>
          <td><?php echo  @$ea->$b->total;?></td>  
          <?php //}?>
          </tr>
          <?php $j++;}?>
           <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
          <td scope="row"></td>
          <td></td>
          <td>NBIV</td>
          <td>10500</td>
        </tr>

        
        <?php $i;} ?>
       <tr>
          <td scope="row"></td>
          <td></td>
          <td></td>
          <td>RS. <?php //echo //$sum;?></td>
        </tr>

        <?php //}else{?>
          <tr>
          <td colspan="4"> There is No Tranactions For selected Date</td>
          
        </tr>
         <?php //}?>
        
        
        
      </tbody>-->
      <tbody>
      <?php 
      // echo "<pre>"; print_r($datewise);exit;
      $types=$second->types;
      $cnt=count($types);
      $sum = 0;
if($cnt>0){
      for($i=0;$i<$cnt;$i++){
          ?>
        <tr>
          <td scope="row"><?php echo $types[$i]->type_name;?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <?php 
          $makeslist=$second->$i;
$makes=$makeslist->makes;
 $cnt1=count($makes);

//echo "<pre>";print_r($makes);
for($j=0;$j<$cnt1;$j++){
    $all=$makeslist->$j->amounts;
   // echo $allcnt=count($all);
 $aa=$makeslist->$j->amounts[0];
//$bb=$makeslist->$j->amounts[1];
          ?>
          <tr>
          <td>&nbsp;</td>
          <td><?php echo $makes[$j]->make_name;?></td>
          <td><?php if(@$all[0]->reg_type==0)echo "NBIV";else echo "BIV";?></td>
          <td><?php echo @$all[0]->total;?></td>
          </tr>
          <?php if(@$all[1]){ ?>
          <tr>
          <td>&nbsp;</td>
          <td><?php //echo $makes[$j]->make_name;?></td>
          <td><?php if(@$all[1]->reg_type==0)echo "NBIV";else echo "BIV";?></td>
          <td><?php echo @$all[1]->total;?></td>
          </tr>
          <?php } ?>
          <?php }?>
          
        </tr>
 
<!--        <tr>
          <td scope="row"></td>
          <td>Mahindra & Mahindra</td>
          <td>BIV</td>
          <td>10500</td>
        </tr>
        <tr>
          <td scope="row"></td>
          <td></td>
          <td>NBIV</td>
          <td>10500</td>
        </tr>-->

        
        <?php } ?>
       <tr>
          <td scope="row"></td>
          <td></td>
          <td></td>
          <td>RS. <?php echo $second->totalamt;?></td>
        </tr>

        <?php }else{?>
          <tr>
          <td colspan="4"> There is No Tranactions For selected Date</td>
          
        </tr>
         <?php }?>
        
        
        
      </tbody>
    </table>
    </div>
    </div>
    <?php }else{?>
    <div class="row">
              
              <div class="col-md-12 col-sm-12 new-row">
              Select the period of report to be generated
              </div>
              </div>
              <div class="row">
              <div class="col-md-12 col-sm-12 new-row">
              Consolldated Report for Date or Consolldated Report for Period
              </div>
              </div>
    <?php }?>
              </div>