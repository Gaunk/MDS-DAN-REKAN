<?php

namespace App\Models;

use CodeIgniter\Model;

class PerkaraModel extends Model
{
    protected $table = 'tabel_perkara';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nomor_perkara',
        'judul',
        'id_klien',
        'id_pengacara',
        'jenis_kasus',
        'status',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'dibuat_pada'
    ];

    public $useTimestamps = false;
}
