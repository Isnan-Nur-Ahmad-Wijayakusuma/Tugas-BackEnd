<?php
//CATATAN:
# value HTML dinggo ngekeki ruh nk datane ngko dilebokne DB
//Memulai session
session_start();

//Kalo ada $_SESSION["login"], maka dibuat ketika user udah login & nek g enek, ditendang.
if (!isset($_SESSION["login"])) {
    header("Location: ../loginAdmin.php");
}

//Menghubungkan dengan halaman Functions.
require "Functions.php";

//Ambil data penjual berdasarkan id
$id_Penjual = $_GET["id"];

//Query data penjual berdasarkan id
#Panggil fungsi query. Ketika masuk Array rows, yg kita ambil langsung indeks ke-0 / elemen pertama
$seller = query("SELECT * FROM penjual WHERE id_Penjual = $id_Penjual")[0];	#Ini Array Numerik

//Ngecek tombol submit ws dipencet porung
#Apakah $_POS dengan keynya kirim apakah ada?
if(isset($_POST["kirim"])){
    
    //Cek datane iso diedit rung. Nk eror, nilai < 0 & sebaliknya.
    //Dikeki alert JS
    if(editData($_POST) > 0){
        echo "<script>
                alert('Data berhasil diubah');
                document.location.href = 'admin.php';
              </script>";
    }else{
        echo "<script>
                alert('Data gagal diubah');
                document.location.href = 'edit.php';
              </script>";
    }
}else if(isset($_POST["batal"]) > 0){
    echo "<script>
        document.location.href = 'admin.php';
     </script>";
}
?>
<!DOCTYPE html>
<html lang="in">
<head>
    <title>Edit data penjual</title>
</head>
<body>
    <h1>Edit data</h1>
    <form action="" method="post">
        <fieldset>
            <table>
            	<input type="hidden" name="id_Penjual" value="<?= $seller["id_Penjual"]; ?>"></input>
        
                <tr>
                    <td>Nama Pemilik</td>
                    <td><input type="text" name="Nama_Pemilik" value="<?= $seller["Nama_Pemilik"]; ?>"></td>
                </tr>
                <tr>
                    <td>Nama Toko</td>
                    <td><input type="text" name="Nama_Toko" value="<?= $seller["Nama_Toko"]; ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="Email" value="<?= $seller["Email"]; ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="Username" value="<?= $seller["Username"]; ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="Pass" value="<?= $seller["Pass"]; ?>"></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="tel" name="Tlp" pattern="[0-9]{12}" value="<?= $seller["Tlp"]; ?>"></td>
                </tr>
                <tr>
                    <td>Kode POS</td>
                    <td><input type="text" name="K_Pos" value="<?= $seller["K_Pos"]; ?>"></td>
                </tr>
                <tr>
                    <td>Jalan</td>
                    <td><input type="text" name="Jln" value="<?= $seller["Jln"]; ?>"></td>
                </tr>
                <tr>
                    <td>Foto Toko</td>
                    <td><input type="file" name="Gambar" value="<?= $seller["Gambar"]; ?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="batal">Cancel</td>
                        <td></td>
                    <td><button type="submit" name="kirim">Edit Data</td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>