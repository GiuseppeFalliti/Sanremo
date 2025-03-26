<?php
session_start();
include 'config.php';

// Abilita la visualizzazione degli errori
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($email) && !empty($password)) {
        try {
            // Controlla se l'utente esiste già
            $stmt = $conn->prepare("SELECT id FROM utenti WHERE username = :username OR email = :email");
            $stmt->bindValue(":username", $username, PDO::PARAM_STR);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $error = "Username o email già in uso!";
            } else {
                // Hash della password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Inserisci il nuovo utente nel database
                $stmt = $conn->prepare("INSERT INTO utenti (username, email, password) VALUES (:username, :email, :password)");
                $stmt->bindValue(":username", $username, PDO::PARAM_STR);
                $stmt->bindValue(":email", $email, PDO::PARAM_STR);
                $stmt->bindValue(":password", $hashed_password, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $_SESSION['user_id'] = $conn->lastInsertId();
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Errore nella registrazione!";
                }
            }
        } catch (PDOException $e) {
            $error = "Errore nel database: " . $e->getMessage();
        }
    } else {
        $error = "Compila tutti i campi!";
    }
}
?>

