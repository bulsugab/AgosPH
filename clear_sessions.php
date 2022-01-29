<?php
require('config.php');
//include("auth.php");
session_start();
// Destroying All Sessions
if(session_destroy())
{
// redirect to login page
header("Location: auth.php");
}
?>