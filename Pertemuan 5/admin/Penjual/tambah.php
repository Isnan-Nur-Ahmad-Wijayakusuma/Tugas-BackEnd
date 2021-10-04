<?php  
//Memulai session
session_start();

//Kalo ada $_SESSION["login"], maka dibuat ketika user udah login & nek g enek, ditendang.
if (!$_SESSION["login"]) {
    header("Location: ../loginAdmin.php");
}

require 'Functions.php';

//Filter berhasil tidaknya user mendaftar
if(isset($_POST["kirim"])){
    if(tambahData($_POST) > 0){
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'admin.php';
              </script>";
    }else{
        echo mysqli_error($conn);
    }
}
else if(isset($_POST["batal"]) > 0){
    echo "<script>
        document.location.href = 'admin.php';
     </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body>
    <h1>Menambah user mitra/penjual</h1>
    <form action="" method="post">
        <fieldset>
            <table>
                <tr>
                    <td>Nama Pemilik</td>
                    <td><input type="text" name="Nama_Pemilik" ></td>
                </tr>
                <tr>
                    <td>Nama Toko</td>
                    <td><input type="text" name="Nama_Toko" ></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="Email" ></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="Username" ></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="Pass" ></td>
                </tr>
                <tr>
                    <td>Konfirmasi password</td>
                    <td><input type="password" name="Pass2" ></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="tel" name="Tlp" pattern="[0-9]{12}" ></td>
                </tr>
                <tr>
                    <td>Kode POS</td>
                    <td><input type="text" name="K_Pos" ></td>
                </tr>
                <tr>
                    <td>Jalan</td>
                    <td><input type="text" name="Jln" ></td>
                </tr>
                <tr>
                    <td>Foto toko</td>
                    <td><input type="file" name="Gambar" id="Gambar"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="batal">Batal</td>
                    <td></td>
                    <td><button type="submit" name="kirim">Daftar</td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>