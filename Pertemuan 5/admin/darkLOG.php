<?php  
require 'fungsiAdmin.php';

//Filter berhasil tidaknya user mendaftar
if(isset($_POST["kirim"])){
    if(registrasi($_POST) > 0){
        echo "
        <script>
            alert('Berhasil mendaftar!');
            document.location.href = 'loginAdmin.php';
        </script>
    ";
    }else{
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ADMIN Register Page</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <table>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="Name" required></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="Username" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="Pass" required></td>
                </tr>
                <tr>
                    <td>Konfirmasi password</td>
                    <td><input type="password" name="Pass2" required></td>
                </tr>
                <tr>
                    <td><button type="submit" name="kirim" required>Daftar</td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>