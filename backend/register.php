<?php
// Inizia o riprende una sessione PHP esistente
session_start();
// Includi il file di configurazione con le credenziali del database
include 'config.php';

// Configurazione della gestione degli errori PHP
// Mostra tutti i tipi di errori per il debug
error_reporting(E_ALL);
// Abilita la visualizzazione degli errori nel browser
ini_set('display_errors', 1);

// Verifica se la richiesta è di tipo POST e se sono presenti tutti i campi necessari
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    // Rimuove gli spazi all'inizio e alla fine delle stringhe inserite
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Verifica che nessun campo sia vuoto dopo il trim
    if (empty($username) || empty($email) || empty($password)) {
        header("Location: ../register.php?error=" . urlencode("Compila tutti i campi!"));
        exit();
    }

    try {
        // Verifica se esiste già un utente con lo stesso username o email
        // Utilizza prepared statement per prevenire SQL injection
        $stmt = $conn->prepare("SELECT id FROM utenti WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Se trova corrispondenze nel database, l'utente esiste già
        if ($result->num_rows > 0) {
            header("Location: ../register.php?error=" . urlencode("Username o email già in uso!"));
            exit();
        }

        // Cripta la password usando l'algoritmo di hashing più sicuro disponibile
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepara la query per inserire il nuovo utente
        // Utilizza prepared statement per l'inserimento sicuro dei dati
        $stmt = $conn->prepare("INSERT INTO utenti (username, email, password) VALUES (?, ?, ?)");
        
        // Verifica se la preparazione della query è fallita
        if ($stmt === false) {
            header("Location: ../register.php?error=" . urlencode("Errore di sistema: " . $conn->error));
            exit();
        }

        // Associa i parametri alla query preparata
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        // Esegue l'inserimento del nuovo utente
        if ($stmt->execute()) {
            // Recupera l'ID autogenerato dell'utente appena inserito
            $user_id = $conn->insert_id;
            
            // Inizializza la sessione dell'utente con i suoi dati
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            
            // Reindirizza l'utente alla homepage dopo la registrazione
            header("Location: ../index.php");
            exit();
        } else {
            // Gestisce gli errori durante l'esecuzione della query
            header("Location: ../register.php?error=" . urlencode("Errore nella registrazione: " . $stmt->error));
            exit();
        }
        
    } catch (Exception $e) {
        // Cattura e gestisce qualsiasi errore imprevisto durante l'esecuzione
        header("Location: ../register.php?error=" . urlencode("Errore nel database: " . $e->getMessage()));
        exit();
    }
}

// Se qualcuno tenta di accedere direttamente a questo file senza una richiesta POST
// viene reindirizzato alla pagina di registrazione
header("Location: ../register.php");
exit();
?>