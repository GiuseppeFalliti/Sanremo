<?php
$host = "localhost";
$dbname = "sanremo_rating";
$username = "root";
$password = "";

// Creazione connessione
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>