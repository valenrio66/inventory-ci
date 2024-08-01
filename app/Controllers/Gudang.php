<?php 

namespace App\Controllers;
use App\Models\GudangModel;

class Gudang extends BaseController
{
	// Get All Gudang
	public function getAllGudang(): string
	{
		$gudangModel = new GudangModel();
		$data['gudangs'] = $gudangModel->findAll();

		return view('admin/gudang_view', $data);
	}

}
?>