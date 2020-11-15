<?php
  session_start();
  require_once('model/connection.php'); // PDO connection
  require_once('views/bootstrap4.php'); // Bootstrap Template

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2ndShop</title>

  <!-- public/css -->
  <link rel="stylesheet" href="css/index.css">

</head>
<body>
<!-- navbar -->
<?php require_once('views/nav.php') ?>
<?php echo $_SESSION['login_role'] ?> 
<!-- search product -->
  <div class="container px-4 mb-4">
    <form action="product.php" method="GET"> <!-- search addressbar -->
      <div class="input-group">
        <input type="text" class="form-control form-control-lg" id="input-search" name="inputSearch" placeholder="ค้นหาสินค้า . . . . " aria-label="Recipient's username" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn px-5 " type="submit" id="button-addon2" name="btnSearch">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
              <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
            </svg> <!-- icon search -->
            ค้นหา
          </button> <!-- button search -->
        </div>
      </div> <!-- input-group -->
    </form> <!-- end search product -->
  </div>
  

<!-- section -->
  <section id="section-main" class="container px-4"> <!-- section-container -->
    <div class="row px-3"> <!-- row -->
      <div class="list-group col-3"> <!-- list-group col-2 -->
        <a href="product.php" class="list-group-item list-group-item-action" id="list-head"> 
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-collection-fill mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7z"/>
            <path fill-rule="evenodd" d="M2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
          </svg>
          <strong>ดูสินค้าทั้งหมด</strong>
        </a>
        <a href="#" class="list-group-item list-group-item-action" id="list-items">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-fill mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
          </svg>
          Vehicle
        </a>
        <a href="#" class="list-group-item list-group-item-action" id="list-items">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-phone-fill mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
          </svg>
          Smartphone
        </a>
        <a href="#" class="list-group-item list-group-item-action" id="list-items">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-laptop mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M13.5 3h-11a.5.5 0 0 0-.5.5V11h12V3.5a.5.5 0 0 0-.5-.5zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11z"/>
          <path d="M0 12h16v.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5V12z"/>
        </svg>
          Notebook
        </a>
      </div>
      
      <div class="col px-1"> <!-- col-10 -->
        <div id="carouselExampleCaptions" class="carousel slide w-100 h-75 m-0" data-ride="carousel"> <!-- carousel | banner slide -->
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
        
          <div class="carousel-inner"> <!-- carousel all -->
            <div class="carousel-item active "> <!-- carousel 1 -->
              <img src="images/1_banner.jpg" class="d-block img-fluid" alt="..." data-pause="hover">
            </div> <!-- end -->

            <div class="carousel-item"> <!-- carousel 2 -->
              <img src="images/2_banner.jpg" class="d-block img-fluid" alt="..." data-pause="hover">
            </div> <!-- end -->

            <div class="carousel-item"> <!-- carousel 3 -->
              <img src="images/3_banner.jpg" class="d-block img-fluid" alt="..." data-pause="hover">
            </div> <!-- end -->
          </div> <!-- carousel all -->

          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev"> <!-- previous slide -->
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next"> <!-- next slide -->
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> <!-- end-carousel -->
      </div> <!-- end flex -->
    </div>

    
  </section> <!-- end-section-container -->
</body>
</html>