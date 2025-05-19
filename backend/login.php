<?php

// Avvia o riprende una sessione PHP
session_start();

// Includi il file di configurazione che contiene le credenziali del database
include 'config.php'; 

// Verifica se esiste già una sessione utente attiva
// Se presente, reindirizza l'utente alla homepage
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); 
    exit();
} 

// Verifica se la richiesta è di tipo POST (form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Controlla se sono stati inviati sia username che password
    // Se uno dei due campi è vuoto, reindirizza alla pagina di login con messaggio di errore
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        header("Location: ../login.php?error=" . urlencode("Tutti i campi sono obbligatori"));
        exit();
    }

    // Recupera username e password dal form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepara la query SQL per cercare l'utente nel database
    // Usa prepared statement per prevenire SQL injection
    $query = "SELECT id, username, email, password FROM utenti WHERE username = ?";
    $stmt = $conn->prepare($query);
    
    // Verifica se la preparazione della query è avvenuta con successo
    if ($stmt) {
        // Associa il parametro username alla query
        $stmt->bind_param("s", $username);
        
        // Esegue la query
        $stmt->execute();
        
        // Ottiene il risultato della query
        $result = $stmt->get_result();

        // Verifica se è stato trovato un utente con lo username fornito
        if ($result->num_rows > 0) {
            // Recupera i dati dell'utente
            $user = $result->fetch_assoc();
            
            // Verifica se la password fornita corrisponde a quella nel database
            if (password_verify($password, $user['password'])) {
                // Password corretta: crea le variabili di sessione
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                
                // Reindirizza alla homepage dopo il login
                header("Location: ../index.php"); 
                exit();
            } else {
                // Password non corretta: reindirizza con messaggio di errore
                header("Location: ../login.php?error=" . urlencode("Password non valida"));
                exit();
            }
        } else {
            // Nessun utente trovato con lo username fornito
            header("Location: ../login.php?error=" . urlencode("Username non trovato"));
            exit();
        }
        
        // Chiude lo statement preparato
        $stmt->close();
    } else {
        // Errore nella preparazione della query
        header("Location: ../login.php?error=" . urlencode("Errore di sistema. Riprova più tardi."));
        exit();
    }
}

// Chiude la connessione al database
$conn->close();
?>