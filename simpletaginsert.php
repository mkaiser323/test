<?php

include 'dbscripts.php';

$value = "rose";
$apID = uniqID();
$value = db_realesc($value);
$sqlTagExists = "SELECT artTagID FROM arttags WHERE (tagName = " . $value . ")";
echo $sqlTagExists . "</br>";
$tagExistsResult = db_mysqli_query($sqlTagExists);

$tagNum = "";
// if tag does not exist add it:

if (mysqli_num_rows(db_mysqli_query($sqlTagExists)) <= 0){
	$sqlNewTag = "INSERT INTO arttags (artTagID, tagName) VALUES (DEFAULT," . $value . ")";
	db_mysqli_query($sqlNewTag);
	// Re-run the query to get the result of the new tag:
	$tagExistsResult = db_mysqli_query($sqlTagExists);	
}
// locate the tagNum and associate it with the art piece:
// $row =  mysqli_fetch_assoc($tagExistsResult);
	while($row =  mysqli_fetch_assoc($tagExistsResult)){
		$tagNum =  $row['artTagID'] . '<br>';
	}
// Associate the artTagID with the art piece in taggedpiece:
	echo "$tagNum is: " . $tagNum . "</br>";
	echo "apID is: " . $apID . "</br>";
	$sqlTagPiece = "INSERT INTO taggedpiece (apID, artTagID)
	 VALUES ('" . $apID . "','" . $tagNum . "')";
	echo $sqlTagPiece;
	db_mysqli_query($sqlTagPiece);



















?>