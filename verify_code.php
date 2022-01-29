<?php 
require("config.php");
include("auth_forgot.php");

if (isset($_REQUEST['verification'])){
    $verification = $_REQUEST['verification'];
   
    if ($verification == $_SESSION['code']){
        header ("location: reset_pass.php");
    }//if equal
    else { echo '<script>alert("Code is incorrect!");</script>'; }
}//isset
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Step 2 : Confirm Code</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body style="background-color: #085e72; font-size: 90%;" onload="setFocus()">
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
            <form id="loginform" action="" method="post" name="login">
                <br><br><br><br><br><h1>Verify the code</h1>
                <input type="text" id="usernameTxt" name="verification" autocomplete="off" placeholder="Enter your code here"  required><br>
                <input type="submit" id="confirmBtn" value="Continue" name="submit" onclick="return confirm('Are you sure that the code is correct?');"><br><br><br>
        </div>
    </div>
<script>
    function setFocus(){
        document.getElementById("usernameTxt").focus();
    }  
</script>
</body>
</html>