
<div class="container-fluid inner-page-body">
  <div class="row">             
    <div class="col-md-9 right_menu">
       
        <?php   //echo "<pre>"; print_r($production_url);  exit;?>
      <iframe src="<?php echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>

<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript">
    	$(document).ready(function(){
    		 window.addEventListener('message', function(e) {
		    	 $("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
		 	 }, false);
	 	 	
		});
</script>
  
    </div>
      <br>
  </div>
</div>
