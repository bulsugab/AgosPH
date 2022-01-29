<?php
require("config.php");
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

if (isset($_REQUEST['addId'], $_REQUEST['eventId'], $_REQUEST['eventName'], $_REQUEST['addAge'], $_REQUEST['addName'], $_REQUEST['addGuardian'], $_REQUEST['addNum'], $_REQUEST['eventAddress'])){
    //$addId = $_REQUEST['addId'];
    $addId = stripslashes($_REQUEST['addId']);
    $addId = mysqli_real_escape_string($db,$addId);
    //$eventId =$_REQUEST['eventId'];
    $eventId = stripslashes($_REQUEST['eventId']);
    $eventId = mysqli_real_escape_string($db,$eventId);

    $eventName = stripslashes($_REQUEST['eventName']);
    $eventName = mysqli_real_escape_string($db,$eventName);

    $addAge = stripslashes($_REQUEST['addAge']);
    $addAge = mysqli_real_escape_string($db,$addAge);

    $addName = stripslashes($_REQUEST['addName']);
    $addName = mysqli_real_escape_string($db,$addName);

    $addGuardian = stripslashes($_REQUEST['addGuardian']);
    $addGuardian = mysqli_real_escape_string($db,$addGuardian);

    $addNum = stripslashes($_REQUEST['addNum']);
    $addNum = mysqli_real_escape_string($db,$addNum);

    $eventAddress = stripslashes($_REQUEST['eventAddress']);
    $eventAddress = mysqli_real_escape_string($db,$eventAddress);

    $query = "INSERT INTO eventparticipants (eventId, addId, eventName, eventAddress, addName, addAge, addGuardian, addNum, addBy)  VALUES ('$eventId', '$addId', '$eventName', '$eventAddress','$addName', '$addAge', '$addGuardian', '$addNum', '".$_SESSION['username']."')";
        $result = mysqli_query($db,$query);
        if($result){

        $addParticipant = "".$_SESSION['username']." registered ".$addName." to participate to ".$eventName;
        $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Event', '".$addParticipant."', '".$_SESSION['username']."')";
        $updateHistoExe = mysqli_query($db, $updateHisto);

        $message = "Hi, ".$addName."! You are registered as one of the participants of ".$eventName.".";

        $results = itexmo("0".$addNum."", $message, "ST-GABZA946272_A56HS", "r3{5q9kim}");
                if ($results == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }   else if ($results == 0){
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }

                else if ($results == 4) {
                    echo "<script>alert('All free SMS trials are used! Cannot send confirmation SMS but process completed!');</script>"; 
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }
                else { 
                    echo "<script>alert('Error Num ". $results . " was encountered! Process completed but cannot send the SMS at the moment.');</script>";
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }

        //sms end

         
        }//if
        else { 
          echo 'alert("Mali nanaman")';
        }//else

}//isset if
else {
    echo "alert('Isset!')";
}//else isset 
?>