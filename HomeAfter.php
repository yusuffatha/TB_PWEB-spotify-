<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
    <link rel="stylesheet" href="homeAfter.css">
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
            <a href="#">
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
            <a href="library.php">
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
     
      <div class="SPOTI-LIST">
        <h2>Spotify Playlists</h2>

        <div class="daftar">
          <?php
          $servername = "localhost";
          $username = "root"; // your MySQL username
          $password = ""; // your MySQL password
          $dbname = "spotifylite";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM playlist";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<div class='myList'>
                          <div class='items'>
                            <a href='{$row['otherpageurl']}'><img src='{$row['thumbnail']}'></a>
                            <div class='play'>
                              <span class='fa fa-play'></span>
                            </div>
                            <a href='{$row['otherpageurl']}'><h4>{$row['title']}</h4></a>
                            <p>{$row['description']}</p>
                          </div>
                        </div>";
              }
          } else {
              echo "No playlist found";
          }
          $conn->close();
          ?>
      </div>

      <div class="spotify-playlists">
        <h2>Focus</h2>
        <div class="list">
          <div class="item">
            <img src="foto/9.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Peaceful Piano</h4>
            <p>Relax and indulge with beautiful piano pieces</p>
          </div>

          <div class="item">
            <img src="foto/10.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Deep Focus</h4>
            <p>Keep calm and focus with ambient and pos...</p>
          </div>

          <div class="item">
            <img src="foto/11.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Instrumental Study</h4>
            <p>Focus with soft study music in the...</p>
          </div>

          <div class="item">
            <img src="foto/12.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>chill lofi study beats</h4>
            <p>The perfect study beats, twenty four...</p>
          </div>

          <div class="item">
            <img src="foto/13.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Coding Mode</h4>
            <p>Dedicated to all the programmers out there.</p>
          </div>
          
          <div class="item">
            <img src="foto/14.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Focus Flow</h4>
            <p>Uptempo instrumental hip hop beats.</p>
          </div>

          <div class="item">
            <img src="foto/15.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Calm Before The Storm</h4>
            <p>Calm before the storm music.</p>
          </div>

          <div class="item">
            <img src="foto/16.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Beats to think to</h4>
            <p>Focus with deep techno and tech house.</p>
          </div>
        </div>
      </div>

      <div class="spotify-playlists">
        <h2>Mood</h2>
        <div class="list">
          <div class="item">
            <img src="foto/17.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Mood Booster</h4>
            <p>Get happy with today's dose of feel-good...</p>
          </div>

          <div class="item">
            <img src="foto/18.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Feelin' Good</h4>
            <p>Feel good with this positively timeless...</p>
          </div>

          <div class="item">
            <img src="foto/19.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Dark & Stormy</h4>
            <p>Beautifully dark, dramatic tracks.</p>
          </div>

          <div class="item">
            <img src="foto/20.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Feel Good Piano</h4>
            <p>Happy vibes for an upbeat morning.</p>
          </div>

          <div class="item">
            <img src="foto/21.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Feelin' Myself</h4>
            <p>The hip-hop playlist that's a whole mood...</p>
          </div>

          <div class="item">
            <img src="foto/1.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Chill Tracks</h4>
            <p>Softer kinda dance</p>
          </div>

          <div class="item">
            <img src="foto/1.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>Feel-Good Indie Rock</h4>
            <p>The best indie rock vibes - classic and...</p>
          </div>

          <div class="item">
            <img src="foto/1.jpeg" alt="Rizky Febian">
            <div class="play">
              <span class="fa fa-play"></span>
            </div>
            <h4>idk.</h4>
            <p>idk.</p>
          </div>
        </div>

        <hr>
      </div>

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