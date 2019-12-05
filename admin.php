<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
     $name = $_SESSION['name'];
     $email = $_SESSION['email'];
     
     if(isset($_POST['submit_link'])){
        $query="INSERT INTO `user_links`(`user_id`, `link`, `description`) VALUES(:user_id, :link, :description) ";
        $stmt=$pdo->prepare($query);
        $stmt->execute(array(
           ':user_id' => $_SESSION['user_id'],
           ':link'=> $_POST['link'],
           ':description' => $_POST['description']
       ));
       $success_message="Link added Successfully";
     }
     
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>UC | Admin</title>
        <meta name="description" content="">
        <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./box.css">
        <script src="https://kit.fontawesome.com/ff3df25b6d.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./flexboxgrid.css">
        <script src="https://kit.fontawesome.com/ff3df25b6d.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Montserrat+Alternates:400,500,600|Montserrat:400,500,600,700|Nunito|Open+Sans|Oswald|Quicksand:400,500,600|Raleway:400,500,600,700|Roboto|Work+Sans:400,500,600&display=swap" rel="stylesheet">
    </head>
    <body>
     <div class="navbar">
        <div class="navbar-options"> 
            <a href="index.php" style="text-decoration: none; color: #00ffc8;">Universal Copier </a>
            <span class="about-icon" style="float: right;"><a href="logout.php" style="text-decoration: none; color: #00ffc8;"><i class="fas fa-sign-out-alt"></i></a></span>
        </div>
      </div> 
      <div style="padding-top: 20px;">   
        <div style="width: 100vw;">
         <div class="col-lg-offset-2 col-lg-8 col-md-12 col-sm-12 col-xs-12 box" style="color: #d1d1d1; background-color:#363636; font-family: 'Montserrat', sans-serif; padding: 15px;">
          <div class="user-info">
              <span style="font-size: 30px;">Hi, <span style="color:#ffc800"><?php echo $name; ?></span>!</span>
          </div>
          <div> 
             <form action ="admin.php" method="POST">
                 <div style="padding: 20px;">
                 <?php if (isset($success_message)) { ?>
                        <br>
                        <small style="font-size: 15px; color:#67ff96;"><?php echo $success_message; ?></small><br>
                        <br>
                 <?php } ?>
                    <div class="row">
                          <div class="form-input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label style="text-align: left">Link</label><br><br>
                              <input placeholder="Enter link here" type = "text" name = "link" class="input-box col-lg-12" autocomplete="off" style="width:100%; background-color: transparent; color: white">
                          </div>
                          <div class=" form-input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                             <label style="text-align: left">Description</label><br><br>
                             <input placeholder="Description" type = "text" name = "description"  class="input-box col-lg-12" autocomplete="off" style="width:100%; background-color: transparent; color: white">
                          </div>   
                          <div class="form-input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <a href="http://uc.tanmoysg.com" target="_blank" style="font-size: 15px; color: #01d0ff; float: left"><i class="fas fa-paper-plane"></i> Go to Public Link Repository(v1)</a>
                             <button type="submit" name="submit_link" class="form-button-one " style="background-color: #01d0ff; color: #000232;float: right;">Add Link</button>                          </div>
                          </div>
                    </div>
                 </div>
              </form>
               </div> 
         </div>    
        <div style="max-width: 100vw;">
        <div class="col-lg-offset-2 col-lg-8 col-md-12 col-sm-12 col-xs-12" style="padding-top: 20px;">
           <center style="font-size: 25px;"> YOUR LINKS </center>
           <div style="padding-top: 15px;">
           <div class="row" >
           <?php
               error_reporting(error_reporting() & ~E_NOTICE);
               $rows = array();
               $query = $pdo->prepare("SELECT * FROM user_links WHERE user_id = :user_id ORDER BY link_no DESC");
               $query->execute(array(':user_id' => $_SESSION['user_id']));
               while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                   $rows[] = $row;
               }
               foreach ($rows as $row) {
                   $link_no = $row['link_no'];
                   $description = $row['description'];
                   if(strpos($row['link'] , "https://") === 0 ){
                    $link = $row['link'];
                   } else{
                    $link = "https://".$row['link'];
                   }
                  
           ?>
             <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                
                   <div style="margin:5px; padding: 10px; color: #d1d1d1; background-color: 1c1c1c; border-radius: 10px;  box-shadow: 0px 15px 42px -22px rgba(71,71,71,1);">
                      <span><?php echo $description;?></span>
                      <p><?php echo substr($link , 0, 15).'...'; ?></p>
                      <a href="<?php echo $link; ?>" style="color: #1e78ff;" target="_blank"><i class="fas fa-paper-plane"></i></a>
                      <a href="dellink.php?link_no=<?php echo $link_no; ?>&user_id=<?php echo $_SESSION['user_id']; ?>" style="color: #1e78ff;" ><i class="fas fa-trash-alt"></i></a>
                   </div>
                
             </div>
           <?php } ?> 
           </div>
           </div>
         </div>
        </div>
       </div>
    </div>
    </body>
</html>
<?php
 } else{
    header('Location: login.php');
 }