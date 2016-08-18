<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
@font-face {
    font-family: Verdana;
    src:url(fonts/verdana.woff);
	src:url(fonts/verdana.ttf);
}

</style>
<?php //echo print_r($data);exit;?>
<body>
<table width="630" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:10px; font-family:Verdana; text-align:justify; border-radius: 5px; border:1px solid rgb(184, 178, 178);">
  
  <tr>
    <td height="88" colspan="2"><img src="<?php echo base_url('assets/img/')?>/logo.png" width="100" /></td>
  </tr>
  
  <tr>
  <td width="174" height="38" colspan="2" style="font-size: 18px;border-bottom: 1px #E4E4E4 solid;"><?php echo $name; ?> Your Password Is :</td>
    
  </tr>
  
   
  <tr>
  <td width="174" height="38" style="font-size: 11px;border-bottom: 1px #E4E4E4 solid; color:#4f4f4f;"><br>Password: <?php echo $password; ?><br><br></td>
    <td width="454" style="font-size: 11px; text-align:right; border-bottom: 1px #E4E4E4 solid; color: #4f4f4f;"></td>
  </tr>
  

  
  </tr>
  
  
 
</table>

</body>
</html>
