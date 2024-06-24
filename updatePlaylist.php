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

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $username = $_POST['username'];
    $description = $_POST['description'];

    $sql = "UPDATE playlist SET title='$title', username='$username', description='$description' WHERE Id='$id'";

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
        $response['title'] = $title;
        $response['username'] = $username;
        $response['description'] = $description;
    } else {
        $response['success'] = false;
        $response['error'] = "Error updating record: " . $conn->error;
    }
} else {
    $response['success'] = false;
    $response['error'] = "Invalid request method";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>