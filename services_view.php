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
       #servicesview-list{
        border-collapse: collapse;
        font-size: 0.9em;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); 
        width: 100%;
       }
       #servicesview-list th{
          position: sticky;
          top: 0px;
          background-color: #085e72;
          color: #ffffff;
          text-align: center;
          font-size: 100%;
          padding: 15px 25px;
          font-weight: bold;
        
        }

        #servicesview-list tbody tr td{
          padding: 5px 25px;
        }
        #servicesview-list tr td:first-child{
            width: fit-content;
            margin-left: 10px;
        }
        #servicesview-list thead tr th:first-child{
            width: 25%;
            margin-left: 15px;
        }
        #servicesview-list tbody tr:last-of-type {
          border-bottom: 2px solid #085e72;
        }
        #servicesview-list tbody tr{
          border-bottom: 1px solid #dddddd;
        }
        #updateBtn a button{
          background-color: #085e72;
          color: #fff;
          border: none;
          outline: none;
          height: 35px;
          padding: auto;
          text-align: center;
          border-radius: 25px;
          font-size: 90% !important;
          font-weight: normal;
          margin-top: 5px;
          width: 200px;
        }
        #blurer{
          height: 100%;
          width: 100%;
          top: 0px;
          right: 0px;
          left: 0px;
          bottom: 0px;
          display: block;
          position: absolute;
          z-index: 900;
          opacity: 0.8;
        }
        #msgform{
            height: 70%;
            width: 40%;
            margin-left: 30%;
            margin-right: 30%;
            z-index: 999;
            display: block;
            position: absolute;
            top: 75px;
            background-color: #fff;
            padding: 30px;
        }
        #textArea{
          resize: none; 
          height: 200px; 
          width: 100%;
          outline: none;
          border: 3px lightgray solid;
          background-color: #fff;
          border-radius: 20px;
          padding: 30px;
          font-size: 100%;
        }
        #sender{
          background-color: transparent;
          outline: none;
          border: none;
          font-weight: bold;
          font-style: italic;
          width: auto;
          padding: 5px;

        }
        #sendBtn{
          display: block;
          position: relative;
          margin-right: 0px;
          margin-left: auto;
          height: 50px;
          width: 150px;
          color: #fff;
          border: none;
          background-color: #085e72;
          border-radius: 25px;
        }

        #sendBtn1{
          display: block;
          position: relative;
          margin-right: 0px;
          margin-left: auto;
          height: 50px;
          width: 150px;
          color: #000000;
          border: none;
          background-color: #FFFFFF;
          border-radius: 25px;
          border: solid 1px;
        }
        #eventDiv{
          position: relative;
          display: inline-block;
          top: 0px;
        }
        #back{
          position: absolute;
          top: 0px;
          left: -35px;
          margin-top: 10px;
          padding: 10px 25px;
          font-size: 100%;
          border-radius:10px;
          width: fit-content;
          border: none;
          background-color: #085e72;
          color: #fff;
        }
        td{
          max-width: 210px;
            word-wrap:break-word;
        }
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
        .subEventBtn{
          display: inline-block;
          width: 49%;
          height: 45px;
          margin-top: 15px;
          border-radius: 6px;
          border: 1px solid;
          outline: none;
        }
        #confirmSE:hover{
          background-color: #053e4c;
          transition: 0.3s;
        }
        .subEvent{
          height: 40px;
          padding: 15px;
          font-size: 100%;
          margin-top: 6px;
          border: 1px solid dimgray;
          border-radius: 7px;
          outline: none;
          width: 100%;
        }

        .search-container{
  position: relative;
  display: inline-block;
  flex-wrap: nowrap;
  left:170px;
  height: 35px;
  float: right;
  background-color: #ddd;
  border-radius: 5px;
  z-index: 5;
}
#searchTxt{
  height: 100%;
  width: auto;
  max-width: 200px;
  margin-top: auto;
  margin-bottom: auto;
  outline: none;
  border: none;
  font-size: 90%;
  padding-top: 3px;
  padding-bottom: 3px;
  padding-left: 10px;
  background-color: transparent;
}


#searchBtn{
  display: inline-block;
  height: 100%;
  width: 50px;
  border: 0px;
  color: #ddd;
  background-color: #ddd;
  font-size: 20px;
  font-weight: bold;
  border-radius: 0px 5px 5px 0px;
}
@media screen and (max-width: 800px) {
  .search-container {
    display: inline-block;
    width: 50%; /* The width is 50%, when the viewport is 800px or smaller */
  }
  #searchTxt{
    width: 50px;
  } 
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
       .subEventBtn{
          font-size: 90%;
          color: #fff;
          border: none;
       }
       #sendBtn{
        border: none;
       }
       #sendBtn1{
        border: none;
        background-color: dimgray;
        color: #fff;
        margin-left: 5px;
       }
       .sortOpt{
        text-align: right;
       }

     </style>
   </head>
<body>
  <div id="blurer" style="visibility:hidden;  background-color: black; height: 100%;">&nbsp;</div>

  <section class="home-section">
    <nav style="background-color: #085e72; color: #fff;">
      
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
      <div id="head-side">
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
          <!-- <div>
              
          </div> -->
          <!--display info-->
          <!-- Jen's Side Starts here!-->
<?php
    if (isset($_GET['servId'], $_GET['servParticipant'], $_GET['servName'], $_GET['countList'], $_GET['countCap'])){
              $id = $_GET['servId'];
              $participant = $_GET['servParticipant'];
              $servName = $_GET['servName'];
              $countList = $_GET['countList'];
              $countCap = $_GET['countCap'];

             $result = mysqli_query($db,"SELECT * FROM services WHERE servId='$id'");
             if($row = mysqli_fetch_array($result)){
                echo "<div id='eventDiv' style='display:inline-block; margin-left: 5%; width: auto; height: auto; style='white-space: nowrap;''>";
                echo "<table id='title-table' border='1' style='border-collapse:collapse; text-align: center; margin-top: 1%; background-color: #f5f5f5 !important; font-size: 105%;'><tbody>";
                echo "<tr><td width='250px'><label><b>Name</b></label></td>";
                echo "<td width='1000px'><label>".$row['servName']."</label></td>";
                echo "<td width='250px'><label><b>Category</b></label></td>";
                echo "<td width='120px'><label>".$row['servCate']."</label></td></tr>";

                echo "<tr><td width='250px'><label><b>Place</b></label></td>";
                echo "<td width='1000px'><label>".$row['servPlace']."</label></td>";
                echo "<td width='250px'><label><b>Capacity</b></label></td>";
                echo "<td width='120px'><label>".$row['servCapacity']."</label></td></tr>";

                echo "<tr><td width='250px'><label><b>Coordinator</b></label></td>";
                echo "<td width='1000px'><label>".$row['coorName']."</label></td>";
                echo "<td width='250px'><label><b>Contact No.</b></label></td>";
                echo "<td width='120px'><label>".$row['coorNum']."</label></td></tr>";

                $when = $row['servStart']." to ".$row['servEnd'];
                echo "<tr><td width='250px'><label><b>Date and time</b></label></td>";
                echo "<td width='1000px'><label>From ".$when."</label></td>";
                echo "<td width='250px'><label><b>Recently Updated By</b></label></td>";
                echo "<td width='120px'><label>".$row['updatedBy']."</label></td></tr>";

              echo "</tbody></table></div>";

                echo "<div id='addPBtn'>";
                echo "<a href='services_qualify.php?servId=".$id."&servName=".$servName."&servParticipant=".$participant."' id='anchorTag'>";
                echo "<input type='button' id='btnParticipant' class='sideBtn' value='Add Participant'><br></a>";
                echo "<a href='services_edit.php?servId=".$id."'><button id='updateBtn' class='sideBtn' style='width: 200px;'>Update Information</button></a><br>";
                echo "<a href='#'><input type='button' id='createSubEvent' class='sideBtn' value='Create Sub-Event' onclick='showSubEvent()'></a><br>";
                echo "<input type='button' id='msgBtn' class='sideBtn' value='Message Participant(s)' onclick='composeMsg()'><br>";
                echo "<a href='participant_list.php?servId=".$id."'><button id='downloadBtn' class='sideBtn'><i class='bx bx-arrow-to-bottom'></i>Download Record</button></a><br>";
                echo "</div>";

             }
            else {
              echo "something went wrong!";
            }
}//if isset
else { echo 'Empty';}
  if ($countList==$countCap){ ?>
            <script type="text/javascript">
                document.getElementById("btnParticipant").value="";
                document.getElementById("btnParticipant").value="List is Full";
                document.getElementById("btnParticipant").disabled;
                document.getElementById("btnParticipant").className="disabledBtn";
                document.getElementById('anchorTag').href = '#';

            </script>
<?php
          }
        else {
        ?>
            <script type="text/javascript">
                document.getElementById("btnParticipant").value="";
                document.getElementById("btnParticipant").value="Add Participants";
                document.getElementById("btnParticipant").className="enabledBtn";

            </script>
    <?php } ?></br><br>
    <center><h1 style="position: relative;">Registered Participants</h1></center>

<!--search bar section-->

<div id="fPanel" style="position: relative; display: inline-block; padding-left:30px;">
  <form method="post" action="">
      <input type="submit" class="sortBtn" id="All" name="All" value=" Show all">
      <select class="sortBtn" id="sortBtnOpt" name="sortBtnOpt" value="Purok" onchange="this.form.submit();">
            <option class="sortOpt" id="sortPuroks" value="">Purok</option>
            <option class="sortOpt" id="sortPurok1" value="Purok 1">Purok 1</option>
            <option class="sortOpt" id="sortPurok2" value="Purok 2">Purok 2</option>
            <option class="sortOpt" id="sortPurok3" value="Purok 3">Purok 3</option>
            <option class="sortOpt" id="sortPurok4" value="Purok 4">Purok 4</option>
            <option class="sortOpt" id="sortPurok5" value="Purok 5">Purok 5</option>
            <option class="sortOpt" id="sortPurok6" value="Purok 6">Purok 6</option> </select>
  </form>
</div>
<div class="search-container" style="position: relative; float: right; margin-right: 15%; margin-left:auto;">
            <form action="" method = "post">
             <input type="text" placeholder="Search Name.." name="searchTxt" id="searchTxt" autocomplete="off">
            <button type="submit" id="searchBtn" style="background: #ddd; color:#085e72"><i class="bx bx-search"></i></button>
            </form>
</div>
          </div>
</div>

          <!-- Jen's Side Ends here!-->
      </div>
      </div>
      <div id="list-side"> <!--list-->
        <div id="table-div" style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); height: auto; max-height: 500px; overflow-y:auto;">
          <table id="servicesview-list" class="listScroll" style="overflow-y: auto !important; border-radius: 5px 5px 0 0;">
          <thead>
              <tr>
                  <th>Participant Name</th>
                  <th>Age</th>
                  <th>Address</th>
                  <th>Guardian</th>
                  <th>Contact number</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
<?php
if (isset($_GET['servId'], $_GET['servParticipant'], $_GET['servName'])){
  $id = $_GET['servId'];
  $participant = $_GET['servParticipant'];
  $servName = $_GET['servName'];

  if (isset($_REQUEST['searchTxt'])){
        $searchTxt = stripslashes($_REQUEST['searchTxt']);
        $searchTxt = mysqli_real_escape_string($db,$searchTxt); 

        // $query = "SELECT * FROM `services` WHERE servName = '$searchTxt'";
      $query = "SELECT * FROM eventparticipants WHERE eventId='$id' AND addName LIKE ('%".$searchTxt."%')";
      $results = mysqli_query($db,$query) or die(mysqli_error($db));

            while ($rows = mysqli_fetch_array($results)){
              echo "</tr>";
              echo "<tr class='userlistoutput' style='height: 50px;'>";
              echo "<td width='120px'>" . $rows['addName'] . "</td>";
              if ($rows['addAge']<'1'){
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . " m/o</td>";
              }
              else {
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . "</td>";
              }
              echo "<td width='120px' style='text-align: center;'>" . $rows['eventAddress'] . "</td>";
              echo "<td width='120px'>" . $rows['addGuardian'] . "</td>";
              echo "<td width='120px' style='text-align: center;'>" . $rows['addNum'] . "</td>";
              echo "<td width='120px' style='text-align: center;'><a href='services_remove_participant.php?rowId=".$rows['rowId']."'><button id='removeBtn' onclick='return confirm('Are you sure you want to         proceed?');'>Remove</button></a></td>";
              echo "</tr>";
          }//while inside
      echo "</table>";
      echo "</div>";
  }//if isset txt
else if (isset($_REQUEST['sortBtn'])){

    $query = "SELECT * FROM eventparticipants WHERE eventId='$id'";
      $results = mysqli_query($db,$query) or die(mysqli_error($db));

            while ($rows = mysqli_fetch_array($results)){
              echo "</tr>";
              echo "<tr class='userlistoutput' style='height: 50px;'>";
              echo "<td width='120px'>" . $rows['addName'] . "</td>";
              if ($rows['addAge']<'1'){
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . " m/o</td>";
              }
              else {
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . "</td>";
              }
              echo "<td width='120px' style='text-align: center;'>" . $rows['eventAddress'] . "</td>";
              echo "<td width='120px'>" . $rows['addGuardian'] . "</td>";
              echo "<td width='120px' style='text-align: center;'>" . $rows['addNum'] . "</td>";
              echo "<td width='120px' style='text-align: center;'><a href='services_remove_participant.php?rowId=".$rows['rowId']."'><button id='removeBtn' onclick='return confirm('Are you sure you want to         proceed?');'>Remove</button></a></td>";
              echo "</tr>";
          }//while inside
      echo "</table>";
      echo "</div>";
}//else if isset sortBtn

else if (isset($_REQUEST['sortBtnOpt'])){

    $query = "SELECT * FROM eventparticipants WHERE eventId='$id' AND eventAddress LIKE ('%".$_REQUEST['sortBtnOpt']."%')";
      $results = mysqli_query($db,$query) or die(mysqli_error($db));

            while ($rows = mysqli_fetch_array($results)){
              echo "</tr>";
              echo "<tr class='userlistoutput' style='height: 50px;'>";
              echo "<td width='120px'>" . $rows['addName'] . "</td>";
              if ($rows['addAge']<'1'){
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . " m/o</td>";
              }
              else {
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . "</td>";
              }
              echo "<td width='120px' style='text-align: center;'>" . $rows['eventAddress'] . "</td>";
              echo "<td width='120px'>" . $rows['addGuardian'] . "</td>";
              echo "<td width='120px' style='text-align: center;'>" . $rows['addNum'] . "</td>";
              echo "<td width='120px' style='text-align: center;'><a href='services_remove_participant.php?rowId=".$rows['rowId']."'><button id='removeBtn' onclick='return confirm('Are you sure you want to         proceed?');'>Remove</button></a></td>";
              echo "</tr>";
          }//while inside
      echo "</table>";
      echo "</div>";
}//else if isset sort btn opt

else {
  $displayQuery = "SELECT * FROM eventparticipants WHERE eventId='$id'";
  $results = mysqli_query($db, $displayQuery) or die( mysqli_error($db));
  //$count = mysqli_num_rows($results);
    while ($rows = mysqli_fetch_array($results)){
      echo "</tr>";
      echo "<tr class='userlistoutput' style='height: 50px;'>";
      echo "<td width='120px'>" . $rows['addName'] . "</td>";
      if ($rows['addAge']<'1'){
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . " m/o</td>";
              }
      else {
              echo "<td width='120px' style='text-align: center;'>" . $rows['addAge'] . "</td>";
              }
      echo "<td width='120px' style='text-align: center;'>" . $rows['eventAddress'] . "</td>";
      echo "<td width='120px'>" . $rows['addGuardian'] . "</td>";
      echo "<td width='120px' style='text-align: center;'>" . $rows['addNum'] . "</td>";
      echo "<td width='120px' style='text-align: center;'><a href='services_remove_participant.php?rowId=".$rows['rowId']."'><button id='removeBtn' onclick='return confirm('Are you sure you want to proceed?');'>Remove</button></a></td>";
      echo "</tr>";
      }//while inside
      echo "</table>";
      echo "</div>";
  }
}//main if
?>
          </tbody>
          </table>
        </div><!--table div-->
        <br><br>
        <!-- <div>
            <button id="confirmBtn" onclick="javascript:history.go(-1)">Back</button>
        </div> -->

      </div> <!--list div-->
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
  <div id="msgform" style="visibility: hidden;border-radius: 4px; padding-top: 15px; height: fit-content;">
      <form action="sms_participants.php?servId=<?php echo $id?>" method="post">
        <button type="button" id="closeFormBtn" onclick = "closeCompose()" style="float: right; padding-right: 5px; border: none; background-color: transparent; color: dimgray;"><b>x</b></button><br><br>
        <h3 style="margin-bottom: 10px;">Message Partcipants</h3><hr><br>
        <textarea id="textArea" name="message" maxlength="460" placeholder="Note: Maximum charcters: 460 only"></textarea>
        <div style="display: inline-block; padding-left: 10px; padding-right: 0px; width: 100%; background-color:transparent;">
          <span style="font-size: 90%;">From:</span> 
          <!-- name ng nagsend below -->
          <input type="text" name="sender" id="sender" disabled style="display: inline-block;" value=<?php echo $_SESSION['username'];?>>
<form method="post" action="">
      <select class="sortBtn" id="temp" name="temp" value="Template" style="display: inline-block; position: relative;  width: 220px; float: right; margin-right: 0px; margin-bottom: 20px; border-radius: 4px;text-align: center;">
            <option class="sortOpt" id="sortPuroks" value="">Message Template</option>
            <option class="sortOpt" id="temp1" value="Hi! this is to inform you the changes about the [EVENT]. The new event venue is at [VENUE] on [DATE][TIME]">Change venue, date and time</option>
            <option class="sortOpt" id="temp2" value="Hi! this is to inform you about the requirements you need to bring for [EVENT]. Kindly bring [REQUIREMENTS] with you to secure your attendance.">Event Requirements</option>
            <option class="sortOpt" id="temp3" value="Hi! This is to remind you about our incoming event [EVENT] that will going to take place at [VENUE] on [DATE][TIME]">Upcoming event reminder</option>
</form>
</div>
<div style="display: inline;">
        <input type="submit" name="sendBtn" value="Send" id="sendBtn" style="display: inline; margin-left: 30%;">
        <input type="button" name="sendBtn1" value="Close" id="sendBtn1" onclick="closeCompose()" style="margin-left:5%; position: relative; display: inline;">
</div>
      </form>
  </div>
  <div id="createSubEventForm" style="position: absolute; top: 10%; display: block; margin-left: 35%; margin-right: 33%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 30%; padding: 25px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 980; border-radius: 4px; padding-top: 15px;">
      <form method="post" action="services_add_sub.php">
        <button id="closeFormBtn" onclick = "closeEvent()" style="float: right; padding-right: 5px; border: none; background-color: transparent; color: dimgray;"><b>x</b></button><br><br>
        <h2 style="margin-bottom: 10px;">Create Sub-Event</h2>
        <hr>
        <input type="text" name="eventTitle" class="subEvent" placeholder="Sub-event Title:" required autocomplete="off">
        <input type="text" name="subEventLoc" placeholder="Sub-event place:" class="subEvent" required autocomplete="off"><br>

        <label for="subEventStart" style="font-size:100%;">&emsp;Start:&emsp;&nbsp;&nbsp;</label>
        <input type="datetime-local" name="subEventStart" style="width: 75.7%; height: 40px; padding: 15px; font-size: 100%; margin-top: 6px; border: 1px solid dimgray; border-radius: 7px; outline: none;"><br>
        <label for="subEventEnd" style="font-size:100%;">&emsp;End:&emsp;&emsp;</label>
        <input type="datetime-local" name="subEventEnd" style="width: 75.7%; height: 40px; padding: 15px; font-size: 100%; margin-top: 6px; border: 1px solid dimgray; border-radius: 7px; outline: none;"><br>

        <label for="subEventCap" style="font-size:100%;">&emsp;Capacity:&emsp;&nbsp;</label>
        <input type="number" name="subEventCap" min="0" placeholder="0"style="width: 66.7%; height: 40px; padding: 15px; font-size: 100%; margin-top: 6px; border: 1px solid dimgray; border-radius: 7px; outline: none; left: 0px;" max=<?php echo $_GET['countCap']; ?>><br>
        <input type="text" name="subEventCoor" placeholder="Sub-event Coordinator:" class="subEvent" required autocomplete="off"><br>
        <input type="text" name="subEventCoorNum" placeholder="Sub-event Coordinator Number:" class="subEvent" required autocomplete="off"><br>
        <div>
          <button class="subEventBtn" id="confirmSE" onclick="return confirm('Are you sure you want to proceed?');" style="background-color:#085e72; color: #fff; border: none;">Confirm</button>
          <button class="subEventBtn" onclick="closeEvent()" style="background-color:dimgray;">Cancel</button>
          <input type="hidden" name="subEventPart" value=<?php echo $_GET['servParticipant'];?>>
          <input type="hidden" name="mainEventName" value=<?php echo $_GET['servName'];?>>
        </div>

      </form>
  </div>


  <!-- COPY FROM HERE! -->

  <div id="blurer1" style="position: absolute; display: block; top:0px; bottom: 0px; width:100%; height: auto; background-color: #000; opacity: 0.9; z-index: 981; visibility:hidden;">
  </div>
  <!-- TO HERE! -->

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

function showSubEvent(){
  window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
  window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
  window.addEventListener('keydown', preventDefaultForScrollKeys, false);
  
  document.getElementById("blurer").style.visibility="visible";
  document.getElementById("createSubEventForm").style.visibility="visible";

}

function closeEvent() {
  enableScroll();
  document.getElementById("blurer").style.visibility="hidden";
  document.getElementById("createSubEventForm").style.visibility="hidden";
}

function showDialog(){
  disableScroll();
  document.getElementById("blurer1").style.visibility="visible";
  document.getElementById("confirmDialog").style.visibility="visible";
}

function closeDialog(){
  enableScroll();
  document.getElementById("blurer1").style.visibility="hidden";
  document.getElementById("confirmDialog").style.visibility="hidden";
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

var mytextbox = document.getElementById('textArea');
    var mydropdown = document.getElementById('temp');

    mydropdown.onchange = function(){
          mytextbox.value = this.value; //to appened
         //mytextbox.innerHTML = this.value;
    }

 </script>

</body>
</html>