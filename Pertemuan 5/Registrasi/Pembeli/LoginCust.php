<?php 
//Memulai session
session_start();

if (isset($_SESSION["login"]) > 0) {
	header("Location: ../../ActivePage/User_Page");
	exit;
}

require "Functions.php";
if (isset($_POST["login"])) {
	$Username = $_POST["Username"];
	$Pass = $_POST["Pass"];

	#ada atau tdknya username di DB yg sama dengan inputannya
	$result = mysqli_query($conn, "SELECT*FROM pembeli WHERE 
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
			header("Location: ../../ActivePage/User_Page");		
			exit;
		}
	}$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Customer</title>
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
    
	<h1><b>Login customer</b></h1>

	<!-- Nek username/pass slh, iki dieksekusi -->
	<?php if(isset($error)) : ?>
		<p style=" color: red; font-style: italic; ">username atau password yang anda masukkan salah</p>
	<?php endif; ?>
	<form action="" method="post">
		<fieldset>
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="Email" required></td>
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