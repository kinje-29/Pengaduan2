// const serviceID = 'service_t4pgpgt'; // Ganti dengan Service ID Anda
// const templateID = 'template_lkq4sz9';
// Ambil elemen form
const form = document.getElementById('email-form');

// Tambahkan event listener untuk submit form
form.addEventListener('submit', function (event) {
    event.preventDefault(); // Mencegah submit form secara default

    const serviceID = 'service_t4pgpgt'; // Ganti dengan Service ID Anda
    const templateID = 'template_lkq4sz9'; // Ganti dengan Template ID Anda

    // Kirim data form melalui EmailJS
    emailjs.sendForm(serviceID, templateID, form)
        .then(() => {
            alert('Email berhasil dikirim!');
            // form.reset(); // Reset form setelah berhasil mengirim
        })
        .catch((error) => {
            console.error('Gagal mengirim email:', error);
            alert('Gagal mengirim email. Silakan coba lagi nanti.');
        });
});