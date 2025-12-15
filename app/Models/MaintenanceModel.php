<?php

namespace App\Models;

use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $table = 'tabel_maintenance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['status'];
    protected $useTimestamps = true; // otomatis update 'updated_at'
    protected $updatedField = 'updated_at';
}
