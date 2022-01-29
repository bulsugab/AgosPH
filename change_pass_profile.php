<?php
require('config.php');
include('auth.php');

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

if (isset($_REQUEST['oldpass'], $_REQUEST['newpass'], $_REQUEST['newpass2'])){
    $oldpass = $_REQUEST['oldpass'];
    $newpass = $_REQUEST['newpass'];
    $newpass2 = $_REQUEST['newpass2'];

    $oldpass = base64_encode($oldpass);
    $newpass = base64_encode($newpass);
    $newpass2 = base64_encode($newpass2);


    if ($newpass==$newpass2){
    $checkProfile = mysqli_query($db, "SELECT * FROM profiles WHERE username='".$_SESSION['username']."'");
    while($row=mysqli_fetch_array($checkProfile)){
        $storedPass = $row['password'];
        if ($oldpass==$storedPass){
            $updatePass = mysqli_query($db, "UPDATE profiles SET password='$newpass' WHERE username='".$_SESSION['username']."'");
            if ($updatePass){
                //sms
                $message = "Your password was successfully changed!";

                $results = itexmo("0".$row['contactNum'], $message,"ST-GABZA946272_A56HS", "r3{5q9kim}");
                if ($results == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }   else if ($results == 0){

                    $addEvent = "".$_SESSION['username']." updated their password.";
                    $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$addEvent."', '".$_SESSION['username']."')";
                    $updateHistoExe = mysqli_query($db, $updateHisto);
                    header ("location: settings.php");
             
                }

                else if ($results == 4){
                    echo "<script>alert('Cannot send SMS! All free SMS are used!');</script>";
                    $addEvent = "".$_SESSION['username']." updated their password.";
                    $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$addEvent."', '".$_SESSION['username']."')";
                    $updateHistoExe = mysqli_query($db, $updateHisto);
                    header ("location: settings.php");

                }

                else{ 
                    echo "<script>alert('Error Num ". $results . " was encountered! Process completed but cannot send the SMS at the moment.');</script>";
                    $addEvent = "".$_SESSION['username']." updated their password.";
                    $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$addEvent."', '".$_SESSION['username']."')";
                    $updateHistoExe = mysqli_query($db, $updateHisto);
                    header ("location: settings.php");
                }
                //sms
            }
        echo "<script>alert('There is an updating error!');</script>";
        }//first while if
    else {echo "<script>alert('Password incorrect!');</script>";}
    }//main while
}//check if
    else {
        echo "<script>alert('New password does not matched! Please try again!');</script>";
    }
}//main if
   
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <div id="updiv">
        <!-- <img src="img/logo.png" id="logo"> -->
<?php

$banner4Query = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo' AND imgFile=''") or die(mysqli_error($db));
$banner4 = mysqli_num_rows($banner4Query);
$banner4Query2 = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo'") or die(mysqli_error($db));
$bannerFour = mysqli_fetch_array($banner4Query2);

   if ($banner4 == '0'){
      echo   "<img src='data:image;base64,".base64_encode($bannerFour['imgFile'])."' id='logo'>";
    } else { echo   "<img src='img/defaultLogo.png' id='logo'>"; }
?>
    </div>
    <div id="downdiv">
        <div id="formdiv">
            <form id="changepassform" action="" method="post" name="changepass">
                <br><br><br><br><br><h1> Change Password</h1>
                <input type="password" id="passTxt" name="oldpass" autocomplete="off" placeholder="Current password" required><br>
                <input type="password" id="newpassTxt" name="newpass" autocomplete="off" placeholder="New password" required><br>
                <input type="password" id="newpassTxt2" name="newpass2" autocomplete="off" placeholder="Confirm new password" required><br>
                <input type="submit" id="confirmBtn" value="Continue" name="submit" onclick="return confirm('Are you sure you want to proceed?');"><br><br>
            </form>
        </div>
    </div>

</body>
</html>