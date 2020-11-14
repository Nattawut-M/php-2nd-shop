<?php
   require_once('model/connection.php');
   require_once('views/bootstrap4.php');

   if (isset($_REQUEST['delete_id'])) {
      try {

         $delete_id = $_REQUEST['delete_id'];
         $query = $db->prepare("SELECT * FROM 2ndshop.tb_product WHERE pd_id = :id");
         $query->execute([':id' => $delete_id]);
         $row = $query->fetch(PDO::FETCH_ASSOC);
         unlink("upload/".$row['pd_img']); // remove file

         $delete_query = $db->prepare("DELETE FROM 2ndshop.tb_product WHERE pd_id = :pd_id");
         $delete_query->execute([':pd_id'=> $delete_id]);
         header("refresh:0;myproduct.php");
         
      } catch (PDOException $err) {
         echo $err->getMessage();
      }
   }
?>