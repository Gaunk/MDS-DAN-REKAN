<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('/contact/submit', 'Home::submit');

$routes->get('word/create', 'Word::create');

$routes->get('profile/(:num)', 'Profile::view/$1');

// ============================
// ROUTE PROTECTED (Wajib Login & Role SESUAI)
// ============================

/// ==========================
// ROUTE ADMIN (WAJIB LOGIN ADMIN)
// ==========================
// ==========================
// ROUTE LOGIN ADMIN
// ==========================
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/doLogin', 'Admin::doLogin');
$routes->get('admin/logout', 'Admin::logout');

$routes->group('admin', [
    'namespace' => 'App\Controllers',
    'filter'    => 'admin'   // pakai AdminFilter
], function($routes) {

    $routes->get('dashboard', 'Admin::dashboard');

    // Pengguna / User Management
    $routes->get('listpengguna', 'Admin::listpengguna');
    $routes->post('savepengguna', 'Admin::savepengguna');
    $routes->post('updatepengguna', 'Admin::updatepengguna');
    $routes->get('deletepengguna/(:num)', 'Admin::deletepengguna/$1');
    $routes->get('editpengguna/(:num)', 'Admin::editpengguna/$1');

    // Klien
    $routes->get('listklien', 'Admin::listklien');
    $routes->post('saveklien', 'Admin::saveklien');
    $routes->post('updateklien', 'Admin::updateklien');
    $routes->get('deleteklien/(:num)', 'Admin::deleteklien/$1');

    // Pertemuan
    $routes->get('jadwalpertemuan', 'Admin::jadwalpertemuan');
    $routes->post('savepertemuan', 'Admin::savepertemuan');
    $routes->post('updatepertemuan', 'Admin::updatepertemuan');
    $routes->get('deletepertemuan/(:num)', 'Admin::deletepertemuan/$1');

    // Perkara
    $routes->get('listperkara', 'Admin::listperkara');
    $routes->post('saveperkara', 'Admin::saveperkara');
    $routes->post('updateperkara', 'Admin::updateperkara');
    $routes->get('deleteperkara/(:num)', 'Admin::deleteperkara/$1');
    $routes->get('statuskasus', 'Admin::statuskasus');

    // Jadwal Sidang
    $routes->get('jadwalsidang', 'Admin::jadwalsidang');

    // Pengacara
    $routes->get('pengacara', 'Admin::pengacara');
    $routes->post('savepengacara', 'Admin::savePengacara');
    $routes->post('updatepengacara', 'Admin::updatePengacara');
    $routes->get('deletepengacara/(:num)', 'Admin::deletePengacara/$1');
    //
    $routes->get('kalender_aktivitas', 'Admin::kalender_aktivitas');
    $routes->get('tagihan', 'Admin::tagihan');
    $routes->post('tambahtagihan', 'Admin::tambahTagihan');
    $routes->post('updatetagihan', 'Admin::updateTagihan');
    $routes->get('deletetagihan/(:num)', 'Admin::deleteTagihan/$1');
    $routes->get('pembayaran', 'Admin::pembayaran');
    $routes->post('tambahpembayaran', 'Admin::tambahpembayaran');
    $routes->post('updatepembayaran', 'Admin::updatePembayaran');
    $routes->get('deletepembayaran/(:num)', 'Admin::deletepembayaran/$1');
    //
    $routes->get('pengeluaranuang', 'Admin::pengeluaranUang');
    $routes->post('savepengeluaran', 'Admin::savePengeluaran');
    $routes->get('updatepengeluaranuang', 'Admin::updatePengeluaranUang');
    $routes->get('deletepengeluaranuang/(:num)', 'Admin::deletePengeluaranUang/$1');
    // 
    $routes->get('laporankeuangan', 'Admin::laporankeuangan');
    $routes->post('tambahpembayaran', 'Admin::tambahpembayaran');
    $routes->post('updatepembayaran', 'Admin::updatePembayaran');
    $routes->get('deletepembayaran/(:num)', 'Admin::deletepembayaran/$1');
    //
    $routes->get('honorariumpengacara', 'Admin::honorariumPengacara');
    $routes->post('proses_honorariumpengacara', 'Admin::proses_honorariumPengacara');
    $routes->post('updatehonorariumpengacara', 'Admin::updatehonorariumPengacara');
    $routes->get('deletehonorariumpengacara/(:num)', 'Admin::deletehonorariumPengacara/$1');
    //
    $routes->get('honorariumpengacara', 'Admin::honorariumPengacara');
    $routes->post('proses_honorariumpengacara', 'Admin::proses_honorariumPengacara');
    $routes->post('updatehonorariumpengacara', 'Admin::updatehonorariumPengacara');
    $routes->get('deletehonorariumpengacara/(:num)', 'Admin::deletehonorariumPengacara/$1');
    //
    $routes->get('suratkuasa', 'Admin::suratKuasa');
    $routes->post('proses_suratkuasa', 'Admin::proses_suratKuasa');
    $routes->post('updatesuratkuasa', 'Admin::updatesuratKuasa');
    $routes->get('deletesuratkuasa/(:num)', 'Admin::deleteSuratKuasa/$1');
    $routes->get('suratkuasaword/(:num)', 'Admin::suratKuasaWord/$1');
    //
    $routes->get('barcodeqr', 'Admin::barcodeQr');                      // Menampilkan halaman daftar barcode / QR
    $routes->post('prosesbarcode', 'Admin::prosesBarcode');  // Proses menambah barcode
    $routes->post('updatebarcode', 'Admin::updateBarcode');  // Update barcode pengacara
    $routes->delete('deletebarcode/(:num)', 'Admin::deleteBarcode/$1');  // Hapus barcode berdasarkan ID

    // 
    $routes->get('dokumenperkara', 'Admin::dokumenPerkara');
    $routes->post('proses_dokumenperkara', 'Admin::proses_dokumenPerkara');
    $routes->post('updatedokumenperkara', 'Admin::updateDokumenPerkara');
    $routes->get('deletedokumenperkara/(:num)', 'Admin::deleteDokumenPerkara/$1');
    // 
    $routes->get('proses_kwitansi/(:num)', 'Admin::proses_kwitansi/$1');
    // 
    $routes->get('account', 'Admin::account');
    $routes->post('updateaccount', 'Admin::updateAccount');
    //
    $routes->get('pengaturansistem', 'Admin::pengaturanSistem');
    $routes->post('proses_pengaturansistem', 'Admin::proses_pengaturanSistem');
    // 

});


// ==========================
// ROUTE LOGIN PENGACARA
// ==========================
$routes->get('pengacara/login', 'Pengacara::login');
$routes->post('pengacara/doLogin', 'Pengacara::doLogin');
$routes->get('pengacara/logout', 'Pengacara::logout');
$routes->group('pengacara', [
    'namespace' => 'App\Controllers',
    'filter'    => 'pengacara'   // ⬅ filter baru
], function($routes) {

    $routes->get('dashboard', 'Pengacara::dashboard');
    $routes->post('savepengacara', 'Pengacara::savePengacara');
    $routes->post('updatepengacara', 'Pengacara::updatePengacara');
    $routes->get('deletepengacara/(:num)', 'Pengacara::deletePengacara/$1');

    // Klien
    $routes->get('listklien', 'Pengacara::listklien');
    $routes->post('saveklien', 'Pengacara::saveklien');
    $routes->post('updateklien', 'Pengacara::updateklien');
    $routes->get('deleteklien/(:num)', 'Pengacara::deleteklien/$1');

    // Pertemuan
    $routes->get('jadwalpertemuan', 'Pengacara::jadwalpertemuan');
    $routes->post('savepertemuan', 'Pengacara::savepertemuan');
    $routes->post('updatepertemuan', 'Pengacara::updatepertemuan');
    $routes->get('deletepertemuan/(:num)', 'Pengacara::deletepertemuan/$1');

    // Perkara
    $routes->get('listperkara', 'Pengacara::listperkara');
    $routes->post('saveperkara', 'Pengacara::saveperkara');
    $routes->post('updateperkara', 'Pengacara::updateperkara');
    $routes->get('deleteperkara/(:num)', 'Pengacara::deleteperkara/$1');
    $routes->get('statuskasus', 'Pengacara::statuskasus');

    // Jadwal Sidang
    $routes->get('jadwalsidang', 'Pengacara::jadwalsidang');

    // Pengacara
    $routes->get('pengacara', 'Admin::pengacara');
    $routes->post('savepengacara', 'Admin::savePengacara');
    $routes->post('updatepengacara', 'Admin::updatePengacara');
    $routes->get('deletepengacara/(:num)', 'Admin::deletePengacara/$1');

});


// Staff (role = 3)
$routes->group('staff', [
    'namespace' => 'App\Controllers',
    'filter'    => 'role:3'
], function($routes) {
    // Tambahkan route untuk staff di sini
    // Misal: $routes->get('dashboard', 'Staff::dashboard');
});

// Paralegal (role = 4)
$routes->group('paralegal', [
    'namespace' => 'App\Controllers',
    'filter'    => 'role:4'
], function($routes) {
    // Tambahkan route untuk paralegal di sini
    // Misal: $routes->get('dashboard', 'Paralegal::dashboard');
});
