<?php
   require_once('model/connection.php');
   require_once('views/bootstrap4.php');

   session_start();
   
   if (isset($_REQUEST['delete_id'])) {
      try {
         
         $delete_id = $_REQUEST['delete_id'];
         $delete_query = $db->prepare("DELETE FROM 2ndshop.tb_users WHERE user_id = :user_id");
         $delete_query->execute([':user_id'=> $delete_id]);
         header("refresh:0;admin-m-user.php");
         
      } catch (PDOException $err) {
         echo $err->getMessage();
      }
   }
?>