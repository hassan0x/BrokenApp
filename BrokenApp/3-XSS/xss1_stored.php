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

<h2>XSS 1 Stored</h2>

<form action="">
  Solve This:<br>
  <input type="text" name="solve1" value="Comment">
  <br>
  <input type="text" name="solve2" value="Name">
  <br>
  <input type="submit" value="Submit">
</form>

<?php

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
	$sql = "SELECT * FROM posts;";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
		    echo "ID: " . $row["comment_id"] . "<br>"; 
			echo "Comment: " . $row["comment"] . "<br>"; 
			echo "Name: " . $row["name"] . "<br>";
		}
	}
	else {
		echo "0 results";
	}

	$conn->close();

if (array_key_exists ("solve1", $_GET) && $_GET["solve1"] != NULL && $_GET["solve1"] != '') {
    
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
	$sql = "INSERT INTO posts (comment, name) VALUES ('" .$_GET["solve1"]. "','" .$_GET["solve2"]. "');";
	if ($conn->query($sql) === TRUE) {
		header('Location: ' . "http://127.0.0.1/BrokenApp/3-XSS/xss1_stored.php");
	} else {
		echo "Error Inserting data: " . $conn->error . " \n";
	}

	

	$conn->close();
    
}
?>

</body>
</html>
