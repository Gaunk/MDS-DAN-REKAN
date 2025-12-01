<?php 

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table      = 'tabel_pembayaran';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_tagihan',
        'jumlah',
        'metode_pembayaran',
        'bukti_transfer',
        'tanggal_pembayaran',
        'dibuat_pada'
    ];
}
