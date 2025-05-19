<?php
session_start();

// Reindirizza alla pagina di login se l'utente non è loggato
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'backend/config.php';

// Recupero dati dell'utente
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM utenti WHERE id = ?");
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

// Debug: Verifica se la tabella preferiti esiste
$check_table = $conn->query("SHOW TABLES LIKE 'preferiti'");
if ($check_table->num_rows === 0) {
    // Crea la tabella se non esiste
    $create_table = "CREATE TABLE IF NOT EXISTS preferiti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        song_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES utenti(id) ON DELETE CASCADE,
        FOREIGN KEY (song_id) REFERENCES canzoni(id) ON DELETE CASCADE,
        UNIQUE KEY unique_favorite (user_id, song_id)
    )";
    $conn->query($create_table);
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Utente - Sanremo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-picture-container {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: visible;
            cursor: pointer;
        }
        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 50%;
        }
        .profile-picture-container:hover .upload-overlay {
            opacity: 1;
        }
        .upload-overlay i {
            color: white;
            font-size: 1.5rem;
        }
        #profile-picture-input {
            display: none;
        }
        .remove-profile-btn {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: all 0.2s;
        }
        .remove-profile-btn:hover {
            background-color: #dc2626;
            transform: scale(1.1);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestione dell'upload della foto profilo
            window.uploadProfilePicture = function(input) {
                if (input.files && input.files[0]) {
                    const formData = new FormData();
                    formData.append('profile_picture', input.files[0]);

                    // Mostra un indicatore di caricamento
                    const preview = document.getElementById('profile-preview');
                    const originalSrc = preview.src;
                    preview.style.opacity = '0.5';

                    fetch('backend/upload_profile_picture.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Errore di rete');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            preview.src = data.path;
                            preview.style.opacity = '1';
                            // Aggiungi il pulsante di rimozione
                            const container = document.querySelector('.profile-picture-container');
                            if (!container.querySelector('.remove-profile-btn')) {
                                const removeBtn = document.createElement('button');
                                removeBtn.className = 'remove-profile-btn';
                                removeBtn.title = 'Rimuovi foto profilo';
                                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                                removeBtn.onclick = removeProfilePicture;
                                container.appendChild(removeBtn);
                            }
                        } else {
                            alert(data.message || 'Errore durante l\'upload');
                            preview.src = originalSrc;
                            preview.style.opacity = '1';
                        }
                    })
                    .catch(error => {
                        console.error('Errore:', error);
                        alert('Si è verificato un errore durante l\'upload. Riprova più tardi.');
                        preview.src = originalSrc;
                        preview.style.opacity = '1';
                    });
                }
            };

            // Funzione per rimuovere la foto profilo
            window.removeProfilePicture = function() {
                if (confirm('Sei sicuro di voler rimuovere la tua foto profilo?')) {
                    const preview = document.getElementById('profile-preview');
                    const removeButton = document.querySelector('.remove-profile-btn');
                    
                    // Disabilita il pulsante durante l'operazione
                    if (removeButton) {
                        removeButton.style.pointerEvents = 'none';
                        removeButton.style.opacity = '0.5';
                    }
                    preview.style.opacity = '0.5';

                    fetch('backend/remove_profile_picture.php', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Risposta dal server:', data);
                        if (data.success) {
                            preview.src = 'assets/images/default-profile.png';
                            preview.style.opacity = '1';
                            if (removeButton) {
                                removeButton.remove();
                            }
                            alert('Foto profilo rimossa con successo');
                        } else {
                            throw new Error(data.message || 'Errore durante la rimozione della foto');
                        }
                    })
                    .catch(error => {
                        console.error('Errore:', error);
                        alert('Si è verificato un errore durante la rimozione della foto: ' + error.message);
                        preview.style.opacity = '1';
                        if (removeButton) {
                            removeButton.style.pointerEvents = 'auto';
                            removeButton.style.opacity = '1';
                        }
                    });
                }
            };

            // Gestione dei pulsanti dei preferiti per le canzoni
            document.querySelectorAll('.favorite-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    const songId = this.dataset.songId;
                    try {
                        const response = await fetch('backend/toggle_favorite.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `song_id=${songId}`
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Rimuovi la card dalla pagina
                            this.closest('.bg-white\\/5').remove();
                            
                            // Se non ci sono più canzoni preferite, mostra il messaggio
                            const songsContainer = document.querySelector('.grid-cols-1.md\\:grid-cols-2');
                            if (songsContainer.children.length === 0) {
                                songsContainer.innerHTML = '<p class="text-white/70 col-span-2">Non hai ancora canzoni preferite</p>';
                            }
                        }
                    } catch (error) {
                        console.error('Errore:', error);
                    }
                });
            });

            // Gestione dei pulsanti dei preferiti per gli artisti
            document.querySelectorAll('.favorite-btn-artist').forEach(button => {
                button.addEventListener('click', async function() {
                    const artistId = this.dataset.artistId;
                    try {
                        const response = await fetch('backend/toggle_favorite_artist.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ artist_id: artistId })
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Rimuovi la card dalla pagina
                            this.closest('.bg-white\\/5').remove();
                            
                            // Se non ci sono più artisti preferiti, mostra il messaggio
                            const artistsContainer = document.querySelector('.grid-cols-1.md\\:grid-cols-2:last-child');
                            if (artistsContainer.children.length === 0) {
                                artistsContainer.innerHTML = '<p class="text-white/70 col-span-2">Non hai ancora artisti preferiti</p>';
                            }
                        }
                    } catch (error) {
                        console.error('Errore:', error);
                    }
                });
            });
        });
    </script>
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
                    <!-- Avatar con upload -->
                    <div class="profile-picture-container mr-6">
                        <img src="<?php echo $user['profile_picture'] ?? 'assets/images/default-profile.png'; ?>" 
                             alt="Foto Profilo" 
                             class="profile-picture"
                             id="profile-preview">
                        <label for="profile-picture-input" class="upload-overlay">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" 
                               id="profile-picture-input" 
                               accept="image/*"
                               onchange="uploadProfilePicture(this)">
                        <?php if ($user['profile_picture']): ?>
                        <button onclick="removeProfilePicture()" 
                                class="remove-profile-btn"
                                title="Rimuovi foto profilo">
                            <i class="fas fa-times"></i>
                        </button>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Informazioni utente -->
                    <div>
                        <h1 class="text-3xl font-bold text-white"><?= htmlspecialchars($user['username']) ?></h1>
                        <p class="text-white/70"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                </div>
                
                <!-- Dettagli utente -->
                <div class="flex justify-between mb-8">
                    <a href="index.php" class="px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm border-2 border-white/20 
                    text-white font-semibold hover:bg-white/20 transition-all duration-300 hover:scale-105">
                        Torna alla home
                    </a>
                    
                    <a href="backend/logout.php" class="px-6 py-3 rounded-full bg-red-500/30 backdrop-blur-sm border-2 border-red-500/20 
                    text-white font-semibold hover:bg-red-500/50 transition-all duration-300 hover:scale-105">
                        Logout
                    </a>
                </div>

                <!-- Sezione Preferiti -->
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-white mb-6">I Tuoi Preferiti</h2>
                    
                    <!-- Canzoni Preferite -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-white mb-4">Canzoni Preferite</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php
                            // Query per recuperare le canzoni preferite
                            $favorites_query = "SELECT c.*, a.nome as artista 
                                              FROM preferiti p 
                                              INNER JOIN canzoni c ON p.song_id = c.id 
                                              INNER JOIN artisti a ON c.artista_id = a.id 
                                              WHERE p.user_id = ? 
                                              ORDER BY p.created_at DESC";
                            
                            $favorites_stmt = $conn->prepare($favorites_query);
                            $favorites_stmt->bind_param("i", $userId);
                            $favorites_stmt->execute();
                            $favorites_result = $favorites_stmt->get_result();

                            if ($favorites_result->num_rows > 0) {
                                while ($song = $favorites_result->fetch_assoc()) {
                                    ?>
                                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="assets/songs/<?= htmlspecialchars($song['titolo']) ?>.jpg" 
                                                 alt="<?= htmlspecialchars($song['titolo']) ?>" 
                                                 class="w-12 h-12 rounded-lg object-cover mr-4">
                                            <div>
                                                <h4 class="text-white font-semibold"><?= htmlspecialchars($song['titolo']) ?></h4>
                                                <p class="text-white/70 text-sm"><?= htmlspecialchars($song['artista']) ?></p>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <button class="play-button p-2 rounded-full hover:bg-purple-600/20" 
                                                    data-song-id="<?= $song['id'] ?>">
                                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5">
                                            </button>
                                            <button class="favorite-btn p-2 rounded-full hover:bg-purple-600/20" 
                                                    data-song-id="<?= $song['id'] ?>">
                                                <img src="assets/heart_filled.svg" alt="preferiti" class="w-5 h-5">
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<p class="text-white/70 col-span-2">Non hai ancora canzoni preferite</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Artisti Preferiti -->
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Artisti Preferiti</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php
                            // Query per recuperare gli artisti preferiti
                            $artists_query = "SELECT a.* FROM artists a 
                                            INNER JOIN favorite_artists fa ON a.id = fa.artist_id 
                                            WHERE fa.user_id = ? 
                                            ORDER BY fa.created_at DESC";
                            $artists_stmt = $conn->prepare($artists_query);
                            $artists_stmt->bind_param("i", $userId);
                            $artists_stmt->execute();
                            $artists_result = $artists_stmt->get_result();

                            if ($artists_result->num_rows > 0) {
                                while ($artist = $artists_result->fetch_assoc()) {
                                    ?>
                                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="assets/artists/<?= htmlspecialchars($artist['image']) ?>" 
                                                 alt="<?= htmlspecialchars($artist['name']) ?>" 
                                                 class="w-12 h-12 rounded-lg object-cover mr-4">
                                            <div>
                                                <h4 class="text-white font-semibold"><?= htmlspecialchars($artist['name']) ?></h4>
                                                <p class="text-white/70 text-sm"><?= htmlspecialchars($artist['songs_count']) ?> canzoni</p>
                                            </div>
                                        </div>
                                        <button class="favorite-btn-artist p-2 rounded-full hover:bg-purple-600/20" 
                                                data-artist-id="<?= $artist['id'] ?>">
                                            <img src="assets/heart-filled.svg" alt="preferiti" class="w-5 h-5">
                                        </button>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<p class="text-white/70 col-span-2">Non hai ancora artisti preferiti</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> 