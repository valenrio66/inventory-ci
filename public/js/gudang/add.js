document.addEventListener('DOMContentLoaded', function () {
	const form = document.querySelector('#addGudang');
	const levelSelect = document.querySelector('#level');
	const kepalaSelect = document.querySelector('#id_kepala');
	const hpInput = document.querySelector('#no_hp');

	// Disable the phone number input field initially
	hpInput.disabled = true;

	// Function to populate kepala gudang dropdown
	function populateKepalaGudang(options) {
		kepalaSelect.innerHTML = '<option value="">Pilih Kepala Gudang</option>';
		options.forEach(user => {
			let option = new Option(user.nama + ' (' + user.role + ')', user.id_user);
			option.dataset.hp = user.no_hp;
			kepalaSelect.appendChild(option);
		});
	}

	levelSelect.addEventListener('change', function () {
		const kepalaPusat = JSON.parse(this.getAttribute('data-kepala-pusat'));
		const kepalaBagian = JSON.parse(this.getAttribute('data-kepala-bagian'));
		let selectedOptions = this.value === 'Pusat' ? kepalaPusat : kepalaBagian;

		populateKepalaGudang(selectedOptions);
	});

	kepalaSelect.addEventListener('change', function () {
		if (this.value) {
			const selectedOption = this.options[this.selectedIndex];
			hpInput.value = selectedOption.dataset.hp;
		} else {
			hpInput.value = '';
		}
		// Ensure the phone number field remains disabled
		hpInput.disabled = true;
	});

	form.addEventListener('submit', function (event) {
		// Hentikan pengiriman formulir default
		event.preventDefault();

		// Tampilkan SweetAlert konfirmasi
		Swal.fire({
			title: 'Konfirmasi',
			text: 'Apakah Anda yakin ingin menambahkan data gudang ini?',
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
					text: 'Berhasil menambahkan data gudang ini.',
					icon: 'success',
					showConfirmButton: false,
					timer: 1500
				})
			} else {
				Swal.fire({
					title: 'Gagal!',
					text: 'Gagal menambahkan data gudang ini.',
					icon: 'error'
				})
			}
		});
	});
});