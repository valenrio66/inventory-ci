<?php

namespace App\Models;

use CodeIgniter\Model;

class BoxModel extends Model
{
    protected $table = 'box';
    protected $primaryKey = 'id_box';
    protected $allowedFields = ['id_rak', 'tipe_box', 'kapasitas_tersedia', 'kapasitas_terpakai'];

    // Get All Box with Rak
    public function getBoxWithRak()
    {
        return $this->select('box.*, rak.nomor_rak')
            ->join('rak', 'rak.id = box.id_rak')
            ->findAll();
    }

    // Untuk Update Kapasitas Box
    public function updateCapacity($id_box, $dimensi_barang) {
        $box = $this->find($id_box);
        $box['kapasitas_tersedia'] -= $dimensi_barang;
        $box['kapasitas_terpakai'] += $dimensi_barang;
        $this->update($id_box, $box);
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
