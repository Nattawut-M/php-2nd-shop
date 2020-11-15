<!-- navbar -->
  <nav class="navbar navbar-expand-sm navbar-dark mb-3 d-flex justify-content-between" style="background-color: #dc7633;"> <!-- navbar-expand-{sm, md, lg} = navbar จะ "ขยาย (expand)" เมื่อขนาดจอเกิน {sm, md, lg}  -->

    <a class="navbar-brand ml-3" href="index.php">
        <img src="images/logo.png" width="30" height="30" class="d-inline-block mr-1" alt="" loading="lazy">
        <b>2nd Shop</b>
    </a>


    <?php if ($_SESSION['login_role'] == '2') :  ?>
      <a href="admin.php" class="btn btn-danger">หน้าผู้ดูแลระบบ</a>
    <?php endif ?>
    <ul class="nav navbar-nav mr-0">
      <li class="nav-item mx-2">
        <a class="nav-link " href="index.php">หน้าแรก</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link " href="html/help.html">ช่วยเหลือ</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link " href="product.php">สินค้าทั้งหมด</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link " href="register.php" >สมัครสมาชิก</a>
      </li>

      <li>
        
      <!-- session check -->
        <?php if ($_SESSION['login']) {  ?> 
          <!-- เมื่อมีการ login (เช็คได้จาก $_SESSION['login'])  -->
          <div class="btn-group">
            <a href="profile.php" class="btn btn-info pr-2"> <!-- display username -->
              สวัสดี <b><?php echo $_SESSION['login_username'] ?></b>
            </a>
            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button> 
            <div class="dropdown-menu">
            <a 
                class="dropdown-item" href="product-add.php" 
                onMouseOver="this.style.backgroundColor='#0275d8'" 
                onMouseOut="this.style.backgroundColor='#f7f7f7'">
                <!-- javascript Over = hover, Out = not hover -->
                ลงประกาศขาย 
              </a>
              <a 
                class="dropdown-item" href="edit-profile.php" 
                onMouseOver="this.style.backgroundColor='#f0ad4e'" 
                onMouseOut="this.style.backgroundColor='#f7f7f7'">
                <!-- javascript Over = hover, Out = not hover -->
                แก้ไขโปรไฟล์ 
              </a>
              <a 
                class="dropdown-item" href="logout.php" 
                onMouseOver="this.style.backgroundColor='#d9534f'" 
                onMouseOut="this.style.backgroundColor='#f7f7f7'">
                <!-- javascript Over = hover, Out = not hover -->
                ออกจากระบบ 
              </a>
            </div>
          </div>

        <?php } else { ?>
            <!-- เมื่อไม่ได้มีการ login (เช็คได้จาก $_SESSION['login']) -->
            <a class="btn btn-outline-light mx-0" href="login.php">เข้าสู่ระบบ (Login)</a>
        <?php } ?>

      </li>
    </ul>
  </nav>