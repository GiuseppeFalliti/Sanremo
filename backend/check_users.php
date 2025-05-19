<?php
require_once 'config.php';

// Abilita la visualizzazione degli errori
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Verifica se la tabella utenti esiste
    $check_table = "SHOW TABLES LIKE 'utenti'";
    $result = $conn->query($check_table);
    
    if ($result->num_rows === 0) {
        echo "La tabella utenti non esiste!\n";
    } else {
        echo "La tabella utenti esiste.\n";
        
        // Verifica la struttura della tabella
        $check_structure = "DESCRIBE utenti";
        $structure = $conn->query($check_structure);
        
        echo "\nStruttura della tabella utenti:\n";
        while ($row = $structure->fetch_assoc()) {
            echo "Campo: " . $row['Field'] . " - Tipo: " . $row['Type'] . " - Null: " . $row['Null'] . " - Chiave: " . $row['Key'] . "\n";
        }
        
        // Verifica i dati nella tabella
        $check_data = "SELECT id, username, email FROM utenti";
        $data = $conn->query($check_data);
        
        echo "\nDati nella tabella utenti:\n";
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                echo "ID: " . $row['id'] . " - Username: " . $row['username'] . " - Email: " . $row['email'] . "\n";
            }
        } else {
            echo "Nessun utente trovato nella tabella.\n";
        }
    }

} catch (Exception $e) {
    echo "Errore: " . $e->getMessage() . "\n";
}

$conn->close();
?> 