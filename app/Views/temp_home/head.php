<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($judul) ?></title>
    <meta name="description" content="<?= esc($pengaturan['seo'] ?? '') ?>">
    <meta name="keywords" content="<?= esc($pengaturan['keyword'] ?? '') ?>">
    <meta name="author" content="<?= esc($pengaturan['nama_perusahaan'] ?? 'Nama Perusahaan') ?>">

    <link rel="icon" href="<?= base_url('temp_home/assets/img/icon.png') ?>">
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
</head>
