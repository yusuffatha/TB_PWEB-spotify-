<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
    <link rel="stylesheet" href="search1.css">
    <link rel="icon" href="assets/spotify-logo.png" type="image/png">
    <script src="https://kit.fontawesome.com/0835df0ce7.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <a href="HomeAfter.php">
                <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2018/11/Spotify_Logo_CMYK_Green.png" alt="Logo" />
            </a>
        </div>

        <div class="navigation">
            <ul>
                <li><a href="HomeAfter.php"><span class="fa fa-home"></span><span>Home</span></a></li>
                <li><a href="#"><span class="fa fa-search"></span><span>Search</span></a></li>
                <li><a href="library.php"><span class="fa fas fa-book"></span><span>Your Library</span></a></li>
            </ul>
        </div>

        <div class="navigation">
            <ul>
                <li><a href="createPL.html"><span class="fa fas fa-plus-square"></span><span>Create Playlist</span></a></li>
                <li><a href="#"><span class="fa fas fa-heart"></span><span>Liked Songs</span></a></li>
            </ul>
        </div>

        <div class="policies">
            <ul>
                <li><a href="#">Cookies</a></li>
                <li><a href="#">Privacy</a></li>
            </ul>
        </div>
    </div>

    <div class="main-container">
        <div class="topbar">
            <div class="prev-next-buttons">
                <button type="button" class="fa fas fa-chevron-left"></button>
                <button type="button" class="fa fas fa-chevron-right"></button>
            </div>

            <div class="navbar">
                <ul>
                    <li><a href="#">Premium</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Download</a></li>
                    <li>
                        <a href="#" class="profile-icon" onclick="togglePopup()">
                            <img src="assets/prof_icon.svg" alt="Profile">
                        </a>
                        <div id="popupMenu" class="popup-menu">
                            <a href="#">Profil</a>
                            <hr>
                            <a onclick="location.href='index.php';">Keluar</a>
                        </div>
                    </li>    
                </ul>
            </div>
        </div>

        <div class="search">
            <form method="POST" action="">
                <input type="text" id="filter" name="searchQuery" placeholder="What do you want to play?" class="tabSearch">
            </form>
        </div><br><br><br>

        <?php
        // Konfigurasi koneksi database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "spotifylite"; 

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Tangani permintaan pencarian
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $searchQuery = $_POST['searchQuery'];

            // Melakukan query ke database
            $sql = "SELECT id_audio_files, title, artist, profile_photo, audio_data FROM audio_files WHERE title LIKE ? OR artist LIKE ?";
            $stmt = $conn->prepare($sql);
            $likeQuery = "%" . $searchQuery . "%";
            $stmt->bind_param("ss", $likeQuery, $likeQuery);
            $stmt->execute();
            $result = $stmt->get_result();

            // Tampilkan hasil pencarian
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $title = $row['title'];
                    $artist = $row['artist'];
                    $audioData = base64_encode($row['audio_data']);
                    $profilePhotoData = base64_encode($row['profile_photo']);
                    
                    echo "<div class='music-web'>";
                    echo "<div class='music-player'>";
                    echo "<nav>";
                    echo "<div class='circle'>";
                    echo "<i class='fa-solid fa-bars'></i>";
                    echo "</div>";
                    echo "</nav>";
                    echo "<img src='data:image/jpeg;base64," . $profilePhotoData . "' class='song-img'>";
                    echo "<h1>" . $title . "</h1>";
                    echo "<p>" . $artist . "</p>";
                    echo "<div class='controls'>";
                    echo "<div onclick='playPause()'><i class='fa-solid fa-play' id='ctrlIcon'></i></div>";
                    echo "</div>";
                    echo "<audio id='song'>";
                    echo "<source src='data:audio/mpeg;base64," . $audioData . "' type='audio/mpeg'>";
                    echo "</audio>";
                    echo "<input type='range' value='0' id='progress'>";
                    echo "<div class='time'>";
                    echo "<span id='currentTime'>0:00</span> / <span id='duration'>0:00</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-results'>No results found.</p>";
            }
        }

        $conn->close();
        ?>

        <br>
        <div class="browse">
            <h2>BROWSE ALL MUSIC</h2>
        </div>
    <style>
        .container-Genre {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            padding: 16px;
        }
        .card {
            position: relative;
            background-color: #181818;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .card img {
            width: 250px;
            height: 250px;
            display: block;
        }
        .card h2 {
            color: #fff;
            position: absolute;
            top: 16px;
            left: 16px;
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container-Genre">
        <div class="card">
            <h2>Musik</h2>
            <img src="foto/music.jpeg" alt="Musik">
        </div>
        <div class="card">
            <h2>Podcast</h2>
            <img src="foto/podcast.jpeg" alt="Podcast">
        </div>
        <div class="card">
            <h2>Acara Langsung</h2>
            <img src="foto/acaraLangsung.jpeg" alt="Acara Langsung">
        </div>
        <div class="card">
            <h2>Dibuat Untuk Kamu</h2>
            <img src="foto/forYou.jpeg" alt="Dibuat Untuk Kamu">
        </div>
        <div class="card">
            <h2>Rilis Baru</h2>
            <img src="foto/rilisBaru.jpeg" alt="Rilis Baru">
        </div>
        <div class="card">
            <h2>Ramadan</h2>
            <img src="foto/ramadhan.jpeg" alt="Ramadan">
        </div>
        <div class="card">
            <h2>Pop</h2>
            <img src="foto/pop.jpeg" alt="Pop">
        </div>
        <div class="card">
            <h2>Musik Indonesia</h2>
            <img src="foto/indoMusik.jpeg" alt="Musik Indonesia">
        </div>
        <div class="card">
            <h2>Peringkat Podcast</h2>
            <img src="foto/peringkatPodcast.jpeg" alt="Peringkat Podcast">
        </div>
        <div class="card">
            <h2>Rilis Baru Podcast</h2>
            <img src="foto/rilisBaruPodcast.jpeg" alt="Rilis Baru Podcast">
        </div>
        <div class="card">
            <h2>Video Podcast</h2>
            <img src="foto/videoPodcast.jpeg" alt="Video Podcast">
        </div>
        <div class="card">
            <h2>Only on Spotify</h2>
            <img src="foto/onlySpotify.jpeg" alt="Only on Spotify">
        </div>
    </div>
</body>
</html>

           
        <script>
            function togglePopup() {
                var popup = document.getElementById("popupMenu");
                popup.classList.toggle("show");
            }

            window.onclick = function(event) {
                if (!event.target.matches('.profile-icon img')) {
                    var dropdowns = document.getElementsByClassName("popup-menu");
                    for (var i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>

        <script>
            let progress = document.getElementById("progress");
            let song = document.getElementById("song");
            let ctrlIcon = document.getElementById("ctrlIcon");
            let currentTime = document.getElementById("currentTime");
            let durationTime = document.getElementById("duration");

            song.onloadedmetadata = function () {
                progress.max = song.duration;
                durationTime.textContent = formatTime(song.duration);
            }

            function playPause(){
                if(song.paused){
                    song.play();
                    ctrlIcon.classList.add("fa-pause");
                    ctrlIcon.classList.remove("fa-play");
                } else {
                    song.pause();
                    ctrlIcon.classList.remove("fa-pause");
                    ctrlIcon.classList.add("fa-play");
                }
            }

            song.addEventListener('timeupdate', function(){
                progress.value = song.currentTime;
                currentTime.textContent = formatTime(song.currentTime);
            });

            progress.oninput = function(){
                song.currentTime = progress.value;
                currentTime.textContent = formatTime(song.currentTime);
            }

            function formatTime(time) {
                let minutes = Math.floor(time / 60);
                let seconds = Math.floor(time % 60);
                if (seconds < 10) {
                    seconds = `0${seconds}`;
                }
                return `${minutes}:${seconds}`;
            }
        </script>

    </div>
</body>
</html>
