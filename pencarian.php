<?php include 'global_fungsi.php';
require_once(__DIR__ . '/lib/db.class.php');
$db = new DB();

// Tambahkan header
include 'global_header.php';

// Ambil data kata kunci dan kategori pencarian dari halaman sebelumnya
if (isset($_POST["kata_kunci"])) {
	$kata_kunci         = $_POST["kata_kunci"];
	$kategori_pencarian = $_POST["kategori_pencarian"];
}
else {
	$kata_kunci         = "";
	$kategori_pencarian = "";
}
$query           = "";
$n_kategori_cari = count($kategori_pencarian);
if ($kategori_pencarian!="" && $n_kategori_cari>0) {
	// Tetapkan query pencarian
	$query = "SELECT * FROM aluni_v_anggota_lengkap WHERE ";
	for ($i=0; $i < $n_kategori_cari; $i++) { 
		if ($kategori_pencarian[$i]!="") {
			$query .= "$kategori_pencarian[$i] LIKE '%".$kata_kunci."%' ";
			if ($i<$n_kategori_cari-1) {
				$query .= " OR ";
			}
		}
	}
}
?>
	<div class="container">
		<div class="row">
			<!-- FORM PENCARIAN -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="kolom_pencarian" style="display:none">
				<div class="panel panel-default">
					<div class="panel-body">
						<legend>Pencarian Anggota</legend>
						<form action="pencarian.php" method="post">
							<div class="form-group">
								<div class="input-group">
									<input type="hidden" name="aksi" id="aksi" value="cari">
									<input type="text" name="kata_kunci" id="kata_kunci" required class="form-control" placeholder="Kata Kunci" value="<?php echo $kata_kunci; ?>">
									<div class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="fui-search"></i> Cari</button>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
										<label class="checkbox" for="cari_nama_lengkap">
											<input type="checkbox" data-toggle="checkbox" value="nama_lengkap" id="cari_nama_lengkap" name="kategori_pencarian[]" class="custom-checkbox" checked="checked"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Nama
										</label>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
										<label class="checkbox" for="cari_angkatan">
											<input type="checkbox" data-toggle="checkbox" value="angkatan" id="cari_angkatan" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Angkatan
										</label>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
										<label class="checkbox" for="cari_provinsi">
											<input type="checkbox" data-toggle="checkbox" value="provinsi" id="cari_provinsi" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Provinsi
										</label>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
										<label class="checkbox" for="cari_kota">
											<input type="checkbox" data-toggle="checkbox" value="kota" id="cari_kota" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Kota
										</label>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
										<label class="checkbox" for="cari_tahun_masuk">
											<input type="checkbox" data-toggle="checkbox" value="tahun_masuk" id="cari_tahun_masuk" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Tahun masuk
										</label>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
										<label class="checkbox" for="cari_tahun_keluar">
											<input type="checkbox" data-toggle="checkbox" value="tahun_keluar" id="cari_tahun_keluar" name="kategori_pencarian[]" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span> Tahun keluar
										</label>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- HASIL PENCARIAN -->
			<?php
			// Loop hasil query
			if ($query != "") {
				// ambil data dari database berdasarkan query yang sudah di tetapkan
				$data_anggota = "";
				$datas        = $db->query($query);
				$total        = 0;
				$nomor        = 0;
				foreach ($datas as $data) {
					$total++;
					$data_anggota .= $data["id_anggota"];
				}
				?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<div class="alert alert-info alert-dismissable">
						<div class="row">
							<div class="col-lg-10 col-md-10  col-sm-10  col-xs-10 ">
								<p>Pencarian anggota dengan kata kunci <strong><?php echo $kata_kunci; ?></strong>, ditemukan <?php echo $total ?> hasil.</p>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right">
								<button type="button" class="btn btn-primary" id="tampil_kolom_pencarian" onclick="tampil_kolom_pencarian()"><i class="glyphicon glyphicon-search"></i> Cari</button>
							</div>
						</div>
					</div>
				</div>
				<?php if ($total>0){ ?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Lengkap</th>
								<th>Panggilan</th>
								<?php if (sudah_login()): ?>
								<th>No Hp</th>
								<?php endif ?>
								<th>Regional</th>
								<th>Angkatan</th>
								<th>Thn Masuk</th>
								<th>Thn Keluar</th>
								<?php if (sudah_login()): ?>
								<th>Aksi</th>
								<?php endif ?>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($datas as $data): $nomor++; ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $data["nama_lengkap"] ?></td>
								<td><?php echo ucfirst($data["nama_panggilan"]) ?></td>
								<?php if (sudah_login()): ?>
								<td><?php echo $data["no_handphone"] ?></td>
								<?php endif ?>
								<td><?php echo $data["kota"].", ".$data["provinsi"] ?></td>
								<td><?php echo $data["angkatan"] ?></td>
								<td><?php echo $data["tahun_masuk"] ?></td>
								<td><?php echo $data["tahun_keluar"] ?></td>
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
								<td><button type="button" class="btn btn-sm btn-primary" onclick="tampil_detail_anggota(<?php echo $data["id_anggota"]; ?>)">Detail</button></td>
								<?php endif ?>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<?php
				}
			}
			?>
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
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            </div>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	</div>

<?php 
// Tambahkan footer 
include 'global_footer.php';

?>
<script type="text/javascript">
	// Toggle untuk kolom pencarian
	function tampil_kolom_pencarian () {
		$("#kolom_pencarian").toggle(400);
	}

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