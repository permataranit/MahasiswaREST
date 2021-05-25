<div class="container">

	<div class="row mt-3">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				Form Edit Data Mahasiswa
			</div>

			<div class="card-body">
				<form action="" method="post">
			        <div class="form-group">
					   <label for="nama">Nama</label>
					   <input type="text" class="form-control" value="<?= $mahasiswa['nama']; ?>" id="nama" name="nama">
					   <small class="form-text text-danger"><?= form_error('nama'); ?></small>
					</div>

					<div class="form-group">
					   <label for="nim">NIM</label>
					   <input type="text" class="form-control" value="<?= $mahasiswa['NIM']; ?>" id="nim" name="nim" readonly>
					   <small class="form-text text-danger"><?= form_error('nim'); ?></small>
					</div>


					<div class="form-group">
					   <label for="email">Email</label>
					   <input type="text" class="form-control" value="<?= $mahasiswa['email']; ?>" id="email" name="email" readonly>
					   <small class="form-text text-danger"><?= form_error('email'); ?></small>
					</div>


					<div class="form-group">
					   <label for="phone">Telp</label>
					   <input type="text" class="form-control" value="<?= $mahasiswa['no_telp']; ?>" id="phone" name="phone">
					   <small class="form-text text-danger"><?= form_error('phone'); ?></small>
					</div>

					<div class="form-group">
					   <label for="alamat">Alamat</label>
					   <textarea rows="2" class="form-control" id="alamat" name="alamat"><?= $mahasiswa['alamat']; ?></textarea>
					   <small class="form-text text-danger"><?= form_error('alamat'); ?></small>
					</div>

					<button type="submit" name="tambah" class="btn btn-primary float-right">Edit Data</button>
				</form>
			</div> <!-- end of card body -->
		</div> <!-- end of card -->

	</div>
	</div>

</div>