<?php

namespace App\Controllers;

use App\Models\GudangModel;
use App\Models\UserModel;

class Gudang extends BaseController
{
	// Get All Gudang
	public function getAllGudang(): string
	{
		$gudangModel = new GudangModel();
		$data['gudangs'] = $gudangModel->getGudangWithKepala();

		return view('gudang/gudang_view', $data);
	}

	// Render Page Add Gudang
	public function renderPageAddGudang(): string
	{
		$userModel = new UserModel();
		// Muat data kepala gudang terlebih dahulu untuk diisi ke form
		$kepalaPusat = $userModel->where('role', 'Gudang Pusat')->findAll();
		$kepalaBagian = $userModel->where('role', 'Gudang Bagian')->findAll();

		$data = [
			'kepalaPusat' => $kepalaPusat,
			'kepalaBagian' => $kepalaBagian
		];


		$gudangModel = new GudangModel();
		$data['level_options'] = $gudangModel->getLevelGudangValues();

		return view('gudang/gudang_add', $data);
	}

	// Create Gudang
	public function addGudang()
	{
		$gudangModel = new GudangModel();
		$userModel = new UserModel();

		$level = $this->request->getPost('level');
		$roleMap = [
			'Bagian' => 'Gudang Bagian',
			'Pusat' => 'Gudang Pusat'
		];

		$role = $roleMap[$level] ?? null;
		if (!$role) {
			return redirect()->back()->withInput()->with('errors', ['Level tidak valid']);
		}

		$kepalaGudang = $userModel->select('user.id_user, user.nama, user.no_hp')
			->where('role', $role)
			->first();

		if (!$kepalaGudang) {
			return redirect()->back()->withInput()->with('errors', ['Kepala gudang tidak ditemukan']);
		}

		$data = [
			'nama_gudang' => $this->request->getPost('nama_gudang'),
			'id_kepala' => $kepalaGudang['id_user'],
			'level' => $level,
			'alamat' => $this->request->getPost('alamat'),
			'no_hp' => $kepalaGudang['no_hp'],
			'kapasitas' => $this->request->getPost('kapasitas')
		];

		if ($gudangModel->insert($data)) {
			return redirect()->to('/dashboard/gudang');
		} else {
			return redirect()->back()->withInput()->with('errors', $gudangModel->errors());
		}
	}

	// Render Page Detail Gudang
	public function renderPageDetailGudang($id): string
	{
		$gudangModel = new GudangModel();
		$data['gudangs'] = $gudangModel->getGudangByIdWithKepala($id);

		return view('gudang/gudang_detail', $data);
	}

	// Render Page Edit Gudang
	public function renderPageUpdateGudang($id): string
	{
		$gudangModel = new GudangModel();
		$data['gudangs'] = $gudangModel->getGudangByIdWithKepala($id);
		$data['level_options'] = $gudangModel->getLevelGudangValues();

		$userModel = new UserModel();
		$data['users'] = $userModel->findAll();

		return view('gudang/gudang_edit', $data);
	}

	// Update Gudang
	public function updateGudang($id)
	{
		$gudangModel = new GudangModel();
		$data = $this->request->getPost();

		if ($gudangModel->updateGudangModel($id, $data)) {
			return redirect()->to('/dashboard/gudang')->with('message', 'Gudang berhasil diupdate');
		} else {
			return redirect()->back()->withInput()->with('errors', $gudangModel->errors());
		}
	}

	// Delete Gudang
	public function deleteGudang($id)
	{
		$gudangModel = new GudangModel();
		if ($gudangModel->deleteGudangModel($id)) {
			// Debugging message
			return redirect()->to('/dashboard/gudang')->with('message', 'Gudang berhasil dihapus');
		} else {
			// Debugging message
			return redirect()->back()->with('message', 'Gagal menghapus gudang');
		}
	}
}
