<?php

include 'database_functions.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);
   $country = mysqli_real_escape_string($conn, md5($_POST['country']));
   $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']) ;



   $address = mysqli_real_escape_string($conn, md5($_POST['address']));

   
   


   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
         mysqli_query($conn, "INSERT INTO `customers`(`customerid`, `name`, `address`, `city`, `zip_code`, `country`) VALUES ('$email','$name','$address','$city','$zipcode','$country')") or die('query failed');
      // INSERT INTO `customers`(`email`, `name`, `address`, `city`, `zip_code`, `country`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
        mysqli_query($conn,"INSERT INTO `users`(`email`, `password`) VALUES ('$email','$pass')");
        $message[] = 'registered successfully!';

         header('location:login.php');
      }


   }
  

?>





<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Empire - Best Books at Great Prices!</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- header section starts  -->

    <header class="header">
        <div class="header-1">
            <a href="index.html" class="logo"> <i class="fas fa-book"></i> Book Empire </a>

            <form action="book.php" method="get" class="search-form">
                <input type="search" name="bookisbn" placeholder="Enter Book ISBN to search" id="search-box" required />
                <label for="search-box" class="fas fa-search"></label>
                <input type="submit" value="search" name="submit" />
            </form>

            <div class="icons">
                <div id="search-btn" class="fas fa-search"></div>
                <a href="#" class="fas fa-heart"></a>
                <a href="cart.php" class="fas fa-shopping-cart"></a>
                <a id="login-btn" href="admin.html" class="fas fa-user"></a>
            </div>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="index.html">home</a>
                <a href="index.html#featured">featured</a>
                <a href="index.html#arrivals">arrivals</a>
                <a href="login.php">login</a>
            </nav>
        </div>
    </header>

    <!-- header section ends -->

    <!-- bottom navbar  -->

    <nav class="bottom-navbar">
        <a href="#home" class="fas fa-home"></a>
        <a href="#featured" class="fas fa-list"></a>
        <a href="#arrivals" class="fas fa-tags"></a>
        <a href="admin.html">admin panel</a>
        <a href="login.php">login</a>
    </nav>

    <div class="reg-form">
        <form action="" method="post">
            <table class="table">
                <center>
                    <h1>Register now</h1>
                </center><br>
                <tr>
                    <th>Email: </th>
                    <td><input type="email" name="email" placeholder=" enter your email" class="frm-login" required
                            class="box"></td>
                </tr>

                <tr>
                    <th>password: </th>
                    <td><input type="password" name="password" placeholder=" enter your password" class="frm-login"
                            required class="box"></td>
                </tr>
                <tr>
                    <th>name: </th>
                    <td><input type="text" name="name" placeholder=" enter your name" class="frm-login" required
                            class="box"></td>
                </tr>
                <tr>
                    <th>address: </th>
                    <td><input type="text" name="address" placeholder=" enter your address" class="frm-login" require
                            class="box"></td>
                </tr>
                <tr>
                    <th>zip code: </th>
                    <td><input type="text" name="zipcode" placeholder=" enter zip code here " class="frm-login" require
                            class="box"></td>
                </tr>
                <tr>
                    <th>city: </th>
                    <td><input type="text" name="city" placeholder=" enter city here " class="frm-login" require
                            class="box"></td>
                </tr>
                <tr>
                    <th>country: </th>
                    <td><input type="text" name="country" placeholder=" enter country here " class="frm-login" require
                            class="box"></td>
                </tr>
            </table>

            <center>
                <input type="submit" name="submit" value="register now" class="btn">

                <p>already have an account? <a href="login.php">login now</a></p>
            </center>
        </form>

    </div>
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>our locations</h3>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> india </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> USA </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> russia </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> france </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> japan </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> africa </a>
            </div>

            <div class="box">
                <h3>quick links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> featured </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> arrivals </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> reviews </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> blogs </a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> account info </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> ordered items </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> privacy policy </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> payment method </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> our serivces </a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
                <a href="#"> <i class="fas fa-envelope"></i> email@gmail.com </a>
            </div>
        </div>

        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>
    </section>
    <div class="credit">
        created by <span>20CP005 & 20CP009</span> | All Rights Reserved!
    </div>
    </section>

    <!-- footer section ends -->

    <!-- loader  -->

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

</body>

</html>