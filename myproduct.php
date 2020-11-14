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
   <title>My Product</title>
</head>
<body>
   <?php require_once('views/nav.php'); ?>

   <div class="container">
      <h1>My Product</h1>
      <table class="table my-3">
         <thead>
            <tr  class="bg-primary text-white">
               <th scope="col">ชื่อสินค้า</th>
               <th scope="col">รายละเอียด</th>
               <th scope="col">เวลาลงขาย</th>
               <th scope="col">รูปภาพ</th>
               <th scope="col">จัดการ</th>
            </tr>
         </thead>
         <tbody>
            <?php 
               $query = $db->query("SELECT * FROM 2ndshop.tb_product ORDER BY pd_id DESC"); 
            ?>

            <?php while($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
               <tr>
                  <td><?php echo $row['pd_name'] ?></td>
                  <td><?php echo $row['pd_detail'] ?></td>
                  <td><?php echo $row['pd_price'] ?></td>
                  <td><img src="upload/<?php echo $row['pd_img'] ?>" alt="" width="100px" height="100px"></td>
                  <td>
                     <a href="product-edit.php" class="btn btn-warning">Edit</a>
                     <a href="product-edit.php" class="btn btn-danger">delete</a>
                  </td>
               </tr>
            <?php } ?>
         </tbody>
         </table>
   </div>
</body>
</html>