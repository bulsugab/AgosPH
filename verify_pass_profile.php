<?php
require('config.php');
include("auth.php");

    if (isset($_POST['password'])){

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($db,$password);
    $password = base64_encode($password);
    $username = $_SESSION['username'];
    
    $query = "SELECT * FROM profiles WHERE username='$username' and password = '$password'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));
    $rows = mysqli_num_rows($result);

        if($rows==1){
            header("Location: registration.php");
         }
        else{
        echo '<script>alert("Wrong password! Please try again.");</script>'; 

    }//isset
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Verification</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body style="background-color: #085e72; font-size: 90%;" onload="setFocus()">
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
            <form id="loginform" action="" method="post" name="login">
                <br><br><br><br><br><h1> Enter your password.</h1>
                <input type="password" id="passwordTxt" name="password" autocomplete="off" placeholder="Password" required><br>
                <input type="submit" id="confirmBtn" value="Confirm" name="submit" onclick="return confirm('Are you sure that the password is correct?');"><br><br>
            </form>
        </div>
    </div>
<script>
    function setFocus(){
        document.getElementById("usernameTxt").focus();
    }  
</script>
</body>
</html>