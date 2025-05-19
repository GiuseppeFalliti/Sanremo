<!DOCTYPE html>
<?php
session_start();
?>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanremo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/styles/style.css">

</head>
    <style>
        /* Effetto di animazione */
        @keyframes fade-in-scale {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in-scale {
            animation: fade-in-scale 0.5s ease-out forwards;
        }
        @keyframes particles {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        .animate-particles {
            animation: particles 0.5s ease-out forwards;
        }

        /* Stile per il sistema di votazione a stelle */
        .star-rating {
            display: inline-flex;
            gap: 2px;
        }

        .star {
            cursor: pointer;
            font-size: 24px;
            color: #4B5563;
            transition: color 0.2s;
        }

        .star:hover,
        .star.active {
            color: #FCD34D;
        }

        .star-rating:hover .star {
            color: #FCD34D;
        }

        .star-rating .star:hover ~ .star {
            color: #4B5563;
        }
    </style>

<body>
    <!--sezione Home-->
    <div id="home" style="background-image: url('assets/Structure/home.jpg');"
        class="bg-cover bg-center bg-no-repeat h-screen w-full relative">
        <div class="absolute inset-0 bg-red-600/70"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-blue-600/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-purple-600/100 to-transparent "></div>


        <!--Logo/titolo-->
        <div class="absolute inset-0 flex items-center justify-center z-index-100">
            <img src="assets/Structure/logo.png" alt="logo" id="logo"
                class="w-[900px] h-[500px] animate-fade-in-scale">
        </div>
    
    </div>





    <!--Sezione Artisti-->
    <div id="artisti" style="background-image: url('assets/Structure/artisti.jpg');"
        class="bg-cover bg-center bg-no-repeat min-h-screen w-full relative py-24 ">

        <br> <br>

        <!-- Container delle card -->
        <div class="container mx-auto px-4 relative z-10 ">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">


                <!-- Card 1 -->
                <div class="group transform transition duration-500 hover:scale-105">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Balorda nostalgia.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>

                        <h3 class="text-white font-bold text-xl mt-4 text-center">Balorda nostalgia</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Olly</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 258.4M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="2">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button
                                class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center
                                 transition duration-300 transform hover:scale-105 play-button">
                                <img src=" assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>

                    </div>
                </div>


                <!-- Card 2 -->
                <div class="group transform transition duration-500 hover:scale-105">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/la noia.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>

                        <h3 class="text-white font-bold text-xl mt-4 text-center">La noia</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Angelina Mango</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 149.4M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="2">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group transform transition duration-500 hover:scale-105">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Due vite.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Due vite</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Marco Mengoni</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 421.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="37">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="group transform transition duration-500 hover:scale-105">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Brividi.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Brividi</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Mahmood e Blanco</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 189.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="4">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Zitti e buoni.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Zitti e buoni</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Måneskin</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 1.2 Mld</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="5">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Fai rumore.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Fai rumore</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Diodato</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 200.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="6">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Soldi.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Soldi</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Mahmood</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 219.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="73">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Non mi avete fatto niente.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Non mi avete fatto niente</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Ermal Meta e Fabrizio Moro</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 101.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="8">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 9 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Occidentali's Karma.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Occidentali's Karma</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Francesco Gabbani</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 700.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="9">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Card 10 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Un giorno mi dirai.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Un giorno mi dirai</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Stadio</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 189.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="10">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Card 11 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Grande amore.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Grande amore</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Il volo</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 189.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="11">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 12 -->
                <div class="group transform transition duration-500 hover:scale-105 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl border-2 border-white/20 p-4 w-[300px] h-[500px]">
                        <div class="overflow-hidden rounded-lg">
                            <img src="assets/songs/Controvento.jpg"
                                class="w-full h-54 object-cover rounded-lg transform  transition duration-500">
                        </div>
                        <h3 class="text-white font-bold text-xl mt-4 text-center">Controvento</h3>
                        <p class="text-white/80 text-sm text-center mt-2">Arisa</p>
                        <p class="text-white/60 text-xs text-center mt-1">Ascolti: 189.7M</p>

                        <!-- Sistema di votazione a stelle -->
                        <div class="mt-2 flex justify-center items-center">
                            <div class="star-rating" data-song-id="12">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-rating="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-average text-white/80 text-sm ml-2">0.0</span>
                            <span class="rating-count text-white/60 text-xs ml-1">(0)</span>
                        </div>

                        <div class="mt-3 flex justify-center">
                            <button class="bg-purple-600/80 hover:bg-purple-600 text-white px-6 py-2 rounded-full flex items-center transition duration-300 transform hover:scale-105 play-button">
                                <img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">
                                Ascolta
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Effetti di sovrapposizione -->
        <div class="absolute inset-0 bg-black/40"></div>
    </div>



    <!--Nav bar che appare quando  scrolliamo-->
    <nav id="scrollNav" class="fixed top-0 left-0 w-full h-24  bg-[#000035]/50 backdrop-blur-sm transform -translate-y-full 
    transition-transform duration-300 z-50 hidden">

        <div class="container mx-auto px-6 py-3 relative">
            <div class="flex items-center justify-between">

                <!--Logo-->
                <div class="absolute -left-4 -bottom-40">
                    <img src="assets/Structure/logo.png" alt="logo" style="object-fit: contain; width: 360px; height: 360px">
                </div>

                <!--Barra di Ricerca-->
                <div class="flex-1 flex justify-center items-center space-x-4 relative">
                    <input type="text" id="searchInput" placeholder="Cerca canzone o artista..." autocomplete="off"
                        class="w-96 h-14 px-6 py-4 text-lg text-center rounded-full bg-gray-900 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white/30">

                    <!-- Risultati della ricerca -->
                    <div id="searchResults" class="absolute top-full mt-2 hidden">
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl border-2 border-white/10 max-h-96 w-96 overflow-y-auto">
                            <div class="p-4 space-y-4">
                                <!-- Elementi cercati verranno aggiunti qui attraverso script JavaScript -->


                            </div>
                        </div>
                    </div>

                </div>

                <!-- Bottoni Auth in alto a destra -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Utente non loggato: mostra login e registrazione -->
                    <form action="register.php" class="absolute top-8 right-40 z-30 flex gap-4">
                        <input type="submit" value="registrati" class="px-8 py-3 rounded-full bg-purple-600/80 backdrop-blur-sm border-2 border-white/20 
                          text-white font-semibold hover:bg-purple-600 transition-all duration-300
                          hover:scale-105 shadow-lg">
                    </form>

                    <form action="login.php" class="absolute top-8 right-8 z-30 flex gap-4">
                        <input type="submit" value="login" class="px-8 py-3 rounded-full bg-white/10 backdrop-blur-sm border-2 border-white/20 
                          text-white font-semibold hover:bg-white/20 transition-all duration-300
                          hover:scale-105 shadow-lg">
                    </form>
                <?php else: ?>
                    <!-- Utente loggato: mostra profilo e logout -->
                    <div class="absolute top-8 right-8 z-30 flex gap-4">
                        <a href="profile.php" class="px-8 py-3 rounded-full bg-purple-600/80 backdrop-blur-sm border-2 border-white/20 
                          text-white font-semibold hover:bg-purple-600 transition-all duration-300
                          hover:scale-105 shadow-lg flex items-center">
                            <img src="assets/user.svg" alt="profilo" class="w-5 h-5 mr-2">
                            Profilo
                        </a>

                        <a href="backend/logout.php" class="px-8 py-3 rounded-full bg-white/10 backdrop-blur-sm border-2 border-white/20 
                          text-white font-semibold hover:bg-white/20 transition-all duration-300
                          hover:scale-105 shadow-lg">
                            Logout
                        </a>
                    </div>
                <?php endif; ?>




            </div>
        </div>
    </nav>

    <!--Script per gestire lo scroll-->
    <script>
        const nav = document.getElementById('scrollNav');
        /*const motore_ricerca = document.getElementById('motore_ricerca');*/
        const logo = document.getElementById('logo');
        const sezioneArtisti = document.getElementById('artisti');
        const home = document.getElementById('home');
        let hasAutoScrolled = false; // Flag per tracciare se lo scroll automatico è già avvenuto

        window.addEventListener('scroll', () => {
            const logoTop = logo.offsetTop; // Posizione del logo(ottengo la distanza tra la barra di ricerca e il top della pagina)
            const scrollPosition = window.scrollY; // Posizione dello scroll in verticale
            const homeBottom = home.offsetHeight; // Altezza totale della sezione home

            // verifica se l'utente ha scrollato oltre la barra di ricerca (con un margine di 100px)
            if (scrollPosition >= logoTop - 100) {
                // Mostra la navbar
                nav.classList.remove('-translate-y-full', 'hidden');
                nav.classList.add('translate-y-0');

                // Se non abbiamo ancora fatto lo scroll automatico
                if (!hasAutoScrolled) {
                    hasAutoScrolled = true; // Impostiamo il flag

                    // Scroll automatico verso la sezione artisti con animazione smooth
                    sezioneArtisti.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            } else { // Se siamo sopra il motore di ricerca
                // Nascondi la navbar
                nav.classList.add('-translate-y-full');
                setTimeout(() => {
                    if (nav.classList.contains('-translate-y-full')) {
                        nav.classList.add('hidden');
                    }
                }, 300);

                // Reset del flag quando si torna su
                if (scrollPosition < logoTop - 200) {
                    hasAutoScrolled = false;
                }
            }

            // Nascondi la navbar quando si torna alla sezione home
            if (scrollPosition < homeBottom) {
                nav.classList.add('-translate-y-full');
                setTimeout(() => {
                    if (nav.classList.contains('-translate-y-full')) {
                        nav.classList.add('hidden');
                    }
                }, 300);
            }
        });
    </script>



    <!-- Script per la lista del motore della navbar -->
    <script>
        const searchInput = document.getElementById('searchInput'); // Input della barra di ricerca
        const searchResults = document.getElementById('searchResults'); // Risultati della barra di ricerca


        // funzione per creare gli elementi dei risultati  della barra di ricerca 
        function createResultItem(result) {
            const item = document.createElement('div');
            item.className = 'p-3 rounded-lg hover:bg-white/40 cursor-pointer transition-colors';

            if (result.type === 'song') {
                item.innerHTML = `
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <p class="text-black font-semibold">${result.title}</p>
                    <p class="text-black/80 text-sm">${result.artist} • ${result.year}</p>
                </div>
                <div class="flex gap-2">
                    <button class="youtube-btn p-2 rounded-full hover:bg-purple-600/20">
                        <img src="assets/youtube.svg" alt="youtube" class="w-5 h-5">
                    </button>
                </div>
            </div>
        `;

                //Click event per il titolo della canzone/ dettagli
                item.querySelector('.flex-1').addEventListener('click', () => {
                    window.location.href = `song.php?id=${result.id}`;
                });

                // Click event per YouTube button
                item.querySelector('.youtube-btn').addEventListener('click', (e) => {
                    e.stopPropagation();
                    const searchQuery = `${result.title} ${result.artist} sanremo`;
                    window.open(`https://www.youtube.com/results?search_query=${encodeURIComponent(searchQuery)}`, '_blank');
                });
            } else if (result.type === 'artist') {
                item.innerHTML = `
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <p class="text-black font-semibold">${result.name}</p>
                    <p class="text-black/80 text-sm">Canzoni: ${result.songs.join(', ') || 'N/A'}</p>
                </div>
                <div class="flex gap-2">
                    <button class="youtube-btn p-2 rounded-full hover:bg-purple-600/20">
                        <img src="assets/youtube.svg" alt="youtube" class="w-5 h-5">
                    </button>
                </div>
                <span class="text-purple-400 text-sm">Artista</span>
            </div>
        `;

                // Click event per il nome dell'artista/dettagli
                item.querySelector('.flex-1').addEventListener('click', () => {
                    window.location.href = `artist.php?id=${result.id}`;
                });

                // Click event per YouTube button
                item.querySelector('.youtube-btn').addEventListener('click', (e) => {
                    e.stopPropagation();
                    const searchQuery = `${result.name} sanremo`;
                    window.open(`https://www.youtube.com/results?search_query=${encodeURIComponent(searchQuery)}`, '_blank');
                });
            }

            return item;
        }

        // Funzione per mostrare i messaggi di feedback
        function showMessage(message, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `fixed top-4 right-4 p-4 rounded-lg ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white z-50`;
            messageDiv.textContent = message;
            
            document.body.appendChild(messageDiv);
            
            setTimeout(() => {
                messageDiv.remove();
            }, 3000);
        }

        // Funzione per effettuare la richiesta di ricerca
        async function fetchSearchResults(query) {
            try {
                const response = await fetch(`backend/search.php?query=${encodeURIComponent(query)}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json(); // Risposta JSON dalla API
                console.log('API Response:', data); // Debug

                if (!data.success) {
                    throw new Error(data.error || 'Errore nella ricerca');
                }

                return data.results; // Risultati della ricerca
            } catch (error) {
                console.error('Errore nella ricerca:', error);
                return [];
            }
        }

        // Funzione per gestire la ricerca
        const handleSearch = async (e) => {
            const query = e.target.value.trim(); // Query della ricerca

            // Se la query è vuota o troppo corta, nascondi i risultati
            if (query.length < 2) {
                searchResults.classList.add('hidden');
                return;
            }

            try {
                const results = await fetchSearchResults(query);
                const resultsContainer = searchResults.querySelector('.p-4'); // Contenitore dei risultati
                resultsContainer.innerHTML = ''; // Pulizia dei risultati precedenti

                if (!results || results.length === 0) {
                    resultsContainer.innerHTML = '<p class="text-black text-center">Nessun risultato trovato</p>';
                } else {

                    results.forEach(result => {
                        if (result) { // Controllo aggiuntivo
                            resultsContainer.appendChild(createResultItem(result));
                        }
                    });
                }

                searchResults.classList.remove('hidden');
            } catch (error) {
                console.error('Search error:', error);
                resultsContainer.innerHTML = '<p class="text-red-500 text-center">Errore nella ricerca</p>';
                searchResults.classList.remove('hidden');
            }
        }

        searchInput.addEventListener('input', handleSearch);

        // Chiudi i risultati quando si clicca fuori
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target)) {
                searchResults.classList.add('hidden');
            }
        });
    </script>


     <!-- Sezione About -->
<div id="about" style="background-image: url('assets/Structure/about.jpg');" 
     class="bg-cover bg-center bg-no-repeat min-h-screen w-full relative py-24">
    
    <!-- Sovrapposizioni gradienti -->
    <div class="absolute inset-0 bg-gradient-to-b from-purple-900/80 to-blue-900/80"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#000035]/90 via-transparent to-transparent"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Titolo sezione -->
        <div class="text-center mb-16 animate-fade-in-scale">
            <h2 class="text-5xl font-bold text-white mb-4">About Festival</h2>
            <div class="w-24 h-1 bg-purple-500 mx-auto rounded-full"></div>
        </div>

        <!-- Grid contenuti -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Storia -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl border-2 border-white/20 p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-purple-800/80 p-3 rounded-xl mr-4">
                        
                    </div>
                    <h3 class="text-2xl font-bold text-white">La Nostra Storia</h3>
                </div>
                <p class="text-white/80 leading-relaxed">
                    Il Festival di Sanremo, nato nel 1951, è il più prestigioso appuntamento 
                    con la musica italiana. Un palcoscenico che ha lanciato leggende della 
                    musica e creato momenti indimenticabili nella cultura popolare.
                </p>
            </div>

            <!-- Competizione -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl border-2 border-white/20 p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-purple-800/80 p-3 rounded-xl mr-4">
                        
                    </div>
                    <h3 class="text-2xl font-bold text-white">La Competizione</h3>
                </div>
                <p class="text-white/80 leading-relaxed">
                    24 artisti emergenti e affermati si sfidano in 5 serate ricche di musica ed emozioni. 
                    La vittoria viene decisa da una giuria mista di esperti e pubblico da casa.
                </p>
            </div>

            <!-- Dati salienti -->
            <div class="lg:col-span-2 bg-white/10 backdrop-blur-sm rounded-2xl border-2 border-white/20 p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="p-4">
                        <div class="text-4xl font-bold text-purple-400 mb-2">73+</div>
                        <div class="text-sm text-white/80">Edizioni</div>
                    </div>
                    <div class="p-4">
                        <div class="text-4xl font-bold text-purple-400 mb-2">5000+</div>
                        <div class="text-sm text-white/80">Canzoni</div>
                    </div>
                    <div class="p-4">
                        <div class="text-4xl font-bold text-purple-400 mb-2">15M+</div>
                        <div class="text-sm text-white/80">Spettatori</div>
                    </div>
                    <div class="p-4">
                        <div class="text-4xl font-bold text-purple-400 mb-2">80+</div>
                        <div class="text-sm text-white/80">Vincitori</div>
                    </div>
                </div>
            </div>

            <!-- Citazione -->
            <div class="lg:col-span-2 text-center mt-12">
                <blockquote class="text-xl italic text-white/90 max-w-2xl mx-auto">
                    "Sanremo non è solo un festival, è un'emozione che unisce generazioni. 
                    Qui la musica diventa storia."
                    <footer class="mt-4 text-purple-300">- Amadeus</footer>
                </blockquote>
            </div>
        </div>

        <!-- Pulsante Scopri di più -->
        <div class="text-center mt-16">
            <a href="https://it.wikipedia.org/wiki/Festival_di_Sanremo#Storia" target="_blank" class="inline-block px-8 py-3 rounded-full bg-purple-600/80 hover:bg-purple-600 
               text-white font-semibold transition-all duration-300 transform hover:scale-105 
               backdrop-blur-sm border-2 border-white/20">
                Scopri la Storia Completa
            </a>
        </div>
    </div>

</div>

<!-- Elemento audio nascosto -->
<audio id="audioPlayer" style="display: none;">
    <source src="" type="audio/mpeg">
    Il tuo browser non supporta l'elemento audio.
</audio>

<!-- Elemento per i messaggi di debug -->
<div id="debug-message" class="fixed bottom-4 right-4 bg-black/80 text-white p-4 rounded-lg z-50 hidden"></div>

<!--Script per gestire la musica-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const audioPlayer = document.getElementById('audioPlayer');
        const playButtons = document.querySelectorAll('.play-button');
        const debugMessage = document.getElementById('debug-message');
        let currentlyPlaying = null;

        // Funzione per mostrare messaggi di debug
        function showDebugMessage(message, isError = false) {
            debugMessage.textContent = message;
            debugMessage.classList.remove('hidden');
            debugMessage.style.backgroundColor = isError ? 'rgba(220, 38, 38, 0.8)' : 'rgba(0, 0, 0, 0.8)';
            setTimeout(() => {
                debugMessage.classList.add('hidden');
            }, 3000);
        }

        // Funzione per convertire il titolo nel formato del nome file
        function convertTitleToFileName(title) {
            // Rimuove eventuali .mp3 esistenti e aggiunge un solo .mp3
            return title.replace(/\s+/g, '_').replace(/\.mp3$/, '') + '.mp3';
        }

        playButtons.forEach(button => {
            button.addEventListener('click', function() {
                const songTitle = this.closest('.group').querySelector('h3').textContent;
                const audioPath = `assets/songsss/${convertTitleToFileName(songTitle)}`;
                
                showDebugMessage(`Tentativo di riproduzione: ${audioPath}`);

                // Verifica se il file esiste
                fetch(audioPath)
                    .then(response => {
                        if (!response.ok) {
                            // Se il primo tentativo fallisce, prova con il doppio .mp3
                            const doubleMp3Path = audioPath.replace('.mp3', '.mp3.mp3');
                            return fetch(doubleMp3Path)
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('File audio non trovato');
                                    }
                                    return { ok: true, path: doubleMp3Path };
                                });
                        }
                        return { ok: true, path: audioPath };
                    })
                    .then(({ path }) => {
                        // Se stiamo già riproducendo questa canzone, la mettiamo in pausa
                        if (currentlyPlaying === path) {
                            audioPlayer.pause();
                            currentlyPlaying = null;
                            this.innerHTML = '<img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">Ascolta';
                            showDebugMessage('Riproduzione in pausa');
                            return;
                        }

                        // Se stiamo riproducendo un'altra canzone, la fermiamo
                        if (currentlyPlaying) {
                            const previousButton = document.querySelector(`[data-audio="${currentlyPlaying}"]`);
                            if (previousButton) {
                                previousButton.innerHTML = '<img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">Ascolta';
                            }
                        }

                        // Impostiamo il nuovo source e riproduciamo
                        audioPlayer.src = path;
                        audioPlayer.play()
                            .then(() => {
                                showDebugMessage('Riproduzione avviata con successo');
                                currentlyPlaying = path;
                                this.setAttribute('data-audio', path);
                                this.innerHTML = '<img src="assets/pause_music.svg" alt="pause" class="w-5 h-5 mr-2">Pausa';
                            })
                            
                            .catch(error => {
                                showDebugMessage('Errore durante la riproduzione: ' + error.message, true);
                            });

                        // Gestione della fine della riproduzione
                        audioPlayer.onended = function() {
                            currentlyPlaying = null;
                            const button = document.querySelector(`[data-audio="${path}"]`);
                            if (button) {
                                button.innerHTML = '<img src="assets/play_music.svg" alt="play" class="w-5 h-5 mr-2">Ascolta';
                            }
                            showDebugMessage('Riproduzione terminata');
                        };
                    })
                    .catch(error => {
                        showDebugMessage('File audio non trovato. Verifica il percorso: ' + audioPath, true);
                    });
            });
        });
    });
</script>

<!--Script per gestire la votazione-->
<script>
    // Sistema di votazione a stelle
    document.addEventListener('DOMContentLoaded', function() {
        const starRatings = document.querySelectorAll('.star-rating');

        // Carica i voti esistenti per ogni canzone
        starRatings.forEach(rating => {
            const songId = rating.dataset.songId;
            fetch(`backend/get_ratings.php?song_id=${songId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const averageElement = rating.parentElement.querySelector('.rating-average');
                        const countElement = rating.parentElement.querySelector('.rating-count');
                        averageElement.textContent = data.average_rating;
                        countElement.textContent = `(${data.total_ratings})`;

                        // Colora le stelle in base al voto dell'utente
                        if (data.user_rating) {
                            const stars = rating.querySelectorAll('.star');
                            stars.forEach(star => {
                                if (parseInt(star.dataset.rating) <= data.user_rating) {
                                    star.classList.add('active');
                                } else {
                                    star.classList.remove('active');
                                }
                            });
                        }
                    }
                })
                .catch(error => console.error('Errore nel caricamento dei voti:', error));
        });

        // Gestione del click sulle stelle
        starRatings.forEach(rating => {
            const stars = rating.querySelectorAll('.star');
            const songId = rating.dataset.songId;

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const ratingValue = parseInt(this.dataset.rating);
                    
                    // Invia il voto al server
                    fetch('backend/rate_song.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            song_id: songId,
                            rating: ratingValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Aggiorna la visualizzazione
                            const averageElement = rating.parentElement.querySelector('.rating-average');
                            const countElement = rating.parentElement.querySelector('.rating-count');
                            averageElement.textContent = data.average_rating;
                            countElement.textContent = `(${data.total_ratings})`;

                            // Aggiorna lo stato delle stelle in base al voto dell'utente
                            stars.forEach(s => {
                                if (parseInt(s.dataset.rating) <= ratingValue) {
                                    s.classList.add('active');
                                } else {
                                    s.classList.remove('active');
                                }
                            });
                        } else {
                            alert(data.message || 'Errore durante la votazione');
                        }
                    })
                    .catch(error => {
                        console.error('Errore durante la votazione:', error);
                        alert('Errore durante la votazione. Riprova più tardi.');
                    });
                });

                // Effetto hover
                star.addEventListener('mouseover', function() {
                    const ratingValue = parseInt(this.dataset.rating);
                    stars.forEach(s => {
                        if (parseInt(s.dataset.rating) <= ratingValue) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                });

                star.addEventListener('mouseout', function() {
                    // Ripristina il voto dell'utente dopo l'hover
                    fetch(`backend/get_ratings.php?song_id=${songId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.user_rating) {
                                stars.forEach(s => {
                                    if (parseInt(s.dataset.rating) <= data.user_rating) {
                                        s.classList.add('active');
                                    } else {
                                        s.classList.remove('active');
                                    }
                                });
                            }
                        })
                        .catch(error => console.error('Errore nel ripristino delle stelle:', error));
                });
            });
        });
    });
</script>

<!-- Script per gestire i preferiti -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    
    // Funzione per aggiornare l'aspetto del pulsante preferiti
    function updateFavoriteButton(button, isFavorite) {
        const heartIcon = button.querySelector('img');
        heartIcon.src = isFavorite ? 'assets/heart_filled.svg' : 'assets/heart_outline.svg';
        button.classList.toggle('bg-red-500/20', isFavorite);
    }

    // Carica lo stato iniziale dei preferiti
    favoriteButtons.forEach(button => {
        const songId = button.dataset.songId;
        fetch(`backend/check_favorite.php?song_id=${songId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateFavoriteButton(button, data.is_favorite);
                }
            })
            .catch(error => console.error('Errore nel caricamento dei preferiti:', error));
    });

    // Gestione del click sul pulsante preferiti
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const songId = this.dataset.songId;
            
            fetch('backend/toggle_favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `song_id=${songId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateFavoriteButton(this, data.is_favorite);
                    // Mostra un messaggio di feedback
                    const message = data.is_favorite ? 'Aggiunto ai preferiti' : 'Rimosso dai preferiti';
                    showMessage(message, 'success');
                } else {
                    showMessage(data.message || 'Errore durante l\'operazione', 'error');
                }
            })
            .catch(error => {
                console.error('Errore durante l\'operazione:', error);
                showMessage('Errore durante l\'operazione', 'error');
                });
            });
        });
    });
</script>

</body>

</html>