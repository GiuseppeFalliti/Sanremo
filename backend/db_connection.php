<?php
// Parametri di connessione al database
$host = 'localhost';
$username = 'root';
$password = 'Edoria11!';
$database = 'sanremo';

// Crea la connessione
$conn = new mysqli($host, $username, $password, $database);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Imposta il charset a utf8mb4
$conn->set_charset("utf8mb4");
?> 