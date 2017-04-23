<?php 
include 'global_fungsi.php';

if (sudah_login()) {
	header("Location: ./dashboard.php");
	die();
}
else {
	// Tambahkan header
	include 'global_header.php';

	// Jika ada session dari hasil error, berikan informasi errornya
	$form_username = "";
	if (isset($_SESSION["form_username"])) {
		$form_username = $_SESSION["form_username"];
		unset($_SESSION["form_username"]); 
	}
	?>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
				<div class="login-form">
					<form action="proses.php" method="post">
						<div class="form-group">
							<input type="text" class="form-control login-field" placeholder="Username" id="login-name" name="username" value="<?php echo $form_username; ?>" required="" autofocus="">
							<label class="login-field-icon fui-user" for="login-name"></label>
						</div>

						<div class="form-group">
							<input type="password" class="form-control login-field" value="" placeholder="Password" id="login-pass"  name="password" required>
							<label class="login-field-icon fui-lock" for="login-pass"></label>
						</div>
						<input type="hidden" name="aksi" id="aksi" value="login_sistem">
						<button class="btn btn-primary btn-lg btn-block" type="submit">Log in</button>
						<!-- <a class="login-link" href="#">Lost your password?</a> -->
					</form>
					<?php // Tampilkan informasi jika ada!
		    		if (isset($_SESSION["form_error"])) {
		    			echo "<div class='alert alert-danger'>".$_SESSION["form_error"]."</div>";
		    			unset($_SESSION["form_error"]);
		    		}
		    		?>
				</div>
				<!-- End login form -->
			</div>
			<!-- End column section -->
		</div>
		<!-- End row -->
	</div>
<?php 
}
?>