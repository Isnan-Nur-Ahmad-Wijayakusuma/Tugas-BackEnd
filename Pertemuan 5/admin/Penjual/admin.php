<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../loginAdmin.php");
  exit;
}
//Menghubungkan dengan halaman Functions.
require "Functions.php";

//Disimpan di variabel $penjual.
#Tampilkan seluruh data penjual, tp urutkan dari yang terbaru.
#ORDER BY = urutkan dr. ASC = Ascending.
$penjual = query("SELECT * FROM penjual");

//tombol cari diklik
if(isset($_POST["find"])){
    $penjual = cariData($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Page</title>
</head>
<body>
    <a href="../logout.php">LOGOUT</a><br>
    <h1>Daftar Penjual/Mitra</h1>
    
    <a href="../Pembeli/admin.php">Data customer</a>
    <br><br>
    <form action="" method="post">
        <?php #autofocus = langsung ngetik tanpa klik. autocomplet = nulis enk historyne?>
        <input type="text" name="keyword" size="29.2" placeholder="cari berdasarkan keyword" autofocus autocomplete="off">
        <button type="submit" name="find">cari</button>
        
    </form><br><br>

    <a href="tambah.php">Tambah data user</a><br><br>
    
    <table border="1" cellspacing="1" cellpadding="20">
    <thead>
 		<tr>
            <th>No</th>
 			<th>ID Penjual</th>
            <th>Nama Pemilik</th>
            <th>Nama Toko</th>
 			<th>Alamat Email</th>
 			<th>Username</th>
 			<th>Password</th>
            <th>Telepon</th>
 			<th>Kode POS</th>
 			<th>Nama Jalan</th>
 			<th>Foto Toko</th>
            <th>Pengaturan</th>
 		</tr>
 	</thead>
    <tbody>
    <?php $a = 1;   #Untuk nomer?>
    <?php foreach($penjual as $row):   #variabel $row yg digunakan dibawah?>
        <tr>
            <td><?= $a; ?></td>
 			<td><?= $row["id_Penjual"]; ?></td>
            <td><?= $row["Nama_Pemilik"]; ?></td>
            <td><?= $row["Nama_Toko"]; ?></td> 			
 			<td><?= $row["Email"]; ?></td>
 			<td><?= $row["Username"]; ?></td>
 			<td><?= $row["Pass"]; ?></td>
            <td><?= $row["Tlp"]; ?></td>
 			<td><?= $row["K_Pos"]; ?></td>
            <td><?= $row["Jln"]; ?></td>
            <td><?= $row["Gambar"]; ?></td>
            <td> 
                <a href="edit.php?id=<?= $row["id_Penjual"]; ?>">edit</a>
                <a href="hapus.php?id=<?= $row["id_Penjual"]; ?> " onclick="return confirm('Apakah anda yakin untuk menghapus data Mitra/Penjual yang bernama <?= $row["Nama_Pemilik"]; ?> ?');"> delete </a>
            </td>
 		</tr>
    <?php $a++  #Agar nambah?>
    <?php endforeach;?>
    </tbody>    
    </table>
</body>
</html>









