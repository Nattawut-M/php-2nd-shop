<?php
   require_once('model/connection.php');
   require_once('views/bootstrap4.php');
   session_start();

   /* check login */
   if (!isset($_SESSION['login'])) { 
      header("location: login.php");
   }

   // receive request from 'myproduct.php' via button 'edit'
   if (isset($_REQUEST['update_id'])) {
      try {
         $user_id = $_SESSION['login_id'];
         $update_id = $_REQUEST['update_id'];
         $query = $db->prepare("SELECT * FROM 2ndshop.tb_product WHERE pd_id = :id");
         $query->execute([':id' => $update_id]);
         $row = $query->fetch(PDO::FETCH_ASSOC);
         extract($row);
      } catch (PDOException $err) {
         echo $err->getMessage();
      }
   }

   // update form form 'this' (product-edit.php)
   if (isset($_REQUEST['btnUpdate'])) {
      try {

         $name = $_REQUEST['inputName'];
         $price = $_REQUEST['inputPrice'];
         $detail = $_REQUEST['inputDetail'];
         $type = $_REQUEST['typeProduct'];

         $img_name =  $_SESSION['login_id'] ."_"  .$_SESSION['login_username'] ."__" .$_FILES['inputImg']['name'];
         $img_type = $_FILES['inputImg']['type'];
         $img_size = $_FILES['inputImg']['size'];
         $img_tmp = $_FILES['inputImg']['tmp_name']; // inintial file stored

         $path = "upload/".$img_name; // file destination / new img name
         $directory ="upload/"; // old directory
         
         if ($img_name) { // ถ้ามีการเลือกรูป

            if (!file_exists($path)) {
               unlink($directory.$row['pd_img']); // remove previous file in directory (old file)
               move_uploaded_file($img_tmp, 'upload/'.$img_name); // insert new file instead

            } else {
               $msg = "files is already exists or Something (from Line: 36-38)";
               echo $msg;
            }

         } else {
            $img_name = $row['pd_img']; // ถ้าไม่ได้เลือกรูปใหม่ ให้ใช้รูปเดิม
         }

         if (!isset($msg)) { // ถ้าไม่มีข้อความ = ไม่มี error

            $query_update = $db->prepare(
               "UPDATE 2ndshop.tb_product SET 
               pd_name = :pd_name, 
               pd_detail = :pd_detail,
               pd_price = :pd_price,
               pd_img = :pd_img
               WHERE user_id = :user_id"
            );

            $result = $query_update->execute([
               ':pd_name' => $name,
               ':pd_detail' => $detail,
               ':pd_price' => $price,
               ':pd_img' => $img_name,
               ':user_id' => $_SESSION['login_id']
            ]); // if success return True, else Failure return False

            if ($result) {
               $updateMsg = '<div class="alert alert-success">อัพเดทสำเร็จ</div>';
               echo $updateMsg;
               header("refresh:1;myproduct.php");
            } else {
               $updateMsg = '<div class="alert alert-danger">มีปัญหา</div>';
               echo $updateMsg;
            }
         }

         
      } catch (PDOException $err) {
         echo $err->getMessage();
      }
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>
   <link rel="stylesheet" href="css/register.css">
</head>

<body>
<!-- Navbar -->
   <?php require_once('views/nav.php'); ?>

<!-- section -->
   <section class="container my-3 py-5">
      <div class="row"> 
      <!-- col img -->
         <div class="col-6 align-self-center" id="col-img">
            <img src="images/sell.jpg" alt="" class="img-fluid">
         </div> 
      <!-- col img end -->

      <!-- col input -->
         <div class="col-6 pr-5" id="col-register">
            <?php if (isset($msg)) {
                  echo '<div class="alert alert-danger">'. $msg .'</div>';
            } ?>
            <h2 class="mb-4">คุณต้องการลงประกาศขายอะไร?</h2>

         <!-- form -->
            <form action="" method="POST" enctype="multipart/form-data"> 
            <!-- ชื่อสินค้า -->
               <div class="form-row mb-3"> 
                  <div class="col">
                     <label for="inputName">ชื่อสินค้า</label>
                     <input type="text" class="form-control" name="inputName" id="inputName" value="<?php echo $row['pd_name'] ?>">
                  </div>
               </div>
            <!-- ราคา และ ประเภทสินค้า -->
               <div class="form-row mb-3">
                  <div class="col-6">
                     <label for="inputPrice">ราคา</label>
                     <input type="number" class="form-control" name="inputPrice" id="inputPrice" value="<?php echo $row['pd_price'] ?>">
                  </div>
                  <div class="col-6">
                     <label for="typeProduct">ประเภทของสินค้า</label>
                     <select class="custom-select" name="typeProduct" id="typeProduct">
                        <option value="1">Vehicle (ยานพาหนะ)</option>
                        <option value="2">Smartphone (สมาร์ทโฟน)</option>
                        <option value="3">Notebook (โน้ตบุ๊ค)</option>
                     </select>
                  </div>
               </div>

            <!-- รูปสินค้า -->
               <div class="form-row mt-4 mb-3">
                  <div class="col">
                     <div class="custom-file">
                        <label for="" class="mr-5">เลือกรูปสินค้า</label>
                        <input type="file" class="ml-3" id="customFile" name="inputImg">
                     </div>
                  </div>
               </div>

            <!-- รายละเอียดสินค้า -->
               <div class="form-row mb-3">
                  <div class="col">
                     <label for="inputDetail">รายละเอียดสินค้า</label>
                     <textarea name="inputDetail" id="inputDetail" class="form-control" placeholder="รายละเอียดสินค้า" rows="3" required><?php echo $row['pd_detail'] ?></textarea>
                  </div>
               </div>
               <div class="row mt-2 d-flex justify-content-center">
                     <button type="submit" class="btn btn-warning mx-2 w-25" name="btnUpdate">อัพเดท</button>
                     <a href="myproduct.php" type="submit" class="btn btn-danger mx-2 w-25">ยกเลิก</a>
               </div>
               
               
            </form> 
         <!-- form end -->
         </div>
         <!-- col input end -->
      </div>
   <!-- row -->
   </section>
<!-- end section -->
</body>
</html>