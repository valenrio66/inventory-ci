<?php 

namespace App\Controllers;
use App\Models\BoxModel;

class Box extends BaseController
{
	// Get All Box
	public function getAllBox(): string
	{
        $boxModel = new BoxModel();
        $data['boxs'] = $boxModel->getBoxWithRak();

		return view('admin/box_view', $data);
	}

}
?>