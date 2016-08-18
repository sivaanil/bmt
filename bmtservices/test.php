<?php
include_once 'class.push.php';
$push	= new pushmessage();

//$params	= array("pushtype"=>"android", $idphone=>"android_smart_phone_id_here", $mst=>"Hello, an android user");
$params	= array("pushtype"=>"ios", 'registration_id'=>"9ebc0a5dc03cad826f9b774f0a9167892f49894aff9af146ef3577c366b3e4e9", 'msg'=>"Hello, an android user");
$rtn = $push->sendMessage($params);
print_r($rtn);
