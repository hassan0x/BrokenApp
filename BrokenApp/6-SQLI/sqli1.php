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

<h2>SQL Injection 1</h2>

<form action="">
  Solve This:<br>
  <input type="text" name="solve">
  <br>
  <input type="submit" value="Submit">
</form>

<?php
if (array_key_exists ("solve", $_GET) && $_GET["solve"] != NULL && $_GET["solve"] != '') {

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
	
	//Query
	$sql = "SELECT first_name, last_name FROM users where user_id = '" . $_GET['solve'] . "';";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
		    echo "id: " . $_GET['solve'] . "<br>"; 
			echo "First Name: " . $row["first_name"] . "<br>"; 
			echo "Last Name: " . $row["last_name"] . "<br>";
		}
	}
	else {
		echo "0 results";
	}

	$conn->close();
}
?>

</body>
</html>
