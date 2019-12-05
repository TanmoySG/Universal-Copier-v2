<?php
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
   $query="DELETE FROM user_links WHERE link_no = :link_no AND user_id = :user_id";
   $stmt=$pdo->prepare($query);
   $stmt->execute(array(
       ':link_no' => $_GET['link_no'],
       ':user_id' => $_GET['user_id']
   ));
   header("location: admin.php");
}else{
    header("location: login.php");
}
?>