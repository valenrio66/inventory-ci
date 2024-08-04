document.addEventListener('DOMContentLoaded', function () {
	// Saat produk dipilih, isi otomatis field box dan rak
	document.getElementById('id_produk').addEventListener('change', function () {
		var selectedOption = this.options[this.selectedIndex];
		var boxId = selectedOption.getAttribute('data-box');
		var tipeBox = selectedOption.getAttribute('data-tipe_box');
		var rakId = selectedOption.getAttribute('data-rak');
		var gudangId = selectedOption.getAttribute('data-gudang');
		var namaGudang = selectedOption.getAttribute('data-nama_gudang');
		var jumlahStok = selectedOption.getAttribute('data-jumlah');
		var namaKepala = selectedOption.getAttribute('data-kepala');

		document.getElementById('id_box').value = boxId + " (" + tipeBox + ")";
		document.getElementById('id_rak').value = rakId;
		document.getElementById('id_gudang').value = namaGudang; // display the name of the gudang
		document.getElementById('jumlah_stok').value = jumlahStok;
		document.getElementById('nama_kepala').value = namaKepala;
	});

	document.getElementById('jumlah').addEventListener('input', function () {
		var jumlahInput = parseInt(this.value);
		var stokMaksimal = parseInt(document.getElementById('id_produk').selectedOptions[0].getAttribute('data-jumlah'));

		if (jumlahInput > stokMaksimal) {
			// Menggunakan SweetAlert untuk pemberitahuan
			Swal.fire({
				title: 'Peringatan!',
				text: 'Jumlah pengiriman melebihi stok yang tersedia. Stok maksimal: ' + stokMaksimal,
				icon: 'warning',
				confirmButtonText: 'Ok'
			});
			this.value = stokMaksimal; // Optional: Set value to max available stock
		}
	});

	// Tangkap formulir
	const form = document.querySelector('#addPengirimanBarang');

	// Tambahkan event listener untuk event submit
	form.addEventListener('submit', function (event) {
		// Hentikan pengiriman formulir default
		event.preventDefault();

		// Tampilkan SweetAlert konfirmasi
		Swal.fire({
			title: 'Konfirmasi',
			text: 'Apakah Anda yakin ingin menambahkan data pengiriman barang ini?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Batal'
		}).then((result) => {
			// Jika pengguna mengonfirmasi, kirimkan formulir
			if (result.isConfirmed) {
				form.submit();
				Swal.fire({
					title: 'Sukses!',
					text: 'Berhasil menambahkan data pengiriman barang ini.',
					icon: 'success',
					showConfirmButton: false,
					timer: 1500
				})
			} else {
				Swal.fire({
					title: 'Gagal!',
					text: 'Gagal menambahkan data pengiriman barang ini.',
					icon: 'error'
				})
			}
		});
	});
});