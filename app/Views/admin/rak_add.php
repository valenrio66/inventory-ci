<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Rak</a> / Tambah Rak
		</h5>
		<h1 class="h3 mb-3"><b>Tambah Rak</b></h1>
		<div class="row">
			<div class="col-12">
				<form id="addRak" action="<?= base_url('/rak/add') ?>" method="post">
					<div class="card">
						<div class="card-body">
							<!-- Inputan Pilih Gudang -->
							<h5 class="card-title">Pilih Gudang</h5>
							<select id="id_gudang" name="id_gudang" class="form-control">
								<option selected>Pilih Gudang</option>
								<?php foreach ($gudangs as $gudang) : ?>
									<option value="<?= esc($gudang['id_gudang']); ?>">
										<?= esc($gudang['nama_gudang']); ?> - <?= esc($gudang['level']); ?>
									</option>
								<?php endforeach; ?>
							</select>

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Kapasitas Barang Fast Moving -->
									<h5 class="card-title mt-2">Kapasitas Barang Fast Moving</h5>
									<input type="number" class="form-control" id="kapasitas_fast" name="kapasitas_fast" placeholder="Masukkan Kapasitas Barang Fast Moving (Jumlah Box/Bin)" required />
								</div>
								<div class="col-md-6">
									<!-- Inputan Kapasitas Barang Medium Moving -->
									<h5 class="card-title mt-2">Kapasitas Barang Medium Moving</h5>
									<input type="number" class="form-control" id="kapasitas_medium" name="kapasitas_medium" placeholder="Masukkan Kapasitas Barang Medium Moving (Jumlah Box/Bin)" required />
								</div>
							</div>

							<div class="col-md-12">
								<!-- Inputan Kapasitas Barang Slow Moving -->
								<h5 class="card-title mt-2">Kapasitas Barang Slow Moving</h5>
								<input type="number" class="form-control" id="kapasitas_slow" name="kapasitas_slow" placeholder="Masukkan Kapasitas Barang Slow Moving (Jumlah Box/Bin)" required />
							</div>

							<!-- Button Submit -->
							<div style="
                                    position: relative;
                                    text-align: right;
                                    margin-top: 20px;
                                ">
								<a href="#" type="button" onclick="history.back()" class="btn btn-info">
									Cancel
								</a>
								<button type="submit" class="btn btn-primary" id="submitButton">
									Simpan
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

<?= $this->include('content/footer') ?>
<script src="<?= base_url('js/rak/add.js') ?>"></script>