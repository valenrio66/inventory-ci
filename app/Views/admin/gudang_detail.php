<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Gudang</a> / Detail Gudang
		</h5>
		<h1 class="h3 mb-3"><b>Detail Gudang</b></h1>
		<div class="row">
			<div class="col-12">
				<form>
					<div class="card">
						<div class="card-body">
							<!-- Inputan Nama Gudang -->
							<h5 class="card-title">Nama Gudang</h5>
							<input type="text" class="form-control" id="nama_gudang" name="nama_gudang" value="<?= esc($gudangs['nama_gudang']) ?>" disabled />

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Pilih Level -->
									<h5 class="card-title mt-2">Pilih Level</h5>
									<input type="text" class="form-control" id="level" name="level" value="<?= esc($gudangs['level']) ?>" disabled />
								</div>
								<div class="col-md-6">
									<!-- Inputan Pilih Kepala Gudang -->
									<h5 class="card-title mt-2">Pilih Kepala Gudang</h5>
									<input type="text" class="form-control" id="id_kepala" name="id_kepala" value="<?= esc($gudangs['nama']) ?> (<?= esc($gudangs['role']) ?>)" disabled />
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Nomor Handphone -->
									<h5 class="card-title mt-2">Nomor Handphone</h5>
									<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= esc($gudangs['no_hp']) ?>" disabled />
								</div>
								<div class="col-md-6">
									<!-- Inputan Kapasitas -->
									<h5 class="card-title mt-2">Kapasitas</h5>
									<input type="text" class="form-control" id="kapasitas" name="kapasitas" value="<?= number_format($gudangs['kapasitas'] / 1000000, 3) ?> m³" disabled />
								</div>
							</div>

							<div class="col-md-12">
								<!-- Inputan Alamat -->
								<h5 class="card-title mt-2">Alamat</h5>
								<input type="text" class="form-control" id="alamat" name="alamat" value="<?= esc($gudangs['alamat']) ?>" disabled />
							</div>

							<!-- Button Submit -->
							<div style="
                                    position: relative;
                                    text-align: right;
                                    margin-top: 20px;
                                ">
								<a href="#" type="button" onclick="history.back()" class="btn btn-info">
									Kembali
								</a>
								<button type="submit" class="btn btn-warning" id="submitButton">
									Edit
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
<script src="<?= base_url('js/gudang/add.js') ?>"></script>