<?php
require 'C:/xampp/htdocs/pengaduan2/private/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    $nama = htmlspecialchars($_POST['nama'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    $confirm_password = htmlspecialchars($_POST['confirm_password'] ?? '');

    if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
        die("Semua bidang harus diisi.");
    }

    if ($password !== $confirm_password) {
        die("Password dan konfirmasi password tidak cocok.");
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Cek apakah email sudah terdaftar
        $stmt = $db->prepare("SELECT * FROM masyarakat WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            die("Email sudah terdaftar. <a href='login.php'>Kembali</a>.");


            // header('Location: login.php');
            // echo('Email Sudah terdaftar');
            // $error = "Email sudah terdaftar.";
            // include '#register'; // Menampilkan ulang halaman register
            // exit();
        }

        // Simpan data registrasi ke database
        $stmt = $db->prepare("INSERT INTO masyarakat (nama, email, password) VALUES (:nama, :email, :password)");
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();
        header('Location: login.php');
        exit();

        // echo "Registrasi berhasil! Silakan <a href='login.php'>login</a>.";
    } catch (PDOException $e) {
        die("Terjadi kesalahan: " . $e->getMessage());
    }
}
?>
