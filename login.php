
<?php
require_once("private/database.php");
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Cari pengguna berdasarkan email
        $stmt = $db->prepare("SELECT id, nama, email, password FROM masyarakat WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Simpan ID pengguna ke session
            $_SESSION['id'] = $user['id'];
            header("Location: lapor.php");
            exit();
        } else {
            $error = "Email atau password salah.";
        }
    } catch (PDOException $e) {
        die("Terjadi kesalahan: " . $e->getMessage());
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Login Form -->
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Belum punya akun? <a href="#register" data-bs-toggle="modal">Daftar di sini</a></p>
                            <p><a href="index.php">Kembali</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pop-up Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Login Gagal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($error)) echo $error; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Register -->
    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerLabel">Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label for="regName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="regName" name="nama" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="regEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="regEmail" name="email" placeholder="Masukkan email" required>
                        </div>
                        <div class="mb-3">
                            <label for="regPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="regPassword" name="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="mb-3">
                            <label for="regConfirmPassword" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="regConfirmPassword" name="confirm_password" placeholder="Masukkan ulang password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Daftar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="text-center w-100">Sudah punya akun? <a href="#" data-bs-dismiss="modal">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (!empty($error)) : ?>
        <script>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        </script>
    <?php endif; ?>
</body>

</html>
