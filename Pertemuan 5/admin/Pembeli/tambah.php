<?php 
//Memulai session
session_start();

//Kalo ada $_SESSION["login"], maka user bisa memasuki halaman ini & kalo tidak ada, ditendang.
if (!isset($_SESSION["login"])) {
    header("Location: ../loginAdmin.php");
}

require 'Functions.php';

//Filter berhasil tidaknya admin menambahkan data
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
    <title>Register Page</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="Nama" ></td>
                </tr>
                <tr>
                    <td>Gender(L/P)</td>
                    <td><input type="txt" name="Gender" pattern="[L,P]{1}"  ></td>
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
                    <td><input type="text" name="K_Pos" pattern="[0-9]{5}" ></td>
                </tr>
                <tr>
                    <td>Jalan</td>
                    <td><input type="text" name="Jln" ></td>
                </tr>
                <tr>
                    <td><button type="submit" name="batal">Batal</td>
                    <td></td>
                    <td><button type="submit" name="kirim">Tambah</td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>