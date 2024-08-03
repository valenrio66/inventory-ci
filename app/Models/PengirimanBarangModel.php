<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanBarangModel extends Model
{
	protected $table = 'pengiriman_barang';
	protected $primaryKey = 'id_pengiriman';
	protected $allowedFields = [
		'id_produk', 'jumlah', 'tanggal_pengiriman', 'status'
	];
	protected $useTimestamps = false;
	protected $createdField = 'tanggal_pengiriman';

	public function getAll()
	{
		return $this->select('pengiriman_barang.*, produk.nama_produk, gudang.nama_gudang, box.id_box, rak.id AS id_rak, gudang.id_gudang, gudang.id_kepala, user.id_user, user.nama')
			->join('produk', 'pengiriman_barang.id_produk = produk.id_produk')
			->join('box', 'produk.id_box = box.id_box') // Pastikan relasi ini benar
			->join('rak', 'box.id_rak = rak.id') // Pastikan relasi ini benar
			->join('gudang', 'rak.id_gudang = gudang.id_gudang')
			->join('user', 'gudang.id_kepala = user.id_user') // Pastikan relasi ini benar
			->findAll();
	}

	public function getById($id_pengiriman)
	{
		return $this->find($id_pengiriman);
	}

	public function createPengiriman($data)
	{
		// Siapkan data yang akan disisipkan ke database, hanya sisipkan kolom yang ada di tabel
		$dataToInsert = [
			'id_produk'         => $data['id_produk'],
			'jumlah'            => $data['jumlah'],
			'tanggal_pengiriman' => $data['tanggal_pengiriman'],
			'status'            => $data['status'] ?? 'Pending', // Gunakan 'Pending' sebagai status default jika tidak diset
		];

		// Sisipkan ke database
		return $this->insert($dataToInsert);
	}

	public function approvePengiriman($id_pengiriman, $id_approval)
	{
		// Mendapatkan detail pengiriman
		$pengiriman = $this->find($id_pengiriman);

		if ($pengiriman) {
			// Update kapasitas Box
			$boxModel = new BoxModel();
			$boxModel->reduceCapacity($pengiriman['id_box'], $pengiriman['jumlah']);

			// Update kapasitas Rak
			$rakModel = new RakModel();
			$rakModel->reduceCapacity($pengiriman['id_rak'], $pengiriman['tipe_box'], $pengiriman['jumlah']);

			// Update kapasitas Gudang
			$gudangModel = new GudangModel();
			$gudangModel->reduceCapacity($pengiriman['id_gudang'], $pengiriman['jumlah']);

			// Update status pengiriman menjadi 'Approved'
			return $this->update($id_pengiriman, [
				'status' => 'Approved',
			]);
		}

		return false;
	}

	public function updatePengiriman($id_pengiriman, $data)
	{
		return $this->update($id_pengiriman, $data);
	}

	public function deletePengiriman($id_pengiriman)
	{
		return $this->delete($id_pengiriman);
	}
}
