<?php
   require_once("views/bootstrap4.php");
   require_once('model/connection.php');

   session_start();
   if (!isset($_SESSION['login'])) {
      header("location:login.php");
   }
   $_SESSION['login'];
   $id = $_SESSION['login_id'];
   $fname = $_SESSION['login_fname'];
   $lname = $_SESSION['login_lname'];
   $username = $_SESSION['login_username'];
   $password = $_SESSION['login_password'];
   $email = $_SESSION['login_email'];
   $role = $_SESSION['login_role'];


   if (isset($_POST['btnEditSubmit'])) {
      $edit_fname = $_POST['inputFname'];
      $edit_lname = $_POST['inputLname'];
      $edit_username = $_POST['inputUsername'];
      $edit_password1 = $_POST['inputPassword1'];
      $edit_password2 = $_POST['inputPassword2'];
      $edit_email = $_POST['inputEmail'];
      
      if ($edit_password1 != $edit_password2) {
         $msg = '<div class="alert alert-danger text-center">รหัสผ่านไม่ตรงกัน</div>';
      } else {

         try {
            $query = $db->prepare(
               "UPDATE 2ndshop.tb_users SET 
               user_fname = :fname, user_lname = :lname,
               user_username = :username, user_password = :password, user_email = :email
               WHERE user_id = :id"
            );
            $result = $query->execute([
               ':fname' => $edit_fname, ':lname' => $edit_lname,
               ':username' => $edit_username, ':password' => $edit_password2,
               ':email' => $edit_email, ':id' => $_SESSION['login_id']
            ]);

            if ($result) {
               $msg = '<div class="alert alert-success text-center">แก้ไขสำเร็จ</div>';
               header("refresh:3; url=profile.php");
            }
            
         } catch (PDOException $err) {
            echo $err->getMessage();
         } /* {} try-catch */

      } /* {} if-else */

   } /* {} if (isset()) */

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>edit profile</title>
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
            <h1><strong>แก้ไขโปรไฟล์</strong></h1>

            <!-- form register -->
            <form action="" method="post"> 
               <div class="form-row"> 
                  <div class="col-6"> <!-- first name -->
                     <label for="inputFname">First name</label>
                     <input type="text" class="form-control" name="inputFname" id="inputFname" placeholder="First Name" required value="<?php echo $fname ?>">
                  </div>
                  <div class="col-6"> <!-- last name -->
                     <label for="inputLname">Last name</label>
                     <input type="text" class="form-control" name="inputLname" id="inputLname" placeholder="Last Name" required value="<?php echo $lname  ?>">
                  </div>
               </div> <!-- form-row  -->

               <div class="form-row">
                  <div class="col">
                     <label for="inputUsername">Username</label>
                     <input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="Username" required value="<?php echo $username ?>">
                  </div>
               </div>
               
               <div class="form-row"> 
                  <div class="col-6"> <!-- first name -->
                     <label for="inputPassword1">Password</label>
                     <input type="text" class="form-control" name="inputPassword1" id="inputPassword1" placeholder="Password" required value="<?php echo $password ?>">
                  </div>
                  <div class="col-6"> <!-- last name -->
                     <label for="inputPassword2">Confirm Password</label>
                     <input type="text" class="form-control" name="inputPassword2" id="inputPassword2" placeholder="Confirm Password" required value="<?php echo $password ?>">
                  </div>
               </div> <!-- form-row  -->

               <div class="form-row">
                  <div class="col"> <!-- email -->
                     <label for="inputEmail">Email</label>
                     <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="E-mail" required value="<?php echo $email  ?>">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col">
                     <button type="submit" name="btnEditSubmit" class="btn btn-primary text-white mt-3 w-100">บันทึก</button>
                  </div>
                  <div class="col">
                     <button type="reset" name="btnEditReset" class="btn btn-warning text-white mt-3 w-100" value="reset">รีเซ็ตแก้ไข</button>
                  </div>
               </div>
               <div class="form-row mt-5">
                  <div class="col">
                     <a href="profile.php" class="btn btn-danger text-white w-100">ยกเลิก</a>
                  </div>
               </div>
            </form> <!-- form -->

            <?php if (isset($msg)) {
               echo $msg;
            } ?>
         </div> <!-- col-register -->
      </div> <!-- row (img+register) -->
   </section>
   
</body>
</html>
