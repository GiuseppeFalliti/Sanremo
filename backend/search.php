<?php
// Configurazione degli header CORS per permettere richieste cross-origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json'); // Imposta il tipo di risposta come JSON

// Registra una funzione che viene eseguita alla chiusura dello script
// Gestisce gli errori fatali e li converte in risposte JSON
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Errore interno del server: ' . $error['message']
        ]);
    }
});

// Inizializza la sessione PHP
session_start();

include 'config.php';

// Configurazione della gestione errori
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se è stata fornita una query di ricerca
if (isset($_GET['query'])) {
    // Pulisce e formatta il termine di ricerca
    $searchTerm = trim($_GET['query']);
    $search = '%' . strtolower($searchTerm) . '%';
    // Array per contenere i risultati della ricerca
    $results = array();
    
    try {
        // Query per cercare le canzoni nel database
        // Recupera ID, titolo, nome artista e anno
        // Unisce le tabelle canzoni e artisti
        $querySongs = "SELECT 
            c.id,
            TRIM(c.titolo) as titolo, 
            a.nome as artista,
            c.anno
        FROM canzoni c
        INNER JOIN artisti a ON c.artista_id = a.id
        WHERE LOWER(TRIM(c.titolo)) LIKE ?
        ORDER BY c.anno DESC
        LIMIT 5";
        
        // Prepara ed esegue la query per le canzoni
        $stmtSongs = $conn->prepare($querySongs);
        $stmtSongs->bind_param("s", $search);
        $stmtSongs->execute();
        $resultSongs = $stmtSongs->get_result();
        $songs = $resultSongs->fetch_all(MYSQLI_ASSOC);

        // Query per cercare gli artisti nel database
        // Recupera ID e nome degli artisti
        $queryArtists = "SELECT DISTINCT
            a.id,
            a.nome
        FROM artisti a
        WHERE LOWER(a.nome) LIKE ?
        LIMIT 3";
        
        // Prepara ed esegue la query per gli artisti
        $stmtArtists = $conn->prepare($queryArtists);
        $stmtArtists->bind_param("s", $search);
        $stmtArtists->execute();
        $resultArtists = $stmtArtists->get_result();
        $artists = $resultArtists->fetch_all(MYSQLI_ASSOC);

        // Per ogni artista trovato, cerca le sue canzoni più recenti
        foreach ($artists as $artist) {
            // Query per recuperare le ultime 2 canzoni dell'artista
            $queryArtistSongs = "SELECT titolo 
                FROM canzoni 
                WHERE artista_id = ? 
                ORDER BY anno DESC 
                LIMIT 2";
            
            // Prepara ed esegue la query per le canzoni dell'artista
            $stmtArtistSongs = $conn->prepare($queryArtistSongs);
            $stmtArtistSongs->bind_param("i", $artist['id']);
            $stmtArtistSongs->execute();
            $resultArtistSongs = $stmtArtistSongs->get_result();
            $artistSongs = [];
            while ($row = $resultArtistSongs->fetch_array(MYSQLI_NUM)) {
                $artistSongs[] = $row[0]; //aggiunge il titolo della canzone all'array 
            }
            
            // Formatta i risultati degli artisti
            $results[] = [
                'type' => 'artist',
                'id' => $artist['id'],
                'name' => $artist['nome'],
                'songs' => $artistSongs
            ];
        }

        // Formatta i risultati delle canzoni
        foreach ($songs as $song) {
            $results[] = [
                'type' => 'song',
                'id' => $song['id'],
                'title' => $song['titolo'],
                'artist' => $song['artista'],
                'year' => $song['anno']
            ];
        }

        // Restituisce i risultati in formato JSON
        echo json_encode([
            'success' => true, 
            'results' => $results
        ]);

    } catch (Exception $e) {
        // Gestisce gli errori del database
        echo json_encode([
            'success' => false, 
            'error' => 'Errore database: ' . $e->getMessage()
        ]);
    }
} else {
    // Restituisce un errore se non è stata fornita una query
    echo json_encode([
        'success' => false, 
        'error' => 'Query mancante'
    ]);
}