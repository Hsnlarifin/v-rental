<?php
$host = 'localhost';
$dbname = 'carrental_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo 'Successfully Connected';
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Fail to Connect!';
    die("ERROR: Could not connect. " . $e->getMessage());
    
}
?>