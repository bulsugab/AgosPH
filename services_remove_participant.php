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

if (isset($_REQUEST['rowId'])){

    $rowId = stripslashes($_REQUEST['rowId']);
    $rowId = mysqli_real_escape_string($db,$rowId);

    $queryLists = "SELECT * FROM eventparticipants WHERE rowId=" .$rowId. "";
    $queryList = mysqli_query($db,$queryLists);
    if ($results = mysqli_fetch_array($queryList)){
      $name = $results['addName'];
      $event = $results['eventName'];
      $nums = $results['addNum'];
    }

    //$num = $nums;


    $query = "DELETE FROM eventparticipants WHERE rowId=" .$rowId. "";
        $result = mysqli_query($db,$query);
        if($result){

       $removeParticipant = "".$_SESSION['username']." removed ".$name." from ".$event;
        $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Event', '".$removeParticipant."', '".$_SESSION['username']."')";
        $updateHistoExe = mysqli_query($db, $updateHisto);

          //echo "<script>console.log('Record deleted from eventparticipants table')</script>"; //tracer only
         
        }//if
        else { 
          echo 'alert("Mali nanaman")';  //tracer only
          echo "ERROR: Could not able to execute $query. " . mysqli_error($db);
        }//else
        //to edit
        //header("Location: services.php");
        //to remove
         //sms start

        $message = "Hi, ".$name."! You have been removed to participate from ".$event.".";

        $resultss = itexmo("0".$nums."", $message, "ST-GABZA946272_A56HS", "r3{5q9kim}");
                if ($resultss == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }   else if ($resultss == 0){
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


}//isset if
else {
    echo "alert('Isset!')";  //tracer only
}//else isset 
?>