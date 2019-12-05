<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
    header('Location: admin.php');
} else {
    if (isset($_POST['email'], $_POST['password'])) {
        if (empty($_POST['email']) or empty($_POST['password'])) {
            $error = 'All Fields Required!';
        } else {
            $query = "SELECT * FROM users WHERE email=:email AND password=:password";
            $stmt=$pdo->prepare($query);
            $stmt->execute(array(
                ':email'=> $_POST['email'],
                ':password' => md5($_POST['password'])
            ));
            $results=$stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount()>0) {
                $_SESSION['logged_in'] = TRUE;
                $_SESSION['user_id'] = $results['user_id'];
                $_SESSION['name'] = $results['name'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                header('Location: admin.php');
                exit();
            } else {
                $error = 'Incorrect Credentials!';
            }
        }
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>UC | Log-In</title>
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
            <span class="about-icon" style="float: right;"><a href="about.html" style="text-decoration: none; color: #00ffc8;"><i class="fas fa-info-circle"></i></a></span>
        </div>
      </div> 
        <div style="padding-top: 25px">   
        <div class=" " style="width: 100vw;">
         <div class="col-lg-offset-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 box" style="color: #d1d1d1; background-color:#363636; font-family: 'Montserrat', sans-serif; padding: 15px;">
         <form action = "login.php" method = "POST" style="padding: 20px;"> 
                    <h1 style="font-size: 50px;">LOGIN</h1>
                    <?php if (isset($error)) { ?>
                        <br>
                        <small style="font-size: 15px; color: #ff6767;"><?php echo $error; ?></small><br>
                        <br>
                    <?php } ?>
                    <div class="row form-input-group">
                        <label style="text-align: left">Email</label><br><br>
                        <input placeholder="Email" type = "text" name = "email" class="input-box col-lg-12" autocomplete="off" style="background-color: transparent; color: white">
                    </div>
                    <div class="row form-input-group">
                        <label style="text-align: left">Password</label><br><br>
                        <input placeholder="Password" type = "password" name = "password"  class="input-box col-lg-12" autocomplete="off" style="background-color: transparent; color: white">
                    </div>
                    <br>     
                    <div class="row form-input-group">
                        <button type="submit" name="submit" class="form-button-one col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #8001ff; border-color:#8001ff; color: white">Log-In</button>
                    </div>
             </form>  
         </div>    
        </div>
       </div>
    </body>
</html>