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
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
				<div class="panel panel-default">
					<div class="panel-body">
						<legend>Daftar Anggota</legend>
						<?php 
							$daftar_anggota = ambil_data_global("aluni_v_anggota_lengkap", "*", "aktif = 'ya'", "nama_lengkap ASC");
							if (count($daftar_anggota)>0) {
								?>
								<table class="table table-striped datatable">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Lengkap</th>
											<th>Panggilan</th>
											<!-- <th>Tempat, Tgl Lahir</th> -->
											<th>JK</th>
											<th>No Handphone</th>
											<th>Angkatan</th>
											<th>#</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$no = 0;
										foreach ($daftar_anggota as $data) {
											$no++;
											?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $data["nama_lengkap"]; ?></td>
												<td><?php echo $data["nama_panggilan"]; ?></td>
												<!-- <td><?php echo $data["tempat_lahir"].", ".$data["tanggal_lahir"]; ?></td> -->
												<td><?php echo $data["jenis_kelamin"]; ?></td>
												<td><?php echo $data["no_handphone"]; ?></td>
												<td><?php echo $data["angkatan"]; ?></td>
												<!-- <td>Aksinya</td> -->
												<?php if (sudah_login()): ?>
												<input type="hidden" id="nama_lengkap_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["nama_lengkap"]; ?>">
												<input type="hidden" id="nama_panggilan_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["nama_panggilan"]; ?>">
												<input type="hidden" id="jenis_kelamin_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["jenis_kelamin"]; ?>">
												<input type="hidden" id="tempat_lahir_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["tempat_lahir"]; ?>">
												<input type="hidden" id="tanggal_lahir_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["tanggal_lahir"]; ?>">
												<input type="hidden" id="agama_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["agama"]; ?>">
												<input type="hidden" id="foto_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["foto"]; ?>">
												<input type="hidden" id="provinsi_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["provinsi"]; ?>">
												<input type="hidden" id="kota_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["kota"]; ?>">
												<input type="hidden" id="alamat_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["alamat"]; ?>">
												<input type="hidden" id="angkatan_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["angkatan"]; ?>">
												<input type="hidden" id="tahun_masuk_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["tahun_masuk"]; ?>">
												<input type="hidden" id="tahun_keluar_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["tahun_keluar"]; ?>">
												<input type="hidden" id="kelas_terakhir_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["kelas_terakhir"]; ?>">
												<input type="hidden" id="catatan_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["catatan"]; ?>">
												<input type="hidden" id="nama_pasangan_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["nama_pasangan"]; ?>">
												<input type="hidden" id="nama_anak_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["nama_anak"]; ?>">
												<input type="hidden" id="nama_ayah_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["nama_ayah"]; ?>">
												<input type="hidden" id="nama_ibu_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["nama_ibu"]; ?>">
												<input type="hidden" id="nama_wali_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["nama_wali"]; ?>">
												<input type="hidden" id="provinsi_orang_tua_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["provinsi_orang_tua"]; ?>">
												<input type="hidden" id="kota_orang_tua_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["kota_orang_tua"]; ?>">
												<input type="hidden" id="alamat_orang_tua_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["alamat_orang_tua"]; ?>">
												<input type="hidden" id="no_rumah_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["no_rumah"]; ?>">
												<input type="hidden" id="no_handphone_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["no_handphone"]; ?>">
												<input type="hidden" id="no_handphone2_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["no_handphone2"]; ?>">
												<input type="hidden" id="pin_blackberry_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["pin_blackberry"]; ?>">
												<input type="hidden" id="alamat_email_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["alamat_email"]; ?>">
												<input type="hidden" id="alamat_website_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["alamat_website"]; ?>">
												<input type="hidden" id="facebook_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["facebook"]; ?>">
												<input type="hidden" id="twitter_<?php echo $data["id_anggota"]; ?>" value="<?php echo $data["twitter"]; ?>">
												<td>
													<button type="button" class="btn btn-inverse btn-sm" onclick="tampil_detail_anggota(<?php echo $data["id_anggota"]; ?>)">Detail</button>
													<?php if (strpos($_SESSION['a2_hak_akses'], '003')!==FALSE || $_SESSION['a2_hak_akses']=="*"): ?>
													<a href="ubah_anggota.php?ida=<?php echo $data["id_anggota"].hash("md5", rand()); ?>" class="btn btn-sm btn-primary">Ubah</a>
													<?php endif ?>
												</td>
												<?php endif ?>
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
	<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_anggota_detail">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">x</span>
	                </button>
	                <h4 class="modal-title" id="modal_title_anggota_detail">Detail Anggota</h4>
	            </div>
	            <div class="modal-body form-horizontal" id="modal_content_anggota_detail">
	            	<!-- <legend>Data Dasar</legend> -->
	                <div class="form-group">
	                    <label class="control-label col-sm-3"></label>
	                    <div class="col-sm-8 form-control-static">
	                        <img class="img-thumbnail" alt="Foto Anggota" id="md_foto" style="max-height:180px">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Nama Lengkap :</label>
	                    <div class="col-sm-8 form-control-static" id="md_nama_lengkap"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Nama Panggilan :</label>
	                    <div class="col-sm-8 form-control-static" id="md_nama_panggilan"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Jenis Kelamin :</label>
	                    <div class="col-sm-8 form-control-static" id="md_jenis_kelamin"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Tempat, Tgl Lahir :</label>
	                    <div class="col-sm-8 form-control-static" id="md_tempat_tanggal_lahir"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Agama :</label>
	                    <div class="col-sm-8 form-control-static" id="md_agama"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Alamat :</label>
	                    <div class="col-sm-8 form-control-static" id="md_alamat_lengkap"></div>
	                </div>

	                <hr class="dashed">
	                <legend class="text-center">Data Keluarga</legend>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Nama Pasangan :</label>
	                    <div class="col-sm-8 form-control-static" id="md_nama_pasangan"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Nama Anak :</label>
	                    <div class="col-sm-8 form-control-static" id="md_nama_anak"></div>
	                </div>

	                <hr class="dashed">
					<legend class="text-center">Data Orang Tua</legend>
					<div class="form-group">
	                    <label class="control-label col-sm-3">Nama Ayah :</label>
	                    <div class="col-sm-8 form-control-static" id="md_nama_ayah"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Nama Ibu :</label>
	                    <div class="col-sm-8 form-control-static" id="md_nama_ibu"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Nama Wali :</label>
	                    <div class="col-sm-8 form-control-static" id="md_nama_wali"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Alamat Orang Tua :</label>
	                    <div class="col-sm-8 form-control-static" id="md_alamat_lengkap_ot"></div>
	                </div>

	                <hr class="dashed">
					<legend class="text-center">Data Kontak</legend>
					<div class="form-group">
	                    <label class="control-label col-sm-3">Telp Rumah :</label>
	                    <div class="col-sm-8 form-control-static" id="md_no_rumah"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">No Handphone :</label>
	                    <div class="col-sm-8 form-control-static" id="md_no_handphone"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">No Handphone 2 :</label>
	                    <div class="col-sm-8 form-control-static" id="md_no_handphone2"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Pin Blackberry :</label>
	                    <div class="col-sm-8 form-control-static" id="md_pin_blackberry"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Email :</label>
	                    <div class="col-sm-8 form-control-static" id="md_alamat_email"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Website :</label>
	                    <div class="col-sm-8 form-control-static" id="md_alamat_website"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Facebook :</label>
	                    <div class="col-sm-8 form-control-static" id="md_facebook"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Twitter :</label>
	                    <div class="col-sm-8 form-control-static" id="md_twitter"></div>
	                </div>

	                <hr class="dashed">
					<legend class="text-center">Data Akademik</legend>
					<div class="form-group">
	                    <label class="control-label col-sm-3">Angkatan :</label>
	                    <div class="col-sm-8 form-control-static" id="md_angkatan"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Tahun Masuk :</label>
	                    <div class="col-sm-8 form-control-static" id="md_tahun_masuk"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Tahun Keluar :</label>
	                    <div class="col-sm-8 form-control-static" id="md_tahun_keluar"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Kelas Terakhir :</label>
	                    <div class="col-sm-8 form-control-static" id="md_kelas_terakhir"></div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-3">Catatan :</label>
	                    <div class="col-sm-8 form-control-static" id="md_catatan"></div>
	                </div>

	            </div>
	            <div class="modal-footer" id="modal_footer_anggota_detail">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
	            </div>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	</div>

	<?php
	// Tambahkan footer
	include 'global_footer.php';

	?>
	<script type="text/javascript">
		// Tombol untuk melihat detail anggota
		function tampil_detail_anggota (id_anggota) {
			// Set hasil dasar
			$("#md_foto").attr('src', './uploaded/foto_profil/'+$("#foto_"+id_anggota).val());
			$("#md_nama_lengkap").html($("#nama_lengkap_"+id_anggota).val());
			$("#md_nama_panggilan").html($("#nama_panggilan_"+id_anggota).val());
			$("#md_jenis_kelamin").html($("#jenis_kelamin_"+id_anggota).val());
			$("#md_tempat_tanggal_lahir").html($("#tempat_lahir_"+id_anggota).val()+', '+$("#tanggal_lahir_"+id_anggota).val());
			$("#md_agama").html($("#agama_"+id_anggota).val());
			$("#md_alamat_lengkap").html($("#kota_"+id_anggota).val()+', '+$("#provinsi_"+id_anggota).val()+' '+$("#alamat_"+id_anggota).val());
			// Set hasil keluarga
			$("#md_nama_pasangan").html($("#nama_pasangan_"+id_anggota).val());
			nama_anak    = '';
			nama_anaknya = $("#nama_anak_"+id_anggota).val().split('|');
			for (var i = nama_anaknya.length - 1; i >= 0; i--) {
				nama_anak += '<p>' + nama_anaknya[i] + '</p>';
			};
			$("#md_nama_anak").html(nama_anak);
			// Set hasil orang tua
			$("#md_nama_ayah").html($("#nama_ayah_"+id_anggota).val());
			$("#md_nama_ibu").html($("#nama_ibu_"+id_anggota).val());
			$("#md_nama_wali").html($("#nama_wali_"+id_anggota).val());
			$("#md_alamat_lengkap_ot").html($("#kota_orang_tua_"+id_anggota).val()+', '+$("#provinsi_orang_tua_"+id_anggota).val()+' '+$("#alamat_orang_tua_"+id_anggota).val());
			// Set hasil kontak
			$("#md_no_rumah").html($("#no_rumah_"+id_anggota).val());
			$("#md_no_handphone").html($("#no_handphone_"+id_anggota).val());
			$("#md_no_handphone2").html($("#no_handphone2_"+id_anggota).val());
			$("#md_pin_blackberry").html($("#pin_blackberry_"+id_anggota).val());
			$("#md_alamat_email").html($("#alamat_email_"+id_anggota).val());
			$("#md_alamat_website").html($("#alamat_website_"+id_anggota).val());
			$("#md_facebook").html($("#facebook_"+id_anggota).val());
			$("#md_twitter").html($("#twitter_"+id_anggota).val());
			// Set hasil akademik
			$("#md_angkatan").html($("#angkatan_"+id_anggota).val());
			$("#md_tahun_masuk").html($("#tahun_masuk_"+id_anggota).val());
			$("#md_tahun_keluar").html($("#tahun_keluar_"+id_anggota).val());
			$("#md_kelas_terakhir").html($("#kelas_terakhir_"+id_anggota).val());
			$("#md_catatan").html($("#catatan_"+id_anggota).val());


			// Tampilkan modal
			$("#modal_dialog_anggota_detail").modal("show");
		}

	</script>
	<?php
}
else {
	header("Location: ./login.php");
	die();
}

?>