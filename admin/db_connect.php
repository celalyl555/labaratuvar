<?php
$servername = "185.92.2.129";
$username = "roott";
$password = "S2Ukh3jTsd_4mHug";
$dbname = "eurolab3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
