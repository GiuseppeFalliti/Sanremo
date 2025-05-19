<?php
include 'config.php';

// Verifica se la colonna profile_picture esiste
$check_column = $conn->query("SHOW COLUMNS FROM utenti LIKE 'profile_picture'");

if ($check_column->num_rows === 0) {
    // Aggiungi la colonna profile_picture
    $alter_table = "ALTER TABLE utenti ADD COLUMN profile_picture VARCHAR(255) DEFAULT NULL";
    
    if ($conn->query($alter_table)) {
        echo "Colonna profile_picture aggiunta con successo!\n";
    } else {
        echo "Errore nell'aggiunta della colonna: " . $conn->error . "\n";
    }
} else {
    echo "La colonna profile_picture esiste già\n";
}
?> 