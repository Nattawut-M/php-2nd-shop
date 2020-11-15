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
	<title>Admin</title>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand d-flex flex-row justify-content-around align-items-center" href="admin.php">
				<img src="./images/logo-admin.png" width="50" height="50" class="d-inline-block mr-2" alt="" loading="lazy">
				2nd Shop
			</a>
	
			<ul class="nav navbar-nav ">
				<li class="nav-item">
					<a class="nav-link" href="index.php">หน้าแรก (Home)</a>
				</li>
	
				<li class="nav-item">
					<a class="nav-link" href="#">จัดการผู้ใช้ (Users)</a>
				</li>
	
				<li class="nav-item">
					<a class="nav-link" href="#">จัดการสินค้า (Product) </a>
				</li>
	
				<li class="nav-item">
					<?php if ($_SESSION['login']) {  ?> 
						<!-- เมื่อมีการ login (เช็คได้จาก $_SESSION['login'])  -->
						<div class="btn-group">
							<a href="profile.php" class="btn btn-primary pr-2"> <!-- display username -->
							สวัสดี <b>ADMIN</b> &nbsp; <u><?php echo $_SESSION['login_username'] ?></u>
							</a>
							<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
							</button> 
							<div class="dropdown-menu">
								<a 
									class="dropdown-item" href="product-add.php" 
									onMouseOver="this.style.backgroundColor='#0275d8'" 
									onMouseOut="this.style.backgroundColor='#f7f7f7'">
									<!-- javascript Over = hover, Out = not hover -->
									ลงประกาศขาย 
								</a>
								<a 
									class="dropdown-item" href="edit-profile.php" 
									onMouseOver="this.style.backgroundColor='#f0ad4e'" 
									onMouseOut="this.style.backgroundColor='#f7f7f7'">
									<!-- javascript Over = hover, Out = not hover -->
									แก้ไขโปรไฟล์ 
								</a>
								<a 
									class="dropdown-item" href="logout.php" 
									onMouseOver="this.style.backgroundColor='#d9534f'" 
									onMouseOut="this.style.backgroundColor='#f7f7f7'">
									<!-- javascript Over = hover, Out = not hover -->
									ออกจากระบบ 
								</a>
							</div>
						</div>

					<?php } else { ?>
						<!-- เมื่อไม่ได้มีการ login (เช็คได้จาก $_SESSION['login']) -->
						<a class="btn btn-outline-light mx-0" href="login.php">เข้าสู่ระบบ (Login)</a>
					<?php } ?>
				</li>
	
			</ul>
		</div>
	</nav>

	<section class="container my-3">
		<!-- display fullname and username of admin -->
		<h1>ยินดีต้อนรับ ADMIN : <?php echo "<mark> {$_SESSION['login_fname']} {$_SESSION['login_lname']} ({$_SESSION['login_username']})</mark>"; ?> </h1>

		
	</section>
</body>
</html>