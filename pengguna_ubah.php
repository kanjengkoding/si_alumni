<?php include 'global_fungsi.php';

// Jika sudah login, arahkan ke dashboard
if (sudah_login() && $_SESSION["a2_level"]=="super_user") {
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
			<!-- Isinya disini -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default">
					<form action="proses.php" method="post" class="form-horizontal">
						<div class="panel-body">
							<legend>Ubah Data Pengguna</legend>
							<?php // Ambil detail user
								$usernya = $_GET["username"];
								$datas   = ambil_data_global("aluni_pengguna a INNER JOIN aluni_pengguna_hak_akses b ON a.username = b.username", "*", "a.aktif = 'ya' AND a.username='$usernya'");
								foreach ($datas as $data) {
									$nama_depan    = $data["nama_depan"];
									$nama_belakang = $data["nama_belakang"];
									$level         = $data["level"];
									$hak_akses     = $data["hak_akses"];
									$aktif         = $data["aktif"];
								}
							?>
							<div class="form-group">
								<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">Username :</label>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 form-control-static">
									<?php echo $usernya ?>
									<input type="hidden" name="username" value="<?php echo $usernya; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4" for="nama_pengguna">Nama :</label>
								<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">
									<input type="text" name="nama_pengguna" id="nama_pengguna" title="Nama Pengguna" class="form-control" value="<?php echo $nama_depan.' '.$nama_belakang; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4" for="level">Level :</label>
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
									<select name="level" id="level" class="form-control" onchange="toggle_fg_hak_akses(this.value)">
										<option value="admin" <?php if ($level=="admin"){ ?>selected<?php } ?>>Admin</option>
										<option value="user" <?php if ($level=="user"){ ?>selected<?php } ?>>Pengguna</option>
									</select>
								</div>
							</div>
							<div class="form-group" id="fg_hak_akses" <?php if ($level=="user") {?> style="display:none" <?php } ?>>
								<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4" for="hak_akses">Hak Akses :</label>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
									<?php 
										$cb_hak_akses   = "";
										$data_hak_akses = ambil_data_global("aluni_m_modul", "*", "tipe_modul = 'biasa' AND aktif = 'ya'");
										foreach ($data_hak_akses as $dha) {
											$id_modul     = $dha['id_modul'];
											$nama_modul   = $dha['nama_modul'];

											// Jika ada hak aksesnya dengan hak akses sekarang, set checked
											if (strpos($hak_akses, $id_modul)!==FALSE) {
												$check = "checked";
											}
											else {
												$check = "";
											}

											// Set checkbox
											$cb_hak_akses .= '<label class="checkbox" for="modul_'.$id_modul.'"> <input type="checkbox" data-toggle="checkbox" value="'.$id_modul.'" name="hak_akses[]" id="modul_'.$id_modul.'" class="custom-checkbox" '.$check.'> <span class="icons"><span class="icon-unchecked"></span> <span class="icon-checked"></span></span> '.$nama_modul.' </label>';
										}
										echo $cb_hak_akses;
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4">Aktif :</label>
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
									<label class="radio">
										<input type="radio" data-toggle="radio" name="aktif" id="aktif1" value="ya" data-radiocheck-toggle="radio" <?php if($aktif == "ya") {echo "checked=''";} ?> class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
										Ya
									</label>
									<label class="radio">
										<input type="radio" data-toggle="radio" name="aktif" id="aktif2" value="tidak" data-radiocheck-toggle="radio" <?php if($aktif == "tidak") {echo "checked=''";} ?> class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
										Tidak
									</label>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-4" for="password">Password Baru :</label>
								<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">
									<input type="password" name="password_baru" id="password" class="form-control">
									<span class="help-block"><label class="checkbox" for="show_password"><input type="checkbox" data-toggle="checkbox" value="" id="show_password" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Tampilkan password</label></span>
									<span class="help-block">Biarkan kolom ini kosong jika tidak ingin mengubah password.</span>
								</div>
							</div>
						</div>
						<div class="panel-footer text-center">
							<input type="hidden" name="aksi" value="ubah_pengguna">
							<a href="pengguna.php" class="btn btn-default" onclick="return confirm('Kembali ke halaman pengguna?\nSemua perubahan yang sudah anda masukkan tidak akan tersimpan!')">Kembali</a>
							<button type="submit" class="btn btn-primary" onclick="return confirm('Yakin simpan data?\nPastikan semua data sudah dimasukkan dengan benar!')">Simpan</button>
						</div>
					</form>
				</div>
				<script type="text/javascript">
					function toggle_fg_hak_akses(level) {
						if (level=="admin") {
							$("#fg_hak_akses").show('fast');
						}
						else {
							$("#fg_hak_akses").hide('fast');
							$('input[name^="hak_akses"]').prop('checked', false);
						}
					}
				</script>
			</div>
		</div>
	</div>
	<?php
	// Include footer
	include 'global_footer.php';
}
else {
	header("Location: ./login.php");
	die();
}

?>