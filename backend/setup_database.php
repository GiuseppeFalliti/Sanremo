<?php
require_once 'config.php';

// Query per creare le tabelle
$queries = [
    // Tabella favorites
    "CREATE TABLE IF NOT EXISTS favorites (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        song_id INT NOT NULL,
        created_at DATETIME NOT NULL,
        FOREIGN KEY (user_id) REFERENCES utenti(id) ON DELETE CASCADE,
        FOREIGN KEY (song_id) REFERENCES canzoni(id) ON DELETE CASCADE,
        UNIQUE KEY unique_favorite (user_id, song_id)
    )",
    
    // Tabella favorite_artists
    "CREATE TABLE IF NOT EXISTS favorite_artists (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        artist_id INT NOT NULL,
        created_at DATETIME NOT NULL,
        FOREIGN KEY (user_id) REFERENCES utenti(id) ON DELETE CASCADE,
        FOREIGN KEY (artist_id) REFERENCES artisti(id) ON DELETE CASCADE,
        UNIQUE KEY unique_favorite_artist (user_id, artist_id)
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