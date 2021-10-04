<?php 
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();
	header("Location: ../../VisitorPage/user_Page/Login.php");
	exit;
?>
