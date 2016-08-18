<?php
ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script
 
$name = "geofencecoordinates.csv";
header('Content-Description: File Transfer');
    header('Content-Type: application/csv');
    header("Content-Disposition: attachment; filename=geofencecoordinates.csv");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($name));
    ob_clean();
    flush();
    readfile($name); //showing the path to the server where the file is to be download
    exit;
