<?php

include 'dbscripts.php';

$apID = $_POST["apID"];
$buyerID = $_POST["buyerID"];
$apPrice = "";
$sellerID = "";
$orderID = uniqid("ord",TRUE);

// Get Artist info

$sellerInfo = "SELECT apPrice, artistID FROM artpiece WHERE apID = '" . $apID . "'";
$si = db_mysqli_query($sellerInfo);


if ($si){
	while ($row =  mysqli_fetch_assoc($si)){
		$apPrice = $row["apPrice"];
		$sellerID = $row["artistID"];
	}
}

$payment_success = TRUE;

// insert PayPal feedback here

if ($payment_success){
	$create_order = "INSERT INTO orders (orderID, apID, orderTotal, buyerID, sellerID, orderDate) VALUES ('" .
	$orderID . "','" . $apID . "','" . $apPrice . "','" . $buyerID . "','" . $sellerID . "'," . "DEFAULT)";
	//echo $create_order . "</br>";
	db_mysqli_query($create_order);
}

readfile("index.html");


?>