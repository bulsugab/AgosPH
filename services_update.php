<?php
require('config.php');
include("auth.php");

if (isset($_POST['hidden'], $_POST['toEdit'], $_POST['initial'])) {
    $hidden = stripslashes($_POST['hidden']);
    $hidden = mysqli_real_escape_string($db,$hidden);

    $toEdit = stripslashes($_POST['toEdit']);
    $toEdit = mysqli_real_escape_string($db,$toEdit);

    $initial = stripslashes($_POST['initial']);
    $initial = mysqli_real_escape_string($db,$initial);

    $updatedBy = $_SESSION['username'];

    $query = "SELECT * FROM services WHERE servId='$hidden'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    if($row['servName'] == $initial){
        $update = "UPDATE services SET servName=UPPER('$toEdit'), updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    } 
    }//inside if
    else if($row['servDesc'] == $initial){
        $update = "UPDATE services SET servDesc='$toEdit', updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//2nd
    else if($row['servPlace'] == $initial){
        $update = "UPDATE services SET servPlace='$toEdit', updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//3rd
    else if($row['servDate'] == $initial){
        $update = "UPDATE services SET servDate='$toEdit', updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        
        }
    }//4th

    else if($row['servCapacity'] == $initial){
        $update = "UPDATE services SET servCapacity='$toEdit', updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
            //header("Location: residents.php"); 
        } 
    }//5th
    else if($row['coorName'] == $initial){
        $update = "UPDATE services SET coorName='$toEdit', updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        
        //header("Location: residents.php"); 
    }  
    }//6th
    else if($row['coorNum'] == $initial){
        $update = "UPDATE services SET coorNum='$toEdit', updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//7th
    
    else if($row['servCate'] == $initial){
        $update = "UPDATE services SET servCate='$toEdit', updatedBy='$updatedBy' WHERE servId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//8th
    else { 
        echo 'Failed to update record. Try again.';
        // echo $hidden."<br>";
        // echo $toEdit."<br>";
        // echo $initial."<br>";
    }



    $updateOther = "SELECT * FROM services WHERE servId='$hidden'";
    $updatedOther = mysqli_query($db,$updateOther) or die(mysqli_error($db));
    $updateBy = $_SESSION['username'];
    while($rowUpdate = mysqli_fetch_array($updatedOther)){

        $updatedName = $rowUpdate['servName'];
        
        $updateDbPart = mysqli_query ($db,"UPDATE eventparticipants SET eventName='$updatedName', updatedBy='$updatedBy' WHERE eventId='$hidden'") or die(mysqli_error($db));
    }

// $updatedEvent = "Updated the information of ".$updatedName."";
// $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$updatedEvent."', '".$_SESSION['username']."')";
// $updateHistoExe = mysqli_query($db, $updateHisto);

$updatedEvent = "".$_SESSION['username']." updated the details of ".$updatedName."";
$updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Event', '".$updatedEvent."', '".$_SESSION['username']."')";
$updateHistoExe = mysqli_query($db, $updateHisto);


header("location: services_edit.php?servId=".$hidden."");
}//main if

else {
    echo $_POST['hidden'];
    echo $_POST['toEdit'];
}//main else
?>