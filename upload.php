<?php

// Link to our useful scripts file:

include 'dbscripts.php';



if (isset($_POST["submit"])) {

	// Set up the target directory and temporary file name

	$targetdir = "images/";
	$temp = explode('.',$_FILES["file"]["name"]);
	$tfname = $targetdir . uniqID() . "." . end($temp);
	$newfname = $tfname;
 
	// Before we do anything with the database, check that the file's size and type are valid:
	
	$validFile = 1;
	 
	$fileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
		
	if($fileType !="jpg" && $fileType !="png" && $fileType !="gif" && $fileType !="jpeg"){
		// echo "Must be of file types JPG, JPEG, PNG, or GIF.";
		$validFile = 0;
	}	 
	if ($_FILES["file"]["size"] > 10000000){
		// echo "Files must be under 10 MB.";
		$validFile = 0;
	}
	if ($validFile = 0){
		// echo "Upload failed.  Please try again!";
		}
	else {
		// Set up the database field variables: 
	
		$desc = db_realesc($_POST['description']);
		$price = floatval($_POST['price']);
		$tags = $_POST['tag'];
		// Note: need a way to get the artist ID from the view
		$artistID = "932837";
		$apID = uniqid();
	  
		// Add the information to the database:  	
	
		// First, add the art piece:
	
			$sqlap = "INSERT INTO artpiece (apID, imageLoc, apDesc, artistID, apUploadDate, apModifyDate, apPrice, apVisible)
				VALUES ('" . $apID . "','" . $newfname . "'," . $desc . "," . $artistID . ",DEFAULT,DEFAULT," . $price . ",DEFAULT)";
			// echo($sqlap);
			db_mysqli_query($sqlap);
	
		// Then, add the art tags:
	
		foreach ($tags as $key => $value){
			$value = db_realesc($value);
			$sqlTagExists = "SELECT artTagID FROM arttags WHERE (tagName = " . $value . ")";
			// echo $sqlTagExists . "</br>";
			$tagExistsResult = db_mysqli_query($sqlTagExists);
	
			if (mysqli_num_rows(db_mysqli_query($sqlTagExists)) <= 0){
				$sqlNewTag = "INSERT INTO arttags (artTagID, tagName) VALUES (DEFAULT," . $value . ")";
				db_mysqli_query($sqlNewTag);
				// Get the index of the new tag:
				$tagExistsResult = db_mysqli_query($sqlTagExists);	
			}
		
		// Locate the tagNum and associate it with the art piece:
	
			while($row =  mysqli_fetch_assoc($tagExistsResult)){
				$tagNum =  $row['artTagID'] . '<br>';
			}
			
		// Associate the artTagID with the art piece in taggedpiece:
	
			$sqlTagPiece = "INSERT INTO taggedpiece (apID, artTagID)
			 VALUES ('" . $apID . "','" . $tagNum . "')";
			db_mysqli_query($sqlTagPiece);
		}
		
		
		
		
		// Upload the file:
	  	
	  	
	 	if (move_uploaded_file($_FILES["file"]["tmp_name"], $newfname)) {
	 	   	// echo "The file ". basename( $_FILES["file"]["name"],$newfname). " has been uploaded.</br>";
	 	   	readfile('success.html');
	   } else {
	   	// echo "Sorry, there was an error uploading your file.</br>";
	
	   	// If not uploaded, delete the database entries for the art piece and the taggedpiece associations
	   	// (the tags themselves can stay as it can be reused for other art pieces)
	
	   	$sqldel1 = "DELETE * FROM taggedpiece WHERE (apID = " . $apID . ")";
	   	$sqldel2 = "DELETE * FROM artpiece WHERE (apID = " . $apID . ")"; 
	   	db_mysqli_query($sqldel1);
	   	db_mysqli_query($sqldel2);
	   	readfile('fail.html');
	   }
	}  

}
?>