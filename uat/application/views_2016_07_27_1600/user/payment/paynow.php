<html>
<head>
<title> Book My Toll</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
body{
	width:100% !important;
	}
</style>
<body> 
<center>
 <iframe src="<?php echo $production_url?>" id="paymentFrame" height="450" frameborder="0" ></iframe>

<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
         window.addEventListener('message', function(e) {
           $("#paymentFrame").css("height",e.data['newHeight']+'px');    
       }, false);
      
    });
</script>
</center>
</body>
</html>
