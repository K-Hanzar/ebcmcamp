<?php
putenv("TZ=Asia/Colombo");
date_default_timezone_set("Asia/Colombo");
session_start();

$postData = json_decode(file_get_contents('php://input'), true);

$camp_id = isset($postData['Camp_id']) ? $postData['Camp_id'] : "";
$msisdn = isset($postData['msisdn']) ? $postData['msisdn'] : "";
$trigger = isset($postData['Triggering_medium']) ? $postData['Triggering_medium'] : "";
$timestamp = date("Y-m-d H:i:s");

$logContent = json_encode($postData);

// Store each JSON content in log.txt line by line
$file = fopen("ebcmlog.txt", "a");
fwrite($file, $logContent . PHP_EOL);
fclose($file);

//$file = fopen("Knorrfinal_log.txt","a");
//fwrite($file,"-------Campaign ID :".$camp_id.",".$timestamp.",".$msisdn.",".$trigger .",".$logContent.PHP_EOL);
//fclose($file);

//$language = $postData['language'];     //use the parameter name configured
//$recipe = $postData['menu'];        //use the parameter name configured

// Your language specific logic goes here...

?>
