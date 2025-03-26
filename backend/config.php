<?php
$host = "localhost";
$dbname = "sanremo";
$username = "root";
$password = "giuse";

try {
    // Connessione al database
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    die("Errore di connessione al database: " . $e->getMessage());
}
?>