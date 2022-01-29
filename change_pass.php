<?php
require('config.php');
include('auth.php');

if (isset($_REQUEST['oldpass'])){
    $defpass = base64_decode($_SESSION['defPassword']);
    if (($_REQUEST['oldpass'])===($defpass)){
        if (($_REQUEST['newpass']) === ($_REQUEST['newpass2'])){
    $newpass = stripslashes($_REQUEST['newpass']);
    $newpass = mysqli_real_escape_string($db,$newpass);

    $newpass = base64_encode($newpass);
    
        $query = "UPDATE profiles SET password='$newpass' WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($db,$query);
        if($result){
            header("Location: clear_sessions.php");
        }
    } //added 1st if
    else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Password does not matched!");'; 
        echo 'window.location.href = "change_pass.php";';
        echo '</script>';
    }
}//if inside added if
    else{
    echo '<script type="text/javascript">'; 
    echo 'alert("Incorrect password!");'; 
    echo 'window.location.href = "change_pass.php";';
    echo '</script>';
    }//added else
}//isset if
else{
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <div id="updiv">
       <!--  <img src="img/logo.png" id="logo"> -->
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
<?php } ?>
</body>
</html>