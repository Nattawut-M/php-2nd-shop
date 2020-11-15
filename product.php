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
  <!-- CSS -->
  <link rel="stylesheet" href="css/product.css">
</head>
<body>
<!-- navbar -->
  <?php require_once('views/nav.php') ?>

  <div class="container"><h1>Product Page</h1></div>
  
  <div class="container d-flex flex-row flex-wrap justify-content-start">
  <?php while($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>

    <div class="card my-3 mx-2 d-inline-block ">
      <div class="card-header bg-primary text-white">
        <h4>
          <strong><?php echo $row['pd_name'] ?></strong>
        </h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4 d-flex align-items-center">
            <img class="" src="upload/<?php echo $row['pd_img'] ?>" alt="img-product" id="img-product">
          </div>
          <div class="col px-3">
            <p class="card-text">
              <?php 
                echo "<strong>รายละเอียด</strong> <br>".$row['pd_detail']. "<br><hr>";
                echo "เวลาลงขาย : ".$row['pd_timestamp']. "<br>";
                echo "ราคา : ".$row['pd_price']. "<br>";
              ?>
            </p>
            <a href="#" class="btn btn-success w-75 align-self-center">
              Buy
              <?php echo $row[''] ?>
            </a>
          </div>
        </div>
        
        
      </div>
    </div>

  <?php } ?> 

  </div>
</body>
</html>