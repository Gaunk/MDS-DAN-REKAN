<?php 

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table      = 'tabel_tagihan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_klien',
        'id_perkara',
        'jumlah',
        'deskripsi',
        'status',
        'tanggal_terbit',
        'tanggal_jatuh_tempo',
        'dibuat_pada'
    ];
}
