<?php
//CATATAN:
# value HTML untuk memberitahu jika datanya nanti dimasukkan DB
//Memulai session
session_start();

//Kalo ada $_SESSION["login"], maka user bisa memasuki halaman ini & kalo tidak ada, ditendang.
if (!isset($_SESSION["login"])) {
    header("Location: ../loginAdmin.php");
}

//Menghubungkan dengan halaman Functions.
require "Functions.php";

//Ambil data pembeli berdasarkan id
$id_Pembeli = $_GET["id"];

//Query data pembeli berdasarkan id
#Panggil fungsi query. Ketika masuk Array rows, yg kita ambil langsung indeks ke-0 / elemen pertama
$cust = query("SELECT * FROM pembeli WHERE id_Pembeli = $id_Pembeli")[0];	#Ini Array Numerik

//Mengecek tombol submit udah diklik atau blm?
#Apakah $_POS dengan keynya kirim apakah ada?
if(isset($_POST["kirim"])){
    
    //Cek datanya bisa diedit atau nggak. Jika eror, nilai < 0 & sebaliknya.
    //Diberi alert JS
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
    <title>Edit data pembeli</title>
</head>
<body>
    <h1>Tambah DATA Pembeli</h1>
    <form action="" method="post">
        <fieldset>
            <table>
            	<input type="hidden" name="id_Pembeli"  value="<?= $cust["id_Pembeli"]; ?>"></input>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="tel" name="Tlp" pattern="[0-9]{12}" value="<?= $cust["Tlp"]; ?>"></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="Nama" pattern="[a-zA-Z\s']{1,40}" value="<?= $cust["Nama"]; ?>"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><input type="text" name="Gender" value="<?= $cust["Gender"]; ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="Email" value="<?= $cust["Email"]; ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="Username" value="<?= $cust["Username"]; ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="Pass" value="<?= $cust["Pass"]; ?>"></td>
                </tr>
                <tr>
                    <td>Kode POS</td>
                    <td><input type="text" name="K_Pos" minlength="5" pattern="[0-9]{5}" value="<?= $cust["K_Pos"]; ?>"></td>
                </tr>
                <tr>
                    <td>Jalan</td>
                    <td><input type="text" name="Jln" value="<?= $cust["Jln"]; ?>"></td>
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