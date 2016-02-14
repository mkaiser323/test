<?php

include 'dbscripts.php';

echo "I made it to search.php</br>";

class ArtPiece
{
	public $imageLoc;
	public $artistID;
	public $desc;
	public $price;
	public $tags = [];
	public $apID;
	
	function __construct($apID){
		
		$this->apID = $apID;

		// Populate the image location, artist ID, and description: 
				
		$apinfo = "SELECT imageLoc, artistID, apDesc, apPrice FROM artpiece WHERE (apID = '" . $apID . "')";
		$apsearch = db_mysqli_query($apinfo);
		$tempArray = [];
		while ($row = mysqli_fetch_assoc($apsearch)){
			$tempArray = explode(',',$row);
			$imageLoc -> $tempArray[0];
			echo "$imageLoc is: " . $imageLoc . "</br>";
			$artistID -> $tempArray[1];
			$desc -> $tempArray[2]; 
			$price -> $tempArray[3];
		}
		
		// Populate the tags:
		
		$taginfo = "SELECT tagName FROM arttags WHERE EXISTS (SELECT artTagID FROM taggedPiece where apID = '" . $apID . "')";
		$tagsearch = db_mysqli_query($taginfo);
		$tempTags = [];		
		while ($rowt = mysqli_fetch_assoc($tagsearch)){
			$tempTags = explode('.',$row);
			foreach ($tempTags as $t){
				array_push($tags,$t);
			}
		}
				
				
	}
}

function get_results($sql_artpiece_IDs){
		while($row =  mysqli_fetch_assoc($sql_artpiece_IDs) > 0){
		/*	
		// extract the information from each image that we need:
		// imageLoc, artistID, description, tags	
		
			$aptemp = $row['apID'];
			$apquery = "SELECT imageLoc, artistID, apDesc FROM artpiece WHERE (apID = '" . $aptemp "')";
			$aptemp_result = db_mysqli_query($apquery);
			while ($aprow = mysqli_fetch_assoc($aptemp_result)){
				$aparr = explode(',',$myString);
				print_r($aparr);		
			}
		*/
		echo "row is: " . $row;
		$tempAP = new ArtPiece($row);
		echo $tempAp.imageLoc . " imageLoc ";
		
		// Add the ArtPiece (and extraction methods) to the artpieces array:
		array_push($artpieces,$tempAP);
		
		}
		
		foreach ($artpieces as $artp){
			echo $artp.imageLoc + "</br>";
			echo $artp.artistID + "</br>";
			echo $artp.desc + "</br>";
			echo $artp.price + "</br>";
			foreach ($artp.tags as $t){
				echo $t + "</br>";		
			}	
			echo "<br>";
		}
}



if (isset($_POST["submit"])) {
	echo "I made it inside POSTing</br>";
	$tag = test_input($_POST["searchValue"]);
	echo "$tag is: " . $tag . "</br>";
	
	// Display artist results:
	
	// get images for the artist:
	// First, get the artpiece ID:	
	
	
	$artist_search = "SELECT apID FROM artpiece WHERE EXISTS (artistID regexp '" . $tag . "')";
	$as = db_mysqli_query($artist_search);
	$artpieces = [];	
	
	echo "artist search is: " . $as . "</br>";
	if ($as){
		get_results($as);
	}
	

	$tag_search = "SELECT DISTINCT apID FROM artpiece WHERE EXISTS (SELECT DISTINCT apID 
		from taggedpiece WHERE EXISTS (SELECT artTagID, tagName FROM arttags WHERE tagName regexp'" . $tag . "'))"; 
	$ts = db_mysqli_query($tag_search);
	
	echo "doing tag search : </br>";	
	echo "tag_search is: " . $tag_search . "</br>";
	
	if ($ts){
		// get_results($ts);
		while($row =  mysqli_fetch_assoc($ts) > 0){
		
		echo "row is: " . $row;
		$tempAP = new ArtPiece($row);
		echo $tempAP->imageLoc . " imageLoc ";
		
		// Add the ArtPiece (and extraction methods) to the artpieces array:
		array_push($artpieces,$tempAP);
		
		}
		
		foreach ($artpieces as $artp){
			echo $artp->imageLoc + "</br>";
			echo $artp->artistID + "</br>";
			echo $artp->desc + "</br>";
			echo $artp->price + "</br>";
			foreach ($artp->tags as $t){
				echo $t + "</br>";		
			}	
			echo "<br>";
		}	
	}	
	
	if (!$as and !$ts){
		echo "No results found";	
	}	
	
	//
		}
	
	
	
	
	
	
	/* $tag_search = SELECT DISTINCT apID FROM artpiece WHERE EXISTS (SELECT DISTINCT apID
	 from taggedpiece WHERE EXISTS (SELECT artTagID, tagName FROM arttags WHERE tagName regexp R)); 
	*/ $ts = db_mysqli_query($tag_search);
	
	

?>