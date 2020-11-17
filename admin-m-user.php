<?php
	require_once('model/connection.php');
	require_once('views/bootstrap4.php');

	session_start();

		// เช็คสถานะ admin 
	if ($_SESSION['login_role'] != '2') { // ถ้าไม่ใช่สถานะ admin
		header("refresh:0;login.php");	
	}

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
	
	<!-- Section -->
    <section class="container my-4">
        <h1>User Management</h1>
        <div class="col mb-4">
            <a href="product-add.php" class="btn btn-success">เพิ่มผู้ใช้งาน</a>
        </div>
		<table class="table table-sm table-bordered table-hover">
			<thead class="bg-primary text-white">
				<tr>
					<th scope="col" class="py-2 px-2 text-center">#</th>
					<th scope="col" class="py-2 px-2">ชื่อผู้ใช้</th>
					<th scope="col" class="py-2 px-2">ชื่อ username</th>
					<th scope="col" class="py-2 px-2">รหัสผ่าน</th>
					<th scope="col" class="py-2 px-2">Mail</th>
					<th scope="col" class="py-2 px-2">ประเภท</th>
					<th scope="col" class="py-2 px-2 text-center">จัดการ</th>
				</tr>
			</thead>
			<tbody>
                <?php 
                    $query = $db->prepare("SELECT * FROM 2ndshop.tb_users ORDER BY user_id DESC"); 
                    $query->execute();
                    $countIndex = 0;
                ?>

                <?php while($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td class="text-center"><?php echo ++$countIndex ?></td>
                        <td class=""><?php echo "{$row['user_fname']} {$row['user_lname']}"?></td>
                        <td class=""><?php echo $row['user_username'] ?></td>
                        <td class=""><?php echo $row['user_password'] ?></td>
                        <td class=""><?php echo $row['user_email'] ?></td>
                        <td class=""><?php echo ($row['role_id'] == '2') ? "admin" : "user" ?></td>
                        <td class="mx-1">
                            <div class="row ">
                                <div class="col d-flex justify-content-around">
									<a href="admin-m-product-edit.php?update_id=<?php echo $row['pd_id'] ?>" class="btn btn-sm btn-warning mr-1">Edit</a>
									<a href="admin-m-product-delete.php?delete_id=<?php echo $row['pd_id'] ?>" class="btn btn-sm btn-danger">delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
			</tbody>
		</table>
        
    </section>
</body>
</html>