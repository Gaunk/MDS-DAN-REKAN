<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPertemuanModel extends Model
{
    protected $table      = 'tabel_jadwal_pertemuan';
    protected $primaryKey = 'id';

    // Jika kamu ingin hasil sebagai array (default), tidak perlu ubah $returnType
    // protected $returnType = 'array';

    protected $useTimestamps = true;
	protected $createdField = 'dibuat_pada';
	protected $updatedField = 'update_at';
	protected $allowedFields = [
	    'id_klien',
	    'id_pengguna',
	    'tanggal_waktu',
	    'waktu',
	    'lokasi',
	    'catatan'
	];


    /**
     * Ambil semua jadwal pertemuan, dengan data klien & pengacara
     */
    public function getJadwalPertemuan()
{
    return $this->select('
                tabel_jadwal_pertemuan.*,
                tabel_klien.nama AS nama_klien,
                tabel_klien.telepon AS telepon_klien,
                tabel_pengguna.username AS nama_pengacara
            ')
            ->join('tabel_klien', 'tabel_klien.id = tabel_jadwal_pertemuan.id_klien', 'left')
            ->join('tabel_pengguna', 'tabel_pengguna.id = tabel_jadwal_pertemuan.id_pengguna', 'left')
            ->orderBy('tanggal_waktu', 'ASC')
            ->findAll();
}

public function getJadwalById($id)
{
    return $this->select('
                tabel_jadwal_pertemuan.*,
                tabel_klien.nama AS nama_klien,
                tabel_klien.telepon AS telepon_klien,
                tabel_pengguna.username AS nama_pengacara
            ')
            ->join('tabel_klien', 'tabel_klien.id = tabel_jadwal_pertemuan.id_klien', 'left')
            ->join('tabel_pengguna', 'tabel_pengguna.id = tabel_jadwal_pertemuan.id_pengguna', 'left')
            ->where('tabel_jadwal_pertemuan.id', $id)
            ->first();
}

}
