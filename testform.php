<!DOCTYPE HTML>
<html>
<head>
</head>

<body>


<?php

// define test variables and set to empty values
$uname = $email = $fname = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$uname = test_input($_POST["uname"]);
	$email = test_input($_POST["email"]);
	$fname = test_input($_POST["fname"]);
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
UserName: <input type ="test" name ="uname">
Email: <input type="text" name="email">
First Name: <input type = "text" name="fname">
<br><br>
<input type="submit" name = "submit" value = "Submit">
</form>

<?php
echo "<h2>What you put:</h2>";
echo $uname;
echo "<br>";
echo $email;
echo "<br>";
echo $fname;
?>
</body>
</html>




