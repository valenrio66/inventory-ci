<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

	<?php
		// Periksa apakah user ID tersedia di sesi
		$userId = session('id_user') ?? null;

		if ($userId) {
		// Periksa apakah model user ada dan dapat digunakan
			if (class_exists('\App\Models\UserModel')) {
				$userModel = new \App\Models\UserModel();

				// Periksa apakah userRole dapat diambil dari model
				if (method_exists($userModel, 'getUserById')) {
					$userRole = $userModel->getUserById($userId);
				} else {
					$userRole['role'] = ""; // Jika method tidak ada, atur ke Guest
						}
				} else {
					$userRole['role'] = ""; // Jika model tidak ada, atur ke Guest
				}
			} else {
				$userRole['role'] = ""; // Jika user ID tidak tersedia di sesi, atur ke Guest
		}
	?>

	<?php if ($userRole['role'] == "Super Admin") : ?>
		<?php
			// Ambil data dari model User
			$userModel = new \App\Models\UserModel();
			$users = $userModel->findAll();

			// Ambil data dari model Gudang
			$gudangModel = new \App\Models\GudangModel();
			$gudangs = $gudangModel->getGudangWithKepala();

			// Ambil data dari model Rak
			$rakModel = new \App\Models\RakModel();
			$raks = $rakModel->getRakWithGudang();

			// Ambil data dari model Box
			$boxModel = new \App\Models\BoxModel();
			$boxs = $boxModel->getBoxWithRak();
			
			// Ambil data dari Barang
			$barangModel = new \App\Models\BarangModel();
			$barangs = $barangModel->getBarangWithBox();

			// Ambil data dari model Pengiriman
			$pengirimanModel = new \App\Models\PengirimanBarangModel();
			$pengiriman = $pengirimanModel->getAll();
		?>
	<main class="content">
		<div class="container-fluid p-0">
			<h5 class="right-aligned" style="float: right">
				<a href="#">Home</a> / <a href="#">Super Admin</a> / Dashboard
			</h5>
			<h1 class="h3 mb-3"><b>Dashboard Super Admin</b></h1>
			<div class="row">
				<div class="row">
					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total User</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="users"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($users) ?> User</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah User LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Gudang</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($gudangs) ?> Gudang</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Gudang dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Rak</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($raks) ?> Rak</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Rak dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Box</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($boxs) ?> Box</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Box dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Barang</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($barangs) ?> Barang</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Barang dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Pengiriman</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($pengiriman) ?> Pengiriman</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Pengiriman dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- View Tabel Pengiriman -->
		<?php
			// Ambil data dari model Key Result
			$pengirimanModel = new \App\Models\PengirimanBarangModel();

			$data['pengiriman'] = $pengirimanModel->getAll();
		?>
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3"><b>Pengiriman Barang</b></h1>
		</div>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="table-container mt-3">
							<table id="example" class="table table-striped" style="width: 100%">
								<thead>
									<tr style="text-align: center; vertical-align: middle">
										<th hidden></th>
										<th>Nama Produk</th>
										<th>Box</th>
										<th>Rak</th>
										<th>Gudang</th>
										<th>Kepala Gudang</th>
										<th>Jumlah</th>
										<th>Tanggal Pengiriman</th>
										<th>Status</th>
									</tr>
								</thead>

								<!-- Fetch Data Start -->
								<tbody>
									<?php if (!empty($pengiriman) && is_array($pengiriman)) : ?>
										<?php foreach ($pengiriman as $item) : ?>
											<tr style="text-align: center; vertical-align: middle">
												<td hidden></td>
												<td><?= esc($item['nama_produk']); ?></td>
												<td><?= esc($item['id_box']); ?></td>
												<td><?= esc($item['id_rak']); ?></td>
												<td><?= esc($item['nama_gudang']); ?></td>
												<td><?= esc($item['nama']); ?></td>
												<td><?= esc($item['jumlah']); ?></td>
												<td><?= esc($item['tanggal_pengiriman']); ?></td>
												<td><?= esc($item['status']); ?></td>
											</tr>
										<?php endforeach; ?>
									<?php else : ?>
										<tr>
											<td colspan="6" class="text-center">No data found</td>
										</tr>
									<?php endif; ?>
								</tbody>
								<!-- Fetch Data End -->

							</table>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="pagination">
									<button id="prevPageBtn" class="btn btn-primary">
										Previous
									</button>
									<span id="currentPage" class="mx-2">Halaman 1</span>
									<button id="nextPageBtn" class="btn btn-primary">
										Next
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php elseif ($userRole['role'] == "Admin") : ?>
		<?php
			// Ambil data dari model Gudang
			$gudangModel = new \App\Models\GudangModel();
			$gudangs = $gudangModel->getGudangWithKepala();

			// Ambil data dari model Rak
			$rakModel = new \App\Models\RakModel();
			$raks = $rakModel->getRakWithGudang();

			// Ambil data dari model Box
			$boxModel = new \App\Models\BoxModel();
			$boxs = $boxModel->getBoxWithRak();
			
			// Ambil data dari Barang
			$barangModel = new \App\Models\BarangModel();
			$barangs = $barangModel->getBarangWithBox();

			// Ambil data dari model Pengiriman
			$pengirimanModel = new \App\Models\PengirimanBarangModel();
			$pengiriman = $pengirimanModel->getAll();
		?>
	<main class="content">
		<div class="container-fluid p-0">
			<h5 class="right-aligned" style="float: right">
				<a href="#">Home</a> / <a href="#">Admin</a> / Dashboard
			</h5>
			<h1 class="h3 mb-3"><b>Dashboard Admin</b></h1>
			<div class="row">
				<div class="row">
					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Gudang</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($gudangs) ?> Gudang</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Gudang dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Rak</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($raks) ?> Rak</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Rak dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Box</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($boxs) ?> Box</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Box dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Barang</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($barangs) ?> Barang</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Barang dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Total Pengiriman</h5>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="list"></i>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= count($pengiriman) ?> Pengiriman</h1>
								<div class="mb-0">
									<span class="text-muted">Jumlah Pengiriman dalam LOGIWARE.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- View Tabel Pengiriman -->
		<?php
			// Ambil data dari model Key Result
			$pengirimanModel = new \App\Models\PengirimanBarangModel();

			$data['pengiriman'] = $pengirimanModel->getAll();
		?>
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3"><b>Pengiriman Barang</b></h1>
		</div>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="table-container mt-3">
							<table id="example" class="table table-striped" style="width: 100%">
								<thead>
									<tr style="text-align: center; vertical-align: middle">
										<th hidden></th>
										<th>Nama Produk</th>
										<th>Box</th>
										<th>Rak</th>
										<th>Gudang</th>
										<th>Kepala Gudang</th>
										<th>Jumlah</th>
										<th>Tanggal Pengiriman</th>
										<th>Status</th>
									</tr>
								</thead>

								<!-- Fetch Data Start -->
								<tbody>
									<?php if (!empty($pengiriman) && is_array($pengiriman)) : ?>
										<?php foreach ($pengiriman as $item) : ?>
											<tr style="text-align: center; vertical-align: middle">
												<td hidden></td>
												<td><?= esc($item['nama_produk']); ?></td>
												<td><?= esc($item['id_box']); ?></td>
												<td><?= esc($item['id_rak']); ?></td>
												<td><?= esc($item['nama_gudang']); ?></td>
												<td><?= esc($item['nama']); ?></td>
												<td><?= esc($item['jumlah']); ?></td>
												<td><?= esc($item['tanggal_pengiriman']); ?></td>
												<td><?= esc($item['status']); ?></td>
											</tr>
										<?php endforeach; ?>
									<?php else : ?>
										<tr>
											<td colspan="6" class="text-center">No data found</td>
										</tr>
									<?php endif; ?>
								</tbody>
								<!-- Fetch Data End -->

							</table>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="pagination">
									<button id="prevPageBtn" class="btn btn-primary">
										Previous
									</button>
									<span id="currentPage" class="mx-2">Halaman 1</span>
									<button id="nextPageBtn" class="btn btn-primary">
										Next
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php elseif ($userRole['role'] == "Gudang Pusat") : ?>
		<?php
			// Ambil data dari model User
			$userModel = new \App\Models\UserModel();
			$users = $userModel->findAll();

			// Ambil data dari model Gudang
			$gudangModel = new \App\Models\GudangModel();
			$gudangs = $gudangModel->getGudangWithKepala();

			// Ambil data dari model Rak
			$rakModel = new \App\Models\RakModel();
			$raks = $rakModel->getRakWithGudang();

			// Ambil data dari model Box
			$boxModel = new \App\Models\BoxModel();
			$boxs = $boxModel->getBoxWithRak();
			
			// Ambil data dari Barang
			$barangModel = new \App\Models\BarangModel();
			$barangs = $barangModel->getBarangWithBox();

			// Ambil data dari model Pengiriman
			$pengirimanModel = new \App\Models\PengirimanBarangModel();
			$pengiriman = $pengirimanModel->getAll();
		?>
		<main class="content">
		<!-- View Tabel Pengiriman -->
		<?php
			// Ambil data dari model Key Result
			$pengirimanModel = new \App\Models\PengirimanBarangModel();

			$data['pengiriman'] = $pengirimanModel->getAll();
		?>
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3"><b>Pengiriman Barang</b></h1>
		</div>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="table-container mt-3">
							<table id="example" class="table table-striped" style="width: 100%">
								<thead>
									<tr style="text-align: center; vertical-align: middle">
										<th hidden></th>
										<th>Nama Produk</th>
										<th>Box</th>
										<th>Rak</th>
										<th>Gudang</th>
										<th>Kepala Gudang</th>
										<th>Jumlah</th>
										<th>Tanggal Pengiriman</th>
										<th>Status</th>
									</tr>
								</thead>

								<!-- Fetch Data Start -->
								<tbody>
									<?php if (!empty($pengiriman) && is_array($pengiriman)) : ?>
										<?php foreach ($pengiriman as $item) : ?>
											<tr style="text-align: center; vertical-align: middle">
												<td hidden></td>
												<td><?= esc($item['nama_produk']); ?></td>
												<td><?= esc($item['id_box']); ?></td>
												<td><?= esc($item['id_rak']); ?></td>
												<td><?= esc($item['nama_gudang']); ?></td>
												<td><?= esc($item['nama']); ?></td>
												<td><?= esc($item['jumlah']); ?></td>
												<td><?= esc($item['tanggal_pengiriman']); ?></td>
												<td><?= esc($item['status']); ?></td>
											</tr>
										<?php endforeach; ?>
									<?php else : ?>
										<tr>
											<td colspan="6" class="text-center">No data found</td>
										</tr>
									<?php endif; ?>
								</tbody>
								<!-- Fetch Data End -->

							</table>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="pagination">
									<button id="prevPageBtn" class="btn btn-primary">
										Previous
									</button>
									<span id="currentPage" class="mx-2">Halaman 1</span>
									<button id="nextPageBtn" class="btn btn-primary">
										Next
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</main>
	<?php elseif ($userRole['role'] == "Gudang Bagian") : ?>
		<?php
			// Ambil data dari model User
			$userModel = new \App\Models\UserModel();
			$users = $userModel->findAll();

			// Ambil data dari model Gudang
			$gudangModel = new \App\Models\GudangModel();
			$gudangs = $gudangModel->getGudangWithKepala();

			// Ambil data dari model Rak
			$rakModel = new \App\Models\RakModel();
			$raks = $rakModel->getRakWithGudang();

			// Ambil data dari model Box
			$boxModel = new \App\Models\BoxModel();
			$boxs = $boxModel->getBoxWithRak();
			
			// Ambil data dari Barang
			$barangModel = new \App\Models\BarangModel();
			$barangs = $barangModel->getBarangWithBox();

			// Ambil data dari model Pengiriman
			$pengirimanModel = new \App\Models\PengirimanBarangModel();
			$pengiriman = $pengirimanModel->getAll();
		?>
		<main class="content">
		<!-- View Tabel Pengiriman -->
		<?php
			// Ambil data dari model Key Result
			$pengirimanModel = new \App\Models\PengirimanBarangModel();

			$data['pengiriman'] = $pengirimanModel->getAll();
		?>
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3"><b>Pengiriman Barang</b></h1>
		</div>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="table-container mt-3">
							<table id="example" class="table table-striped" style="width: 100%">
								<thead>
									<tr style="text-align: center; vertical-align: middle">
										<th hidden></th>
										<th>Nama Produk</th>
										<th>Box</th>
										<th>Rak</th>
										<th>Gudang</th>
										<th>Kepala Gudang</th>
										<th>Jumlah</th>
										<th>Tanggal Pengiriman</th>
										<th>Status</th>
									</tr>
								</thead>

								<!-- Fetch Data Start -->
								<tbody>
									<?php if (!empty($pengiriman) && is_array($pengiriman)) : ?>
										<?php foreach ($pengiriman as $item) : ?>
											<tr style="text-align: center; vertical-align: middle">
												<td hidden></td>
												<td><?= esc($item['nama_produk']); ?></td>
												<td><?= esc($item['id_box']); ?></td>
												<td><?= esc($item['id_rak']); ?></td>
												<td><?= esc($item['nama_gudang']); ?></td>
												<td><?= esc($item['nama']); ?></td>
												<td><?= esc($item['jumlah']); ?></td>
												<td><?= esc($item['tanggal_pengiriman']); ?></td>
												<td><?= esc($item['status']); ?></td>
											</tr>
										<?php endforeach; ?>
									<?php else : ?>
										<tr>
											<td colspan="6" class="text-center">No data found</td>
										</tr>
									<?php endif; ?>
								</tbody>
								<!-- Fetch Data End -->

							</table>
						</div>
						<div class="row mt-3">
							<div class="col-md-6">
								<div class="pagination">
									<button id="prevPageBtn" class="btn btn-primary">
										Previous
									</button>
									<span id="currentPage" class="mx-2">Halaman 1</span>
									<button id="nextPageBtn" class="btn btn-primary">
										Next
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</main>
	<?php else : ?>
		<main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3">Blank Page</h1>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Empty card</h5>
							</div>
							<div class="card-body">
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php endif; ?>

<?= $this->include('content/footer') ?>