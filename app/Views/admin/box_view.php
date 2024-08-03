<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Box</a> / Box View
		</h5>
		<h1 class="h3 mb-3"><b>Box View</b></h1>
		<div class="col-md-6 mb-3">
			<div class="d-flex justify-content-start">
				<a href="<?= base_url('/dashboard/box/add') ?>" type="button" class="btn btn-info me-2">
					<i class="align-middle" data-feather="list"></i>
					Tambah Box
				</a>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="row no-gutters" style="height: 40px">
							<h1 class="h3 mt-2">Tabel Box</h1>
						</div>

						<hr />
						<div class="table-container">
							<table id="example" class="table table-striped" style="width: 100%">
								<thead>
									<tr style="text-align: center; vertical-align: middle">
										<th hidden></th>
										<th>Nomor Box</th>
										<th>Nomor Rak</th>
										<th>Tipe Box</th>
										<th>Kapasitas Tersedia</th>
										<th>Kapasitas Terpakai</th>
										<th>Action</th>
									</tr>
								</thead>

								<!-- Fetch Data Start -->
								<tbody>
									<?php foreach ($boxs as $box) : ?>
										<tr>
											<td hidden></td>
											<td>
												<?= $box['id_box'] ?>
											</td>
											<td>
												<?= $box['id'] ?>
											</td>
											<td>
												<?= $box['tipe_box'] ?>
											</td>
											<td>
												<?= $box['kapasitas_tersedia'] ?> cm³
											</td>
											<td>
												<?= $box['kapasitas_terpakai'] ?> cm³
											</td>
											<td>
												<a href="<?= base_url('/dashboard/box/detail/' . $box['id_box']) ?>" class="btn btn-info">Detail</a>
												<a href="<?= base_url('/dashboard/box/update/' . $box['id_box']) ?>" class="btn btn-warning">Edit</a>
												<a href="<?= base_url('box/delete/' . $box['id_box']) ?>" class="btn btn-danger" onclick="return confirmDelete(event)">Delete</a>
											</td>
										</tr>
									<?php endforeach; ?>
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
<script src="<?= base_url('js/rak/delete.js') ?>"></script>