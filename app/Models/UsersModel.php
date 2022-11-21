<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $allowedFields = ['name', 'email', 'password', 'level'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField  = 'deleted_at';
}
