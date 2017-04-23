<?php session_start();
/**
*	FUNGSI PROSES SISTEM ALUMNI
*	Berguna untuk melakukan proses semua data yang dikirimkan dari formulir.
*	Sebagai contoh adalah melakukan pengecekkan pada saat login, dan memasukkan data anggota baru
*	
*/

	require_once(__DIR__ . '/lib/db.class.php');
	$db = new DB();

	// Dapatkan aksi proses
	$aksi = $_POST["aksi"];


	/**
	*	Login sistem
	*	Cek data username dan password pengguna, kemudian set session jika pengguna terdaftar
	*	
	*/
	if ($aksi == "login_sistem") {
		$username = addslashes(strtolower($_POST["username"]));
		$password = $_POST["password"];

		$query = "SELECT salt FROM aluni_pengguna WHERE username = '$username'";
		$datas = $db->query($query);
		$salt  = "";
		foreach ($datas as $data) {
			$salt .= $data["salt"];
		}
		if ($salt == "") {
			$_SESSION["form_username"] = $_POST["username"];
			$_SESSION["form_error"]    = "Username tidak ditemukan!";
			header("Location: ./login.php");
			die();
		}
		else {
			$password_salted = hash("SHA512", $password.$salt);
			$query = "SELECT * FROM aluni_pengguna a INNER JOIN aluni_pengguna_hak_akses b ON a.`username` = b.`username` WHERE a.`username` = '$username' AND a.`password` = '$password_salted' AND a.`aktif` = 'ya'";
			$datas = $db->query($query);
			$x     = 0;
			foreach ($datas as $data) {
				$x++;
				$_SESSION["a2_username"]      = $data["username"];
				$_SESSION["a2_nama_depan"]    = $data["nama_depan"];
				$_SESSION["a2_nama_belakang"] = $data["nama_belakang"];
				$_SESSION["a2_level"]         = $data["level"];
				$_SESSION["a2_hak_akses"]     = $data["hak_akses"];
			}
			if ($x>0) {
				header("Location: ./dashboard.php");
				die();
			}
			else {
				$_SESSION["form_username"] = $_POST["username"];
				$_SESSION["form_error"]    = "Password yang anda masukkan salah!";
				header("Location: ./login.php");
				die();
			}
		}
	}


	/**
	*	Pencarian
	*	Melakukan pencarian data berdasarkan nama, angkatan, provinsi, kota, tahun masuk atau tahun keluar
	*	
	*/
	elseif ($aksi == "cari") {
		$kata_kunci         = $_POST["kata_kunci"];
		$kategori_pencarian = $_POST["kategori_pencarian"];

		$n_kategori_cari = count($kategori_pencarian);
		if ($n_kategori_cari!=0) {
			// Tetapkan query pencarian
			$query = "SELECT * FROM aluni_anggota_dasar WHERE ";
			for ($i=0; $i < $n_kategori_cari; $i++) { 
				if ($kategori_pencarian[$i]!="") {
					$query .= "$kategori_pencarian[$i] LIKE '%".$kata_kunci."%' ";
					if ($i<$n_kategori_cari-1) {
						$query .= " OR ";
					}
				}
			}
		}
		else {
			$query = "";
		}
		$_SESSION["query"] = $query;
		header("Location: ./dashboard.php");
		die();
	}
	

	/**
	*	Proses permintaan data ajax kota
	*	
	*/
	elseif ($aksi == "ajax_kota") {
		$nama_input  = $_POST["nama_input"];
		$id_provinsi = $_POST["id_provinsi"];
		$query       = "SELECT id_kota, nama_kota FROM aluni_m_kota WHERE aktif='ya' AND id_provinsi='$id_provinsi'";
		$datas       = $db->query($query);
		$hasil       = "<select data-toggle='select' name='$nama_input' id='$nama_input' class='form-control select select-primary mrs mbm'><option value='>- Pilih Kota -</option>";
		foreach ($datas as $data) {
			$hasil .= "<option value='$data[id_kota]'>$data[nama_kota]</option>";
		}
		$hasil  .= "</select>";
		echo $hasil;
	}

	/**
	*	Proses permintaan data ajax cek nama panggilan
	*	
	*/
	elseif ($aksi == "ajax_cek_nama_panggilan") {
		$nama_panggilan = $_POST["nama_panggilan"];
		$id_anggota     = "";
		// $query          = "SELECT id_anggota FROM aluni_anggota_dasar WHERE nama_panggilan = '$nama_panggilan'";
		$query          = "SELECT * FROM aluni_pengguna WHERE username = '$nama_panggilan'";
		$datas          = $db->query($query);
		foreach ($datas as $data) {
			// $id_anggota = $data["id_anggota"];
			$id_anggota = $data["username"];
		}
		if ($id_anggota!="") {
			$hasil = "Nama panggilan '$nama_panggilan' sudah digunakan. Silahkan masukkan nama lain. Terima kasih.";
		} else {
			$hasil = "";
		}
		echo $hasil;
	}


	/**
	*	Proses simpan data anggota
	*	
	*/
	elseif ($aksi == "tambah_anggota") {
		// Variabel umum
		$informasi = "";

		// Ambil semua variabel kiriman
		// Dasar
		$nama_lengkap   = addslashes($_POST["nama_lengkap"]);
		$nama_panggilan = addslashes($_POST["nama_panggilan"]);
		$jenis_kelamin  = $_POST["jenis_kelamin"];
		$tempat_lahir   = $_POST["tempat_lahir"];
		$tanggal_lahir  = $_POST["tanggal_lahir"];
		$agama          = $_POST["agama"];
		// $foto           = $_POST["foto"];
		$aktif          = $_POST["aktif"];
		$id_provinsi    = $_POST["id_provinsi"];
		$id_kota        = $_POST["id_kota"];
		$alamat         = $_POST["alamat"];
		// Keluarga
		$nama_pasangan  = addslashes($_POST["nama_pasangan"]);
		$nama_anak      = implode("|", $_POST["nama_anak"]);
		// Orang Tua
		$nama_ayah      = addslashes($_POST["nama_ayah"]);
		$nama_ibu       = addslashes($_POST["nama_ibu"]);
		$nama_wali      = addslashes($_POST["nama_wali"]);
		$id_provinsi_ot = $_POST["id_provinsi_ot"];
		$id_kota_ot     = $_POST["id_kota_ot"];
		$alamat_ot      = $_POST["alamat_ot"];
		// Kontak
		$no_rumah       = $_POST["no_rumah_ext"].$_POST["no_rumah"];
		$no_handphone   = $_POST["no_handphone"];
		$no_handphone2  = $_POST["no_handphone2"];
		$pin_blackberry = $_POST["pin_blackberry"];
		$alamat_email   = $_POST["alamat_email"];
		$alamat_website = $_POST["alamat_website"];
		$facebook       = $_POST["facebook"];
		$twitter        = $_POST["twitter"];
		// Akademik
		$angkatan       = $_POST["angkatan"];
		$tahun_masuk    = $_POST["tahun_masuk"];
		$tahun_keluar   = $_POST["tahun_keluar"];
		$kelas_terakhir = $_POST["kelas_terakhir"];
		$catatan        = $_POST["catatan"];
		// Akun
		$username       = addslashes(strtolower($_POST["username"]));
		$salt           = hash("SHA256", rand());
		$password       = hash("SHA512", $_POST["password"].$salt);
		$level          = "user";

		// Proses upload
		if ($_FILES["foto"]["name"]!="") {
			$lokasi        = "./uploaded/foto_profil/";
			// Check if file is the real image
			$check_image = getimagesize($_FILES["foto"]["tmp_name"]);
			if($check_image !== false) {
				// Verify extension
				$extensions = array("png", "jpg", "jpeg", "gif");
				$file_ext   = explode('.',$_FILES["foto"]["name"]);
				$file_ext   = strtolower(end($file_ext));
				if(in_array($file_ext,$extensions ) === false){
					$errors[] = "<br>Format file tidak diizinkan, format yang diizinkan adalah png, jpg or gif file.";
				}

				// Verify size
				if($_FILES["foto"]["size"] > 2097152){
					$errors[]="<br>Ukuran file melebihi batas 2 MB.";
				}

				// Set new name
				$nama_foto_baru = $username.".".$file_ext;

				// Upload file process
				if(empty($errors)==true){
					// Upload
					move_uploaded_file($_FILES["foto"]["tmp_name"], $lokasi.$nama_foto_baru);
					$sukses_upload = true;
					$foto          = $nama_foto_baru;
				}
				else {
					// Set error count flag and notification
					foreach ($errors as $upload_error) {
						$informasi .= $upload_error;
					}
					$sukses_upload = false;
					$foto          = "no-img.jpg";
				}
			}
		}
		else {
			$sukses_upload = true;
			$foto          = "no-img.jpg";
		}

		// Jika upload berhasil, Proses simpan ~
		if ($sukses_upload) {
			// Simpan Dasar
			$query      = "INSERT INTO aluni_anggota_dasar VALUES ('', '$nama_lengkap', '$nama_panggilan', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$agama', '$foto', '$id_provinsi', '$id_kota', '$alamat', '$aktif', '$_SESSION[a2_username]', NOW(), '$_SESSION[a2_username]', NOW(), '0')";
			$proses     = $db->query($query);
			$id_anggota = $db->lastInsertId();

			// Jika anggota berhasil dimasukkan, ambil id_anggota dan simpan data lainnya.
			if ($id_anggota!="") {
				// Simpan Pengguna
				$query  = "INSERT INTO aluni_pengguna VALUES ('$username', '$password', '$salt', '$level', 'ya', '$nama_lengkap', '', '$foto', '$id_anggota', '$_SESSION[a2_username]', NOW(), '$_SESSION[a2_username]', NOW(), '0')";
				$proses = $db->query($query);

				// Simpan Hak akses pengguna
				$query  = "INSERT INTO aluni_pengguna_hak_akses VALUES ('$username', '', NOW())";
				$proses = $db->query($query);

				// Simpan status password pengguna
				$query  = "INSERT INTO aluni_pengguna_status_password VALUES ('$id_anggota', '$username', '$_POST[password]', 'belum diubah', '$_SESSION[a2_username]', NOW(), '$_SESSION[a2_username]', NOW())";
				$proses = $db->query($query);
				
				// Simpan keluarga
				$query = "INSERT INTO aluni_anggota_keluarga VALUES ('$id_anggota', '$nama_pasangan', '$nama_anak', '$_SESSION[a2_username]', NOW(), '$_SESSION[a2_username]', NOW(), '0')";
				$proses     = $db->query($query);
				
				// Simpan orang tua
				$query = "INSERT INTO aluni_anggota_orang_tua VALUES ('$id_anggota', '$nama_ayah', '$nama_ibu', '$nama_wali', '$id_provinsi_ot', '$id_kota_ot', '$alamat_ot', '$_SESSION[a2_username]', NOW(), '$_SESSION[a2_username]', NOW(), '0')";
				$proses     = $db->query($query);
				
				// Simpan kontak
				$query = "INSERT INTO aluni_anggota_kontak VALUES ('$id_anggota', '$no_rumah', '$no_handphone', '$no_handphone2', '$pin_blackberry', '$alamat_email', '$alamat_website', '$facebook', '$twitter', '$_SESSION[a2_username]', NOW(), '$_SESSION[a2_username]', NOW(), '0')";
				$proses     = $db->query($query);
				
				// Simpan akademik
				$query = "INSERT INTO aluni_anggota_akademik VALUES ('$id_anggota', '$angkatan', '$tahun_masuk', '$tahun_keluar', '$kelas_terakhir', '$catatan', '$_SESSION[a2_username]', NOW(), '$_SESSION[a2_username]', NOW(), '0')";
				$proses     = $db->query($query);
			}

			if ($proses) {
				$_SESSION["informasi"] = "Data anggota baru berhasil disimpan!";
			}
			
		}
		// Jika upload gagal, berikan informasi ke halaman depan
		else {
			$_SESSION["informasi"] = "Penyimpanan data anggota gagal!".$informasi;
		}
		header("Location: ./tambah_anggota.php");
		die();
	}


	/**
	*	Proses simpan perubahan data anggota
	*	
	*/
	elseif ($aksi == "ubah_anggota") {
		// Variabel umum
		$informasi = "";

		// Ambil semua variabel kiriman
		$id_anggota     = $_POST["id_anggota"];
		$username       = $_POST["username"];
		// Dasar
		$nama_lengkap   = addslashes($_POST["nama_lengkap"]);
		$nama_panggilan = addslashes($_POST["nama_panggilan"]);
		$jenis_kelamin  = $_POST["jenis_kelamin"];
		$tempat_lahir   = $_POST["tempat_lahir"];
		$tanggal_lahir  = $_POST["tanggal_lahir"];
		$agama          = $_POST["agama"];
		$aktif          = $_POST["aktif"];
		$id_provinsi    = $_POST["id_provinsi"];
		$id_kota        = $_POST["id_kota"];
		$alamat         = $_POST["alamat"];
		// Keluarga
		$nama_pasangan  = addslashes($_POST["nama_pasangan"]);
		$nama_anak      = implode("|", $_POST["nama_anak"]);
		// Orang Tua
		$nama_ayah      = addslashes($_POST["nama_ayah"]);
		$nama_ibu       = addslashes($_POST["nama_ibu"]);
		$nama_wali      = addslashes($_POST["nama_wali"]);
		$id_provinsi_ot = $_POST["id_provinsi_ot"];
		$id_kota_ot     = $_POST["id_kota_ot"];
		$alamat_ot      = $_POST["alamat_ot"];
		// Kontak
		$no_rumah       = $_POST["no_rumah"];
		$no_handphone   = $_POST["no_handphone"];
		$no_handphone2  = $_POST["no_handphone2"];
		$pin_blackberry = $_POST["pin_blackberry"];
		$alamat_email   = $_POST["alamat_email"];
		$alamat_website = $_POST["alamat_website"];
		$facebook       = $_POST["facebook"];
		$twitter        = $_POST["twitter"];
		// Akademik
		$angkatan       = $_POST["angkatan"];
		$tahun_masuk    = $_POST["tahun_masuk"];
		$tahun_keluar   = $_POST["tahun_keluar"];
		$kelas_terakhir = $_POST["kelas_terakhir"];
		$catatan        = $_POST["catatan"];

		// Proses upload
		if ($_FILES["foto"]["name"]!="") {
			$lokasi        = "./uploaded/foto_profil/";
			// Check if file is the real image
			$check_image = getimagesize($_FILES["foto"]["tmp_name"]);
			if($check_image !== false) {
				// Verify extension
				$extensions = array("png", "jpg", "jpeg", "gif");
				$file_ext   = explode('.',$_FILES["foto"]["name"]);
				$file_ext   = strtolower(end($file_ext));
				if(in_array($file_ext,$extensions ) === false){
					$errors[] = "<br>Format file tidak diizinkan, format yang diizinkan adalah png, jpg or gif file.";
				}

				// Verify size
				if($_FILES["foto"]["size"] > 2097152){
					$errors[]="<br>Ukuran file melebihi batas 2 MB.";
				}

				// Set new name
				$nama_foto_baru = $username.".".$file_ext;

				// Upload file process
				if(empty($errors)==true){
					// Upload
					move_uploaded_file($_FILES["foto"]["tmp_name"], $lokasi.$nama_foto_baru);
					$sukses_upload = true;
					$foto          = ", foto = '$nama_foto_baru'";
				}
				else {
					// Set error count flag and notification
					foreach ($errors as $upload_error) {
						$informasi .= $upload_error;
					}
					$sukses_upload = false;
					$foto          = ", foto = 'no-img.jpg'";
				}
			}
		}
		else {
			$sukses_upload = true;
			$foto          = "";
		}

		// Jika upload berhasil, Proses simpan ~
		if ($sukses_upload) {
			if ($id_anggota!="") {
				// Simpan Dasar
				$query  = "UPDATE aluni_anggota_dasar SET nama_lengkap = '$nama_lengkap', nama_panggilan = '$nama_panggilan', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', agama = '$agama' $foto, id_provinsi = '$id_provinsi', id_kota = '$id_kota', alamat = '$alamat', aktif = '$aktif', updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1 WHERE id_anggota = '$id_anggota'";
				$proses = $db->query($query);
				
				// Simpan keluarga
				$query = "UPDATE aluni_anggota_keluarga SET nama_pasangan = '$nama_pasangan', nama_anak = '$nama_anak', updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1 WHERE id_anggota = '$id_anggota'";
				$proses = $db->query($query);
				
				// Simpan orang tua
				$query = "UPDATE aluni_anggota_orang_tua SET nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', nama_wali = '$nama_wali', id_provinsi = '$id_provinsi_ot', id_kota = '$id_kota_ot', alamat_orang_tua = '$alamat_ot', updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1 WHERE id_anggota = '$id_anggota'";
				$proses = $db->query($query);
				
				// Simpan kontak
				$query = "UPDATE aluni_anggota_kontak SET no_rumah = '$no_rumah', no_handphone = '$no_handphone', no_handphone2 = '$no_handphone2', pin_blackberry = '$pin_blackberry', alamat_email = '$alamat_email', alamat_website = '$alamat_website', facebook = '$facebook', twitter = '$twitter', updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1 WHERE id_anggota = '$id_anggota'";
				$proses = $db->query($query);
				
				// Simpan akademik
				$query = "UPDATE aluni_anggota_akademik SET angkatan = '$angkatan', tahun_masuk = '$tahun_masuk', tahun_keluar = '$tahun_keluar', kelas_terakhir = '$kelas_terakhir', catatan = '$catatan', updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1 WHERE id_anggota = '$id_anggota'";
				$proses = $db->query($query);

				// Simpan Pengguna
				$query  = "UPDATE aluni_pengguna SET nama_depan = '$nama_lengkap' $foto, updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1  WHERE id_anggota = '$id_anggota'";
				$proses = $db->query($query);
			}

			if ($proses) {
				$_SESSION["informasi"] = "Perubahan data anggota <strong>$nama_lengkap</strong> berhasil disimpan!";
			}
			
		}
		// Jika upload gagal, berikan informasi ke halaman depan
		else {
			$_SESSION["informasi"] = "Penyimpanan data anggota gagal!".$informasi;
		}
		header("Location: ./anggota.php");
		die();
	}


	/**
	*	Proses ubah pengaturan sistem
	*	
	*/
	elseif ($aksi == "ubah_pengaturan") {
		// Ambil variabel
		$nama_pengaturan  = $_POST["md_nama_pengaturan"];
		$nilai_pengaturan = $_POST["md_nilai_pengaturan"];
		$keterangan       = $_POST["md_keterangan"];

		// Set Query
		if ($nama_pengaturan!="") {
			$query  = "UPDATE aluni_pengaturan SET nilai_pengaturan = '$nilai_pengaturan', keterangan = '$keterangan' WHERE nama_pengaturan = '$nama_pengaturan'";
			$proses = $db->query($query);

			if ($proses) {
				$_SESSION["informasi"] = "Data pengaturan telah berhasil disimpan.";
			}
			else {
				$_SESSION["informasi"] = "Data pengaturan gagal disimpan!";
			}
		}

		// Kembalikan
		header("Location: ./pengaturan_sistem.php");
		die();
	}


	/**
	*	Proses ubah password dari halaman profil
	*	
	*/
	elseif ($aksi == "ubah_password") {
		$username            = $_POST["md_username"];
		$password_baru       = $_POST["md_password_baru"];
		$password_konfirmasi = $_POST["md_password_baru_2"];
		if ($password_baru == $password_konfirmasi) {
			// Set Password Baru
			$salt        = hash("SHA256", rand());
			$salted_pass = hash("SHA512", $password_baru.$salt);
			// Ubah Password dari database
			$query  = "UPDATE aluni_pengguna SET salt = '$salt', password = '$salted_pass', updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1 WHERE username = '$username'";
			$proses = $db->query($query);
			// Ubah Status Password
			$status = "";
			$query  = "SELECT status FROM aluni_pengguna_status_password WHERE username = '$username'";
			$datas  = $db->query($query);
			foreach ($datas as $data) {
				$status = $data["status"];
			}
			if ($status == "belum diubah") {
				$query  = "UPDATE aluni_pengguna_status_password SET password = '-', status = 'sudah diubah', updated_by = '$_SESSION[a2_username]', updated_date = NOW() WHERE username = '$username'";
				$proses = $db->query($query);
			}
			$_SESSION["informasi"] = "Password anda sudah berhasil diubah!";
		}
		else {
			$_SESSION["informasi"] = "Password yang anda masukkan tidak sama. Silahkan coba lagi.";
		}
		// Kembalikan
		header("Location: ./profil.php");
		die();
	}


	/**
	*	Proses ubah pengguna dari halaman pengguna
	*	
	*/
	elseif ($aksi == "ubah_pengguna") {
		$username      = $_POST["username"];
		$nama_pengguna = $_POST["nama_pengguna"];
		$level         = $_POST["level"];
		$aktif         = $_POST["aktif"];
		$password_baru = $_POST["password_baru"];
		$hak_akses_arr = $_POST["hak_akses"];
		$hak_akses     = implode("|", $hak_akses_arr);

		$pass_query = "";
		if ($password_baru!="") {
			$salt        = hash("SHA256", rand());
			$salted_pass = hash("SHA512", $password_baru.$salt);
			$pass_query  = ", password = '$salted_pass', salt = '$salt' ";
		}

		// Update pengguna
		$query = "UPDATE aluni_pengguna SET nama_depan = '$nama_pengguna', level = '$level', aktif = '$aktif', updated_by = '$_SESSION[a2_username]', updated_date = NOW(), revisi = revisi+1 $pass_query WHERE username = '$username'";
		$proses = $db->query($query);

		// Update hak akses pengguna
		$query = "UPDATE aluni_pengguna_hak_akses SET hak_akses = '$hak_akses' WHERE username = '$username'";
		$proses = $db->query($query);

		if ($proses) {
			$_SESSION["informasi"] = "Data pengguna dengan username $username sudah berhasil diubah!";
		}

		// Kembalikan
		header("Location: ./pengguna.php");
		die();
	}


	/**
	*	Proses hapus pengguna dari halaman pengguna
	*	
	*/
	elseif ($aksi == "hapus_pengguna") {
		$username = $_POST["username"];
		// Hapus pengguna
		$query    = "DELETE FROM aluni_pengguna WHERE username = 'username'";
		$proses   = $db->query($query);
		// Hapus pengguna hak akses
		$query    = "DELETE FROM aluni_pengguna_hak_akses WHERE username = '$username'";
		$proses   = $db->query($query);
		// Hapus pengguna status password
		$query    = "DELETE FROM aluni_pengguna_hak_akses WHERE username = '$username'";
		$proses   = $db->query($query);

		if ($proses) {
			$_SESSION["informasi"] = "Data pengguna dengan username $username sudah berhasil dihapus!";
		}

		// Kembalikan
		header("Location: ./pengguna.php");
		die();
	}


	/**
	*	Jika tidak ada aksi kembalikan ke halaman utama
	*	
	*/
	else {
		header("Location: ./index.php");
		die();
	}
?>