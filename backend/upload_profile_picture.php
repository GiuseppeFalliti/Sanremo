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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $uploadDir = '../assets/profile_pictures/';
    
    // Crea la directory se non esiste
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            echo json_encode(['success' => false, 'message' => 'Impossibile creare la directory di upload']);
            exit();
        }
    }

    // Verifica i permessi della directory
    if (!is_writable($uploadDir)) {
        echo json_encode(['success' => false, 'message' => 'La directory di upload non ha i permessi di scrittura']);
        exit();
    }

    if (isset($_FILES['profile_picture'])) {
        $file = $_FILES['profile_picture'];
        
        // Verifica se ci sono errori nell'upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errorMessage = match($file['error']) {
                UPLOAD_ERR_INI_SIZE => 'Il file supera il limite di dimensione del server',
                UPLOAD_ERR_FORM_SIZE => 'Il file supera il limite di dimensione del form',
                UPLOAD_ERR_PARTIAL => 'Il file è stato caricato solo parzialmente',
                UPLOAD_ERR_NO_FILE => 'Nessun file è stato caricato',
                UPLOAD_ERR_NO_TMP_DIR => 'Directory temporanea mancante',
                UPLOAD_ERR_CANT_WRITE => 'Impossibile scrivere il file',
                UPLOAD_ERR_EXTENSION => 'Un\'estensione PHP ha fermato l\'upload',
                default => 'Errore sconosciuto durante l\'upload'
            };
            echo json_encode(['success' => false, 'message' => $errorMessage]);
            exit();
        }

        $fileName = $userId . '_' . time() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;
        
        // Verifica il tipo di file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Tipo di file non supportato. Tipi consentiti: JPG, PNG, GIF']);
            exit();
        }

        // Verifica la dimensione del file (max 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'File troppo grande. Dimensione massima: 5MB']);
            exit();
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Aggiorna il percorso dell'immagine nel database
            $relativePath = 'assets/profile_pictures/' . $fileName;
            $stmt = $conn->prepare("UPDATE utenti SET profile_picture = ? WHERE id = ?");
            $stmt->bind_param("si", $relativePath, $userId);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'path' => $relativePath]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Errore nell\'aggiornamento del database: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Errore nell\'upload del file. Verifica i permessi della directory']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Nessun file caricato']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metodo non consentito']);
}
?> 