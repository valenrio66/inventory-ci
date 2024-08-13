<!-- Content Login Start -->
<?= $this->include('auth/header-login') ?>

<main class="d-flex w-100">
	<div class="container d-flex flex-column">
		<div class="row vh-100">
			<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
				<div class="d-table-cell align-middle">

					<div class="text-center mt-4">
						<h1 class="h2">Selamat Datang!</h1>
                        <img src="<?= base_url('img/icon_gudang.png') ?>" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
						<p class="lead">
							Sistem Pergudangan <b>(LOGIWARE)</b>
						</p>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="m-sm-3">
								<form action="#" method="post">
                                    <div class="mb-3">
										<label class="form-label">Nama Lengkap</label>
										<input class="form-control form-control-lg" type="text" id="nama_user" name="nama_user" placeholder="Masukkan Nama Lengkap" />
									</div>
                                    <div class="mb-3">
										<label class="form-label">Username</label>
										<input class="form-control form-control-lg" type="text" id="username" name="username" placeholder="Masukkan Username" />
									</div>
									<div class="mb-3">
										<label class="form-label">Password</label>
										<input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Masukkan Password" />
									</div>
                                    <div class="mb-3">
										<label class="form-label">Email</label>
										<input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Masukkan Email" />
									</div>
                                    <div class="mb-3">
										<label class="form-label">Pilih Role</label>
										<select id="role" name="role" class="form-control">
                                            <option selected>Pilih Role User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Gudang Bagian">Gudang Bagian</option>
                                            <option value="Gudang Pusat">Gudang Pusat</option>
                                        </select>
									</div>
									<div class="d-grid gap-2 mt-5">
										<button type="submit" class="btn btn-lg" style="background-color: orange; color: white;">Buat Akun</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="text-center mb-3">
						Sudah Punya Akun? <a href="#" style="color: orange;"><b>Login</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?= $this->include('auth/footer-login') ?>
<!-- Content Login End -->