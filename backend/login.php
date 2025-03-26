<?php
session_start();
include 'config.php'; // Connessione al database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparazione della query per ottenere l'utente
    $query = "SELECT id, username, password FROM utenti WHERE username = :username;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password corretta: avvia la sessione
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Reindirizza alla pagina principale
        exit;
    } else {
        // Credenziali errate
        echo "Nome utente o password non validi.";
    }
}
?>




