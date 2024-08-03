<?php 

namespace App\Controllers;
use App\Models\BoxModel;
use App\Models\RakModel;

class Box extends BaseController
{
	// Get All Box
	public function getAllBox(): string
	{
        $boxModel = new BoxModel();
        $data['boxs'] = $boxModel->getBoxWithRak();

		return view('admin/box_view', $data);
	}

	// Render Page Add Box
	public function renderPageAddBox(): string
	{
		$rakModel = new RakModel();
		$data['raks'] = $rakModel->findAll();
		

		$boxModel = new BoxModel();
		$data['tipe_box_options'] = $boxModel->getLevelBoxValues();
	
		return view('admin/box_add', $data);
	}

}
?>