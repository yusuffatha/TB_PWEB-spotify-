<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
    <link rel="stylesheet" href="library.css">
    <link rel="icon" href="assets/spotify-logo.png" type="img/png">
    <style>
      .profile-icon img {
      background-color: #f2f2f2;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      vertical-align: middle;
    }
     /* Popup Menu */
     .popup-menu {
      display: none;
      position: absolute;
      right: 0;
      background-color: #333;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      width: 200px;
      border-radius: 8px;
    }

    .popup-menu a {
      color: white;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .popup-menu a:hover {
      background-color: #575757;
    }

    .popup-menu hr {
      border: 1px solid #444;
      margin: 0;
    }

    .show {
      display: block;
    }
    
    </style>
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
          <li>
            <a href="HomeAfter.php">
              <span class="fa fa-home"></span>
              <span>Home</span>
            </a>
          </li>

          <li>
            <a href="search.php">
              <span class="fa fa-search"></span>
              <span>Search</span>
            </a>
          </li>

          <li>
            <a href="#">
              <span class="fa fas fa-book"></span>
              <span>Your Library</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="navigation">
        <ul>
          <li>
            <a href="createPL.html">
              <span class="fa fas fa-plus-square"></span>
              <span>Create Playlist</span>
            </a>
          </li>

          <li>
            <a href="#">
              <span class="fa fas fa-heart"></span>
              <span>Liked Songs</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="policies">
        <ul>
          <li>
            <a href="#">Cookies</a>
          </li>
          <li>
            <a href="#">Privacy</a>
          </li>
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
            <li>
              <a href="#">Premium</a>
            </li>
            <li>
              <a href="#">Support</a>
            </li>
            <li>
              <a href="#">Download</a>
            </li>           
            <li>
              <a href="#" class="profile-icon" onclick="togglePopup()">
               <img src="assets/prof_icon.svg" alt="Profile">
              </a>
            <div id="popupMenu" class="popup-menu">
              <!-- <a href="#">Akun <span style="float:right;">&#x2197;</span></a> -->
              <a href="#">Profil</a>
              <!-- <a href="#">Upgrade ke Premium <span style="float:right;">&#x2197;</span></a>
              <a href="#">Pengaturan</a> -->
              <hr>
              <a onclick="location.href='index.php';">Keluar</a>
             </div>
            </li>    
            
        </div>
      </div>
     
      <div class="browse" style="display: flex; gap:10px; align-items: center; ">
        <h2>YOUR LIBRARY</h2>
        <div>
          <a href="addSong.php" style="text-decoration:none"><img src="assets/downloading.png" alt="">
        </div>
      </div>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "spotifylite";

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Mengecek koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query untuk mengambil data dari database
        $sql = "SELECT id_audio_files, title, artist, audio_data, filename, profile_photo FROM audio_files";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Menampilkan data untuk setiap baris hasil query
            while($row = $result->fetch_assoc()) {
                $id = $row['id_audio_files'];
                $title = $row['title'];
                $artist = $row['artist'];
                $audioData = base64_encode($row['audio_data']);
                $fileName = $row['filename'];
                $profilePhotoData = base64_encode($row['profile_photo']);
                
                echo "<div class='audio-container'>";
                echo "<img src='data:image/jpeg;base64,$profilePhotoData' alt='Profile Photo'>";
                echo "<div class='audio-details'>";
                echo "<h2>$title</h2>";
                echo "<p>$artist</p>";

                echo "</div>";
                echo "<div class='audio-form'>";

                echo "<form method='post' action='add_to_playlist.php'>";
                echo "<input type='hidden' name='audio_id' value='$id'>";

                echo "<div class='dropdown'>";
                echo "<button type='button' class='dropbtn'><i class='fa fa-plus'></i></button>";

                echo "<div class='dropdown-content'>";
                echo "<button type='submit' name='playlist' value='$id'>Playlist 1</button>";
                echo "<button type='submit' name='playlist' value='2'>Playlist 2</button>";
                echo "<button type='submit' name='playlist' value='3'>Playlist 3</button>";
                echo "</div>";

                echo "</div>";

                echo "</form>";

                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No records found.";
        }
        $conn->close();
        ?>

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

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
</body>

</div>
</body>
</html>