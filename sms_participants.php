<?php
require('config.php');
include("auth.php");

function itexmo($number,$message,$apicode,$passwd){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    $param = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($itexmo),
      ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}

if (isset($_REQUEST['message'], $_REQUEST['servId'])){
    $message = $_REQUEST['message'];
    $id = $_REQUEST['servId'];
    
    $servQuery = mysqli_query($db, "SELECT * FROM eventparticipants WHERE eventId='$id'") or die(mysqli_error($db));
    do {
    //to edit
    //echo "<script>alert('SMS disabled!');</script>"; 
    //to remove
    
    $num = $parts['addNum'];
    $eventName = $parts['eventName'];
    $result = itexmo("0".$num."", $message,"ST-GABZA946272_A56HS", "r3{5q9kim}");
    if ($result == ""){
    echo "iTexMo: No response from server!!!
    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
    Please CONTACT US for help. ";  
    }else if ($result == 0){
    }
    else if ($results == 4) {
    echo "<script>alert('All free SMS trials are used!');</script>"; 
    }
    else { 
    echo "<script>alert('Error Num ". $results . " was encountered! Cannot send the SMS at the moment.');</script>";
    
    }
}//do while 
while ($parts = mysqli_fetch_array($servQuery));

    // $smsParticipant = $_SESSION['username']." sent SMS to ".$eventName." participants";
    // $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$smsParticipant."', '".$_SESSION['username']."')";
    // $updateHistoExe = mysqli_query($db, $updateHisto) or die(mysqli_error($db));

$smsParticipant = $_SESSION['username']." sent SMS to ".$eventName." participants";
$updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Event', '".$smsParticipant."', '".$_SESSION['username']."')";
$updateHistoExe = mysqli_query($db, $updateHisto);

    if ($updateHistoExe){
    header("Location: services.php"); }
}//isset
?>