<li class="nav-item dropdown mx-2">
   <a class="nav-link dropdown-toggle dropdown-toggle-split " href="product.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      เลือกประเภท
   </a>
   <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href="#">มอเตอร์ไซค์</a>
      <a class="dropdown-item" href="#">สมาร์ทโฟน</a>
      <a class="dropdown-item" href="#">โน้ตบุ๊ค</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="product.php">ดูทั้งหมด</a>
   </div>
</li>

<?php
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $phone = $_POST['phone'];
   $sql = "INSERT INTO tb_member (fname, lname, phone) VALUES ({$_POST['fname']}, $lname, $phone)";

   $dept_name = $_POST['dept_name'];
   $sql2 = "INSERT INTO tb_dept (dept_name) VALUES ($dept_name)";
?>

<!-- $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); -->
<!-- // http://marcuscode.com/lang/php/exceptions#:~:text=%E0%B8%84%E0%B8%B3%E0%B8%AA%E0%B8%B1%E0%B9%88%E0%B8%87%20catch-,throw%20new%20Exception(%22Division%20by%20zero.%22)%3B,%2D%3EgetMessage()%3B%20%7D -->