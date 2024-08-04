<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">Gudang</a> / Edit Gudang
                </h5>
                <h1 class="h3 mb-3"><b>Edit Gudang</b></h1>
                    <div class="row">
                        <div class="col-12">
                        <form id="updateGudang" action="<?= base_url('/gudang/update/' . $gudangs['id_gudang']) ?>" method="post">
                            <div class="card">
                            <div class="card-body">
                                <!-- Inputan Nama Gudang -->
                                <h5 class="card-title">Nama Gudang</h5>
                                <input
                                type="text"
                                class="form-control"
                                id="nama_gudang" name="nama_gudang"
                                value="<?= esc($gudangs['nama_gudang']) ?>"
                                required/>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Pilih Level -->
                                        <h5 class="card-title mt-2">Pilih Level</h5>
                                        <select class="form-control" id="level" name="level" required>
                                            <option value="">Pilih Level Gudang</option>
                                            <?php foreach ($level_options as $option): ?>
                                                <option value="<?= htmlspecialchars($option); ?>"><?= htmlspecialchars($option); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Pilih Kepala Gudang -->
                                        <h5 class="card-title mt-2">Pilih Kepala Gudang</h5>
                                        <select id="id_kepala" name="id_kepala" class="form-control">
                                            <option selected>Pilih Kepala Gudang</option>
                                            <?php foreach ($users as $user): ?>
                                                <option value="<?= esc($user['id_user']); ?>">
                                                    <?= esc($user['nama']); ?> (<?= esc($user['role']); ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                            <!-- Inputan Nomor Handphone -->
                                            <h5 class="card-title mt-2">Nomor Handphone</h5>
                                            <input
                                            type="text"
                                            class="form-control"
                                            id="no_hp" name="no_hp"
                                            value="<?= esc($gudangs['no_hp']) ?>"
                                            required/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Kapasitas -->
                                        <h5 class="card-title mt-2">Kapasitas</h5>
                                        <input
                                        type="number"
                                        class="form-control"
                                        id="kapasitas" name="kapasitas"
                                        value="<?= esc($gudangs['kapasitas']) ?>"
                                        required/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Inputan Alamat -->
                                    <h5 class="card-title mt-2">Alamat</h5>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="alamat" name="alamat"
                                        value="<?= esc($gudangs['alamat']) ?>"
                                        required/>
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
<script src="<?= base_url('js/gudang/update.js') ?>"></script>