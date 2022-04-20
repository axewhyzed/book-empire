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

    <!-- header section ends -->

    <!-- bottom navbar  -->

    <nav class="bottom-navbar">
        <a href="#home" class="fas fa-home"></a>
        <a href="#featured" class="fas fa-list"></a>
        <a href="#arrivals" class="fas fa-tags"></a>
        <a href="login.php">login</a>
    </nav>
</body>

</html><?php
  session_start();
 
  // connecto database
  require_once "database_functions.php";
  $conn = db_connect();
  if(isset($_GET['bookisbn'])){
		$book_isbn = $_GET['bookisbn'];
	
  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
   exit;
  }

  $title = $row['book_title'];
  }

?>
<div class="book-disp">
    <!-- Example row of columns -->
    <p class="lead" style="margin: 25px 0"><a href="books.php">Books</a> > <?php echo $row['book_title']; ?></p>
    <div class="row">
        <div class="col-md-3 text-center">
            <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
        </div>
        <div class="col-md-6">
            <h4>Book Description</h4>
            <p><?php echo $row['book_descr']; ?></p>
            <h4>Book Details</h4>
            <table class="table">
                <?php foreach($row as $key => $value){
              if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
                continue;
              }
              switch($key){
                case "book_isbn":
                  $key = "ISBN";
                  break;
                case "book_title":
                  $key = "Title";
                  break;
                case "book_author":
                  $key = "Author";
                  break;
                case "book_price":
                  $key = "Price";
                  break;
              }
            ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value; ?></td>
                </tr>
                <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
            </table>
            <form method="post" action="cart.php">
                <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
                <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary">
            </form>
        </div>
    </div>
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