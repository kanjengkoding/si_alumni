<?php include 'global_fungsi.php';

// Jika sudah login, arahkan ke dashboard
if (sudah_login()) {
	// Tambahkan header
	include 'global_header.php';

	// Ambil detail datanya
	$datas = ambil_data_global("aluni_v_pengguna", "*", "username = '$_SESSION[a2_username]'");
	foreach ($datas as $data) {
		$username      = $data["username"];
		$level         = $data["level"];
		$nama_depan    = $data["nama_depan"];
		$nama_belakang = $data["nama_belakang"];
		$foto          = $data["foto"];
		$id_anggota    = $data["id_anggota"];
		$hak_akses     = $data["hak_akses"];
	}
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
					<div class="panel-body">
						<legend>Profil anda</legend>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-3">Username :</label>
								<div class="col-sm-8 form-control-static" id="username"><?php echo $username ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Nama :</label>
								<div class="col-sm-8 form-control-static" id="nama"><?php echo $nama_depan." ".$nama_belakang ?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Hak Akses :</label>
								<div class="col-sm-8 form-control-static">
									<?php
										if ($hak_akses=="*") {
											echo "Semua Akses";
										}
										elseif ($hak_akses=="") {
											echo "Akses Standar ";
										}
										else {
											$info_hak_akses = "";
											if (strpos($hak_akses, "|")!==FALSE) {
												$hak_akses_ex   = explode("|", $hak_akses);
												for ($i=0; $i < count($hak_akses_ex); $i++) { 
													$datas = ambil_data_global("aluni_m_modul", "*", "id_modul = '$hak_akses_ex[$i]'");
													foreach ($datas as $data) {
														$info_hak_akses .= $data["nama_modul"];
													}
												}
											}
											else {
												$datas = ambil_data_global("aluni_m_modul", "*", "id_modul = '$hak_akses'");
												foreach ($datas as $data) {
													$info_hak_akses .= $data["nama_modul"];
												}
											}
											echo $info_hak_akses;
										}
									?>
									<input type="hidden" value="<?php echo $hak_akses ?>" name="hak_akses" id="hak_akses">
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="col-sm-3">&nbsp;</div>
								<div class="col-sm-8">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_dialog_ubah_password">Ubah Password</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Ubah Password -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_ubah_password">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="proses.php" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">x</span>
						</button>
						<h4 class="modal-title" id="modal_title_ubah_password">Ubah Password</h4>
					</div>
					<div class="modal-body form-horizontal" id="modal_content_ubah_password">
						<div class="form-group">
							<label class="control-label col-sm-3">Password Baru</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="md_password_baru" id="md_password_baru" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Ulangi Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="md_password_baru_2" id="md_password_baru_2" required="">
							</div>
						</div>
					</div>
					<div class="modal-footer" id="modal_footer_ubah_password">
						<input type="hidden" name="aksi" value="ubah_password">
						<input type="hidden" name="md_username" value="<?php echo $username ?>">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<?php
}
else {
	header("Location: ./login.php");
	die();
}

?>