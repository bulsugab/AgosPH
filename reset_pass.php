<?php 
require('config.php');
include("auth_forgot.php");

if (isset($_REQUEST['newpass'], $_REQUEST['confirmpass'])){
    $newpass = stripslashes($_REQUEST['newpass']);
    $newpass = mysqli_real_escape_string($db,$newpass);

    $confirmpass = stripslashes($_REQUEST['confirmpass']);
    $confirmpass = mysqli_real_escape_string($db,$confirmpass);

    if ($newpass == $confirmpass){
        $newpass = base64_encode($newpass);
        $passQuery = mysqli_query($db, "UPDATE profiles SET password='$newpass' WHERE username='".$_SESSION['username']."'") or die(mysqli_error($db));
        if ($passQuery){
        header ("location: clear_sessions.php"); }
    }//if equal
    else { echo '<script>alert("Password does not matched!");</script>'; }
}//isset
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Set New Password</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body style="background-color: #085e72; font-size: 90%;" onload="setFocus()">
    <div id="updiv">
        <img src="img/logo.png" id="logo">
    </div>
    <div id="downdiv">
        <div id="formdiv">
            <form id="loginform" action="" method="post" name="login">
                <br><br><br><br><br><h1>Set New Password</h1>
                <input type="password" id="usernameTxt" name="newpass" autocomplete="off" placeholder="Enter New Password"  required><br>
                <input type="password" id="passwordTxt" name="confirmpass" autocomplete="off" placeholder="Confirm New Password"  required><br>
                <input type="submit" id="confirmBtn" value="Continue" name="submit" onclick="return confirm('Are you sure you want to proceed?');"><br><br><br>
        </div>
    </div>
<script>
    function setFocus(){
        document.getElementById("usernameTxt").focus();
    }  
</script>
</body>
</html>