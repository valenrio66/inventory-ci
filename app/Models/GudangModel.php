<?php

namespace App\Models;

use CodeIgniter\Model;

class GudangModel extends Model
{
	protected $table = 'gudang';
	protected $primaryKey = 'id_gudang';
	protected $allowedFields = ['nama_gudang', 'id_kepala', 'level', 'alamat', 'no_hp', 'kapasitas'];

	// Untuk Get All Gudang
	public function getGudangWithKepala()
	{
		return $this->select('gudang.*, user.nama, user.role')
			->join('user', 'user.id_user = gudang.id_kepala')
			->findAll();
	}

	// Untuk Get By ID Gudang
	public function getGudangByIdWithKepala($id)
	{
		return $this->select('gudang.*, user.nama, user.role')
			->join('user', 'user.id_user = gudang.id_kepala')
			->find($id);
	}

	// Untuk update Gudang
	public function updateCapacity($id_gudang, $dimensi_barang)
	{
		$gudang = $this->find($id_gudang);
		$gudang['kapasitas'] -= $dimensi_barang;
		$this->update($id_gudang, $gudang);
	}

	// Untuk Get Opsi Level Gudang
	public function getLevelGudangValues()
	{
		$query = $this->db->query("SHOW COLUMNS FROM gudang WHERE Field = 'level'");
		$row = $query->getRow();
		if ($row === null) {
			return [];
		}

		$regex = "/^enum\((.*)\)$/";
		preg_match($regex, $row->Type, $matches);
		$enum = str_replace("'", "", $matches[1]);
		return explode(",", $enum);
	}

	// public function updateRoleModel($id, $data)
	// {
	//     return $this->update($id, $data);
	// }

	public function deleteGudangModel($id)
	{
		return $this->delete($id);
	}
}
