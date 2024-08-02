<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">Barang</a> / Tambah Barang
                </h5>
                <h1 class="h3 mb-3"><b>Tambah Barang</b></h1>
                    <div class="row">
                        <div class="col-12">
                        <form id="addBarang" action="<?= base_url('/barang/add') ?>" method="post">
                            <div class="card">
                            <div class="card-body">
                                <!-- Inputan Nama Barang -->
                                <h5 class="card-title">Nama Barang</h5>
                                <input
                                type="text"
                                class="form-control"
                                id="nama_produk" name="nama_produk"
                                placeholder="Masukkan Nama Barang"
                                required/>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Box -->
                                        <h5 class="card-title mt-2">Box</h5>
                                        <select id="id_box" name="id_box" class="form-control">
                                            <option selected>Pilih Jenis User</option>
                                            <?php foreach ($boxs as $box): ?>
                                                <option value="<?= esc($box['id_box']); ?>">
                                                    <?= esc($box['id_box']); ?> - <?= esc($box['tipe_box']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Klasifikasi Material -->
                                        <h5 class="card-title mt-2">Klasifikasi Material</h5>
                                        <select class="form-control" id="klasifikasi_material" name="klasifikasi_material" required>
                                            <option value="">Pilih Klasifikasi Material</option>
                                            <?php foreach ($klasifikasi_material_options as $option): ?>
                                                <option value="<?= htmlspecialchars($option); ?>"><?= htmlspecialchars($option); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Merk -->
                                        <h5 class="card-title mt-2">Merk</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="merk" name="merk"
                                        placeholder="Masukkan Merk Barang"
                                        required/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Jenis/Tipe -->
                                        <h5 class="card-title mt-2">Jenis/Tipe</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="jenis_tipe" name="jenis_tipe"
                                        placeholder="Masukkan Jenis/Tipe Barang"
                                        required/>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Serial Number -->
                                        <h5 class="card-title mt-2">Serial Number</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="serial_number" name="serial_number"
                                        placeholder="Masukkan Serial Number"
                                        required/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Kode Material SAP -->
                                        <h5 class="card-title mt-2">Kode Material SAP</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="kode_material_sap" name="kode_material_sap"
                                        placeholder="Masukkan Kode Material SAP"
                                        required/>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Jumlah Barang -->
                                        <h5 class="card-title mt-2">Jumlah Barang</h5>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="jumlah" name="jumlah"
                                        placeholder="Masukkan Jumlah Barang"
                                        required/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Satuan Barang -->
                                        <h5 class="card-title mt-2">Satuan Barang</h5>
                                        <select class="form-control" id="satuan" name="satuan" required>
                                            <option value="">Pilih Satuan Barang</option>
                                            <?php foreach ($satuan_barang_options as $option): ?>
                                                <option value="<?= htmlspecialchars($option); ?>"><?= htmlspecialchars($option); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                        <!-- Inputan Harga Satuan -->
                                        <h5 class="card-title mt-2">Harga Satuan</h5>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="harga_satuan" name="harga_satuan"
                                        placeholder="Masukkan Harga Satuan"
                                        required/>
                                </div>

                                <div class="row mt-1">
                                <h5 class="card-title mt-2">Dimensi Barang</h5>
                                    <div class="col-md-4">
                                        <!-- Inputan Panjang Barang -->
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="panjang" name="panjang"
                                        placeholder="Masukkan Panjang Barang (cm)"
                                        required/>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Inputan Lebar Barang -->
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="lebar" name="lebar"
                                        placeholder="Masukkan Lebar Barang (cm)"
                                        required/>
                                    </div>
                                    <div class="col-md-4">
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="tinggi" name="tinggi"
                                        placeholder="Masukkan Tinggi Barang (cm)"
                                        required/>
                                    </div>
                                </div>

                                <!-- Button Submit -->
                                <div
                                style="
                                    position: relative;
                                    text-align: right;
                                    margin-top: 20px;
                                ">
                                <a href="#"
                                    type="button"
                                    onclick="history.back()"
                                    class="btn btn-info">
                                    Cancel
                                </a>
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    id="submitButton">
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
<script src="<?= base_url('js/barang/add.js') ?>"></script>