<?php
  require_once("views/bootstrap4.php");
  require_once('model/connection.php');

  session_start();
  if (isset($_POST['btnLogin'])) {
    try {

      $username = $_POST['username'];
      $password = $_POST['password'];

      $query = $db->prepare("SELECT * FROM 2ndshop.tb_users WHERE user_username = :username AND user_password = :password");
      $query->execute([':username' => $username,':password' => $password]);
      
      $row = $query->fetch(PDO::FETCH_ASSOC); /* return array associative, index by column name in database to access data */
      
      if ($query->rowCount() > 0) {

          if ($username == $row['user_username'] && $password == $row['user_password']) { // ถ้า username และ password ตรงก็จะทำงาน
            
              // create SESSION and assign value from database
              $_SESSION['login'] = true; // session สำหรับยืนยันการเข้าสู่ระบบ
              $_SESSION['login_id'] = $row['user_id'];
              $_SESSION['login_fname'] = $row['user_fname'];
              $_SESSION['login_lname'] = $row['user_lname'];
              $_SESSION['login_username'] = $row['user_username'];
              $_SESSION['login_password'] = $row['user_password'];
              $_SESSION['login_email'] = $row['user_email'];
              $_SESSION['login_role'] = $row['role_id'];

              $msg = '<div class="alert alert-success text-center">Login Successfully</div>';

              // redirect to different page
              if ($_SESSION['login_role'] == '2') {
                header("refresh:1;admin.php");
              } else {
                $msg = '<div class="alert alert-danger text-center">username or something error</div>';
                echo $msg;
              }
          } 

      } else {
          $msg = '<div class="alert alert-danger text-center">username or password wrong</div>';
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
  <title>Login</title>

  <!-- CSS -->
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<!-- navbar -->
  <?php require_once("views/nav.php") ?>

  <section class="container">
    <div class="content row">
      <div class="col-6 mb-3">
        <img src="./images/login.jpg" alt="image" class="img-fluid">
      </div>
      <div class="col-6"> 
        <h3 class="login-text mb-3">
          <u>Login</u>
        </h3>
        <!-- form  -->
        <form action="" method="POST">
          <div class="form-group"> <!-- username -->
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="username">
          </div>
          <div class="form-group"> <!-- password -->
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="password">
          </div>

          <p> <!-- register -->
            you don't have an account? 
            <a href="register.php">register</a>
          </p>
          <button type="submit" name="btnLogin" class="btn btn-primary col">Login</button>
        </form>
        <?php if ($msg) {
          echo $msg;
        } ?>
      </div> <!-- col-6 login (input) -->
    </div> <!-- parent row -->
  </section>

</body>
</html>