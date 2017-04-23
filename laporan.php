<?php include 'global_fungsi.php';

// Jika sudah login, arahkan ke dashboard
if (sudah_login() && (strpos($_SESSION['a2_hak_akses'], '004')!==FALSE || $_SESSION['a2_hak_akses']=="*")) {
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
						<legend>Laporan</legend>
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="tile">
									<img src="./assets/img/icons/svg/clipboard.svg" alt="Clipboard" class="tile-image big-illustration">
									<h3 class="tile-title">Laporan Keseluruhan</h3>
									<p>Proses download laporan keseluruhan data anggota.</p>
									<a class="btn btn-primary btn-large btn-block" href="laporan_download.php?tipe=keseluruhan">Download</a>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="tile">
									<img src="./assets/img/icons/svg/book.svg" alt="Book" class="tile-image big-illustration">
									<h3 class="tile-title">Laporan Per Angkatan</h3>
									<p>Proses download laporan berdasarkan angkatan anggota.</p>
									<div class="form-group">
										<select data-toggle="select" name="angkatan" id="angkatan" class="form-control select select-primary mrs mbm" onchange="angkatan_report_url(this.value)">
											<option value="">- Pilih Angkatan -</option>
											<?php 
												// Ambil data angkatan yang di DISTINCT dari tabel dasar
												$daftar_angkatan = ambil_data_global("aluni_anggota_akademik", "DISTINCT(angkatan)", "", "angkatan ASC");
												$select_angkatan = "";
												foreach ($daftar_angkatan as $dang) {
													if ($dang['angkatan']!="") {
														$select_angkatan .= "<option value='$dang[angkatan]'>Angkatan $dang[angkatan]</option>";
													}
												}
												echo $select_angkatan;
											?>
										</select>
										<a class="btn btn-primary btn-large btn-block" id="angkatan_select">Download</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('select[name="angkatan"]').select2({dropdownCssClass: 'show-select-search'});
											});
											function angkatan_report_url(id_ang) {
												if (id_ang!="") {
													$("#angkatan_select").attr("href", "laporan_download.php?tipe=angkatan&id="+id_ang);
												}
												else {
													$("#angkatan_select").attr("href", "#");
												}
											}
										</script>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="tile">
									<img src="./assets/img/icons/svg/map.svg" alt="Map" class="tile-image big-illustration">
									<h3 class="tile-title">Laporan Per Provinsi</h3>
									<p>Proses download laporan berdasarkan provinsi tinggal anggota.</p>
									<div class="form-group">
										<select data-toggle="select" name="regional" id="regional" class="form-control select select-primary mrs mbm" onchange="regional_report_url(this.value)">
											<option value="">- Pilih Provinsi -</option>
											<?php 
												// Ambil data provinsi dari tabel master provinsi
												$daftar_provinsi = ambil_data_global("aluni_m_provinsi", "id_provinsi, nama_provinsi", "aktif = 'ya'", "id_provinsi ASC");
												$select_provinsi = "";
												foreach ($daftar_provinsi as $dprovinsi) {
													$select_provinsi .= "<option value='$dprovinsi[nama_provinsi]'>$dprovinsi[nama_provinsi]</option>";
												}
												echo $select_provinsi;
											?>
										</select>
										<a class="btn btn-primary btn-large btn-block" id="regional_select">Download</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('select[name="regional"]').select2({dropdownCssClass: 'show-select-search'});
											});
											function regional_report_url(id_provinsi) {
												if (id_provinsi!="") {
													$("#regional_select").attr("href", "laporan_download.php?tipe=regional&id="+id_provinsi);
												}
												else {
													$("#regional_select").attr("href", "#");
												}
											}
										</script>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
else {
	header("Location: ./login.php");
	die();
}

?>