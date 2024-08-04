<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['id_produk','nama_produk', 'id_box', 'klasifikasi_material', 'merk', 'jenis_tipe', 'serial_number', 'kode_material_sap', 'jumlah', 'satuan', 'harga_satuan', 'jumlah_harga', 'nomor_urut_gudang', 'dimensi_barang'];

    // Untuk Get All
    public function getBarangWithBox()
    {
        return $this->select('produk.*, box.id_box')
            ->join('box', 'box.id_box = produk.id_box')
            ->findAll();
    }

    // Untuk Get By ID
    public function getBarangWithBoxById($id)
    {
        return $this->select('produk.*, box.id_box')
            ->join('box', 'box.id_box = produk.id_box')
            ->where('id_produk', $id)
            ->find($id);
    }

    // Untuk Get Opsi Klasifikasi Material
    public function getKlasifikasiMaterialValues()
    {
        $query = $this->db->query("SHOW COLUMNS FROM produk WHERE Field = 'klasifikasi_material'");
        $row = $query->getRow();
        if ($row === null) {
            return [];
        }

        $regex = "/^enum\((.*)\)$/";
        preg_match($regex, $row->Type, $matches);
        $enum = str_replace("'", "", $matches[1]);
        return explode(",", $enum);
    }

    // Untuk Get Opsi Satuan Barang
    public function getSatuanBarangValues()
    {
        $query = $this->db->query("SHOW COLUMNS FROM produk WHERE Field = 'satuan'");
        $row = $query->getRow();
        if ($row === null) {
            return [];
        }

        $regex = "/^enum\((.*)\)$/";
        preg_match($regex, $row->Type, $matches);
        $enum = str_replace("'", "", $matches[1]);
        return explode(",", $enum);
    }

    // Untuk Cari Produk Terakhir Dalam Box
    public function getLastProductInBox($id_box)
    {
        return $this->where('id_box', $id_box)->orderBy('created_at', 'desc')->first();
    }

    // Untuk Update Barang
    public function updateBarangModel($id, $data)
    {
        return $this->update($id, $data);
    }

    // public function deleteRoleModel($id)
    // {
    //     return $this->delete($id);
    // }
}
