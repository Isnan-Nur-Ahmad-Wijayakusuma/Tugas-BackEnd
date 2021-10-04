<?php 
//Memulai session
session_start();

//Kalo ada $_SESSION["login"], maka dibuat ketika user udah login & nek g enek, ditendang.
if (!isset($_SESSION["login"])) {
    header("Location: ../loginAdmin.php");
}

require 'Functions.php';
//ambil idnya/tangkep id dr url tadi
$id_Penjual = $_GET["id"];

//id ditangkep Fungsi hapusData
if( hapusData($id_Penjual) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'admin.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'admin.php';
		</script>
	";
}
?>