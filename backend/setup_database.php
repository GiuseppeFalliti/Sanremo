<?php
require_once 'config.php';

// Query per creare le tabelle
$queries = [
    //Tabella utenti
    "CREATE TABLE IF NOT EXISTS utenti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY unique_username (username)
    )",

    //Tabella artisti
    "CREATE TABLE IF NOT EXISTS artisti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        UNIQUE KEY unique_nome (nome)
    )",

    //Tabella canzoni
    "CREATE TABLE IF NOT EXISTS canzoni (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titolo VARCHAR(50) NOT NULL,
        anno INT(11) NOT NULL,
        artista_id INT(11) NOT NULL,
        FOREIGN KEY (artista_id) REFERENCES artisti(id) ON DELETE CASCADE 
    )",
    
    // Tabella ratings per i voti delle canzoni
    "CREATE TABLE IF NOT EXISTS ratings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        song_id INT NOT NULL,
        rating INT NOT NULL CHECK (rating >= 0 AND rating <= 5),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES utenti(id) ON DELETE CASCADE,
        FOREIGN KEY (song_id) REFERENCES canzoni(id) ON DELETE CASCADE,
        UNIQUE KEY unique_rating (user_id, song_id)
    )"
];

// Esegui le query
foreach ($queries as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Query eseguita con successo: " . substr($query, 0, 50) . "...<br>";
    } else {
        echo "Errore nell'esecuzione della query: " . $conn->error . "<br>";
    }
}

$conn->close();
echo "Setup del database completato!";
?> 