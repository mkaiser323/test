<?php
/*

*	File:		insertdata.php
*	By:		
*	Date:		2015-11-22
*
*	This script *
*
*
*=====================================
*/






{ // Connect and Test MySQL and specific DB (return $dbSuccess = T/F)
				
			$hostname = "localhost";
			$username = "root";
			$password = "";
			$databaseName = "gallery";

			$dbconn = new mysqli($hostname, $username, $password, $databaseName);
			
			
			if ($dbconn->connect_error) {
				trigger_error('Database connection failed: ' . mysqli_connect_error(), E_USER_ERROR);
			}
}  

//	 Execute code ONLY if connections were successful 	
if ($dbconn) {

	 $sql1 = "INSERT INTO reguser (ruID, ruPass, ruFname, ruminit, ruLname, ruDateCreated, ruDateModified, artistFlag, ruPhone)
	 	VALUES ('thorny','asdf1234*','Briar','T','Rose',CURDATE(),CURDATE(),'FALSE',5556667777)";

	// Check for successful insertion: 
	if ($dbconn->mysqli_query($sql1) == TRUE){
		echo "New record created successfully";
	}
	else {
		echo "Error: " . $sql1 . "<br>" . $dbconn->error;
		}
	$sql2 = "INSERT INTO reguser (	ruID, ruPass, ruFname, ruminit, ruLname, ruDateCreated, ruDateModified, artistFlag, ruPhone)
	VALUES ('thorn',asdf1234*','Bria','L','Ros',CURDATE(),CURDATE(),'TRUE',1112223333)";
	
	if ($dbconn->mysqli_query($sql2) == TRUE) {
		echo "New record created successfully";
	}
	else{
		echo "Erorr: " . $sql2 . "<br>" . $dbconn->error;
	}
	function db_filter($value){
		$connection = db_connect();
			
	
	
/*	
	$sql3 = "INSERT INTO artpiece (apID, imageLoc, apDesc, artistID, apUploadDate, apModifyDate, apPrice, apVisible)
	VALUES ('111111111111','
	
		*/
	$dbconn->close();
			
}
?>