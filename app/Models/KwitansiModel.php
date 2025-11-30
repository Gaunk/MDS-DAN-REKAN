<?php

namespace App\Models;

use CodeIgniter\Model;

class KwitansiModel extends Model
{
    protected $table = 'tabel_pembayaran';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_tagihan',
        'jumlah',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'dibuat_pada'
    ];

    // Ambil data lengkap kwitansi (join klien, tagihan, perkara)
    public function getKwitansi($id)
    {
        return $this->select('
                tabel_pembayaran.*,
                tabel_tagihan.jumlah AS total_tagihan,
                tabel_tagihan.deskripsi,
                tabel_klien.nama AS nama_klien,
                tabel_klien.alamat AS alamat_klien,
                tabel_perkara.nomor_perkara
            ')
            ->join('tabel_tagihan', 'tabel_tagihan.id = tabel_pembayaran.id_tagihan', 'left')
            ->join('tabel_klien', 'tabel_klien.id = tabel_tagihan.id_klien', 'left')
            ->join('tabel_perkara', 'tabel_perkara.id = tabel_tagihan.id_perkara', 'left')
            ->where('tabel_pembayaran.id', $id)
            ->first();
    }
}
