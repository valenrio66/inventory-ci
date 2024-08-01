<?php 

namespace App\Controllers;
use App\Models\RakModel;

class Rak extends BaseController
{
	// Get All Rak
	public function getAllRak(): string
	{
		$rakModel = new RakModel();
		$data['raks'] = $rakModel->findAll();

		return view('admin/rak_view', $data);
	}

}
?>