<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanBarangModel extends Model
{
	protected $table = 'pengiriman_barang';
	protected $primaryKey = 'id_pengiriman';
	protected $allowedFields = [
		'id_produk',
		'jumlah',
		'tanggal_pengiriman',
		'status'
	];

	protected $boxModel;
	protected $rakModel;
	protected $gudangModel;

	public function __construct()
	{
		parent::__construct();
		$this->boxModel = new BoxModel();
		$this->rakModel = new RakModel();
		$this->gudangModel = new GudangModel();
	}

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

	public function getShipmentWithProduct($id_pengiriman)
	{
		return $this->db->table('pengiriman_barang')
		->select('pengiriman_barang.*, produk.id_produk, produk.nama_produk')
		->join('produk', 'pengiriman_barang.id_produk = produk.id_produk')
		->where('pengiriman_barang.id_pengiriman', $id_pengiriman)
			->get()
			->getRowArray();
	}


	public function createPengiriman($data)
	{
		// Siapkan data yang akan disisipkan ke database, hanya sisipkan kolom yang ada di tabel
		$dataToInsert = [
			'id_produk' => $data['id_produk'],
			'jumlah' => $data['jumlah'],
			'tanggal_pengiriman' => $data['tanggal_pengiriman'],
			'status' => $data['status'] ?? 'Pending', // Gunakan 'Pending' sebagai status default jika tidak diset
		];

		// Sisipkan ke database
		return $this->insert($dataToInsert);
	}

	public function approvePengiriman($id_pengiriman)
	{
		log_message('debug', "Memulai transaksi pengiriman.");
		$this->db->transStart();

		$pengiriman = $this->db->table('pengiriman_barang')
			->select('pengiriman_barang.*, produk.id_box, produk.id_produk, produk.dimensi_barang')
			->join('produk', 'pengiriman_barang.id_produk = produk.id_produk', 'left')
			->where('pengiriman_barang.id_pengiriman', $id_pengiriman)
			->get()
			->getRow();

		if (!$pengiriman) {
			log_message('error', "Pengiriman tidak ditemukan dengan ID: $id_pengiriman");
			$this->db->transRollback();
			return false;
		}

		log_message('info', "Pengiriman ditemukan: " . json_encode($pengiriman));

		// Reduce capacity in Box
		if (!$this->boxModel->reduceCapacity($pengiriman->id_box, $pengiriman->jumlah, $pengiriman->dimensi_barang)) {
			log_message('error', "Kegagalan mengurangi kapasitas box");
			$this->db->transRollback();
			return false;
		}

		$box = $this->db->table('box')->where('id_box', $pengiriman->id_box)->get()->getRow();
		if (!$this->rakModel->reduceCapacity($box->id_rak, $box->tipe_box, $pengiriman->jumlah, $pengiriman->dimensi_barang)) {
			log_message('error', "Kegagalan mengurangi kapasitas rak");
			$this->db->transRollback();
			return false;
		}

		$rak = $this->db->table('rak')->where('id', $box->id_rak)->get()->getRow();
		if (!$this->gudangModel->reduceCapacity($rak->id_gudang, $pengiriman->jumlah, $pengiriman->dimensi_barang)) {
			log_message('error', "Kegagalan mengurangi kapasitas gudang");
			$this->db->transRollback();
			return false;
		}

		// Update the status of the shipment to 'Approved'
		if (!$this->db->table('pengiriman_barang')->where('id_pengiriman', $id_pengiriman)->update(['status' => 'Approved'])) {
			log_message('error', "Gagal mengupdate status pengiriman ke 'Approved'");
			$this->db->transRollback();
			return false;
		}

		$this->db->transCommit();
		log_message('info', "Transaksi pengiriman berhasil dan status diupdate ke 'Approved'.");
		return true;
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
