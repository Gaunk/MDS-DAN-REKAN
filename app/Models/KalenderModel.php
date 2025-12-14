<?php

namespace App\Models;

use CodeIgniter\Model;

class KalenderModel extends Model
{
    protected $table = 'tabel_kalender';  // nama tabel
    protected $primaryKey = 'id';
    protected $useTimestamps = true;      // otomatis update created_at & updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Fields yang bisa diisi secara massal
    protected $allowedFields = [
        'kegiatan',
        'deskripsi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'all_day',
        'tipe'
    ];

    // Optional: validasi sederhana
    protected $validationRules = [
        'kegiatan' => 'required|min_length[3]',
        'tanggal'  => 'required|valid_date[Y-m-d]',
        'tipe'     => 'required|in_list[meeting,task,appointment,deadline,presentation,custom]'
    ];
}
