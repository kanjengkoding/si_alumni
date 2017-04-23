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
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
				<div class="panel panel-default">
					<div class="panel-body">
						<legend>Pengaturan Sistem</legend>
						<?php 
							$daftar_pengaturan = ambil_data_global("aluni_pengaturan", "*", "aktif = 'ya'");
							if (count($daftar_pengaturan)>0) {
								?>
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Pengaturan</th>
											<th width="35%">Nilai</th>
											<th width="35%">Keterangan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$no    = 0;
										foreach ($daftar_pengaturan as $data) {
											$no++; ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $data['nama_pengaturan'] ?></td>
												<td><?php echo strip_tags($data['nilai_pengaturan']) ?></td>
												<td><?php echo strip_tags($data['keterangan']) ?></td>
												<input type="hidden" id="nilai_<?php echo $data['nama_pengaturan'] ?>" value="<?php echo $data['nilai_pengaturan'] ?>">
												<input type="hidden" id="keterangan_<?php echo $data['nama_pengaturan'] ?>" value="<?php echo $data['keterangan'] ?>">
												<td>
													<div class="btn-group btn-group-sm">
														<button class="btn btn-primary" onclick="ubah_pengaturan('<?php echo $data['nama_pengaturan'] ?>')">Ubah</button>
													</div>
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

	<!-- Modal Detail Anggota -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_ubah_pengaturan">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<form action="proses.php" method="post">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">x</span>
		                </button>
		                <h4 class="modal-title" id="modal_title_ubah_pengaturan">Ubah Pengaturan</h4>
		            </div>
		            <div class="modal-body form-horizontal" id="modal_content_ubah_pengaturan">
		                <div class="form-group">
		                    <label class="control-label col-sm-3">Nama</label>
		                    <div class="col-sm-8 form-control-static" id="md_nama_pengaturan_v"></div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3">Nilai</label>
		                    <div class="col-sm-8">
		                    	<textarea name="md_nilai_pengaturan" id="md_nilai_pengaturan" class="form-control" rows="5"></textarea>
	                    		<p class="help-block">Anda dapat menggunakan tag html disini.</p>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3">Keterangan</label>
		                    <div class="col-sm-8">
		                    	<textarea name="md_keterangan" id="md_keterangan" class="form-control" rows="5"></textarea>
		                    </div>
		                </div>

		            </div>
		            <div class="modal-footer" id="modal_footer_ubah_pengaturan">
		            	<input type="hidden" name="md_nama_pengaturan" id="md_nama_pengaturan">
		            	<input type="hidden" name="aksi" value="ubah_pengaturan">
		            	<button type="submit" class="btn btn-primary" onclick="return confirm('Pastikan semua data sudah diisikan.\nProses simpan pengaturan ini?')">Simpan</button>
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		            </div>
	        	</form>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	</div>
	<script type="text/javascript">
	function ubah_pengaturan (nama_pengaturan) {
		// Set variabel
		$("#md_nama_pengaturan_v").html(nama_pengaturan);
		$("#md_nama_pengaturan").val(nama_pengaturan);
		$("#md_nilai_pengaturan").html($("#nilai_"+nama_pengaturan).val());
		$("#md_keterangan").html($("#keterangan_"+nama_pengaturan).val());
		$("#modal_dialog_ubah_pengaturan").modal("show");
	}
	</script>
	<?php
}
else {
	header("Location: ./login.php");
	die();
}

?>