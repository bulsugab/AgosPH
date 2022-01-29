<?php
include('auth.php');
require('config.php');
//include('residents.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/services-edit.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style type="text/css">
        #banner{
          position: relative;
          float: left;
          top: -10px !important;
          margin-bottom: 10px;
          width: 100%;
          height: fit-content;
          margin-right: auto;
          margin-left: auto;
          padding: 15px;
          background-color: transparent;
          position: relative;
          display: inline-block;
          width: fit-content;
        }
        #banner #imgBanner{
          position: relative;
          display: inline-block;
          left: 10px;
          height: 150px;
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
  <div id="blurer" style="visibility:hidden;  background-color: black; overflow: hidden; position: absolute; top: 0px; z-index: 400;">
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
        <a href="services.php" class="active_menu">Events</a>
        <a href="inventory.php">Inventory</a>
        <a href="residents.php">Residents</a>
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
      <div id="head-side">
          <!--<button type="button" onclick="registerForm()">Information</button>-->
<div id="banner">
            <!-- <button id="back" onclick="history.go(-1);">Back</button><br><br> -->
              <!-- <img src="img/tampok_logo.png" id="imgBanner"><br> -->
<?php

$banner4Query = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo' AND imgFile=''") or die(mysqli_error($db));
$banner4 = mysqli_num_rows($banner4Query);
$banner4Query2 = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='logo'") or die(mysqli_error($db));
$bannerFour = mysqli_fetch_array($banner4Query2);

   if ($banner4 == '0'){
      echo   "<img src='data:image;base64,".base64_encode($bannerFour['imgFile'])."' id='imgBanner'>";
    } else { echo   "<img src='img/defaultLogo.png' id='imgBanner'>"; }
?>
</div>
      </div>
      <div id="info">
 	      <table id="event-update">
          <thead>
            <tr>
              <th colspan="3">UPDATE INFORMATION</th>
            </tr>
          </thead>
          <tbody>
<?php
if (isset($_GET['servId'])){
  $id = $_GET['servId'];

  $servQuery = mysqli_query($db, "SELECT * FROM services WHERE servId='$id'") or die(mysqli_error($db));
  while ($service = mysqli_fetch_array($servQuery)){
    $eventName = $service['servName'];
    $eventCate = $service['servCate'];
    $eventPlace = $service['servPlace'];
    //$eventParticipant = $service['servParticipant'];
    $eventCapacity = $service['servCapacity'];
    $eventStart = $service['servStart'];
    $eventEnd = $service['servEnd'];
    $eventCoor = $service['coorName'];
    $eventCoorNum = $service['coorNum'];

        echo  "<tr>
              <td><b>Title</b></td>
              <td><input type='text' name='eventName' value='".$eventName."' id='eventname' disabled></td>
              <td><a href='#' id='editName' onclick='viewEdit(); nameEdit();' name='".$eventName."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
            <tr>
              <td><b>Category</b></td>
              <td><input type='text' name='eventName' value='".$eventCate."' id='eventcate' disabled></td>
              <td><a href='#' id='editCate' onclick='viewEdit(); cateEdit();' name='".$eventCate."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
              <tr>
              <td><b>Place</b></td>
              <td><input type='text' name='eventName' value='".$eventPlace."' id='eventdate' disabled></td>
              <td><a href='#' id='editPlace' onclick='viewEdit(); placeEdit();' name='".$eventPlace."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
            <tr>
              <td><b>Event Start</b></td>
              <td><input type='text' name='eventName' value='".$eventStart."' id='eventstart' disabled></td>
              <td><a href='#' id='editStart' onclick='viewEdit(); startEdit();' name='".$eventStart."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>

            <tr>
              <td><b>Event End</b></td>
              <td><input type='text' name='eventName' value='".$eventEnd."' id='eventend' disabled></td>
              <td><a href='#' id='editEnd' onclick='viewEdit(); endEdit();' name='".$eventEnd."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>

            <tr>
              <td><b>Capacity</b></td>
              <td><input type='text' name='eventName' value='".$eventCapacity."' id='eventcap' disabled></td>
              <td><a href='#' id='editCap' onclick='viewEdit(); capEdit();' name='".$eventCapacity."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
            <tr>
              <td><b>Coordinator</b></td>
              <td><input type='text' name='eventName' value='".$eventCoor."' id='eventcoor'disabled></td>
              <td><a href='#' id='editCoor' onclick='viewEdit(); coorEdit();' name='".$eventCoor."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
            <tr>
              <td><b>Coordinator Number:</b></td>
              <td><input type='text' name='eventName' value='".$eventCoorNum."' id='eventcoornum' disabled></td>
              <td><a href='#' id='editCoorNum' onclick='viewEdit(); coorNumEdit();' name='".$eventCoorNum."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>";
  }//while
} //isset
?>
          </tbody>          
        </table>
          <div>
            <button id="confirmBtn" onclick="javascript:history.go(-1)">Back</button>
          </div>

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
      <form id="reg-form" method="post" action="services_update.php">
          <input type="text" id="hiddenId" class="editform-texthidden" name="hidden" style="position: absolute; top: -100px; visibility: visible; display: none; height: 0px;" value= <?php echo $id;?>>
          <input type="text" id="hiddenInitial" class="editform-texthidden" name="initial" style="visibility: hidden; z-index:0;" value= ""> 
          <button type="button" id="closeFormBtn" onclick = "closeEdit()">x</button><br>
          <h3>&nbsp;Edit Info</h3><br>
          <input type="text" id="editThis" name="toEdit" placeholder="" required autocomplete="off" style="height: 40px; padding: 5px 10px; width: 100%; outline: none; font-size: 100%;"><br>
          <button style="border: none; background-color: transparent;"><input type="submit" name="submit" class="editform-btn" id="confirm" value="Confirm" style="height: 40px; border-radius: 10px;  background-color: #085e72; color: #fff;" onclick="return confirm('Are you sure you want to proceed?');"> </button>
          <button type="button" onclick="closeEdit()" id="cancel" class="editform-btn" style="height: 40px; border-radius: 10px; background-color: #c0c0c0;">Cancel</button>
        </form>
    </div>

     <!-- COPY FROM HERE! -->

  <div id="blurer1" style="position: absolute; display: block; top:0px; bottom: 0px; width:100%; height: auto; background-color: #000; opacity: 0.95; z-index: 981; visibility:hidden;">
  </div>

  <!-- <div id="confirmDialog" style="position: absolute; top: 10%; display: block; margin-left: 35%; margin-right: 33%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 30%; padding: 25px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 990; border-radius: 10px;">
    <br>
    <center><span>Are you sure you want to proceed?</span></center>
    <div style="position: relative; display: block; width: 100%; padding: 15px; height: fit-content;">
      <button style="position: relative; display: inline-block; width:46%; margin-right: 10px; background-color: #085e72; color: #fff; border: 1px solid #085e72; padding: 10px; font-size: 100%;">Confirm</button>
      <button style="position: relative; display: inline-block; width:46%; border: 1px solid dimgray; padding: 10px; font-size: 100%;" onclick="closeDialog()">Cancel</button>
    </div>
    
  </div> -->

  <!-- TO HERE! -->

</body>
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

function viewEdit(){
    document.getElementById("blurer").style.visibility="visible";
    document.getElementById("editform-container").style.visibility="visible";

}

function closeEdit(){
    document.getElementById("blurer").style.visibility="hidden";
    document.getElementById("editform-container").style.visibility="hidden";
}

  function nameEdit(){
    var edited = document.getElementById('editName').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}
  function cateEdit(){
    var edited = document.getElementById('editCate').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function startEdit(){
    var edited = document.getElementById('editStart').name;
    document.getElementById("editThis").placeholder= edited+" YYYY-MM-DD HH-MM-SS";
    document.getElementById("hiddenInitial").value= edited;
  
}

function endEdit(){
    var edited = document.getElementById('editEnd').name;
    document.getElementById("editThis").placeholder= +" YYYY-MM-DD HH-MM-SS";
    document.getElementById("hiddenInitial").value= edited;
  
}

  function placeEdit(){
    var edited = document.getElementById('editPlace').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function dateEdit(){
    var edited = document.getElementById('editDate').name;
    document.getElementById("editThis").placeholder= "YYYY-MM-DD";
    document.getElementById("hiddenInitial").value= edited;
  
}

function capEdit(){
    var edited = document.getElementById('editCap').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
}

function coorEdit(){
    var edited = document.getElementById('editCoor').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function coorNumEdit(){
    var edited = document.getElementById('editCoorNum').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
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

function showDialog(){
  window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
  window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
  window.addEventListener('keydown', preventDefaultForScrollKeys, false);

  document.getElementById("blurer1").style.visibility="visible";
  document.getElementById("confirmDialog").style.visibility="visible";
}


</script>


</html>