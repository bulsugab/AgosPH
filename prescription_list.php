<?php
//echo "Button is working!";
require('config.php');
include('auth.php');
require_once('tcpdf/tcpdf.php');

//if (isset($_GET['servId'])){
	
	$id = $_GET['itemId'];  
    $query = "SELECT * FROM items WHERE itemId = '$id'";  
    $results = mysqli_query($db, $query) or die( mysqli_error($db));
    //  
    while($rows = mysqli_fetch_array($results))  
    {       
    	$itemName = $rows['itemName'];
      $itemGen = $rows['itemGen'];
    	$itemNo = $rows['itemNo'];
      $itemDist = $rows['itemQty'] - $rows['itemNum'];
    	$itemExp = $rows['itemExp'];
    	$itemFor = $rows['itemFor'];
    }  

$ssql = "SELECT * FROM prescriptions WHERE presMedId = '$id'";  
$rresult = mysqli_query($db, $ssql) or die( mysqli_error($db));
$row_num = mysqli_num_rows($rresult);

 function fetch_data()  
 { 
 	require('config.php');

 	$itemId = $_GET['itemId']; 
      $output = '';  
      $sql = "SELECT * FROM prescriptions WHERE presMedId = '$itemId'";  
      $result = mysqli_query($db, $sql) or die( mysqli_error($db));  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '<tr>  
                          <td>'.$row["presDate"].'</td>  
                          <td>'.$row["presName"].'</td>  
                          <td>'.$row["presAge"].'</td>  
                          <td>'.$row["presQty"].'</td>
                          <td>'.$row["createdBy"].'</td>
                     </tr>  
                          ';  
      }  
      return $output;  
 } //function 


      //require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Download recipient List");  
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
      <table cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="50%"><b>Item Name:</b> '.$itemName.'</th> 
                <th width="50%"><b>Item Generic Name:</b> '.$itemGen.'</th> 
           </tr>

           <tr>
              <td><b>Item No.:</b> '.$itemNo.'</td>  
           		<td><b>Item Expiration Date:</b> '.$itemExp.'</td>  
                
           </tr>

           <tr>
           		<td><b>Total Item Distributed:</b> '.$itemDist.'</td>  
              <td><b>Item For:</b> '.$itemFor.'</td>  
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
                <th width="15%">Date Received</th>  
                <th width="25%">Name of Patient</th>
                <th width="10%">Age</th>
                <th width="25%">Quantity Received</th>  
                <th width="25%">Issued By</th>
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>

      <p>************************************ NOTHING FOLLOWS ************************************</p><br><br>
      <p>_________________________</p>
      <p style="text-indent: 10em;"><br>Name of Head<br><b>Barangay Post</b></p>
      ';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('list of '.$itemName.' recipients.pdf', 'I');  
//} // isset

?>