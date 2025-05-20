<?php
session_start();

// Reindirizza alla pagina di login se l'utente non è loggato
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


include 'backend/config.php';

// Recupero  dati dell'utente
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM utenti WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Se per qualche motivo l'utente non esiste più nel database
    session_destroy();
    header('Location: login.php');
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Utente - Sanremo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/style.css">
</head>

<body>
    <div style="background-image: url('assets/Structure/artisti.jpg');"
         class="bg-cover bg-center bg-no-repeat min-h-screen w-full relative py-24">
        
        <div class="absolute inset-0 bg-black/60"></div>
        
        
        <div class="container mx-auto px-4 relative z-10">
            <!-- Card profilo -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-8 max-w-3xl mx-auto">
                <!-- Header -->
                <div class="flex items-center mb-8">
                    <!-- Avatar -->
                    <div class="bg-purple-600 rounded-full w-20 h-20 flex items-center justify-center mr-6">
                        <span class="text-white text-3xl font-bold"><?= strtoupper(substr($user['username'], 0, 1)) ?></span>
                    </div>
                    
                    <!-- Informazioni utente -->
                    <div>
                        <h1 class="text-3xl font-bold text-white"><?= htmlspecialchars($user['username']) ?></h1>
                        <p class="text-white/70"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                </div>
                
                
                
                <div class="flex justify-between">
                    <a href="index.php" class="px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm border-2 border-white/20 
                    text-white font-semibold hover:bg-white/20 transition-all duration-300 hover:scale-105">
                        Torna alla home
                    </a>
                    
                    <a href="backend/logout.php" class="px-6 py-3 rounded-full bg-red-500/30 backdrop-blur-sm border-2 border-red-500/20 
                    text-white font-semibold hover:bg-red-500/50 transition-all duration-300 hover:scale-105">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html> 