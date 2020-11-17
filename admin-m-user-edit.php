<?php
   require_once('model/connection.php');
   require_once('views/bootstrap4.php');
   
   session_start();

   /* check login */
   /* 
   if (!isset($_SESSION['login'])) { 
      header("location: login.php");
   }
    */
   // receive request from 'myproduct.php' via button 'edit'
   if (isset($_REQUEST['update_id'])) {
      try {
         $user_id = $_SESSION['login_id'];
         $update_id = $_REQUEST['update_id'];
         $query = $db->prepare("SELECT * FROM 2ndshop.tb_product WHERE pd_id = :id");
         $query->execute([':id' => $update_id]);
         $row = $query->fetch(PDO::FETCH_ASSOC);
         // extract($row);
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

         $img_name =  $row['pd_img']; // ให้ค่าเริ่มต้นเป็นรูปเดิม
         $img_type = $_FILES['inputImg']['type'];
         $img_size = $_FILES['inputImg']['size'];
         $img_tmp = $_FILES['inputImg']['tmp_name']; // inintial file stored

         $path = "upload/".$img_name; // file destination / new img name
         $directory ="upload/"; // old directory

         // ถ้ามีการเลือกรูป
         if (isset($img_name)) { 

            if (file_exists($path)) {
               move_uploaded_file($img_tmp, 'upload/'.$img_name);
            }
         // ถ้าไม่ได้เลือกรูปใหม่ ให้ใช้รูปเดิม
         } else { 
            $img_name = $row['pd_img']; 
         }

         if (!isset($msg)) { // ถ้าไม่มีข้อความ = ไม่มี error

            $query_update = $db->prepare(
               "UPDATE 2ndshop.tb_product SET 
               pd_name = :pd_name, 
               pd_detail = :pd_detail,
               pd_price = :pd_price,
               pd_img = :pd_img
               WHERE pd_id = :pd_id"
            );

            // if success return True, else Failure return False to $result
            $result = $query_update->execute([
               ':pd_name' => $name,
               ':pd_detail' => $detail,
               ':pd_price' => $price,
               ':pd_img' => $img_name,
               ':pd_id' => $row['pd_id']
            ]); 

            if ($result) {
               $updateMsg = '<div class="alert alert-success">อัพเดทสำเร็จ</div>';
               // echo $updateMsg;
               header("refresh:1;admin-m-product.php");
            } else {
               $updateMsg = '<div class="alert alert-danger">มีปัญหา</div>';
               // echo $updateMsg;
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
   <link rel="stylesheet" href="css/admin-edit.css">
</head>

<body>
<!-- Navbar -->
   <?php include_once('views/nav-admin.php'); ?>

<!-- section -->
   <section class="container my-3 py-5" id="section-container">
      <div class="row"> 
      <!-- col img -->
         <div class="col-6 align-self-center" id="col-img">
            <img src="images/sell.jpg" alt="" class="img-fluid">
         </div> 
      <!-- col img end -->

      <!-- col input -->
         <div class="col-6 pr-5" id="col-register">
            <?php 
               if (isset($msg)) {
                  echo '<div class="alert alert-danger">'. $msg .'</div>';
               } 
            
               if (isset($updateMsg)) {
                  echo $updateMsg;
               }
            ?>
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

                        <?php if ($row['type_id'] == '1') : ?>
                           <option value="1" selected>Vehicle (ยานพาหนะ)</option>
                           <option value="2" >Smartphone (สมาร์ทโฟน)</option>
                           <option value="3" >Notebook (โน้ตบุ๊ค)</option>
                        <?php elseif ($row['type_id'] == '2') : ?>
                           <option value="1" >Vehicle (ยานพาหนะ)</option>
                           <option value="2" selected>Smartphone (สมาร์ทโฟน)</option>
                           <option value="3" >Notebook (โน้ตบุ๊ค)</option>
                        <?php elseif ($row['type_id'] == '3') : ?>
                           <option value="1" >Vehicle (ยานพาหนะ)</option>
                           <option value="2" >Smartphone (สมาร์ทโฟน)</option>
                           <option value="3" selected>Notebook (โน้ตบุ๊ค)</option>
                        <?php endif ?>
                           
                     </select>
                  </div>
               </div>

            <!-- รูปสินค้า -->
               <div class="form-row mt-4 mb-3">
                  <div class="col">
                     <div class="custom-file mb-3">
                        <label for="" class="mr-5">เลือกรูปสินค้า *ข้ามขั้นตอนนี้ หากไม่ต้องการเปลี่ยนรูปสินค้า*</label>
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
                     <a href="admin-m-product.php" type="submit" class="btn btn-danger mx-2 w-25">ยกเลิก</a>
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