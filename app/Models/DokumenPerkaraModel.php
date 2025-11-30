<?php 

namespace App\Models;

use CodeIgniter\Model;

class DokumenPerkaraModel extends Model
{
    protected $table      = 'tabel_dokumen_perkara';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_perkara',
        'nama_file',
        'path_file',
        'kategori',
        'diunggah_oleh',
        'diunggah_pada'
    ];
    protected $useTimestamps = false;
}
