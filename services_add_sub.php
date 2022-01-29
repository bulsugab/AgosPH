<?php
require("config.php");
include("auth.php");

if (isset($_REQUEST['eventTitle'], $_REQUEST['subEventLoc'], $_REQUEST['subEventCap'], $_REQUEST['subEventPart'], $_REQUEST['subEventStart'], $_REQUEST['subEventEnd'],  $_REQUEST['subEventCoor'], $_REQUEST['subEventCoorNum'], $_REQUEST['mainEventName'])){

    $sub_name = stripslashes($_REQUEST['eventTitle']);
    $sub_name = mysqli_real_escape_string($db,$sub_name);

    $main_name = stripslashes($_REQUEST['mainEventName']);
    $main_name = mysqli_real_escape_string($db,$main_name);

    $event_name = $main_name." - ".$sub_name;

    $event_cate = "Sub-Event";

    $event_loc = stripslashes($_REQUEST['subEventLoc']);
    $event_loc = mysqli_real_escape_string($db,$event_loc);

    $event_caps = stripslashes($_REQUEST['subEventCap']);
    $event_caps = mysqli_real_escape_string($db,$event_caps);

    $event_part = stripslashes($_REQUEST['subEventPart']);
    $event_part = mysqli_real_escape_string($db,$event_part); //none pa

    $event_start = stripslashes($_REQUEST['subEventStart']);
    $event_start = mysqli_real_escape_string($db,$event_start);

    $event_end = stripslashes($_REQUEST['subEventEnd']);
    $event_end = mysqli_real_escape_string($db,$event_end);

    $coor_name = stripslashes($_REQUEST['subEventCoor']);
    $coor_name = mysqli_real_escape_string($db,$coor_name);
    
    $coor_num = stripslashes($_REQUEST['subEventCoorNum']);
    $coor_num = mysqli_real_escape_string($db,$coor_num);



    $query = "INSERT INTO services (servName, servCate, servPlace, servParticipant, servCapacity, servStart, servEnd, coorName, coorNum, createdBy)  VALUES ('$event_name', '$event_cate', '$event_loc', '$event_part', '$event_caps', '$event_start', '$event_end','$coor_name', '$coor_num', '".$_SESSION['username']."')";
        $result = mysqli_query($db,$query);
        if($result){

        $addEvent = "".$_SESSION['username']." created sub-event for ".$event_name;
        $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Event', '".$addEvent."', '".$_SESSION['username']."')";
        $updateHistoExe = mysqli_query($db, $updateHisto);


          header("Location: services.php");
        }
        else { 
          echo '<script>
            alert("Failed to add event!"); 
            window.location.replace("services.php"); </script>';
        }
      }
else {
    echo '<script>
        alert("Incomplete information!"); 
        window.location.replace("services.php"); </script>';
}
?>