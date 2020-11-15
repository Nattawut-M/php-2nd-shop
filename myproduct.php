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
      <div class="col">
         <a href="product-add.php" class="btn btn-success">เพิ่มสินค้า</a>
      </div>
      <table class="table table-bordered table-hover my-3">
         <thead class="thead-dark">
            <tr  class="">
               <th scope="col">ชื่อสินค้า</th>
               <th scope="col">รายละเอียด</th>
               <th scope="col">ราคา</th>
               <th scope="col">รูปภาพ</th>
               <th scope="col">จัดการ</th>
            </tr>
         </thead>
         <tbody>
            <?php 
               $query = $db->prepare("SELECT * FROM 2ndshop.tb_product WHERE user_id = :user_id ORDER BY pd_id DESC"); 
               $query->execute([':user_id' => $_SESSION['login_id']]);
            ?>

            <?php while($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
               <tr>
                  <td class=""><?php echo $row['pd_name'] ?></td>
                  <td class=""><?php echo $row['pd_detail'] ?></td>
                  <td class=""><?php echo $row['pd_price'] ?></td>
                  <td class=""><img src="upload/<?php echo $row['pd_img'] ?>" alt="" width="100px" height="100px"></td>
                  <td class="mx-1">
                     <div class="row ">
                        <div class="col d-flex justify-content-around">
                           <a href="product-edit.php?update_id=<?php echo $row['pd_id'] ?>" class="btn btn-warning">Edit</a>
                           <a href="product-delete.php?delete_id=<?php echo $row['pd_id'] ?>" class="btn btn-danger">delete</a>
                        </div>
                     </div>
                  </td>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</body>
</html>