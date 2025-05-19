<?php
session_start();
require_once 'config.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Devi essere loggato per votare']);
    exit;
}

// Verifica se la richiesta è di tipo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Metodo non consentito']);
    exit;
}

// Recupera i dati dalla richiesta
$data = json_decode(file_get_contents('php://input'), true);
$song_id = $data['song_id'] ?? null;
$rating = $data['rating'] ?? null;

// Validazione dei dati
if (!$song_id || !is_numeric($rating) || $rating < 0 || $rating > 5) {
    echo json_encode(['success' => false, 'message' => 'Dati non validi']);
    exit;
}

try {
    // Inserisci o aggiorna il voto
    $query = "INSERT INTO ratings (user_id, song_id, rating) 
              VALUES (?, ?, ?) 
              ON DUPLICATE KEY UPDATE rating = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiii", $_SESSION['user_id'], $song_id, $rating, $rating);
    
    if ($stmt->execute()) {
        // Calcola la media dei voti per questa canzone
        $avg_query = "SELECT AVG(rating) as average_rating, COUNT(*) as total_ratings 
                     FROM ratings 
                     WHERE song_id = ?";
        $avg_stmt = $conn->prepare($avg_query);
        $avg_stmt->bind_param("i", $song_id);
        $avg_stmt->execute();
        $result = $avg_stmt->get_result()->fetch_assoc();
        
        echo json_encode([
            'success' => true, 
            'message' => 'Voto registrato con successo',
            'average_rating' => round($result['average_rating'], 1),
            'total_ratings' => $result['total_ratings']
        ]);
    } else {
        throw new Exception("Errore durante il salvataggio del voto");
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?> 