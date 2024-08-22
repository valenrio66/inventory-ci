<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Surat Pengiriman Barang</title>
	<style>
		body {
			font-family: 'Helvetica', 'Arial', sans-serif;
			margin: 20px;
		}

		.header,
		.content,
		.signature {
			margin-bottom: 20px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			border: 1px solid black;
			padding: 8px;
			text-align: left;
		}
	</style>
</head>

<body>
	<header>
		<h1>SURAT PENGIRIMAN BARANG</h1>
		<p>Cilegon, Banten, Indonesia</p>
	</header>

	<section class="content">
		<p>Bakauheni, <?= date('d F Y', strtotime($item['tanggal_pengiriman'])); ?></p>
		<p>Hal: Pemberitahuan Pengiriman Barang</p>
		<p>Lampiran: 1 (lembar)</p>

		<p>Kepada Yth.<br>
			Kepala Gudang<br>
			Di Tempat</p>

		<p>Dengan hormat,</p>

		<p>Berdasarkan dokumen PO yang sampai kepada kami, pesanan tersebut sudah kami terima. Bersama datangnya surat ini, kami memberitahukan bahwa barang pesanan telah dikirimkan dengan ekspedisi gudang pada tanggal <?= date('d F Y', strtotime($item['tanggal_pengiriman'])); ?>.</p>

		<div class="table-container">
			<p>Setiap unit barang dikemas dengan kardus terpisah dan dilapisi dengan bubble wrap. Berikut ini adalah daftar barang yang kami kirimkan beserta faktur pada lampiran:</p>
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
						<td><?= esc($item['nama_produk']); ?></td>
						<td><?= esc($item['jumlah']); ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<p>Apabila terdapat barang yang cacat/rusak (syarat & ketentuan berlaku), kami menerima retur penjualan paling lambat 2 hari setelah barang diterima. Demikian surat pengiriman barang ini kami sampaikan. Atas kerja sama yang baik kami mengucapkan terimakasih.</p>
	</section>

	<footer class="signature">
		<p>Tim Manajemen Gudang</p>
		<br><br>
		<p>Admin</p>
	</footer>
</body>

</html>