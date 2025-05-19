<?php
session_start();
require_once 'backend/config.php';

// Se l'utente è già loggato, reindirizza alla home
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Per favore compila tutti i campi';
    } elseif ($password !== $confirm_password) {
        $error = 'Le password non coincidono';
    } elseif (strlen($password) < 8) {
        $error = 'La password deve essere di almeno 8 caratteri';
    } else {
        // Verifica se l'username o l'email sono già in uso
        $stmt = $conn->prepare("SELECT id FROM utenti WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = 'Username o email già in uso';
        } else {
            // Crea il nuovo utente
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO utenti (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $stmt->insert_id;
                header('Location: index.php');
                exit;
            } else {
                $error = 'Errore durante la registrazione';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Sanremo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body class="bg-[#000035] min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8">
        <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-8">
            <h1 class="text-3xl font-bold text-white mb-8 text-center">Registrazione</h1>
            
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
                    <label for="email" class="block text-white mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 rounded-lg bg-white/10 border-2 border-white/20 text-white
                                  focus:outline-none focus:border-purple-500">
                </div>

                <div>
                    <label for="password" class="block text-white mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 rounded-lg bg-white/10 border-2 border-white/20 text-white
                                  focus:outline-none focus:border-purple-500">
                    <p class="text-white/60 text-sm mt-1">La password deve essere di almeno 8 caratteri</p>
                </div>

                <div>
                    <label for="confirm_password" class="block text-white mb-2">Conferma Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
                           class="w-full px-4 py-3 rounded-lg bg-white/10 border-2 border-white/20 text-white
                                  focus:outline-none focus:border-purple-500">
                </div>

                <button type="submit"
                        class="w-full px-8 py-3 rounded-full bg-purple-600/80 hover:bg-purple-600
                               text-white font-semibold transition-all duration-300">
                    Registrati
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-white/80">
                    Hai già un account? 
                    <a href="login.php" class="text-purple-400 hover:text-purple-300">Accedi</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>