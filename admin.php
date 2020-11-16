<?php
	require_once('model/connection.php');
	require_once('views/bootstrap4.php');

	session_start();
	
		// เช็คสถานะ admin 
	if ($_SESSION['login_role'] != '2') { // ถ้าไม่ใช่ admin
		header("location:index.php");
	} 
	// Query from database
	$user_query = $db->prepare("SELECT user_id, role_id FROM 2ndshop.tb_users");
	$user_query->execute();
	// count
	$countAllUsers = $user_query->rowCount();
	$countUser = 0;
	$countAdmin = 0;
	// fetch data
	while ($rowUser = $user_query->fetch(PDO::FETCH_ASSOC)) {
		if ($rowUser['role_id'] == '1') {
			$countUser++;
		} else if ($rowUser['role_id'] == '2') {
			$countAdmin++;
		}
	}

	// Query from database
	$product_query = $db->prepare("SELECT type_id FROM 2ndshop.tb_product");
	$product_query->execute();
	// count
	$countAllProduct = $product_query->rowCount();
	$countVehicle = 0;
	$countSmartphone = 0;
	$countNotebook = 0;
	// fetch data
	while ($rowProduct = $product_query->fetch(PDO::FETCH_ASSOC)) {
		if ($rowProduct['type_id'] == '1') {
			$countVehicle++;
		} else if ($rowProduct['type_id'] == '2') {
			$countSmartphone++;
		} else if ($rowProduct['type_id'] == '3') {
			$countNotebook++;
		}
	}
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
	<?php require_once('views/nav-admin.php') ?>

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
						ผู้ใช้ทั้งหมด
						
					</h5>
					<div class="card-body">
						<h6 class="card-title">จำนวนผู้ใช้ทั้งหมด &nbsp;:&nbsp;  <?php echo $countAllUsers ?> &nbsp; คน แบ่งได้ 2 ประเภท</h6>
						<p class="card-text px-2">
							<b>1. ผู้ใช้งานทั่วไป&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo $countUser ?>
						</p>
						<p class="card-text px-2">
							<b>2. ผู้ดูแลระบบ&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo $countAdmin ?>
						</p>

						<hr>

						<!-- progress bar -->
						<!-- all -->
						<p>ทั้งหมด 2 ประเภท</p>
						<div class="progress progress-all">
							<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countUser * (100/$countAllUsers) ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">ผู้ใช้ทั่วไป : <?php echo $countUser ?></div>
							<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countAdmin * (100/$countAllUsers) ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">ผู้ดูแลระบบ : <?php echo $countAdmin ?></div>
						</div>
						
						<!-- notebook -->
						<p>ประเภท &nbsp : &nbsp ผู้ใช้ทั่วไป <?php echo $countUser ?> คน</p>
						<div class="progress">
							<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "70" ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"><?php echo "ผู้ใช้ทั่วไป" ?></div>
						</div>

						<!-- notebook -->
						<p>ประเภท &nbsp : &nbsp ผู้ดูแลระบบ <?php echo $countAdmin ?> คน</p>
						<div class="progress">
							<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo "30" ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"><?php echo "ผู้ดูแลระบบ" ?></div>
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
						สินค้าทั้งหมด
					</h5>
					<div class="card-body">
						<h6 class="card-title">จำนวนสินค้าทั้งหมด <?php echo $countAllProduct ?> รายการ แบ่งได้ 3 ประเภท</h6>
							<p class="card-text px-2">
								<b>1. ประเภทยานพาหนะ&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo $countVehicle ?>
							</p>
							<p class="card-text px-2">
								<b>2. ประเภทสมาร์ทโฟน&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo $countSmartphone ?>
							</p>
							<p class="card-text px-2">
								<b>3. ประเภทโน้ตบุ๊ค&nbsp;&nbsp;:&nbsp;&nbsp;</b>  <?php echo $countNotebook ?>
							</p>

							<hr>

							<!-- progress bar -->
							<p>ทั้งหมด 3 ประเภท  : <?php echo $countAllProduct ?> รายการ</p>
							<!-- all -->
							<div class="progress progress-all">
								<div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countVehicle * (100/$countAllProduct) ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">ยานพาหนะ : <?php echo $countVehicle ?></div>
								<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countSmartphone * (100/$countAllProduct) ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">สมาร์ทโฟน : <?php echo $countSmartphone ?></div>
								<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countNotebook * (100/$countAllProduct) ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">โน้ตบุ๊ค : <?php echo $countNotebook ?></div>
							</div>

							<!-- vehicle -->
							<p>ประเภท &nbsp : &nbsp ยานพาหนะ : <?php echo $countVehicle ?> รายการ</p>
							<div class="progress">
								<div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countVehicle * (100/$countAllProduct) ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">ยานพาหนะ</div>
							</div>

							<!-- smartphone -->
							<p>ประเภท &nbsp : &nbsp สมาร์ทโฟน : <?php echo $countSmartphone ?> รายการ</p>
							<div class="progress">
								<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countSmartphone * (100/$countAllProduct) ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">สมาร์ทโฟน</div>
							</div>

							<!-- notebook -->
							<p>ประเภท &nbsp : &nbsp โน้ตบุ๊ค : <?php echo $countNotebook ?> รายการ</p>
							<div class="progress">
								<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $countNotebook * (100/$countAllProduct) ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">โน้ตบุ๊ค</div>
							</div>
						<a href="admin-m-product.php" class="btn btn-primary my-3 w-100">จัดการสินค้า</a>
					</div>
				</div>
			</div>
		</div>

	</section>
</body>
</html>