<?php
/*

*	File:		creategallery.php
*	By:			TMIT
*	Date:		2015-11-22
*
*	This script starts the server and adds the schema to it*
*
*
*=====================================
*/

{ // Connect and Test MySQL and specific DB (return $dbSuccess = T/F)
				
			$DBServer = 'localhost';
			$DBUser = 'root';
			$DBPass = '';

			$conn = new mysqli($DBServer, $DBUser, $DBPass);

			if ($conn->connect_error){
				trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
			}
}  

//	 Execute code ONLY if connections were successful 	
if ($conn) {
	$sql = "CREATE DATABASE gallery";
	if ($conn->query($sql) == TRUE) {
		echo "Database created successfully";
		}
		else{
			echo "Error creating database: " . $conn->error;
			}
			
	}
			
	$conn -> close();	
			






?>