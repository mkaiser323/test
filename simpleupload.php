<?php
/*
 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    */
 $targetdir = "images/";
 $temp = explode('.',$_FILES["file"]["name"]);
 $newfname = $targetdir . time() . "." . end($temp);
 if (move_uploaded_file($_FILES["file"]["tmp_name"], $newfname)) {

   	echo "The file ". basename( $_FILES["file"]["name"],$newfname). " has been uploaded.</br>";
   } else {
   	echo "Sorry, there was an error uploading your file.</br>";
   	// If not uploaded, delete the database entry
  }
  $desc = $_POST['description'];
  echo "Description is: " . $desc . "</br>";
  $price = $_POST['price'];
  echo "Price is: " . $price . "</br>";
  $tags = $_POST['tag'];
  foreach ($tags as $key => $value){
		echo "key is: " . $key . " and value is " . $value . "</br>";  	
  	}
?>
