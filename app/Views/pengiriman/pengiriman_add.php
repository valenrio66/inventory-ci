<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">Pengiriman Barang</a> / Tambah Pengiriman Barang
		</h5>
		<h1 class="h3 mb-3"><b>Tambah Pengiriman Barang</b></h1>
		<div class="row">
			<div class="col-12">
				<form id="addPengirimanBarang" action="<?= base_url('/dashboard/pengirimanbarang/add') ?>" method="post">
					<div class="card">
						<div class="card-body">
							<div class="row mt-1">
								<div class="form-group">
									<!-- Inputan Pilih Rak -->
									<h5 class="card-title">Pilih Produk</h5>
									<select id="id_produk" name="id_produk" class="form-control">
										<option value="">Pilih Produk</option>
										<?php if (!empty($barang)) : ?>
											<?php foreach ($barang as $item) : ?>
												<option value="<?= esc($item['id_produk']); ?>" data-box="<?= esc($item['id_box']); ?>" data-tipe_box="<?= esc($item['tipe_box']); ?>" data-rak="<?= esc($item['id_rak']); ?>" data-gudang="<?= esc($item['id_gudang']); ?>" data-nama_gudang="<?= esc($item['nama_gudang']); ?>" data-jumlah="<?= esc($item['stok_produk']); ?>" data-kepala="<?= esc($item['nama_kepala']); ?>">
													<?= esc($item['nama_produk']); ?> - <?= esc($item['klasifikasi_material']); ?>
												</option>
											<?php endforeach; ?>
										<?php else : ?>
											<option value="">No Produk Available</option>
										<?php endif; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="jumlah_stok">Jumlah Stok Produk</label>
									<input type="text" id="jumlah_stok" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label for="id_box">Box (Tipe Box)</label>
									<input type="text" name="id_box" id="id_box" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label for="id_rak">Rak</label>
									<input type="text" name="id_rak" id="id_rak" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label for="id_gudang">Gudang</label>
									<input type="text" name="id_gudang" id="id_gudang" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label for="nama_kepala">Kepala Gudang</label>
									<input type="text" name="nama_kepala" id="nama_kepala" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label for="jumlah">Jumlah</label>
									<input type="number" name="jumlah" id="jumlah" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="tanggal_pengiriman">Tanggal Pengiriman</label>
									<input type="date" name="tanggal_pengiriman" id="tanggal_pengiriman" class="form-control" required>
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
<script src="<?= base_url('js/pengirimanbarang/add.js') ?>"></script>