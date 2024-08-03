<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Box</a> / Detail Box
		</h5>
		<h1 class="h3 mb-3"><b>Detail Box</b></h1>
		<div class="row">
			<div class="col-12">
				<form>
					<div class="card">
						<div class="card-body">
							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Nomor Box -->
									<h5 class="card-title">Nomor Box</h5>
									<input type="text" class="form-control" id="id_box" name="id_box" value="<?= esc($boxs['id_box']) ?>" disabled />
								</div>
								<div class="col-md-6">
									<!-- Inputan Nomor Rak -->
									<h5 class="card-title">Nomor Rak</h5>
									<input type="text" class="form-control" id="id_rak" name="id_rak" value="<?= esc($boxs['id']) ?> (<?= esc($boxs['nama_gudang']) ?>)" disabled />
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-4">
									<h5 class="card-title mt-2">Tipe Box</h5>
									<!-- Inputan Tipe Box -->
									<input type="text" class="form-control" id="tipe_box" name="tipe_box" value="<?= esc($boxs['tipe_box']) ?>" disabled />
								</div>
								<div class="col-md-4">
									<h5 class="card-title mt-2">Kapasitas Tersedia</h5>
									<!-- Inputan Kapasitas Tersedia -->
									<input type="text" class="form-control" id="kapasitas_tersedia" name="kapasitas_tersedia" value="<?= esc($boxs['kapasitas_tersedia']) ?> cm³" disabled />
								</div>
								<div class="col-md-4">
									<!-- Inputan Kapasitas Terpakai -->
									<h5 class="card-title mt-2">Kapasitas Terpakai</h5>
									<input type="text" class="form-control" id="kapasitas_terpakai" name="kapasitas_terpakai" value="<?= esc($boxs['kapasitas_terpakai']) ?> cm³" disabled />
								</div>
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