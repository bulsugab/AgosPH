<?php
include('auth.php');
require('config.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/services.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
      canvas {
          width: 100%;
          height: 50%;
          border: 1px solid black;
        }
       .actionBtn{
        background-color: #085e72;
        border: none;
        outline: none;
        padding: 5px 15px;
        text-align: center;
        color: #fff;
        border-radius: 15px;
       }
       #services-list tbody tr:nth-child(even) {
          background-color: #f2f2f2;
        }
        #services-list tbody tr:last-of-type {
          border-bottom: 2px solid #085e72;
        }

        .dropbtnEvent {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
          }

          .dropbtnEvent:hover, .dropbtnEvent:focus {
            background-color: #2980B9;
          }

          .dropdownEvent {
            position: relative;
            display: inline-block;
          }

          .dropdown-contentEvent {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
          }

          .dropdown-contentEvent a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
          }

          .dropdownEvent a:hover {background-color: #ddd;}

          .show {display: block;}

          #confirmDialog{
            position: absolute;
            display: block;
            background-color: #fff;
            height: fit-content;
            width: 350px;
            margin-top: 10%;
            margin-left: 40%;
            margin-right: 30%;
            z-index: 99;
          }
          .dialogBtn{
            position: relative;
            display: inline-block;
            top: 15px;
            width: 130px;
            height: 35px;
            margin-bottom: 30px;
          }
          #blurer1{
            display: block;
            position: absolute;
            height: 100%;
            width: 100%;
            background-color: black;
            z-index: 910;
            opacity: 0.8;
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
       .form-btn{
        font-size: 90%;
       }
       #cancel{
        background-color: gray;
        color: #fff;
       }
       .fillform-div button{
        font-size: 90%;
       }

     </style>
   </head>
<body>
  <div id="blurer" style="visibility:hidden; background-color: black;">
  </div>
  <section id="home-section">
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
        <button onclick="showDropdown()" class="dropbtn" style="width:fit-content;">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div>
    </nav>
    <div class="home-content"> <!--$age = date_diff(date_create($birthDate), date_create($currentDate));-->
    <!-- JEN'S Side Starts here! -->
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
        <div class="overview-boxes">
        <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
          <div class="right-side">
            <div class="box-topic">Recently Concluded</div>
<?php $result = mysqli_query($db,"SELECT * FROM services WHERE servEnd < CURRENT_DATE() ORDER BY servEnd DESC LIMIT 1"); 
    if ($resultTitle = mysqli_fetch_array($result)){
      echo  "<div class='result'><h1> ".$resultTitle['servName']."</h1> </div>"; }?>    
          </div>
          <img src="img/doneCalendar.png" class="imgIcon">
        </div>
        <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
          <div class="right-side">
             <div class="box-topic" style="font-size: 110%;">Total Upcoming Events</div>
<?php $result = mysqli_query($db,"SELECT * FROM services WHERE servStart > CURRENT_DATE()");          
          echo  "<div class='result'><h1> ".mysqli_num_rows($result)."</h1> </div>"; ?>
            </div>
         <img src="img/numCalendar.png" class="imgIcon">
        </div>
        <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
          <div class="right-side">
            <div class="box-topic">Upcoming Event</div>
<?php $result = mysqli_query($db,"SELECT * FROM services WHERE servStart > CURRENT_DATE() ORDER BY servStart ASC LIMIT 1"); 
    if ($resultTitle = mysqli_fetch_array($result)){        
          echo  "<div class='result'><h1> ".$resultTitle['servName']." </h1></div>"; }?>  
            </div>
          <img src="img/upcomingCalendar.png" class="imgIcon">
        </div>
      </div>

         <!-- end -->
        <br>
          <div style="position: relative; width:100%;background-color: transparent; align-content: left; display: inline-block; margin-left: 0px;">
            <div class="dropdownEvent">
              <button onclick="showDropEvent()" class="dropbtnEvent"style="position: relative; display: inline-block; width: 150px; font-size: 100%; height: 45px; padding: 7px; bottom: -5px; border-radius: 7px; margin-left: 27px; margin-right:auto;"><i class="bx bx-plus"></i>&nbsp;Add</button>
              <div id="myDropdownEvent" class="dropdown-contentEvent" style="width: 150px; z-index:99; margin-left:27px ; margin-top: -8px;">
                <a href="#" onclick="eventForm()">Event</a>
                <a href="#" onclick="eventForm2()">Service</a>
                <a href="#" onclick="eventForm3()">Seminar</a>
                <a href="#" onclick="eventFormOther()">Others</a>
                
              </div>
            </div>
            <div id="fPanel" style="position: relative; display: inline-block;">
              <form method="post" action="">
                  <span>&emsp;&emsp;Sort by:&emsp;</span>
                  <input type="submit" class="sortBtn" id="All" name="All" value="All">
                  <input type="submit" class="sortBtn" id="Upcoming" name="Upcoming" value="Upcoming">
                  <input type="submit" class="sortBtn" id="Concluded" name="Concluded" value="Concluded">
              </form>
              </div>
          
              <!--search bar section-->
              <div class="search-container" style="position: relative; float: right; margin-right: 0px; margin-left:auto;">
            <form action="" method = "get">
             <input type="text" placeholder="Search Event.." name="searchTxt" id="searchTxt" autocomplete="off">
            <button type="submit" id="searchBtn" style="background: #ddd; color:#085e72"><i class="bx bx-search"></i></button>
            </form>
          </div>
          </div>
      </div>

      <div id="list-side">
        <div id="table-div" style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
          <table id="services-list" style="font-size: 90%; max-height: 40px; overflow-y: auto !important; border-radius: 5px 5px 0 0;">
          <thead>
              <tr>
                  <th>Category</th>
                  <th>Event Name</th>
                  <th>Participant</th>
                  <th>Capacity</th>
                  <th>Status</th>
                  <th>When</th>
                  <th>Where</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
<?php
if (isset($_REQUEST['All'])){
  $sortingCat = $_REQUEST['All'];
  if ($sortingCat=="All"){ ?>
    <script>
      document.getElementById("All").style.backgroundColor="#085e72";
      document.getElementById("All").style.color="#fff";

      document.getElementById("Upcoming").style.backgroundColor="#fff";
      document.getElementById("Upcoming").style.color="dimgray";

      document.getElementById("Concluded").style.backgroundColor="#fff";
      document.getElementById("Concluded").style.color="dimgray";
    </script>
    <?php
    $result = mysqli_query($db,"SELECT * FROM services");
        while($row = mysqli_fetch_array($result))
          {
            $countQuery = "SELECT * FROM eventparticipants WHERE eventId='".$row['servId']."'";
                $resultss = mysqli_query($db, $countQuery) or die( mysqli_error($db));
                $count = mysqli_num_rows($resultss);
                echo "<tr>";
                echo "<tr class='userlistoutput'>";
                echo "<td width='70px'>" . $row['servCate'] . "</td>";
                echo "<td width='120px'>" . $row['servName'] . "</td>";
                echo "<td width='70px'>" . $row['servParticipant'] . "</td>";
                //echo "<td width='120px'>" . $row['servCapacity'] . "</td>";
                if ($count==0){
                  echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                  // echo "<td width='120px'>No participants yet</td>"; 
                  echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                }
                else if (($count > 0) && ($count < $row['servCapacity'])){
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                else if ($count == $row['servCapacity']){ 
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>" . $count ." of " . $row['servCapacity'] . "</td>";
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                
                echo "<td width='150px'>From ".$row['servStart']." to ".$row['servEnd']."</td>";
                echo "<td width='100px'>" . $row['servPlace'] . "</td>";
                echo "<td width='100px'><a href='services_view.php?servId=".$row['servId']."&servParticipant=".$row['servParticipant']."&servName=" . $row['servName'] . "&countList=".$count."&countCap=".$row['servCapacity']."'><button class='actionBtn'>View</button></a></td>";
                //echo "<td width='120px'>This is link</td>";
                echo "</tr>";
          }//while inside
      echo "</table>";
      echo "</div>";
  }
}

else if (isset($_REQUEST['Upcoming'])){
  $sortingCat = $_REQUEST['Upcoming'];
  if ($sortingCat=="Upcoming"){?>
    <script>
      document.getElementById("All").style.backgroundColor="#fff";
      document.getElementById("All").style.color="dimgray";

      document.getElementById("Upcoming").style.backgroundColor="#085e72";
      document.getElementById("Upcoming").style.color="#fff";

      document.getElementById("Concluded").style.backgroundColor="#fff";
      document.getElementById("Concluded").style.color="dimgray";
    </script>
    <?php
    $result = mysqli_query($db,"SELECT * FROM services WHERE servStart > CURRENT_DATE() ORDER BY servStart ASC");
        while($row = mysqli_fetch_array($result))
          {
            $countQuery = "SELECT * FROM eventparticipants WHERE eventId='".$row['servId']."'";
                $resultss = mysqli_query($db, $countQuery) or die( mysqli_error($db));
                $count = mysqli_num_rows($resultss);
                echo "<tr>";
                echo "<tr class='userlistoutput'>";
                echo "<td width='70px'>" . $row['servCate'] . "</td>";
                echo "<td width='120px'>" . $row['servName'] . "</td>";
                echo "<td width='70px'>" . $row['servParticipant'] . "</td>";
                //echo "<td width='120px'>" . $row['servCapacity'] . "</td>";
                if ($count==0){
                  echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                  // echo "<td width='120px'>No participants yet</td>"; 
                  echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                }
                else if (($count > 0) && ($count < $row['servCapacity'])){
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                else if ($count == $row['servCapacity']){ 
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>" . $count ." of " . $row['servCapacity'] . "</td>";
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                
                echo "<td width='150px'>From ".$row['servStart']." to ".$row['servEnd']."</td>";
                echo "<td width='100px'>" . $row['servPlace'] . "</td>";
                echo "<td width='100px'><a href='services_view.php?servId=".$row['servId']."&servParticipant=".$row['servParticipant']."&servName=" . $row['servName'] . "&countList=".$count."&countCap=".$row['servCapacity']."'><button class='actionBtn'>View</button></a></td>";
                //echo "<td width='120px'>This is link</td>";
                echo "</tr>";
          }//while inside
      echo "</table>";
      echo "</div>";
  }
}

else if (isset($_REQUEST['Concluded'])){
  $sortingCat = $_REQUEST['Concluded'];
  if ($sortingCat=="Concluded"){
    ?>
    <script>
      document.getElementById("All").style.backgroundColor="#fff";
      document.getElementById("All").style.color="dimgray";

      document.getElementById("Upcoming").style.backgroundColor="#fff";
      document.getElementById("Upcoming").style.color="dimgray";

      document.getElementById("Concluded").style.backgroundColor="#085e72";
      document.getElementById("Concluded").style.color="#fff";
    </script>
    <?php
    $result = mysqli_query($db,"SELECT * FROM services WHERE servEnd < CURRENT_DATE() ORDER BY servEnd DESC");
        while($row = mysqli_fetch_array($result))
          {
            $countQuery = "SELECT * FROM eventparticipants WHERE eventId='".$row['servId']."'";
                $resultss = mysqli_query($db, $countQuery) or die( mysqli_error($db));
                $count = mysqli_num_rows($resultss);
                echo "<tr>";
                echo "<tr class='userlistoutput'>";
                echo "<td width='70px'>" . $row['servCate'] . "</td>";
                echo "<td width='120px'>" . $row['servName'] . "</td>";
                echo "<td width='70px'>" . $row['servParticipant'] . "</td>";
                //echo "<td width='120px'>" . $row['servCapacity'] . "</td>";
                if ($count==0){
                  echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                  // echo "<td width='120px'>No participants yet</td>"; 
                  echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                }
                else if (($count > 0) && ($count < $row['servCapacity'])){
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                else if ($count == $row['servCapacity']){ 
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>" . $count ." of " . $row['servCapacity'] . "</td>";
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                
                echo "<td width='150px'>From ".$row['servStart']." to ".$row['servEnd']."</td>";
                echo "<td width='100px'>" . $row['servPlace'] . "</td>";
                echo "<td width='100px'><a href='services_view.php?servId=".$row['servId']."&servParticipant=".$row['servParticipant']."&servName=" . $row['servName'] . "&countList=".$count."&countCap=".$row['servCapacity']."'><button class='actionBtn'>View</button></a></td>";
                //echo "<td width='120px'>This is link</td>";
                echo "</tr>";
          }//while inside
      echo "</table>";
      echo "</div>";
  }
}

else if (isset($_REQUEST['searchTxt'])){
        $searchTxt = stripslashes($_REQUEST['searchTxt']);
        $searchTxt = mysqli_real_escape_string($db,$searchTxt); 

        // $query = "SELECT * FROM `services` WHERE servName = '$searchTxt'";
        $query = "SELECT * FROM services WHERE servName LIKE ('%".$searchTxt."%')";
        $result = mysqli_query($db,$query) or die(mysqli_error($db));

             while($row = mysqli_fetch_array($result)){

              $countQuery = "SELECT * FROM eventparticipants WHERE eventId='".$row['servId']."'";
                $resultss = mysqli_query($db, $countQuery) or die( mysqli_error($db));
                $count = mysqli_num_rows($resultss);
                echo "<tr>";
                echo "<tr class='userlistoutput'>";
                echo "<td width='70px'>" . $row['servCate'] . "</td>";
                echo "<td width='120px'>" . $row['servName'] . "</td>";
                echo "<td width='70px'>" . $row['servParticipant'] . "</td>";
                //echo "<td width='120px'>" . $row['servCapacity'] . "</td>";
                if ($count==0){
                  echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                  // echo "<td width='120px'>No participants yet</td>"; 
                  echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                }
                else if (($count > 0) && ($count < $row['servCapacity'])){
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                else if ($count == $row['servCapacity']){ 
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>" . $count ." of " . $row['servCapacity'] . "</td>";
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                
                echo "<td width='150px'>From ".$row['servStart']." to ".$row['servEnd']."</td>";
                echo "<td width='100px'>" . $row['servPlace'] . "</td>";
                echo "<td width='100px'><a href='services_view.php?servId=".$row['servId']."&servParticipant=".$row['servParticipant']."&servName=" . $row['servName'] . "&countList=".$count."&countCap=".$row['servCapacity']."'><button class='actionBtn'>View</button></a></td>";
                //echo "<td width='120px'>This is link</td>";
                echo "</tr>";
                }//while inside
       echo "</table>";
        echo "</div>";
    }//search

  else {
  $result = mysqli_query($db,"SELECT * FROM services");
  while($row = mysqli_fetch_array($result))
    {
      ?>
    <script>
      document.getElementById("All").style.backgroundColor="#085e72";
      document.getElementById("All").style.color="#fff";

      document.getElementById("Upcoming").style.backgroundColor="#fff";
      document.getElementById("Upcoming").style.color="dimgray";

      document.getElementById("Concluded").style.backgroundColor="#fff";
      document.getElementById("Concluded").style.color="dimgray";
    </script>
    <?php
       $countQuery = "SELECT * FROM eventparticipants WHERE eventId='".$row['servId']."'";
                $resultss = mysqli_query($db, $countQuery) or die( mysqli_error($db));
                $count = mysqli_num_rows($resultss);
                echo "<tr>";
                echo "<tr class='userlistoutput'>";
                echo "<td width='70px'>" . $row['servCate'] . "</td>";
                echo "<td width='120px'>" . $row['servName'] . "</td>";
                echo "<td width='70px'>" . $row['servParticipant'] . "</td>";
                //echo "<td width='120px'>" . $row['servCapacity'] . "</td>";
                if ($count==0){
                  echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                  // echo "<td width='120px'>No participants yet</td>"; 
                  echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                }
                else if (($count > 0) && ($count < $row['servCapacity'])){
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>".$count." of " . $row['servCapacity'] . "</td>"; 
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                else if ($count == $row['servCapacity']){ 
                    echo "<td width='50px'>" . $row['servCapacity'] . "</td>";
                    echo "<td width='50px'>" . $count ." of " . $row['servCapacity'] . "</td>";
                    //echo "<td width='120px'>" . $row['servStatus'] . "</td>"; 
                }
                
                echo "<td width='150px'>From ".$row['servStart']." to ".$row['servEnd']."</td>";
                echo "<td width='100px'>" . $row['servPlace'] . "</td>";
                echo "<td width='100px'><a href='services_view.php?servId=".$row['servId']."&servParticipant=".$row['servParticipant']."&servName=" . $row['servName'] . "&countList=".$count."&countCap=".$row['servCapacity']."'><button class='actionBtn'>View</button></a></td>";
                //echo "<td width='120px'>This is link</td>";
                echo "</tr>";
          }//while inside
      echo "</table>";
      echo "</div>";
  }
?>
          </tbody>
      </table>
        </div>

      </div> <!--list div-->
    </div><br><br>
    
    <footer class="site-footer">
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
  <div class="fillform-div" id="form-container" style="position: absolute; top: 3%; display: block; width: 26%; margin-left: 37%; margin-right:37%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 33%; padding: 10px; padding-left: 40px; padding-bottom: 20px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 900; border-radius: 4px; padding-top: 8px;">
      <form id="serv-form" method="post" action="services_add.php">
        <button type="button" id="closeFormBtn" onclick = "eventClose()" style="color: gray; margin-right: 15px;">x</button>
        <br><br>
          
          <h2 style="padding-top: 15px;">Add Event</h2><hr><br>
          <input type="text" class="form-text" name="event_name" placeholder="Event Title: " onkeyup="this.value = this.value.toUpperCase();" required autocomplete="off"><br>
          <input type="hidden" name="event_cate" value="Event">
          <input type="text" class="form-text" name="event_loc" placeholder="Where: " required autocomplete="off"><br>
          <input type="Number" class="form-text" name="event_caps" placeholder="Number of Allowed Participants: " required autocomplete="off"><br>
          
              <span>&emsp;Event for:&emsp;&emsp;&nbsp;&nbsp;</span>
                <select name="event_part" id="event_part" required style="height: 35px; width: 220px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">----Participant----</option>
                <option value="Seniors">Seniors</option>
                 <option value="Children">Children</option>
                  <option value="Infants">Infants</option>
                </select><br>
              <label for="event_start">&emsp;From: &emsp;&emsp;</label>
              <input type="datetime-local" max="2999-12-31T20:20" class="form-date" id="event_start" name="event_start" required style="height: 35px; width: 250px;"><br>

              <label for="event_end">&emsp;Until: &emsp;&emsp;&nbsp;</label>
              <input type="datetime-local" max="2999-12-31T20:20" class="form-date" id="event_end" name="event_end" required style="height: 35px; width: 250px;"><br>

            <input type="text" class="form-text" name="coor_name" placeholder="Event Coordinator: " required autocomplete="off"><br>
            <input type="text" class="form-text" name="coor_num" placeholder="Coordinator Number: " required autocomplete="off"><br>

          <input type="submit" name="submit" class="form-btn" id="confirm" value="Confirm" onclick="return confirm('Are you sure you want to proceed?');"> 
          <button type="button" onclick="eventClose()" id="cancel" class="form-btn">Cancel</button> 
        </form>
    </div>

   <!--  NEW POP UP -->
    <div class="fillform-div" id="form-container-services" style="position: absolute; top: 3%; display: block; margin-left: 30%; margin-right: 30%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 33%; padding: 25px; padding-left: 40px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 900; border-radius: 4px; padding-top: 8px;">
      <form id="serv-form" method="post" action="services_add.php" style="margin-right: auto; margin-left:auto;">
        <button type="button" id="closeFormBtn" onclick = "servicesClose()">x</button>
        <br><br>
          
          <h2>Add Service</h2><hr><br>
          <input type="text" class="form-text" name="event_name" placeholder="Service Title: " onkeyup="this.value = this.value.toUpperCase();" required autocomplete="off"><br>
          <input type="hidden" name="event_cate" value="Service">
          <input type="text" class="form-text" name="event_loc" placeholder="Where: " required autocomplete="off"><br>
          <input type="Number" class="form-text" name="event_caps" placeholder="Number of Allowed Participants: " required autocomplete="off"><br>
          
              <span>&emsp;Service for:&emsp;&emsp;&emsp;</span>
                <select name="event_part" id="event_part" required style="height: 35px; width: 198px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">----Participant----</option>
                <option value="Seniors">Seniors</option>
                 <option value="Children">Children</option>
                  <option value="Infants">Infants</option>
                </select><br>
              <label for="event_start">&emsp;From: &emsp;&emsp;</label>
              <input type="datetime-local" max="2999-12-31T20:20" class="form-date" id="event_start" name="event_start" required style="height: 35px; width: 250px;"><br>

              <label for="event_end">&emsp;Until: &emsp;&emsp;&nbsp;</label>
              <input type="datetime-local" max="2999-12-31T20:20" class="form-date" id="event_end" name="event_end" required style="height: 35px; width: 250px;"><br>

            <input type="text" class="form-text" name="coor_name" placeholder="Service Coordinator: " required autocomplete="off"><br>
            <input type="text" class="form-text" name="coor_num" placeholder="Service Number: " required autocomplete="off"><br>

          <input type="submit" name="submit" class="form-btn" id="confirm" value="Confirm" style="font-size: 100%; height: 45px;" onclick="return confirm('Are you sure you want to proceed?');"> 
          <button type="button" onclick="servicesClose()" id="cancel" class="form-btn" style="font-size: 100%;height: 45px;">Cancel</button> 
        </form>
    </div>



    <div class="fillform-div" id="form-container-seminars" style="position: absolute; top: 3%; display: block; margin-left: 30%; margin-right: 30%; visibility: hidden; background-color: #f5f5f5; box-shadow: none; width: 33%; padding: 25px; padding-left: 40px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 900; border-radius: 4px; padding-top: 8px;">
      <form id="serv-form" method="post" action="services_add.php" style="margin-right: auto; margin-left:auto;">
        <button type="button" id="closeFormBtn" onclick = "seminarsClose()">x</button>
        <br><br>
          
          <h2>Add Seminar</h2><hr><br>
          <input type="text" class="form-text" name="event_name" placeholder="Seminar Title: " onkeyup="this.value = this.value.toUpperCase();" required autocomplete="off"><br>
          <input type="hidden" name="event_cate" value="Seminar">
          <input type="text" class="form-text" name="event_loc" placeholder="Where: " required autocomplete="off"><br>
          <input type="Number" class="form-text" name="event_caps" placeholder="Number of Allowed Participants: " required autocomplete="off"><br>
          
              <span>&emsp;Seminar for:&emsp;&emsp;&emsp;</span>
                <select name="event_part" id="event_part" required style="height: 35px; width: 198px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">----Participant----</option>
                <option value="Seniors">Seniors</option>
                 <option value="Children">Children</option>
                  <option value="Infants">Infants</option>
                </select><br>

              <label for="event_start">&emsp;From: &emsp;&emsp;</label>
              <input type="datetime-local" max="2999-12-31T20:20" class="form-date" id="event_start" name="event_start" required style="height: 35px; width: 250px;"><br>

              <label for="event_end">&emsp;Until: &emsp;&emsp;&nbsp;</label>
              <input type="datetime-local" max="2999-12-31T20:20" class="form-date" id="event_end" name="event_end" required style="height: 35px; width: 250px;"><br>

            <input type="text" class="form-text" name="coor_name" placeholder="Seminar Coordinator: " required autocomplete="off"><br>
            <input type="text" class="form-text" name="coor_num" placeholder="Seminar Number: " required autocomplete="off"><br>

          <input type="submit" name="submit" class="form-btn" id="confirm" value="Confirm" onclick="return confirm('Are you sure you want to proceed?');" style="font-size: 100%; height: 45px;"> 
          <button type="button" onclick="seminarsClose()" id="cancel" class="form-btn" style="font-size: 100%;height: 45px;">Cancel</button> 
        </form>

    </div>
    <div id="form-container-others" style="position: absolute; top: 20px; padding: 20px; width: 35%; z-index:900; background-color:#f5f5f5; padding: 30px; border-radius:10px; margin-left: 35%; margin-right: 25%; visibility:hidden;">
        <center><i>Feature not available at this time.</i></center> <br><br>
        <center><button type="button" onclick="othersClose()" id="cancel" class="form-btn" style="background-color: #e0e0e0; color: #000; width: 20%; font-size: 90%; height: 45px; margin-right: auto; margin-left: auto;">Close</button></center>
      </div>
<!-- SYSTEM IMAGES UPDATE--> 


  <div id="blurer1" style="position: absolute; display: block; top:0px; bottom: 0px; width:100%; height: auto; background-color: #000; opacity: 0.95; z-index: 981; visibility:hidden;">
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

  function eventForm(){
      window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
      window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
      window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
      window.addEventListener('keydown', preventDefaultForScrollKeys, false);

    document.getElementById("blurer").style.visibility="visible";
    document.getElementById('blurer').style.height=heightNum;
    document.getElementById("form-container").style.visibility="visible";
}

function eventForm1(){
      window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
      window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
      window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
      window.addEventListener('keydown', preventDefaultForScrollKeys, false);

    document.getElementById("blurer").style.visibility="visible";
    document.getElementById('blurer').style.height=heightNum;
    document.getElementById("form-container1").style.visibility="visible";
}

function eventForm2(){
  
    window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
    window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
    window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);

    document.getElementById("blurer").style.visibility="visible";
    document.getElementById('blurer').style.height=heightNum;
    document.getElementById("form-container-services").style.visibility="visible";
}

function eventForm3(){
  
    window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
    window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
    window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);

    document.getElementById("blurer").style.visibility="visible";
    document.getElementById('blurer').style.height=heightNum;
    document.getElementById("form-container-seminars").style.visibility="visible";
}

function eventClose(){
      window.removeEventListener('DOMMouseScroll', preventDefault, false);
      window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
      window.removeEventListener('touchmove', preventDefault, wheelOpt);
      window.removeEventListener('keydown', preventDefaultForScrollKeys, false);

  document.getElementById("blurer").style.visibility="hidden";
  document.getElementById("form-container").style.visibility="hidden";
}

function seminarsClose(){
      window.removeEventListener('DOMMouseScroll', preventDefault, false);
      window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
      window.removeEventListener('touchmove', preventDefault, wheelOpt);
      window.removeEventListener('keydown', preventDefaultForScrollKeys, false);


  document.getElementById("blurer").style.visibility="hidden";
  document.getElementById("form-container-seminars").style.visibility="hidden";
}

function servicesClose(){
      window.removeEventListener('DOMMouseScroll', preventDefault, false);
      window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
      window.removeEventListener('touchmove', preventDefault, wheelOpt);
      window.removeEventListener('keydown', preventDefaultForScrollKeys, false);


  document.getElementById("blurer").style.visibility="hidden";
  document.getElementById("form-container-services").style.visibility="hidden";
}

function othersClose(){
      window.removeEventListener('DOMMouseScroll', preventDefault, false);
      window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
      window.removeEventListener('touchmove', preventDefault, wheelOpt);
      window.removeEventListener('keydown', preventDefaultForScrollKeys, false);


  document.getElementById("blurer").style.visibility="hidden";
  document.getElementById("form-container-others").style.visibility="hidden";
}

    function eventFormOther(){
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);

        document.getElementById("blurer").style.visibility="visible";
        document.getElementById('blurer').style.height=heightNum;
        document.getElementById("form-container-others").style.visibility="visible";
    }

    function closeDialog(){
        
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
        window.removeEventListener('touchmove', preventDefault, wheelOpt);
        window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
        
        document.getElementById("blurer1").style.visibility="hidden";
        document.getElementById("confirmDialog").style.visibility="hidden";
      }

function showDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('#dropdownn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var x;
    for (x = 0; x < dropdowns.length; x++) {
      var openDropdown = dropdowns[x];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function showDropEvent() {
  document.getElementById("myDropdownEvent").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtnEvent')) {
    var dropdowns = document.getElementsByClassName("dropdown-contentEvent");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// document.addEventListener('mouseup', function(e) {
//     var container = document.getElementById('myDropdownUpdate');
//     if (!container.contains(e.target)) {
//         container.style.display = 'none';
//     }
// });

 </script>

</body>
</html>