<?php
	include 'dbscripts.php';
	
	$tag = test_input($_POST['searchValue']);
	
	// Disabled artist search functionality below:	
	/*	
	$artist_search = "SELECT imageLoc, artistID, apDesc, apPrice FROM artpiece WHERE EXISTS (SELECT apID FROM artpiece WHERE (artistID regexp '" . $tag . "'))";
	$as = db_mysqli_query($artist_search);
	$artist_results = [];
	
	// echo "artist search is: " . $as . "</br>";
	if ($as){
		// $results = mysqli_fetch_assoc($as);
		// echo json_encode($results) ;
		
		while($row =  mysqli_fetch_assoc($as)){
			
		// extract the information from each image that we need:
		// imageLoc, artistID, description, tags	
		echo (json_encode($row)) . "</br>";	
		// array_push($artist_results,$json_encode($row));	
		// echo "row is: " . $row["imageLoc"] . " " . $row["artistID"] .  "</br>";
	
		}
	*/
	
	$tag_search = "SELECT imageLoc, artistID, apDesc, apPrice, apID FROM artpiece WHERE apID IN (SELECT DISTINCT apID FROM arttags 
	INNER JOIN taggedpiece ON arttags.artTagID = taggedpiece.artTagID WHERE (tagName REGEXP '" . $tag . "'))"; 
	$ts = db_mysqli_query($tag_search);
	$tag_results = [];
	
	if ($ts){
		while ($row = mysqli_fetch_assoc($ts)){
		// convert the row to an array for JSON encoding
		$temparray = [];
		
		array_push($temparray,$row["imageLoc"]);
		array_push($temparray,$row["artistID"]);
		array_push($temparray,$row["apDesc"]);
		array_push($temparray,$row["apPrice"]);
		$get_tags = "SELECT DISTINCT tagName FROM arttags INNER JOIN taggedpiece ON arttags.artTagID = taggedpiece.artTagID
		 WHERE apID = '" . $row["apID"] . "'";
		$gt = db_mysqli_query($get_tags);
		while ($gtrow = mysqli_fetch_assoc($gt)){
			echo $gtrow['tagName'] . "</br>";
			array_push($temparray,$gtrow['tagName']);	
			}
		array_push($tag_results,$temparray);
		}	


	}
	
	
	

 		

?>