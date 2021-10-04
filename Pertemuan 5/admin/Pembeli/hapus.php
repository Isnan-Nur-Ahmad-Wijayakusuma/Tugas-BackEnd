<?php 
//Memulai session
session_start();

//Kalo ada $_SESSION["login"], maka user bisa memasuki halaman ini & kalo tidak ada, ditendang.
if (!isset($_SESSION["login"])) {
    header("Location: ../loginAdmin.php");
}

require 'Functions.php';
//ambil idnya/tangkep id dr url tadi
$id = $_GET["id"];

//id ditangkep Fungsi hapusData
if( hapusData($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'admin.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal ditambahkan!');
			document.location.href = 'admin.php';
		</script>
	";
}
?>