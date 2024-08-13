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
						<h2>PT. JK SEJAHTERA</h2>
						<p>Jl. Bhayangkara 17, Sleman, Yogyakarta</p>
						<p>0888-5454-xxxx / jksejahtera@gmail.com</p>
					</div>

					<div class="content">
						<p>Yogyakarta, 01 Februari 2023</p>

						<p>Nomor: 02/09/PB/2023</p>
						<p>Hal: Pemberitahuan Pengiriman Barang</p>
						<p>Lampiran: 1 (lembar)</p>

						<p>Kepada Yth.<br>
							PT. JM MAJU JAYA<br>
							Jl. Asri 10, Klaten<br>
							Jawa Tengah</p>

						<p>Dengan hormat,</p>

						<p>Berdasarkan dokumen PO Nomor 31/245/BRG/2023 yang sampai kepada kami pada tanggal 30 Januari 2023, pesanan tersebut sudah kami terima.</p>

						<p>Bersama datangnya surat ini, kami memberitahukan bahwa barang pesanan telah dikirimkan dengan ekspedisi JK SEJAHTERA pada tanggal 1 Februari 2023. Pembayaran dapat dilakukan secara transfer ke nomor rekening 227722882299 paling lambat 7 hari kerja setelah barang diterima.</p>

						<div class="table-container">
							<p>Setiap unit barang dikemas dengan kardus terpisah dan dilapisi dengan <i>bubble wrap</i>. Berikut ini adalah daftar barang yang kami kirimkan beserta faktur pada lampiran:</p>
							<table>
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Barang</th>
										<th>Jumlah (Unit)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Pemanggang Roti Miyiko BR-223</td>
										<td>10</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Air Fryer Moonie 740</td>
										<td>10</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Blender Minimoni BT21</td>
										<td>10</td>
									</tr>
									<tr>
										<td>4</td>
										<td>Coffee Maker AMRCN Boost</td>
										<td>5</td>
									</tr>
								</tbody>
							</table>
						</div>

						<p>Apabila terdapat barang yang cacat/rusak (syarat & ketentuan berlaku), kami menerima retur penjualan paling lambat 2 hari setelah barang diterima.</p>

						<p>Demikian surat pengiriman barang ini kami sampaikan. Atas kerja sama yang baik kami mengucapkan terimakasih.</p>
					</div>

					<div class="signature">
						<p>Tim Penjualan</p>
						<p>PT. JK Sejahtera</p>
						<br><br>
						<p>Awan</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</main>

<?= $this->include('content/footer') ?>
<link rel="stylesheet" href="<?= base_url('css/surat/style.css') ?>">
<script src="<?= base_url('js/pengirimanbarang/approve.js') ?>"></script>