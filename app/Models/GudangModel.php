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

	// Untuk update Gudang
	public function updateGudangModel($id, $data)
	{
		return $this->update($id, $data);
	}

	// Reduce Capacity when Sending Package
	public function reduceCapacity($id_gudang, $jumlah, $volume_per_unit)
	{
		log_message('debug', "Mengurangi kapasitas untuk gudang ID: $id_gudang");
		$gudang = $this->find($id_gudang);
		$volume_to_reduce = $jumlah * $volume_per_unit;

		if ($gudang && ($gudang['kapasitas'] >= $volume_to_reduce)) {
			$data = [
				'kapasitas' => $gudang['kapasitas'] - $volume_to_reduce
			];
			if ($this->update($id_gudang, $data)) {
				log_message('info', "Kapasitas gudang $id_gudang berhasil dikurangi.");
				return true;
			} else {
				log_message('error', "Gagal mengupdate kapasitas gudang $id_gudang.");
				return false;
			}
		} else {
			log_message('error', "Kapasitas gudang $id_gudang tidak cukup.");
			return false;
		}
	}

	public function deleteGudangModel($id)
	{
		return $this->delete($id);
	}
}
