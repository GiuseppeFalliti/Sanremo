

<?php
session_start();
require_once 'backend/config.php';

// Abilita la visualizzazione degli errori
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Se l'utente è già loggato, reindirizza alla home
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Per favore inserisci username e password';
    } else {
        try {
            $stmt = $conn->prepare("SELECT id, username, email, password FROM utenti WHERE username = ?");
            if (!$stmt) {
                throw new Exception("Errore nella preparazione della query: " . $conn->error);
            }
            
            $stmt->bind_param("s", $username);
            if (!$stmt->execute()) {
                throw new Exception("Errore nell'esecuzione della query: " . $stmt->error);
            }
            
            $result = $stmt->get_result();
            
            if ($utenti = $result->fetch_assoc()) {
                if (password_verify($password, $utenti['password'])) {
                    $_SESSION['user_id'] = $utenti['id'];
                    $_SESSION['username'] = $utenti['username'];
                    $_SESSION['email'] = $utenti['email'];
                    header('Location: index.php');
                    exit;
                } else {
                    $error = 'Password non corretta';
                }
            } else {
                $error = 'Utente non trovato';
            }
        } catch (Exception $e) {
            $error = 'Errore di sistema: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sanremo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body class="bg-[#000035] min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8">
        <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-8">
            <h1 class="text-3xl font-bold text-white mb-8 text-center">Accedi</h1>
            
            <?php if ($error): ?>
            <div class="bg-red-500/20 border border-red-500 text-white px-4 py-3 rounded-lg mb-6">
                <?php echo htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-white mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-3 rounded-lg bg-white/10 border-2 border-white/20 text-white
                                  focus:outline-none focus:border-purple-500">
                </div>

                <div>
                    <label for="password" class="block text-white mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 rounded-lg bg-white/10 border-2 border-white/20 text-white
                                  focus:outline-none focus:border-purple-500">
                </div>

                <button type="submit"
                        class="w-full px-8 py-3 rounded-full bg-purple-600/80 hover:bg-purple-600
                               text-white font-semibold transition-all duration-300">
                    Accedi
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-white/80">
                    Non hai un account? 
                    <a href="register.php" class="text-purple-400 hover:text-purple-300">Registrati</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>