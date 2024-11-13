<?php

// Database connection file
$host = 'localhost';
$dbname = 'drug_database';
$username = 'root'; // Replace with your MySQL username
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "db connected";
}



