<!DOCTYPE html>
<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) or empty($_POST['name']) or empty($_POST['password'])) {
        $error = 'All Fields Required!';
    } else {
        $query = "INSERT INTO `users`(`user_id`, `name`, `email`, `password`) VALUES ( :user_id, :name, :email, :password) ";
        $stmt=$pdo->prepare($query);
        $stmt->execute(array(
            ':user_id'=> strtoupper(uniqid('UC')),
            ':name' => $_POST['name'],
            ':email'=> $_POST['email'],
            ':password' => md5($_POST['password'])
        ));
        $message = 'Registration Successfull.';
       
    }
} 
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>UC | Sign-Up</title>
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
         <form action = "signup.php" method = "POST" style="padding: 20px;"> 
                    <h1 style="font-size: 50px;">SIGN-UP</h1>
                    <?php if (isset($message)) { ?>
                        <br>
                        <small style="font-size: 15px; color: #ffffff;"><?php echo $message; ?> <a style="text-decoration: none; color: #00ffc8;" href="login.php">Log in!</a></small><br>
                        <br>
                    <?php } ?>
                    <div class="row form-input-group">
                        <label style="text-align: left">Name</label><br><br>
                        <input placeholder="Full Name" type = "text" name = "name" class="input-box col-lg-12" autocomplete="off" style="background-color: transparent; color: white">
                    </div>
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
                        <button type="submit" name="submit" class="form-button-one col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #8001ff; border-color:#8001ff; color: white">Sign-Up</button>
                    </div>
             </form>  
         </div>    
        </div>
       </div>
    </body>
</html>