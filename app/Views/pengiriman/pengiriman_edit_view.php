<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Pengiriman Barang</a> / Tracking Pengiriman Barang
		</h5>
		<h1 class="h3 mb-3"><b>Tracking Pengiriman Barang</b></h1>
		<div class="row">
			<div class="col-12">
				<form id="updatePengirimanBarang" action="<?= base_url('/pengirimanbarang/edit/' . $pengirimans['id_pengiriman']) ?>" method="post">
					<div class="card">
						<div class="card-body">
							<div class="row mt-1">
								<div class="form-group">
								<div class="row mt-1">
									<div class="col-md-6">
										<!-- Inputan Pilih Produk -->
										<h5 class="card-title">Produk</h5>
										<input type="text" id="id_produk" class="form-control" value="<?= esc($pengirimans['nama_produk']) ?>" disabled>
									</div>
									<div class="col-md-6">
										<h5 class="card-title">Jumlah Stok Produk</h5>
										<input type="text" id="jumlah_stok" class="form-control" value="<?= esc($pengirimans['total_stok']) ?>" disabled>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-6">
										<h5 class="card-title">Box (Tipe Box)</h5>
										<input type="text" name="id_box" id="id_box" class="form-control" value="<?= esc($pengirimans['id_box']) ?>" disabled>
									</div>
									<div class="col-md-6">
										<h5 class="card-title">Rak</h5>
										<input type="text" name="id_rak" id="id_rak" class="form-control" value="<?= esc($pengirimans['id_rak']) ?>" disabled>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-6">
										<h5 class="card-title">Gudang</h5>
										<input type="text" name="id_gudang" id="id_gudang" class="form-control" value="<?= esc($pengirimans['nama_gudang']) ?>" disabled>
									</div>
									<div class="col-md-6">
										<h5 class="card-title">Kepala Gudang</h5>
										<input type="text" name="nama_kepala" id="nama_kepala" class="form-control" value="<?= esc($pengirimans['nama']) ?>" disabled>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-6">
										<h5 class="card-title">Jumlah</h5>
										<input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan Jumlah Barang" value="<?= esc($pengirimans['jumlah']) ?>" disabled>
									</div>
									<div class="col-md-6">
										<h5 class="card-title">Tanggal Pengiriman</h5>
										<input type="datetime-local" name="tanggal_pengiriman" id="tanggal_pengiriman" class="form-control" value="<?= esc($pengirimans['tanggal_pengiriman']) ?>" disabled>
									</div>
								</div>
                                <div class="row mt-3">
									<div class="col-md-12">
										<h5 class="card-title">Status Pengiriman</h5>
										<input type="text" name="status" id="status" class="form-control" value="<?= esc($pengirimans['status']) ?>" disabled>
									</div>
								</div>
                                <hr class="mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Status Tracking Sebelumnya</h5>
                                        <input type="text" name="tracking" id="tracking_sebelum" class="form-control" value="<?= esc($pengirimans['tracking']) ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Status Tracking Selanjutnya</h5>
                                        <select class="form-control" id="tracking" name="tracking" required>
                                            <option value="">Pilih Status Tracking</option>
                                            <?php foreach ($tracking as $option) : ?>
                                                <option value="<?= htmlspecialchars($option); ?>"><?= htmlspecialchars($option); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
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
<script src="<?= base_url('js/pengirimanbarang/edit.js') ?>"></script>