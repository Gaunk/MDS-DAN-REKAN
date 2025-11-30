<?php

namespace App\Models;

use CodeIgniter\Model;

class PengacaraModel extends Model
{
    protected $table      = 'tabel_pengacara';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // Kolom yang boleh diinsert/update
    protected $allowedFields = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'pendidikan',
        'jurusan',
        'nama_kampus',
        'peran',        // jika menyimpan ID peran, nanti bisa join ke tabel peran
        'foto_pengacara',
        'created_at',
        'updated_at'
    ];

    // Timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Jika ingin otomatis validasi
    protected $validationRules = [
        'nama'  => 'required|min_length[3]',
        'email' => 'required|valid_email',
        'telepon' => 'required',
        'peran' => 'required|integer'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama pengacara wajib diisi',
            'min_length' => 'Nama terlalu pendek'
        ],
        'email' => [
            'required' => 'Email wajib diisi',
            'valid_email' => 'Email tidak valid'
        ],
        'telepon' => [
            'required' => 'Telepon wajib diisi'
        ],
        'peran' => [
            'required' => 'Peran wajib dipilih',
            'integer' => 'Peran harus berupa angka'
        ]
    ];

    // ==============================
    // Contoh method join dengan tabel peran
    // ==============================
    public function getPengacaraWithPeran()
    {
        return $this->select('tabel_pengacara.*, tabel_peran.nama_peran')
                    ->join('tabel_peran', 'tabel_peran.id = tabel_pengacara.peran', 'left')
                    ->orderBy('tabel_pengacara.nama', 'ASC')
                    ->findAll();
    }
}
