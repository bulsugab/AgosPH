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
     <style>
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
  <div id="blurer" style="visibility:hidden;  background-color: black; overflow: hidden; z-index: 997; position: absolute; top: 0px;">
    </div>
  
  <section class="home-section">
    <nav style="background-color: #085e72; color: #fff;">
      <!-- <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Home</span>
      </div> -->
      <img src="img/agosph.png" id="appLogo">
      <div id="menu">
        <a href="dashboard.php" >Home</a>
        <a href="services.php">Events</a>
        <a href="inventory.php" class="active_menu">Inventory</a>
        <a href="residents.php">Residents</a>
        <a href="history.php">Activity Logs</a>
        <a href="settings.php">Accounts</a>
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
      <div id="head-side">
         <div id="banner">
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
              <th colspan="3">UPDATE ITEM INFORMATION</th>
            </tr>
          </thead>
          <tbody>
<?php

if (isset($_REQUEST['itemId'])){
  $itemId = $_REQUEST['itemId'];

  $itemQuery = mysqli_query($db, "SELECT * FROM items WHERE itemId='$itemId'") or die(mysqli_error($db));
  while ($item = mysqli_fetch_array($itemQuery)){
    $itemName = $item['itemName'];
    $itemGen = $item['itemGen'];
    $itemNo = $item['itemNo'];
    $itemExp = $item['itemExp'];
    $itemFor = $item['itemFor'];
    $itemUnit = $item['itemUnit'];

      echo    "<tr>
              <td><b>Item Name</b></td>
              <td><input type='text' name='itemName' value='".$itemName."' id='itemName' disabled on></td>
              <td><a href='#' id='editName' onclick='viewEdit(); nameEdit();' name='".$itemName."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
            <tr>
              <td><b>Item Brand Name</b></td>
              <td><input type='text' name='itemName' value='".$itemGen."' id='itemgGen' disabled></td>
              <td><a href='#' id='editGen' onclick='viewEdit(); genEdit();' name='".$itemGen."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
            <tr>
              <td><b>Item No.</b></td>
              <td><input type='text' name='itemName' value='".$itemNo."' id='itemNo' disabled></td>
              <td><a href='#' id='editNo' onclick='viewEdit(); noEdit();' name='".$itemNo."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>
            <tr>
              <td><b>Item Expiration Date</b></td>
              <td><input type='text' name='itemName' value='".$itemExp."' id='itemExp' disabled></td>
              <td><a href='#' id='editExp' onclick='viewEdit(); expEdit();' name='".$itemExp."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>

            <tr>
              <td><b>Item Unit</b></td>
              <td><input type='text' name='itemName' value='".$itemUnit."' id='itemUnit' disabled></td>
              <td><a href='#' id='editUnit' onclick='viewEdit(); unitEdit();' name='".$itemUnit."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>

            <tr>
              <td><b>Item For</b></td>
              <td><input type='text' name='itemName' value='".$itemFor."' id='itemfor' disabled></td>
              <td><a href='#' id='editFor' onclick='viewEdit(); forEdit();' name='".$itemFor."'><input type='button' class='editBtn' value='Edit'></a></td></tr>
            </tr>";
    }//while
}//isset
?>
          </tbody>          
        </table>
      </div>
</div>

<div>
            <button id="confirmBtn" onclick="javascript:history.go(-1)">Back</button>
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
<div id="editform-container" style="visibility: hidden; height:200px !important;z-index: 998;">
      <form id="reg-form" method="post" action="inventory_update.php">

          <input type="text" id="hiddenId" class="editform-texthidden" name="hidden" style="position: absolute; top: -100px; visibility: visible; display: none; height: 0px;" value=<?php echo $itemId;?> >
          <button type="button" id="closeFormBtn" onclick = "closeEdit()">x</button><br>
          <h3 id="titleEdit">Edit Info</h3><hr><br>
          <input type="text" id="editThis" class="editform-text" name="toEdit" placeholder="" required autocomplete="off"><br>
          
          <input type="submit" name="submit" class="editform-btn" id="confirm" value="Confirm" style="background-color: #085e72; color: #fff;" onclick="return confirm('Are you sure you want to proceed?');"> 
          <button type="button" onclick="closeEdit()" id="cancel" class="editform-btn" style="background-color: #c0c0c0;">Cancel</button> 
          <input type="text" id="hiddenInitial" class="editform-texthidden" name="initial" style="visibility: hidden;" value= "">
        </form>
</div>

<!-- COPY FROM HERE! -->

  <div id="blurer1" style="position: absolute; display: block; top:0px; bottom: 0px; width:100%; height: auto; background-color: #000; opacity: 0.95; z-index: 981; visibility:hidden;">
  </div>

 <!--  <div id="confirmDialog" style="position: absolute; top: 10%; display: block; margin-left: 35%; margin-right: 33%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 30%; padding: 25px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 990; border-radius: 10px;">
    <br>
    <center><span>Are you sure you want to proceed?</span></center>
    <div style="position: relative; display: block; width: 100%; padding: 15px; height: fit-content;">
      <button style="position: relative; display: inline-block; width:46%; margin-right: 10px; background-color: #085e72; color: #fff; border: 1px solid #085e72; padding: 10px; font-size: 100%;">Confirm</button>
      <button style="position: relative; display: inline-block; width:46%; border: 1px solid dimgray; padding: 10px; font-size: 100%;" onclick="closeDialog()">Cancel</button>
    </div>
    
  </div> -->

  <!-- TO HERE! -->


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
  function genEdit(){
    var edited = document.getElementById('editGen').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

  function expEdit(){
    var edited = document.getElementById('editExp').name;
    document.getElementById("editThis").placeholder= edited+" format: YYYY-MM-DD";
    document.getElementById("hiddenInitial").value= edited;
  
}

function forEdit(){
    var edited = document.getElementById('editFor').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
  
}

function noEdit(){
    var edited = document.getElementById('editNo').name;
    document.getElementById("editThis").placeholder= edited;
    document.getElementById("hiddenInitial").value= edited;
}

function unitEdit(){
    var edited = document.getElementById('editUnit').name;
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
// function showDialog(){
//       window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
//       window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
//       window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
//       window.addEventListener('keydown', preventDefaultForScrollKeys, false);

//       document.getElementById("blurer1").style.visibility="visible";
//       document.getElementById("confirmDialog").style.visibility="visible";
//     }
//     function closeDialog(){
        
//         window.removeEventListener('DOMMouseScroll', preventDefault, false);
//         window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
//         window.removeEventListener('touchmove', preventDefault, wheelOpt);
//         window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
        
//         document.getElementById("blurer1").style.visibility="hidden";
//         document.getElementById("confirmDialog").style.visibility="hidden";
//       }

</script>


</body>
</html>