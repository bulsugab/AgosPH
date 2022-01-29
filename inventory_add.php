<?php
require("config.php");
include("auth.php");


if (isset($_REQUEST['invt_no'], $_REQUEST['invt_name'], $_REQUEST['invt_gen'], $_REQUEST['invt_qty'], $_REQUEST['invt_unit'], $_REQUEST['invt_for'], $_REQUEST['invt_exp'], $_REQUEST['invt_rcv'])){

    $invt_no = stripslashes($_REQUEST['invt_no']);
    $invt_no = mysqli_real_escape_string($db,$invt_no);

    $invt_name = stripslashes($_REQUEST['invt_name']);
    $invt_name = mysqli_real_escape_string($db,$invt_name);

    $invt_gen = stripslashes($_REQUEST['invt_gen']);
    $invt_gen = mysqli_real_escape_string($db,$invt_gen);

    $invt_qty = stripslashes($_REQUEST['invt_qty']);
    $invt_qty = mysqli_real_escape_string($db,$invt_qty);

    $invt_unit = stripslashes($_REQUEST['invt_unit']);
    $invt_unit = mysqli_real_escape_string($db,$invt_unit);

    $invt_for = stripslashes($_REQUEST['invt_for']);
    $invt_for = mysqli_real_escape_string($db,$invt_for);

    $invt_exp = stripslashes($_REQUEST['invt_exp']);
    $invt_exp = mysqli_real_escape_string($db,$invt_exp);

    $invt_rcv = stripslashes($_REQUEST['invt_rcv']);
    $invt_rcv = mysqli_real_escape_string($db,$invt_rcv);



    $query = "INSERT INTO items (itemNo, itemName, itemGen, itemQty, itemNum, itemUnit, itemFor, itemExp, itemDateRcv, createdBy)  VALUES ('$invt_no', '$invt_name', '$invt_gen', '$invt_qty', '$invt_qty', '$invt_unit','$invt_for', '$invt_exp', '$invt_rcv','".$_SESSION['username']."')";
        $result = mysqli_query($db,$query);
        if($result){

            $addItem = "Added ".$invt_qty." count(s) of ".$invt_name." (".$invt_unit.").";
            $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Inventory', '".$addItem."', '".$_SESSION['username']."')";
            $updateHistoExe = mysqli_query($db, $updateHisto);

        header("Location: inventory.php");
        }
        else { 
          echo '<script>
            alert("Failed to stock the item!"); 
            window.location.replace("inventory.php"); </script>';
        }
      }
else {
    echo '<script>
        alert("Data incomplete!"); 
        window.location.replace("inventory.php"); </script>';
}
?>