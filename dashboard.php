<?php
require('config.php');
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/dashboard.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
     <style>
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
     </style>
   </head>
<body>
  <section class="home-section">
    <nav style="background-color: #085e72; color: #fff;">
      <!-- <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Home</span>
      </div> -->
      <img src="img/agosph.png" id="appLogo">
      <div id="menu">
        <a href="dashboard.php" class="active_menu">Home</a>
        <a href="services.php">Events</a>
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
     
<div class="slideshow-container">

<?php

// $imgTable = mysqli_query($db, "SELECT * FROM imgs") or die(mysqli_error($db));
// $tableCheck = mysqli_num_rows($imgTable);

// if ($tableCheck > 0){
$banner1Query = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='banner1' AND imgFile=''") or die(mysqli_error($db));
$banner1 = mysqli_num_rows($banner1Query);
$banner1Query2 = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='banner1'") or die(mysqli_error($db));
$bannerOne = mysqli_fetch_array($banner1Query2);

$banner2Query = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='banner2' AND imgFile=''") or die(mysqli_error($db));
$banner2 = mysqli_num_rows($banner2Query);
$banner2Query2 = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='banner2'") or die(mysqli_error($db));
$bannerTwo = mysqli_fetch_array($banner2Query2);

$banner3Query = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='banner3' AND imgFile=''") or die(mysqli_error($db));
$banner3 = mysqli_num_rows($banner3Query);
$banner3Query2 = mysqli_query($db, "SELECT * FROM imgs WHERE imgClass='banner3'") or die(mysqli_error($db));
$bannerThree = mysqli_fetch_array($banner3Query2);

 
echo    "<div class='mySlides fade'>";
        if ($banner1 == '0'){
echo     "<img src='data:image;base64,".base64_encode($bannerOne['imgFile'])."' style='width:100%; height: auto;' id='banner1'>";
        } else { echo "<img src='img/defbanner.jpg' style='width:100%; height: auto;'>"; }
echo     "</div>";
echo      "<div class='mySlides fade'>";
        if ($banner2 == '0'){
echo      "<img src='data:image;base64,".base64_encode($bannerTwo['imgFile'])."' style='width:100%' id='banner2'>";
        } else { echo "<img src='img/defbanner.jpg' style='width:100%; height: auto;'>"; }
echo      "</div>";
echo      "<div class='mySlides fade'>";
        if ($banner3 == '0'){
echo      "<img src='data:image;base64,".base64_encode($bannerThree['imgFile'])."' style='width:100%' id='banner3'>";
        } else { echo "<img src='img/defbanner.jpg' style='width:100%; height: auto;'>"; }
echo      "</div>";
// }

// else {

// echo "<div class='mySlides fade'>
//           <img src='img/defbanner.jpg' style='width:100%; height: auto;'>
//       </div>
//       <div class='mySlides fade'>
//           <img src='img/defbanner.jpg' style='width:100%; height: auto;'>
//       </div>

//       <div class='mySlides fade'>
//           <img src='img/defbanner.jpg' style='width:100%; height: auto;'>
//       </div>";
// }//check if img table is empty

?>
</div>

<!-- <div> -->
        <div style="text-align:center; margin-top: -23px;">
          <span class="dot"></span>
          <span class="dot"></span>
          <span class="dot"></span>
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
<div id="summary" style=" overflow: hidden;">
        <div id="overview">
            <div class="title" style="width: 100%; text-align:center; margin-bottom:30px;"><h2>Inventory Status</h2></div>
            <div id="chartDiv" style="width:100%; margin-bottom: 50px;">
              <canvas id="myChart" style="width:100%;max-width:700px; margin-right: auto; margin-left: auto;"></canvas>
            </div>
        </div>
        <div id="monthlyEvents" style="width: 40%; height: 350px; float:right; margin-right: 10%;">
            <div class="title" style="width: 100%; text-align:center; margin-bottom:30px;"><h2>Upcoming Activities</h2></div>
            <div id="table-div" style="font-size: 90%; overflow-y: auto !important; max-height: 350px; ">
                <table class="content-table" style="top: 0px; width:100%;">
                  <thead>
                    <tr>
                      <th>Activity Name</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Participants</th>
                    </tr>
                  </thead>
                  <tbody>
<?php $resultsss = mysqli_query($db,"SELECT * FROM services WHERE servStart > CURRENT_DATE() ORDER BY servStart ASC");
      while ($rowsss = mysqli_fetch_array($resultsss)){
              echo "<tr>";
              echo "<td>".$rowsss['servName']."</td>";
              echo "<td>".$rowsss['servCate']."</td>";
              echo "<td>".$rowsss['servStart']."</td>";
              echo "<td>".$rowsss['servParticipant']."</td>";
              echo "</tr>";

      }//while

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
  <script>

var xValues = ["In Stock", "Out Of Stock", "Low Stock"];
<?php
$inQ = mysqli_query($db, "SELECT * FROM items WHERE itemNum > '10'");
$in = mysqli_num_rows($inQ);
$outQ = mysqli_query($db, "SELECT * FROM items WHERE itemNum = '0'");
$out = mysqli_num_rows($outQ);
$lowQ = mysqli_query($db, "SELECT * FROM items WHERE itemNum < '11' AND itemNum > '0'");
$low = mysqli_num_rows($lowQ);

echo "var yValues = [".$in.", ".$out.", ".$low."];"; ?>
var barColors = [
  "#034f84",
  "#d64161",
  "#feb236"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
 
});

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
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 7000); // Change image every 2 seconds
}
 </script>

</body>
</html>