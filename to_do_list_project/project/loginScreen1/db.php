<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$dbName = "user";
if(!mysqli_select_db($conn, $dbName))
{
    $sql = "CREATE DATABASE $dbName";
    if(($conn->query($sql) === TRUE)){
        echo "Database created successuflly";
    }else{
        echo "An Error Occured" . $conn->error;
    }
}

// //if database already exist

$conn = new mysqli($servername, $username, $password, $dbName);

$sql =" SELECT id FROM Users ";
if(!$conn->query($sql)){
    $sql = "CREATE TABLE Users(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(999), `fullName` VARCHAR(999), `password` VARCHAR(999), group_id INT(6), group_manager INT(6));";
    if($conn->query($sql) === TRUE)
    {
        echo "Table created successfully!";
    }else{
        echo "An Error Occured " . $conn->error;
    }
}
?>
