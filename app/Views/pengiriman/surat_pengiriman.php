<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
    <div class="container-fluid p-0">
        <h5 class="right-aligned" style="float: right">
            <a href="#">Home</a> / <a href="#">Pengiriman Barang</a> / Surat Pengiriman Barang
        </h5>
        <h1 class="h3 mb-3"><b>Surat Pengiriman Barang</b></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header">
                        <h2>SURAT PENGIRIMAN BARANG</h2>
                        <p>Cilegon, Banten, Indonesia</p>
                    </div>

                    <div class="content">
                        <p>Bakauheni, <?= date('d F Y', strtotime($pengirimanData['tanggal_pengiriman'])) ?></p>

                        <p>Hal: Pemberitahuan Pengiriman Barang</p>
                        <p>Lampiran: 1 (lembar)</p>

                        <p>Kepada Yth.<br>
                            Kepala Gudang<br>
                            Di Tempat</p>

                        <p>Dengan hormat,</p>

                        <p>Berdasarkan dokumen PO yang sampai kepada kami, pesanan tersebut sudah kami terima. Bersama datangnya surat ini, kami memberitahukan bahwa barang pesanan telah dikirimkan dengan ekspedisi gudang pada tanggal <?= date('d F Y', strtotime($pengirimanData['tanggal_pengiriman'])) ?>.</p>

                        <div class="table-container">
                            <p>Setiap unit barang dikemas dengan kardus terpisah dan dilapisi dengan <i>bubble wrap</i>. Berikut ini adalah daftar barang yang kami kirimkan beserta faktur pada lampiran:</p>
                            <table>
                                <thead>
                                    <tr>
										<th hidden></th>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah (Unit)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><?= esc($pengirimanData['nama_produk']) ?? '...' ?></td>
                                        <td><?= esc($pengirimanData['jumlah']) ?? '...' ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <p>Apabila terdapat barang yang cacat/rusak (syarat & ketentuan berlaku), kami menerima retur penjualan paling lambat 2 hari setelah barang diterima. Demikian surat pengiriman barang ini kami sampaikan. Atas kerja sama yang baik kami mengucapkan terimakasih.</p>
                    </div>

                    <div class="signature">
                        <p>Tim Manajemen Gudang</p>
                        <br><br>
                        <p>Admin</p>
                    </div>
                </div>
            </div>
			<div class="mt-4 text-right">
                <form action="<?= base_url('/dashboard/pengirimanbarang/submitpengiriman') ?>" method="post">
                    <input type="hidden" name="id_produk" value="<?= esc($pengirimanData['id_produk']) ?>">
                    <input type="hidden" name="jumlah" value="<?= esc($pengirimanData['jumlah']) ?>">
                    <input type="hidden" name="tanggal_pengiriman" value="<?= esc($pengirimanData['tanggal_pengiriman']) ?>">
					<button id="submitPengiriman" type="submit" class="btn btn-success">Submit Pengiriman</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>

<?= $this->include('content/footer') ?>
<link rel="stylesheet" href="<?= base_url('css/surat/style.css') ?>">
<script src="<?= base_url('js/pengirimanbarang/submitpengiriman.js') ?>"></script>