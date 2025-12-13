<?php

namespace App\Models;

use CodeIgniter\Model;

class TabelBarcodeModel extends Model
{
    protected $table = 'tabel_barcode';
    protected $primaryKey = 'id';
    
    // Kolom yang dapat diisi
    protected $allowedFields = [
        'nama_pengacara', 'spesialis', 'no_hp', 'lokasi_maps', 'latitude', 'longitude', 'foto', 'barcode', 'link_profile'
    ];

    // Mengaktifkan fitur timestamp untuk otomatis mengelola created_at dan updated_at
    protected $useTimestamps = true;
    
    // Kolom yang digunakan untuk created_at dan updated_at
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
