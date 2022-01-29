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
      table{
        font-size: 90%;
      }
       #tablediv{
        width: fit-content;
       }
       #tablediv td{
          width: 45%;
       }
       #blurer{
        display: block;
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: black;
        z-index: 13;
        opacity: 0.8;
       }
       #closeFormBtn{
        position: relative;
        font-weight: bold;
        float: right;
        border: none;
        background-color: transparent;
        padding: 5px;
        top: 5px;
        right: 0px;
        color: gray;
      }
       #editform-container{
         position: absolute;
          display: flex;
          top: 20px;
          margin-left: 32.5%;
          margin-right: 32.5%;
          margin-top: 5%;
          border-radius: 10px;
          width: 430px;
          height: fit-content;
          padding: 35px;
          padding-top: 10px;
          background-color: #fff;
          box-shadow: 5px black;
          z-index: 30;
       }
       .editform-text{
          position: absolute;
          top: 40%;
          left: 0px;
          height: 35px;
          width: 300px;
          padding: 5px 15px;
          margin-right: 15%;
          margin-left: 15%;
          border: 1px #c0c0c0 solid;
          border-radius: 5px;
          font-size: 100%;
       }
       .editform-btn{
          margin-top: 40px;
          height: 35px;
          width: 150px !important;
          padding: 5px 15px;
          margin-left: 20px;
          border: none;
          border-radius: 15px;
       }
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
      input[type="button"]:disabled{
          background: #053e4c;
          cursor: not-allowed;
      }
      #update-list tr{
        height: 20px;
      }
      #update-list tr:nth-child(even) {
        background-color: #f2f2f2;
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
  <div id="blurer" style="visibility:hidden;  background-color: black; overflow: hidden; position: absolute; top: 0px;">
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
      <div id="head-side" style="width: 15%; margin-top: -7.5%; margin-left: -2.5%;">
          <!--<button type="button" onclick="registerForm()">Information</button>-->
          <div id="banner" style="background-color: transparent;">
          <!-- <img src="img/tampok_logo.png" id="imgBanner" style="float: left; left: 30px; margin-left: 10%; position: relative; width: 100%;"> -->
          <?php

$banner4Query = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo' AND imgFile=''") or die(mysqli_error($db));
$banner4 = mysqli_num_rows($banner4Query);
$banner4Query2 = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo'") or die(mysqli_error($db));
$bannerFour = mysqli_fetch_array($banner4Query2);

   if ($banner4 == '0'){
      echo   "<img src='data:image;base64,".base64_encode($bannerFour['imgFile'])."' id='imgBanner' style='float: left; left: 30px; margin-left: 10%; position: relative; width: 100%;'>";
    } else { echo   "<img src='img/defaultLogo.png' id='imgBanner' style='float: left; left: 30px; margin-left: 10%; position: relative; width: 100%;'>"; }
?>
          <br>
        </div><br>
      </div>
      <div id="info" style=" top:150px;">
 	    <?php
 	        if (isset($_GET['idRecord'], $_GET['fname'], $_GET['mname'], $_GET['lname'], $_GET['bdate'], $_GET['address'], $_GET['guardian'], $_GET['contactNum'], $_GET['contactNum2'])){

            $id = $_GET['idRecord'];
            $fname = $_GET['fname'];
            $mname = $_GET['mname'];
            $lname = $_GET['lname'];
            $bdate = $_GET['bdate'];
            $address = $_GET['address'];
            $guardian = $_GET['guardian'];
            $contactNum = $_GET['contactNum'];
            $contactNum2 = $_GET['contactNum2'];

                echo "<div id='tablediv' style='box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); margin-left: auto; margin-right: auto;'>";
                echo "<table id='update-list' style='height: 300px; width: 700px; background-color: transparent;'>";
                echo "<thead><th colspan='3'><center><span>Update Resident Profile</span> </center> </td></th></thead>";
                echo "<tbody><tr><td>";
                echo "<label><b>First Name </b></label></td>";
                echo "<td><label>".$fname."</label></td>";
                echo "<td><a href='#' id='editFname' onclick='viewEdit(); fnameEdit();' name='".$fname."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['fname']." (Click to edit or leave as is)'></input>";

                echo "<tr><td><label><b>Middle Name </b></label></td>";
                echo "<td><label>".$mname."</label></td>";
                 echo "<td><a href='#' id='editMname' onclick='viewEdit(); mnameEdit();' name='".$mname."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['mname']." (Click to edit or leave as is)'></input>";

                echo "<tr><td><label><b>Last Name </b></label></td>";
                echo "<td><label>".$lname."</label></td>";
                echo "<td><a href='#' id='editLname' onclick='viewEdit(); lnameEdit();' name='".$lname."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                ///echo "<input type='text' placeholder='&emsp;".$row['lname']." (Click to edit or leave as is)'></input><br>";

                echo "<tr><td><label><b>Address </b></label></td>";
                echo "<td><label>".$address."</label></td>";
                echo "<td><a href='#' id='editAddress' onclick='viewEdit(); addressEdit();' name='".$address."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                //echo "&emsp;<a href='#' onclick='viewEdit()'>Edit</a>&emsp;";
                //echo "<input type='text' placeholder='&emsp;".$row['age']." (Click to edit or leave as is)'></input>";

                echo "<tr><td><label><b>Birth Date </b></label></td>";
                echo "<td><label>".$bdate."</label></td>";
                 echo "<td><a href='#' id='editBdate' onclick='viewEdit(); bdateEdit();' name='".$bdate."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['bdate']." (Click to edit or leave as is)'></input>";

                echo "<tr><td><label><b>Guardian Name </b></label></td>";
                echo "<td><label>".$guardian."</label></td>";
                 echo "<td><a href='#' id='editGuardian' onclick='viewEdit(); guardianEdit();' name='".$guardian."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['guardian']." (Click to edit or leave as is)'</input><br>";

                echo "<tr><td><label><b>Contact Number [Primary] </b></label></td>";
                echo "<td><label>".$contactNum."</label></td>";
                echo "<td><a href='#' id='editContactNum' onclick='viewEdit(); contactNumEdit();' name='".$contactNum."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['contactNum']." (Click to edit or leave as is)'></input>";

                echo "<tr><td><label><b>Contact Number [Other] </b></label></td>";
                echo "<td><label>".$contactNum2."</label></td>";
                echo "<td><a href='#' id='editContactNum2' onclick='viewEdit(); contactNum2Edit();' name='".$contactNum2."'><input type='button' class='actionBtn' value='Edit'></a></td></tr>";
                echo "</tbody>";
                echo "<tfoot><tr>";
                
                echo "<td colspan='3'><a href='#' onclick='history.go(-1);'><i class='bx bx-arrow-back'></i>Back</a></td>";
                echo"</table></div>";


 	        }//if isset
 	        else { echo 'Empty';}
 	        ?>
 	<!--<Label></Label>
 	<input>-->
      </div>
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
    </div>
 <div id="editform-container" style="visibility: hidden; z-index: 500; height: 230px;">
      <form id="reg-form" method="post" action="resident_update.php">
        <input type="text" id="hiddenId" class="editform-texthidden" name="hidden" style="position: absolute; top: -100px; visibility: visible; display: none; height: 0px;" value= <?php echo $id;?> >
          <input type="text" id="hiddenInitial" class="editform-texthidden" name="initial" style="visibility: hidden;" value= "">
          <button type="button" id="closeFormBtn" onclick = "closeEdit()" style="background-color: transparent; border: none;">X</button><br>
          <h3 id="titleEdit">Edit Info</h3><hr><br>
          <input type="text" id="editThis" class="editform-text" name="toEdit" placeholder="" required autocomplete="off" style="margin-top: 5px; margin-right: auto; margin-left: 45px; width: 80%;"><br>
          <button style="border: none; background-color: transparent;"><input type="submit" name="submit" class="editform-btn" id="confirm" value="Confirm" style="height: 40px; border-radius: 10px;  background-color: #085e72; color: #fff;" onclick="return confirm('Are you sure you want to proceed?');"></button>
          <button type="button" onclick="closeEdit()" id="cancel" class="editform-btn" style="height: 40px; border-radius: 10px; background-color: #c0c0c0;">Cancel</button>
        </form>
    </div>
<script>
   var keys = {37: 1, 38: 1, 39: 1, 40: 1};
  var heightNum = document.body.scrollHeight;
function preventDefault(e) {
  e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
  if (keys[e.keyCode]) {
    preventDefault(e);
    return false;
  }
}

// modern Chrome requires { passive: false } when adding event
var supportsPassive = false;
try {
  window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
    get: function () { supportsPassive = true; } 
  }));
} catch(e) {}

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

// call this to Disable
function disableScroll() {
  window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
  window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
  window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable
function enableScroll() {
  window.removeEventListener('DOMMouseScroll', preventDefault, false);
  window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
  window.removeEventListener('touchmove', preventDefault, wheelOpt);
  window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}


 function viewEdit(){
  disableScroll();
    document.getElementById("blurer").style.visibility="visible";
    document.getElementById("editform-container").style.visibility="visible";

}
  function fnameEdit(){
    disableScroll();
    var edited = document.getElementById('editFname').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}
  function mnameEdit(){
    disableScroll();
    var edited = document.getElementById('editMname').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

  function lnameEdit(){
    disableScroll();
    var edited = document.getElementById('editLname').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function bdateEdit(){
  disableScroll();
    var edited = document.getElementById('editBdate').name;
    document.getElementById("editThis").placeholder= "YYYY-MM-DD";
    document.getElementById("hiddenInitial").value= edited;
  
}

function addressEdit(){
  disableScroll();
    var edited = document.getElementById('editAddress').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
}

function guardianEdit(){
  disableScroll();
    var edited = document.getElementById('editGuardian').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function contactNumEdit(){
  disableScroll();
    var edited = document.getElementById('editContactNum').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function contactNum2Edit(){
  disableScroll();
    var edited = document.getElementById('editContactNum2').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function closeEdit(){
  enableScroll();
    document.getElementById("blurer").style.visibility="hidden";
    document.getElementById("editform-container").style.visibility="hidden";
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