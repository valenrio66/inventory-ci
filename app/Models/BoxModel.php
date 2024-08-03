<?php

namespace App\Models;

use CodeIgniter\Model;

class BoxModel extends Model
{
	protected $table = 'box';
	protected $primaryKey = 'id_box';
	protected $allowedFields = ['id_box', 'id_rak', 'tipe_box', 'kapasitas_tersedia', 'kapasitas_terpakai', 'created_at'];

	// Get All Box with Rak
	public function getBoxWithRak()
	{
		return $this->select('box.*, rak.id')
			->join('rak', 'rak.id = box.id_rak')
			->findAll();
	}

	// Untuk Cari Box Terakhir Dalam Rak
	public function getLastBoxInRak($id_rak, $abbreviation)
	{
		// Mencari box terakhir dengan id_rak dan prefix abbreviation tertentu
		return $this->where('id_rak', $id_rak)
			->like('id_box', $id_rak . $abbreviation, 'after') // Pastikan id_box dimulai dengan id_rak diikuti abbreviation
			->orderBy('id_box', 'desc')
			->first();
	}

	// Untuk Get Jenis Level Box
	public function getLevelBoxValues()
	{
		$query = $this->db->query("SHOW COLUMNS FROM box WHERE Field = 'tipe_box'");
		$row = $query->getRow();
		if ($row === null) {
			return [];
		}

		$regex = "/^enum\((.*)\)$/";
		preg_match($regex, $row->Type, $matches);
		$enum = str_replace("'", "", $matches[1]);
		return explode(",", $enum);
	}

	// Untuk Update Kapasitas Box
	public function updateCapacity($id_box, $dimensi_barang)
	{
		$box = $this->find($id_box);
		$box['kapasitas_tersedia'] -= $dimensi_barang;
		$box['kapasitas_terpakai'] += $dimensi_barang;
		$this->update($id_box, $box);
	}

	// Untuk Get By ID Box
	public function getBoxWithRakAndGudang($id)
	{
		return $this->select('box.*, rak.id, gudang.nama_gudang')
			->join('rak', 'rak.id = box.id_rak')
			->join('gudang', 'gudang.id_gudang = rak.id_gudang')
			->find($id);
	}

	// public function createRoleModel($data)
	// {
	//     return $this->insert($data);
	// }

	// public function updateRoleModel($id, $data)
	// {
	//     return $this->update($id, $data);
	// }

	public function deleteBoxModel($id)
	{
		return $this->delete($id);
	}
}
