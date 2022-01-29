<?php
require('config.php');
include("auth.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/services-view.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
       .actionBtn{
        background-color: #085e72;
        border: none;
        outline: none;
        padding: 5px 15px;
        text-align: center;
        color: #fff;
        border-radius: 15px;
       }
       #table-div{
        width: 95%;
        height: auto;
        max-height: 500px;
       }
       table{
        width: 100%;
        height: 100%;
        text-align: center;
       }
       table tbody{
        background-color: #f0f0f0;
       }
       table tbody tr{
        padding: 5px 15px;
        height: 35px;
       }
        table tbody tr:last-of-type {
          border-bottom: 3px solid #085e72 !important;
        }
        table tr:nth-child(even) {
            background-color: #fff;
          }

        #back{
          position: relative;
          top: 0px;
          left: 30px;
          padding: 10px 25px;
          font-size: 100%;
          border-radius:10px;
          width: fit-content;
          border: none;
          background-color: #085e72;
          color: #fff;
        }
        #qualified-list tr{
          height: 50px;
          text-align: center;
        }

       #menu a:hover{
        background-color: #074e5e;
       }
       .active_menu{
        font-weight: 900;
       }
       #signoutDrp:hover{
        background-color: #9c001d;
        color: #fff;
       }
       .namesValue{
        text-align: left;
        padding-left: 20px;
       }
     </style>
   </head>
<body>
  <div id="blurer" style="visibility:hidden;  background-color: black; height: 100%;">&nbsp;</div>
  <section class="home-section" style="position: absolute; top: 0px;">
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
      <div class="dropdown">
        <button onclick="showDropdown()" class="dropbtn" data-toggle="dropdown" style="width:fit-content;">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div>
    </nav>
    
    <div class="home-content"> <!--$age = date_diff(date_create($birthDate), date_create($currentDate));-->
    <div id="list-side1" style="display: inline;">
        <!-- <button id="back" onclick="history.go(-1);">Back</button> -->
        <center><h1>Qualified Residents</h1></center>
<div id="fPanel" style="position: relative; display: inline-block; padding-left:30px;">
  <form method="post" action="">
      <input type="submit" class="sortBtn" id="All" name="All" value=" Show all">
      <select class="sortBtn" id="sortBtnOpt" name="sortBtnOpt" value="Purok" onchange="this.form.submit();" style="width: auto;">
            <option class="sortOpt" id="sortPuroks" value="">Purok</option>
            <option class="sortOpt" id="sortPurok1" value="Purok 1">Purok 1</option>
            <option class="sortOpt" id="sortPurok2" value="Purok 2">Purok 2</option>
            <option class="sortOpt" id="sortPurok3" value="Purok 3">Purok 3</option>
            <option class="sortOpt" id="sortPurok4" value="Purok 4">Purok 4</option>
            <option class="sortOpt" id="sortPurok5" value="Purok 5">Purok 5</option>
            <option class="sortOpt" id="sortPurok6" value="Purok 6">Purok 6</option> </select>
  </form>
</div>
<div class="search-container" style="position: relative; float: right; margin-right: 16%; margin-left:auto;">
            <form action="" method = "post">
             <input type="text" placeholder="Search Name.." name="searchTxt" id="searchTxt" autocomplete="off">
            <button type="submit" id="searchBtn" style="background: #ddd; color:#085e72"><i class="bx bx-search"></i></button>
            </form>
</div>
       <!--search bar section-->
          </div>
      </div><br>

        <div id="table-div" style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); max-height: 500px; overflow-y: auto; position: relative; top: 0px;">
          <table id="qualified-list" style=" border-collapse: collapse; height: auto; text-align: center;">
          <thead style="padding: 20px 10px; background-color: #085e72; color: #fff; position: sticky; top:0px;">
              <tr>
                  <th style="padding: 15px;">Address</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th style="text-align: left; padding-left:15px;">Guardian</th>
                  <th style="text-align: left; padding-left:15px;">Contact Number</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody style="text-align: center;">
<?php 

$listRegistered = [];
if (isset($_GET['servParticipant'], $_GET['servName'], $_GET['servId'])) {

            $participant = $_GET['servParticipant'];
            $servName = $_GET['servName'];
            $id = $_GET['servId'];  
            
if ($participant == 'Seniors') {
        if (isset($_REQUEST['searchTxt'])){
        $searchTxt = stripslashes($_REQUEST['searchTxt']);
        $searchTxt = mysqli_real_escape_string($db,$searchTxt);

        $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '59' AND CONCAT(fname, mname, lname) LIKE ('%".$searchTxt."%')") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" . $row['age'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
                }
}//if isset search

    else if (isset($_REQUEST['sortBtnOpt'])){

    $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '59' AND address LIKE ('%".$_REQUEST['sortBtnOpt']."%')") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" . $row['age'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
                }
}//else if isset sort btn opt

    else if (isset($_REQUEST['sortBtn'])){

     $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '59'") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" . $row['age'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
                }
}//else if isset sortBtn

    else {      
                // original code
                $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '59'") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" . $row['age'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
                }
  }//else orig code
}//if senior

else if ($participant == 'Children') {
    if (isset($_REQUEST['searchTxt'])){
        $searchTxt = stripslashes($_REQUEST['searchTxt']);
        $searchTxt = mysqli_real_escape_string($db,$searchTxt);

        $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '0' AND age < '7' AND CONCAT(fname, mname, lname) LIKE ('%".$searchTxt."%')") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='auto'>" . $row['address'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='auto'>" . $row['age'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='auto'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
          }
}//if isset code

    else if (isset($_REQUEST['sortBtnOpt'])){

    $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '0' AND age < '7' AND address LIKE ('%".$_REQUEST['sortBtnOpt']."%')") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='auto'>" . $row['address'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='auto'>" . $row['age'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='auto'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
                }
}//else if isset sort btn opt

    else if (isset($_REQUEST['sortBtn'])){

    $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '0' AND age < '7'") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='auto'>" . $row['address'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='auto'>" . $row['age'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='auto'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
                }
}//else if isset sortBtn

    else {
                //original code
                $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age > '0' AND age < '7'") or die(mysqli_error($db));

                while ($row = mysqli_fetch_array($resultCheck)) {
                  echo "<tr>";
                  echo "<td width='auto'>" . $row['address'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='auto'>" . $row['age'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='auto' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='auto'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn'>Add</button></a></td>";
                  echo "</tr>";
                }
    }//else orig code
}//if children

else if ($participant == 'Infants') {

    if (isset($_REQUEST['searchTxt'])){
        $searchTxt = stripslashes($_REQUEST['searchTxt']);
        $searchTxt = mysqli_real_escape_string($db,$searchTxt);

        $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age < '1' AND CONCAT(fname, mname, lname) LIKE ('%".$searchTxt."%')") or die(mysqli_error($db));


                while ($row = mysqli_fetch_array($resultCheck)) {
            $bday = new DateTime($row['bdate']); // infants
            $today = new Datetime(date('y-m-d'));
            $diff = $today->diff($bday);
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" .$diff->format('%m'). " m/o</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn' onclick='return confirm('Are you sure that you want to add this resident?');'>Add</button></a></td>";
                    echo "</tr>";
                }
}//if isset

  else if (isset($_REQUEST['sortBtnOpt'])){

    $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age < '1' AND address LIKE ('%".$_REQUEST['sortBtnOpt']."%')") or die(mysqli_error($db));


                while ($row = mysqli_fetch_array($resultCheck)) {
            $bday = new DateTime($row['bdate']); // infants
            $today = new Datetime(date('y-m-d'));
            $diff = $today->diff($bday);
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" .$diff->format('%m'). " m/o</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn' onclick='return confirm('Are you sure that you want to add this resident?');'>Add</button></a></td>";
                    echo "</tr>";
                }
}//else if isset sort btn opt

  else if (isset($_REQUEST['sortBtn'])){

    $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age < '1'") or die(mysqli_error($db));


                while ($row = mysqli_fetch_array($resultCheck)) {
            $bday = new DateTime($row['bdate']); // infants
            $today = new Datetime(date('y-m-d'));
            $diff = $today->diff($bday);
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" . $diff->format('%m'). " m/o</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn' onclick='return confirm('Are you sure that you want to add this resident?');'>Add</button></a></td>";
                    echo "</tr>";
                }
}//else if isset sortBtn

  else {
                //original code
                $resultCheck = mysqli_query($db, "SELECT * FROM residents WHERE NOT EXISTS (SELECT * FROM eventparticipants WHERE eventparticipants.addId = residents.idRecord AND eventparticipants.eventId='$id' ) AND age < '1'") or die(mysqli_error($db));


            while ($row = mysqli_fetch_array($resultCheck)) {
            $bday = new DateTime($row['bdate']); // infants
            $today = new Datetime(date('y-m-d'));
            $diff = $today->diff($bday);
                  echo "<tr>";
                  echo "<td width='120px'>" . $row['address'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."</td>";
                  echo "<td width='120px'>" . $diff->format('%m'). " m/o</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['guardian'] . "</td>";
                  echo "<td width='120px' class='namesValue'>" . $row['contactNum'] . "</td>";
                  echo "<td width='120px'><a href='services_add_participant.php?addId=".$row['idRecord']."&eventId=".$id."&addName=" . $row['fname'] . " ". $row['mname'] ." ". $row['lname'] ."&addAge=".$row['age']."&addGuardian=" . $row['guardian'] . "&addNum=" . $row['contactNum'] . "&eventAddress=".$row['address']."&eventName=".$servName."'><button class='actionBtn' onclick='return confirm('Are you sure that you want to add this resident?');'>Add</button></a></td>";
                    echo "</tr>";
                }
    }//else orig code
}//if infant 

else {
      echo "<script>console.log('Else placeholder')</script>";
}
}//main if
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

      function composeMsg(){
        disableScroll();
        document.getElementById("blurer").style.visibility="visible";
        document.getElementById("msgform").style.visibility="visible";
      }
      function closeCompose(){
        enableScroll();
        document.getElementById("textArea").value="";
        document.getElementById("blurer").style.visibility="hidden";
        document.getElementById("msgform").style.visibility="hidden";
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

function goBack(){
  window.open("services_view.php");
}

 </script>

</body>
</html>