<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spotifylite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit']) && isset($_FILES['audio_file']) && isset($_FILES['profile_photo'])) {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $audioFile = $_FILES['audio_file']['tmp_name'];
    $audioFileName = $_FILES['audio_file']['name'];
    $audioFileData = addslashes(file_get_contents($audioFile));
    
    $profilePhoto = $_FILES['profile_photo']['tmp_name'];
    $profilePhotoData = addslashes(file_get_contents($profilePhoto));

    $sql = "INSERT INTO audio_files (title, artist, audio_data, filename, profile_photo) VALUES ('$title', '$artist', '$audioFileData', '$audioFileName', '$profilePhotoData')";

    if ($conn->query($sql) === TRUE) {
        header("Location: library.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
    <link rel="icon" href="assets/spotify-logo.png" type="img/png">
    <link rel="icon" href="assets/spotify-logo.png" type="img/png">
    <script src="https://kit.fontawesome.com/0835df0ce7.js" crossorigin="anonymous"></script>
    <style>
        *{
    padding: 0;
    margin: 0;
  }
  body {
    background-color: #121212;
    font-family: 'Montserrat', sans-serif;
  }
  
  .sidebar {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    width: 196px;
    background-color: #000000;
    padding: 24px;
  }
  .sidebar .logo img {
    width: 130px;
  }
  .sidebar .navigation ul {
    list-style: none;
    margin-top: 20px;
  }
  .sidebar .navigation ul li {
    padding: 10px 0px;
  }
  .sidebar .navigation ul li a {
    color: #b3b3b3;
    text-decoration: none;
    font-weight: bold;
    font-size: 13px;
  }
  .sidebar .navigation ul li a:hover,
  .sidebar .navigation ul li a:active,
  .sidebar .navigation ul li a:focus {
    color: #ffffff;
  }
  .sidebar .navigation ul li a:hover .fa,
  .sidebar .navigation ul li a:active .fa,
  .sidebar .navigation ul li a:focus .fa {
    color: #b3b3b3;
  }
  .sidebar .navigation ul li .fa {
    font-size: 20px;
    margin-right: 10px;
  }
  .sidebar .navigation ul li a:hover .fa:hover,
  .sidebar .navigation ul li a:hover .fa:active,
  .sidebar .navigation ul li a:hover .fa:focus {
    color: #ffffff;
  }
  .menu-playlists ul {
    list-style: none;
    
  }
  .menu-playlists ul li {
    padding: 10px 0px;
  }
  .menu-playlists ul li a {
    color: #b3b3b3;
    text-decoration: none;
    font-weight: bold;
    font-size: 13px;
  }
  .menu-playlists ul li a:hover,
  .menu-playlists ul li a:active,
  .menu-playlists ul li a:focus {
    color: #ffffff;
  }
  .menu-playlists ul li a:hover .fa,
  .menu-playlists ul li a:active .fa,
  .menu-playlists ul li a:focus .fa {
    color: #b3b3b3;
  }
  .menu-playlists ul li .fa {
    font-size: 20px;
    margin-right: 10px;
  }
  .menu-playlists ul li a:hover .fa:hover,
  .menu-playlists ul li a:hover .fa:active,
  .menu-playlists ul li a:hover .fa:focus {
    color: #ffffff;
  }
  .sidebar .policies {
    position: absolute;
    bottom: 40px;
  }
  .sidebar .policies ul {
    list-style: none;
  }
  .sidebar .policies ul li {
    padding-bottom: 5px;
  }
  .sidebar .policies ul li a {
    color: #b3b3b3;
    font-weight: 500;
    text-decoration: none;
    font-size: 10px;
  }
  .sidebar .policies ul li a:hover,
  .sidebar .policies ul li a:active,
  .sidebar .policies ul li a:focus {
    text-decoration: underline;
  }
  
section {
    background: linear-gradient(rgb(47, 42, 42); 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

section div.main{
    margin: 32px 0;
    padding: 32px;
    width: 734px;
    height: 200px;
    background: linear-gradient(rgb(47, 42, 42); 100%);
    border-radius: 5px;
}
section div.main h2{
    text-align: center;
    margin: 48px 0;
    color: white;
    font-size: 30px;
}
section div.main .addSong{
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

section div.main .addSong form label{
    color: white;
    font-size: 14px;
    margin-bottom: 8px;
    display: inline-block;
}

section div.main .addSong form input{
    display: block;
    padding: 14px;
    width: 324px;
    margin-bottom: 15px;
    font-size: 15px;
    font-weight: 500;
    background: rgb(0, 0, 0);
    outline: none;
    border: none;
    appearance: none;
    border-radius: 4px;
    box-sizing: inset 0 0 0 1px #878787;
    color: white;
}
section div.main .addSong button {
    background-color: #1ed760;
    border-radius: 30px;
    font-weight: bold;
    padding: 8px 32px;
    height: 48px;
    width: 354px;
    letter-spacing: .4px;
    font-size: 16px;
    margin: 20px 0px;
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
        <section>
            <div class="main">
                <h2>Add Song</h2>

                <div class="addSong">
                    <form action="addSong.php" method="post" enctype="multipart/form-data">
                        <label>Title</label>
                        <input type="text" placeholder="Title" name="title" required><br>

                        <label>Artist</label>
                        <input type="text" placeholder="Artist Name" name="artist" required><br>

                        <label>Select audio file to upload</label>
                        <input type="file" name="audio_file" id="audio_file" required><br>

                        <label>Select profile photo to upload</label>
                        <input type="file" name="profile_photo" id="profile_photo" required><br>
                        
                        <button type="submit" name="submit">Upload Audio</button>
                    </form>
                </div>
            </div>
</body>
</html>
