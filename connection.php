<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "ecom_store"; //Change this one base on the database name you have

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
