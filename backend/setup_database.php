<?php
require_once 'config.php';

// Query per creare le tabelle
$queries = [   
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