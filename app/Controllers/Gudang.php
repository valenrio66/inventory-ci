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

		return view('admin/gudang_view', $data);
	}

	// Render Page Add Gudang
	public function renderPageAddGudang(): string
	{
		$userModel = new UserModel();
		$data['users'] = $userModel->findAll();
		

		$gudangModel = new GudangModel();
		$data['level_options'] = $gudangModel->getLevelGudangValues();
	
		return view('admin/gudang_add', $data);
	}

	// Create Gudang
	public function addGudang()
	{
		$gudangModel = new GudangModel();
		
		$rak = $this->request->getPost('kapasitas');
		$dimensi_bin = 0.495 * 0.37 * 0.31;
		$bin = 15 * $dimensi_bin;
		$kapasitas = $rak * $bin;
		$data = [
			'nama_gudang' => $this->request->getPost('nama_gudang'),
			'id_kepala' => $this->request->getPost('id_kepala'),
			'level' => $this->request->getPost('level'),
			'alamat' => $this->request->getPost('alamat'),
			'no_hp' => $this->request->getPost('no_hp'),
			'kapasitas' => $kapasitas
		];

		if ($gudangModel->insert($data)) {
			return redirect()->to('/dashboard/gudang');
		} else {
			return redirect()->back()->withInput()->with('errors', $gudangModel->errors());
		}
	}

}
?>