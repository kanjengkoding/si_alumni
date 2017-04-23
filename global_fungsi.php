<?php session_start();

	/**
	*	FUNGSI GLOBAL SISTEM ALUMNI
	*
	*/
	require_once(__DIR__ . '/lib/db.class.php');

	/**
	*	Cek apakah user sudah melakukan login
	*	Jika session sudah ada, maka kembalikan status true, selain itu false
	*	
	*	@return 	boolean
	*	
	*/
	function sudah_login()
	{
		if (isset($_SESSION["a2_username"])) {
			$a2_username      = $_SESSION["a2_username"];
			$a2_nama_depan    = $_SESSION["a2_nama_depan"];
			$a2_nama_belakang = $_SESSION["a2_nama_belakang"];
			$a2_level         = $_SESSION["a2_level"];

			if ($a2_username!="" && $a2_nama_depan!="" && $a2_level!="") {
				return TRUE;
			}
		}
		else {
			return FALSE;
		}
	}


	/**
	*	Ambil data sistem saat ini
	*	Set jadi array dan kembalikan
	*	
	*	@return 	array 		$settingan
	*	
	*/
	function setting_sistem()
	{
		$db    = new DB();
		$query = "SELECT * FROM aluni_pengaturan";
		$datas = $db->query($query);
		foreach ($datas as $data) {
			$settingan[$data["nama_pengaturan"]] = $data["nilai_pengaturan"];
		}
		return $settingan;
	}


	/**
	*	Tampilkan menu berdasarkan modul umum
	*	
	*	@param 		string 		$tipe (system / common)
	*	@param 		string 		$hak_akses
	*	@return 	array 		$datas
	*	
	*/
	function tampil_menu($tipe, $hak_akses = "")
	{
		$db = new DB();
		if ($hak_akses!="") {
			if (strpos($hak_akses, "|")!==FALSE) {
				$mod_array = explode("|", $hak_akses);
				foreach ($mod_array as $ma => $value) {
					$mod_array2[] = "'".$value."'";
				}
				$mod_ids = implode(",", $mod_array2);
				$query   = "SELECT * FROM aluni_m_modul WHERE tipe_modul = '$tipe' AND id_modul IN ($mod_ids)";
			}
			else if ($hak_akses == "*") {
				$query = "SELECT * FROM aluni_m_modul WHERE tipe_modul = '$tipe'";
			}
			else {
				$query   = "SELECT * FROM aluni_m_modul WHERE tipe_modul = '$tipe' AND id_modul = '$hak_akses'";
			}
		}
		$datas = $db->query($query);
		return $datas;
	}


	/**
	*	Ambil data dari database
	*	
	*	@param 		string 		$tabel
	*	@param 		string 		$kolom
	*	@param 		string 		$kriteria
	*	@param 		string 		$urutan
	*	@param 		string 		$tambahan
	*	@return 	array 		$datas
	*	
	*/
	function ambil_data_global($tabel, $kolom, $kriteria="", $urutan="", $tambahan="")
	{
		$db    = new DB();
		$query = "SELECT $kolom FROM $tabel ";
		if ($kriteria!="") {
			$query .= " WHERE $kriteria ";
		}
		if ($urutan!="") {
			$query .= " ORDER BY $urutan ";
		}
		if ($tambahan!="") {
			$query .= $tambahan;
		}

		$datas = $db->query($query);
		return $datas;
	}


?>