<?php   

$servername = "localhost";
$username = "root";
$password = "mysqlpassword";

$conn = mysqli_connect($servername, $username, $password);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully <br>";

// Create database 
$sql = "CREATE DATABASE userDB";
if( mysqli_query($conn, $sql) ) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}       


// close connection
mysqli_close($conn)
?>