<?php
require("config.php");
include("auth.php");

function itexmo($number,$message,$apicode,$passwd){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    $param = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($itexmo),
      ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}

if (isset($_REQUEST['pat_name'], $_REQUEST['pat_med'], $_REQUEST['pat_qty'], $_REQUEST['pat_note'])){

    $pat_name = stripslashes($_REQUEST['pat_name']);
    $pat_name = mysqli_real_escape_string($db,$pat_name);

    $pat_name_query = mysqli_query ($db, "SELECT * FROM residents WHERE idRecord = '$pat_name'") or die(mysqli_error($db)); 
    while ($pat_res = mysqli_fetch_array($pat_name_query)){ 

        $pat_full = $pat_res['fname']." ".$pat_res['mname']." ".$pat_res['lname'];
        $pat_id = $pat_res['idRecord'];
        $pat_age = $pat_res['age'];
        $pat_address = $pat_res['address']

        if ($pat_age > '59'){
            $pat_type = 'Seniors';
        }

        else if (($pat_age > '0') && ($pat_age < '7')){
            $pat_type = 'Children';
        }

        else {
            $pat_type = 'Infant';
        }

        $pat_guardian = $pat_res['guardian'];
        $pat_num = $pat_res['contactNum']; }

    $pat_med = stripslashes($_REQUEST['pat_med']);
    $pat_med = mysqli_real_escape_string($db,$pat_med);

    $pat_med_query = mysqli_query ($db, "SELECT * FROM items WHERE itemId = '$pat_med'") or die(mysqli_error($db));
    while ($pat_item = mysqli_fetch_array($pat_med_query)){ 

        $item_name = $pat_item['itemName'];
        $item_id = $pat_item['itemId'];
        $item_exp = $pat_item['itemExp'];
        }

    $pat_qty = stripslashes($_REQUEST['pat_qty']);
    $pat_qty = mysqli_real_escape_string($db,$pat_qty);

    $pat_note = stripslashes($_REQUEST['pat_note']);
    $pat_note = mysqli_real_escape_string($db,$pat_note);




    $query = "INSERT INTO prescriptions (presType, presAge, presName, presAddress, presNameId, presMed, presMedId, presExp, presQty, presNote, presGuardian, presNum, createdBy)  VALUES ('$pat_type', '$pat_age', '$pat_full','$pat_address', '$pat_id', '$item_name', '$item_id', '$item_exp','$pat_qty', '$pat_note','$pat_guardian', '$pat_num', '".$_SESSION['username']."')";
        $result = mysqli_query($db,$query) or die(mysqli_error($db));
        if($result){
        
        // $addPres = "Issued item(s) for: ".$pat_full."";
        // $updateHisto = "INSERT INTO history (actName, actBy) VALUES ('".$addPres."', '".$_SESSION['username']."')";
        // $updateHistoExe = mysqli_query($db, $updateHisto) or die(mysqli_error($db));

        $addPres = "Issued ".$pat_qty." count(s) of ".$item_name." to ".$pat_full."";
        $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Inventory', '".$addPres."', '".$_SESSION['username']."')";
        $updateHistoExe = mysqli_query($db, $updateHisto);

        $updateStock = "UPDATE items SET itemNum = itemNum - '$pat_qty' WHERE itemId = '$item_id'";
        $updateStockExe = mysqli_query($db, $updateStock) or die(mysqli_error($db));

        //edit
        //header("Location: inventory.php");
        //to be remove
        //sms start

        $message = "Hi, ".$pat_full."! This is a confirmation that you received ".$pat_qty." counts of ".$item_name.".";

        $results = itexmo("0".$pat_num."", $message ,"ST-GABZA946272_A56HS", "r3{5q9kim}");
                if ($results == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }   else if ($results == 0){
                     header("Location: inventory.php");
                }
                else if ($results == 4){
                    echo "<script>alert('All free SMS trials are used! Cannot send confirmation SMS!');</script>";
                    header("Location: inventory.php");

                }

                else{ 
                    echo "<script>alert('Error Num ". $results . " was encountered! Process completed but cannot send the SMS at the moment.');</script>";
                    header("Location: inventory.php");
                }

        //sms end
        }
        else { 
          echo "<script>alert('Failed to post program. Try again.');</script>";
        }
      }
else {
    echo "<script>alert('Failed to post program. Try again.'');</script>";
}
?>