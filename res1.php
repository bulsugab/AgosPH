<?php
require('config.php');
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/res1.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
     <style>
       #logo{
        position: relative;
        float: left;
        width: 80%;
      }

      nav{

        -webkit-box-shadow: 3px 3px 5px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
        -moz-box-shadow:    3px 3px 5px 6px #ccc;  /* Firefox 3.5 - 3.6 */
        box-shadow:         3px 3px 5px 6px #ccc;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
      }
      #appLogo{
        position: relative;
        height: 100%;
        padding: 0px;
        float: left;
        left: 10px;
        margin-right: 10px;
      }
      #banner #imgBanner{
        position: relative;
        display: block;
        margin-right: auto;
        margin-left: auto;
        height: 150px;
      }
      .actionBtn{
        border: none;
        border-radius: 15px;
        background-color: #085e72;
        color: #fff;
        padding: 5px 10px;
      }
     </style>

   </head>
<body>
  <div id="blurer" style="position:absolute; top:0px;left: 0px; right: 0px; bottom: 0px; height:100%; width:100%; background-color: #000; opacity: 0.7; z-index: 999; visibility: hidden;">&nsbp;</div>
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
      </div>
     <!--  <div class="profile-details" style="display: inline-block;">
        <a href="#"><span class="admin_name">Hi, <?php echo $_SESSION['username'];?>!</span></a>
      </div> -->
      <div class="dropdown">
        <button onclick="showDropdown()" class="dropbtn" data-toggle="dropdown" style="width:fit-content;">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="" id="helpOption">Help Option</a>
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div>
    </nav>
    

    <div class="home-content"> <!--$age = date_diff(date_create($birthDate), date_create($currentDate));-->
      <div id="head-side">
        <div id="banner" style="background-color: transparent; float: left;position: relative; top:-100px; width: 15%; border: none;">
          <img src="img/tampok_logo.png" id="imgBanner">
        </div>
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Seniors</div>
<!--seniors--> <?php $result = mysqli_query($db,"SELECT * FROM residents WHERE age > '59'");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
          </div>
          <img src="img/senior.png" class="imgInd">
        </div>
        <div class="box">
          <div class="right-side">
             <div class="box-topic">Children</div>
<!--children--><?php $result = mysqli_query($db,"SELECT * FROM residents WHERE age < '7' AND age >'0'");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
            </div>
          <img src="img/children.png" class="imgInd">
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Infants</div>
<!--infants--><?php $result = mysqli_query($db,"SELECT * FROM residents WHERE age < '1'");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
            </div>
          <img src="img/infant.png" class="imgInd">
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total</div>
<!--total--><?php $result = mysqli_query($db,"SELECT * FROM residents WHERE fname <>''");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
          </div>
          <img src="img/population.png" class="imgInd">
        </div>
      </div>
      <div class="dropdownReg" style="background-color: transparent; margin: 2%; height: 30px;">
        <button onclick="myFunctionReg()" class="dropbtnReg" style="position: relative; display: block; width: 200px; font-size: 100%; height: 45px; padding: 7px; bottom: -5px; border-radius: 7px;">Register</button>
          <div id="myDropdownReg" class="dropdown-contentReg" style="width: 200px; z-index:99; margin-left:15% ; margin-top: -10px;">
                <a href="#">Register a Senior</a>
                <a href="#">Register a Child</a>
                <a href="#">Register an Infant</a>
                <a href="#">Register Others</a>
        </div>
      </div>

      <div class="search-container">
            <form action="" method = "get">
               <input type="text" placeholder="Search Resident Name" name="searchTxt" id="searchTxt" autocomplete="off">
              <button type="submit" id="searchBtn" style="background: #ddd; color:#085e72"><i class="bx bx-search"></i></button>
            </form>
          </div>


   </div>
       <div id="filterPanel" style="background-color: transparent;">
           <form method="post" action="">
            <span>&emsp;&emsp;Sort by: &emsp;</span>
            <input type="submit" class="sortBtn" id="All" name="category" value="All">
            <input type="submit" class="sortBtn" id="Seniors" name="category" value="Seniors">
            <input type="submit" class="sortBtn" id="Children" name="category" value="Children">
            <input type="submit" class="sortBtn" id="Infants" name="category" value="Infants">
            <input type="button" class="sortBtn" id="Others" name="category" value="Others">
          </form>
        </div><br>


        <div id="list-side">
        <div id="table-div" style="position: relative; background-color: transparent; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); max-height: 500px;">
          <table id="residents-list" style="font-size: 90%; overflow-y: auto !important; border-radius: 5px 5px 0 0;">
          <thead>
              <tr>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Age</th>
                  <th>Contact Number</th>
                  <th>&emsp;Action</th>
              </tr>
          </thead>
          <tbody>
<?php
if (isset($_REQUEST['category'])){
  $sortingCat = $_REQUEST['category'];

  if ($sortingCat=='All'){
    $query = "SELECT * FROM residents";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)){?>

      <script>
        document.getElementById("All").style.backgroundColor="#085e72";
        document.getElementById("All").style.color="#fff";
        document.getElementById("All").style.border="1px solid #085e72";

        document.getElementById("Seniors").style.backgroundColor="#f5f5f5";
        document.getElementById("Seniors").style.color="dimgray";
        document.getElementById("Seniors").style.border="1px solid dimgray";

        document.getElementById("Children").style.backgroundColor="#f5f5f5";
        document.getElementById("Children").style.color="dimgray";
        document.getElementById("Children").style.border="1px solid dimgray";

        document.getElementById("Infants").style.backgroundColor="#f5f5f5";
        document.getElementById("Infants").style.color="dimgray";
        document.getElementById("Infants").style.border="1px solid dimgray";

        document.getElementById("Others").style.backgroundColor="#f5f5f5";
        document.getElementById("Others").style.color="dimgray";
        document.getElementById("Others").style.border="1px solid dimgray";

      </script>
      <?php

      // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='120px'>" . $row['lname'] . "</td>";
            echo "<td width='120px'>" . $row['fname'] . "</td>";
            echo "<td width='120px'>" . $row['mname'] . "</td>";
            echo "<td width='120px'>" . $row['age'] . "</td>";
            echo "<td width='120px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
   }//while
   echo "</table>";
   echo "</div>";

  }

  else if ($sortingCat=='Seniors'){?>

      <script>
        document.getElementById("Seniors").style.backgroundColor="#085e72";
        document.getElementById("Seniors").style.color="#fff";
        document.getElementById("Seniors").style.border="1px solid #085e72";

        document.getElementById("All").style.backgroundColor="#f5f5f5";
        document.getElementById("All").style.color="dimgray";
        document.getElementById("All").style.border="1px solid dimgray";

        document.getElementById("Children").style.backgroundColor="#f5f5f5";
        document.getElementById("Children").style.color="dimgray";
        document.getElementById("Children").style.border="1px solid dimgray";

        document.getElementById("Infants").style.backgroundColor="#f5f5f5";
        document.getElementById("Infants").style.color="dimgray";
        document.getElementById("Infants").style.border="1px solid dimgray";

        document.getElementById("Others").style.backgroundColor="#f5f5f5";
        document.getElementById("Others").style.color="dimgray";
        document.getElementById("Others").style.border="1px solid dimgray";

      </script>
      <?php
    $query = "SELECT * FROM residents WHERE age > '59'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)){
      // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='120px'>" . $row['lname'] . "</td>";
            echo "<td width='120px'>" . $row['fname'] . "</td>";
            echo "<td width='120px'>" . $row['mname'] . "</td>";
            echo "<td width='120px'>" . $row['age'] . "</td>";
            echo "<td width='120px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
   }//while
   echo "</table>";
   echo "</div>";

  }

  else if ($sortingCat=='Children'){?>

      <script>
        document.getElementById("Children").style.backgroundColor="#085e72";
        document.getElementById("Children").style.color="#fff";
        document.getElementById("Children").style.border="1px solid #085e72";

        document.getElementById("All").style.backgroundColor="#f5f5f5";
        document.getElementById("All").style.color="dimgray";
        document.getElementById("All").style.border="1px solid dimgray";

        document.getElementById("Seniors").style.backgroundColor="#f5f5f5";
        document.getElementById("Seniors").style.color="dimgray";
        document.getElementById("Seniors").style.border="1px solid dimgray";

        document.getElementById("Infants").style.backgroundColor="#f5f5f5";
        document.getElementById("Infants").style.color="dimgray";
        document.getElementById("Infants").style.border="1px solid dimgray";

        document.getElementById("Others").style.backgroundColor="#f5f5f5";
        document.getElementById("Others").style.color="dimgray";
        document.getElementById("Others").style.border="1px solid dimgray";

      </script>
      <?php
    $query = "SELECT * FROM residents WHERE age > '0' AND age < '7'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)){
      // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='120px'>" . $row['lname'] . "</td>";
            echo "<td width='120px'>" . $row['fname'] . "</td>";
            echo "<td width='120px'>" . $row['mname'] . "</td>";
            echo "<td width='120px'>" . $row['age'] . "</td>";
            echo "<td width='120px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
            
   }//while
   echo "</table>";
   echo "</div>";

  }

  if ($sortingCat=='Infants'){?>

      <script>
        document.getElementById("Infants").style.backgroundColor="#085e72";
        document.getElementById("Infants").style.color="#fff";
        document.getElementById("Infants").style.border="1px solid #085e72";

        document.getElementById("All").style.backgroundColor="#f5f5f5";
        document.getElementById("All").style.color="dimgray";
        document.getElementById("All").style.border="1px solid dimgray";

        document.getElementById("Seniors").style.backgroundColor="#f5f5f5";
        document.getElementById("Seniors").style.color="dimgray";
        document.getElementById("Seniors").style.border="1px solid dimgray";

        document.getElementById("Children").style.backgroundColor="#f5f5f5";
        document.getElementById("Children").style.color="dimgray";
        document.getElementById("Children").style.border="1px solid dimgray";

        document.getElementById("Others").style.backgroundColor="#f5f5f5";
        document.getElementById("Others").style.color="dimgray";
        document.getElementById("Others").style.border="1px solid dimgray";

      </script>
      <?php
    $query = "SELECT * FROM residents WHERE age < '1'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)){
      // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='120px'>" . $row['lname'] . "</td>";
            echo "<td width='120px'>" . $row['fname'] . "</td>";
            echo "<td width='120px'>" . $row['mname'] . "</td>";
            echo "<td width='120px'>" . $row['age'] . "</td>";
            echo "<td width='120px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
   }//while
   echo "</table>";
   echo "</div>";

  }
            
}//isset if
else if (isset($_REQUEST['searchTxt'])){
    $searchTxt = stripslashes($_REQUEST['searchTxt']);
    $searchTxt = mysqli_real_escape_string($db,$searchTxt); 

    $query = "SELECT * FROM residents WHERE fname = '$searchTxt' OR lname = '$searchTxt' OR '$searchTxt'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

            while($row = mysqli_fetch_array($result)){
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='120px'>" . $row['lname'] . "</td>";
            echo "<td width='120px'>" . $row['fname'] . "</td>";
            echo "<td width='120px'>" . $row['mname'] . "</td>";
            echo "<td width='120px'>" . $row['age'] . "</td>";
            echo "<td width='120px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
   }//while
   echo "</table>";
   echo "</div>";
  //}//if row 1
//}//if isset
}
else {
  $result = mysqli_query($db,"SELECT * FROM residents");
  while($row = mysqli_fetch_array($result))
    {
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='120px'>" . $row['lname'] . "</td>";
            echo "<td width='120px'>" . $row['fname'] . "</td>";
            echo "<td width='120px'>" . $row['mname'] . "</td>";
            if ($row['age']=='0'){
              $bday = new DateTime($row['bdate']); // Your date of birth
              $today = new Datetime(date('y-m-d'));
              $diff = $today->diff($bday);
              echo "<td width='120px'>" .$diff->format('%m'). " m/o</td>";
            }
            else {
            echo "<td width='120px'>" . $row['age'] . "</td>";
            }
            echo "<td width='120px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
   }
   echo "</table>";
   echo "</div>";
}
//viewRecords

?>  
          </tbody>
      </table>
        </div>

      </div>





</div>



    
    </div><br><br><br>
  <footer class="site-footer">
      
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
              <center><p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by 
           <a href="#">GROUP NAME</a>.
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

      function registerForm(){

        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);

        document.getElementById("blurer").style.visibility="visible";
        document.getElementById("form-container").style.visibility="visible";
      }

      function registerForm_infant(){

        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);

        document.getElementById("blurer").style.visibility="visible";
        document.getElementById("form-container1").style.visibility="visible";
      } 

      function closeRegister(){
          window.removeEventListener('DOMMouseScroll', preventDefault, false);
          window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
          window.removeEventListener('touchmove', preventDefault, wheelOpt);

          window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
          document.getElementById("blurer").style.visibility="hidden";
          document.getElementById("form-container").style.visibility="hidden";
          document.getElementById("form-container1").style.visibility="hidden";
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

function myFunctionReg() {
  document.getElementById("myDropdownReg").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtnReg')) {
    var dropdowns = document.getElementsByClassName("dropdown-contentReg");
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