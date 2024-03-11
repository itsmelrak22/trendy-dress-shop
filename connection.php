<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "trendy"; //Change this one base on the database name you have

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// try {
//     $conn = new PDO("mysql:host=$servername;dbname=u916113351_ecomm_store", "u916113351_root", "Trendydresshopsystem@2024");
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
