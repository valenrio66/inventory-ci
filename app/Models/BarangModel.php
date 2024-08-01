<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['nama_barang'];

    // public function createRoleModel($data)
    // {
    //     return $this->insert($data);
    // }

    // public function updateRoleModel($id, $data)
    // {
    //     return $this->update($id, $data);
    // }

    // public function deleteRoleModel($id)
    // {
    //     return $this->delete($id);
    // }
}
