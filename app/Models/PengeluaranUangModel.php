<?php

namespace App\Models;
use CodeIgniter\Model;

class PengeluaranUangModel extends Model
{
    protected $table = 'tabel_pengeluaran_uang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tanggal',
        'keterangan',
        'jumlah',
        'kategori',
        'id_pengacara',
        'id_perkara'
    ];

    // Default order
    protected $orderBy = ['tanggal' => 'DESC'];

    // Optional: timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Hitung total pengeluaran (opsional filter kategori)
     */
    public function totalPengeluaran($kategori = null)
    {
        $builder = $this->selectSum('jumlah');

        if ($kategori) {
            $builder->where('kategori', $kategori);
        }

        $result = $builder->first();
        return $result['jumlah'] ?? 0;
    }

    /**
     * Ambil pengeluaran berdasarkan kategori
     */
    public function getByKategori($kategori)
    {
        return $this->where('kategori', $kategori)
                    ->orderBy('tanggal', 'DESC')
                    ->findAll();
    }
}
