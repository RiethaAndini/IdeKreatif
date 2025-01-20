<?php
require_once("../config.php");
//memulai session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        // simpan notifikasi ke dalam session
        $_SESSION['notification'] = [ 
            'type' => 'primary',
            'massage' => 'Registrasi berhasil!'
        ];
    } else {
        $_SESSION['notification'] = [ 
            'type' => 'primary',
            'massage' => 'Gagal Registrasi: ' . mysqli_error($conn)
        ];
    }
    header('Location: login.php');
    exit();
}

$conn->close();
?>