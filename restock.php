<?php
require('config.php');
include("auth.php");

if (isset($_POST['itemId'], $_POST['res_qty'])){
	$itemId = $_POST['itemId'];
	$itemId = stripslashes($_POST['itemId']);
	$itemId = mysqli_real_escape_string($db,$itemId);

	$restock = $_POST['res_qty'];
	$restock = stripslashes($_POST['res_qty']);
	$restock = mysqli_real_escape_string($db,$restock);

	$updatedBy = $_SESSION['username'];

	$itemTab = mysqli_query($db, "UPDATE items SET itemQty= itemNum + '$restock', itemNum = itemNum + '$restock', updatedBy='$updatedBy', itemDate = CURRENT_TIMESTAMP WHERE itemId='$itemId'") or die(mysqli_error($db));
if ($itemTab){
	$itemCheck = mysqli_query($db, "SELECT * FROM items WHERE itemId='$itemId'") or die(mysqli_error($db));
	
		while ($row = mysqli_fetch_array($itemCheck)){
		$histoRestock = "".$_SESSION['username']." restocked ".$row['itemName']." with ".$restock." count(s)";
        $updateHisto = "INSERT INTO history (actCate, actName, actBy) VALUES ('Inventory', '".$histoRestock."', '".$_SESSION['username']."')";
        $updateHistoExe = mysqli_query($db, $updateHisto);
        }

		header("Location: inventory.php");
}
}//isset if

else {
	echo "<script>alert('Value empty');</script>";
	//header("Location: inventory.php");
}

?>