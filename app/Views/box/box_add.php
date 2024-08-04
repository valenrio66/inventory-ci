<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Box</a> / Tambah Box
		</h5>
		<h1 class="h3 mb-3"><b>Tambah Box</b></h1>
		<div class="row">
			<div class="col-12">
				<form id="addBox" action="<?= base_url('/box/add') ?>" method="post">
					<div class="card">
						<div class="card-body">
							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Pilih Rak -->
									<h5 class="card-title">Pilih Rak</h5>
									<select id="id_rak" name="id_rak" class="form-control">
										<option selected>Pilih Rak</option>
										<?php foreach ($raks as $rak) : ?>
											<option value="<?= esc($rak['id']); ?>">
												<?= esc($rak['id']); ?> - <?= esc($rak['id_gudang']); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-6">
									<!-- Inputan Pilih Tipe Box -->
									<h5 class="card-title">Pilih Tipe Box</h5>
									<select class="form-control" id="tipe_box" name="tipe_box" required>
										<option value="">Pilih Tipe Box</option>
										<?php foreach ($tipe_box_options as $option) : ?>
											<option value="<?= htmlspecialchars($option); ?>"><?= htmlspecialchars($option); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
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