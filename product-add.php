<?php
require_once('views/bootstrap4.php');
require_once('model/connection.php');
session_start();

   if (!isset($_SESSION['login'])) { /* check login */

      header("location: login.php");
      
   }

   if (isset($_REQUEST['btnAdd'])) {
      
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
         
         if (!file_exists($path)) {
            
            move_uploaded_file($img_tmp, 'upload/'.$img_name);

         } else {
            $msg = "files is already exists";
            echo $msg;
         }
         
         if(!isset($msg)) {
            $query = $db->prepare(
               "INSERT INTO 2ndshop.tb_product (
               pd_name, pd_detail, pd_price, pd_img, user_id, type_id
               ) VALUES (
                  :name, :detail, :price, :img, :id, :type
               )"
            );

            $result = $query->execute([
               ':name' => $name, ':detail' => $detail, 
               ':price' => $price, ':img' => $img_name, 
               ':id' => $_SESSION['login_id'], ':type' => $type
            ]);

            if ($result) {
               $query_msg = "ลงขายสินค้าสำเร็จ";
               header("refresh:1; myproduct.php");
            }
         }

      } catch (PDOException $err) {
         echo $err->getMessage();
      }
   }
       /* {if-else} check $_SESSION['login'] */
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sell Product</title>
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
            <?php 
               if (isset($msg)) {
                     echo '<div class="alert alert-danger text-center">'. $msg .'</div>';
               } 
               if (isset($query_msg)) {
                  echo '<div class="alert alert-success text-center">'. $query_msg .'</div>';
               }
            ?>
            <h2 class="mb-4">คุณต้องการลงประกาศขายอะไร?</h2>

         <!-- form -->
            <form action="" method="POST" enctype="multipart/form-data"> 
            <!-- ชื่อสินค้า -->
               <div class="form-row mb-3"> 
                  <div class="col">
                     <label for="inputName">ชื่อสินค้า</label>
                     <input type="text" class="form-control" name="inputName" id="inputName" placeholder="ระบุชื่อของสินค้า">
                  </div>
               </div>
            <!-- ราคา และ ประเภทสินค้า -->
               <div class="form-row mb-3">
                  <div class="col-6">
                     <label for="inputPrice">ราคา</label>
                     <input type="number" class="form-control" name="inputPrice" id="inputPrice" placeholder="ระบุราคาของสินค้า">
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
                     <textarea name="inputDetail" id="inputDetail" class="form-control" placeholder="รายละเอียดสินค้า" rows="3" required></textarea>
                  </div>
               </div>
               <button type="submit" class="btn btn-success mt-3" name="btnAdd">ลงขาย</button>
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