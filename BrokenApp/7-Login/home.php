<html>
<style>
input[type=text], select {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h2>Your Personal Home Page!</h2>

<?php

session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    $servername = "localhost";
	$username = "root";
	$password = "BrokenApp";
	$dbname = "BrokenApp";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error) . " \n";
	}

	$sql = "SELECT * FROM users where user_id = " .$_SESSION['user_id']. ";";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
		    echo "id: " . $row["user_id"] . "<br>"; 
			echo "First Name: " . $row["first_name"] . "<br>";
			echo "Last Name: " . $row["last_name"] . "<br>";
			echo "Username: " . $row["user"] . "<br>";
			echo "Password: " . $row["password"] . "<br><br>";
		}
	}
	else {
		echo "0 results";
	}

	$conn->close();

} else {
    // Redirect them to the login page
    header("Location: http://127.0.0.1/BrokenApp/7-Login/login2.php");
}

?>


<form action="">
  Account Number: <br>
  <input type="text" name="solve1">
  <br>
  Money Amount: <br>
  <input type="text" name="solve2">
  <br>
  <input type="submit" value="Submit">
</form>

<?php
if (array_key_exists ("solve1", $_GET) && $_GET["solve1"] != NULL && $_GET["solve1"] != '') {
    echo 'Hello ' . $_SESSION['user'] . ' you have transfered this amount: ' . $_GET['solve2'] . ' to this account: ' . $_GET['solve1'];
}
?>

</body>
</html>
