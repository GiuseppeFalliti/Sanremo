<?php
include 'config.php';

// Query per creare le tabelle
$queries = [
    //Tabella utenti
    "CREATE TABLE IF NOT EXISTS utenti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )",

    //Tabella artisti
    "CREATE TABLE IF NOT EXISTS artisti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL
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
        FOREIGN KEY (song_id) REFERENCES canzoni(id) ON DELETE CASCADE
    )"
];

?> 