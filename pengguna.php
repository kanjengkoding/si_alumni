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
					<div class="panel-body">
						<legend>Daftar Pengguna</legend>
						<?php 
							$daftar_pengguna = ambil_data_global("aluni_v_pengguna", "*", "level!='super_user'");
							if (count($daftar_pengguna)>0) {
								?>
								<table class="table table-striped datatable">
									<thead>
										<tr>
											<th>No</th>
											<th>Username</th>
											<th>Nama</th>
											<th>Level</th>
											<th>Aktif</th>
											<th>Password</th>
											<th>Hak Akses</th>
											<th>#</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$no = 0;
										foreach ($daftar_pengguna as $data) {
											$usernya = $data["username"];
											$no++;
											?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $usernya; ?></td>
												<td><?php echo $data["nama_depan"].$data["nama_belakang"]; ?></td>
												<td><?php echo ucfirst($data["level"]); ?></td>
												<td><?php echo ucfirst($data["aktif"]); ?></td>
												<td><?php if ($data["status"] == "belum diubah") {echo $data["password"];} else {echo "-";}?></td>
												<td><?php 
													if ($data["hak_akses"]=="*") {
														echo "Semua Akses";
													}
													elseif ($data["hak_akses"]=="") {
														echo "Akses Standar ";
													}
													else {
														$info_hak_akses = "Akses Standar<br>";
														if (strpos($data["hak_akses"], "|")!==FALSE) {
															$hak_akses_ex   = explode("|", $data["hak_akses"]);
															for ($i=0; $i < count($hak_akses_ex); $i++) { 
																$datas = ambil_data_global("aluni_m_modul", "*", "id_modul = '$hak_akses_ex[$i]'");
																foreach ($datas as $data) {
																	$info_hak_akses .= $data["nama_modul"]."<br>";
																}
															}
														}
														else {
															$datas = ambil_data_global("aluni_m_modul", "*", "id_modul = '$data[hak_akses]'");
															foreach ($datas as $data) {
																$info_hak_akses .= $data["nama_modul"];
															}
														}
														echo $info_hak_akses;
													} ?>
												</td>
												<td>
													<form action="proses.php" method="post">
														<a href="pengguna_ubah.php?username=<?php echo $usernya; ?>" class="btn btn-sm btn-primary">Ubah</a>
														<?php if ($_SESSION['a2_level']=="super_user"){ ?><input type="hidden" name="aksi" value="hapus_pengguna"><input type="hidden" name="username" value="<?php echo $usernya ?>"><button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data pengguna? Pengguna ini akan dihapus dan tidak dapat dikembalikan.')">Hapus</button><?php } ?>
													</form>
												</td>
											</tr>
											<?php
										}
									?>
									</tbody>
								</table>
								<?php
							}
							else {
								echo "<p class='text-center'>Tidak Ada Data!</p>";
							}
						?>
					</div>
				</div>
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