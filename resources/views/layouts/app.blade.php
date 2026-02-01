<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jade Birthday')</title>
    <meta name="description" content="Célébration des 23 ans de Jade - The Bellini Fest">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=Montserrat:wght@300;400;700&family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    
    <!-- Meta Tags for Social Sharing -->
    <meta property="og:title" content="Jade Birthday 23 - Bellini Fest">
    <meta property="og:description" content="Rejoignez-nous pour célébrer les 23 ans de Jade dans une ambiance festival !">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="loading-content">
            <div class="loading-icon">
                <i class="fa-solid fa-martini-glass-citrus"></i>
            </div>
            <h2>Préparation de la fête...</h2>
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
        </div>
    </div>

    @yield('floating-assets')

    @yield('header')

    <main>
        @yield('content')
    </main>

    <footer class="text-center py-5 mt-5">
        <div class="container">
            <h3 class="mb-4 tracking-tighter" style="font-size: 3rem;">JAAD 23</h3>
            <div class="d-flex justify-content-center gap-4 fs-3 mb-4">
                <i class="fa-solid fa-martini-glass-citrus"></i>
                <i class="fa-solid fa-compact-disc"></i>
                <i class="fa-solid fa-bottle-droplet"></i>
            </div>
            <p class="small opacity-50 text-uppercase tracking-widest mb-0">
                L'abus d'alcool est dangereux pour la santé. À consommer avec modération.
            </p>
            <div class="mt-4">
                <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <!-- Music Player Widget -->
    <div class="music-player" id="music-player">
        <div class="player-toggle">
            <i class="fas fa-music"></i>
        </div>
        <div class="player-content">
            <h4>Festival Playlist</h4>
            <div class="player-controls">
                <i class="fas fa-backward" id="prev-btn"></i>
                <i class="fas fa-play" id="play-btn"></i>
                <i class="fas fa-forward" id="next-btn"></i>
            </div>
            <div class="track-info">
                <div class="track-name">TAMBOU</div>
                <div class="track-artist">AYEWAI X DJ GLAD X DJ TUTUSS</div>
            </div>
            <div class="player-progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
            <div class="time-display">
                <span id="current-time">0:00</span> / <span id="total-time">0:00</span>
            </div>
            <div class="volume-control">
                <i class="fas fa-volume-up"></i>
                <input type="range" id="volume-slider" min="0" max="1" step="0.1" value="0.7">
            </div>
            <div class="playlist-toggle">
                <i class="fas fa-list"></i> Playlist
            </div>
            <div class="playlist" id="playlist">
                <div class="playlist-header">
                    <h5>Playlist Festival</h5>
                    <i class="fas fa-times" id="close-playlist"></i>
                </div>
                <ul class="playlist-items">
                    <li class="playlist-item active" data-track="0">
                        <div class="track-info-item">
                            <span class="track-title">TAMBOU</span>
                            <span class="track-artist-item">AYEWAI X DJ GLAD X DJ TUTUSS</span>
                        </div>
                        <span class="track-duration">3:45</span>
                    </li>
                    <li class="playlist-item" data-track="1">
                        <div class="track-info-item">
                            <span class="track-title">Feu</span>
                            <span class="track-artist-item">Maurane Voyer, DJ Tutuss, Bad Bitch, Mikado</span>
                        </div>
                        <span class="track-duration">4:12</span>
                    </li>
                    <li class="playlist-item" data-track="2">
                        <div class="track-info-item">
                            <span class="track-title">Meryl - EDF Riddim Remix</span>
                            <span class="track-artist-item">feat. Danthology</span>
                        </div>
                        <span class="track-duration">3:28</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Audio element (caché) -->
    <audio id="audio-player" preload="auto"></audio>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <script>
        // Initialiser AOS
        AOS.init({
            duration: 1000,
            once: true
        });
        
        // Loading screen
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading-screen').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('loading-screen').style.display = 'none';
                    
                    // Démarrer la musique automatiquement après le chargement
                    initMusicPlayer();
                    playMusic();
                }, 500);
            }, 1500);
        });
        
        // Playlist des morceaux
        const playlist = [
            {
                title: "TAMBOU",
                artist: "AYEWAI X DJ GLAD X DJ TUTUSS",
                file: "{{ asset('musique/tambou.mp3') }}",
                duration: "3:45"
            },
            {
                title: "Feu",
                artist: "Maurane Voyer, DJ Tutuss, Bad Bitch, Mikado",
                file: "{{ asset('musique/feu.mp3') }}",
                duration: "4:12"
            },
            {
                title: "Meryl - EDF Riddim Remix",
                artist: "feat. Danthology",
                file: "{{ asset('musique/meryl-edf-riddim-remix.mp3') }}",
                duration: "3:28"
            }
        ];
        
        let currentTrack = 0;
        let isPlaying = false;
        let audioPlayer;
        let progressBar;
        let playBtn;
        let prevBtn;
        let nextBtn;
        let currentTimeEl;
        let totalTimeEl;
        let volumeSlider;
        let playlistVisible = false;
        
        // Initialiser le lecteur de musique
        function initMusicPlayer() {
            audioPlayer = document.getElementById('audio-player');
            progressBar = document.getElementById('progress-bar');
            playBtn = document.getElementById('play-btn');
            prevBtn = document.getElementById('prev-btn');
            nextBtn = document.getElementById('next-btn');
            currentTimeEl = document.getElementById('current-time');
            totalTimeEl = document.getElementById('total-time');
            volumeSlider = document.getElementById('volume-slider');
            
            // Charger la première piste
            loadTrack(currentTrack);
            
            // Événements du lecteur
            playBtn.addEventListener('click', togglePlayPause);
            prevBtn.addEventListener('click', playPreviousTrack);
            nextBtn.addEventListener('click', playNextTrack);
            
            // Mise à jour de la barre de progression
            audioPlayer.addEventListener('timeupdate', updateProgress);
            
            // Passage à la piste suivante à la fin
            audioPlayer.addEventListener('ended', playNextTrack);
            
            // Contrôle du volume
            volumeSlider.addEventListener('input', function() {
                audioPlayer.volume = this.value;
            });
            
            // Toggle de la playlist
            document.querySelector('.playlist-toggle').addEventListener('click', function() {
                document.getElementById('playlist').classList.toggle('show');
                playlistVisible = !playlistVisible;
            });
            
            // Fermeture de la playlist
            document.getElementById('close-playlist').addEventListener('click', function() {
                document.getElementById('playlist').classList.remove('show');
                playlistVisible = false;
            });
            
            // Sélection d'une piste dans la playlist
            document.querySelectorAll('.playlist-item').forEach(item => {
                item.addEventListener('click', function() {
                    const trackIndex = parseInt(this.getAttribute('data-track'));
                    if (trackIndex !== currentTrack) {
                        currentTrack = trackIndex;
                        loadTrack(currentTrack);
                        playMusic();
                    }
                });
            });
            
            // Toggle du lecteur
            document.querySelector('.player-toggle').addEventListener('click', function() {
                document.getElementById('music-player').classList.toggle('expanded');
            });
        }
        
        // Charger une piste
        function loadTrack(index) {
            const track = playlist[index];
            audioPlayer.src = track.file;
            document.querySelector('.track-name').textContent = track.title;
            document.querySelector('.track-artist').textContent = track.artist;
            
            // Mettre à jour la playlist
            document.querySelectorAll('.playlist-item').forEach((item, i) => {
                if (i === index) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
            
            // Réinitialiser la barre de progression
            progressBar.style.width = '0%';
            currentTimeEl.textContent = '0:00';
        }
        
        // Lire la musique
        function playMusic() {
            // Utiliser une promesse pour gérer les restrictions de lecture automatique
            const playPromise = audioPlayer.play();
            
            if (playPromise !== undefined) {
                playPromise.then(_ => {
                    // Lecture automatique démarrée
                    isPlaying = true;
                    playBtn.className = 'fas fa-pause';
                })
                .catch(error => {
                    // Lecture automatique bloquée par le navigateur
                    console.log('Lecture automatique bloquée:', error);
                    isPlaying = false;
                    playBtn.className = 'fas fa-play';
                    
                    // Afficher une notification pour inviter l'utilisateur à cliquer
                    showMusicNotification();
                });
            }
        }
        
        // Afficher une notification pour la musique
        function showMusicNotification() {
            const notification = document.createElement('div');
            notification.className = 'music-notification';
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-music"></i>
                    <p>Cliquez sur le bouton play pour démarrer la musique du festival!</p>
                    <button class="btn btn-sm btn-light" id="start-music-btn">
                        <i class="fas fa-play"></i> Démarrer
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animation d'entrée
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Bouton pour démarrer la musique
            document.getElementById('start-music-btn').addEventListener('click', function() {
                playMusic();
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            });
            
            // Fermeture automatique après 10 secondes
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.remove();
                        }
                    }, 300);
                }
            }, 10000);
        }
        
        // Mettre en pause/reprendre
        function togglePlayPause() {
            if (isPlaying) {
                audioPlayer.pause();
                playBtn.className = 'fas fa-play';
            } else {
                playMusic();
            }
            isPlaying = !isPlaying;
        }
        
        // Piste précédente
        function playPreviousTrack() {
            currentTrack = (currentTrack - 1 + playlist.length) % playlist.length;
            loadTrack(currentTrack);
            if (isPlaying) {
                playMusic();
            }
        }
        
        // Piste suivante
        function playNextTrack() {
            currentTrack = (currentTrack + 1) % playlist.length;
            loadTrack(currentTrack);
            if (isPlaying) {
                playMusic();
            }
        }
        
        // Mettre à jour la barre de progression
        function updateProgress() {
            const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            progressBar.style.width = progress + '%';
            
            // Mettre à jour les temps
            currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
            totalTimeEl.textContent = formatTime(audioPlayer.duration);
        }
        
        // Formater le temps (secondes en MM:SS)
        function formatTime(seconds) {
            if (isNaN(seconds)) return '0:00';
            
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = Math.floor(seconds % 60);
            return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
        }
        
        // Clic sur la barre de progression pour changer la position
        document.addEventListener('DOMContentLoaded', function() {
            const progressContainer = document.querySelector('.player-progress');
            
            progressContainer.addEventListener('click', function(e) {
                if (audioPlayer && audioPlayer.duration) {
                    const clickPosition = (e.clientX - progressContainer.getBoundingClientRect().left) / progressContainer.offsetWidth;
                    audioPlayer.currentTime = clickPosition * audioPlayer.duration;
                }
            });
        });
    </script>
</body>
</html>