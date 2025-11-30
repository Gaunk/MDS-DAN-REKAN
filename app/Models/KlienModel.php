<?php

namespace App\Models;

use CodeIgniter\Model;

class KlienModel extends Model
{
    protected $table = 'tabel_klien';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama',
        'alamat',
        'telepon',
        'email',
        'catatan',
        'id_pengacara',
        'dibuat_pada'
    ];

    // Jika "dibuat_pada" otomatis, matikan timestamps
    protected $useTimestamps = false;
}
