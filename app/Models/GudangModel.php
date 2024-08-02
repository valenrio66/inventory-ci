<?php

namespace App\Models;

use CodeIgniter\Model;

class GudangModel extends Model
{
    protected $table = 'gudang';
    protected $primaryKey = 'id_gudang';
    protected $allowedFields = ['nama_gudang', 'id_kepala', 'level', 'alamat', 'no_hp', 'kapasitas'];

    // Untuk update Gudang
    public function updateCapacity($id_gudang, $dimensi_barang) {
        $gudang = $this->find($id_gudang);
        $gudang['kapasitas'] -= $dimensi_barang;
        $this->update($id_gudang, $gudang);
    }
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
