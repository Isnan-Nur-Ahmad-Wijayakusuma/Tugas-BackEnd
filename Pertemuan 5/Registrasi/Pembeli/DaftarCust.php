<?php  
require 'Functions.php';

//Filter berhasil tidaknya user mendaftar
if(isset($_POST["kirim"])){
    if(registrasi($_POST) > 0){
        echo "<script>
                alert('Selamat, registrasi anda berhasil!');
              </script>";
    }else{
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Register Customer</title>
    <link rel="stylesheet" type="text/css" href="Hias.css">
</head>
<body>
    <div class="header">
      <div class="header-logo"><a href="../../VisitorPage/user_Page/index.php" style = "color: #6e5ae6; text-decoration: none;">WARCAF</a></div>
      <div class="header-list">
        <ul>
			<a href="../../VisitorPage/user_Page/Login.php" style = "color: #1e0731;"><li>LOGIN</li></a>
			<a href="../../VisitorPage/user_Page/contact.html" style = "color: #1e0731;"><li>Contact</li></a>
			<a href="../../VisitorPage/user_Page/blog.html" style = "color: #1e0731;"><li>Blog</li></a>
			<a href="../../VisitorPage/user_Page/service.html" style = "color: #1e0731;"><li>Service</li></a>
			<a href="../../VisitorPage/user_Page/about.html" style = "color: #1e0731;"><li>About</li></a>
			<a href="../../VisitorPage/user_Page/index.php" style = "color: #1e0731;"><li>Home</li></a>
        </ul>
      </div>
    </div>
    <h1>Registrasi customer</h1>
    <form action="" method="post">
        <fieldset>
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="Nama" placeholder="nama lengkap" required></td>
                </tr>
                <tr>
                    <td>Gender(L/P)</td>
                    <td><input type="txt" name="Gender" pattern="[L,P]{1}" placeholder="ketik L atau P" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="Email" placeholder="email@warcaf.com" required></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="Username" placeholder="berisi karakter bebas" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="Pass" placeholder="kata sandi" required></td>
                </tr>
                <tr>
                    <td>Konfirmasi password</td>
                    <td><input type="password" name="Pass2" placeholder="validasi kata sandi" required></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="tel" name="Tlp" pattern="[0-9]{12}" placeholder="085755904707"required></td>
                </tr>
                <tr>
                    <td>Kode POS</td>
                    <td><input type="text" name="K_Pos" pattern="[0-9]{5}" placeholder="berisi 5 angka" required></td>
                </tr>
                <tr>
                    <td>Jalan</td>
                    <td><input type="text" name="Jln" placeholder="alamat jalan" required></td>
                </tr>
                <tr>
                    <td><button type="submit" name="kirim">Daftar</td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>