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

if (isset($_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['mname'], $_REQUEST['gender'], $_REQUEST['birthday'], $_REQUEST['guardian'], $_REQUEST['mobile1'], $_REQUEST['mobile2'], $_REQUEST['status'], $_REQUEST['address'])){

    $fname = stripslashes($_REQUEST['fname']);
    $fname = mysqli_real_escape_string($db,$fname);

    $lname = stripslashes($_REQUEST['lname']);
    $lname = mysqli_real_escape_string($db,$lname);

    $mname = stripslashes($_REQUEST['mname']);
    $mname = mysqli_real_escape_string($db,$mname);

    $gender = stripslashes($_REQUEST['gender']);
    $gender = mysqli_real_escape_string($db,$gender);
    
    $birthday = stripslashes($_REQUEST['birthday']);
    $birthday = mysqli_real_escape_string($db,$birthday);

    $guardian = stripslashes($_REQUEST['guardian']);
    $guardian = mysqli_real_escape_string($db,$guardian);

    $mobile1 = stripslashes($_REQUEST['mobile1']);
    $mobile1 = mysqli_real_escape_string($db,$mobile1);

    $mobile2 = stripslashes($_REQUEST['mobile2']);
    $mobile2 = mysqli_real_escape_string($db,$mobile2);

    $disability = stripslashes($_REQUEST['disability']);
    $disability = mysqli_real_escape_string($db,$disability);

    $status = stripslashes($_REQUEST['status']);
    $status = mysqli_real_escape_string($db,$status);

    $address = stripslashes($_REQUEST['address']);
    $address = mysqli_real_escape_string($db,$address);

    if (!isset($_REQUEST['mother'], $_REQUEST['father'], $_REQUEST['motherOccupation'], $_REQUEST['fatherOccupation'])){
        $mother = "N/A";
        $father = "N/A";
        $motherOccupation = "N/A";
        $fatherOccupation = "N/A";

    } else {
        $mother = stripslashes($_REQUEST['mother']);
        $mother = mysqli_real_escape_string($db,$mother);

        $father = stripslashes($_REQUEST['father']);
        $father = mysqli_real_escape_string($db,$father);

        $motherOccupation = stripslashes($_REQUEST['motherOccupation']);
        $motherOccupation = mysqli_real_escape_string($db,$motherOccupation);

        $fatherOccupation = stripslashes($_REQUEST['fatherOccupation']);
        $fatherOccupation = mysqli_real_escape_string($db,$fatherOccupation);
    }


    //edit start
    $today = intval(date("Y-m-d"));
    $bday = intval($birthday);
    $checkAge = $today - $bday;
if (($checkAge > '59') || ($checkAge > '0' && $checkAge < '7') || ($checkAge < '1')){
    //edit end
    $query = "INSERT INTO residents (fname, mname, lname, bdate, gender, guardian, address, status, contactNum, contactNum2, mother, father, moccupation, foccupation, disability, created_by) VALUES ('$fname', '$mname', '$lname', '$birthday', '$gender', '$guardian', '$address', '$status', '$mobile1', '$mobile2', '$mother', '$father', '$motherOccupation', '$fatherOccupation', '$disability', '".$_SESSION['username']."')";
        $result = mysqli_query($db,$query) or die(mysqli_error($db));
        if($result){
        $query = "UPDATE residents SET age = TIMESTAMPDIFF(year, bdate, createdAt) WHERE age = ''";
        $result = mysqli_query($db,$query);
        

        $addResident = "".$_SESSION['username']." created the record of ".$fname." ".$mname." ".$lname.".";
        $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Record', '".$addResident."', '".$_SESSION['username']."')";
        $updateHistoExe = mysqli_query($db, $updateHisto);


        $message = "Hi! This is your confirmation SMS that you have a record on Barangay Tampok Health Care System.";

        $results = itexmo($mobile1, $message,"ST-GABZA946272_A56HS", "r3{5q9kim}");
                if ($results == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }   else if ($results == 0){
                    header("Location: residents.php"); 
                }

                else if ($results == 4) {
                    echo "<script>alert('All free SMS trials are used! Cannot send confirmation SMS.');</script>"; 
                    header("Location: residents.php"); 
                }

                else{ 
                    //echo "Error Num ". $results . " was encountered!";
                     echo "<script>alert('Error Num ". $results . " was encountered! Process completed but cannot send the SMS at the moment.');</script>";
                    header("Location: residents.php");
                }

        //sms end
      }//if added sql
    else { 
        echo '<script>alert("Failed to register resident!"); 
    window.location("residents.php"); </script>';  
    }
 }//if qualify
 else { 
    echo '<script>
    alert("Please register Seniors, Children or Infants only!"); 
    window.location("residents.php"); </script>';
}
}//iseet
else {
    echo '<script> alert("Data incomplete!"); 
    window.location("residents.php"); </script>'; 
}

?>