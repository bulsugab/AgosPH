<?php
include('auth.php');
require('config.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/inventory.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
       .preslistBtn{
          background-color: #085e72;
          border: none;
          outline: none;
          padding: 5px 15px;
          text-align: center;
          color: #fff;
          border-radius: 15px;
       }

       .preslistBtn1{
          background-color: #085e72;
          border: none;
          outline: none;
          padding: 5px 15px;
          text-align: center;
          color: #fff;
          border-radius: 15px;
       }
       table tbody tr td{
        width: auto;
       }
       table tbody tr{
        border-bottom: 1px #c0c0c0 solid;

       }
       table tbody tr td:last-of-type{
        width: 200px;
        align-content: right;
       }

       .issuebtn {
          background-color: #04AA6D;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
        }

        .dropdown {
          position: relative;
          display: inline-block;
        }

        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .dropdown-content a:hover {background-color: #ddd;}

        .dropdown-issue:hover .dropdown-content {display: block;}

        .dropdown-issue:hover .issuebtn {background-color: #3e8e41;}


        .dropbtn-issue {
          background-color: #3498DB;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }

        .dropbtn-issue:hover, .dropbtn-issue:focus {
          background-color: #2980B9;
        }

        .dropdown-issue {
          position: relative;
          display: inline-block;
        }

        .dropdown-content-issue {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          margin-top: -10px;
          margin-left: 30px;
          overflow: auto;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-content-issue a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .dropdown-issue a:hover {background-color: #ddd;}

        .show {display: block;}

        .invform-btn{
            height: 45px;
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
       .invform-btn{
        border: none;
        font-size: 90%;
       }
       #cancel{
        background-color: dimgray;
        color: #fff;
       }
       #closeFormBtn{
        color: gray;
        padding-bottom: 25px;
       }
       table button{
        width: 100px;
        height: 30px;
       }

     </style>
   </head>
<body style="background-color:#f5f5f5;">
  <div id="blurer" style="visibility:hidden; background-color: black;">
  </div>
  

  <section class="home-section" id="top">
    <nav style="background-color: #085e72; color: #fff;">

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
      <div id="head-side">
          <div id="banner">
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
          </div>
          <div class="overview-boxes">
              <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
                <div class="right-side">
                  <div class="box-topic">Out of Stocks</div>
<?php $result = mysqli_query($db,"SELECT * FROM items WHERE itemNum = '0'");
          echo  "<div class='result'><h1> ".mysqli_num_rows($result)." </h1></div>"; ?>
                </div>
                <img src="img/outofstock.png" class="imgIcon">
              </div>
              <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
                <div class="right-side">
                   <div class="box-topic">Low Stocks</div>
<?php $result = mysqli_query($db,"SELECT * FROM items WHERE itemNum < '11' AND itemNum > '0'");          
          echo  "<div class='result'><h1> ".mysqli_num_rows($result)."</h1> </div>"; ?>
                  </div>
               <img src="img/lowstock.png" class="imgIcon">
              </div>
              <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
                <div class="right-side">
                  <div class="box-topic">In Stocks</div>
<?php $result = mysqli_query($db,"SELECT * FROM items WHERE itemNum > '10'");         
          echo  "<div class='result'><h1> ".mysqli_num_rows($result)." </h1></div>";?>
                  </div>
                <img src="img/box.png" class="imgIcon">
              </div>
        

          </div> <!-- end -->
          <br>
<!-- Changes starts here -->
          <div style="position: relative; width: 100%; background-color:transparent; align-content: left;">
            <a href="#top" style="text-decoration: none;">
            <button type="button" onclick="itemForm()" style="position: relative; display: inline-block; width: 150px; font-size: 100%; height: 45px; padding: 7px; border-radius: 7px; text-decoration: none; margin-left: -150px; margin-right: auto;">+ Stock</button>
          </a>
          <div class="dropdown-issue" style="">
            <button onclick="drpIssue()" class="dropbtn-issue" style="position: relative; display: inline-block; width: 150px; font-size: 100%; height: 45px; padding: 7px; margin-left: 10px; border-radius: 7px; text-decoration: none;">Issue&nbsp;<i class="fa fa-angle-down"></i></button>
            <div id="drpdown-issue" class="dropdown-content-issue" style="margin-left: 10px;" >
              <a href="#" onclick="presForm1()">Senior</a>
              <a href="#" onclick="presForm2()">Child</a>
              <a href="#" onclick="presForm3()">Infant</a>
              <a href="#" onclick="presFormOthers()">Other</a>
            </div>
          </div>
          
          <div style="position: relative; display: inline-block; margin-left: 0px;">
            <form method="post" action="">
            <span>&emsp;Sort by: &emsp;</span>
            <input type="submit" class="sortBtn" id="All" name="category" value="All">
            <input type="submit" class="sortBtn" id="Seniors" name="category" value="Seniors">
            <input type="submit" class="sortBtn" id="Children" name="category" value="Children">
            <input type="submit" class="sortBtn" id="Infants" name="category" value="Infants">
            <input type="submit" class="sortBtn" id="Out" name="category" value="Out">
            <input type="submit" class="sortBtn" id="Low" name="category" value="Low">
            </form>
          </div>

          <div class="search-container">
            <form action="" method = "get">
             <input type="text" placeholder="Search Item Name" name="searchTxt" id="searchTxt">
            <button type="submit" id="searchBtn" style="background: #ddd; color:#085e72"><i class="bx bx-search"></i></button>
            </form>
          </div>
        </div>
      </div>
      <!-- Changes Ends Here! -->

      <div id="list-side">
        <div id="table-div" style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); max-height: 800px;width: 95%; margin-right: auto; margin-left: auto;">
          <table id="inventory-list" style="border:none; font-size: 90%; width:100%; text-align: center;">
          <thead style="text-align: center;">
              <tr>
                  <th style="text-align: center;">For</th>
                  <th style="text-align: center;">Item No.</th>
                  <th style="text-align: center;">Item Name</th>
                  <th style="text-align: center;">Item Brand Name</th>
                  <th style="text-align: center;">Stocks Available</th>
                  <th style="text-align: center;">Expiration Date</th>
                  <th style="text-align: center;">Action</th>
                  <!-- <th>View or Add Participants</th> -->
              </tr>
          </thead>
          <tbody>
<?php
  if (isset($_REQUEST['category'])){
  $sortingCat = $_REQUEST['category'];

  if ($sortingCat=='All'){
    $query = "SELECT * FROM items";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)){ ?>

      <script>
        document.getElementById("All").style.backgroundColor="#085e72";
        document.getElementById("All").style.color="#fff";

        document.getElementById("Seniors").style.backgroundColor="#fff";
        document.getElementById("Seniors").style.color="dimgray";

        document.getElementById("Children").style.backgroundColor="#fff";
        document.getElementById("Children").style.color="dimgray";

        document.getElementById("Infants").style.backgroundColor="#fff";
        document.getElementById("Infants").style.color="dimgray";

        document.getElementById("Out").style.backgroundColor="#fff";
        document.getElementById("Out").style.color="dimgray";

        document.getElementById("Low").style.backgroundColor="#fff";
        document.getElementById("Low").style.color="dimgray";
    </script>


      <?php
      // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
    }
      echo "</table>";
      echo "</div>";
}

else if ($sortingCat=='Seniors'){
    $query = "SELECT * FROM items WHERE itemFor='$sortingCat'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)){?>

      <script>
        document.getElementById("Seniors").style.backgroundColor="#085e72";
        document.getElementById("Seniors").style.color="#fff";

        document.getElementById("All").style.backgroundColor="#fff";
        document.getElementById("All").style.color="dimgray";

        document.getElementById("Children").style.backgroundColor="#fff";
        document.getElementById("Children").style.color="dimgray";

        document.getElementById("Infants").style.backgroundColor="#fff";
        document.getElementById("Infants").style.color="dimgray";

        document.getElementById("Out").style.backgroundColor="#fff";
        document.getElementById("Out").style.color="dimgray";

        document.getElementById("Low").style.backgroundColor="#fff";
        document.getElementById("Low").style.color="dimgray";
    </script>


      <?php
      // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
          }
      echo "</table>";
      echo "</div>";
  
}

else if ($sortingCat=='Children'){
    $query = "SELECT * FROM items WHERE itemFor='$sortingCat'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)){ ?>

      <script>
        document.getElementById("Children").style.backgroundColor="#085e72";
        document.getElementById("Children").style.color="#fff";

        document.getElementById("All").style.backgroundColor="#fff";
        document.getElementById("All").style.color="dimgray";

        document.getElementById("Seniors").style.backgroundColor="#fff";
        document.getElementById("Seniors").style.color="dimgray";

        document.getElementById("Infants").style.backgroundColor="#fff";
        document.getElementById("Infants").style.color="dimgray";

        document.getElementById("Out").style.backgroundColor="#fff";
        document.getElementById("Out").style.color="dimgray";

        document.getElementById("Low").style.backgroundColor="#fff";
        document.getElementById("Low").style.color="dimgray";
    </script>


      <?php
      // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
          }
      echo "</table>";
      echo "</div>";
}

else if ($sortingCat=='Infants'){
    $query = "SELECT * FROM items WHERE itemFor='$sortingCat'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

      while($row = mysqli_fetch_array($result)){ ?>

      <script>
        document.getElementById("Infants").style.backgroundColor="#085e72";
        document.getElementById("Infants").style.color="#fff";

        document.getElementById("All").style.backgroundColor="#fff";
        document.getElementById("All").style.color="dimgray";

        document.getElementById("Seniors").style.backgroundColor="#fff";
        document.getElementById("Seniors").style.color="dimgray";

        document.getElementById("Children").style.backgroundColor="#fff";
        document.getElementById("Children").style.color="dimgray";

        document.getElementById("Out").style.backgroundColor="#fff";
        document.getElementById("Out").style.color="dimgray";

        document.getElementById("Low").style.backgroundColor="#fff";
        document.getElementById("Low").style.color="dimgray";
    </script>


      <?php
        // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
          }
      echo "</table>";
      echo "</div>";
}

else if ($sortingCat=='Out'){
    $query = "SELECT * FROM items WHERE itemNum='0'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

      while($row = mysqli_fetch_array($result)){ ?>

      <script>
        document.getElementById("Out").style.backgroundColor="#085e72";
        document.getElementById("Out").style.color="#fff";

        document.getElementById("All").style.backgroundColor="#fff";
        document.getElementById("All").style.color="dimgray";

        document.getElementById("Seniors").style.backgroundColor="#fff";
        document.getElementById("Seniors").style.color="dimgray";

        document.getElementById("Children").style.backgroundColor="#fff";
        document.getElementById("Children").style.color="dimgray";

        document.getElementById("Infants").style.backgroundColor="#fff";
        document.getElementById("Infants").style.color="dimgray";

        document.getElementById("Low").style.backgroundColor="#fff";
        document.getElementById("Low").style.color="dimgray";
    </script>


      <?php
        // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
          }
      echo "</table>";
      echo "</div>";
}

else if ($sortingCat=='Low'){
    $query = "SELECT * FROM items WHERE itemNum < '11' AND itemNum > '0'";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

      while($row = mysqli_fetch_array($result)){ ?>

      <script>
        document.getElementById("Low").style.backgroundColor="#085e72";
        document.getElementById("Low").style.color="#fff";

        document.getElementById("All").style.backgroundColor="#fff";
        document.getElementById("All").style.color="dimgray";

        document.getElementById("Seniors").style.backgroundColor="#fff";
        document.getElementById("Seniors").style.color="dimgray";

        document.getElementById("Children").style.backgroundColor="#fff";
        document.getElementById("Children").style.color="dimgray";

        document.getElementById("Infants").style.backgroundColor="#fff";
        document.getElementById("Infants").style.color="dimgray";

        document.getElementById("Out").style.backgroundColor="#fff";
        document.getElementById("Out").style.color="dimgray";
    </script>


      <?php
        // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
          }
      echo "</table>";
      echo "</div>";
}
}
  
else if (isset($_REQUEST['searchTxt'])){
  
    $searchTxt = stripslashes($_REQUEST['searchTxt']);
    $searchTxt = mysqli_real_escape_string($db,$searchTxt); 

    $query = "SELECT * FROM items WHERE itemName LIKE ('%".$searchTxt."%')";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

        while($row = mysqli_fetch_array($result)){
          // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
          }
      echo "</table>"; 
      echo "</div>";
}
    
else {
        $result = mysqli_query($db,"SELECT * FROM items ORDER BY itemQty ASC");
   while($row = mysqli_fetch_array($result)) {
    // $id = $row['itemId'];
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td style='width: 50px;'>" . $row['itemFor'] . "</td>";
            echo "<td style='width: 70px;'>" . $row['itemNo'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemName'] . "</td>";
            echo "<td style='width: 100px;'>" . $row['itemGen'] . "</td>";
            echo "<td style='text-align: center; width: 50px;'>".$row['itemNum']." (".$row['itemUnit'].")</td>";
            echo "<td style='text-align: center; width: 50px;'>" . $row['itemExp'] . "</td>";
            echo "<td style='width: 200px;'><a href='#'><button type='button' class='preslistBtn' onclick='popUpForm(); setUpForm(this.id);' id='".$row['itemId']."'>Restock</button></a>&emsp;<a href='inventory_list.php?inventoryId=".$row['itemId']."'><button class='preslistBtn1'>View</button></a></td>";
            echo "</tr>";
          }
      echo "</table>";
      echo "</div>";

}
 
?> 
          </tbody>
      </table>
        </div>

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
  <div id="form-container" style="visibility: hidden; background-color: #f5f5f5; box-shadow: none; height: fit-content !important; top: -50px; border-radius: 4px; padding-top: 8px; padding-right: 15px;">
      <form id="serv-form" method="post" action="inventory_add.php">
          <button type="button" id="closeFormBtn" onclick = "closeItem()" style="color: gray; float: right;">x</button><br><br>
          <h2 style="padding-top: 15px;">Add Item</h2><hr><br>
          <input type="text" class="form-text" name="invt_no" placeholder="Item No: " required><br>
          <input type="text" class="form-text" name="invt_name" placeholder="Medicine Name: " required><br>
          <input type="text" class="form-text" name="invt_gen" placeholder="Medicine Brand Name: " required><br>
          <!-- <input type="text" class="form-text" name="invt_desc" placeholder="Medicine Description: " required><br>
            <label for="unit">&emsp;Unit:&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <input type="number" name="unit" placeholder="Quantity" class="form-text" min="0"required style="width: 65%"> -->
          <span>Quantity:</span>
          <input type="number" class="form-text" name="invt_qty" placeholder="0" min="0"required style="width: 100px; right: 0px;">
          <input type="text"  class="form-text" name="invt_unit" placeholder="Unit ex. 5g/tab" style="width:43%;" required><br>
          
              <span>Available for:&emsp;&emsp;</span>
                <select name="invt_for" id="invt_for" required style="height: 35px; width: 200px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">-------For-------</option>
                <!--<option value="all">All</option>-->
                <option value="Seniors">Seniors</option>
                 <option value="Children">Children</option>
                  <option value="Infants">Infants</option>
                  <option value="Other">Other</option>
                </select><br>


              <label for="invt_rcv">Date Received: &nbsp;&nbsp;</label>
              <input type="date" class="form-date" id="invt_rcv" name="invt_rcv" required style="height: 35px; width: 200px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;"><br>

              <label for="invt_exp">Expiration Date:&nbsp;&nbsp;</label>
              <input type="date" class="form-date" id="invt_exp" name="invt_exp" required style="height: 35px; width: 200px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;"><br>

          <input type="submit" name="submit" class="invform-btn" id="confirm" value="Confirm" onclick="return confirm('Are you sure you want to proceed?');"> 
          <button type="button" class="invform-btn"onclick="closeItem()" id="cancel" class="form-btn">Cancel</button> 
        </form>
    </div>

    <div id="form-container-prescribe-senior" style="visibility: hidden; background-color: #f5f5f5; box-shadow: none;  border-radius: 4px; padding-top: 8px; padding-right: 15px;">
      <form id="serv-form" method="post" action="inventory_pres_add.php">
          <button type="button" id="closeFormBtn" onclick = "closePres1()">x</button><br><br>
          <h3>Issue to Senior: </h3><hr><br>
          <span>&emsp;Patient: &emsp;</span>
                <select name='pat_name' id='pat_name' required style='height: 35px; width: 250px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid; margin-bottom: 5px;'>
                  <option value='' selected disabled>Select Recepient:</option>";
              <?php
                      $res_query = "SELECT * FROM residents WHERE age > '59'";
                      $res_result = mysqli_query($db, $res_query);
                      while ($res = mysqli_fetch_array($res_result)){
                        echo  "<option value='".$res['idRecord']."'>".$res['fname']." ".$res['mname']." ".$res['lname']."</option>"; } ?>
                 </select>

        <span >&emsp;&nbsp;&nbsp;&nbsp;Medicine:&nbsp;</span>
        <select name='pat_med' id='pat_med' required style='height: 35px; width: 250px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid; margin-bottom: 5px; margin-left: 3px;'>
        <option value='' selected disabled>--------Medicine--------</option>";
      <?php
        $item_query = "SELECT * FROM items WHERE itemFor = 'Seniors'";
        $item_result = mysqli_query($db, $item_query);
        while ($item = mysqli_fetch_array($item_result)){
          if ($item['itemNum'] > '0'){
              echo "<option value='".$item['itemId']."'>".$item['itemName']."</option>";
          } 
              $max = $item['itemNum']; 

        } ?>
         
      </select><br>      
    <span>&emsp;Quantity:&nbsp;</span>
        <input type='number' class='form-text' name='pat_qty' placeholder='0' min='0' required style='width: 250px;' max=<?php echo $max; ?>><br>
        <input type='text' class='form-text' name='pat_note' placeholder='Diagnosis/Notes: ' required><br>

        <input type='submit' name='submit' class='invform-btn' id='confirm' value='Confirm' onclick="return confirm('Are you sure you want to proceed?');"> 
          <button type='button' onclick='closePres1()' id='cancel' class='invform-btn'>Cancel</button> 
        </form>
    </div> <!-- Here -->

    <div id="form-container-prescribe-child" style="visibility: hidden; background-color: #f5f5f5; box-shadow: none; ">
      <form id="serv-form" method="post" action="inventory_pres_add.php">
          <button type="button" id="closeFormBtn" onclick = "closePres2()">x</button><br><br>
          <h3>Issue to Children: </h3><hr><br>
          <span>&emsp;Patient: &emsp;</span>
                <select name='pat_name' id='pat_name' required style='height: 35px; width: 250px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;'>
                  <option value='' selected disabled>Select Recepient:</option>";
              <?php
                      $res_query = "SELECT * FROM residents WHERE age > '0' AND age < '8'";
                      $res_result = mysqli_query($db, $res_query);
                      while ($res = mysqli_fetch_array($res_result)){
                           echo "<option value='".$res['idRecord']."'>".$res['fname']." ".$res['mname']." ".$res['lname']."</option>"; } ?>
                </select><br>

        <span >&emsp;Medicine:&nbsp;</span>
        <select name='pat_med' id='pat_med' required style='height: 35px; width: 250px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;'>
        <option value='' selected disabled>--Medicine--</option>";
      <?php
        $item_query = "SELECT * FROM items WHERE itemFor = 'Children'";
        $item_result = mysqli_query($db, $item_query);
        while ($item = mysqli_fetch_array($item_result)){
          if ($item['itemNum'] > '0'){
              echo "<option value='".$item['itemId']."'>".$item['itemName']."</option>";
          } 
              $max = $item['itemNum'];
        } ?>
         
      </select><br>      
    <span>&emsp;Quantity:&nbsp;</span>
        <input type='number' class='form-text' name='pat_qty' placeholder='0' min='0' required style='width: 250px;' max=<?php echo $max; ?>><br>
        <input type='text' class='form-text' name='pat_note' placeholder='Diagnosis/Notes: ' required><br>

        <input type='submit' name='submit' class='invform-btn' id='confirm' value='Confirm'  onclick="return confirm('Are you sure you want to proceed?');"> 
          <button type='button' onclick='closePres2()' id='cancel' class='invform-btn'>Cancel</button> 
        </form>
    </div> <!-- Here Child -->

    <div id="form-container-prescribe-infant" style="visibility: hidden; background-color: #f5f5f5; box-shadow: none; ">
      <form id="serv-form" method="post" action="inventory_pres_add.php">
          <button type="button" id="closeFormBtn" onclick = "closePres3()">x</button><br><br>
          <h3>Issue to Infant: </h3><hr><br>
          <span>&emsp;Patient: &emsp;</span>
                <select name='pat_name' id='pat_name' required style='height: 35px; width: 250px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;'>
                  <option value='' selected disabled>Select Recepient:</option>";
              <?php
                      $res_query = "SELECT * FROM residents WHERE age < '1'";
                      $res_result = mysqli_query($db, $res_query);
                      while ($res = mysqli_fetch_array($res_result)){
                        echo "<option value='".$res['idRecord']."'>".$res['fname']." ".$res['mname']." ".$res['lname']."</option>"; } ?>
                </select>

        <span >&emsp;Medicine:&nbsp;</span>
        <select name='pat_med' id='pat_med' required style='height: 35px; width: 250px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;'>
        <option value='' selected disabled>--Medicine--</option>";
      <?php
        $item_query = "SELECT * FROM items WHERE itemFor = 'Infants'";
        $item_result = mysqli_query($db, $item_query);
        while ($item = mysqli_fetch_array($item_result)){
          if ($item['itemNum'] > '0'){
              echo "<option value='".$item['itemId']."'>".$item['itemName']."</option>";
          }
              $max = $item['itemNum']; 
        } ?>
         
      </select><br>      
    <span>&emsp;Quantity:&nbsp;</span>
        <input type='number' class='form-text' name='pat_qty' placeholder='0' min='0' required style='width: 250px;' max=<?php echo $max; ?>><br>
        <input type='text' class='form-text' name='pat_note' placeholder='Diagnosis/Notes: ' required><br>

        <input type='submit' name='submit' class='invform-btn' id='confirm' value='Confirm'  onclick="return confirm('Are you sure you want to proceed?');"> 
          <button type='button' onclick='closePres3()' id='cancel' class='invform-btn'>Cancel</button> 
        </form>
    </div>

    <div id="form-container-prescribe-other" style="position: absolute; top: 10%; padding: 20px; width: 35%; z-index:999; background-color:#f5f5f5; padding: 30px; border-radius:10px; margin-left: 35%; margin-right: 25%; visibility:hidden; text-align: center;">
        <p><i>Feature not available at this time.</i>&nbsp;<br><br>
        <button type='button' onclick='closePres4()' id='cancel' class='invform-btn' style="background-color: #e0e0e0; color: #000; width: 20%; font-size: 90%; height: 45px; margin-left: auto; margin-right: auto;">Close</button> </p> 
    </div>

  <div id="popUp" style="visibility:hidden; border-radius:4px; width: auto; height:fit-content;">
      
    <form method='post' action='restock.php'>
      <button style="padding: 5px 10px; float: right; background-color: transparent; border: none; color: gray; font-weight: 600;" onclick="closeOk()">x</button><br><br>
      <h2>Restock</h2><hr><br>
      <span style="font-size: 110%;"><b>&emsp;Med Name Here</b></span><br>
      <span>&emsp;Quantity: &emsp;</span><input type='number' class='form-text' name='res_qty'  placeholder='0' min='0' required style="width: 64%;" id='tr1'>
      <input type="text" id="itemId" name="itemId" style="display: none;" value="">
      <div style="position:relative; width:100%; background-color:transparent; margin-top: 15px; margin-bottom: 10px;">
        <input type='submit' class='popBtn' id='yesBtn' value='Restock' onclick="return confirm('Does the item has the same Name, Brand and Expiration Date?');" style="width:45%; margin-right:0px; margin-left: 10px;">
      <button class='popBtn' id='noBtn' onclick='closeOk()' style="width:45%; margin-left: 5px;">Cancel</button>

      </div>
    </form>
  </div>

  <!-- COPY FROM HERE! -->

  <div id="blurer1" style="position: absolute; display: block; top:0px; bottom: 0px; width:100%; height: auto; background-color: #000; opacity: 0.95; z-index: 981; visibility:hidden;">
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
        function itemForm(){

          window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
          window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
          window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
          window.addEventListener('keydown', preventDefaultForScrollKeys, false);
          document.getElementById("blurer").style.visibility="visible";
          document.getElementById("form-container").style.visibility="visible";
        }
        function presForm1(){
          disableScroll();
            document.getElementById("blurer").style.visibility="visible";
            document.getElementById("form-container-prescribe-senior").style.visibility="visible";
        }

        function presForm2(){
          disableScroll();
            document.getElementById("blurer").style.visibility="visible";
            document.getElementById("form-container-prescribe-child").style.visibility="visible";
        }

        function presForm3(){
          disableScroll();
            document.getElementById("blurer").style.visibility="visible";
            document.getElementById("form-container-prescribe-infant").style.visibility="visible";
        }

        function presFormOthers(){
          disableScroll();
            document.getElementById("blurer").style.visibility="visible";
            document.getElementById("form-container-prescribe-other").style.visibility="visible";
        }

        function closeItem(){
          enableScroll();
            document.getElementById("blurer").style.visibility="hidden";
            document.getElementById("form-container").style.visibility="hidden";
            document.getElementById("popUp").style.visibility="hidden";
            document.getElementById("blurer1").style.visibility="hidden";
            document.getElementById("seniorList").style.visibility="hidden";
        }
        function closeItemList(){
          enableScroll();
            document.getElementById("blurer").style.visibility="visible";
            document.getElementById("form-container").style.visibility="hidden";
            document.getElementById("popUp").style.visibility="hidden";
            document.getElementById("blurer1").style.visibility="hidden";
            document.getElementById("seniorList").style.visibility="hidden";
        }

        function closeYn(){
          enableScroll();
            document.getElementById("blurer").style.visibility="hidden";
            //document.getElementById("form-container").style.visibility="hidden";
            document.getElementById("popUp").style.visibility="hidden";
        }


        function closeOk(){
          enableScroll();
            document.getElementById("blurer").style.visibility="hidden";
            //document.getElementById("form-container").style.visibility="hidden";
            document.getElementById("popUp").style.visibility="hidden";
        }

        function showForm(){
          disableScroll();
          document.getElementById("blurer").style.visibility="visible";
          document.getElementById("popUp").style.visibility="visible";
        }

        // function YnForm(){
        //   disableScroll();
        //   document.getElementById("blurer").style.visibility="visible";
        //   document.getElementById("popUp").style.visibility="visible";
        //   var idItems = document.getElementById('invqty').name;
        //   document.getElementById("idItem").value= idItems;
        // }

        function popUpForm(){
        disableScroll();
            document.getElementById("blurer").style.visibility="visible";
            document.getElementById("popUp").style.visibility="visible";
        }

        function setUpForm(id){
        disableScroll();
        // var idItems = document.getElementById(this.id);
            document.getElementById("itemId").value = id;
            //idItems = '';
        }
        function closePres1(){

          enableScroll();
            document.getElementById("blurer").style.visibility="hidden";
            document.getElementById("form-container-prescribe-senior").style.visibility="hidden";
        }

        function closePres2(){

          enableScroll();
            document.getElementById("blurer").style.visibility="hidden";
            document.getElementById("form-container-prescribe-child").style.visibility="hidden";
        }

        function closePres3(){

          enableScroll();
            document.getElementById("blurer").style.visibility="hidden";
            document.getElementById("form-container-prescribe-infant").style.visibility="hidden";
        } 

        function closePres4(){

          enableScroll();
            document.getElementById("blurer").style.visibility="hidden";
            document.getElementById("form-container-prescribe-other").style.visibility="hidden";
        } 



        function gotoAddItem(){
          disableScroll();
            document.getElementById("popUp").style.visibility="hidden";
            document.getElementById("form-container").style.visibility="visible";
        }


        function showDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("searchInputSenior");
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchULSenior");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function filterFunctionChild() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("searchInputChildren");
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchULChildren");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function filterFunctionInfant() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("searchInputInfant");
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchULInfant");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

  function showSeniors() {
    document.getElementById("blurer1").style.visibility="visible"
    document.getElementById("seniorList").style.visibility="visible";
  }

  function showChildren(){
    document.getElementById("blurer1").style.visibility="visible"
    document.getElementById("childrenList").style.visibility="visible";
  }

  function showInfants(){
    document.getElementById("blurer1").style.visibility="visible"
    document.getElementById("infantList").style.visibility="visible";
  }

  function showOthers(){
    document.getElementById("blurer1").style.visibility="visible"
    document.getElementById("otherList").style.visibility="visible";
  }


  function closeSenior(){
    document.getElementById("blurer1").style.visibility="hidden";
    document.getElementById("seniorList").style.visibility="hidden";
  }

  function closeChildren(){
    document.getElementById("blurer1").style.visibility="hidden";
    document.getElementById("childrenList").style.visibility="hidden";
  }

  function closeInfant(){
    document.getElementById("blurer1").style.visibility="hidden";
    document.getElementById("infantList").style.visibility="hidden";
  }

  function closeOther(){
    document.getElementById("blurer1").style.visibility="hidden";
    document.getElementById("otherList").style.visibility="hidden";
  }
  
function drpIssue() {
  document.getElementById("drpdown-issue").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn-issue')) {
    var dropdowns = document.getElementsByClassName("dropdown-content-issue");
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
    function closeDialog(){
        
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
        window.removeEventListener('touchmove', preventDefault, wheelOpt);
        window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
        
        document.getElementById("blurer1").style.visibility="hidden";
        document.getElementById("confirmDialog").style.visibility="hidden";
      }


    </script>

 </body>
</html>
