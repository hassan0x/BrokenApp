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

input[type=password], select {
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

<h2>Login 1</h2>

<form action="">
  Solve This:<br>
  <input type="text" name="user">
  <br>
  <input type="password" name="password">
  <br>
  <input type="submit" value="Login">
</form>

<?php
if (array_key_exists ("user", $_GET) && $_GET["user"] != NULL && $_GET["user"] != '') {

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
	
	$user = $_GET['user'];
	$password = MD5($_GET['password']);
	
	$sql = "SELECT * FROM users where user = '" .$user. "' and password = '" .$password. "';";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
		    echo "id: " . $row["user_id"] . "<br>"; 
			echo "First Name: " . $row["first_name"] . "<br>";
			echo "Last Name: " . $row["last_name"] . "<br>";
			echo "Username: " . $row["user"] . "<br>";
			echo "Password: " . $row["password"] . "<br>";
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
