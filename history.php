<?php
include('auth.php');
require('config.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/history.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
       #table-div{
          position: relative;
          top: 5px;
          left: 25px;
          height: auto;
          width: 96%;
          overflow-y: auto;
          max-height: 450px;
          background-color: pink;
      }
      #history-list{
        width: 100%;
        height: auto;
        padding: 15px;
      }

      #history-list th,
      #history-list td{
        padding: 12px 15px;
      }
      tbody tr {
        border-bottom: 1px solid #dddddd;
      }
      thead th {
        position: sticky;
        padding: 5px 15px;
        top: 0;
        height: 50px;
        color: #fff;
        background-color: #085e72 ;
      }
      td{
        padding: 5px 10px;
      }
      table{
        text-align: left;
        font-size: 80%;
        border-collapse: collapse;
        outline: none;
        cursor: pointer;
        table-layout: auto;
      }
      tr{
        background: #fff;
      }
      #history-list tbody tr:last-of-type {
        border-bottom: 2px solid #085e72;
      }
      #history-list tr:nth-child(even) {
        background-color: #f2f2f2;
      }
      #history-list tbody tr td:nth-child(2) {
        font-weight: bold;
      }
      #history-list tbody tr td:first-child{
        width: 120px;
      }
      .sortBtn{
        position: relative;
        display: inline-block;
        padding: 5px 15px;
        background-color: #fff;
        margin-right: 10px;
        color: dimgray;
        border: 1px solid dimgray;
        outline: none;
        border-radius: 15px;
      }

      .sortBtn:hover{
        background-color: #085e72;
        color: #fff;
        border: 1px solid #085e72;
        transition: all 0.5s ease;
      }
      .dropbtnAcc {
          background-color: #085e72;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }

        .dropbtnAcc:hover, .dropbtnAcc:focus {
          background-color: #053e4c;
        }

        .dropdownAcc {
          position: relative;
          display: inline-block;
          float: right;
        }

        .dropdown-contentAcc {
          display: none;
          position: absolute;
          float: right;
          right: 0px;
          background-color: #f1f1f1;
          min-width: 160px;
          overflow: auto;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 999;
        }

        .dropdown-contentAcc a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

.dropdownAcc a:hover {background-color: #9c001d;}

.show1 {display: block;}
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
        <a href="inventory.php">Inventory</a>
        <a href="residents.php">Residents</a>
        <a href="history.php" class="active_menu">Activity Logs</a>
        <a href="settings.php">Accounts</a>
        <a href="help.php">Help</a>
      </div>
      
      <script>
        function showDrpAcc() {
          document.getElementById("myDropdownAcc").classList.toggle("show1");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtnAcc')) {
            var dropdowns = document.getElementsByClassName("dropdown-contentAcc");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show1')) {
                openDropdown.classList.remove('show1');
              }
            }
          }
        }
      </script>


      <div class="dropdownAcc">
        <button onclick="showDrpAcc()" class="dropbtnAcc">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="myDropdownAcc" class="dropdown-contentAcc">
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div>
    </nav>

    <div class="home-content">
      <div id="head-side">
          
          <div class="search-container">
            <form action="" method = "post">
             <input type="text" placeholder="Search.." name="searchTxt" id="searchTxt" autocomplete="off">
            <button type="submit" id="searchBtn" style="background: #ddd; color:#085e72"><i class="bx bx-search"></i></button>
            </form>
          </div>
      </div> 
<div id="list-side"> <!--list-->
  <div id="filterPanel" style="position: relative; top: 10px;">
    <form method="post" action="" style="display: inline;">
        <span>&emsp;&emsp;Sort by:&emsp;</span>
<form method="post" action="" style="display: inline;">
        <input type="submit" class="sortBtn" id="all" name="all" value="Show All"> </form>

<!--DATE PICKER-->
<form method="post" action="" id="dateForm" style="display: inline;">
  <input type="date" class="sortBtn" id="sortDatePicker" name="sortHisto" min='1777-01-01' max="2999-12-31" onkeypress="if(event.keyCode==13){this.form.submit();}" />
</form>
<!--DATE PICKER-->

<form method="post" action="" style="display: inline;">
        <select class="sortBtn" id="sortHisto" name="sortHisto" value="Category" onchange="this.form.submit();">
        <option class="sortOpt" id="sortOpt2" value="">Category</option>
<?php
$cateQuery =mysqli_query($db,"SELECT DISTINCT actCate FROM history");
  while($cateSort=mysqli_fetch_array($cateQuery)){
  echo  "<option class='sortOpt' value='".$cateSort['actCate']."'>".$cateSort['actCate']."</option>";
  }
?>
        </select></form>

<form method="post" action="" style="display: inline;">
        <select class="sortBtn" id="sortHisto" name="sortHisto" value="Name" onchange="this.form.submit();">
        <option class="sortOpt" id="sortOpt3" value="">Name</option>
<?php
$byQuery =mysqli_query($db,"SELECT DISTINCT actBy FROM history");
  while($bySort=mysqli_fetch_array($byQuery)){
  echo  "<option class='sortOpt' value='".$bySort['actBy']."'>".$bySort['actBy']."</option>";
  }
?>
        </select></form>


    </form>
<div id="table-div" style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); position: relative;">
          <table id="history-list">
          <thead>
              <tr>
                  <th>Date</th>
                  <th>Category</th>
                  <th>Activity</th>
                  <th>Processed By</th>
              </tr>
          </thead>
          <tbody>
<?php

if (isset($_REQUEST['sortHisto'])){
  //$sortHisto = $_REQUEST['sortHisto'];

  $sortHisto = stripslashes($_REQUEST['sortHisto']);
  $sortHisto = mysqli_real_escape_string($db,$sortHisto);

  $dateHistoQuery = mysqli_query($db, "SELECT * FROM history WHERE actDate='$sortHisto'") or die( mysqli_error($db));
  $dateResultCount = mysqli_num_rows($dateHistoQuery);

  $cateHistoQuery = mysqli_query($db, "SELECT * FROM history WHERE actCate='$sortHisto'") or die( mysqli_error($db));
  $cateResultCount = mysqli_num_rows($cateHistoQuery);

  $nameHistoQuery = mysqli_query($db, "SELECT * FROM history WHERE actBy='$sortHisto'") or die( mysqli_error($db));
  $nameResultCount = mysqli_num_rows($nameHistoQuery);

  if ($dateResultCount > '0'){
    $dateHisto = mysqli_query($db, "SELECT * FROM history WHERE actDate='$sortHisto'") or die( mysqli_error($db));
    while ($rows = mysqli_fetch_array($dateHisto)){
      echo "</tr>";
      echo "<tr class='userlistoutput'>";
      echo "<td width='20%'>" . $rows['actDate'] . "</td>";
      echo "<td width='20%'>" . $rows['actCate'] . "</td>";
      echo "<td width='40%'>" . $rows['actName'] . "</td>";
      echo "<td width='20%'>" . $rows['actBy'] . "</td>";
      echo "</tr>";
      }//while inside
  }//date result
  else {

    if ($cateResultCount > '0'){
    $cateHisto = mysqli_query($db, "SELECT * FROM history WHERE actCate='$sortHisto'") or die( mysqli_error($db));
    while ($rows = mysqli_fetch_array($cateHisto)){
      echo "</tr>";
      echo "<tr class='userlistoutput'>";
      echo "<td width='20%'>" . $rows['actDate'] . "</td>";
      echo "<td width='20%'>" . $rows['actCate'] . "</td>";
      echo "<td width='40%'>" . $rows['actName'] . "</td>";
      echo "<td width='20%'>" . $rows['actBy'] . "</td>";
      echo "</tr>";
      }//while inside
  }//cate result

  else { 

    if ($nameResultCount > '0'){
    $nameHisto = mysqli_query($db, "SELECT * FROM history WHERE actBy='$sortHisto'") or die( mysqli_error($db));
    while ($rows = mysqli_fetch_array($nameHisto)){
      echo "</tr>";
      echo "<tr class='userlistoutput'>";
      echo "<td width='20%'>" . $rows['actDate'] . "</td>";
      echo "<td width='20%'>" . $rows['actCate'] . "</td>";
      echo "<td width='40%'>" . $rows['actName'] . "</td>";
      echo "<td width='20%'>" . $rows['actBy'] . "</td>";
      echo "</tr>";
          }//while inside
      }//name result
    }//else name inside
}//date result else
}//isset if

else if (isset($_REQUEST['all'])){
  $showAll = stripslashes($_REQUEST['all']);
  $showAll = mysqli_real_escape_string($db,$showAll);

  if ($showAll == "Show All"){

    $displayHistory = "SELECT * FROM history ORDER BY actDT DESC";
    $results = mysqli_query($db, $displayHistory) or die( mysqli_error($db));

    while ($rows = mysqli_fetch_array($results)){
      echo "</tr>";
      echo "<tr class='userlistoutput'>";
      echo "<td width='20%'>" . $rows['actDate'] . "</td>";
      echo "<td width='20%'>" . $rows['actCate'] . "</td>";
      echo "<td width='40%'>" . $rows['actName'] . "</td>";
      echo "<td width='20%'>" . $rows['actBy'] . "</td>";
      echo "</tr>";
  }//while inside
}

}//else is isset

else if (isset($_REQUEST['searchTxt'])){
  
    $searchTxt = stripslashes($_REQUEST['searchTxt']);
    $searchTxt = mysqli_real_escape_string($db,$searchTxt); 

    $displayHistory = "SELECT * FROM history WHERE actName LIKE ('%".$searchTxt."%')";
    $results = mysqli_query($db,$displayHistory) or die(mysqli_error($db));

        while($rows = mysqli_fetch_array($results)){
          echo "</tr>";
          echo "<tr class='userlistoutput'>";
          echo "<td width='20%'>" . $rows['actDate'] . "</td>";
          echo "<td width='20%'>" . $rows['actCate'] . "</td>";
          echo "<td width='40%'>" . $rows['actName'] . "</td>";
          echo "<td width='20%'>" . $rows['actBy'] . "</td>";
        echo "</tr>";
    }
}//else if isset2

else {
  $displayHistory = "SELECT * FROM history ORDER BY actDT DESC";
  $results = mysqli_query($db, $displayHistory) or die( mysqli_error($db));

    while ($rows = mysqli_fetch_array($results)){
      echo "</tr>";
      echo "<tr class='userlistoutput'>";
      echo "<td width='20%'>" . $rows['actDate'] . "</td>";
      echo "<td width='20%'>" . $rows['actCate'] . "</td>";
      echo "<td width='40%'>" . $rows['actName'] . "</td>";
      echo "<td width='20%'>" . $rows['actBy'] . "</td>";
      echo "</tr>";
  }//while inside
}//else isset
?>
          </tbody>
          </table>
        </div><!--table div-->

</div> <!--list div-->

  </section>
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
function showDrpAcc() {
  document.getElementById("myDropdownAcc").classList.toggle("show1");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtnAcc')) {
    var dropdowns = document.getElementsByClassName("dropdown-contentAcc");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show1')) {
        openDropdown.classList.remove('show1');
      }
    }
  }
}

function keepDate(){
  document.getElementById('sortOpt1').value= "<?php echo $_REQUEST['sortHisto'];?>";
}

 </script>
</body>
</html>
