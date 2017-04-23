<?php 
	// Ambil data sistem 
	$setting_sistem = setting_sistem();
?>
<html>
	<head>
		<title><?php echo $setting_sistem["nama_sistem"]; ?></title>
		<script type="text/javascript" src="./assets/js/vendor/jquery.min.js"></script>
		<script type="text/javascript" src="./assets/js/flat-ui.min.js"></script>
		<link rel="stylesheet" href="./assets/css/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/css/flat-ui.min.css">
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
		<!--[if lt IE 9]>
			<script src="./assets/js/vendor/html5shiv.js"></script>
			<script src="./assets/js/vendor/respond.min.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="./assets/img/favicon.ico">
		<style type="text/css">
			body {
				padding-top: 70px;
			}
		</style>
	</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
					</button>
					<a class="navbar-brand" href="index.php"><?php 
					// Jika nama sistem lebih besar dari 10 karakter
					if (strlen($setting_sistem["nama_sistem"])>10) {
						$nama_baru = "";
						if (strpos($setting_sistem["nama_sistem"], " ")!==FALSE) {
							$ex_nama_sistem = explode(" ", $setting_sistem["nama_sistem"]);
							for ($i=0; $i < count($ex_nama_sistem); $i++) { 
								$nama_baru .= ucwords(substr($ex_nama_sistem[$i], 0, 1));
							}
						}
						echo $nama_baru;
					}
					else {
						echo $setting_sistem["nama_sistem"];
					}
					?></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<!-- <li class="active"><a href="index.php">Beranda</a></li> -->
						<?php 
						// Menu ditampilkan hanya jika user login
						if (sudah_login()) {
							echo '<li><a href="anggota.php">Data Anggota</a></li>';
						}

						// Menu berdasarkan hak akses
						if (isset($_SESSION["a2_hak_akses"]) && $_SESSION["a2_hak_akses"]!=""){
							$array_menu = tampil_menu("biasa", $_SESSION["a2_hak_akses"]);
							$menu_utama = "";
							foreach ($array_menu as $data_menu) {
								$menu_utama .= "<li><a href='$data_menu[halaman_modul]'>$data_menu[nama_modul]</a></li>";
							}
							echo $menu_utama;
						}
						?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if (sudah_login()): ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fui-gear"></i> <i class="caret"></i></a>
								<ul class="dropdown-menu">
									<li><a class="disabled"><?php echo $_SESSION["a2_nama_depan"]." ".$_SESSION["a2_nama_belakang"] ?></a></li>
									<?php 
									if ($_SESSION["a2_level"] == "super_user"){
										$array_menu_user = tampil_menu("sistem", "*");
										$menu_user       = "";
										foreach ($array_menu_user as $data_menu_user) {
											$menu_user .= "<li><a href='$data_menu_user[halaman_modul]'>$data_menu_user[nama_modul]</a></li>";
										}
										echo $menu_user;
									}
									?>
									<li class="divider"></li>
									<li><a href="profil.php"><i class="fui-user"></i> Profil</a></li>
									<li><a href="logout.php" onclick="return confirm('Keluar dari sistem <?php echo $setting_sistem["nama_sistem"] ?>?')"><i class="fui-exit"></i> Logout</a></li>
				                
								</ul>
							</li>
						<?php else: ?>
							<li><a href="login.php">Login</a></li>
						<?php endif ?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>