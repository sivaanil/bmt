<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$con = mysqli_connect("localhost","root","bHvhTb@1b6","uat_bmtdb");
$con = mysqli_connect("localhost","root","bHvhTb@1b6","bmtdb");
$output = $con->query("DELETE FROM ringroad WHERE TIMEDIFF( now(), created_on) > '03:00:00' ");
echo date('Y-m-d H:i:s');
unset($con);
?>
