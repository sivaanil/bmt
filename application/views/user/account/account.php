<div class="container-fluid inner-page-body">
  <div class="row">             
    <div class="col-md-9 right_menu">

        <div id="mydiv"></div>
        <?php   //echo "<pre>"; print_r($tolls);  ?>
        <form name="tollform" class="form-horizontal" style="width:80%; margin:0 auto;" method="post" action="<?php echo base_url('account/payment');?>" id="tollform" enctype="multipart/form-data">          
            <?php 
        if(isset($tolls)){?> 
       <div class="form-group">
       <label for="inputPassword3" class="col-sm-3 control-label">Toll Center</label>
          <div class="col-sm-3">
         <select id="tc_id" name="tc_id" onchange="getWayTypes(this.value);">
             <option value="">Select Toll</option>
             <?php foreach($tolls as $each){?>
             <option value="<?php echo $each->tc_id?>"><?php echo $each->tc_name?></option>
             <?php }?>
             </select>
          </div>
        </div>

        <div class="form-group">
       <label for="inputPassword3" class="col-sm-3 control-label">Way Type</label>
          <div class="col-sm-3">
          <div id="ajaxdiv">
         <select id="way_type" name="way_type">
             <option value="">Select Way</option>
            
             </select>
             </div>
          </div>
        </div>

         <div class="form-group text-right">
             <div id="btnid">
            <button  style="margin-right: 3%; margin-left: 245px;float:left;" type="submit" class="btn save_changes common-btn-pass" name="submit">Submit</button>
            </div>
        </div>
           <?php }else{?>
           <div class="form-group">
           There is no Toll Centers.
           </div>
           <?php }?>  
            
           
           
            </form>
       
 <script type="text/javascript">
     function getWayTypes(tcid){
      //alert(tcid);
      $.ajax({
          "url"  : "<?php echo base_url('account/getwaytypes');?>",
          "type" : "POST",
          "data" : ({'tcid':tcid}),
          success:function(response){
           // alert(response);
            $('#ajaxdiv').html(response);
            // $("#pop_view").text("");
             //$("#pop_view").append(response);            
          }
        });
     }
     $( "#tollform" ).submit(function( event ) {
  //event.preventDefault();
         var tc_id=$('#tc_id').val();
         var way_type=$('#way_type').val();
         if(tc_id==''){
          alert('Select Your Tollcenter') ;  
          return false;
         }else
          if(way_type==''){
          alert('Select Your Way') ;  
          return false;
         }else{
         
         document.getElementById("tollform").submit();
         }
});

//     function getamt(){
//         var tc_id=$('#tc_id').val();
//         var way_type=$('#way_type').val();
//         if(tc_id==''){
//          alert('Select Your Tollcenter') ;  
//          return false;
//         }else
//          if(way_type==''){
//          alert('Select Your Way') ;  
//          return false;
//         }else{
//         
//         document.getElementById("tollform").submit();
////          $.ajax({
////          "url"  : "<?php echo base_url('account/getLane');?>",
////          "type" : "POST",
////          "data" : ({'tc_id':tc_id,'way_type':way_type}),
////          success:function(response){
////           // alert(response);
////             $("#mydiv").html(response);
////             //$("#pop_view").append(response);            
////          }
////        });
//         }
//     }
     </script>
     

    </div>
      <br>
  </div>


</div>

