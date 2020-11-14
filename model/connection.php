<?php 
  // PDO 
  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "root";
  $dbName = "shop2nd";

  try {

    $db = new PDO("mysql:{$host};dbname={$dbName}", $dbUsername, $dbPassword);
    
    // Set Error Mode PDOException (ATTR_ERRMODE = Error reporting,ERRMODE_EXCEPTION = Throw Exceptions)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $error) {
    echo "Connect Failed : {$error->getMessage()}";
  }
?>