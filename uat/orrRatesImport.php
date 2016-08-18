<?php

$con = mysqli_connect("localhost","root","bHvhTb@1b6","uat_bmtdb");
//$con = mysqli_connect("localhost","root","bHvhTb@1b6","bmtdb");
//$con = mysqli_connect("localhost", "root", "ray123", "uat_bmtdb");

$output = $con->query("truncate outerringroad_charge");

if (($handle = fopen('ORR_Rates.csv', 'r')) !== FALSE) {
    // necessary if a large csv file
    set_time_limit(0);

    $row = 0;
    $col_count = 0;
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        // number of fields in the csv
        $col_count = count($data);

        // get the values from the csv
//                $csv[$row]['col1'] = $data[0];
//                $csv[$row]['col2'] = $data[1];
        $csv[$row] = $data;

        // inc the row
        $row++;
    }
    fclose($handle);
}

//echo $col_count . "<pre>";print_r($csv);echo "</pre>"; //exit;
$sql = "SELECT * FROM vehicle_type";
$vehicle_types = array();
if ($result = mysqli_query($con, $sql)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $vehicle_types[trim($row['type_name'])] = $row['type_id'];
    }
    // Free result set
    mysqli_free_result($result);
}

//echo "<pre>";print_r($vehicle_types);echo "</pre>";//exit;

$sql = "SELECT * FROM orr_toll_center";
$orr_toll_centers = array();
if ($result = mysqli_query($con, $sql)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $orr_toll_centers[trim($row['interchange_name'])] = $row['interchange_number'];
    }
    // Free result set
    mysqli_free_result($result);
}

//echo "<pre>";print_r($orr_toll_centers);echo "</pre>";//exit;

$sql = '';
$headerArr = $csv[0];
unset($csv[0]);
foreach ($headerArr as $key => $value) {
    if($key == 0)
        continue;
    foreach ($csv as $key1 => $value1) {
        if($key1 == 0)
            continue;
        foreach ($value1 as $key2 => $value2) {
            if($key2 == 0)
                continue;
//            echo $value1[0];
            $explodeArr =  explode('/',$value1[0]);
//            echo "<pre>";print_r($explodeArr);echo "</pre>";exit;
            $sql .= "INSERT INTO outerringroad_charge (from_tc_id, to_tc_id, type_of_vehicle_id,charge,city_id)
                        VALUES ('".$orr_toll_centers[trim(reset($explodeArr))]."','".$orr_toll_centers[trim(end($explodeArr))]."','".$vehicle_types[trim($value)]."','".$value2."',1);";
        }
    }
}

//echo $sql;exit;
mysqli_multi_query($con,$sql);

echo "DONE";
unset($con);