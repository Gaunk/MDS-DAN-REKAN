<?php

namespace App\Controllers;

use App\Models\PengaturanSistemModel;
use App\Models\PengacaraModel;

class Home extends BaseController
{
    public function index(): string
    {
        // Ambil pengaturan sistem (baris pertama)
        $pengaturan = (new PengaturanSistemModel())->first() ?? [];

        // Ambil semua pengacara
        $pengacara = (new PengacaraModel())->findAll();

        // Siapkan data global untuk view
        $data = [
            'judul'      => $pengaturan['nama_perusahaan'] ?? 'Nama Perusahaan',
            'pengaturan' => $pengaturan,
            'pengacara'  => $pengacara
        ];

        // Load view
        return 
            view('temp_home/head', $data) .
            view('temp_home/nav', $data) .
            view('home', $data) .
            view('temp_home/footer', $data);
    }
}
