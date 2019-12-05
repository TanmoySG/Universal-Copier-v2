<?php
 
/* try {*/
      $pdo = new PDO("mysql: host=localhost:3306; dbname=***;", '***', '***' );
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             //echo "Connected successfully";
    /*}catch(PDOException $e)
          {
            echo "Connection failed: " . $e->getMessage();
          }*/
?>