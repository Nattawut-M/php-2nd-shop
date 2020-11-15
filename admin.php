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

	<!-- CSS -->
	<link rel="stylesheet" href="css/admin.css">

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
		<h1>
			ยินดีต้อนรับ ADMIN : <?php echo "<mark>#{$_SESSION['login_id']} {$_SESSION['login_fname']} {$_SESSION['login_lname']} ({$_SESSION['login_username']})</mark>"; ?> 
		</h1>

		<hr>

		<div class="row d-flex flex-row justify-content-around d-flex align-items-start">
			<!-- ผู้ใช้ทั้งหมด (User) -->
			<div class="col">
				<div class="card">
					<h5 class="card-header text-white bg-dark">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill mt-2 mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
						</svg>
						จำนวนผู้ใช้ทั้งหมด &nbsp;:&nbsp;  <?php echo "xx คน - php" ?>
						
					</h5>
					<div class="card-body">
						<h6 class="card-title">ผู้ใช้มีทั้งหมด 2 ประเภท</h6>
							<p class="card-text px-2">
								<b>ผู้ใช้งานทั่วไป&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo "xx คน - php" ?>
							</p>
							<p class="card-text px-2">
								<b>ผู้ดูแลระบบ&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo "xx คน - php" ?>
							</p>

							<hr>

							<!-- progress bar -->

							<!-- all -->
							<p>ทั้งหมด 2 ประเภท : <?php echo "10" ?></p>
							<div class="progress progress-all">
								<div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "70" ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">ผู้ใช้ทั่วไป <?php echo "7" ?></div>
								<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "30" ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">ผู้ดูแลระบบ <?php echo "3" ?></div>
							</div>
							
							<!-- notebook -->
							<p>ประเภท &nbsp : &nbsp ผู้ใช้ทั่วไป <?php echo "7" ?></p>
							<div class="progress">
								<div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "70" ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">ผู้ใช้ทั่วไป <?php echo "7" ?></div>
							</div>

							<!-- notebook -->
							<p>ประเภท &nbsp : &nbsp ผู้ดูแลระบบ <?php echo "3" ?></p>
							<div class="progress">
								<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "30" ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">ผู้ดูแลระบบ <?php echo "3" ?></div>
							</div>

						<!-- button -->
						<a href="#" class="btn btn-primary my-3 w-100">จัดการผู้ใช้ระบบ</a>
					</div>
				</div>
			</div>


			<!-- สินค้าทั้งหมด (Product) -->
			<div class="col">
				<div class="card">
					<h5 class="card-header text-white bg-dark">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart4 mt-2 mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
						</svg>
						จำนวนสินค้าทั้งหมด &nbsp;:&nbsp;  <?php echo "xx คน - php" ?>
					</h5>
					<div class="card-body">
						<h6 class="card-title">สินค้ามีทั้งหมด 3 ประเภท</h6>
							<p class="card-text px-2">
								<b>ประเภทยานพาหนะ&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo "xx คน - php" ?>
							</p>
							<p class="card-text px-2">
								<b>ประเภทสมาร์ทโฟน&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo "xx คน - php" ?>
							</p>
							<p class="card-text px-2">
								<b>ประเภทโน้ตบุ๊ค&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo "xx คน - php" ?>
							</p>

							<hr>

							<!-- progress bar -->
							<p>ทั้งหมด 3 ประเภท  : <?php echo "10" ?> ชิ้น</p>
							<!-- all -->
							<div class="progress progress-all">
								<div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "50" ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">ยานพาหนะ : <?php echo "5" ?></div>
								<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "20" ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">สมาร์ทโฟน : <?php echo "2" ?></div>
								<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "30" ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">โน้ตบุ๊ค : <?php echo "3" ?></div>
							</div>

							<!-- vehicle -->
							<p>ประเภท &nbsp : &nbsp ยานพาหนะ : <?php echo "5" ?> ชิ้น</p>
							<div class="progress">
								<div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "50" ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">ยานพาหนะ</div>
							</div>

							<!-- smartphone -->
							<p>ประเภท &nbsp : &nbsp สมาร์ทโฟน : <?php echo "2" ?> ชิ้น</p>
							<div class="progress">
								<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "20" ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">สมาร์ทโฟน</div>
							</div>

							<!-- notebook -->
							<p>ประเภท &nbsp : &nbsp โน้ตบุ๊ค : <?php echo "3" ?> ชิ้น</p>
							<div class="progress">
								<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "30" ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">โน้ตบุ๊ค</div>
							</div>
						<a href="#" class="btn btn-primary my-3 w-100">จัดการสินค้า</a>
					</div>
				</div>
			</div>
		</div>

	</section>
</body>
</html>