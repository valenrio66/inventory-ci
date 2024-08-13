<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">User</a> / Tambah User
		</h5>
		<h1 class="h3 mb-3"><b>Tambah User</b></h1>
		<div class="row">
			<div class="col-12">
				<form action="<?= base_url('/user/create') ?>" method="post">
					<div class="card">
						<div class="card-body">
							<!-- Inputan Nama Lengkap -->
							<h5 class="card-title">Nama Lengkap</h5>
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required />

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Username -->
									<h5 class="card-title mt-2">Username</h5>
									<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required />
								</div>
								<div class="col-md-6">
									<!-- Inputan Password -->
									<h5 class="card-title mt-2">Password</h5>
									<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required />
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Email -->
									<h5 class="card-title mt-2">Email</h5>
									<input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required />
								</div>
								<div class="col-md-6">
									<!-- Inputan Role -->
									<h5 class="card-title mt-2">Role User</h5>
									<select id="role" name="role" class="form-control">
										<option selected>Pilih Role User</option>
										<option value="Admin">Admin</option>
										<option value="Gudang Bagian">Gudang Bagian</option>
										<option value="Gudang Pusat">Gudang Pusat</option>
									</select>
								</div>
							</div>

                            <div class="row mt-1">
								<div class="col-md-6">
                                    <!-- Inputan Nomor Handphone -->
                                    <h5 class="card-title mt-2">Nomor Handphone</h5>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Handphone" required />
                                </div>
                                <!-- <div class="col-md-6">
                                    <h5 class="card-title mt-2">Status</h5>
                                    <input type="text" class="form-control" id="status" name="status" value="Tidak Ada Status" disabled />
                                </div> -->
                            </div> 

							<!-- Button Submit -->
							<div style="
                                    position: relative;
                                    text-align: right;
                                    margin-top: 20px;
                                ">
								<a href="#" type="button" onclick="history.back()" class="btn btn-info">
									Kembali
								</a>
								<button type="submit" class="btn btn-primary" id="submitButton">
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
<script src="<?= base_url('js/user/add.js') ?>"></script>