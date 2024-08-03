<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Rak</a> / Detail Rak
		</h5>
		<h1 class="h3 mb-3"><b>Detail Rak</b></h1>
		<div class="row">
			<div class="col-12">
				<form>
					<div class="card">
						<div class="card-body">
							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Nomor Rak -->
									<h5 class="card-title">Nomor Rak</h5>
									<input type="number" class="form-control" id="id" name="id" value="<?= esc($raks['id']) ?>" disabled />
								</div>
								<div class="col-md-6">
									<!-- Inputan Gudang -->
									<h5 class="card-title">Gudang</h5>
									<input type="text" class="form-control" id="kapasitas_fast" name="kapasitas_fast" value="<?= esc($raks['nama_gudang']) ?>" disabled />
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Kapasitas Barang Fast Moving -->
									<h5 class="card-title mt-2">Kapasitas Barang Fast Moving</h5>
									<input type="text" class="form-control" id="kapasitas_fast" name="kapasitas_fast" value="<?= esc($raks['kapasitas_fast']) ?> cm³" disabled />
								</div>
								<div class="col-md-6">
									<!-- Inputan Kapasitas Barang Medium Moving -->
									<h5 class="card-title mt-2">Kapasitas Barang Medium Moving</h5>
									<input type="text" class="form-control" id="kapasitas_medium" name="kapasitas_medium" value="<?= esc($raks['kapasitas_medium']) ?> cm³" disabled />
								</div>
							</div>

							<div class="col-md-12">
								<!-- Inputan Kapasitas Barang Slow Moving -->
								<h5 class="card-title mt-2">Kapasitas Barang Slow Moving</h5>
								<input type="text" class="form-control" id="kapasitas_slow" name="kapasitas_slow" value="<?= esc($raks['kapasitas_slow']) ?> cm³" disabled />
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
								<button type="submit" class="btn btn-primary" id="submitButton">
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
<script src="<?= base_url('js/rak/add.js') ?>"></script>