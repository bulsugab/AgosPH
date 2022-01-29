<?php
require('config.php');
include_once('functions.php');

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

$profileQuery = mysqli_query($db, "SELECT * FROM profiles") or die(mysqli_error($db));
$profilesCheck = mysqli_num_rows($profileQuery);
	if ($profilesCheck > 0){
		header("Location: login.php");
	}

if (isset($_REQUEST['fname'], $_REQUEST['mname'], $_REQUEST['lname'], $_REQUEST['idNum'], $_REQUEST['position'], $_REQUEST['Num'], $_REQUEST['bday'], $_REQUEST['gender'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['passwordConfirm'])){

	$fname = stripslashes($_REQUEST['fname']);
    $fname = mysqli_real_escape_string($db,$fname);

    $mname = stripslashes($_REQUEST['mname']);
    $mname = mysqli_real_escape_string($db,$mname);

    $lname = stripslashes($_REQUEST['lname']);
    $lname = mysqli_real_escape_string($db,$lname);

    $idNum = stripslashes($_REQUEST['idNum']);
    $idNum = mysqli_real_escape_string($db,$idNum);

    $position = stripslashes($_REQUEST['position']);
    $position = mysqli_real_escape_string($db,$position);

    $Num = stripslashes($_REQUEST['Num']);
    $Num = mysqli_real_escape_string($db,$Num);

    $bday = stripslashes($_REQUEST['bday']);
    $bday = mysqli_real_escape_string($db,$bday);

    $gender = stripslashes($_REQUEST['gender']);
    $gender = mysqli_real_escape_string($db,$gender);

    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($db,$username);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($db,$password);

    $passwordConfirm = stripslashes($_REQUEST['passwordConfirm']);
    $passwordConfirm = mysqli_real_escape_string($db,$passwordConfirm);

  	if ($password==$passwordConfirm){

  	$password = base64_encode($password);
  
    $insertQuery = mysqli_query($db, "INSERT INTO profiles (employeeId, username, password, defPassword, fname, mname, lname, bday, position, contactNum) VALUES ('$idNum', '$username', '$password', '$password', '$fname', '$mname', '$lname', '$bday', '$position', '$Num')") or die(mysqli_error($db));

    if ($insertQuery){

    $banner1Query = mysqli_query($db, "INSERT INTO imgs (imgClass) VALUES ('banner1')") or die(mysqli_error($db));
    if ($banner1Query){
    	$banner2Query = mysqli_query($db, "INSERT INTO imgs (imgClass) VALUES ('banner2')") or die(mysqli_error($db));
    	if ($banner2Query){
    		$banner3Query = mysqli_query($db, "INSERT INTO imgs (imgClass) VALUES ('banner3')") or die(mysqli_error($db));
    		if ($banner3Query){
    			$logoQuery = mysqli_query($db, "INSERT INTO imgs (imgClass) VALUES ('logo')") or die(mysqli_error($db));
    		}
    	}
    }


        $message = "Welcome, ".$fname."! Username: ".$username." Password: ".base64_decode($password).".";

        $results = itexmo($Num, $message,"ST-GABZA946272_A56HS", "r3{5q9kim}");
                if ($results == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }   else if ($results == 0){
                	
         			$addEvent = "Super Admin ".$fname." (".$position.") profile created!";
        			$updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Access', '".$addEvent."', '".$username."')";
        			$updateHistoExe = mysqli_query($db, $updateHisto);
                   	header ("location: login.php");
             
                }

                else if ($results == 4){
                    echo "<script>alert('All free SMS trials are used! Cannot send confirmation SMS.');</script>";
                     header ("location: login.php");

                }

                else{ 
                    echo "<script>alert('Error Num ". $results . " was encountered! Process completed but cannot send the SMS at the moment.');</script>";
                    header ("location: login.php");
                }
    	
    }//if insertQuery

    else {
    	echo "<script>alert('Something went wrong!')</script>";
    }
	}//confirm
	else {
		echo "<script>alert('Password do not matched!')</script>";
	}
}//if isset

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to Barangay Tampok HCSM</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
		*{
		  margin: 0;
		  padding: 0;
		  box-sizing: border-box;
		  font-family: 'Poppins', sans-serif;
		}
		body{
			background-color: #085e72;
		}
		#formdiv{
			position: absolute;
			display: flex;
			right: 15%;
			padding: 10px;
			padding-left: 50px;
			margin-top: 2%;
			height: fit-content;
			width: 400px;
			background-color: #fff;
		}
		.inputElem{
			height: 35px;
			width: 280px;
			padding: 5px 10px;
			border-radius: 7px;
			outline: none;
			border: 1px gray solid;
			margin-bottom: 5px;
		}

		.inputInfo{
			height: 35px;
			width: 140px;
			padding: 5px 10px;
			border-radius: 7px;
			outline: none;
			border: 1px gray solid;
			margin-bottom: 5px;
		}

		#confirmBtn{
			margin-top: 10px; 
			position: relative;
			display: inline-block;
			height: 35px;
			width: 140px;
			background-color: #085e72;
			outline: none;
			color: #fff;
			border: none;
			border-radius: 10px;
			padding: 5px 38px;
			text-align: center!important;
			font-size: 100%;
			margin-bottom: 10px;
		}
		#cancelBtn{
			margin-top: 5px; 
			position: relative;
			display: inline-block;
			height: 35px;
			width: 140px;
			background-color: #f5f5f5;
			outline: none;
			color: #000;
			border: solid 1px;
			border-color: dimgray;
			border-radius: 10px;
			padding: 5px 38px;
			text-align: center!important;
			font-size: 100%;
			margin-bottom: 10px;
		}


		.alert {
  			padding: 5px;
 			background-color: #f44336;
  			color: white;
		}

		.closebtn {
  			margin-left: 15px;
  			color: white;
  			font-weight: bold;
  			float: right;
  			font-size: 22px;
  			line-height: 20px;
  			cursor: pointer;
  			transition: 0.3s;
		}

		.closebtn:hover {
  			color: black;
		}	

				#title{
			position: absolute;
			top: 5%;
			left: 5%;
			width: 50%;
			height: 85%;
			border: none;

		}
		#brgyLogo{
			display: inline-block;
			height: 280px;
			top: 0px;
			margin-left: 5%;
			margin-right: auto;
			position: relative;
		}
		#dohLogo{
			display: inline-block;
			height: 280px;
			top: 0px;
			margin-left:25%;
			margin-right: auto;
			position: relative;
		}
		#appLogo{
			display: flex;
			position: relative;
			top: -90px;
			margin-left: 10%;
			margin-right: auto;
			width: 500px;
		}
		#titletxt{
			color: #fff;
			position: absolute;
			bottom: 0px;
			left: 0px;
			width: 50%;
			font-size: 70%;
		}
		#blurer{
			position: absolute;
			height: 100%;
			width: 100%;
			background-color: #000;
			z-index: 98;
			opacity: 0.8;
		}
		#confirmDialog{
			background-color: #fff;
			display: block;
			position: relative;
			border-radius: 15px;
			opacity: 1;
			top: 10%;
			height: 200px;
			width: 350px;
			margin-right: auto;
			margin-left: auto;
			padding: 15px 25px;
			z-index: 99;
		}
		.btn{
			padding: 10px 15px;
			width: 120px;
			display: inline-block;
			position: relative;
			top: -10px;
			border: none;
			border-radius: 5px;
			outline: none;
		}
		#confirmBtnD{
			margin-right: 10px;
			margin-left: 20px;
			background-color: #085e72;
			color: #fff;
			border: 2px solid #085e72;
		}
		#cancelBtnD{
			border: 2px solid #c0c0c0;
		}

		#greetings{
			position: absolute;
			display: block;
			right: 10%;
			top: 15%;
		}
		#greetings h1{

			font-size: 300%;
		}
		#regBtn{
			position: relative;
			top: 10px;
			margin-left: auto;
			margin-right: auto;
			background-color: #f5f5f5;
			color: #085e72;
			font-size: 130%;
			padding: 10px 15px;
			border: none;
			border-radius: 10px;
		}
		#confirmDialog{
			position: absolute;
			display: block;
			background-color: #fff;
			height: fit-content;
			width: 350px;
			margin-top: 10%;
			margin-left: 40%;
			margin-right: 30%;
			z-index: 99;
		}
		.dialogBtn{
			position: relative;
			display: inline-block;
			top: 15px;
			width: 130px;
			height: 35px;
			margin-bottom: 30px;
		}


	</style>
</head>
<body>
	<div id="blurer" style="visibility:hidden;">&nbsp;</div>
	<div id="title">

		<img src="img/DOH.png" id="dohLogo">
		<br>
		<img src="img/agosph.png" id="appLogo">
		<span></span>
		<div id="titletxt">
			<h3>AUTHORIZED PERSONNEL ONLY</h3>
			<span>For any concerns, please contact the <br>administrator(...gov.ph)</span>
		</div>
	</div>
	<div id="formdiv" style="visibility: hidden;">
		<form>
			<br><h1> Register Staff</h1><hr>
                <input type="text" class="inputElem" id="fname" name="fname" autocomplete="off" placeholder="First Name"  required style="margin-top: 10px;"><br>
                <input type="text" class="inputElem" id="mname" name="mname" autocomplete="off" placeholder="Middle Name"  required><br>
                <input type="text" class="inputElem" id="lname" name="lname" autocomplete="off" placeholder="Last Name"  required><br>
                <input type="text" class="inputInfo" id="idNum" name="idNum" autocomplete="off" placeholder="Employee ID No."  required>
                <input type="text" class="inputInfo" id="position" name="position" autocomplete="off" placeholder="Job Title"  required><br>
                <input type="text" class="inputElem" id="Num" name="Num" autocomplete="off" placeholder="Contact Number"  required><br>
                <span>Birth Date: &emsp;</span>
                <input type="date" class="inputElem" id="bday" name="bday" required style="width:170px;"><br>
                <span>Gender:&emsp;</span>
                	<input type="radio" id="gender-male" name="gender" value="Male">
                	<label for="gender-male">Male</label>
                	<input type="radio" id="gender-female" name="gender" value="Female">
                	<label for="gender-female">Female</label><br>
                <input type="text" class="inputElem" id="username" name="username" autocomplete="off" placeholder="Username" required style="margin-top: 10px;"><br>
                <input type="password" class="inputElem" id="passwordTxt" name="password" autocomplete="off" placeholder="Password" required><br>
                <input type="password" class="inputElem" id="passwordTxt" name="passwordConfirm" autocomplete="off" placeholder="Confirm Password" required><br>
                <button id="confirmBtn" id="submit" onclick="return confirm('Are you sure you want to registered as Super Admin of this system?');">Register</button>
                <button id="cancelBtn" onclick="hideForm()">Cancel</button>
		</form>
	</div>
	<div id="greetings">
		<h1 style="color: #fff;">Welcome!</h1><br>
		<button id="regBtn" onclick="showForm()">Register as Administrator</button>
	</div>
	<!-- <div id="confirmDialog" style="visibility:hidden;">
		<br>
		<center><span>Are you sure you want to registered as Super Admin of this system?</span></center>
		<center><button class="dialogBtn" id="confirmD">Confirm</button>
		<button class="dialogBtn" id="cancelD" onclick="hideDialog()">Cancel</button></center>
	</div> -->

	<script>
		function showForm() {
			document.getElementById("formdiv").style.visibility="visible";
			document.getElementById("greetings").style.visibility="hidden";
		}

		function hideForm(){
			document.getElementById("greetings").style.visibility="visible";
			document.getElementById("formdiv").style.visibility="hidden";
		}
		function showDialog() {
			document.getElementById("blurer").style.visibility="visible";
			document.getElementById("confirmDialog").style.visibility="visible"
		}
		function hideDialog() {
			document.getElementById("blurer").style.visibility="hidden";
			document.getElementById("confirmDialog").style.visibility="hidden"
		}
	</script>
</body>
</html>