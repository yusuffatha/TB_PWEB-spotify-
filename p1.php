<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
    <link rel="stylesheet" href="playlist.css">
    <link rel="icon" href="assets/spotify-logo.png" type="img/png">
    <script src="https://kit.fontawesome.com/0835df0ce7.js" crossorigin="anonymous"></script>
    <style>
        /* Gaya untuk formulir pop-up */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .modal-content {
            background-color: #121212;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            color: white;
        }

        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
        }

        .modal-content form label,
        .modal-content form input,
        .modal-content form textarea,
        .modal-content form button {
            margin: 10px 0;
        }

        .modal-content form input,
        .modal-content form textarea {
            background-color: #222;
            border: none;
            padding: 10px;
            border-radius: 4px;
            color: white;
        }

        .modal-content form button {
            padding: 10px;
            background-color: #1db954;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .modal-content form button:hover {
            background-color: #1ed760;
        }

        .thumbnail-selection {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .thumbnail-selection img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            cursor: pointer;
        }

        .thumbnail-selection img.selected {
            border: 2px solid #1db954;
        }

        .modal-content form textarea {
            resize: none;
        }

        .modal-content .note {
            font-size: 12px;
            color: #888;
            margin-top: 20px;
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
        <div class="header">
            <div class="topbar">
                <div class="prev-next-buttons">
                    <button type="button" class="fa fas fa-chevron-left"></button>
                    <button type="button" class="fa fas fa-chevron-right"></button>
                </div>
            </div>
            
            <div class="playlist-content">
              <?php
              $servername = "localhost";
              $username = "root"; // username MySQL Anda
              $password = ""; // password MySQL Anda
              $dbname = "spotifylite";

              // Membuat koneksi
              $conn = new mysqli($servername, $username, $password, $dbname);

              // Memeriksa koneksi
              if ($conn->connect_error) {
                  die("Koneksi gagal: " . $conn->connect_error);
              }
              
              // Query SQL untuk mencari playlist berdasarkan judul
              $sql = "SELECT * FROM playlist WHERE Id = '1'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<div class='playlist-cover' id='updateBtn'>
                                <a href='#'><img src='{$row['thumbnail']}'></a>
                            </div>
                            <div class='playlist-info'>
                              <div class='playlist-public'>PLAYLIST PUBLIK</div>
                              <div class='playlist-title'>
                                <p>{$row['title']}</p>
                              </div>
                              <div class='playlist-user'>
                                <p>{$row['username']}</p>
                              </div>
                              <div class='playlist-description'>
                                <p>{$row['description']}</p>
                              </div>
                              <div style='height: 10px;'></div>
                              <div class='playlist-stats'>
                                <img src='assets/spotify-logo.png' width='24px' height='24px' alt=''>
                                <span> Spotify ·</span>
                                <span>5,131,321 suka · </span>
                                <span>100 lagu, </span>
                                <span>6 jam 57 menit </span> 
                              </div>
                              <div style='height: 10px;'></div>
                            </div>";
                  }
              } else {
                  echo "Tidak ada playlist yang ditemukan";
              }

              ?>
            </div>
        </div>
        
        <div class="playlist-songs-container">
            <div class="playlist-buttons">
                <div class="playlist-buttons-left">
                    <div class="playlist-buttons-resume-pause">
                        <img src="assets/Pause.svg" alt="">
                    </div>
                    <div class="playlist-buttons-like">
                        <img src="assets/FiiledLike.svg" alt="" class="spotify-color">
                    </div>
                    <div class="playlist-buttons-download">
                        <a href="addSong.php"><img src="assets/plus.svg" alt="" style="width: 45px; height: 45px; filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(360deg) brightness(100%) contrast(100%);"></a>  
                    </div>
                </div>
                <div class="playlist-buttons-right">
                    <div class="playlist-buttons-search">
                        <img src="assets/Search.svg" alt="">
                    </div>
                    <div class="playlist-buttons-order">
                        Custom Order
                    </div>
                </div>
            </div>
         
            <div class="playlist-songs">
                <table>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Album</th>
                        <th>Date Added</th>
                        <th>Play Back</th>
                        <th></th>
                    </tr>
                    <?php
                    // Membuat koneksi
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "spotifylite";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Mengecek koneksi
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query untuk mengambil data dari database termasuk id
                    $sql = "SELECT id_audio_files, title, artist, audio_data, filename, upload_date, profile_photo FROM audio_files";
                    $result = $conn->query($sql);
                    $a = 0;
                    if ($result->num_rows > 0) {
                        // Menampilkan data untuk setiap baris hasil query
                        while($row = $result->fetch_assoc()) {
                            $a++;
                            $id = $row['id_audio_files'];
                            $title = $row['title'];
                            $artist = $row['artist'];
                            $audioData = base64_encode($row['audio_data']);
                            $fileName = $row['filename'];
                            $uploadDate = date("F d, Y", strtotime($row['upload_date'])); 
                            $profilePhoto = base64_encode($row['profile_photo']);
                    
                            echo "<tr>
                                    <td>$a</td>
                                    <td class='song-title'>
                                        <div style='display: flex; align-items: center;'>
                                            <img src='data:image/jpeg;base64,$profilePhoto' alt='Profile Photo' style='width: 40px; height: 40px; margin-right: 10px;'>
                                        <div>
                                            <div style='font-weight: bold;'>$title</div>
                                            <div style='font-size: 14px; color: #888;'>$artist</div>
                                        </div>
                                        </div>
                                    </td>
                                    <td class='song-album'>Spotify</td> 
                                    <td class='song-date-added'>$uploadDate</td> 
                                    <td>
                                        <div class='audio-controls'>
                                            <audio controls>                      
                                                <source src='data:audio/mpeg;base64,$audioData' type='audio/mpeg'>
                                                Your browser does not support the audio element.
                                            </audio>  
                                        </div>                                  
                                    </td>
                                    <td>
                                        <form method='post' action='deleteSong.php' style='display: inline;'>
                                            <input type='hidden' name='id' value='$id'>
                                            <button class='deleteSong' type='submit' name='submit' style='
                                                background-color: #1ed760;
                                                border-radius: 30px;
                                                font-weight: bold;
                                                height: 25px;
                                                width: 100px;
                                                letter-spacing: .4px;
                                                font-size: 16px;
                                                border: none;
                                                color: black;
                                                cursor: pointer;'>
                                                DELETE
                                            </button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </table> 
            </div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="updateForm">
                    <input type="hidden" name="id" value="1">
                    <label for="title">Judul Playlist:</label>
                    <input type="text" id="title" name="title" value=""><br><br>
                    <label for="username">Nama Pengguna:</label>
                    <input type="text" id="username" name="username" value=""><br><br>
                    <label for="description">Deskripsi:</label>
                    <textarea id="description" name="description"></textarea><br><br>
                    <input type="submit" value="Perbarui">
                </form>
            </div>
        </div>

        <script>
            // Dapatkan modal
            var modal = document.getElementById("myModal");

            // Dapatkan tombol yang membuka modal
            var btn = document.getElementById("updateBtn");

            // Dapatkan elemen <span> yang menutup modal
            var span = document.getElementsByClassName("close")[0];

            // Ketika pengguna mengklik tombol, buka modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // Ketika pengguna mengklik <span> (x), tutup modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // Ketika pengguna mengklik di luar modal, tutup modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // AJAX untuk mengupdate data tanpa berpindah halaman
            document.getElementById('updateForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                var formData = new FormData(this);

                fetch('updatePlaylist.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Playlist berhasil diperbarui!');
                        modal.style.display = 'none';
                        // Update data pada halaman tanpa reload
                        document.querySelector('.playlist-title p').textContent = data.title;
                        document.querySelector('.playlist-user p').textContent = data.username;
                        document.querySelector('.playlist-description p').textContent = data.description;
                    } else {
                        alert('Gagal memperbarui playlist: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
            });
        </script>

</body>
</html>