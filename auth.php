<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}
?>
