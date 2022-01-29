<?php
include('auth.php');
require('config.php');
require('functions.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/inventory-list.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
      #head-side{
        top: -10px;
      }
      #list-side{
        display: block;
        top: 0px;
      }
      #table-div{
        width: 95%;
        position: relative;
        display: block;
        margin-right: auto;
        margin-left: auto;
      }
       #inventory-pres-list{
          top: 20px;
          width: 100%;
          height: 100%;
          padding: 15px;
          table-layout: auto;
       }
       #inventory-pres-list tbody tr:nth-child(even) {
          background-color: #f2f2f2;
        }
        #inventory-pres-list tbody tr:last-of-type {
          border-bottom: 2px solid #085e72;
        }
        /*#title-table{
          height: 100px;
          width: 60%;
          background-color: #f5f5f5;
        }*/
        #title-table tbody tr{
          background-color: #f5f5f5 !important; 
          padding: 5px;
          border-collapse: collapse; 
          border: 1px solid black; 
          overflow: hidden;
        }

        #title-table{
          position: relative;
          float: left;
          left: 15%;
          width: 65%;
          border-collapse: collapse; 
          /*border: solid 1px; */
          margin-top: -1%; 
          background-color: #f5f5f5 !important; 
          font-size: 92%; 
          text-align: center;overflow: hidden
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

        #btnDiv{
          float: right;
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

        li a i{
          vertical-align: bottom;
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
      <div id="head-side"> <!--dito-->
        <!-- <button onclick="history.go(-1);" style="height: 45px; width: 100px;">Back</button><br> -->
        <div id="banner">
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
        </div><br>
<div id="info">
      <?php
          if (isset($_GET['inventoryId'])){
            $inventoryId = $_GET['inventoryId'];
             $result = mysqli_query($db,"SELECT * FROM items WHERE itemId='$inventoryId'");
             if($row = mysqli_fetch_array($result)){
              echo "<div id='btnDiv'>";

              echo "<a href='inventory_edit.php?itemId=".$inventoryId."'><button id='updateBtn' style='font-size:90%; width:200px; height: 45px; border-radius: 25px;'>Update Information</button></a><br>";
              echo "<a href='prescription_list.php?itemId=".$inventoryId."'><button id='downloadBtn' style='font-size:90%; width:200px; height: 45px; border-radius: 25px;'><i class='bx bx-arrow-to-bottom'></i>Download Record</button></a>";

              echo "</div>";

                echo "<table id='title-table' border='1'>
                      <tbody>";
                echo "<tr><td width='500px'><label><b>Item Name </b></label></td>";
                echo "<td width='150px'><label>".$row['itemName']."</label></td>";
                echo "<td width='500px'><label><b>Item Brand Name</b></label></td>";
                echo "<td width='150px'><label>".$row['itemGen']."</label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['fname']."' disable></input>";

                echo "<tr><td width='500px'><label><b>Item No. </b></label></td>";
                echo "<td width='150px'><label>".$row['itemNo']."</label></td>";
                echo "<td width='500px'><label><b>Item Expiration Date </b></label></td>";
                echo "<td width='150px'><label>".$row['itemExp']."</label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['mname']."' disable></input>";

                $diff = $row['itemQty'] - $row['itemNum'];
                echo "<tr><td width='500px'><label><b>Total Items Distributed </b></label></td>";
                echo "<td width='150px'><label>".$diff."</label></td>";
                echo "<td width='500px'><label><b>Total Items Available</b></label></td>";
                echo "<td width='150px'><label>".$row['itemNum']."</label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['lname']."' disable></input><br>";

                
                echo "<tr><td width='500px'><label><b>Item Unit</b></label></td>";
                echo "<td width='150px'><label>".$row['itemUnit']."</label></td>";
                echo "<td width='500px'><label><b>Recently Update By</b></label></td>";
                echo "<td width='150px'><label>".$row['updatedBy']."</label></td></tr>";
                //echo "<input type='text' placeholder='&emsp;".$row['guardian']."' disable></input><br>";
                echo "</tbody></table>";

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
      </div>

      <!-- <div>
            <button id="confirmBtn" onclick="javascript:history.go(-1)">Back</button>
      </div> -->
      <div id="list-side">
        <div id="table-div" style="position: relative;">
          <table id="inventory-pres-list" style="font-size: 90%;height: auto; overflow-y: auto !important; border-radius: 5px 5px 0 0; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
          <thead>
              <tr>
                  <th>Name</th>
                  <th width="50px">Age</th>
                  <th>Prescription</th>
                  <th width="50px">Quantity</th>
                  <th>Address</th>
                  <th>Notes</th>
                  <th>Guardian</th>
                  <th>Cellphone</th>
                  <th>Issued On</th>
                  <th>Issued By</th>
              </tr>
          </thead>
          <tbody>
          
        </br></br></br></br></br></br></br>
          <!--search bar section-->
<center><h1>Registered Participants</h1></center>
<div id="fPanel" style="position: relative; display: inline-block;">
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
      </div></br></br>

<?php 
    if (isset($_GET['inventoryId'])){

      $inventoryId = $_GET['inventoryId'];

      if (isset($_REQUEST['searchTxt'])){
        $searchTxt = stripslashes($_REQUEST['searchTxt']);
        $searchTxt = mysqli_real_escape_string($db,$searchTxt); 

        $pres_list_query = mysqli_query($db, "SELECT * FROM prescriptions WHERE presMedId = '$inventoryId' AND presName LIKE ('%".$searchTxt."%')") or die(mysqli_error($db));
                while($pres_list = mysqli_fetch_array($pres_list_query)){
                echo "</tr>";
                echo "<td width='200px'>" . $pres_list['presName'] . "</td>";
                echo "<td width='50px'>" . $pres_list['presAge'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presMed'] . "</td>";
                echo "<td width='50px' style='text-align: center;'>" . $pres_list['presQty'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presAddress'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNote'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presGuardian'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNum'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presDate'] . "</td>";
                echo "<td width='120px'>" . $pres_list['createdBy'] . "</td>";
                echo "</tr>";
                
              }
              echo "</tbody>";
              echo "</table>";
              echo "</div>"; 

}//search isset

else if (isset($_REQUEST['sortBtn'])){
  $pres_list_query = mysqli_query($db, "SELECT * FROM prescriptions WHERE presMedId = '$inventoryId'") or die(mysqli_error($db));
                while($pres_list = mysqli_fetch_array($pres_list_query)){
                echo "</tr>";
                echo "<td width='200px'>" . $pres_list['presName'] . "</td>";
                echo "<td width='50px'>" . $pres_list['presAge'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presMed'] . "</td>";
                echo "<td width='50px' style='text-align: center;'>" . $pres_list['presQty'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presAddress'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNote'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presGuardian'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNum'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presDate'] . "</td>";
                echo "<td width='120px'>" . $pres_list['createdBy'] . "</td>";
                echo "</tr>";
                
              }
              echo "</tbody>";
              echo "</table>";
              echo "</div>"; 

}//isset btn

else if (isset($_REQUEST['sortBtnOpt'])){
  $pres_list_query = mysqli_query($db, "SELECT * FROM prescriptions WHERE presAddress LIKE ('%".$_REQUEST['sortBtnOpt']."%')") or die(mysqli_error($db));
                while($pres_list = mysqli_fetch_array($pres_list_query)){
                echo "</tr>";
                echo "<td width='200px'>" . $pres_list['presName'] . "</td>";
                echo "<td width='50px'>" . $pres_list['presAge'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presMed'] . "</td>";
                echo "<td width='50px' style='text-align: center;'>" . $pres_list['presQty'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presAddress'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNote'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presGuardian'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNum'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presDate'] . "</td>";
                echo "<td width='120px'>" . $pres_list['createdBy'] . "</td>";
                echo "</tr>";
                
              }
              echo "</tbody>";
              echo "</table>";
              echo "</div>"; 

}//isset btn opt

else {
      $pres_list_query = mysqli_query($db, "SELECT * FROM prescriptions WHERE presMedId = '$inventoryId'") or die(mysqli_error($db));
                while($pres_list = mysqli_fetch_array($pres_list_query)){
                echo "</tr>";
                echo "<td width='200px'>" . $pres_list['presName'] . "</td>";
                echo "<td width='50px'>" . $pres_list['presAge'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presMed'] . "</td>";
                echo "<td width='50px' style='text-align: center;'>" . $pres_list['presQty'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presAddress'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNote'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presGuardian'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presNum'] . "</td>";
                echo "<td width='120px'>" . $pres_list['presDate'] . "</td>";
                echo "<td width='120px'>" . $pres_list['createdBy'] . "</td>";
                echo "</tr>";
                
              }
              echo "</tbody>";
              echo "</table>";
              echo "</div>"; 
            }
    }//isset
?>

<div>
            <button id="confirmBtn" onclick="javascript:history.go(-1)">Back</button>
        </div>
        
      </div> <!--list div-->
      <br><br>

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