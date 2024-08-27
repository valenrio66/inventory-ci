document.addEventListener('DOMContentLoaded', function() {

    // Ambil elemen input status
    var statusElement = document.getElementById('status');

    // Seleksi elemen yang akan disembunyikan
    var trackingNext = document.getElementById('tracking');

    // Cek apakah nilai dari input status adalah 'Approved'
    if (statusElement.value === 'Approved') {
        // Sembunyikan inputan status tracking selanjutnya
        trackingNext.closest('.col-md-6').style.display = 'none';
    }

    // Tangkap formulir
    const form = document.querySelector('#updatePengirimanBarang');

    // Tambahkan event listener untuk event submit
    form.addEventListener('submit', function(event) {
        // Hentikan pengiriman formulir default
        event.preventDefault();

        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengubah status tracking ini?',
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
                    text: 'Berhasil mengubah status tracking ini.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Gagal mengubah status tracking ini.',
                    icon: 'error'
                })
            }
        });
    });
});