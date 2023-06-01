<?php
$servername = "localhost";
$username = "vtworks_natarajbar";
$password = "vtworks_natarajbar";
$dbname = "vtworks_natarajbar";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
