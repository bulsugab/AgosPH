<?php
require('config.php');
session_start();

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

function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    return substr(str_shuffle($chars),0,$length);
}

if (isset($_REQUEST['username'])){
       
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($db,$username);

    $proQuery = mysqli_query($db, "SELECT * FROM profiles WHERE username='$username'") or die(mysqli_error($db));
    $one = mysqli_num_rows($proQuery);

    if ($one==1){
        while ($row = mysqli_fetch_array($proQuery)){
        $num = $row['contactNum']; }//while
        //to edit
        // $_SESSION["username"] = $username;
        // $_SESSION["code"] = $verify;
        // header ("location: verify_code.php");
        //to remove
        
        $verify = rand_string(6);
        $message = "Code is : ".$verify."";
        $send = itexmo("0".$num."", $message, "ST-GABZA946272_A56HS", "r3{5q9kim}");
        if ($send == ""){
            echo "iTexMo: No response from server!!!
            Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
            Please CONTACT US for help. ";  
        } else if ($send == 0){
            $_SESSION["username"] = $username;
            $_SESSION["code"] = $verify;
            header ("location: verify_code.php");
        }
         else if ($results == 4) {
            echo "<script>alert('All free SMS trials are used! Cannot send verification code.');</script>"; 
            header ("location: logout.php");
        }
    }//if one
    else { echo '<script>alert("Username does not exist!");</script>'; }
}//isset

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Step 1 : Enter username</title>
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
                <br><br><br><br><br><h1>Enter your username</h1>
                <input type="text" id="usernameTxt" name="username" autocomplete="off" placeholder="Username"  required><br>
                <input type="submit" id="confirmBtn" value="Continue" name="submit" onclick="return confirm('Are you sure that the username is correct?');"><br><br><br>
        </div>
    </div>
<script>
    function setFocus(){
        document.getElementById("usernameTxt").focus();
    }  
</script>
</body>
</html>