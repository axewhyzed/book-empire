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
            <a href="#" class="logo"> <i class="fas fa-book"></i> Book Empire </a>

            <form action="book.php" method="get" class="search-form">
                <input type="search" name="bookisbn" placeholder="Enter Book ISBN to search" id="search-box" required />
                <label for="search-box" class="fas fa-search"></label>
                <input type="submit" value="search" name="submit" />
            </form>

            <div class="icons">
                <div id="search-btn" class="fas fa-search"></div>
                <a href="#" class="fas fa-heart"></a>
                <a href="cart.php" class="fas fa-shopping-cart"></a>
                <a id="login-btn" href="login.php" class="fas fa-user"></a>
            </div>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="index.html#home">home</a>

                <a href="admin_book.php" class="btn btn-primary">admin panel</a>

                <a class="lead"><a href="admin_add.php">Add new book</a>
                    <a class="lead"><a href="admin_delete.php">delete a book</a>
                        <a href="admin_signout.php" class="btn btn-primary">Sign out!</a>
            </nav>
        </div>
    </header>
    <?php
	session_start();

	$title = "List book";
	
	require_once "database_functions.php";
	$conn = db_connect();
  $sql="select * from books";
  $result=$conn->query($sql);
?>

    <table style="width:100%  " class="table" style="margin-top: 20px">
        <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Image</th>
            <th>Description</th>
            <th>Price</th>
            <th>Publisher</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $row['book_isbn']; ?></td>
            <td><?php echo $row['book_title']; ?></td>
            <td><?php echo $row['book_author']; ?></td>
            <td><?php echo $row['book_image']; ?></td>
            <td><?php echo $row['book_descr']; ?></td>
            <td><?php echo $row['book_price']; ?></td>
            <td><?php echo $row['publisherid']; ?></td>

        </tr>
        <?php } ?>
    </table>

    <?php
	if(isset($conn)) {mysqli_close($conn);}
	
?>
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

    <!-- loader  -->
</body>

</html>