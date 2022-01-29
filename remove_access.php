<?php
include('auth.php');
require('config.php');

if (isset($_GET['profId'])){

$profId = $_GET['profId'];

$remQuery = mysqli_query($db, "UPDATE profiles SET username='', defPassword='', password='' WHERE idProf='$profId'") or die(mysqli_error($db));

if ($remQuery){
	$histoQuery = mysqli_query($db, "SELECT * FROM profiles WHERE idProf='$profId'") or die(mysqli_error($db));
	while ($row = mysqli_fetch_array($histoQuery)){
		$addEvent = "".$_SESSION['username']." removed ".$row['fname']." ".$row['lname']." (".$row['position'].") access!";
		$updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Access', '".$addEvent."', '".$_SESSION['username']."')";
	}	$updateHistoExe = mysqli_query($db, $updateHisto);

header("Location: settings.php");
}

}//issets

?>