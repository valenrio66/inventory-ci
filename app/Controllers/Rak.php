<?php

namespace App\Controllers;

use App\Models\RakModel;
use App\Models\GudangModel;

class Rak extends BaseController
{
	// Get All Rak
	public function getAllRak(): string
	{
		$rakModel = new RakModel();
		$data['raks'] = $rakModel->getRakWithGudang();

		return view('admin/rak_view', $data);
	}

	// Render Page Add Rak
	public function renderPageAddRak(): string
	{
		$gudangModel = new GudangModel();
		$data['gudangs'] = $gudangModel->findAll();

		return view('admin/rak_add', $data);
	}

	// Create Rak
	public function addRak()
	{
		$rakModel = new RakModel();

		// Untuk membuat nomor rak
		$id_gudang = $this->request->getPost('id_gudang');
		$lastRak = $rakModel->getLastRakInGudang($id_gudang);
		if ($lastRak) {
			$lastId = intval(substr($lastRak['id'], strlen($id_gudang))); // Mengambil bagian numerik dari ID rak terakhir
			$rakCountInGudang = $lastId + 1;
		} else {
			$rakCountInGudang = 1; // Ini adalah rak pertama dalam gudang
		}
		$nomor_urut_rak = $id_gudang . $rakCountInGudang;

		$data = [
			'id' => $nomor_urut_rak,
			'id_gudang' => $this->request->getPost('id_gudang'),
			'kapasitas_fast' => $this->request->getPost('kapasitas_fast') * 49.5 * 37 * 31,
			'kapasitas_medium' => $this->request->getPost('kapasitas_medium') * 49.5 * 37 * 31,
			'kapasitas_slow' => $this->request->getPost('kapasitas_slow') * 49.5 * 37 * 31,
		];

		if ($rakModel->insert($data)) {
			return redirect()->to('/dashboard/rak');
		} else {
			return redirect()->back()->withInput()->with('errors', $rakModel->errors());
		}
	}

	// Render Page Detail Rak
	public function renderPageDetailRak($id): string
	{
		$rakModel = new RakModel();
		$data['raks'] = $rakModel->getRakByIdWithGudang($id);

		return view('admin/rak_detail', $data);
	}

	// Delete Rak
	public function deleteRak($id)
	{
		$rakModel = new RakModel();
		if ($rakModel->deleteRakModel($id)) {
			// Debugging message
			return redirect()->to('/dashboard/rak')->with('message', 'Rak berhasil dihapus');
		} else {
			// Debugging message
			return redirect()->back()->with('message', 'Gagal menghapus rak');
		}
	}
}
