<?php

namespace App\Models;

use CodeIgniter\Model;

class KontakModel extends Model
{
    protected $table = 'kontak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'subject', 'message', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
