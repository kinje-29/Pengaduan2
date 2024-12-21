<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// echo realpath('private/PHPMailer/src/Exception.php');
// exit;

require_once('C:/xampp/htdocs/pengaduan/private/PHPMailer/src/Exception.php');
require_once('C:/xampp/htdocs/pengaduan/private/PHPMailer/src/PHPMailer.php');
require_once('C:/xampp/htdocs/pengaduan/private/PHPMailer/src/SMTP.php');



session_start();
require_once("database.php");
// header("Location: ../index?status=success");
// Atasi Undefined
$nama = $email = $telpon = $alamat = $pengaduan = $captcha = $is_valid = "";
$namaError = $emailError = $telponError = $alamatError = $pengaduanError = $captchaError = "";

if (isset($_POST['submit'])) {
    $nomor     = $_POST['nomor'];
    $nama      = $_POST['nama'];
    $email     = $_POST['email'];
    $telpon    = $_POST['telpon'];
    $alamat    = $_POST['alamat'];
    $tujuan    = $_POST['tujuan'];
    $pengaduan = $_POST['pengaduan'];
    $captcha   = $_POST['captcha'];
    $is_valid  = true;

    validate_input();
    // yvio myjc obvz xmzi
    // Proses unggah file foto jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto_tmp  = $_FILES['foto']['tmp_name'];
        $foto_name = basename(path: $_FILES['foto']['name']);
        $foto_path = '../foto/' . $foto_name;

        if (move_uploaded_file(from: $foto_tmp, to: $foto_path)) {
            if ($is_valid) {
                $sql = "INSERT INTO `laporan` (`id`, `nama`, `email`, `telpon`, `alamat`, `tujuan`, `foto`, `isi`, `tanggal`, `status`) 
                        VALUES (:nomor, :nama, :email, :telpon, :alamat, :tujuan, :foto, :isi, CURRENT_TIMESTAMP, :status)";
                $stmt = $db->prepare(query: $sql);
                $stmt->bindValue(param:  ':nomor', value:   $nomor);
                $stmt->bindValue(param: ':nama', value:  $nama);
                $stmt->bindValue(param: ':email', value:  $email);
                $stmt->bindValue(param: ':telpon', value:  $telpon);
                $stmt->bindValue(param: ':alamat', value:  htmlspecialchars($alamat));
                $stmt->bindValue(param: ':tujuan', value:  $tujuan);
                $stmt->bindValue(param: ':foto', value:  $foto_name);
                $stmt->bindValue(param: ':isi', value:  htmlspecialchars($pengaduan));
                $stmt->bindValue(param: ':status', value: "Menunggu");

                header:
                $stmt->execute();
                header(header: "Location: ../index?status=success");
                send_email($nomor, $nama, $email, $telpon, $alamat, $tujuan, $pengaduan, $foto_path);
                send_email_admin($nomor, $nama, $email, $telpon, $alamat, $tujuan, $pengaduan, $foto_path);

                kirimForm();

            } elseif (!$is_valid){
                header(header: "Location: ../lapor.php?nomor=$nomor&nama=$nama&namaError=$namaError&email=$email&emailError=$emailError&telepon=$telpon&telponError=$telponError&alamat=$alamat&alamatError=$alamatError&pengaduan=$pengaduan&pengaduanError=$pengaduanError&captcha=$captcha&capthcaError=$captchaError");
            }
        }
    }
}
function send_email($nomor, $nama, $email, $telpon, $alamat, $tujuan, $pengaduan, $foto_path) {
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Host SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'fajar.vds@gmail.com'; // Email pengirim
        $mail->Password = 'yvio myjc obvz xmzi'; // Password email pengirim (gunakan App Password jika pakai Gmail)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan email
        $mail->setFrom('fajar.vds@gmail.com', 'Kelurahan Jayasampurna');
        $mail->addAddress($email); // Email penerima
        $mail->addAttachment($foto_path); // Lampirkan foto

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = "Nomor Pengaduan : $nomor";
        $mail->Body = "
            <p>Hallo $nama, kami dari pihak petugas kelurahan Jayasampuran telah menerima laporan yang anda berikan.
            Petugas kami akan memeriksa langsung ke lolasi yang anda berikan dan berikut detail laporan yang anda berikan : <br></p>
            <h3>Detail Pengaduan</h3>
            <p><b>Nomor:</b> $nomor</p>
            <p><b>Nama:</b> $nama</p>
            <p><b>Email:</b> $email</p>
            <p><b>Telpon:</b> $telpon</p>
            <p><b>Alamat:</b> $alamat</p>
            <p><b>Tujuan:</b> $tujuan</p>
            <p><b>Isi Pengaduan:</b> <br>$pengaduan</p>
            <hr>
            <p>Untuk melihat tindak lanjut selanjutnya anda bisa melihat status Lihat pengaduan di situs web kami https://localhost/pengaduan/lihat dengan memasukan nomor pengaduan yang kami berikan  </p>
            <p>Terkait laporan yang anda berikan kami akan menghubungi kembali melalui email/status laporan di websate kami.<br>
            Terimaksi atas laporan yang anda berikan. <b>Kelurahan Jayasampurna</p>
        ";

        // Kirim email
        $mail->send();
        echo 'Pengaduan berhasil dikirim!';
    } catch (Exception $e) {
        echo "Pengaduan gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}

function send_email_admin($nomor, $nama, $email, $telpon, $alamat, $tujuan, $pengaduan, $foto_path) {
    $email_admin = 'fajar.vds@gmail.com';
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Host SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'fajar.vds@gmail.com'; // Email pengirim
        $mail->Password = 'yvio myjc obvz xmzi'; // Password email pengirim (gunakan App Password jika pakai Gmail)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan email
        $mail->setFrom('fajar.vds@gmail.com', 'Kelurahan Jayasampurna');
        $mail->addAddress($email_admin); // Email penerima
        $mail->addAttachment($foto_path); // Lampirkan foto

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = "Laporan Baru : $nomor";
        $mail->Body = "
            <h3>Laporan Baru Masuk</h3>
            <p><b>Nomor Pengaduan :</b> $nomor</p>
            <p><b>Nama Pelapor    :</b> $nama</p>
            <p><b>Email Pelapor   :</b> $email</p>
            <p><b>Telpon Pelapor  :</b> $telpon</p>
            <p><b>Alamat Pelapor  :</b> $alamat</p>
            <p><b>Tujuan Palapor  :</b> $tujuan</p>
            <p><b>Isi Pengaduan   :</b> <br>$pengaduan</p>
            <hr>
        ";

        // Kirim email
        $mail->send();
        echo 'Pengaduan berhasil dikirim!';
    } catch (Exception $e) {
        echo "Pengaduan gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}

// Fungsi Untuk Melakukan Pengecekan Dari Setiap Inputan Di Masing-masing Fungsi
function validate_input(): void
{
    global $nama, $email, $telpon, $alamat, $pengaduan, $captcha, $is_valid;
    cek_nama($nama);
    cek_email($email);
    cek_telpon($telpon);
    cek_alamat($alamat);
    cek_pengaduan($pengaduan);
    cek_captcha($captcha);

    if (isset($_FILES['foto']['name'])) {
        cek_foto($_FILES['foto']['name']);
    }
}

// Fungsi validasi foto, dengan parameter $foto
function cek_foto($foto): void
{
    global $is_valid, $fotoError;
    echo "cek_foto      : ", $foto, "<br>";
    if (!preg_match("/\.(jpg|jpeg|png|gif|bmp)$/i", $foto)) {
        $fotoError = "Foto hanya boleh jpg, jpeg, png, gif, atau bmp.";
        $is_valid = false;
    }
}

// validasi nama
function cek_nama($nama)
{
    global $nama, $is_valid, $namaError;
    echo "cek_nama      : ", $nama, "<br>";
    if (!preg_match("/^[a-zA-Z ]*$/", $nama)) { // cek nama bukan huruf
        $namaError = "Nama Hanya Boleh Huruf dan Spasi";
        $is_valid = false;
    } else { // jika nama valid kosongkan error
        $namaError = "";
    }
}

// validasi email
function cek_email($email)
{
    global $email, $is_valid, $emailError;
    echo "cek_email     : ", $email, "<br>";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // cek format email
        $emailError = "Email Tidak Valid";
        $is_valid = false;
    } else { // jika email valid kosongkan eror
        $emailError = "";
    }
}

// validasi telpon
function cek_telpon($telpon)
{
    global $telpon, $telponError, $is_valid;
    echo "cek_telpon    : ", $telpon, "<br>";
    if (!preg_match("/^[0-9]*$/", $telpon)) { // cek telpon hanya boleh angka
        $telponError = "Telpon Hanya Boleh Angka";
        $is_valid = false;
    } elseif (strlen($telpon) != 12) { // cek panjang telpon harus >= 6
        $telponError = "Panjang Telpon Harus 12 Digit";
        $is_valid = false;
    } else { // jika telpon valid kosongkan error
        $telponError = "";
    }
}

// validasi alamat
function cek_alamat($alamat)
{
    global $alamat, $is_valid, $alamatError;
    echo "cek_alamat    : ", $alamat, "<br>";
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $alamat)) { // cek fullname bukan huruf
        $alamatError = "Alamat Hanya Boleh Huruf dan Angka";
        $is_valid = false;
    } else { // jika fullname valid kosongkan error
        $alamatError = "";
    }
}

// validasi pengaduan
function cek_pengaduan($pengaduan)
{
    global $pengaduan, $is_valid, $pengaduanError;
    echo "cek_pengaduan : ", $pengaduan, "<br>";
    if (strlen($pengaduan) > 2048) { // cek fullname bukan huruf
        $pengaduanError = "Isi Pengaduan Tidak Boleh Huruf Lebih Dari 2048 Karakter";
        $is_valid = false;
    } else { // jika pengaduan valid kosongkan error
        $pengaduanError = "";
    }
}

// validasi captcha
function cek_captcha($captcha)
{
    global $captcha, $is_valid, $captchaError;
    echo "cek_captcha   : ", $captcha, "<br>";
    if ($captcha != $_SESSION['bilangan']) { // cek fullname bukan huruf
        $captchaError = "Captcha Salah atau Silahkan Reload Browser Anda";
        $is_valid = false;
    } else { // jika pengaduan valid kosongkan error
        $captchaError = "coba lagi!!!";
    }
}