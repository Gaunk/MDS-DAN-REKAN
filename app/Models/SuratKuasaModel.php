<?php 

namespace App\Models;
use CodeIgniter\Model;

class SuratKuasaModel extends Model
{
    protected $table = 'tabel_surat_kuasa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_klien', 'id_perkara', 'deskripsi', 'tanggal', 'created_at'
    ];
}
