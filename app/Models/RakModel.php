<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
	protected $table = 'rak';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'id_gudang', 'kapasitas_fast', 'kapasitas_medium', 'kapasitas_slow', 'created_at'];

	// Get All Rak
	public function getRakWithGudang()
	{
		return $this->select('rak.*, gudang.nama_gudang')
			->join('gudang', 'gudang.id_gudang = rak.id_gudang')
			->findAll();
	}

	// Untuk Cari Rak Terakhir Dalam Gudang
	public function getLastRakInGudang($id_gudang)
	{
		return $this->where('id_gudang', $id_gudang)->orderBy('id', 'desc')->first();
	}

	// Update Capacity Rak
	public function updateCapacity($id_rak, $dimensi_barang, $tipe_box)
	{
		$rak = $this->find($id_rak);
		if ($tipe_box == 'Fast Moving') {
			$rak['kapasitas_fast'] -= $dimensi_barang;
		} elseif ($tipe_box == 'Medium Moving') {
			$rak['kapasitas_medium'] -= $dimensi_barang;
		} elseif ($tipe_box == 'Slow Moving') {
			$rak['kapasitas_slow'] -= $dimensi_barang;
		}
		$this->update($id_rak, $rak);
	}

	// Untuk Get By ID Rak
	public function getRakByIdWithGudang($id)
	{
		return $this->select('rak.*, gudang.nama_gudang, gudang.level')
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

	// Reduce Capacity when Sending Package
	public function reduceCapacity($id, $tipe_box, $jumlah, $volume_per_unit) {
		log_message('debug', "Mengurangi kapasitas untuk rak ID: $id");
		$rak = $this->find($id);
		$volume_to_reduce = $jumlah * $volume_per_unit;
	
		$field_update = $this->determineField($tipe_box);
	
		if ($rak && ($rak[$field_update] >= $volume_to_reduce)) {
			$data = [
				$field_update => $rak[$field_update] - $volume_to_reduce
			];
			if ($this->update($id, $data)) {
				log_message('info', "Kapasitas rak $id berhasil dikurangi.");
				return true;
			} else {
				log_message('error', "Gagal mengupdate kapasitas rak $id.");
				return false;
			}
		} else {
			log_message('error', "Kapasitas rak $id tidak cukup.");
			return false;
		}
	}
	
	private function determineField($tipe_box) {
		switch ($tipe_box) {
			case 'Fast Moving': return 'kapasitas_fast';
			case 'Medium Moving': return 'kapasitas_medium';
			case 'Slow Moving': return 'kapasitas_slow';
			default: throw new \Exception("Tipe box tidak valid: $tipe_box");
		}
	}

	// Untuk Update Rak
	public function updateRakModel($id, $data)
	{
		return $this->update($id, $data);
	}

	public function deleteRakModel($id)
	{
		return $this->delete($id);
	}
}
