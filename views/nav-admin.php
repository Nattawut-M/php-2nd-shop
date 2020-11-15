<!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand d-flex flex-row justify-content-around align-items-center" href="admin.php">
				<img src="./images/logo-admin.png" width="50" height="50" class="d-inline-block mr-2" alt="" loading="lazy">
				2nd Shop
			</a>
			
			<a href="index.php" class="btn btn-light">หน้า index</a>

			<ul class="nav navbar-nav ">
				<li class="nav-item">
					<a class="nav-link" href="admin.php">หน้าแอดมิน (Home)</a>
				</li>
	
				<li class="nav-item">
					<a class="nav-link" href="admin-m-user.php">จัดการผู้ใช้ (Users)</a>
				</li>
	
				<li class="nav-item">
					<a class="nav-link" href="admin-m-product.php">จัดการสินค้า (Product) </a>
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
								<a  class="dropdown-item" href="logout.php" 
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