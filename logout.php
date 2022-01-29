<?php
require('config.php');
//include("auth.php");
session_start();
$accessOut = $_SESSION['username']." signed Out.";
$updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Access', '".$accessOut."', '".$_SESSION['username']."')";
$updateHistoExe = mysqli_query($db, $updateHisto);
// Destroying All Sessions
if(session_destroy())
{
// redirect to login page
header("Location: auth.php");
}
?>