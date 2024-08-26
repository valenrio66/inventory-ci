<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PengirimanBarangModel;
use App\Models\BoxModel;
use App\Models\RakModel;
use App\Models\GudangModel;
use App\Models\UserModel;
use Dompdf\Dompdf;

class PengirimanBarang extends BaseController
{
	public function index()
	{
		$model = new PengirimanBarangModel();
		$data['pengiriman'] = $model->getAll();
		$data['current_user_id'] = session()->get('id_user'); // Mengambil ID user yang sedang login

		return view('pengiriman/pengiriman_view', $data);
	}

	// Search Pengiriman
	public function searchPengiriman()
	{
		$searchTerm = $this->request->getGet('search');
		$pengirimanModel = new PengirimanBarangModel();

		if ($searchTerm) {
			$data['pengirimans'] = $pengirimanModel->like('nama_produk', $searchTerm)
				->orLike('merk', $searchTerm)
				->orLike('jenis_tipe', $searchTerm)
				->orLike('serial_number', $searchTerm)
				->orLike('id_produk', $searchTerm)
				->orLike('id_box', $searchTerm)
				->findAll();
		} else {
			$data['pengirimans'] = $pengirimanModel->findAll();
		}

		return view('pengiriman/pengiriman_view', $data);
	}

	public function show($id = null)
	{
		$model = new PengirimanBarangModel();
		$data['pengiriman'] = $model->getById($id);

		if ($data['pengiriman']) {
			return view('pengiriman_detail_view', $data);
		} else {
			return redirect()->to('/dashboard/pengirimanbarang')->with('error', 'Pengiriman not found');
		}
	}

	public function create()
	{
		$barangModel = new BarangModel();
		$boxModel = new BoxModel();
		$rakModel = new RakModel();
		$gudangModel = new GudangModel();
		$userModel = new UserModel();

		$data['barang'] = $barangModel->select('produk.*, box.id_box, box.tipe_box, rak.id as id_rak, gudang.id_gudang, gudang.nama_gudang, produk.klasifikasi_material, produk.jumlah as stok_produk, gudang.id_kepala, user.nama as nama_kepala')
			->join('box', 'produk.id_box = box.id_box')
			->join('rak', 'box.id_rak = rak.id')
			->join('gudang', 'rak.id_gudang = gudang.id_gudang')
			->join('user', 'gudang.id_kepala = user.id_user')
			->findAll();
		$data['box'] = $boxModel->findAll();
		$data['rak'] = $rakModel->findAll();
		$data['gudang'] = $gudangModel->findAll();
		$data['kepala_gudang'] = $userModel->findAll();

		if ($this->request->getMethod() == 'POST') {
			$requestData = $this->request->getPost();

			$id_produk = $requestData['id_produk'];
			$jumlahPengiriman = $requestData['jumlah'];

			// Cek jumlah stok produk
			$produk = $barangModel->find($id_produk);
			if ($produk['jumlah'] < $jumlahPengiriman) {
				return redirect()->to('/dashboard/pengirimanbarang/create')->with('error', 'Jumlah pengiriman melebihi stok yang tersedia');
			}

			// Kirim data ke halaman surat pengiriman
			return redirect()->to('/dashboard/pengirimanbarang/suratpengiriman')
				->with('pengirimanData', $requestData)
				->with('success', 'Silakan konfirmasi pengiriman.');
		}

		return view('pengiriman/pengiriman_add', $data);
	}

	public function suratPengiriman()
	{
		$pengirimanData = session()->getFlashdata('pengirimanData');

		if (!$pengirimanData) {
			return redirect()->to('/dashboard/pengirimanbarang/create')->with('error', 'Data pengiriman tidak valid.');
		}

		// Ambil id_produk dari pengirimanData
		$id_produk = $pengirimanData['id_produk'];

		// Lakukan join antara pengiriman_barang dan produk
		$barangModel = new BarangModel();
		$produk = $barangModel->select('produk.nama_produk')
		->where('produk.id_produk', $id_produk)
			->first();

		if (!$produk) {
			return redirect()->to('/dashboard/pengirimanbarang/create')->with('error', 'Produk tidak ditemukan.');
		}

		// Gabungkan nama_produk dengan data pengiriman
		$pengirimanData['nama_produk'] = $produk['nama_produk'];

		return view('pengiriman/surat_pengiriman', ['pengirimanData' => $pengirimanData]);
	}


	public function submitPengiriman()
	{
		$pengirimanBarangModel = new PengirimanBarangModel();
		$barangModel = new BarangModel();

		$requestData = $this->request->getPost();
		$id_produk = $requestData['id_produk'];
		$jumlahPengiriman = $requestData['jumlah'];

		// Update stok produk
		$produk = $barangModel->find($id_produk);
		$barangModel->update($id_produk, ['jumlah' => $produk['jumlah'] - $jumlahPengiriman]);

		// Siapkan data pengiriman untuk disimpan
		$pengirimanData = [
			'id_produk' => $id_produk,
			'jumlah' => $jumlahPengiriman,
			'tanggal_pengiriman' => $requestData['tanggal_pengiriman'],
			'status' => 'Pending'
		];

		// Simpan pengiriman ke database
		$pengirimanBarangModel->insert($pengirimanData);

		// Redirect ke halaman daftar pengiriman dengan pesan sukses
		return redirect()->to('/dashboard/pengirimanbarang')->with('success', 'Pengiriman berhasil disimpan.');
	}

	public function downloadPdf($id_pengiriman)
	{
		$model = new PengirimanBarangModel();
		$item = $model->getShipmentWithProduct($id_pengiriman);

		if (!$item) {
			return redirect()->to('/dashboard/pengirimanbarang')->with('error', 'Shipment data not found.');
		}

		$htmlContent = view('pengiriman/surat_pengiriman_pdf', ['item' => $item]);

		$dompdf = new Dompdf();
		$dompdf->loadHtml($htmlContent);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream("surat_pengiriman_barang_" . $id_pengiriman . ".pdf", array("Attachment" => true));
	}

	public function edit($id = null)
	{
		$model = new PengirimanBarangModel();
		$data['pengiriman'] = $model->getById($id);

		if ($this->request->getMethod() == 'post') {
			$data = $this->request->getPost();

			if ($model->updatePengiriman($id, $data)) {
				return redirect()->to('/dashboard/pengirimanbarang')->with('success', 'Pengiriman updated successfully');
			} else {
				return redirect()->to('/dashboard/pengirimanbarang/edit/' . $id)->with('error', 'Failed to update pengiriman');
			}
		}

		return view('pengiriman_edit_view', $data);
	}

	public function delete($id = null)
	{
		$model = new PengirimanBarangModel();

		if ($model->deletePengiriman($id)) {
			return redirect()->to('/dashboard/pengirimanbarang')->with('success', 'Pengiriman deleted successfully');
		} else {
			return redirect()->to('/dashboard/pengirimanbarang')->with('error', 'Failed to delete pengiriman');
		}
	}

	public function approve($id_pengiriman)
	{
		$model = new PengirimanBarangModel();

		if ($model->approvePengiriman($id_pengiriman)) {
			return redirect()->to('/dashboard/pengirimanbarang')->with('success', 'Pengiriman approved successfully');
		} else {
			return redirect()->to('/dashboard/pengirimanbarang')->with('error', 'Failed to approve pengiriman');
		}
	}
}
