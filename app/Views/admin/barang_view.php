<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">Barang</a> / Barang View
                </h5>
                <h1 class="h3 mb-3"><b>Barang View</b></h1>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex justify-content-start">
                        <a href="<?= base_url('/dashboard/barang/add') ?>"
                            type="button"
                            class="btn btn-info me-2">
                            <i class="align-middle" data-feather="list"></i>
                            Tambah Barang
                        </a>
                        </div>
                    </div>
                        <div class="row justify-content-center">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <div class="row no-gutters" style="height: 40px">
                                    <h1 class="h3 mt-2">Tabel Barang</h1>
                                </div>

                                <hr />
                                <div class="table-container">
                                    <table id="example"
                                    class="table table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <tr style="text-align: center; vertical-align: middle">
                                            <th hidden></th>
                                            <th>Nama Produk</th>
                                            <th>Nomor Box</th>
                                            <th>Merk</th>
                                            <th>Jenis/Tipe</th>
											<th>Serial Number</th>
											<th>Kode Material SAP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <!-- Fetch Data Start -->
                                    <tbody>
                                        <?php foreach ($barangs as $barang): ?>
                                            <tr>
                                                <td hidden></td>
                                                <td>
                                                    <?= $barang['nama_produk'] ?>
                                                </td>
                                                <td>
                                                    <?= $barang['id_box'] ?>
                                                </td>
                                                <td>
                                                    <?= $barang['merk'] ?>
                                                </td>
												<td>
                                                    <?= $barang['jenis_tipe'] ?>
                                                </td>
												<td>
                                                    <?= $barang['serial_number'] ?>
                                                </td>
												<td>
                                                    <?= $barang['kode_material_sap'] ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('/dashboard/barang/detail/' . $barang['id_produk']) ?>" class="btn btn-info">Detail</a>
                                                    <a href="<?= base_url('/dashboard/barang/update/' . $barang['id_produk']) ?>" class="btn btn-warning">Edit</a>
                                                    <a href="<?= base_url('barang/delete/' . $barang['id_produk']) ?>" class="btn btn-danger" onclick="return confirmDelete(event)">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <!-- Fetch Data End -->
                                    
                                    </table>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                    <div class="pagination">
                                        <button
                                        id="prevPageBtn"
                                        class="btn btn-primary">
                                        Previous
                                        </button>
                                        <span id="currentPage" class="mx-2">Halaman 1</span>
                                        <button
                                        id="nextPageBtn"
                                        class="btn btn-primary">
                                        Next
                                        </button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>
            </main>

<?= $this->include('content/footer') ?>
<script src="<?= base_url('js/barang/delete.js') ?>"></script>