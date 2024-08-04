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

		return view('box/box_view', $data);
	}

	// Render Page Add Box
	public function renderPageAddBox(): string
	{
		$rakModel = new RakModel();
		$data['raks'] = $rakModel->findAll();


		$boxModel = new BoxModel();
		$data['tipe_box_options'] = $boxModel->getLevelBoxValues();

		return view('box/box_add', $data);
	}

	// Create Box
	public function addBox()
	{
		$boxModel = new BoxModel();
		$id_rak = $this->request->getPost('id_rak');
		$tipe_box = $this->request->getPost('tipe_box');

		$abbreviations = [
			'Fast Moving' => 'FM',
			'Medium Moving' => 'MM',
			'Slow Moving' => 'SM'
		];
		$abbreviation = isset($abbreviations[$tipe_box]) ? $abbreviations[$tipe_box] : '';

		// Update getLastBoxInRak untuk menyertakan abbreviation
		$lastBox = $boxModel->getLastBoxInRak($id_rak, $abbreviation);
		if ($lastBox) {
			$lastIdNum = intval(substr($lastBox['id_box'], strlen($id_rak) + 2)) + 1;
			$nomor_urut_box = $id_rak . $abbreviation . $lastIdNum;
		} else {
			$nomor_urut_box = $id_rak . $abbreviation . '1';  // Mulai dari 1 jika belum ada box dengan tipe yang sama
		}

		$data = [
			'id_box' => $nomor_urut_box,
			'id_rak' => $id_rak,
			'tipe_box' => $tipe_box,
			'kapasitas_tersedia' => 49.5 * 37 * 31,
			'kapasitas_slow' => "0"
		];

		if ($boxModel->insert($data)) {
			return redirect()->to('/dashboard/box');
		} else {
			return redirect()->back()->withInput()->with('errors', $boxModel->errors());
		}
	}

	// Get Box By Id
	public function renderPageDetailBox($id)
	{
		$boxModel = new BoxModel();
		$data['boxs'] = $boxModel->getBoxWithRakAndGudang($id);

		// Misalnya mengembalikan ke view
		return view('box/box_detail', $data);
	}

	// Render Page Update Box
	public function renderPageUpdateBox($id)
	{
		$boxModel = new BoxModel();
		$data['boxs'] = $boxModel->getBoxWithRakAndGudang($id);

		// Misalnya mengembalikan ke view
		return view('box/box_edit', $data);
	}

	// Update Box
	public function updateBox($id)
	{
		$boxModel = new BoxModel();
		$data = $this->request->getPost();

		if ($boxModel->updateBoxModel($id, $data)) {
			return redirect()->to('/dashboard/box')->with('message', 'Box berhasil diupdate');
		} else {
			return redirect()->back()->withInput()->with('errors', $boxModel->errors());
		}
	}

	// Delete Box
	public function deleteBox($id_box)
	{
		$boxModel = new BoxModel();
		if ($boxModel->deleteBoxModel($id_box)) {
			// Debugging message
			return redirect()->to('/dashboard/box')->with('message', 'Box berhasil dihapus');
		} else {
			// Debugging message
			return redirect()->back()->with('message', 'Gagal menghapus box');
		}
	}
}
