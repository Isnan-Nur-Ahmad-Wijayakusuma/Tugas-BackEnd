<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../loginAdmin.php");
  exit;
}
//Menghubungkan dengan halaman Functions.
require "Functions.php";
$pembeli = query("SELECT * FROM pembeli");

//tombol cari diklik
if(isset($_POST["find"])){
    $pembeli = cariData($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Page</title>
</head>
<body>
    <a href="../logout.php">LOGOUT</a><br>
    <h1>Daftar Pembeli</h1>
    
    <a href="../Penjual/admin.php">Data Penjual</a>
    <br><br>
    <form action="" method="post">
        <!-- autofocus = langsung ngetik tanpa klik. autocomplet = nulis ada historynya -->
        <input type="text" name="keyword" size="29.2" placeholder="cari berdasarkan keyword" autofocus autocomplete="off">
        <button type="submit" name="find">cari</button>
        
    </form><br><br>

    <a href="tambah.php">Tambah data user</a><br><br>
    
    <table border="1" cellspacing="1" cellpadding="7">
    <thead>
 		<tr>
            <th>No</th>
 			<th width="100" align="center">ID Pembeli</th>
            <th width="800" align="justify" valign="middle">Nama Lengkap</th>
            <th>Gender</th>
 			<th width="400" align="justify" valign="middle">Alamat Email</th>
 			<th width="250" align="left">Username</th>
 			<th>Password</th>
            <th width="220" align="left">Telepon</th>
 			<th width="150" align="left">Kode POS</th>
 			<th width="250" align="left">Nama Jalan</th>
            <th>Pengaturan</th>
 		</tr>
 	</thead>
    <tbody>
    <?php $a = 1;   #Untuk nomer?>
    <?php foreach($pembeli as $row):   #variabel $row yg digunakan dibawah?>
        <tr>
            <td><?= $a; ?></td>
 			<td align="center"><?= $row["id_Pembeli"]; ?></td>
            <td><?= $row["Nama"]; ?></td> 			
 			<td><?= $row["Gender"]; ?></td>		
 			<td><?= $row["Email"]; ?></td>
 			<td><?= $row["Username"]; ?></td>
 			<td><?= $row["Pass"]; ?></td>
            <td><?= $row["Tlp"]; ?></td>
 			<td><?= $row["K_Pos"]; ?></td>
            <td><?= $row["Jln"]; ?></td>
            <td> 
                <a href="edit.php?id=<?= $row["id_Pembeli"]; ?>">edit</a>
                <a href="hapus.php?id=<?= $row["id_Pembeli"]; ?> " onclick="return 
                confirm('Apakah anda yakin untuk menghapus data Customer yang bernama  <?= $row["Nama"]; ?> ?');"> delete </a>
            </td>
 		</tr>
    <?php $a++  #Agar nambah?>
    <?php endforeach;?>
    </tbody>    
    </table>
    <?php 
    //Disimpan di variabel $pembeli.
#Tampilkan seluruh data pembeli, tp urutkan dari yang terbaru.
#ORDER BY = urutkan dr. ASC = Ascending.

    ;?>

</body>
</html>









