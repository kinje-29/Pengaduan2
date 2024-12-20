// const serviceID = 'service_t4pgpgt'; // Ganti dengan Service ID Anda
// const templateID = 'template_lkq4sz9';
// Ambil elemen form
const form = document.getElementsById('email-form');

// Tambahkan event listener untuk submit form
form.addEventListener('submit', function (event) {
    event.preventDefault(); // Mencegah submit form secara default

    const serviceID = 'service_t4pgpgt'; // Ganti dengan Service ID Anda
    const templateID = 'template_lkq4sz9'; // Ganti dengan Template ID Anda

    // Kirim data form melalui EmailJS
    emailjs.sendForm(serviceID, templateID, form)
        .then(() => {
            alert('Email berhasil dikirim!');

            // Setelah email berhasil dikirim, kirim data ke validasi.php
            const formData = new FormData(form);
            fetch('private/validasi.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data berhasil disimpan ke database!');
                        form.reset(); // Reset form jika diperlukan
                    } else {
                        alert('Gagal menyimpan data ke database: ' + data.message);
                    }
                })
                .catch(err => {
                    console.error('Kesalahan saat menyimpan data ke database:', err);
                    alert('Terjadi kesalahan saat menyimpan data ke database.');
                });
        })
        .catch((error) => {
            console.error('Gagal mengirim email:', error);
            alert('Gagal mengirim email. Silakan coba lagi nanti.');
        });
});