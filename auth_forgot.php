<?php
session_start();
if(!isset($_SESSION["username"], $_SESSION["code"])){
header("location: verify_username.php");
exit(); }
?>