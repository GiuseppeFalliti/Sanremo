<?php
session_start();
include 'config.php';

// Abilita la visualizzazione degli errori per il debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utente non autenticato']);
    exit();
}

$userId = $_SESSION['user_id'];

try {
    // Recupera il percorso della foto profilo attuale
    $stmt = $conn->prepare("SELECT profile_picture FROM utenti WHERE id = ?");
    if (!$stmt) {
        throw new Exception("Errore nella preparazione della query: " . $conn->error);
    }
    
    $stmt->bind_param("i", $userId);
    if (!$stmt->execute()) {
        throw new Exception("Errore nell'esecuzione della query: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $user['profile_picture']) {
        // Rimuovi il file fisico se esiste
        $filePath = '../' . $user['profile_picture'];
        if (file_exists($filePath)) {
            if (!unlink($filePath)) {
                throw new Exception("Impossibile eliminare il file: " . $filePath);
            }
        }
    }

    // Aggiorna il database rimuovendo il percorso della foto
    $updateStmt = $conn->prepare("UPDATE utenti SET profile_picture = NULL WHERE id = ?");
    if (!$updateStmt) {
        throw new Exception("Errore nella preparazione della query di aggiornamento: " . $conn->error);
    }
    
    $updateStmt->bind_param("i", $userId);
    if (!$updateStmt->execute()) {
        throw new Exception("Errore nell'aggiornamento del database: " . $updateStmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Foto profilo rimossa con successo']);
} catch (Exception $e) {
    error_log("Errore nella rimozione della foto profilo: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore: ' . $e->getMessage()]);
}
?> 