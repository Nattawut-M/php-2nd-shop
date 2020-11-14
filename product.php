<?php

  require_once("model/connection.php");
  require_once("views/bootstrap4.php");
  session_start();

  $query = $db->query("SELECT * FROM 2ndshop.tb_product ORDER BY pd_id DESC");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product</title>
</head>
<body>
<!-- navbar -->
  <?php require_once('views/nav.php') ?>

  <div class="container"><h1>product page</h1></div>
  
  <div class="container d-flex flex-row flex-wrap justify-content-between">
  <?php while($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

    <div class="card my-3 mx-2 d-inline-block ">
      <div class="card-header bg-primary text-white">
        <h4>
          <strong><?php echo $row['pd_name'] ?></strong>
        </h4>
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $row['pd_name'] ?></h5>
        <p class="card-text">
          <img src="upload/<?php echo $row['pd_img'] ?>" alt="" width="100px" height="100px">
          <br>
          <?php 
            echo "รายละเอียด : ".$row['pd_detail']. "<br>";
            echo "ผู้ขาย : ".$row['user_id']. "<br>";
            echo "เวลาลงขาย : ".$row['pd_timestamp']. "<br>";
            echo "ราคา : ".$row['pd_price']. "<br>";
          ?>
        </p>
        <a href="#" class="btn btn-success">
          Buy
          <?php echo $row[''] ?>
        </a>
      </div>
    </div>

  <?php } ?> 

  </div>
</body>
</html>