<?php
session_start();
header('Content-Type: application/json');

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Devi essere loggato per aggiungere ai preferiti'
    ]);
    exit;
}

// Includi configurazione database
include 'config.php';

// Verifica se sono stati forniti i parametri necessari
if (!isset($_POST['song_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID canzone mancante'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];
$song_id = $_POST['song_id'];

try {
    // Verifica se la canzone è già nei preferiti
    $check_query = "SELECT id FROM preferiti WHERE user_id = ? AND song_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ii", $user_id, $song_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Rimuovi dai preferiti
        $delete_query = "DELETE FROM preferiti WHERE user_id = ? AND song_id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("ii", $user_id, $song_id);
        $delete_stmt->execute();
        
        echo json_encode([
            'success' => true,
            'message' => 'Canzone rimossa dai preferiti',
            'is_favorite' => false
        ]);
    } else {
        // Aggiungi ai preferiti
        $insert_query = "INSERT INTO preferiti (user_id, song_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ii", $user_id, $song_id);
        $insert_stmt->execute();
        
        echo json_encode([
            'success' => true,
            'message' => 'Canzone aggiunta ai preferiti',
            'is_favorite' => true
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Errore durante l\'operazione: ' . $e->getMessage()
    ]);
} 