<?php 

namespace App\Models;
use CodeIgniter\Model;

class SuratKuasaModel extends Model
{
    protected $table = 'tabel_surat_kuasa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_klien',
        'id_perkara',
        'deskripsi',
        'tanggal',
        'nik',
        'ttl',
        'jenis_kelamin',
        'pekerjaan',
        'alamat',
        'penerima',
        'alamat_kantor',
        'created_at',
        'updated_at'
    ];

    // Aktifkan timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil surat dengan data klien dan perkara
     * @param int $id
     * @return array|null
     */
    public function getSuratWithDetails($id)
    {
        // pastikan $id scalar
    if (!is_numeric($id)) {
        return null;
    }
        $builder = $this->db->table($this->table)
            ->select('tabel_surat_kuasa.*, tabel_klien.nama as nama_klien, tabel_perkara.nomor_perkara')
            ->join('tabel_klien', 'tabel_klien.id = tabel_surat_kuasa.id_klien', 'left')
            ->join('tabel_perkara', 'tabel_perkara.id = tabel_surat_kuasa.id_perkara', 'left')

            ->where('tabel_surat_kuasa.id', $id);

        return $builder->get()->getRowArray();
    }
}
