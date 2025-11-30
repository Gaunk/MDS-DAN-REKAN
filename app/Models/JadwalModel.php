<?php 

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends \CodeIgniter\Model
{
    protected $table = 'tabel_jadwal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_klien', 'email', 'kegiatan', 'tanggal', 'status_reminder'];
}
