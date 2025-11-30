<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'tabel_pengguna';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'kata_sandi',
        'email',
        'peran',
        'tema',               // enum: light/dark
        'notifikasi_email',   // 0/1
        'pesan',
        'dibuat_pada',
    ];

    // Jika ingin auto-timestamp
    protected $useTimestamps = true;
    protected $createdField  = 'dibuat_pada';
    protected $updatedField  = 'diupdate_pada'; // buat kolom baru jika mau
}
