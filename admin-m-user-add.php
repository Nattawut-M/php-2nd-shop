<?php
	require_once('views/bootstrap4.php');
	require_once('model/connection.php');
	
	session_start();

	if (isset($_POST['btnSubmitNewUser'])) {
		$fname = $_POST['inputFname'];
		$lname = $_POST['inputLname'];
		$username = $_POST['inputUsername'];
		$password1 = $_POST['inputPassword1'];
		$password2 = $_POST['inputPassword2'];
		$email = $_POST['inputEmail'];
		$role = $_POST['roleUser'];
		if ($password1 != $password2) {
			$msg = '<div class="alert alert-danger text-center">รหัสผ่านไม่ตรงกัน</div>';
		} else {

		try {
			$query = $db->prepare(
				"INSERT INTO 2ndshop.tb_users (user_fname, user_lname, user_username, user_password, user_email, role_id) 
				VALUES (:fname, :lname, :username, :password, :email, :role_id)"
			);

			$result = $query->execute([
				':fname' => $fname, ':lname' => $lname,
				':username' => $username, ':password' => $password2,
				':email' => $email, ':role_id' => $role
			]);
			
			if (!$result) {
				$msg = '<div class="alert alert-danger text-center">something went wrong</div>';
			} else {
				$msg = '<div class="alert alert-success text-center">register successfully</div>';
				header("refresh:1;admin-m-user.php");
			}

		} catch (PDOException $err) {
			echo $err->getMessage();
		}

		} /* {} if-else (check password) */
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ADD USER</title>
	<link rel="stylesheet" href="css/register.css">
</head>
<body>
	<?php require_once('views/nav.php'); ?>

	<section class="container my-5 py-5">
		<div class="row"> 

			<div class="col-6 align-self-center" id="col-img">
				<img src="images/register.jpg" alt="" class="img-fluid">
			</div> <!-- col-img -->

			<div class="col-6 pr-5" id="col-register">
				<h1><strong>เพิ่มผู้ใช้งานใหม่</strong></h1>

			<!-- form register -->
			<form action="" method="post"> 
				<div class="form-row"> 
					<div class="col-6"> <!-- first name -->
						<label for="inputFname">First name</label>
						<input type="text" class="form-control" name="inputFname" id="inputFname" placeholder="First Name" required>
					</div>
					<div class="col-6"> <!-- last name -->
						<label for="inputLname">Last name</label>
						<input type="text" class="form-control" name="inputLname" id="inputLname" placeholder="Last Name" required>
					</div>
				</div> <!-- form-row  -->

				<div class="form-row">
					<div class="col">
						<label for="inputUsername">Username</label>
						<input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="Username" required>
					</div>
				</div>
				
				<div class="form-row"> 
					<div class="col-6"> <!-- first name -->
						<label for="inputPassword1">Password</label>
						<input type="password" class="form-control" name="inputPassword1" id="inputPassword1" placeholder="Password" required>
					</div>
					<div class="col-6"> <!-- last name -->
						<label for="inputPassword2">Confirm Password</label>
						<input type="password" class="form-control" name="inputPassword2" id="inputPassword2" placeholder="Confirm Password" required>
					</div>
				</div> <!-- form-row  -->

				<div class="form-row">
					<div class="col"> <!-- email -->
						<label for="inputEmail">Email</label>
						<input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="E-mail" required>
					</div>
				</div>

				<div class="form-row">
					<label for="roleUser">ประเภทของผู้ใช้</label>
					<select class="custom-select" name="roleUser" id="roleUser">
						<option value="1">User (ผู้ใช้ทั่วไป)</option>
						<option value="2">Admin (ผู้ดูแลระบบ)</option>
					</select>
				</div>
				
				<button type="submit" name="btnSubmitNewUser" class="btn orange-light mt-3 w-100">เพิ่มผู้ใช้</button>
			</form> <!-- form -->

				<?php if (isset($msg)) {
					echo $msg;
				} ?>
			</div> <!-- col-register -->
		</div> <!-- row (img+register) -->
	</section>
</body>
</html>