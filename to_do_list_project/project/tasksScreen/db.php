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
$dbName = "Tasks";
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

$sql =" SELECT id FROM Tasks ";
if(!$conn->query($sql)){
    $sql = "CREATE TABLE Tasks(`email` VARCHAR(999), id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `name_task` VARCHAR(999), `writer` VARCHAR(999), `date` VARCHAR(999), `group` VARCHAR(999));";
    if($conn->query($sql) === TRUE)
    {
        echo "Table created successfully!";
    }else{
        echo "An Error Occured " . $conn->error;
    }
}
?>
