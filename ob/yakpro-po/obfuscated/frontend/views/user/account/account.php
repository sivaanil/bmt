<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto rO2oE; Upd1I: echo kSfh8("\141\143\x63\157\x75\156\x74\57\x70\x61\x79\155\x65\x6e\164"); goto DUvDa; yeoz8: goto En634; goto e0bZ1; h4FSu: ?>
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
           <?php  goto ae27J; z2103: echo KsFh8("\x61\x63\143\157\x75\156\164\x2f\147\x65\164\167\141\171\x74\x79\160\145\163"); goto SQFBZ; JCw26: ?>
           <div class="form-group">
           There is no Toll Centers.
           </div>
           <?php  goto yeoz8; zkRgU: foreach ($rS9y7 as $kcrwq) { goto s02Kr; KLSaQ: ?>
</option>
             <?php  goto WHBu6; WHBu6: nWdNP: goto AYHnE; DCdFU: echo $kcrwq->Nb6y_; goto KLSaQ; czUIQ: echo $kcrwq->q9pm2; goto y5AX4; s02Kr: ?>
             <option value="<?php  goto czUIQ; y5AX4: ?>
"><?php  goto DCdFU; AYHnE: } goto a3ZHA; DUvDa: ?>
" id="tollform" enctype="multipart/form-data">          
            <?php  goto VI0h6; J4_A3: echo KsfH8("\141\x63\143\x6f\x75\156\x74\x2f\147\x65\x74\x4c\141\156\x65"); goto JpQuf; OXUsI: ?>
        <form name="tollform" class="form-horizontal" style="width:80%; margin:0 auto;" method="post" action="<?php  goto Upd1I; e0bZ1: SYQZU: goto DKCDy; rO2oE: ?>
<div class="container-fluid inner-page-body">
  <div class="row">             
    <div class="col-md-9 right_menu">

        <div id="mydiv"></div>
        <?php  goto OXUsI; led1k: ?>
  
            
           
           
            </form>
       
 <script type="text/javascript">
     function getWayTypes(tcid){
      //alert(tcid);
      $.ajax({
          "url"  : "<?php  goto z2103; DKCDy: ?>
 
       <div class="form-group">
       <label for="inputPassword3" class="col-sm-3 control-label">Toll Center</label>
          <div class="col-sm-3">
         <select id="tc_id" name="tc_id" onchange="getWayTypes(this.value);">
             <option value="">Select Toll</option>
             <?php  goto zkRgU; ae27J: En634: goto led1k; a3ZHA: QVtme: goto h4FSu; VI0h6: if (isset($rS9y7)) { goto SYQZU; } goto JCw26; SQFBZ: ?>
",
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
////          "url"  : "<?php  goto J4_A3; JpQuf: ?>
",
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
