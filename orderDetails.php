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
                <a href="index.html#home">home</a>
                <a href="index.html#featured">featured</a>
                <a href="index.html#arrivals">arrivals</a>
                <a href="login.php">login</a>
            </nav>
        </div>
    </header>

    <div class="form-container" style="border:1px solid black; width:min-content">
        <?php

require_once "database_functions.php";
	$conn = db_connect();

    $sql=" select order_items.book_isbn,orderid,item_price ,book_title from books inner join order_items on order_items.book_isbn=order_items.book_isbn";
   
    $result=$conn->query($sql);
    while($raw=$result->fetch_assoc() )
        {
            echo "ordered book isbn no.                : ".$raw["book_isbn"]."<br>";
            echo "item price                 : ".$raw["item_price"]."<br>";
            echo "orderid             : ".$raw["orderid"]."<br>";
            //echo "amount                 : ".$raw["amount"]."<br>";
            echo "orderd book name            : ".$raw["book_title"]."<br>";
            echo "orderd id               : ".$raw["orderid"]."<br>";
           
            echo "==========================="."<br><br>";
        }
    ?>
    </div>


    <!-- footer section starts  -->

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


</body>

</html>