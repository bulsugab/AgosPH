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

    $query = "SELECT * FROM items WHERE itemId='$hidden'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    if($row['itemName'] == $initial){
        $update = "UPDATE items SET itemName='$toEdit', updatedBy='$updatedBy' WHERE itemId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    } 
    }//inside if
    else if($row['itemGen'] == $initial){
        $update = "UPDATE items SET itemGen='$toEdit', updatedBy='$updatedBy' WHERE itemId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//2nd
    else if($row['itemExp'] == $initial){
        $update = "UPDATE items SET itemExp='$toEdit', updatedBy='$updatedBy' WHERE itemId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//3rd
    else if($row['itemFor'] == $initial){
        $update = "UPDATE items SET itemFor='$toEdit', updatedBy='$updatedBy' WHERE itemId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        
        }
    }//4th

    else if($row['itemNo'] == $initial){
        $update = "UPDATE items SET itemNo='$toEdit', updatedBy='$updatedBy' WHERE itemId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
            //header("Location: residents.php"); 
        } 
    }//5th
    else if($row['itemUnit'] == $initial){
        $update = "UPDATE items SET itemUnit='$toEdit', updatedBy='$updatedBy' WHERE itemId='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
            //header("Location: residents.php"); 
        } 
    }//th
    else { 
        echo 'Failed to update record. Try again.';
        // echo $hidden."<br>";
        // echo $toEdit."<br>";
        // echo $initial."<br>";
    }



    $updateOther = "SELECT * FROM items WHERE itemId='$hidden'";
    $updatedOther = mysqli_query($db,$updateOther) or die(mysqli_error($db));
    $updateBy = $_SESSION['username'];
    while($rowUpdate = mysqli_fetch_array($updatedOther)){

        $updatedName = $rowUpdate['itemName'];
        $updatedExp = $rowUpdate['itemExp'];
        $updatedQty = $rowUpdate['itemQty'];
        
        $updateDbPart = mysqli_query ($db,"UPDATE prescriptions SET presMed='$updatedName', presExp='$updatedExp' WHERE presMedId='$hidden'") or die(mysqli_error($db));
    }

// $updatedEvent = "Updated the information of ".$updatedName."";
// $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$updatedEvent."', '".$_SESSION['username']."')";
// $updateHistoExe = mysqli_query($db, $updateHisto);

    $updatedEvent = "Updated the information of ".$updatedName."";
    $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Inventory', '".$updatedEvent."', '".$_SESSION['username']."')";
    $updateHistoExe = mysqli_query($db, $updateHisto);
header("location: inventory_edit.php?itemId=".$hidden."");
}//main if

else {
    echo $_POST['hidden'];
    echo $_POST['toEdit'];
}//main else
?>