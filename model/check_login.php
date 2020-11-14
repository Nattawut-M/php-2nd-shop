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
   <title>check</title>
</head>
<body>
<?php require_once('views/nav.php'); ?>

<?php
   if (isset($_POST['btnLogin'])) {
      try {
         echo "<pre>";
            echo print_r($_POST);
         echo "</pre>";
         $username = $_POST['username'];
         $password = $_POST['password'];

         $query = $db->prepare("SELECT * FROM 2ndshop.tb_users WHERE user_username = :username AND user_password = :password");
         $query->execute([
         ':username' => $username,
         ':password' => $password
         ]);
         /* 
         echo "<pre>";
            echo print_r($query);
         echo "</pre>";
         */
         $row = $query->fetch(PDO::FETCH_ASSOC); /* return array associative, index by column name in database to access data */
         
         if ($query->rowCount() > 0) {
            if ($username == $row['user_username']) {
               if ($password == $row['user_password']) {
                  $_SESSION['login'] = true;
                  // $login = $_SESSION['login'];
                  $_SESSION['login_name'] = $_POST['username'];
                  header("location: index.php");
               } else {

                  echo '<div class="alert alert-danger">something went wrong!! lv.3</div>';
               }
            } else {
               echo '<div class="alert alert-danger">something went wrong!!lv.2</div>';
            }
         } else {
            echo '<div class="alert alert-danger">something went wrong!!lv.1</div>';
         }
      } catch (PDOException $err) {
         echo $err->getMessage();
      }
   }
?>
</body>
</html>