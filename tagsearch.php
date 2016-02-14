<!DOCTYPE HTML>
<html>
<head>
</head>

<body>


<?php

// define test variables and set to empty values
$tag1 = $tag2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$tag1 = test_input($_POST["tag1"]);
	$tag2 = test_input($_POST["tag2"]);
	$tag2 = test_input($_POST["tag2"]);
	
}

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<h2> Test this Stuff </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Tag or Artist 1: <input type ="test" name ="tag1">
Tag or Artist 2: <input type="text" name="tag2">

<br><br>
<input type="submit" name = "submit" value = "Submit">
</form>

<?php
include 'dbscripts.php';
	

echo("Artist results:");
$q1 = "SELECT apID FROM artpiece WHERE (artistID regexp '" . $tag1 . "')";
echo('<br>');
$q2 = "SELECT apID from arttag WHERE (tagName regexp'" . $tag2 . "')"; 


$conn = db_connect();

echo($q1);

echo('<br>');


$result = mysqli_query($conn,$q1);
while($row =  mysqli_fetch_assoc($result)){
	echo $row['apID'] . '<br>';
	}

echo($q2);

echo('<br>');


$result2 = mysqli_query($conn,$q2);
while($row2 = mysqli_fetch_assoc($result2)){
	echo $row2['apID'] . '<br>';
	}

// return:
// path to file
// tags
// price
// artist name
// description

// for loop: make the tag variables


?>

<?php
/*
echo "<h2>What you put:</h2>";
echo $uname;
echo "<br>";
echo $email;
echo "<br>";
echo $fname;
?>
</body>
</html>
*/ 
?>
<?php
/*

*	File:		tagsearch.php
*	By:			AKP
*	Date:		2015-11-22
*
*	This script uses functions to search for tags in the database.
*  Requires dbscripts.php to be in the same directory
*
*
*=====================================
*/
?>
