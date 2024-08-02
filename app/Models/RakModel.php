<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
    protected $table = 'rak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor_rak', 'id_gudang', 'kapasitas_fast', 'kapasitas_medium', 'kapasitas_slow'];

    public function getRakWithGudang()
    {
        return $this->select('rak.*, gudang.nama_gudang')
            ->join('gudang', 'gudang.id_gudang = rak.id_gudang')
            ->findAll();
    }

    public function updateCapacity($id_rak, $dimensi_barang, $tipe_box) {
        $rak = $this->find($id_rak);
        if ($tipe_box == 'Fast Moving') {
            $rak['kapasitas_fast'] -= $dimensi_barang;
        } elseif ($tipe_box == 'Medium Moving') {
            $rak['kapasitas_medium'] -= $dimensi_barang;
        } elseif ($tipe_box == 'Slow Moving') {
            $rak['kapasitas_slow'] -=$dimensi_barang;
        }
        $this->update($id_rak, $rak);
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
