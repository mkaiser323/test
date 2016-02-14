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

function db_connect(){
	
	// We only need one connection	
	$connection = false;
	
	// Try to connect:
	// Load the configuration file
	$config = parse_ini_file('config.ini');
	$connection = mysqli_connect('localhost:8889',$config['username'],$config['password'],$config['dbasename']);
		
	// If connection fails, handle it:
	if($connection === false) {
		// show error
		echo "It doesn't work";
		return mysqli_connect_error();
	}
	return $connection;
}

function db_mysqli_query($query) {
	$conn = db_connect();
	
	$result = mysqli_query($conn,$query);
	
	mysqli_close($conn);

	return $result;
}

function db_realesc($value) {
	$conn = db_connect();
	$return_value = "'" . mysqli_real_escape_string($conn,$value) . "'";
	mysqli_close($conn);
	return $return_value;
}
	

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





/*$testing = db_connect();
 if( $testing ) {
 	echo "It works";	
 } else {
 	echo "It doenst works";	
 }*/
 



?>