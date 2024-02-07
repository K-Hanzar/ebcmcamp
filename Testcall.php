<?php
putenv("TZ=Asia/Colombo");
//date_default_timezone_set("Asia/Colombo");

 session_start();


 $postData = json_decode(file_get_contents('php://input'),true);

 $camp_id = $postData['Camp_id'];
 $msisdn = $postData['msisdn'];
 $trigger = $postData['Triggering_medium'];
 //$language = $postData['language'];		//use the parameter name configured
 //$recipe = $postData['menu'];		//use the parameter name configured

$file = fopen("test.txt","a");
fwrite($file,"Selected language is $language".PHP_EOL);	//this will log to test.txt file that located in the directory where this ebcm.php lies.
fwrite($file,"Selected recipe is $recipe".PHP_EOL);
fclose($file);


  //$language = $_POST['language'];
  //$language = $language;
  //$menu = $_POST['menu'];
  //$menu = $recipe;

  //$mobil_number = implode("", $msisdn);
  //$mobil_number = $_POST['msisdn'];
  //echo $mobil_number = $msisdn;

  $msg_content = 'Dear customer please try again';
//$msisdn= "94777338025";
  $operator = substr($msisdn,0,4);

  if ($operator == "9471" or $operator == "9470")
{
    $msg_content = $operator." is Mobitel";
}

elseif ($operator == "9477" or $operator == "9476" or $operator == "9479" or $operator == "9479")
{
    echo "this is here";
    $msg_content = $operator." is dialog";
}

elseif ($operator == "9472")
{
    $msg_content = $operator." is etisalt";
}

elseif ($operator == "9478")
{
    $msg_content = $operator." is Hutch";
}

elseif ($operator == "9475")
{
    $msg_content = $operator." is Airtel";
}
else 
{
    $msg_content = "invalid operator";
}


  $msg_sent = strval($msg_content);



        $url        = 'https://digitalreachapi.dialog.lk/refresh_token.php';

        // DATA JASON ENCODED
        $data       = array("u_name" => "hanzar_01", "passwd" => "h@123123");
        $data_json  = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // DATA ARRAY
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);

        if ($response === false) {
        $response = curl_error($ch); }

        echo stripslashes($response);
        $arr = explode('"',trim($response));
        //$arr[3];

        $access_token = $arr[3];
        echo $access_value = 'Authorization:'.$access_token;
        curl_close($ch);
        echo $msisdn;



        //$mobil_number='94776740041';


    $url        = 'https://digitalreachapi.dialog.lk/camp_req.php';

    // DATA JASON ENCODED
    $data       = array(
        "msisdn" => "$mobil_number",
        "channel" => "162",
        "mt_port" => "ADA REACH",
        "s_time" => "2024-02-01 10:07:00",
        "e_time" => "2024-05-30 12:00:00",
        "msg" => "$msg_sent",
        "callback_url" => "https://digitalreachapi.dialog.lk/call_back.php"
        );
    $data_json  = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',$access_value));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // DATA ARRAY
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);

    if ($response === false)
        $response = curl_error($ch);
    stripslashes($response);

    $arr2 = explode('"',trim($response));
    $arr2[3];

    curl_close($ch);


  if($arr2[3] =='0'){
        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';

    }else {
        echo $arr2[3];
        echo '<script language="javascript">';
        echo 'alert("PLEASE TRY AGAIN !!")';
        echo '</script>';
    }
