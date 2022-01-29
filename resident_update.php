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

if (isset($_POST['hidden'], $_POST['toEdit'], $_POST['initial'])) {
    $hidden = stripslashes($_POST['hidden']);
    $hidden = mysqli_real_escape_string($db,$hidden);

    $toEdit = stripslashes($_POST['toEdit']);
    $toEdit = mysqli_real_escape_string($db,$toEdit);

    $initial = stripslashes($_POST['initial']);
    $initial = mysqli_real_escape_string($db,$initial);

    $updatedBy = $_SESSION['username'];

    $query = "SELECT * FROM residents WHERE idRecord='$hidden'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    if($row['fname'] == $initial){
        $update = "UPDATE residents SET fname='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    } 
    }//inside if
    else if($row['mname'] == $initial){
        $update = "UPDATE residents SET mname='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//2nd
    else if($row['lname'] == $initial){
        $update = "UPDATE residents SET lname='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//3rd
    else if($row['bdate'] == $initial){
        $update = "UPDATE residents SET bdate='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
            $updateAge = "UPDATE residents SET age = TIMESTAMPDIFF(year, bdate, CURRENT_TIMESTAMP) WHERE idRecord='$hidden'";
            $updatedAge = mysqli_query($db,$updateAge);
                if ($updatedAge){
                    //header("Location: residents.php"); 
                } }
    }//4th

    else if($row['gender'] == $initial){
        $update = "UPDATE residents SET gender='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
            //header("Location: residents.php"); 
        } 
    }//5th
    else if($row['address'] == $initial){
        $update = "UPDATE residents SET address='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        
        //header("Location: residents.php"); 
    }  
    }//6th
    else if($row['contactNum'] == $initial){
        $update = "UPDATE residents SET contactNum='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        //header("Location: residents.php"); 
    }  
    }//7th
    else if($row['contactNum2'] == $initial){
        $update = "UPDATE residents SET contactNum2='$toEdit', updatedBy='$updatedBy' WHERE idRecord='$hidden'";
        $updated = mysqli_query($db,$update);
        if ($updated){
        
        //header("Location: residents.php"); 
    }  
    }//8th
    else { 
          echo 'Failed to update record. Try again.';
        }



    $updateOther = "SELECT * FROM residents WHERE idRecord='$hidden'";
    $updatedOther = mysqli_query($db,$updateOther) or die(mysqli_error($db));
    while($rowUpdate = mysqli_fetch_array($updatedOther)){

        $updatedName = $rowUpdate['fname']." ".$rowUpdate['mname']." ".$rowUpdate['lname'];
        $updatedAge = $rowUpdate['age'];
        $updatedGuardian = $rowUpdate['guardian'];
        $updatedNum = $rowUpdate['contactNum'];

        if ($updatedAge > '60'){
            $updatedType = 'Seniors';
        }
        else if (($updatedAge > '0') && ($updatedAge < '7')){
            $updatedType = 'Children';
        }

        else {
            $updatedType = 'Infants';
        }

        $updateDbPart = mysqli_query ($db,"UPDATE eventparticipants SET addName='$updatedName', addAge='$updatedAge', addGuardian='$updatedGuardian', addNum='$updatedNum' WHERE addId='$hidden'") or die(mysqli_error($db));
        $updateDbPres = mysqli_query ($db,"UPDATE prescriptions SET presName='$updatedName', presAge='$updatedAge', presGuardian='$updatedGuardian', presNum='$updatedNum', presType='$updatedType' WHERE presNameId='$hidden'") or die(mysqli_error($db));

        //sms start

        $message = "Your record in HCMS has been updated!";

        $results = itexmo("0".$updatedNum, $message,"ST-GABZA946272_A56HS", "r3{5q9kim}");
                if ($results == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }   else if ($results == 0){
        // $updatedResident = "Updated the record of: ";
        // $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$updatedResident."".$updatedName."', '".$_SESSION['username']."')";
        // $updateHistoExe = mysqli_query($db, $updateHisto);

        $updatedResident = "".$_SESSION['username']." updated the record of ".$updatedName;
        $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Record', '".$updatedResident."', '".$_SESSION['username']."')";
        $updateHistoExe = mysqli_query($db, $updateHisto);

                    header("Location: residents.php"); 
                }
                else if ($results == 4){
        // $updatedResident = "Updated the record of: ";
        // $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$updatedResident."".$updatedName."', '".$_SESSION['username']."')";
        // $updateHistoExe = mysqli_query($db, $updateHisto);
                    echo "<script>alert('All free SMS trials are used! Cannot send confirmation SMS.');</script>";
                    header("Location: residents.php"); 

                }

                else {
        // $updatedResident = "Updated the record of: ";
        // $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$updatedResident."".$updatedName."', '".$_SESSION['username']."')";
        // $updateHistoExe = mysqli_query($db, $updateHisto); 
                    echo "<script>alert('Error Num ". $results . " was encountered! Process completed but cannot send the SMS at the moment.');</script>";
                     header("Location: residents.php"); 
                }

        //sms end

        //to edit
        //header("Location: residents.php");
        //to remove
    }


}//main if

else {
    echo $_POST['hidden'];
    echo $_POST['toEdit'];
}//main else
?>