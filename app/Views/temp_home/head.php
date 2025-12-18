<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($judul) ?></title>
    <meta name="description" content="<?= esc($pengaturan['seo'] ?? '') ?>">
    <meta name="keywords" content="<?= esc($pengaturan['keyword'] ?? '') ?>">
    <meta name="author" content="<?= esc($pengaturan['nama_perusahaan'] ?? 'Nama Perusahaan') ?>">

    <link rel="icon" href="<?= base_url('temp_home/assets/img/icon-1.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('temp_home/assets/img/apple-touch-icon.png') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="<?= base_url('temp_home/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('temp_home/') ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('temp_home/assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('temp_home/assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('temp_home/assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('temp_home/assets/css/main.css') ?>" rel="stylesheet">
    <!-- Link AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<style>
/* Latar belakang popup */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none; /* awalnya tersembunyi */
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Kotak popup */
.popup-content {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    max-width: 500px;
    text-align: center;
    position: relative;

    /* Animasi */
    opacity: 0;
    transform: translateY(-50px);
    transition: all 0.6s ease;
}

.popup-overlay.show .popup-content {
    opacity: 1;
    transform: translateY(0);
}

.popup-content img {
    max-width: 100%;
    border-radius: 10px;
}

/* Tombol tutup */
.close-btn {
    margin-top: 15px;
    padding: 10px 20px;
    background: #f44336;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>

</head>
