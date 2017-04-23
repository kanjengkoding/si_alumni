<?php session_start();
// session_destroy();
unset($_SESSION["a2_username"],$_SESSION["a2_nama_depan"],$_SESSION["a2_nama_belakang"],$_SESSION["a2_level"],$_SESSION["a2_hak_akses"]);
header("Location: ./index.php");
die();
?>