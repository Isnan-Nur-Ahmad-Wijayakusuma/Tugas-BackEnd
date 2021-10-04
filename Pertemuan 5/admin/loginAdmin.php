<?php 
//Memulai session
session_start();

if (isset($_SESSION["login"])) {
  header("Location: Pembeli/admin.php");
  exit;
}

require "fungsiAdmin.php";
if (isset($_POST["login"])) {
	$Username = $_POST["Username"];
	$Pass = $_POST["Pass"];

	#ada atau tdknya username di DB yg sama dengan inputannya
	$result = mysqli_query($conn, "SELECT*FROM admin WHERE 
		      Username = '$Username'");

	#cek username. mysqli_num_rows = ada brp baris yg dikembalikan dr fungsi select
	if (mysqli_num_rows($result) === 1) {
		
		#cek passwordnya apakah sama
		$row = mysqli_fetch_assoc($result);
		#Parameternya ada 2 = String yg blm diacak & yg sudah
		if (password_verify($Pass, $row["Pass"])){
			
			//Setup session. Bikin var session dengan key 'login'
			$_SESSION["login"] = true;

			#direct to dashboard page as end user
			header("Location: Pembeli/admin.php");	
			exit;	
		}
	}$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<body>
	<h1><b>ADMIN Login</b></h1>

	<!-- Nek username/pass slh, iki dieksekusi -->
	<?php if(isset($error)) : ?>
		<p style=" color: red; font-style: italic; ">username atau password yang anda masukkan salah</p>
	<?php endif; ?>
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
				    <td><button type="submit" name="login">login</td>
			    </tr>
        	</table>
        </fieldset>
	</form>

</body>
</html>