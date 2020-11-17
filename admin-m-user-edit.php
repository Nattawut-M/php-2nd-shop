<?php
    require_once('model/connection.php');
    require_once('views/bootstrap4.php');
    
    session_start();

    /* check login */
    /* 
    if (!isset($_SESSION['login'])) { 
        header("location: login.php");
    }
    */

    // get request 'update_id' from 'admin-m-user.php' via button 'edit'
    if (isset($_REQUEST['update_id'])) {
        try {

            $update_id = $_REQUEST['update_id'];
            $query = $db->prepare("SELECT * FROM 2ndshop.tb_users WHERE user_id = :id");
            $query->execute([':id' => $update_id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            print_r($row);
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }


    // update form form 'this' (admin-m-user-edit.php)
    if (isset($_REQUEST['btnEditSubmit'])) {

        try {
            // assign update data to variables
            $edit_fname = $_POST['inputFname'];
            $edit_lname = $_POST['inputLname'];
            $edit_username = $_POST['inputUsername'];
            $edit_password1 = $_POST['inputPassword1'];
            $edit_password2 = $_POST['inputPassword2'];
            $edit_email = $_POST['inputEmail'];
            
            // check password and confirm password
            if ($edit_password1 != $edit_password2) {
                $msg = '<div class="alert alert-danger text-center">รหัสผ่านไม่ตรงกัน</div>';
            } else {

                try {
                    
                    $query = $db->prepare(
                    "UPDATE 2ndshop.tb_users SET 
                        user_fname = :fname, 
                        user_lname = :lname,
                        user_username = :username, 
                        user_password = :password, 
                        user_email = :email
                    WHERE 
                        user_id = :id"
                    );

                    $result = $query->execute([
                        ':fname' => $edit_fname, 
                        ':lname' => $edit_lname,
                        ':username' => $edit_username,
                        ':password' => $edit_password2,
                        ':email' => $edit_email,
                        ':id' => $_REQUEST['update_id']
                    ]);

                    if ($result) {

                        // fetch data for show result
                        $update_id = $_REQUEST['update_id'];
                        $query = $db->prepare("SELECT * FROM 2ndshop.tb_users WHERE user_id = :id");
                        $query->execute([':id' => $update_id]);
                        $row = $query->fetch(PDO::FETCH_ASSOC);

                        $msg = '<div class="alert alert-success text-center">แก้ไขสำเร็จ</div>';
                        header("refresh:1; admin-m-user.php");
                    }
                    
                } catch (PDOException $err) {
                echo $err->getMessage();
            } /* {} try-catch */

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
    <title>edit profile</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <?php require_once('views/nav.php'); ?>

    <section class="container my-5 py-5">
        <div class="row"> 

            <div class="col-6 align-self-center" id="col-img">
            <img src="images/register.jpg" alt="" class="img-fluid">
            </div> <!-- col-img -->

            <div class="col-6 pr-5" id="col-register">
                <h1><strong>แก้ไขโปรไฟล์</strong></h1>

                <!-- form register -->
                <form action="" method="post"> 
                <div class="form-row"> 
                    <div class="col-6"> <!-- first name -->
                        <label for="inputFname">First name</label>
                        <input type="text" class="form-control" name="inputFname" id="inputFname" placeholder="First Name" required value="<?php echo $row['user_fname'] ?>">
                    </div>
                    <div class="col-6"> <!-- last name -->
                        <label for="inputLname">Last name</label>
                        <input type="text" class="form-control" name="inputLname" id="inputLname" placeholder="Last Name" required value="<?php echo $row['user_lname'] ?>">
                    </div>
                </div> <!-- form-row  -->

                <div class="form-row">
                    <div class="col">
                        <label for="inputUsername">Username</label>
                        <input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="Username" required value="<?php echo $row['user_username'] ?>">
                    </div>
                </div>
                
                <div class="form-row"> 
                    <div class="col-6"> <!-- first name -->
                        <label for="inputPassword1">Password</label>
                        <input type="text" class="form-control" name="inputPassword1" id="inputPassword1" placeholder="Password" required value="<?php echo $row['user_password'] ?>">
                    </div>
                    <div class="col-6"> <!-- last name -->
                        <label for="inputPassword2">Confirm Password</label>
                        <input type="text" class="form-control" name="inputPassword2" id="inputPassword2" placeholder="Confirm Password" required value="<?php echo $row['user_password'] ?>">
                    </div>
                </div> <!-- form-row  -->

                <div class="form-row">
                    <div class="col"> <!-- email -->
                        <label for="inputEmail">Email</label>
                        <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="E-mail" required value="<?php echo $row['user_email']  ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <button type="submit" name="btnEditSubmit" class="btn btn-primary text-white mt-3 w-100">บันทึก</button>
                    </div>
                    <div class="col">
                        <button type="reset" name="btnEditReset" class="btn btn-warning text-white mt-3 w-100" value="reset">รีเซ็ตแก้ไข</button>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col">
                        <a href="admin-m-user.php" class="btn btn-danger text-white w-100">ยกเลิก</a>
                    </div>
                </div>
                </form> <!-- form -->

                <?php if (isset($msg)) {
                    echo $msg;
                } ?>
            </div> <!-- col-register -->
        </div> <!-- row (img+register) -->
    </section>
    
</body>
</html>
