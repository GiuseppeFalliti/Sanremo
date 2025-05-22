<?php
session_start();
require_once 'config.php';

if (!isset($_GET['song_id'])) {
    echo json_encode(['success' => false, 'message' => 'ID canzone mancante']);
    exit;
}

$song_id = $_GET['song_id'];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

try {
    // Calcola la media dei voti e il numero totale di voti
    $query = "SELECT AVG(rating) as average_rating, COUNT(*) as total_ratings 
              FROM ratings 
              WHERE song_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $song_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    // Recupera il voto dell'utente corrente se è loggato
    $user_rating = null;
    if ($user_id) {
        $user_query = "SELECT rating FROM ratings WHERE song_id = ? AND user_id = ?";
        $user_stmt = $conn->prepare($user_query);
        $user_stmt->bind_param("ii", $song_id, $user_id);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result()->fetch_assoc();
        if ($user_result) {
            $user_rating = $user_result['rating'];
        }
    }
    
    //metodo per inviare i risultati in formato json al frontend
    echo json_encode([
        'success' => true,
        'average_rating' => $result['average_rating'] ? round($result['average_rating'], 1) : 0,
        'total_ratings' => $result['total_ratings'],
        'user_rating' => $user_rating
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?> 