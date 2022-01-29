<?php
require('config.php');
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/settings.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
        #profile-table{
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.9em;
          min-width: 400px;
          overflow: hidden;
          width: 100%;
          padding: 10px 15px !important;
      }
        #profile-table thead tr {
          background-color: #085e72;
          color: #ffffff;
          text-align: center;
          height: 50px;
          font-weight: bold;
      }
        #profile-table tbody tr{
          height: 50px;
          border-bottom: 1px lightgray solid;
        }
      #profile-table tbody tr td:first-child{
        padding-left: 30px !important;
        text-align: left;
      }
      #profile-table tbody tr:last-of-type {
          border-bottom: 2px solid #085e72;
        }
        .settingBtn{
          height: 40px;
          width: 250px;
          margin-bottom: 10px;
          border: none;
          border-radius: 20px;
          outline: none;
          color: #fff;
          background-color: #085e72;
        }


        /*.dropdown-content-update {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
          }

          .dropdown-content-update a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
          }*/

           .dropUpdateB {
          background-color: #085e72;
          color: white;
          /*padding: 16px;
          font-size: 16px;*/
          border: none;
          border-radius: 10px;
          cursor: pointer;
        }

        .dropUpdateB:hover, .dropUpdateB:focus {
          background-color: #085e72;
        }

        .dropdownUpdateB {
          position: relative;
          display: inline-block;
        }

        .dropdown-contentUpdateB {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          overflow: auto;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-contentUpdateB .menuList {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .dropdownUpdateB .menuList:hover {background-color: #ddd;}

        .show {display: block;}

        /*#blurer{
          position: absolute;
          top: 0px;
          bottom: 0px;
          right: 0px;
          left: 0px;
          background-color: black;
          opacity: 0.7;
          z-index: 9999;
        }*/

        #blurer{
          display: block;
          position: absolute;
          top: 0px;
          bottom: 0px;
          right: 0px;
          left: 0px;
          background-color: black;
          z-index: 199;
          opacity: 0.8;
        }
        .removeAccessBtn{
          position: relative;
          padding: 6px 15px;
          background-color: #085e72;
          color: #fff;
          border: none;
          border-radius: 15px;
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
 <!--  <div id="blurer" style="visibility:hidden; background-color: black;">
  </div> -->
  <div id="blurer" style="visibility: hidden;">&nbsp;</div>
  <section class="home-section">
   <nav style="background-color: #085e72; color: #fff;">
      <img src="img/agosph.png" id="appLogo" href="dashboard.php">
      <div id="menu">
        <a href="dashboard.php">Home</a>
        <a href="services.php">Events</a>
        <a href="inventory.php">Inventory</a>
        <a href="residents.php">Residents</a>
        <a href="history.php">Activity Logs</a>
        <a href="settings.php" class="active_menu">Accounts</a>
        <a href="help.php">Help</a>
      </div>

      <div class="dropdown">
        <button onclick="showDropdown()" class="dropbtn" data-toggle="dropdown" style="width:fit-content;">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div>
    </nav>

    <div class="home-content"> 
    <?php
          $active = $_SESSION['username'];
          $checkAdmin = mysqli_query($db, "SELECT * FROM profiles WHERE username='$active' AND idProf='1'") or die(mysqli_error($db));;
          $profile = mysqli_num_rows($checkAdmin);
          //$profile = mysqli_fetch_array($nums);
          if ($profile == '1'){ 
            echo  "<div><a href='verify_pass_profile.php'><button style='background-color:#085e72; color: #fff; height: auto; padding: 10px 25px; float: right; margin-right: 80px; border: none; border-radius: 10px;'>Add an Administrator +</button></a>"; 
            echo "<div class='dropdownUpdateB' style='display: inline; margin-left: 5%; margin-right: 10px; float: right;'>
        <button onclick='showdropdownUpdateB()' class='dropUpdateB' style='margin-right: 10px; background-color:#085e72; color: #fff; height: auto; padding: 10px 25px; float: right; border: none; border-radius: 10px;'>Update&emsp;<i class='fa fa-angle-down' aria-hidden='true' onclick='showdropdownUpdateB()'>&nbsp;</i></button>
        <div id='myDropdownUpdateB' class='dropdown-contentUpdateB' style='margin-top: 30%;'>
          <a class='menuList' href='#' onclick='showImgForm1()'>Banner 1</a>
          <a class='menuList' href='#' onclick='showImgForm2()'>Banner 2</a>
          <a class='menuList' href='#' onclick='showImgForm3()'>Banner 3</a>
          <a class='menuList' href='#' onclick='showImgForm4()'>Brgy Logo</a>
        </div>
      </div>";
          } ?>
       </div>
        <br>
        <div style="height: fit-content; width: 90%; background-color: transparent; margin-left: 60px; 
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
          <table id="users-table" style="width:100%; max-height: 500px; overflow-y: auto;">
            <thead>
              <th width="16.6%">ID</th>
              <th width="16.6%">Name</th>
              <th width="16.6%">Username</th>
              <th width="16.6%">Position</th>
              <th width="16.6%">Status</th>
              <th width="16.6%">Action</th>
            </thead>
            <tbody>
<?php

$logQuery = mysqli_query($db, "SELECT * FROM profiles WHERE username='".$_SESSION['username']."'") or die(mysqli_error($db));
  $loggQueryy = mysqli_fetch_assoc($logQuery);
    $loggQuery = $loggQueryy['idProf'];
    //echo $loggQuery;


      $accQuery = mysqli_query($db, "SELECT * FROM profiles") or die(mysqli_error($db));
      while ($profile = mysqli_fetch_array($accQuery)){
        echo "<tr>";
        echo "<td width='16.6%'>".$profile['employeeId']."</td>";
        echo "<td width='16.6%'>".$profile['fname']." ".$profile['mname']." ".$profile['lname']."</td>";
        echo "<td width='16.6%'>".$profile['username']."</td>";
        echo "<td width='16.6%'>".$profile['position']."</td>";

        if ($profile['username']==''){ 
        echo "<td width='16.6%'>No Access</td>";
        echo "<td width='16.6%'><i>Access has been removed</i></td>";
        }
        else if (($profile['username']==$_SESSION['username'])){
        echo "<td width='16.6%'>Active</td>";
        echo "<td width='16.6%'><a href='change_pass_profile.php'>Change My Password</a></td>";
        }
        else {
            if ($loggQuery=='1'){
              echo "<td width='16.6%'>Active</td>";
              echo "<td width='16.6%'><a href='remove_access.php?profId=".$profile['idProf']."' onclick='return confirm('Are you sure you want to proceed?');'>Remove Access</button></a></td>";; 
            }

        else {
              echo "<td width='16.6%'>Active</td>";
              echo "<td width='16.6%'>You do not have access to modify this.</td>"; 
            }
          }

        }
?>
            </tbody>
          </table>
        </div>
        </div>
    </div>

<div id="uploadImg1" style="position: absolute; display:block; top: 15%; margin-left:37%; margin-right: 37%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 26%; padding: 25px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 900; border-radius:4px; height: fit-content; z-index: 1998; padding-top: 10px;">
        <button style="position: relative; display: block; float: right; background-color: transparent; border: none; color: gray;" onclick="closeEvent()"><h4>x</h4></button><br>
      <h3 style="text-align: center;">Update Banner 1</h3><br>
      <form method="post" action="upload_banner1.php" enctype="multipart/form-data">
        <div style="width:auto; display: block;">
          <label for="banner1" style="font-size: 100%; text-align: center;">Dashboard First Banner: </label>
          <!-- <input type="submit" id="submit1" name="submit" value="Save"> -->
          <input type="file" id="banner1" multiple="false" accept="image/*" name="banner1" onchange="upload()">
        </div> <br>
      <div style="width:100%; background-color:transparent;">
        <input type="submit" name="submit1" value="Save" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: #085e72; color: #fff; border-radius: 7px; border:none;"> 
      <button type="button" onclick="closeEvent()" id="cancel" class="form-btn" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: dimgray; color: #fff; border-radius: 7px; border:none;">Cancel</button> 
      </div>
    </form>
</div>

<div id="uploadImg2" style="position: absolute; display:block; top: 15%; margin-left:37%; margin-right: 37%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 26%; padding: 25px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 900; border-radius:4px; height: fit-content; z-index: 1998; padding-top: 10px;">
         <button style="position: relative; display: block; float: right; background-color: transparent; border: none; color: gray;" onclick="closeEvent()"><h4>x</h4></button><br>
      <h3 style="text-align: center;">Update Banner 2</h3><br>
      <form method="post" action="upload_banner2.php" enctype="multipart/form-data">
        <div>
          <label for="banner2" style="font-size: 100%;">Dashboard Second Banner: </label>
          <input type="file" id="banner2" multiple="false" accept="image/*" name="banner2" onchange="upload()">
        </div> <br><br>

     <div>
       <input type="submit" name="submit2" value="Save" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: #085e72; color: #fff; border-radius: 7px; border:none;"> 
      <button type="button" onclick="closeEvent()" id="cancel" class="form-btn" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: dimgray; color: #fff; border-radius: 7px; border:none;">Cancel</button>
     </div>
      </form> 
</div>

<div id="uploadImg3" style="position: absolute; display:block; top: 15%; margin-left:37%; margin-right: 37%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 26%; padding: 25px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 900; border-radius:4px; height: fit-content; z-index: 1998; padding-top: 10px;">
         <button style="position: relative; display: block; float: right; background-color: transparent; border: none; color: gray;" onclick="closeEvent()"><h4>x</h4></button><br>
      <h3 style="text-align: center;">Update Banner 3</h3><br>
      <form method="post" action="upload_banner3.php" enctype="multipart/form-data">
        <div>
          <label for="banner3" style="font-size: 100%;">Dashboard Third Banner: </label>
          <!-- <input type="submit" id="submit1" name="submit" value="Save"> -->
          <input type="file" id="banner3" multiple="false" accept="image/*" name="banner3" onchange="upload()">
        </div> <br><br>

        <div>
          <input type="submit" name="submit3" value="Save" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: #085e72; color: #fff; border-radius: 7px; border:none;"> 
      <button type="button" onclick="closeEvent()" id="cancel" class="form-btn" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: dimgray; color: #fff; border-radius: 7px; border:none;">Cancel</button>
        </div>

     </form>
</div>

<div id="uploadImg4" style="position: absolute; display:block; top: 15%; margin-left:37%; margin-right: 37%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 26%; padding: 25px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 900; border-radius:4px; height: fit-content; z-index: 1998; padding-top: 10px;">
         <button style="position: relative; display: block; float: right; background-color: transparent; border: none; color: gray;" onclick="closeEvent()"><h4>x</h4></button><br>
      <h3 style="text-align: center;">Update Barangay Logo</h3><br>
      <form method="post" action="upload_logo.php" enctype="multipart/form-data">
        <div>
          <label for="banner4" style="font-size: 16px;">Barangay Official Logo: </label>
          <!-- <input type="submit" id="submit1" name="submit" value="Save"> -->
          <input type="file" id="banner4" multiple="false" accept="image/*" name="banner4" onchange="upload()">
        </div> <br><br>
        <div>
          <input type="submit" name="submit4" value="Save" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: #085e72; color: #fff; border-radius: 7px; border:none;"> 
        <button type="button" onclick="closeEvent()" id="cancel" class="form-btn" style="position: relative; font-size: 90%; width: 150px; height: 35px; margin-bottom: 0%; background-color: dimgray; color: #fff; border-radius: 7px; border:none;">Cancel</button>
        </div>

      

      </form>
</div>

    <footer class="site-footer">
      
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
              <center><p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by 
           <a href="#">AGOS<sup>ph</sup></a>.
              </p></center>
            </div>
              <br>
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
function showImgForm1(){
      document.getElementById("blurer").style.visibility="visible";
      document.getElementById("uploadImg1").style.visibility="visible";
}

function showImgForm2(){
      document.getElementById("blurer").style.visibility="visible";
      document.getElementById("uploadImg2").style.visibility="visible";
}

function showImgForm3(){
      document.getElementById("blurer").style.visibility="visible";
      document.getElementById("uploadImg3").style.visibility="visible";
}

function showImgForm4(){
      document.getElementById("blurer").style.visibility="visible";
      document.getElementById("uploadImg4").style.visibility="visible";
}

function closeEvent(){
    document.getElementById("blurer").style.visibility="hidden";
    document.getElementById("uploadImg1").style.visibility="hidden";
    document.getElementById("uploadImg2").style.visibility="hidden";
    document.getElementById("uploadImg3").style.visibility="hidden";
    document.getElementById("uploadImg4").style.visibility="hidden";

}

function showdropdownUpdateB() {
  document.getElementById("myDropdownUpdateB").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropUpdateB')) {
    var dropdowns = document.getElementsByClassName("dropdown-contentUpdateB");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function upload() {
  var f = document.getElementById('fileInput');
  var img = new SimpleImage(f);
  var canvas = document.getElementById('canvas');
  
  img.drawTo(canvas);
}

</script>
</body>
</html>

