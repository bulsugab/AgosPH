<?php
//echo "Button is working!";
require('config.php');
include('auth.php');
require_once('tcpdf/tcpdf.php');

//if (isset($_GET['servId'])){
  
  $id = $_GET['servId'];  
    $query = "SELECT * FROM services WHERE servId = '$id'";  
    $results = mysqli_query($db, $query) or die( mysqli_error($db));
    //  
    while($rows = mysqli_fetch_array($results))  
    {       
      $eventName = $rows['servName'];
      $eventPlace = $rows['servPlace'];
      $eventCapacity = $rows['servCapacity'];
      $eventStart = $rows['servStart'];
      $eventEnd = $rows['servEnd'];
      $eventParticipants = $rows['servParticipant'];
      $coorName = $rows['coorName'];
      $coorNum = $rows['coorNum'];
      
    }  

$ssql = "SELECT * FROM eventparticipants WHERE eventId = '$id'";  
$rresult = mysqli_query($db, $ssql) or die( mysqli_error($db));
$row_num = mysqli_num_rows($rresult);

 function fetch_data()  
 { 
  require('config.php');

  $servId = $_GET['servId']; 
      $output = '';  
      $sql = "SELECT * FROM eventparticipants WHERE eventId = '$servId'";  
      $result = mysqli_query($db, $sql) or die( mysqli_error($db));  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '<tr>  
                          <td>'.$row["addName"].'</td>  
                          <td>'.$row["addAge"].'</td>  
                          <td>'.$row["addGuardian"].'</td>  
                          <td>'.$row["addNum"].'</td>
                     </tr>  
                          ';  
      }  
      return $output;  
 } //function 


      //require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Download Participant List");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('times');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('times', '', 11);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <table cellspacing="0" cellpadding="0">
      <tr>
      <th width="30%"><img src="img/DOH.png" width="65" height="65"/></th>
      <th width="40%" align="center"><br><br>Patient Recipient List<br>DOH - Medicine<br>Rural Health Unit II BHS<br>Barangay Tampok Hagonoy, Bulacan</th>
      <th width="15%"></th>
      <th width="15%"><img src="img/HB.png" width="70" height="70"/></th>
      </tr>
      </table>

      <table>
       <tr>
        <th>
        </th>
       </tr>
       </table>

      <table cellspacing="0" cellpadding="1.5">

           <tr>  
                <th width="50%"><b>Event Name:</b> '.$eventName.'</th>  
                <th width="50%"><b>Total Attendees:</b> '.$row_num.'</th>   
           </tr>

           <tr>
              <td><b>Venue:</b> '.$eventPlace.'</td>  
                <td><b>Capacity:</b> '.$eventCapacity.'</td>  
           </tr>

           <tr>
             <td><b>Event Start:</b> '.$eventStart.'</td> 
             <td><b>Event End:</b> '.$eventEnd.'</td> 
           </tr>

           <tr>
              <td><b>Coordinator:</b> '.$coorName.'</td>  
              <td><b>Coordinator Contact Number:</b> '.$coorNum.'</td>  
           </tr>
       </table>
       <table>
       <tr>
        <th>
        </th>
       </tr>
       </table>

      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="30%">Name</th>  
                <th width="10%">Age</th>  
                <th width="30%">Guardian</th>  
                <th width="30%">Contact Number</th>
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>

      <p>************************************ NOTHING FOLLOWS ************************************</p><br><br>
      <p>_________________________</p>
      <p style="text-indent: 10em;"><br>Name of Head<br><b>Barangay Post</b></p>
      ';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('paticipants of '.$eventName.'.pdf', 'I');  
//} // isset

?>