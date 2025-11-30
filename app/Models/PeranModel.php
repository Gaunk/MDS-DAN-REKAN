<?php

namespace App\Models;

use CodeIgniter\Model;

class PeranModel extends Model
{
    protected $table      = 'tabel_peran';   // Nama tabel
    protected $primaryKey = 'id';            // Primary key

    protected $useAutoIncrement = true;      // Auto increment id
    protected $returnType       = 'array';   // Format hasil query
    protected $useSoftDeletes   = false;     // Bisa aktifkan jika ingin soft delete

    protected $allowedFields = [
        'nama_peran',                     // Kolom yang boleh di-insert/update
    ];

    // Timestam
}