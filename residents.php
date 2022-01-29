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
        z-index: 1;
      }

      .form-text{
            height: 35px;
            width: 350px;
            padding: 5px 15px;
            border: 1px #c0c0c0 solid;
            margin: 3px;
            border-radius: 5px;
            font-size: 100%;
          }
          .form-date{
            height: 35px;
            width: 175px;
            padding: 5px 15px;
            right: 10px;
            border: 1px #c0c0c0 solid;
            margin: 3px;
            border-radius: 5px;
            font-size: 100%;
          }
          .form-btn{
            margin-top: 10px;
            height: 35px;
            width: 175px;
            padding: 5px 15px;
            margin-left: 20px;
          }
          .radio-btn{
            text-align: right;
          }
          #confirm{
            background: #085e72;
            color: #fff;
            border-radius: 10px;
            border: none;
          }
          #cancel{
            background: #ddd;
            color: #000000;
            border-radius: 10px;
            border: none;
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
       .leftAlign{
        text-align: left;
        padding-left: 25px;
       }
       #sortPurok:hover{
        color: dimgray;
       }
       .form-btn{
        color: #fff;
        font-size: 90%;
       }
     </style>

   </head>
<body>
  <div id="blurer" style="position:absolute; top:0px;left: 0px; right: 0px; bottom: 0px; height:100%; width:100%; background-color: #000; opacity: 0.7; z-index: 899; visibility: hidden;">&nbsp;</div>
  <section class="home-section">
    <nav style="background-color: #085e72; color: #fff;">
      
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
   
      <div class="dropdown">
        <button onclick="showDropdown()" class="dropbtn" data-toggle="dropdown" style="width:fit-content;">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div>
    </nav>
    

    <div class="home-content"> <!--$age = date_diff(date_create($birthDate), date_create($currentDate));-->
      <div id="head-side" style="position: relative; display: block;top: -5px;">
        <div id="banner" style="background-color: transparent; float: left;position: relative; top:-100px; width: 15%; border: none;">
         <!--  <img src="img/tampok_logo.png" id="imgBanner"> -->
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
            <div class="box-topic">Seniors</div>
<!--seniors--> <?php $result = mysqli_query($db,"SELECT * FROM residents WHERE age > '59'");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
          </div>
          <img src="img/senior.png" class="imgInd">
        </div>
        <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
          <div class="right-side">
             <div class="box-topic">Children</div>
<!--children--><?php $result = mysqli_query($db,"SELECT * FROM residents WHERE age < '7' AND age >'0'");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
            </div>
          <img src="img/children.png" class="imgInd">
        </div>
        <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
          <div class="right-side">
            <div class="box-topic">Infants</div>
<!--infants--><?php $result = mysqli_query($db,"SELECT * FROM residents WHERE age < '1'");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
            </div>
          <img src="img/infant.png" class="imgInd">
        </div>
        <div class="box" style="box-shadow: none; border: 1px solid dimgray;">
          <div class="right-side">
            <div class="box-topic">Total</div>
<!--total--><?php $result = mysqli_query($db,"SELECT * FROM residents WHERE fname <>''");
                  echo "<div class='number'>".mysqli_num_rows($result)."</div>"; ?>
          </div>
          <img src="img/population.png" class="imgInd">
        </div>
      </div>
 <!-- CHANGES STARTS HERE! -->

      <div style="position: relative; width:100%; height: 45px; background-color: transparent; align-content: left; margin-bottom: 15px; margin-top:40px !important; display: inline-block;">
        <div class="dropdownReg" style="background-color: transparent; margin: 0px; height: 30px; display: inline-block; float: left;">
        <button onclick="myFunctionReg()" class="dropbtnReg" style="position: relative; display: inline-block; width: 200px; font-size: 100%; height: 45px; padding: 7px; bottom: 0px; border-radius: 7px; margin-left: 30px; margin-right:auto;">+ Register</button>
          <div id="myDropdownReg" class="dropdown-contentReg" style="width: 200px; z-index:99; margin-left:30px ; margin-top: -10px;">
                <a href="#" onclick="showAddSenior()">Senior</a>
                <a href="#" onclick="showAddChild()">Child</a>
                <a href="#" onclick="showAddInfant()">Infant</a>
                <a href="#" onclick="showAddOthers()">Others</a>
        </div>
      </div>
       <div id="filterPanel" style="background-color: transparent; display: inline-block; margin-top: 0.5%;">
           <form method="post" action="">
            <span>Sort by: &emsp;</span>
            <input type="submit" class="sortBtn" id="All" name="category" value="All">
            <input type="submit" class="sortBtn" id="Seniors" name="category" value="Seniors">
            <input type="submit" class="sortBtn" id="Children" name="category" value="Children">
            <input type="submit" class="sortBtn" id="Infants" name="category" value="Infants">
            <!-- <form method="post" action="" style="display: inline;"> -->
            <select class="sortBtn" id="sortPurok" name="sortPurok" value="Purok" onchange="this.form.submit();"style="background-color: transparent;">
            <option class="sortOpt" id="sortPuroks" value="">Purok</option>
            <option class="sortOpt" id="sortPurok1" value="Purok 1">Purok 1</option>
            <option class="sortOpt" id="sortPurok2" value="Purok 2">Purok 2</option>
            <option class="sortOpt" id="sortPurok3" value="Purok 3">Purok 3</option>
            <option class="sortOpt" id="sortPurok4" value="Purok 4">Purok 4</option>
            <option class="sortOpt" id="sortPurok5" value="Purok 5">Purok 5</option>
            <option class="sortOpt" id="sortPurok6" value="Purok 6">Purok 6</option> </select>
            <input type="button" class="sortBtn" id="Others" name="category" value="Others">
          </form>
        </div>

      <div class="search-container" style="display: inline-block; margin-top: 0.5%;">
            <form action="" method = "post">
               <input type="text" placeholder="Search Resident Name" name="searchTxt" id="searchTxt" autocomplete="off">
              <button type="submit" id="searchBtn" style="background: #ddd; color:#085e72"><i class="bx bx-search"></i></button>
            </form>
          </div>
</div>
      <!-- CHANGES ENDS HERE! -->


        <div id="list-side">
        <div id="table-div" style="position: relative; background-color: transparent; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); max-height: 800px;">
          <table id="residents-list" style="font-size: 90%; overflow-y: auto !important; border-radius: 5px 5px 0 0; text-align: center;">
          <thead style=" z-index:500 !important;">
              <tr>
                  <th>Resident Name</th>
                  <th>Category</th>
                  <th>Address</th>
                  <th>Age</th>
                  <th>Gender</th>
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
            echo "<td width='200px' class='leftAlign'>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>";
            if ($row['age'] > '59'){ echo "<td width='120px'>Senior</td>"; }
            else if ($row['age'] > '0' && $row['age'] < '8'){ echo "<td width='50px'>Children</td>"; }
            else if ($row['age'] < '1'){ echo "<td width='50px'>Infant</td>"; }
            else { echo "<td width='50px'>Others</td>"; }
            echo "<td width='120px'>" . $row['address'] . "</td>";
            if ($row['age']=='0'){
              $bday = new DateTime($row['bdate']); // Your date of birth
              $today = new Datetime(date('y-m-d'));
              $diff = $today->diff($bday);
              echo "<td width='50px'>" .$diff->format('%m'). " m/o</td>";
            }
            else {
            echo "<td width='50px'>" . $row['age'] . "</td>";
            }
            echo "<td width='50px'>" . $row['gender'] . "</td>";
            echo "<td width='100px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn' >View Profile</button></a></td>";
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
            echo "<td width='200px' class='leftAlign'>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>";
            if ($row['age'] > '59'){ echo "<td width='50px'>Senior</td>"; }
            else if ($row['age'] > '0' && $row['age'] < '8'){ echo "<td width='50px'>Children</td>"; }
            else if ($row['age'] < '1'){ echo "<td width='50px'>Infant</td>"; }
            else { echo "<td width='50px'>Others</td>"; }
            echo "<td width='120px'>" . $row['address'] . "</td>";
            echo "<td width='50px'>" . $row['age'] . "</td>";
            echo "<td width='50px'>" . $row['gender'] . "</td>";
            echo "<td width='100px'>" . $row['contactNum'] . "</td>";
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
            echo "<td width='200px' class='leftAlign'>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>";
            if ($row['age'] > '59'){ echo "<td width='50px'>Senior</td>"; }
            else if ($row['age'] > '0' && $row['age'] < '8'){ echo "<td width='50px'>Children</td>"; }
            else if ($row['age'] < '1'){ echo "<td width='50px'>Infant</td>"; }
            else { echo "<td width='50px'>Others</td>"; }
            echo "<td width='120px'>" . $row['address'] . "</td>";
            echo "<td width='50px'>" . $row['age'] . "</td>";
            echo "<td width='50px'>" . $row['gender'] . "</td>";
            echo "<td width='100px'>" . $row['contactNum'] . "</td>";
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
            echo "<td width='200px' class='leftAlign'>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>";
            if ($row['age'] > '59'){ echo "<td width='50px'>Senior</td>"; }
            else if ($row['age'] > '0' && $row['age'] < '8'){ echo "<td width='50px'>Children</td>"; }
            else if ($row['age'] < '1'){ echo "<td width='50px'>Infant</td>"; }
            else { echo "<td width='50px'>Others</td>"; }
            echo "<td width='120px'>" . $row['address'] . "</td>";
            if ($row['age']=='0'){
              $bday = new DateTime($row['bdate']); // Your date of birth
              $today = new Datetime(date('y-m-d'));
              $diff = $today->diff($bday);
              echo "<td width='50px'>" .$diff->format('%m'). " m/o</td>";
            }
            else {
            echo "<td width='50px'>" . $row['age'] . "</td>";
            }
            echo "<td width='50px'>" . $row['gender'] . "</td>";
            echo "<td width='100px'>" . $row['contactNum'] . "</td>";
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

    $query = "SELECT * FROM residents WHERE CONCAT(fname,' ',mname,' ',lname) LIKE ('%".$searchTxt."%') OR CONCAT(fname,' ',lname) LIKE ('%".$searchTxt."%')";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

            while($row = mysqli_fetch_array($result)){
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='200px' class='leftAlign'>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>";
            if ($row['age'] > '59'){ echo "<td width='50px'>Senior</td>"; }
            else if ($row['age'] > '0' && $row['age'] < '8'){ echo "<td width='50px'>Children</td>"; }
            else if ($row['age'] < '1'){ echo "<td width='50px'>Infant</td>"; }
            else { echo "<td width='50px'>Others</td>"; }
            echo "<td width='120px'>" . $row['address'] . "</td>";
            if ($row['age']=='0'){
              $bday = new DateTime($row['bdate']); // Your date of birth
              $today = new Datetime(date('y-m-d'));
              $diff = $today->diff($bday);
              echo "<td width='50px'>" .$diff->format('%m'). " m/o</td>";
            }
            else {
            echo "<td width='50px'>" . $row['age'] . "</td>";
            }
            echo "<td width='50px'>" . $row['gender'] . "</td>";
            echo "<td width='100px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
   }//while
   echo "</table>";
   echo "</div>";
  //}//if row 1
//}//if isset
}
else if (isset($_REQUEST['sortPurok'])){
  $sortPurok = stripslashes($_REQUEST['sortPurok']);
  $sortPurok = mysqli_real_escape_string($db,$sortPurok); 
  $result = mysqli_query($db,"SELECT * FROM residents WHERE address LIKE ('%".$sortPurok."%')");
  while($row = mysqli_fetch_array($result))
    {
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='200px' class='leftAlign'>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>";
            if ($row['age'] > '59'){ echo "<td width='50px'>Senior</td>"; }
            else if ($row['age'] > '0' && $row['age'] < '8'){ echo "<td width='50px'>Children</td>"; }
            else if ($row['age'] < '1'){ echo "<td width='50px'>Infant</td>"; }
            else { echo "<td width='50px'>Others</td>"; }
            echo "<td width='120px'>" . $row['address'] . "</td>";
            if ($row['age']=='0'){
              $bday = new DateTime($row['bdate']); // Your date of birth
              $today = new Datetime(date('y-m-d'));
              $diff = $today->diff($bday);
              echo "<td width='50px'>" .$diff->format('%m'). " m/o</td>";
            }
            else {
            echo "<td width='50px'>" . $row['age'] . "</td>";
            }
            echo "<td width='50px'>" . $row['gender'] . "</td>";
            echo "<td width='100px'>" . $row['contactNum'] . "</td>";
            echo "<td width='120px'><a href='resident_view.php?idRecord=".$row['idRecord']."'><button class='actionBtn'>View Profile</button></a></td>";
            echo "</tr>";
   }
   echo "</table>";
   echo "</div>";

}//isset purok
else {
  $result = mysqli_query($db,"SELECT * FROM residents");
  while($row = mysqli_fetch_array($result))
    {
            echo "</tr>";
            echo "<tr class='userlistoutput'>";
            echo "<td width='200px' class='leftAlign'>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>";
            if ($row['age'] > '59'){ echo "<td width='50px'>Senior</td>"; }
            else if ($row['age'] > '0' && $row['age'] < '8'){ echo "<td width='50px'>Children</td>"; }
            else if ($row['age'] < '1'){ echo "<td width='50px'>Infant</td>"; }
            else { echo "<td width='50px'>Others</td>"; }
            echo "<td width='120px'>" . $row['address'] . "</td>";
            if ($row['age']=='0'){
              $bday = new DateTime($row['bdate']); // Your date of birth
              $today = new Datetime(date('y-m-d'));
              $diff = $today->diff($bday);
              echo "<td width='50px'>" .$diff->format('%m'). " m/o</td>";
            }
            else {
            echo "<td width='50px'>" . $row['age'] . "</td>";
            }
            echo "<td width='50px'>" . $row['gender'] . "</td>";
            echo "<td width='100px'>" . $row['contactNum'] . "</td>";
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
  <div id="regSenior" style="position: absolute; top: 20px; padding: 20px; width: 50%; z-index:900; background-color:#f5f5f5; padding: 30px; border-radius:10px; margin-left: 25%; margin-right: 25%; visibility:hidden; padding-top: 15px; border-radius:4px;">
    <form id="" method="post" action="residents_add.php">
          <button type="button" id="closeFormBtn" onclick = "closeRegister()" style="float: right; background-color: transparent; border:none; color: gray;"><h4>x</h4></button><br><br>
          <h2 style="margin-bottom: 7px; margin-top: 5px;">Register a Senior Citizen</h2><hr><br>
          <input type="text" class="form-text" name="fname" placeholder="First Name:" required autocomplete="off" style="width: 31%;">
          <input type="text" class="form-text" name="mname" placeholder="Middle Name:" required autocomplete="off" style="width: 30%;">
          <input type="text" class="form-text" name="lname" placeholder="Last Name:" required autocomplete="off" style="width: 30%;">
          <!--<form action="">-->
                <label for="gender">&emsp;&nbsp;Gender:&emsp;</label>
                <select name="gender" id="gender" required style="height: 35px; width: 200px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">---Select Gender---</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
                </select>
              <label for="birthday">&nbsp;&nbsp;Birthday:</label>
              <input type="date" class="form-date" id="birthday" name="birthday" required style="height: 35px; width: 203px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid; margin-left: 7px;"><br>
              
              <label for="status">&nbsp;Marital Status:&emsp;</label>
                <select name="status" id="status" required style="height: 35px; width: 150px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">----Status----</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
                </select>
              <input type="text" class="form-text" name="disability" placeholder="Type of disability: (N/A if none)" required autocomplete="off" style="width: 47%;"><br>
              <input type="text" class="form-text" name="address" placeholder="Address:" required autocomplete="off" style="width: 94.5%;"><br>
              <input type="text" class="form-text" name="guardian" placeholder="Guardian:" required autocomplete=" off"style="width: 94.5%;"><br>
              <input type="text" class="form-text" name="mobile1" placeholder="Mobile Number:" required autocomplete="off"style="width: 46.5%;">
              <input type="text" class="form-text" name="mobile2" placeholder="Other Number:" required autocomplete="off"style="width: 46.5%;"><br><br>
              <div style="position: relative; background-color: transparent; width: 60%; margin-left:auto; margin-right: auto;">
                <input type="submit" name="submit" class="form-btn" id="confirm" value="Confirm" style="margin-left: 5px; width: 45%; font-size: 90%; height: 45px;" onclick="return confirm('Are you sure you want to proceed?');"> 
              <button type="button" onclick="closeRegister()" id="cancel" class="form-btn" style="background-color: dimgray; color: #fff; width: 45%; font-size: 90%; height: 45px;">Cancel</button> 
              </div>
          </form>
      </div>

      <div id="regChild" style="position: absolute; top: 20px; padding: 20px; width: 50%; z-index:900; background-color:#f5f5f5; padding: 30px; border-radius:10px; margin-left: 25%; margin-right: 25%; visibility:hidden;padding-top: 15px; border-radius:4px;">
        <form id="" method="post" action="residents_add.php">
          <button type="button" id="closeFormBtn" onclick = "closeRegister()" style="float: right; background-color: transparent; border:none; color: gray;"><h4>x</h4></button><br><br>
          <h3 style="margin-bottom: 7px; margin-top: 5px;">Register a Child</h3><hr><br>
          <input type="text" class="form-text" name="fname" placeholder="First Name:" required autocomplete="off" style="width: 31%;">
          <input type="text" class="form-text" name="mname" placeholder="Middle Name:" required autocomplete="off" style="width: 30%;">
          <input type="text" class="form-text" name="lname" placeholder="Last Name:" required autocomplete="off" style="width: 30%;">
          <!--<form action="">-->
                <label for="gender">&emsp;&nbsp;Gender:&emsp;</label>
                <select name="gender" id="gender" required style="height: 35px; width: 200px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">---Select Gender---</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
                </select>
              <label for="birthday">&nbsp;&nbsp;Birthday:</label>
              <input type="date" class="form-date" id="birthday" name="birthday" required style="height: 35px; width: 203px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid; margin-left: 7px;"><br>

              <input type="text" class="form-text" name="mother" placeholder="Mother's Name:" required autocomplete="off">
              <input type="text" class="form-text" name="motherOccupation" placeholder="Mother's Occupation:" required autocomplete="off" style="width:222px;"><br>
              <input type="text" class="form-text" name="father" placeholder="Father's Name:" required autocomplete="off">
              <input type="text" class="form-text" name="fatherOccupation" placeholder="Father's Occupation:" required autocomplete="off" style="width:222px;">
              <br>
              <input type="text" class="form-text" name="guardian" placeholder="Guardian's Name:" required autocomplete="off">
              <input type="text" class="form-text" name="disability" placeholder="Disability: (N/A if none)" required autocomplete="off" style="width:222px;">
              <br>
              <input type="text" class="form-text" name="address" placeholder="Address:" required autocomplete="off"style="width: 94.5%;"><br>
              <input type="text" class="form-text" name="mobile1" placeholder="Mobile Number:" required autocomplete="off" style="width:47%;">
              <input type="text" class="form-text" name="mobile2" placeholder="Other Number:" required autocomplete="off" style="width:46%;"><br><br>
              
              <div style="position: relative; background-color: transparent; width: 60%; margin-left:auto; margin-right: auto;">
                <input type="submit" name="submit" class="form-btn" id="confirm" value="Confirm" style="margin-left: 5px; width: 45%; font-size: 90%; height: 45px;" onclick="return confirm('Are you sure you want to proceed?');"> 
              <button type="button" onclick="closeRegister()" id="cancel" class="form-btn" style="background-color: dimgray; color: #fff; width: 45%; font-size: 90%; height: 45px;">Cancel</button>
              <input type="hidden" id="status" name="status" value="Single"> 
              </div>
          </form>
      </div>


      <div id="regInfant" style="position: absolute; top: 20px; padding: 20px; width: 50%; z-index:900; background-color:#f5f5f5; padding: 30px; border-radius:10px; margin-left: 25%; margin-right: 25%; visibility:hidden;padding-top: 15px; border-radius:4px;">
        <form id="" method="post" action="residents_add.php">
          <button type="button" id="closeFormBtn" onclick = "closeRegister()" style="float: right; background-color: transparent; border:none; color: gray;"><h4>x</h4></button><br><br>
          <h3 style="margin-bottom: 7px; margin-top: 5px;">Register an Infant</h3><hr><br>
          <input type="text" class="form-text" name="fname" placeholder="First Name:" required autocomplete="off" style="width: 31%;">
          <input type="text" class="form-text" name="mname" placeholder="Middle Name:" required autocomplete="off" style="width: 30%;">
          <input type="text" class="form-text" name="lname" placeholder="Last Name:" required autocomplete="off" style="width: 30%;">
          <!--<form action="">-->
                <label for="gender">&emsp;&nbsp;Gender:&emsp;</label>
                <select name="gender" id="gender" required style="height: 35px; width: 200px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid;">
                <option value="">---Select Gender---</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Others</option>
                </select>
              <label for="birthday">&nbsp;&nbsp;Birthday:</label>
              <input type="date" class="form-date" id="birthday" name="birthday" required style="height: 35px; width: 203px; font-size: 100%;border-radius: 5px; border: 1px lightgray solid; margin-left: 7px;"><br>

              <input type="text" class="form-text" name="mother" placeholder="Mother's Name:" required autocomplete="off">
              <input type="text" class="form-text" name="motherOccupation" placeholder="Mother's Occupation:" required autocomplete="off" style="width:222px;"><br>
              <input type="text" class="form-text" name="father" placeholder="Father's Name:" required autocomplete="off">
              <input type="text" class="form-text" name="fatherOccupation" placeholder="Father's Occupation:" required autocomplete="off" style="width:222px;">
              <br>
              <input type="text" class="form-text" name="guardian" placeholder="Guardian's Name:" required autocomplete="off">
              <input type="text" class="form-text" name="disability" placeholder="Disability: (N/A if none)" required autocomplete="off" style="width:222px;">
              <br>
              <input type="text" class="form-text" name="address" placeholder="Address:" required autocomplete="off"style="width: 94.5%;"><br>
              <input type="text" class="form-text" name="mobile1" placeholder="Mobile Number:" required autocomplete="off" style="width:47%;">
              <input type="text" class="form-text" name="mobile2" placeholder="Other Number:" required autocomplete="off" style="width:46%;"><br><br>
              
              <div style="position: relative; background-color: transparent; width: 60%; margin-left:auto; margin-right: auto;">
                <input type="submit" name="submit" class="form-btn" id="confirm" value="Confirm" style="margin-left: 5px; width: 45%; font-size: 90%; height: 45px; " onclick="return confirm('Are you sure you want to proceed?');"> 
              <button type="button" onclick="closeRegister()" id="cancel" class="form-btn" style="background-color: dimgray; color: #fff;width: 45%; font-size: 90%; height: 45px;">Cancel</button> 
              <input type="hidden" id="status" name="status" value="Single">
              </div>
          </form>
      </div>

      <div id="regOthers" style="position: absolute; top: 20px; padding: 20px; width: 35%; z-index:900; background-color:#f5f5f5; padding: 30px; border-radius:10px; margin-left: 35%; margin-right: 25%; visibility:hidden;padding-top: 15px; border-radius:4px;">
        <center><i>Feature not available at this time.</i></center> <br><br>
        <center><button type="button" onclick="closeRegister()" id="cancel" class="form-btn" style="background-color: #e0e0e0; color: #000; width: 20%; font-size: 90%; height: 45px; margin-right: auto; margin-left: auto;">Close</button></center>
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
          /*document.getElementById("form-container").style.visibility="hidden";
          document.getElementById("form-container1").style.visibility="hidden";*/
          document.getElementById("regSenior").style.visibility="hidden";
        document.getElementById("regChild").style.visibility="hidden";
        document.getElementById("regInfant").style.visibility="hidden";
        document.getElementById("regOthers").style.visibility="hidden";
      }

      function showAddSenior(){
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);

        document.getElementById("blurer").style.visibility="visible";
        document.getElementById("regSenior").style.visibility="visible";
      }

      function showAddChild(){
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);
        document.getElementById("blurer").style.visibility="visible";
        document.getElementById("regChild").style.visibility="visible";
      }

      function showAddInfant(){
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);

        document.getElementById("blurer").style.visibility="visible";
        document.getElementById("regInfant").style.visibility="visible";
      }

      function showAddOthers(){
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);
  
        document.getElementById("blurer").style.visibility="visible";
        document.getElementById("regOthers").style.visibility="visible";
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