<?php include 'global_fungsi.php';

// Jika sudah login, arahkan ke dashboard
if (sudah_login() && (strpos($_SESSION['a2_hak_akses'], '003')!==FALSE || $_SESSION['a2_hak_akses']=="*")) {
	// Tambahkan header
	include 'global_header.php';
	?>
	<div class="container">
		<div class="row">
			<?php // Tampilkan informasi jika ada!
			if (isset($_SESSION["informasi"])) {
				echo "<div class='alert alert-info'>".$_SESSION["informasi"]."</div>";
				unset($_SESSION["informasi"]);
			}
			?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
				<div class="panel panel-default">
					<div class="panel-body">
						<legend>Tambah Anggota</legend>
						<form action="proses.php" method="post" enctype="multipart/form-data">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#basic_info" aria-controls="basic_info" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-user"></i> Info Dasar</a>
								</li>
								<li role="presentation">
									<a href="#family_info" aria-controls="family_info" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-home"></i> Keluarga</a>
								</li>
								<li role="presentation">
									<a href="#parent_info" aria-controls="parent_info" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-tree-conifer"></i> Orang Tua</a>
								</li>
								<li role="presentation">
									<a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-phone"></i> Kontak</a>
								</li>
								<li role="presentation">
									<a href="#academic_info" aria-controls="academic_info" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-briefcase"></i> Akademik</a>
								</li>
								<li role="presentation">
									<a href="#account_info" aria-controls="account_info" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-wrench"></i> Akun</a>
								</li>
							</ul>
							<!-- // End nav tabs -->

							<!-- Tab panes -->
							<div class="tab-content">
								<!-- Informasi Dasar -->
								<div role="tabpanel" class="tab-pane active" id="basic_info">
									<div class="container">
										<div class="col-sm-10 form-horizontal">
											<br>
											<!-- Nama Lengkap -->
											<div class="form-group">
												<input type="hidden" name="aksi" id="aksi" value="tambah_anggota">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Nama lengkap
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="nama_lengkap" id="nama_lengkap" required class="form-control" placeholder="Nama lengkap" onchange="auto_nickname(this.value)">
												</div>
											</div>
											<!-- Nama Panggilan -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Nama panggilan
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="nama_panggilan" id="nama_panggilan" required class="form-control" placeholder="Nama panggilan" onchange="auto_username(this.value)" onkeyup="cek_nama_panggilan(this.value)">
													<p class="form-control-static text-danger" id="info_nama_panggilan"></p>
													<p class="form-control-static" id="saran_nama_panggilan"></p>
													<span class="help-block">Nama panggilan harus diisi dan harus unik karena akan digunakan sebagai username untuk dapat masuk ke dalam sistem ini.</span>
												</div>
											</div>
											<!-- Jenis Kelamin -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Jenis Kelamin
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<label class="radio">
														<input type="radio" data-toggle="radio" name="jenis_kelamin" id="jenis_kelamin1" value="laki-laki" data-radiocheck-toggle="radio" checked="" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
														Laki-laki
													</label>
													<label class="radio">
														<input type="radio" data-toggle="radio" name="jenis_kelamin" id="jenis_kelamin2" value="perempuan" data-radiocheck-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
														Perempuan
													</label>
												</div>
											</div>
											<!-- Tempat Lahir -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Tempat Lahir
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<select data-toggle="select" name="tempat_lahir" id="tempat_lahir" class="form-control select select-primary mrs mbm">
														<option value="">- Pilih Kota -</option>
														<?php 
															// Ambil data kota dari tabel master kota
															$daftar_kota = ambil_data_global("aluni_m_kota", "id_provinsi, id_kota, nama_kota", "aktif = 'ya'", "id_provinsi ASC");
															$select_kota = "";
															foreach ($daftar_kota as $dkota) {
																$select_kota .= "<option value='$dkota[nama_kota]'>$dkota[nama_kota]</option>";
															}
															echo $select_kota;
														?>
													</select>
													<script type="text/javascript">
														$(document).ready(function() {
															$('select[name="tempat_lahir"]').select2({dropdownCssClass: 'show-select-search'});
														});
													</script>
												</div>
											</div>
											<!-- Tanggal Lahir -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Tanggal Lahir
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<div class="input-group">
														<input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control datepicker" placeholder="Tanggal Lahir">
														<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
													</div>
												</div>
											</div>
											<!-- Agama -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Tanggal Lahir
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<select data-toggle="select" name="agama" id="agama" class="form-control select select-primary mrs mbm">
														<option value="">- Pilih Agama -</option>
														<?php 
															// Ambil data kota dari tabel master kota
															$daftar_agama = ambil_data_global("aluni_m_agama", "id_agama, nama_agama", "aktif = 'ya'");
															$select_agama = "";
															foreach ($daftar_agama as $dagama) {
																$select_agama .= "<option value='$dagama[id_agama]'>$dagama[nama_agama]</option>";
															}
															echo $select_agama;
														?>
													</select>
													<script type="text/javascript">
														$(document).ready(function() {
															$('select[name="agama"]').select2({dropdownCssClass: 'show-select-search'});
														});
													</script>
												</div>
											</div>
											<!-- Foto -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Foto
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="file" name="foto" id="foto" class="form-control">
													<span class="help-block">Format harus jpg, png atau gif. Maksimal ukuran 2 Mb.</span>
												</div>
											</div>
											<!-- Aktif -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Aktif
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<label class="radio">
														<input type="radio" data-toggle="radio" name="aktif" id="aktif1" value="ya" data-radiocheck-toggle="radio" checked="" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
														Ya
													</label>
													<label class="radio">
														<input type="radio" data-toggle="radio" name="aktif" id="aktif2" value="tidak" data-radiocheck-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
														Tidak
													</label>
												</div>
											</div>
											<hr>
											<!-- Alamat Provinsi Tinggal -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Provinsi Tinggal
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<select data-toggle="select" name="id_provinsi" id="id_provinsi" class="form-control select select-primary mrs mbm" onchange="ajax_kota(this.value, 'id_kota', 'kolom_kota')">
														<option value="">- Pilih Provinsi -</option>
														<?php 
															// Ambil data kota dari tabel master kota
															$daftar_provinsi = ambil_data_global("aluni_m_provinsi", "id_provinsi, nama_provinsi", "aktif = 'ya'");
															$select_provinsi = "";
															foreach ($daftar_provinsi as $dprovinsi) {
																$select_provinsi .= "<option value='$dprovinsi[id_provinsi]'>$dprovinsi[nama_provinsi]</option>";
															}
															echo $select_provinsi;
														?>
													</select>
													<script type="text/javascript">
														$(document).ready(function() {
															$('select[name="id_provinsi"]').select2({dropdownCssClass: 'show-select-search'});
														});
													</script>
												</div>
											</div>
											<!-- Alamat Kota Tinggal -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Kota Tinggal
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4" id="kolom_kota">
													<input type='hidden' name='id_kota' id='id_kota' value=''>
												</div>
											</div>
											<!-- Alamat -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Alamat
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<textarea name="alamat" id="alamat" class="form-control"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Informasi Keluarga -->
								<div role="tabpanel" class="tab-pane" id="family_info">
									<div class="container">
										<div class="col-sm-10 form-horizontal">
											<br>
											<!-- Nama Pasangan -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Nama Suami / Istri
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="nama_pasangan" id="nama_pasangan" class="form-control" placeholder="Nama Pasangan">
												</div>
											</div>
											<!-- Nama Anak -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Nama Anak
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<div class="input-group">
														<input type="text" name="nama_anak[]" class="form-control" placeholder="Nama Anak">
														<span class="input-group-btn">
															<button type="button" name="tambah_nama_anak" id="tambah_nama_anak" class="btn btn-default">Tambah</button>
														</span>
													</div>
													<p></p>
													<div id="kolom_nama_anak"></div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Informasi Orang Tua -->
								<div role="tabpanel" class="tab-pane" id="parent_info">
									<div class="container">
										<div class="col-sm-10 form-horizontal">
											<br>
											<!-- Nama Ayah -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Nama Ayah
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Nama Ayah">
												</div>
											</div>
											<!-- Nama Ibu -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Nama Ibu
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="nama_ibu" id="nama_ibu" class="form-control" placeholder="Nama Ibu">
												</div>
											</div>
											<!-- Nama Wali -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Nama Wali
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="nama_wali" id="nama_wali" class="form-control" placeholder="Nama Wali (Optional)">
												</div>
											</div>
											<hr>
											<!-- Alamat Provinsi Tinggal Orang Tua -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Provinsi Tinggal
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<select data-toggle="select" name="id_provinsi_ot" id="id_provinsi_ot" class="form-control select select-primary mrs mbm" onchange="ajax_kota(this.value, 'id_kota_ot', 'kolom_kota_ot')">
														<option value="">- Pilih Provinsi -</option>
														<?php 
															// Ambil data kota dari tabel master kota
															$daftar_provinsi = ambil_data_global("aluni_m_provinsi", "id_provinsi, nama_provinsi", "aktif = 'ya'");
															$select_provinsi = "";
															foreach ($daftar_provinsi as $dprovinsi) {
																$select_provinsi .= "<option value='$dprovinsi[id_provinsi]'>$dprovinsi[nama_provinsi]</option>";
															}
															echo $select_provinsi;
														?>
													</select>
													<script type="text/javascript">
														$(document).ready(function() {
															$('select[name="id_provinsi_ot"]').select2({dropdownCssClass: 'show-select-search'});
														});
													</script>
												</div>
											</div>
											<!-- Alamat Kota Tinggal Orang Tua -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Kota Tinggal
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4" id="kolom_kota_ot">
													<input type='hidden' name='id_kota_ot' id='id_kota_ot' value=''>
												</div>
											</div>
											<!-- Alamat Orang Tua -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Alamat
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<textarea name="alamat_ot" id="alamat_ot" class="form-control"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Informasi Kontak -->
								<div role="tabpanel" class="tab-pane" id="contact_info">
									<div class="container">
										<div class="col-sm-10 form-horizontal">
											<br>
											<!-- No Rumah -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													No Rumah
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<div class="row">
														<div class="col-lg-3 col-md-3 col-sm-3">
															<input type="text" name="no_rumah_ext" id="no_rumah_ext" class="form-control" placeholder="Kode" onfocus="input_nomor(this.id)">
														</div>
														<div class="col-lg-9 col-md-9 col-sm-9">
															<input type="text" name="no_rumah" id="no_rumah" class="form-control" placeholder="No Rumah" onfocus="input_nomor(this.id)">
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12">
															<span class="help-block">Pisahkan kode wilayah dengan no telepon rumah.</span>
														</div>
													</div>
												</div>
											</div>
											<!-- No Handphone -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													No Handphone
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="no_handphone" id="no_handphone" class="form-control" placeholder="No Handphone" onfocus="input_nomor(this.id)">
												</div>
											</div>
											<!-- No Handphone 2 -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													No Handphone 2
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="no_handphone2" id="no_handphone2" class="form-control" placeholder="No Handphone 2" onfocus="input_nomor(this.id)">
												</div>
											</div>
											<!-- PIN Blackberry -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Pin Blackberry
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<input type="text" name="pin_blackberry" id="pin_blackberry" class="form-control" placeholder="Pin Blackberry">
												</div>
											</div>
											<hr>
											<!-- Email -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Email
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="alamat_email" id="alamat_email" class="form-control" placeholder="Email">
												</div>
											</div>
											<!-- Website -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Website
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="alamat_website" id="alamat_website" class="form-control" placeholder="Website">
												</div>
											</div>
											<!-- Facebook -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Facebook
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="facebook" id="facebook" class="form-control" placeholder="Facebook URL">
													<span class="help-block">example : http://facebook.com/aluni_v2</span>
												</div>
											</div>
											<!-- Twitter -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Twitter
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<input type="text" name="twitter" id="twitter" class="form-control" placeholder="Twitter (@nama_anda)">
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Informasi Akademik -->
								<div role="tabpanel" class="tab-pane" id="academic_info">
									<div class="container">
										<div class="col-sm-10 form-horizontal">
											<br>
											<!-- Angkatan -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Angkatan
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<input type="text" name="angkatan" id="angkatan" class="form-control" placeholder="Angkatan (contoh : 12)">
												</div>
											</div>
											<!-- Tahun Masuk -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Tahun Masuk
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<input type="text" name="tahun_masuk" id="tahun_masuk" class="form-control" placeholder="Tahun Masuk (contoh : 1990)" onfocus="input_nomor(this.id)">
												</div>
											</div>
											<!-- Tahun Lulus -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Tahun Lulus
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<input type="text" name="tahun_keluar" id="tahun_keluar" class="form-control" placeholder="Tahun Lulus (contoh : 1996)" onfocus="input_nomor(this.id)">
												</div>
											</div>
											<!-- Kelas Terakhir -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Kelas Terakhir
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<input type="text" name="kelas_terakhir" id="kelas_terakhir" class="form-control" placeholder="Kelas Terakhir">
												</div>
											</div>
											<hr>
											<!-- Catatan Tambahan -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Catatan
												</label>
												<div class="col-lg-8 col-md-8 col-sm-6">
													<textarea name="catatan" id="catatan" class="form-control"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Informasi Akun -->
								<div role="tabpanel" class="tab-pane" id="account_info">
									<div class="container">
										<div class="col-sm-10 form-horizontal">
											<br>
											<!-- Username -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Username
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<p id="username_view" class="form-control-static"></p>
													<input type="hidden" name="username" id="username" value="">
												</div>
											</div>
											<!-- Password -->
											<div class="form-group">
												<label class="col-lg-3 col-md-3 col-sm-5 control-label">
													Password
												</label>
												<div class="col-lg-5 col-md-5 col-sm-4">
													<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo substr(hash("SHA256", rand()), 0, 8); ?>">
													<span class="help-block"><label class="checkbox" for="show_password"><input type="checkbox" data-toggle="checkbox" value="" id="show_password" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Tampilkan password</label></span>
													<span class="help-block">Password diatas adalah hasil pembuatan otomatis, anda masih dapat mengubah password tersebut.</span>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- // End of Tab panes -->

							<!-- Tombol simpan -->
							<div class="well text-center">
								<button type="submit" class="btn btn-primary btn-lg" id="proses_simpan">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function() {
		// Aksi jika tambah kolom nama anak di klik
		var i = 0;
		$("#tambah_nama_anak").on('click', function(event) {
			i++;
			event.preventDefault();
			$("<div id='remove_"+i+"'><div class='input-group'><input type='text' name='nama_anak[]' class='form-control' placeholder='Nama Anak'><span class='input-group-btn'><button type='button' class='btn btn-default' onclick=\"hapus_nama_anak('"+i+"')\">Hapus</button></span></div><p></p></div>").appendTo($("#kolom_nama_anak"));
		});

	});

	// Aksi jika tombol hapus kolom anak di klik
	function hapus_nama_anak (i) {
		$('#remove_'+i).fadeOut('slow', function() {
			$('#remove_'+i).remove();
		});
	}

	// Validasi input nomor
	function input_nomor (idnya) {
		if (idnya!="") {
			$("#"+idnya).keypress(function (e) {
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					return false;
				}
			});
		};
	}

	// Aksi jika provinsi di info dasar di ubah
	function ajax_kota (id_provinsi, nama_input, target_hasil) {
		if (id_provinsi!="") {
			$.ajax({
				url: 'proses.php',
				type: 'POST',
				dataType: 'html',
				data: {aksi: 'ajax_kota', nama_input: nama_input, id_provinsi: id_provinsi},
			})
			.done(function(hasil) {
				$("#"+target_hasil).html(hasil);
				$('select[name="'+nama_input+'"]').select2({dropdownCssClass: 'show-select-search'});
			})
			.fail(function(hasil) {
				console.log("error "+hasil);
			});
		}
		else {
			$("#"+target_hasil).html("<input type='hidden' name='"+target_hasil+"' id='"+target_hasil+"' value=''>");
		}
	}

	// Aksi setelah kolom nama panggilan diubah
	function cek_nama_panggilan (nama_panggilan) {
		if (nama_panggilan!="") {
			$.ajax({
				url: 'proses.php',
				type: 'POST',
				dataType: 'html',
				data: {aksi: 'ajax_cek_nama_panggilan', nama_panggilan: nama_panggilan},
			})
			.done(function(hasil) {
				$("#info_nama_panggilan").html(hasil);
				if (hasil!="") {
					$("#proses_simpan").hide('slow');
				}
				else {
					$("#proses_simpan").show('slow');
				}
			})
			.fail(function(hasil) {
				console.log("error "+hasil);
			});
		}
		else {
			$("#info_nama_panggilan").html("Harap isikan nama panggilan!");
			$("#proses_simpan").hide('slow');
		}
	}

	// Function to create auto nickname based on fullname
	function auto_nickname (fullname) {
		// Var
		var fullname             = $.trim(fullname);
		var fullname             = fullname.replace(/\s\s+/g, ' ');
		var nickname             = "";
		var nickname_suggestion  = "";
		var nickname_suggestion2 = "";
		var spacing              = fullname.indexOf(" ");
		if (spacing>-1) {
			var name_break = fullname.split(" ");
			if (name_break.length>1) {
				for (var i = name_break.length - 1; i >= 0; i--) {
					if (i==0) {
						nickname = name_break[i].toLowerCase()+nickname;
						nickname_suggestion += name_break[i].toLowerCase();
						nickname_suggestion2 = name_break[i].toLowerCase().substr(0,1)+nickname_suggestion2;
					}
					else {
						nickname = name_break[i].toLowerCase().substr(0,1)+nickname;
						nickname_suggestion += name_break[i].toLowerCase().substr(0,1);
						if (i>1) {
							nickname_suggestion2 = name_break[i].toLowerCase().substr(0,1)+nickname_suggestion2;
						}
						else {
							nickname_suggestion2 = name_break[i].toLowerCase()+nickname_suggestion2;
						}
					}
				}
			}
			else {
				nickname = name_break;
			}
		}
		else {
			nickname = fullname.toLowerCase();
		}

		// Set value to nickname field
		$("#nama_panggilan").val(nickname);
		if ($("#nama_lengkap").val()=="") {
			$("#saran_nama_panggilan").html("");
		}
		else {
			$("#saran_nama_panggilan").html("Saran : "+nickname+" / "+nickname_suggestion+" / "+nickname_suggestion2);
		}

		// Panggil fungsi cek nama panggilan
		cek_nama_panggilan(nickname);

		// Call set username
		auto_username(nickname);
	}

	// Function to set username
	function auto_username (nickname) {
		// Panggil fungsi cek nama panggilan
		cek_nama_panggilan(nickname);

		var nickname = $.trim(nickname);
		$("#username").val(nickname);
		$("#username_view").html(nickname);
	}

</script>

<?php
	// Tambah footer
	include 'global_footer.php';
}
else {
	header("Location: ./login.php");
	die();
}

?>