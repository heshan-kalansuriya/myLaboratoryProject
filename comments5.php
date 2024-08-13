<?php
$servername = "localhost"; 
$username = "root"; 
$password = "12345"; 
$dbname = "myDB"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$anycomment = $_POST['anycomment'];


$stmt = $conn->prepare("INSERT INTO comments (name, comment) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $anycomment);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>