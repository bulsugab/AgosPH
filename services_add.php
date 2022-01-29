<?php
require("config.php");
include("auth.php");

if (isset($_REQUEST['event_name'], $_REQUEST['event_cate'], $_REQUEST['event_loc'], $_REQUEST['event_caps'], $_REQUEST['event_part'], $_REQUEST['event_start'], $_REQUEST['event_end'],  $_REQUEST['coor_name'], $_REQUEST['coor_num'])){

    $event_name = stripslashes($_REQUEST['event_name']);
    $event_name = mysqli_real_escape_string($db,$event_name);

    $event_cate = stripslashes($_REQUEST['event_cate']);
    $event_cate = mysqli_real_escape_string($db,$event_cate);

    $event_loc = stripslashes($_REQUEST['event_loc']);
    $event_loc = mysqli_real_escape_string($db,$event_loc);

    $event_caps = stripslashes($_REQUEST['event_caps']);
    $event_caps = mysqli_real_escape_string($db,$event_caps);

    $event_part = stripslashes($_REQUEST['event_part']);
    $event_part = mysqli_real_escape_string($db,$event_part);

    $event_start = stripslashes($_REQUEST['event_start']);
    $event_start = mysqli_real_escape_string($db,$event_start);

    $event_start = stripslashes($_REQUEST['event_start']);
    $event_start = mysqli_real_escape_string($db,$event_start);

    $event_end = stripslashes($_REQUEST['event_end']);
    $event_end = mysqli_real_escape_string($db,$event_end);

    $coor_name = stripslashes($_REQUEST['coor_name']);
    $coor_name = mysqli_real_escape_string($db,$coor_name);
    
    $coor_num = stripslashes($_REQUEST['coor_num']);
    $coor_num = mysqli_real_escape_string($db,$coor_num);



    $query = "INSERT INTO services (servName, servCate, servPlace, servParticipant, servCapacity, servStart, servEnd, coorName, coorNum, createdBy)  VALUES ('$event_name', '$event_cate', '$event_loc', '$event_part', '$event_caps', '$event_start', '$event_end','$coor_name', '$coor_num', '".$_SESSION['username']."')";
        $result = mysqli_query($db,$query);
        if($result){

        $addEvent = "".$_SESSION['username']." created ".$event_name;
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