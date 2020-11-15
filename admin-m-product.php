<?php
	require_once('model/connection.php');
	require_once('views/bootstrap4.php');

	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>

    <style>
        img#img-product {
            max-width: 8rem;
            max-height: fit-content;
        }
    </style>
</head>
<body>
    <!-- Navber -->
    <?php require_once('views/nav-admin.php') ?>

    <!-- Section -->
    <section class="container my-4">

        <h1>Product Management</h1>
        <div class="col mb-2">
            <a href="product-add.php" class="btn btn-success">เพิ่มสินค้า</a>
        </div>
		<table class="table table-bordered table-hover">
			<thead class="bg-primary text-white">
				<tr>
					<th scope="col-1">#</th>
					<th scope="col-1">ชื่อสินค้า</th>
					<th scope="col-1">ประเภท</th>
					<th scope="col-4">รายละเอียด</th>
					<th scope="col-1">ราคา</th>
					<th scope="col-1">เวลาลงขาย</th>
					<th scope="col-2">รูปภาพ</th>
					<th scope="col-1">จัดการ</th>
				</tr>
			</thead>
			<tbody>
                <?php 
                    $query = $db->prepare("SELECT * FROM 2ndshop.tb_product ORDER BY pd_id ASC"); 
                    $query->execute();
                    $countIndex = 0;
                ?>

                <?php while($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td class=""><?php echo ++$countIndex ?></td>
                        <td class=""><?php echo $row['pd_name'] ?></td>
                        <td class=""><?php echo $row['type_id'] ?></td>
                        <td class=""><?php echo $row['pd_detail'] ?></td>
                        <td class=""><?php echo $row['pd_price'] ?></td>
                        <td class=""><?php echo $row['pd_timestamp'] ?></td>
                        <td class=""><img src="upload/<?php echo $row['pd_img'] ?>" alt="product-db" id="img-product"></td>
                        <td class="mx-1">
                            <div class="row ">
                                <div class="col d-flex justify-content-around">
                                <a href="product-edit.php?update_id=<?php echo $row['pd_id'] ?>" class="btn btn-warning mr-1">Edit</a>
                                <a href="product-delete.php?delete_id=<?php echo $row['pd_id'] ?>" class="btn btn-danger">delete</a>
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