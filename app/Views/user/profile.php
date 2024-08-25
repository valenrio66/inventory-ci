<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

<main class="content">
	<div class="container-fluid p-0">
		<h5 class="right-aligned" style="float: right">
			<a href="#">Home</a> / <a href="#">User</a> / Profil User
		</h5>
		<h1 class="h3 mb-3"><b>Profil User</b></h1>
		<div class="row">
			<div class="col-12">
				<form>
					<div class="card">
						<div class="card-body">
							<!-- Inputan Nama Lengkap -->
							<h5 class="card-title">Nama Lengkap</h5>
							<input type="text" class="form-control" id="nama" name="nama" value="<?= esc($users['nama']) ?>" disabled />

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Username -->
									<h5 class="card-title mt-2">Username</h5>
									<input type="text" class="form-control" id="username" name="username" value="<?= esc($users['username']) ?>" disabled />
								</div>
                                <div class="col-md-6">
                                    <!-- Inputan Nomor Handphone -->
                                    <h5 class="card-title mt-2">Nomor Handphone</h5>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= esc($users['no_hp']) ?>" disabled />
                                </div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<!-- Inputan Email -->
									<h5 class="card-title mt-2">Email</h5>
									<input type="email" class="form-control" id="email" name="email" value="<?= esc($users['email']) ?>" disabled />
								</div>
								<div class="col-md-6">
									<!-- Inputan Role -->
									<h5 class="card-title mt-2">Role User</h5>
									<input type="email" class="form-control" id="role" name="role" value="<?= esc($users['role']) ?>" disabled />
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

<?= $this->include('content/footer') ?>