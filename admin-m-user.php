<?php
	require_once('model/connection.php');
	require_once('views/bootstrap4.php');

	session_start();
	
	// เช็คสถานะ login
	if (!isset($_SESSION['login'])) {
		header("location:login.php");
	}
	
		// เช็คสถานะ admin 
	if ($_SESSION['login_role'] != '2') { // ถ้าไม่ใช่ admin
		
			// ถ้ายังไม่ได้ login ให้ redirect ไปที่หน้า login
		if (!isset($_SESSION['login'])) { 
			header("location:login.php");
		
			// ถ้า login แล้วให้ redirect ไปที่หน้า index
		} else { 
			header("location:admin-panel.php");
		}
		
	} /* {if-else} เช็คสถานะ login */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <!-- Navbar -->
    <?php require_once('views/nav-admin.php') ?>
</body>
</html>