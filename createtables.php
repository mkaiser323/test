<?php
/*

*	File:		createtables.php
*	By:			AKP
*	Date:		2015-11-22
*
*	This script creates the tables for Gallery*
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
	
	// Create Registered User Table
	$sql1 = "create table reguser (
	ruID char(9),
   ruPass varchar(15) not null,
   ruFname varchar(15) not null,
   ruminit varchar(1),
   ruLname varchar(15) not null,
   ruEmail varchar(15) not null,
   ruDateCreated date,
   ruDateModified date,
   # favorites 
   # orderHistory
   artistFlag boolean,
   # artList
   ruPhone integer(10),
   primary key(ruID)
   )";
	if (mysqli_query($dbconn, $sql1)) {   
		echo "Table reguser created OK";
	}
	else {
		echo "Error creating table: " . mysqli_error($dbconn);
	}
	

	// Create Order table    
    
	$sql2 = "create table orders (
	orderID varchar(15),
   orderNum integer(9),
   buyerID char(9),
   sellerID char(9),
   apID Integer(12),
   orderAmount decimal(9,2),
   orderDate date,
   primary key (orderID),
   foreign key (buyerID) references reguser(ruID),
   foreign key (sellerID) references reguser(ruID),
   foreign key (apID) references artpiece(apID)
   )";
   if (mysqli_query($dbconn, $sql2)) {   
   	echo "Table order created successfully";
	} 	else {
	    echo "Error creating table: " . mysqli_error($dbconn);
	}
	// Create ArtPiece table    
    
	$sql3 = "create table artpiece (
	apID Integer(12),
	imageLoc varchar(15),
   apDesc text,
   artistID char(9),
   apUploadDate date,
   apModifyDate date,
   apPrice decimal(9,2),
   apVisible boolean,
   primary key (apID),
   constraint foreign key (artistID) references reguser(ruID) on delete cascade on update cascade
   )";
   if (mysqli_query($dbconn, $sql3)) {   
   	 echo "Table artpiece created successfully";
	} 	else {
	    echo "Error creating table: " . mysqli_error($dbconn);
	}	 
    
	//  Creating another table for tags to help with lookup/normalization:

	$sql4 = "create table artTag (
	artTagID varchar(15),
	apID Integer(12),
   tagName varchar(15),
   primary key (artTagID, apID),
   constraint foreign key (apID) references artpiece(apID) on delete cascade on update cascade
   )";
   if (mysqli_query($dbconn, $sql4)) {   
   	echo "Table artTag created successfully";
	} 	else {
	   echo "Error creating table: " . mysqli_error($dbconn);
	}	
   $sql5 = "create table admin (
	adminID char(9),
   adminPass varchar(15) not null
	)";
	if (mysqli_query($dbconn, $sql5)) {	
		echo "Table admin created successfully";
	} 	else {
		echo "Error creating table: " . mysqli_error($dbconn);
			
	}

	mysqli_close($dbconn);
}


?>