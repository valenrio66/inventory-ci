<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\BoxModel;
use App\Models\RakModel;
use App\Models\GudangModel;

class Barang extends BaseController
{
	// Get All Barang
	public function getAllBarang(): string
	{
		$barangModel = new BarangModel();
		$data['barangs'] = $barangModel->getBarangWithBox();

		return view('barang/barang_view', $data);
	}

	// Search Barang
	public function searchBarang()
	{
		$searchTerm = $this->request->getGet('search');
		$barangModel = new BarangModel();

		if ($searchTerm) {
			$data['barangs'] = $barangModel->like('nama_produk', $searchTerm)
				->orLike('merk', $searchTerm)
				->orLike('jenis_tipe', $searchTerm)
				->orLike('serial_number', $searchTerm)
				->orLike('id_produk', $searchTerm)
				->orLike('id_box', $searchTerm)
				->findAll();
		} else {
			$data['barangs'] = $barangModel->findAll();
		}

		return view('barang/barang_view', $data);
	}

	// Get All Barang By Id
	public function renderPageDetailBarang($id): string
	{
		$barangModel = new BarangModel();
		$data['barangs'] = $barangModel->getBarangWithBoxById($id);

		return view('barang/barang_detail', $data);
	}

	// Render Page Add Barang
	public function renderPageAddBarang(): string
	{
		$barangModel = new BarangModel();
		$boxModel = new BoxModel();
		$data['boxs'] = $boxModel->findAll();
		$data['klasifikasi_material_options'] = $barangModel->getKlasifikasiMaterialValues();
		$data['satuan_barang_options'] = $barangModel->getSatuanBarangValues();

		return view('barang/barang_add', $data);
	}

	// Render Page Update Barang
	public function renderPageUpdateBarang($id)
	{
		$barangModel = new BarangModel();
		$data['barangs'] = $barangModel->getBarangWithBoxById($id);

		return view('barang/barang_edit', $data);
	}

	// Fungsi Add Barang
	public function addBarang()
	{
		$merk = $this->request->getPost('merk');
		$jenis_tipe = $this->request->getPost('jenis_tipe');
		$id_box = $this->request->getPost('id_box');
		$dimensi_barang = $this->request->getPost('panjang') * $this->request->getPost('lebar') * $this->request->getPost('tinggi');

		$boxModel = new BoxModel();
		$rakModel = new RakModel();
		$gudangModel = new GudangModel();

		$box = $boxModel->find($id_box);
		$rak = $rakModel->find($box['id_rak']);
		$gudang = $gudangModel->find($rak['id_gudang']);

		$barangModel = new BarangModel();
		$lastProduct = $barangModel->getLastProductInBox($id_box);
		$productCountInBox = isset($lastProduct['urutan']) ? $lastProduct['urutan'] + 1 : 1;

		// Untuk membuat kode unik Barang/Produk
		$id_produk = strtoupper(substr($merk, 0, 1))
			. strtoupper(substr($jenis_tipe, 0, 5))
			. $id_box
			. $productCountInBox;
		$nomor_urut_gudang = $id_box . $productCountInBox;

		// Update capacities
		$boxModel->updateCapacity($id_box, $dimensi_barang);
		$rakModel->updateCapacity($rak['id'], $dimensi_barang, $box['tipe_box']);
		$gudangModel->updateCapacity($gudang['id_gudang'], $dimensi_barang);

		$jumlah = $this->request->getPost('jumlah');

		$data = [
			'id_produk' => $id_produk,
			'nama_produk' => $this->request->getPost('nama_produk'),
			'id_box' => $id_box,
			'klasifikasi_material' => $this->request->getPost('klasifikasi_material'),
			'merk' => $merk,
			'jenis_tipe' => $jenis_tipe,
			'serial_number' => $this->request->getPost('serial_number'),
			'kode_material_sap' => $this->request->getPost('kode_material_sap'),
			'jumlah' => $jumlah,
			'total_stok' => $jumlah,
			'satuan' => $this->request->getPost('satuan'),
			'harga_satuan' => $this->request->getPost('harga_satuan'),
			'nomor_urut_gudang' => $nomor_urut_gudang,
			'dimensi_barang' => $this->request->getPost('panjang') * $this->request->getPost('lebar') * $this->request->getPost('tinggi'),
			'jumlah_harga' => $this->request->getPost('harga_satuan') * $this->request->getPost('jumlah')
		];

		if ($barangModel->insert($data)) {
			return redirect()->to('/dashboard/barang');
		} else {
			return redirect()->back()->withInput()->with('errors', $barangModel->errors());
		}
	}

	// Update Barang
	public function updateBarang($id)
	{
		$barangModel = new BarangModel();
		$data = $this->request->getPost();

		if ($barangModel->updateBarangModel($id, $data)) {
			return redirect()->to('/dashboard/barang')->with('message', 'Barang berhasil diupdate');
		} else {
			return redirect()->back()->withInput()->with('errors', $barangModel->errors());
		}
	}
}
