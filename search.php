<?php
	include 'dbscripts.php';
	
	//$tag = test_input($_POST['searchValue']);
	$tag = test_input($_GET['searchValue']);
	
	$tag_search = "SELECT imageLoc, artistID, apDesc, apPrice, apID FROM artpiece WHERE apID IN (SELECT DISTINCT apID FROM arttags 
	INNER JOIN taggedpiece ON arttags.artTagID = taggedpiece.artTagID WHERE (tagName REGEXP '" . $tag . "'))"; 
	$ts = db_mysqli_query($tag_search);
	$tag_results = [];
	$resultnum = $ts->num_rows;
	$index = 0;
	//echo "num rows is: " . $resultnum . "</br>";

	if ($ts){
		while ($row = mysqli_fetch_assoc($ts)){
		// convert the row to an array for JSON encoding
		$temparray = [];
		array_push($temparray,$row["imageLoc"]);
		array_push($temparray,$row["artistID"]);
		array_push($temparray,$row["apDesc"]);
		array_push($temparray,$row["apPrice"]);
		array_push($temparray,$row["apID"]);
		$get_tags = "SELECT DISTINCT tagName FROM arttags INNER JOIN taggedpiece ON arttags.artTagID = taggedpiece.artTagID
		 WHERE apID = '" . $row["apID"] . "'";
		$gt = db_mysqli_query($get_tags);
		while ($gtrow = mysqli_fetch_assoc($gt)){
			array_push($temparray,$gtrow['tagName']);
			}
		//echo $temparray[0] . " is temparray[0]</br>";
		
		/*echo $tag_results[0] . " is tagresults[0]</br>";*/
		echo "{";
		$length = count($temparray);
		$i = 0;
		foreach ($temparray as $var) {
			switch ($i) {
				case 0:
				$attribute = "url";
				$imageLoc = $var;
					break;
				case 1:
				$attribute = "artist";
				$artistID = $var;
					break;
				case 2:
				$attribute = "description";
				$apDesc = $var;

					break;
				case 3:
				$attribute = "price";
				$apPrice = $var;
					break;
				case 4:
				$attribute = "apID";
				break;

			}

			//before tags:
			if($i<5){
				echo '"' . $attribute . '":"' . $var . '"';
				if ($i < 4){
					echo ",";
				}
			} else {

			//tags:
			if ($i == 5){echo ',"tags":[';}

			$num_tags = $length - 5;
				echo '{"tag":"' . $var . '"}';
				if($i < $length - 1){
					echo ',';
				}

			if ($i == $length - 1){echo ']';}
			}
			$i++;
		}

		echo "}";
		if ($index < $resultnum - 1) {
			# code...
			echo "#";
		}
		$index++;



		}
	}

		

		/*echo "{";
		$length = count($temparray);
		$i = 0;
		foreach ($temparray as $var) {
			switch ($i) {
				case 0:
				$attribute = "url";
				$imageLoc = $var;
					break;
				case 1:
				$attribute = "artist";
				$artistID = $var;
					break;
				case 2:
				$attribute = "description";
				$apDesc = $var;

					break;
				case 3:
				$attribute = "price";
				$apPrice = $var;
					break;
				case 4:
				$attribute = "apID";
				break;

			}

			//before tags:
			if($i<5){
				echo '"' . $attribute . '":"' . $var . '"';
				if ($i < 4){
					echo ",";
				}
			} else {

			//tags:
			if ($i == 5){echo ',"tags":[';}

			$num_tags = $length - 5;
				echo '{"tag":"' . $var . '"}';
				if($i < $length - 1){
					echo ',';
				}

			if ($i == $length - 1){echo ']';}
			}
			$i++;
		}

		echo "}";*/
?>
