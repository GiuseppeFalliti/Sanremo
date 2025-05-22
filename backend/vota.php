<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Accesso negato");
}

$user_id = $_SESSION['user_id'];
$song_id = $_POST['song_id'];
$rating = $_POST['rating'];

//query per inserire/aggiornare il voto
$query = "INSERT INTO feedback (user_id, song_id, rating) VALUES (:user_id, :song_id, :rating)
ON DUPLICATE KEY UPDATE rating = :rating";

$stmt = $conn->prepare($query);
$stmt->execute(['user_id' => $user_id, 'song_id' => $song_id, 'rating' => $rating]);

echo "Voto registrato con successo!";
?>
