<?php
include('auth.php');
require('config.php');
//include('residents.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/residents.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
       .actionBtn{
        background-color: #085e72;
        border: none;
        outline: none;
        padding: 5px 20px;
        text-align: center;
        color: #fff;
        font-size: 90%;
        border-radius: 15px;
       }
       tr td:first-child {
        padding-left: 100px;
        width: 50%;
      }
      tr td:last-child {
        padding-left: 30px;
        width: 50%;
      }
      #menu a:hover{
        background-color: #074e5e;
       }
       .active_menu{
        font-weight: 1000;

       }
       #signoutDrp:hover{
        background-color: #9c001d;
        color: #fff;
       }
      </style>
   </head>
<body>
  <div id="blurer" style="visibility:hidden;">
    </div>
  
  <section class="home-section">
    <nav style="background-color: #085e72; color: #fff;">
      <!-- <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Home</span>
      </div> -->
      <img src="img/agosph.png" id="appLogo">
      <div id="menu">
        <a href="dashboard.php">Home</a>
        <a href="services.php">Events</a>
        <a href="inventory.php">Inventory</a>
        <a href="residents.php" class="active_menu">Residents</a>
        <a href="history.php">Activity Logs</a>
        <a href="settings.php">Accounts</a>
        <a href="help.php">Help</a>
      </div>
     <!--  <div class="profile-details" style="display: inline-block;">
        <a href="#"><span class="admin_name">Hi, <?php echo $_SESSION['username'];?>!</span></a>
      </div> -->
      <div class="dropdown">
        <button onclick="showDropdown()" class="dropbtn" data-toggle="dropdown" style="width:fit-content;">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div>
    </nav>

<div class="home-content">
     <!--  <div id="head-side"style="position: relative; display: block; width: 15%;">
      </div> -->
      <div id="banner" style="background-color: transparent;">
          <!-- <img src="img/tampok_logo.png" id="imgBanner"> -->
<?php

$banner4Query = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo' AND imgFile=''") or die(mysqli_error($db));
$banner4 = mysqli_num_rows($banner4Query);
$banner4Query2 = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo'") or die(mysqli_error($db));
$bannerFour = mysqli_fetch_array($banner4Query2);

   if ($banner4 == '0'){
      echo   "<img src='data:image;base64,".base64_encode($bannerFour['imgFile'])."' id='imgBanner'>";
    } else { echo   "<img src='img/defaultLogo.png' id='imgBanner'>"; }
?>
        </div><br><br><br><br><br>
      <div id="info">
 	    <?php
 	        if (isset($_GET['idRecord'])){
            $id = $_GET['idRecord'];
 		         $result = mysqli_query($db,"SELECT * FROM residents WHERE idRecord='$id'");
             if($row = mysqli_fetch_array($result)){
                /*Note: todo put everything into a table for nicer columns*/
                echo "<table id='editResTable' style='font-size:100%; width: 70%; margin-left:20%; margin-right: auto; background-color: #f5f5f5; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); padding: 5px 15px; position:relative; top: -100px;'><tr>";
                echo "<th colspan='2' style='padding:5px 15px; text-align: center; background-color:#085e72; color: #fff; font-size: 110%; height: 50px; border-radius: '><label><b>".$row['fname']."&ensp;".$row['mname']."&ensp;".$row['lname']."</b></label></th></tr>";

                echo "<tr><td><label><b>Address: </b></label></td>";
                echo "<td><label><b>".$row['address']."</b></label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['bdate']."' disable></input>";
                echo "<tr><td><label><b>Birthdate: </b></label></td>";
                echo "<td><label><b>".$row['bdate']."</b></label></td></tr>";
                echo "<tr><td><label><b>Age: </b></label></td>";
                echo "<td><label><b>".$row['age']."</b></label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['age']."' disable></input>";
                echo "<tr><td><label><b>Gender: </b></label></td>";
                echo "<td><label><b>".$row['gender']."</b></label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['gender']."' disable></input><br>";

                echo "<tr><td><label><b>Disability: </b></label></td>";
                echo "<td><label><b>".$row['disability']."</b></label></td></tr>";

                echo "<tr><td><label><b>Guardian Name: </b></label></td>";
                echo "<td><label><b>".$row['guardian']."</b></label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['guardian']."' disable></input><br>";
                echo "<tr><td><label><b>Contact Number [Primary]: </b></label></td>";
                echo "<td><label><b>".$row['contactNum']."</b></label></td></tr>";
            
                echo "<tr><td><label><b>Record created by: </b></label></td>";
                echo "<td><label><i>".$row['created_by']."</i></label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['created_by']."' disable></input><br><br>";

                echo "<tr><td colspan='2' style='padding-left:0px;'><center><a href='resident_edit.php?idRecord=".$row['idRecord']."&fname=".$row['fname']."&mname=".$row['mname']."&lname=".$row['lname']."&bdate=".$row['bdate']."&address=".$row['address']."&guardian=".$row['guardian']."&contactNum=".$row['contactNum']."&contactNum2=".$row['contactNum2']."'><button class='actionBtn'>Update</button></a></center></td></tr>";
                echo "<tr><td colspan='2' style='padding-left:0px;'><center><a href='#' onclick='history.go(-1);'>Back</a></center></td></tr></table>";

             }
            else {
              echo "something went wrong!";
            }

 	        }//if isset
 	        else { echo 'Empty';}
 	        ?>
 	<!--<Label></Label>
 	<input>-->
      </div>
</div>
<footer class="site-footer" style="display: block;position: relative; top: -20px;">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
              <center><p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by 
           <a href="#">AGOS<sup>ph</sup></a>.
              </p></center>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="social-icons">
                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
              </ul>
            </div>
          </div>
        </div>
    </footer>
</section>
<script>
  let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if(sidebar.classList.contains("active")){
    sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
  }else
    sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  }

  function showDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
</body>
</html>