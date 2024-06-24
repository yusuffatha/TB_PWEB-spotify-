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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Query untuk menghapus data dari database berdasarkan id
    $sql = "DELETE FROM audio_files WHERE id_audio_files = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();

// Redirect back to the playlist page
header("Location: p1.php");
exit();
?>
