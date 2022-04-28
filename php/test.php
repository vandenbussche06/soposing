<?php
$conn = new mysqli("mysql", "root", ".sweetpwd.", "dbs2172565");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nom_categorie     FROM categorie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo $row['nom_categorie']."<br>";
	}
} else {
	echo "0 results";
}
$conn->close();