<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">Barang</a> / Edit Barang
                </h5>
                <h1 class="h3 mb-3"><b>Edit Barang</b></h1>
                    <div class="row">
                        <div class="col-12">
                        <form id="updateBarang" action="<?= base_url('/barang/update/' . $barangs['id_produk']) ?>" method="post">
                            <div class="card">
                            <div class="card-body">
                                <!-- Inputan Nama Barang -->
                                <h5 class="card-title">Nama Barang</h5>
                                <input
                                type="text"
                                class="form-control"
                                id="nama_produk" name="nama_produk"
                                value="<?= esc($barangs['nama_produk']) ?>"
                                disabled/>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Box -->
                                        <h5 class="card-title mt-2">Box</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="id_box" name="id_box"
                                        value="<?= esc($barangs['id_box']) ?>"
                                        disabled/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Klasifikasi Material -->
                                        <h5 class="card-title mt-2">Klasifikasi Material</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="klasifikasi_material" name="klasifikasi_material"
                                        value="<?= esc($barangs['klasifikasi_material']) ?>"
                                        disabled/>
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
                                        value="<?= esc($barangs['merk']) ?>"
                                        disabled/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Jenis/Tipe -->
                                        <h5 class="card-title mt-2">Jenis/Tipe</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="jenis_tipe" name="jenis_tipe"
                                        value="<?= esc($barangs['jenis_tipe']) ?>"
                                        disabled/>
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
                                        value="<?= esc($barangs['serial_number']) ?>"
                                        disabled/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Kode Material SAP -->
                                        <h5 class="card-title mt-2">Kode Material SAP</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="kode_material_sap" name="kode_material_sap"
                                        value="<?= esc($barangs['kode_material_sap']) ?>"
                                        disabled/>
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
                                        value="<?= esc($barangs['jumlah']) ?>"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Satuan Barang -->
                                        <h5 class="card-title mt-2">Satuan Barang</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="nama_produk" name="nama_produk"
                                        value="<?= esc($barangs['satuan']) ?>"
                                        disabled />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                        <!-- Inputan Harga Satuan -->
                                        <h5 class="card-title mt-2">Harga Satuan</h5>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="harga_satuan" name="harga_satuan"
                                        value="<?= esc($barangs['harga_satuan']) ?>"
                                        />
                                </div>

                                <div class="col-md-12">
                                        <!-- Inputan Dimensi Barang -->
                                        <h5 class="card-title mt-2">Dimensi Barang</h5>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="dimensi_barang" name="dimensi_barang"
                                        value="<?= esc($barangs['dimensi_barang']) ?>"
                                        />
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
                                    Kembali
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
<script src="<?= base_url('js/barang/update.js') ?>"></script>