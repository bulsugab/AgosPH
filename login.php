<?php
require('config.php');
session_start();

$profileQuery = mysqli_query($db, "SELECT * FROM profiles") or die(mysqli_error($db));
$profilesCheck = mysqli_num_rows($profileQuery);

if ($profilesCheck != '0'){
    if (isset($_REQUEST['username'], $_REQUEST['password'])){
       
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($db,$username);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($db,$password);

    $password = base64_encode($password);
    
    $query = "SELECT * FROM profiles WHERE username='$username' AND password= ''";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));
    $rows = mysqli_num_rows($result);

        if($rows==1){
            $_SESSION['username']=$username;
            $_SESSION['defPassword']=$password;
            header("Location: change_pass.php");
         }
        else{
            $query = "SELECT * FROM profiles WHERE username='$username' AND password='$password'";
            $result = mysqli_query($db,$query) or die(mysqli_error($db));
            $rows = mysqli_num_rows($result);
                if($rows==1){
                    $_SESSION['username'] = $username;
    $accessIn = $username." signed In.";
    $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Access', '".$accessIn."', '".$_SESSION['username']."')";
    $updateHistoExe = mysqli_query($db, $updateHisto);
                    header("Location: dashboard.php"); } }
        
        echo '<script>alert("Incorrect username/password!");</script>';
        //echo $password; 

    }//isset

}

 else { header("Location: index.php"); }


?>

<!DOCTYPE html>
<html>
    <head>
        <title>HCMS - Login</title>
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
                <br><br><br><br><br><h1> Sign In</h1>
                <input type="text" id="usernameTxt" name="username" autocomplete="off" placeholder="Username"  required><br>
                <input type="password" id="passwordTxt" name="password" autocomplete="off" placeholder="Password" required><br>
                <input type="submit" id="confirmBtn" value="Confirm" name="submit"><br>
                <a href='verify_username.php'>Forgot Password</a><br><br><br>
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