<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Pengiriman Barang</a> / Pengiriman Barang View
		</h5>
		<h1 class="h3 mb-3"><b>Pengiriman Barang View</b></h1>
		<div class="col-md-6 mb-3">
			<div class="d-flex justify-content-start">
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
				<?php if ($userRole['role'] == 'Admin' || $userRole['role'] == 'Super Admin') : ?>
					<a href="<?= base_url('/dashboard/pengirimanbarang/add') ?>" type="button" class="btn btn-info me-2">
						<i class="align-middle" data-feather="list"></i>
						Tambah Pengiriman Barang
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<!-- Input Search -->
					<input type="text" id="searchInput" class="form-control me-2" placeholder="Cari Barang..." onkeyup="searchPengiriman()">
					<div class="row no-gutters" style="height: 40px">
						<h1 class="h3 mt-2">Tabel Pengiriman Barang</h1>
					</div>

					<hr />
					<div class="table-container">
						<table id="example" class="table table-striped" style="width: 100%">
							<thead>
								<tr style="text-align: center; vertical-align: middle">
									<th hidden></th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Box</th>
									<th>Rak</th>
									<th>Gudang</th>
									<th>Kepala Gudang</th>
									<th>Jumlah Barang yang Dikirim</th>
									<th>Tanggal Pengiriman</th>
									<th>Tracking</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>

							<!-- Fetch Data Start -->
							<tbody>
								<?php if (!empty($pengiriman) && is_array($pengiriman)) : ?>
									<?php foreach ($pengiriman as $item) : ?>
										<tr style="text-align: center; vertical-align: middle">
											<td hidden></td>
											<td><?= esc($item['id_produk']); ?></td>
											<td><?= esc($item['nama_produk']); ?></td>
											<td><?= esc($item['id_box']); ?></td>
											<td><?= esc($item['id_rak']); ?></td>
											<td><?= esc($item['nama_gudang']); ?></td>
											<td><?= esc($item['nama']); ?></td>
											<td><?= esc($item['jumlah']) . ' dari ' . esc($item['total_stok']) . ' pcs'; ?></td>
											<td><?= esc($item['tanggal_pengiriman']); ?></td>
											<td><?= esc($item['tracking']); ?></td>
											<td><?= esc($item['status']); ?></td>
											<?php if ($userRole['role'] == 'Gudang Pusat' || $userRole['role'] == 'Gudang Bagian') : ?>
												<td>
													<?php if ($item['status'] == 'Pending' && $item['tracking'] == 'Barang Sampai di Gudang') : ?>
														<form id="approveKirim" action="<?= site_url('/dashboard/pengirimanbarang/approve/' . $item['id_pengiriman']); ?>" method="post" style="display:inline-block;">
															<input type="hidden" name="id_pengiriman" value="<?= esc($current_user_id); ?>">
															<button type="submit" class="btn btn-success btn-sm">Approve</button>
														</form>
														<a href="<?= base_url('/dashboard/pengirimanbarang/download/' . $item['id_pengiriman']); ?>" class="btn btn-primary">Download Surat</a>
													<?php elseif ($item['status'] == 'Approved' && $item['tracking'] == 'Barang Keluar dari Gudang' || 'Barang Sedang dalam Perjalanan') : ?>
														<span class="text-muted">No Action Required</span>
													<?php endif; ?>
												</td>
											<?php elseif ($userRole['role'] == "Admin" || $userRole['role'] == "Super Admin") : ?>
												<td>
													<a href="<?= site_url('/dashboard/pengirimanbarang/edit/' . $item['id_pengiriman']); ?>" class="btn btn-info btn-sm">Tracking</a>
													<a href="<?= site_url('pengirimanbarang/delete/' . $item['id_pengiriman']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
												</td>
											<?php endif; ?>
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
	</div>
</main>

<?= $this->include('content/footer') ?>
<script src="<?= base_url('js/pengirimanbarang/approve.js') ?>"></script>
<script>
	function searchPengiriman() {
		var input, filter, table, tr, td, i, j, txtValue;
		input = document.getElementById('searchInput');
		filter = input.value.toUpperCase();
		table = document.getElementById('example');
		tr = table.getElementsByTagName('tr');

		for (i = 1; i < tr.length; i++) {
			tr[i].style.display = 'none';
			td = tr[i].getElementsByTagName('td');
			for (j = 0; j < td.length; j++) {
				if (td[j]) {
					txtValue = td[j].textContent || td[j].innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = '';
						break;
					}
				}
			}
		}
	}
</script>