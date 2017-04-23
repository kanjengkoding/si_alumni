<?php include 'global_fungsi.php';

// Jika sudah login, arahkan ke dashboard
if (sudah_login()) {
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

			<div class="well">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
						<div class="panel panel-default">
							<div class="panel-body">
								<legend>Pencarian Anggota</legend>
								<form action="pencarian.php" method="post">
									<div class="form-group">
										<div class="input-group">
											<input type="hidden" name="aksi" id="aksi" value="cari">
											<input type="text" name="kata_kunci" id="kata_kunci" required class="form-control" placeholder="Kata Kunci">
											<div class="input-group-btn">
												<button class="btn btn-default" type="submit"><i class="fui-search"></i> Cari</button>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="checkbox" for="cari_nama_lengkap">
											<input type="checkbox" data-toggle="checkbox" value="nama_lengkap" id="cari_nama_lengkap" name="kategori_pencarian[]" class="custom-checkbox" checked="checked"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Nama
										</label>
										<label class="checkbox" for="cari_angkatan">
											<input type="checkbox" data-toggle="checkbox" value="angkatan" id="cari_angkatan" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Angkatan
										</label>
										<label class="checkbox" for="cari_provinsi">
											<input type="checkbox" data-toggle="checkbox" value="provinsi" id="cari_provinsi" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Provinsi
										</label>
										<label class="checkbox" for="cari_kota">
											<input type="checkbox" data-toggle="checkbox" value="kota" id="cari_kota" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Kota
										</label>
										<label class="checkbox" for="cari_tahun_masuk">
											<input type="checkbox" data-toggle="checkbox" value="tahun_masuk" id="cari_tahun_masuk" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Tahun masuk
										</label>
										<label class="checkbox" for="cari_tahun_keluar">
											<input type="checkbox" data-toggle="checkbox" value="tahun_keluar" id="cari_tahun_keluar" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Tahun keluar
										</label>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
						<div class="panel panel-default">
							<div class="panel-body">
								<?php 
									$anggota_laki   = ambil_data_global("aluni_v_anggota_lengkap", "id_anggota", "jenis_kelamin = 'laki-laki' AND aktif = 'ya'");
									$n_anggota_laki = count($anggota_laki);

									$anggota_perempuan   = ambil_data_global("aluni_v_anggota_lengkap", "id_anggota", "jenis_kelamin = 'perempuan' AND aktif = 'ya'");
									$n_anggota_perempuan = count($anggota_perempuan);
								?>
								<legend>Grafik Anggota</legend>
								<div class="img-responsive">
									<canvas id="canvas_chart" style="width:100%"></canvas>
									<div>
										<span style="background-color:#F7464A"> &nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp; Laki-laki : <?php echo $n_anggota_laki; ?>
										<br>
										<span style="background-color:#46BFBD"> &nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp; Perempuan : <?php echo $n_anggota_perempuan; ?>
										<br>
										<span style="background-color:#000000"> &nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp; Total : <?php echo $n_anggota_perempuan+$n_anggota_laki; ?>
									</div>
								</div>
								<!-- Chart JS -->
								<script type="text/javascript" src="./assets/js/vendor/chartjs/Chart.min.js"></script>
								<script type="text/javascript">
									// For a pie chart
									var options = [
									    {
									        value: <?php echo $n_anggota_laki; ?>,
									        color:"#F7464A",
									        highlight: "#FF5A5E",
									        label: "Laki-laki"
									    },
									    {
									        value: <?php echo $n_anggota_perempuan; ?>,
									        color: "#46BFBD",
									        highlight: "#5AD3D1",
									        label: "Perempuan"
									    }
									]
									window.onload = function(){
										var ctx      = document.getElementById("canvas_chart").getContext("2d");
										window.myPie = new Chart(ctx).Pie(options, {
										    animateScale: true

										});
									};
								</script>
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