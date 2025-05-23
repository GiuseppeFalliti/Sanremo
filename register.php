
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
            
            
            <form method="POST" class="space-y-6" action="backend/register.php">
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