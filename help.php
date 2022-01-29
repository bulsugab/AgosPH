<?php
include('auth.php');
require('config.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/help.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>HCMS - Help Center</title>
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
      .dropbtnMore {
          background-color: #085e72;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }

        .dropbtnMore:hover, .dropbtnMore:focus{
          background-color: #053e4c;
        }

        .dropdownMore {
          position: relative;
          display: inline-block;
        }

        .dropdown-contentMore {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          float: right;
          right: 0px;
          margin-left: auto;
          width: 200px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 900;
        }

        .dropdown-contentMore .opt {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          z-index: 901;
        }

        .dropdownMore .opt:hover {background-color: #ddd;}

        .show1 {display: block;}




        .dropbtnHelp {
            background-color: transparent;
            font-weight: bold;
            color: #000;
            padding: 16px;
            width: 100%;
            text-align: left;
            font-size: 16px;
            border: none;
            word-break: break-all;
            border-bottom: 1px solid dimgray;
            cursor: pointer;
          }

          .dropbtnHelp:hover,  .dropbtnHelp:focus{
            background-color: #ddd;
            color: #000;
          }

          .dropdownHelp {
            position: relative;
            display: block;
          }

          .dropdown-contentHelp {
            display: none;
            position: relative;
            background-color: transparent;
            width: 100%;
            min-width: 160px;
            overflow: auto;
            z-index: 1;
          }

          .dropdown-contentHelp a {
            color: black;
            padding: 12px 16px;
            padding-left: 50px;
            text-decoration: none;
            display: block;
          }

          .dropdownHelp a:hover {
            background-color: #ddd;
            color: #000;
          }

          .show {
            display: block;
              -webkit-transition:1s;
              }

            .subOpt:hover{
              background-color: #ddd;
            }
            .subOpt{
              display: block;
              border: none;
              padding: 15px;
              border-bottom: 1px solid dimgray;
            }
            .helpInfo{
              padding-left: 25px;
              padding-top: 10px;
              padding-bottom: 30px;
            }
            .dropbtnHelp{
              font-weight: normal;
            }
            .dropbtnHelp .fa{
              float: right;
            }
            #backBtnHelp:hover{
              background-color: #ddd;
              color: #000;
            }

            .site-footer
          {
            background-color:#f5f5f5;
            /*padding:45px 0 20px;*/
            padding:45px;
            margin-top: 100px;
            font-size:15px;
            line-height:24px;
            color:#737373;
          }
          .site-footer hr
          {
            border-top-color:#bbb;
            opacity:0.5
          }
          .site-footer hr.small
          {
            margin:20px 0
          }
          .site-footer h6
          {
            color:#fff;
            font-size:16px;
            text-transform:uppercase;
            margin-top:5px;
            letter-spacing:2px;
          }
          .site-footer a
          {
            color:#737373;
          }
          .site-footer a:hover
          {
            color:#3366cc;
            text-decoration:none;
          }
          .footer-links
          {
            padding-left:0;
            list-style:none
          }
          .footer-links li
          {
            display:block
          }
          .footer-links a
          {
            color:#737373
          }
          .footer-links a:active,.footer-links a:focus,.footer-links a:hover
          {
            color:#3366cc;
            text-decoration:none;
          }
          .footer-links.inline li
          {
            display:inline-block
          }
          .site-footer .social-icons
          {
            text-align:center;
          }
          .site-footer .social-icons a
          {
            width:40px;
            height:40px;
            line-height:40px;
            margin-left:6px;
            margin-right:0;
            border-radius:100%;
            background-color:#33353d
          }
          .copyright-text
          {
            margin:0
          }
          @media (max-width:991px)
          {
            .site-footer [class^=col-]
            {
              margin-bottom:30px
            }
          }
          @media (max-width:767px)
          {
            .site-footer
            {
              padding-bottom:0
            }
            .site-footer .copyright-text,.site-footer .social-icons
            {
              text-align:center
            }
          }
          .social-icons
          {
            padding-left:0;
            margin-bottom:0;
            list-style:none
          }
          .social-icons li
          {
            display:inline-block;
            margin-bottom:4px
          }
          .social-icons li.title
          {
            margin-right:auto;
            margin-left: auto;
            text-transform:uppercase;
            color:#96a2b2;
            font-weight:700;
            font-size:13px
          }
          .social-icons a{
            background-color:#eceeef;
            color:#fff;
            font-size:16px;
            display:inline-block;
            line-height:44px;
            width:44px;
            height:44px;
            text-align:center;
            margin-right:8px;
            border-radius:100%;
            -webkit-transition:all .2s linear;
            -o-transition:all .2s linear;
            transition:all .2s linear
          }
          .social-icons a:active,.social-icons a:focus,.social-icons a:hover
          {
            color:#fff;
            background-color:#29aafe
          }
          .social-icons.size-sm a
          {
            line-height:34px;
            height:34px;
            width:34px;
            font-size:14px
          }
          .social-icons a.facebook
          {
            background-color:#3b5998
          }
          .social-icons a.twitter
          {
            background-color:#00aced
          }
          .social-icons a.linkedin
          {
            background-color:#007bb6
          }
          .social-icons a.dribbble
          {
            background-color:#ea4c89
          }
          @media (max-width:767px)
          {
            .social-icons li.title
            {
              display:block;
              margin-right:auto;
              margin-left: auto;
              font-weight:600
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
      </style>
   </head>
<body style="background-color:#f5f5f5;">
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
        <a href="history.php">Activity Logs</a>
        <a href="settings.php">Accounts</a>
        <a href="help.php" class="active_menu">Help</a>
      </div>
      
      <!-- <div class="dropdown1">
        <button onclick="showDropdown1()" class="dropbtn1" data-toggle="dropdown" style="width:fit-content;">Hi, !&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="drpContent" class="dropdown-content1">
          <a href="" id="helpOption">Help Option</a>
          <a href="logout.php" id="signoutDrp">Sign Out</a>
        </div>
      </div> -->
      <div class="dropdownMore">
        <script>
          function showMoreOpt() {
            document.getElementById("drpMore").classList.toggle("show1");
          }
        </script>
        <button onclick="showMoreOpt()" class="dropbtnMore">Hi, <?php echo $_SESSION['username'];?>!&emsp;<i class="fa fa-angle-down" aria-hidden="true" onclick="showDropdown()">&nbsp;</i></button>
        <div id="drpMore" class="dropdown-contentMore">
          <a href="logout.php" id="signoutDrp" class="opt">Sign Out</a>
        </div>
      </div>


    </nav>

    <div class="home-content">

      <div id="head-side">
        <button id="backBtnHelp" style="position: relative; display: block; float: left; background-color: #085e72; color: #fff; border:1px solid dimgray; border-radius: 7px; padding-left: 15px; padding-right: 15px; margin-top: -10px; font-size: 100%; width: auto; height: auto;" onclick="javascript:history.go(-1)">Back</button><br><br>
          <div style="display:block; font-size: 200%; padding-left: 30px; background-color: transparent;">HELP CENTER</div>          
          
      </div>
      <div id="helpSideOpt" style="display: inline-block; background-color: transparent; padding: 20px; width:30%; height: 100%; border:none;">
          <a id="eventHelpMenu" class="subOpt" style="font-weight: bold;" onclick="showEventHelp()">Events and other Services</a>
          <a id="inventoryHelpMenu" class="subOpt" onclick="showInventoryHelp()">Inventory</a>
          <a id="residentHelpMenu" class="subOpt" onclick="showResidentHelp()">Residents</a>
      </div>
      <div id="helpSideRight" style="display: inline-block;float: right; margin-right: 15px; margin-top: 18px; background-color: transparent; padding-left: 20px; width:68%; border-left: 1px solid dimgray;">
        <div id="eventHelp" style="display:block;">
          <div class="dropdownHelp">
            <button onclick="showDrp1()" class="dropbtnHelp">How to <b>add events, seminars, or services</b> on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp1" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Go to the ‘<b>Event</b>’ tab on the menu.<br>
                  2. Click ‘<b>+ Add</b>’ and then choose what kind of activity you would.<br>
              </div>
            </div>
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp2()" class="dropbtnHelp">How to <b>view events, seminars, or services</b> information and participants stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp2" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the event, seminars and services you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “View”.<br>
                  3. It will route you to the window that will show the information of the chosen activity.

              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp3()" class="dropbtnHelp">How to <b>update events, seminars, or services</b> information stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp3" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the event, seminars and services you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.<br>
                  3. Click ‘<b>Update information</b>’.<br>
                  4. Find the information you wish to edit and then click ‘<b>Edit</b>’ to modify the information.<br>
                  5. Press ‘<b>Confirm</b>’ to save the new information.<br>
              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp4()" class="dropbtnHelp">How to <b>add participants to events, seminars, or services</b> information stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp4" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the event, seminars and services you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.<br>
                  3. Click ‘<b>Add Participants</b>’.<br>
                  4. Find the residents you want to add then press ‘<b>Add</b>’.<br>

              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp5()" class="dropbtnHelp">How to <b>remove participants to events, seminars, or services</b> information stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp5" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the event, seminars and services you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.<br>
                  3. The window will show a list of the participants.<br>
                  4. Find the residents you want to remove then press ‘<b>Remove</b>’.

              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp6()" class="dropbtnHelp">How to <b>add sub events, seminars, or services</b> information stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp6" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the event, seminars and services you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.<br>
                  3. Click ‘<b>Create sub-event</b>’.
                  4. Fill up the form and press ‘<b>Confirm</b>’ to save the information.

              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp7()" class="dropbtnHelp">How to <b>send messages</b> for events, seminars, or service  participants?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp7" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the event, seminars and services you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.<br>
                  3. Click ‘<b>Message Participant(s)</b>’.<br>
                  4. Type message on the text box and press ‘<b>Send</b>’ to send the message.<br>


              </div>
            </div>  
          </div>

          <div class="dropdownHelp">
            <button onclick="showDrp8()" class="dropbtnHelp">How to <b>view and download</b> list of participants on a document?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp8" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the event, seminars and services you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.<br>
                  3. Click ‘<b>Download Record</b>’.<br>
                  4. It will route on the window that will show and will allow the user to download the document that consists of the list of participants.<br>


              </div>
            </div>  
          </div>
        </div><!-- END OF EVENT HELP DIV -->
        <!--INVENTORY HELP-->
        <div id="inventoryHelp" style="display: none;">
          <div class="dropdownHelp">
            <button onclick="showDrp9()" class="dropbtnHelp">How to <b>add items</b> for seniors, children, or infants on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp9" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Go to the ‘<b>Inventory</b>’ tab on the menu.<br>
                  2. Click ‘<b>+ Stock</b>’ and then choose who the items are for.<br>
                  3. Fill up the form and press ‘<b>Confirm</b>’ to save the item information.<br>


              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp10()" class="dropbtnHelp">How to <b>issue items</b> for seniors, children, or infants on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp10" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Go to the ‘<b>Inventory</b>’ tab on the menu.<br>
                  2. Click ‘<b>Issue</b>’ and then choose who the items are for.<br>
                  3. Fill up the form and press ‘<b>Confirm</b>’ to save the item issuance information.<br>
              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp11()" class="dropbtnHelp">How to <b>view items</b> stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp11" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the items you want to view the information on the listed records.<br>
                  2. Under the ‘<b>Action</b>’ column, click “<b>View</b>”.<br>
                  3. It will route you to the window that will show the information of the chosen item.<br>

              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp12()" class="dropbtnHelp">How to <b>update items</b> stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp12" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the items you want to view the information on the listed records.<br>
                  2. Under the ‘<b>Action</b>’ column, click “<b>View</b>”.<br>
                  3. Click ‘<b>Update information</b>’.<br>
                  4. Find the information you wish to edit and then click ‘<b>Edit</b>’ to modify the information.<br>
                  5. Press ‘<b>Confirm</b>’ to save the new information.<br>

              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp13()" class="dropbtnHelp">How to <b>view and download</b> a list of residents who received a specific item on a document?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp13" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the items you want to view the information on the listed records.<br>
                  2. Under the ‘<b>Action</b>’ column, click “<b>View</b>”.<br>
                  3. Click ‘<b>Download Record</b>’.<br>
                  4. It will route on the window that will show and will allow the user to download the document that consists of the list of residents who received a specific item.<br>
              </div>
            </div>  
          </div>
           <div class="dropdownHelp">
            <button onclick="showDrp14()" class="dropbtnHelp">How to <b>restock items</b>?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp14" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the items you want to view the information on the listed records.<br>
                  2. Under the ‘<b>Action</b>’ column, click “<b>Restock</b>”.<br>
                  3. Input the quantity and press ‘<b>Restock</b>’ to update the item.<br>

              </div>
            </div>  
          </div>
        </div>
        <!-- END OF INVENTORY HELP -->
        <!-- START OF RESIDENT HELP -->
        <div id="residentHelp" style="display: none;">
          <div class="dropdownHelp">
            <button onclick="showDrp15()" class="dropbtnHelp">How to <b>register resident</b> records for seniors, children, or infants on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp15" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Go to the ‘<b>Residents</b>’ tab on the menu.<br>
                  2. Click ‘<b>+ Register</b>’ and then choose who the records are for.<br>
                  3. Fill up the form and press ‘<b>Confirm</b>’ to save the resident information.


              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp16()" class="dropbtnHelp">How to <b>view records of the resident</b> stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp16" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the resident you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.<br>
                  3. It will route you to the window that will show the information of the chosen resident.<br>
              </div>
            </div>  
          </div>
          <div class="dropdownHelp">
            <button onclick="showDrp17()" class="dropbtnHelp">How to <b>update resident information</b> stored on the system?<i class="fa fa-angle-down"></i></button>
            <div id="helpDrp17" class="dropdown-contentHelp">
              <div class="helpInfo">
                  1. Locate the resident you want to view the information on the listed records.<br>
                  2. Under the ‘<b>action</b>’ column, click “<b>View</b>”.
                  3. Click ‘<b>Update information</b>’.<br>
                  4. Find the information you wish to edit and then click ‘<b>Edit</b>’ to modify the information.<br>
                  5. Press ‘<b>Confirm</b>’ to save the new information.<br>
              </div>
            </div>  
          </div>

        </div>
        <!-- END OF RESIDENT HELP -->
      </div>

    </div> 
</section>
<br>
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
  
  <script>
     

function showDropdown1() {
  document.getElementById("drpContent").classList.toggle("show");
}

function showMoreOpt() {
  document.getElementById("drpMore").classList.toggle("show1");
}






function showDrp1() {
  document.getElementById("helpDrp1").classList.toggle("show");
}
function showDrp2() {
  document.getElementById("helpDrp2").classList.toggle("show");
}
function showDrp3() {
  document.getElementById("helpDrp3").classList.toggle("show");
}
function showDrp4() {
  document.getElementById("helpDrp4").classList.toggle("show");
}
function showDrp5() {
  document.getElementById("helpDrp5").classList.toggle("show");
}
function showDrp6() {
  document.getElementById("helpDrp6").classList.toggle("show");
}
function showDrp7() {
  document.getElementById("helpDrp7").classList.toggle("show");
}
function showDrp8() {
  document.getElementById("helpDrp8").classList.toggle("show");
}
function showDrp9() {
  document.getElementById("helpDrp9").classList.toggle("show");
}
function showDrp10() {
  document.getElementById("helpDrp10").classList.toggle("show");
}
function showDrp11() {
  document.getElementById("helpDrp11").classList.toggle("show");
}
function showDrp12() {
  document.getElementById("helpDrp12").classList.toggle("show");
}
function showDrp13() {
  document.getElementById("helpDrp13").classList.toggle("show");
}
function showDrp14() {
  document.getElementById("helpDrp14").classList.toggle("show");
}
function showDrp15() {
  document.getElementById("helpDrp15").classList.toggle("show");
}
function showDrp16() {
  document.getElementById("helpDrp16").classList.toggle("show");
}
function showDrp17() {
  document.getElementById("helpDrp17").classList.toggle("show");
}


function showEventHelp(){
  document.getElementById("eventHelp").style.display="block";
  document.getElementById("inventoryHelp").style.display="none";
  document.getElementById("residentHelp").style.display="none";

  document.getElementById("eventHelpMenu").style.fontWeight="900";
  document.getElementById("inventoryHelpMenu").style.fontWeight="400";
  document.getElementById("residentHelpMenu").style.fontWeight="400";
}
function showInventoryHelp(){
  document.getElementById("eventHelp").style.display="none";
  document.getElementById("inventoryHelp").style.display="block";
  document.getElementById("residentHelp").style.display="none";

  document.getElementById("eventHelpMenu").style.fontWeight="400";
  document.getElementById("inventoryHelpMenu").style.fontWeight="900";
  document.getElementById("residentHelpMenu").style.fontWeight="400";
}
function showResidentHelp(){
  document.getElementById("eventHelp").style.display="none";
  document.getElementById("inventoryHelp").style.display="none";
  document.getElementById("residentHelp").style.display="block";

  document.getElementById("eventHelpMenu").style.fontWeight="400";
  document.getElementById("inventoryHelpMenu").style.fontWeight="400";
  document.getElementById("residentHelpMenu").style.fontWeight="900";
}


 </script>
</body>
</html>