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
			header("location:index.php");
		}
		
	} /* {if-else} เช็คสถานะ login */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-dark bg-dark">
		<a class="navbar-brand d-flex flex-row justify-content-around align-items-center" href="admin-panel.php">
			<img src="./images/logo-admin.png" width="50" height="50" class="d-inline-block mr-2" alt="" loading="lazy">
			2nd Shop
		</a>

		<ul class="navbar-nav navbar-collapse">
		<div class="navbar-nav">
			<a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
			<a class="nav-link" href="#">Features</a>
			<a class="nav-link" href="#">Pricing</a>
			<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
		</div>
		</ul>
	</nav>

	<section class="container">
		<h1>Admin Panel</h1>
		<pre>
			<?php 
				print_r($_SESSION);
			?>
		</pre>

		<?php echo gettype($_SESSION['login_id']); ?>
	</section>
</body>
</html>