<?php
   require_once('model/connection.php');
   require_once('views/bootstrap4.php');

   // เช็คสถานะ login
   session_start();
   if (!isset($_SESSION['login'])) {
      header("location:login.php");
   }
   
   // เช็คสถานะ admin 
   if ($_SESSION['login_role'] != 2) {
      header("refresh:0;login.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>
</head>
<body>
   
</body>
</html>