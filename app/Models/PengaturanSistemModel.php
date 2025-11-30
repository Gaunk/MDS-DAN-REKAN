<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanSistemModel extends Model
{
    protected $table      = 'tabel_pengaturan_sistem';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'logo',
        'nama_perusahaan',
        'seo',
        'keyword',
        'copyright',
        'maintenance',
        'diupdate_pada'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'dibuat_pada';
    protected $updatedField  = 'diupdate_pada';
}
