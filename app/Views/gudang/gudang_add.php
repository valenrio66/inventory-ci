<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Gudang</a> / Tambah Gudang
		</h5>
		<h1 class="h3 mb-3"><b>Tambah Gudang</b></h1>
		<div class="row">
			<div class="col-12">
				<form id="addGudang" action="<?= base_url('/gudang/add') ?>" method="post">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Nama Gudang</h5>
							<input type="text" class="form-control" id="nama_gudang" name="nama_gudang" placeholder="Masukkan Nama Gudang" required />

							<div class="row mt-1">
								<div class="col-md-6">
									<h5 class="card-title">Pilih Level</h5>
									<select class="form-control" id="level" name="level" required
										data-kepala-pusat='<?= json_encode($kepalaPusat) ?>'
										data-kepala-bagian='<?= json_encode($kepalaBagian) ?>'>
										<option value="">Pilih Level Gudang</option>
										<option value="Pusat">Gudang Pusat</option>
										<option value="Bagian">Gudang Bagian</option>
									</select>
								</div>
								<div class="col-md-6">
									<h5 class="card-title">Pilih Kepala Gudang</h5>
									<select id="id_kepala" name="id_kepala" class="form-control">
										<option selected>Pilih Kepala Gudang</option>
									</select>
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<h5 class="card-title mt-2">Nomor Handphone</h5>
									<input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Handphone" required />
								</div>
								<div class="col-md-6">
									<h5 class="card-title mt-2">Kapasitas</h5>
									<input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Masukkan Kapasitas (Jumlah Rak)" required />
								</div>
							</div>

							<div class="col-md-12">
								<h5 class="card-title mt-2">Alamat</h5>
								<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Gudang" required />
							</div>

							<div style="position: relative; text-align: right; margin-top: 20px;">
								<a href="#" type="button" onclick="history.back()" class="btn btn-info">Kembali</a>
								<button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

<?= $this->include('content/footer') ?>
<script src="<?= base_url('js/gudang/add.js') ?>"></script>