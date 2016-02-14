<?php
/*

*	File:		dbscripts.php
*	By:			AKP
*	Date:		2015-11-22
*
*	This script gives functions to use with the Gallery db*
*
*
*=====================================
*/

// Make a connection:

function db_connect(){
	
	
	// We only need one connection	
	
	$connection = false;
	
	// Try to connect:
	// Load the configuration file
	$config = parse_ini_file('c:/xampp/htdocs/gallery/config.ini');
	$connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbasename']);
	
	// If connection fails, handle it:
	if($connection === false) {
		// show error
		return mysqli_connect_error();
	}
	return $connection;
}

// Do a query:

function db_mysqli_query($query) {
	$conn = db_connect();
	
	$result = mysqli_query($conn,$query);
	
	return $result;
}

// Use the real escape filter to try to catch bad/harmful inputs

function db_realesc($value) {
	$conn = db_connect();
	return "'" . mysqli_real_escape_string($conn,$value) . "'";
}

// $_FILES sucks to use - use this to make it better

function easierFiles($files) 
{
	$newFiles = [];
	foreach($files as $attribute => $values){
		foreach ($values as $key => $somevalue){
			$newFiles[$key][$attribute] = $somevalue;
		}
	}
	return $newFiles;
}
	
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


?>