<?php
   require_once('views/bootstrap4.php');
   require_once('model/connection.php');

   session_start();
   if (!isset($_SESSION['login'])) {
      header("location:login.php");
   }
   $uid = $_SESSION['login_id'];
   $ufname = $_SESSION['login_fname'];
   $ulname = $_SESSION['login_lname'];
   $uusername = $_SESSION['login_username'];
   $upassword = $_SESSION['login_password'];
   $uemail = $_SESSION['login_email'];
   $urole = $_SESSION['login_role'];

   $query = $db->prepare("SELECT * FROM 2ndshop.tb_users WHERE user_id = :id");
   $query->execute([':id'=> $_SESSION['login_id']]);
   $row = $query->fetch(PDO::FETCH_ASSOC);

   if ($query) {
      // print_r($row);
      $_SESSION['login_id'] = $row['user_id'];
      $_SESSION['login_fname'] = $row['user_fname'];
      $_SESSION['login_lname'] = $row['user_lname'];
      $_SESSION['login_username'] = $row['user_username'];
      $_SESSION['login_password'] = $row['user_password'];
      $_SESSION['login_email'] = $row['user_email'];
      $_SESSION['login_role'] = $row['user_role'];

   } else {
      echo "error";
      print_r($row);
      print_r($_SESSION);
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
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
         
         <h1><strong>Profile</strong></h1>

         <!-- form profile -->
         <form action="" method="post">
            <fieldset disabled="disabled">
               <div class="form-row"> 
                  <div class="col-6"> <!-- first name -->
                     <label for="inputFname">First name</label>
                     <input type="text" class="form-control" name="inputFname" id="inputFname" placeholder="<?php echo $row['user_fname'] ?>" required>
                  </div>
                  <div class="col-6"> <!-- last name -->
                     <label for="inputLname">Last name</label>
                     <input type="text" class="form-control" name="inputLname" id="inputLname" placeholder="<?php echo $row['user_lname'] ?>" required>
                  </div>
               </div> <!-- form-row  -->
      
               <div class="form-row">
                  <div class="col">
                     <label for="inputUsername">Username</label>
                     <input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="<?php echo $row['user_username'] ?>" required>
                  </div>
               </div>
      
               <div class="form-row mb-4">
                  <div class="col"> <!-- email -->
                     <label for="inputEmail">Email</label>
                     <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="<?php echo $row['user_email'] ?>" required>
                  </div>
               </div>

            </fieldset>

            <div class="form-row">
               <div class="col">
                  <a href="myproduct.php" class="btn btn-primary w-100">My Product</a>
               </div>
               <div class="col">
                  <a href="mypurchase.php" class="btn btn-info w-100">My Purchase</a>
               </div>
            </div>

            <a href="edit-profile.php" name="btnSubmitRegister" class="btn btn-sm btn-warning w-100 mt-3">แก้ไขโปรไฟล์</a>

         </form> <!-- form -->
      </div> <!-- col-register -->
   </div> <!-- row (img+register) -->
</section>
</body>
</html>