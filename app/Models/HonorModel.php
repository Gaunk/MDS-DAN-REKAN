<?php

namespace App\Models;

use CodeIgniter\Model;

class HonorModel extends Model
{
    protected $table      = 'tabel_honorarium';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_pengacara',
        'nama_pengacara',
        'jumlah',
        'status',
        'keterangan',
        'created_at'
    ];

    public $useTimestamps = false; // Karena created_at diisi manual
}
