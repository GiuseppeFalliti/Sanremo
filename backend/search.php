<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

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

session_start();
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['query'])) {
    $searchTerm = trim($_GET['query']);
    $search = '%' . strtolower($searchTerm) . '%';
    $results = array();
    
    try {
        // Query per le canzoni
        $stmtSongs = $conn->prepare("
        SELECT 
            c.id,
            TRIM(c.titolo) as titolo, 
            a.nome as artista,
            c.anno
        FROM canzoni c
        INNER JOIN artisti a ON c.artista_id = a.id
        WHERE LOWER(TRIM(c.titolo)) LIKE LOWER(:search)
        ORDER BY c.anno DESC
        LIMIT 5
    ");
        $stmtSongs->execute(['search' => $search]);
        $songs = $stmtSongs->fetchAll(PDO::FETCH_ASSOC);

        // Query per gli artisti
        $stmtArtists = $conn->prepare("
            SELECT DISTINCT
                a.id,
                a.nome
            FROM artisti a
            WHERE LOWER(a.nome) LIKE LOWER(:search)
            LIMIT 3
        ");
        $stmtArtists->execute(['search' => $search]);
        $artists = $stmtArtists->fetchAll(PDO::FETCH_ASSOC);

        // Processa risultati
        foreach ($artists as $artist) {
            $stmt = $conn->prepare("
                SELECT titolo 
                FROM canzoni 
                WHERE artista_id = :artist_id 
                ORDER BY anno DESC 
                LIMIT 2
            ");
            $stmt->execute(['artist_id' => $artist['id']]);
            $artistSongs = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            $results[] = [
                'type' => 'artist',
                'id' => $artist['id'],
                'name' => $artist['nome'],
                'songs' => $artistSongs
            ];
        }

        foreach ($songs as $song) {
            $results[] = [
                'type' => 'song',
                'id' => $song['id'],
                'title' => $song['titolo'],
                'artist' => $song['artista'],
                'year' => $song['anno']
            ];
        }

        echo json_encode([
            'success' => true, 
            'results' => $results
        ]);

    } catch (PDOException $e) {
        echo json_encode([
            'success' => false, 
            'error' => 'Errore database: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'error' => 'Query mancante'
    ]);
}