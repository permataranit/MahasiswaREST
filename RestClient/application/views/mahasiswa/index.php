<div class="container">

	<?php if( $this->session->flashdata('flash') ) : ?>
	<div class="row mt-3">
		<div class="col-md-6">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="row mt-3">
		<div class="col-md-6">
			<!-- Button Tambah -->
			<a type="button" class="btn btn-primary" href="<?= base_url(); ?>mahasiswa/tambah">
			  Tambah Data Mahasiswa
			</a>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-6">
			<!-- Form Cari Mahasiswa Berdasarkan Nama-->
			<form action="" method="post">
				<div class="input-group mb-3">
				  <input type="text" class="form-control" id="keyword" name="keyword" autocomplete="off" placeholder="Masukkan nama mahasiswa">
				  <div class="input-group-append">
				    <button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
				  </div>
				</div>
			</form>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-6">
			<h3>Daftar Mahasiswa</h3>
			<?php if( empty($mahasiswa) ) : ?>
					<h4 class="text-center mt-3"> Mahasiswa tidak ditemukan </h4>
			<?php endif; ?>
			<ul class="list-group">
				<?php foreach ( $mahasiswa as $mhs ) : ?>
					<li class="list-group-item">
						<?= $mhs['nama']; ?>
						<a href="<?= base_url(); ?>mahasiswa/hapus/<?= $mhs['NIM']; ?>" class="badge badge-danger float-right ml-1" onclick="return confirm('Anda yakin ingin menghapus?');">Hapus</a>
						<a href="<?= base_url(); ?>mahasiswa/edit/<?= $mhs['NIM']; ?>" class="badge badge-success float-right ml-1">Edit</a>
						<a href="<?= base_url(); ?>mahasiswa/detail/<?= $mhs['NIM']; ?>" class="badge badge-primary float-right ml-1">Detail</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

</div>