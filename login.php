<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sanremo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body class="min-h-screen">
    <!-- Sfondo con gradienti -->
    <div class="bg-cover bg-center bg-no-repeat min-h-screen w-full relative" style="background-image: url('assets/Structure/home.jpg')">
        <div class="absolute inset-0 bg-red-600/70"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-blue-600/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-purple-600/100 to-transparent"></div>

        <!-- Form di login -->
        <div class="relative z-10 flex items-center justify-center min-h-screen">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl border-2 border-white/20 p-8 w-full max-w-md mx-4">
                <h2 class="text-3xl font-bold text-white text-center mb-8">Accedi</h2>
                
                <?php if(isset($_GET['error'])): ?>
                    <div class="mb-4 p-3 bg-red-500/20 text-red-300 rounded-lg text-sm">
                        <?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php endif; ?>

                <form action="./backend/login.php" method="POST" class="space-y-6">
                    <div>
                        <label class="text-white/80 block mb-2">Username</label>
                        <input type="text" name="login" 
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-sm border-2 border-white/20 rounded-lg
                                   text-white placeholder-white/50 focus:outline-none focus:border-purple-500">
                    </div>

                    <div>
                        <label class="text-white/80 block mb-2">Password</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-sm border-2 border-white/20 rounded-lg
                                   text-white placeholder-white/50 focus:outline-none focus:border-purple-500">
                    </div>

                    <button type="submit" 
                            class="w-full py-3 px-6 bg-purple-600/80 hover:bg-purple-600 text-white rounded-lg
                                   font-semibold transition-all duration-300 transform hover:scale-105">
                        Accedi
                    </button>
                </form>

                <p class="text-white/70 text-center mt-6">
                    Non hai un account? 
                    <a href="register.php" class="text-purple-300 hover:text-purple-400 underline transition-colors">
                        Registrati qui
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>