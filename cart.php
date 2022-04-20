<html>

<body>

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
                    <input type="search" name="bookisbn" placeholder="Enter Book ISBN to search" id="search-box"
                        required />
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

            <a href="login.php">login</a>
        </nav>
        <?php
	// the shopping cart needs sessions, to start one
	/*
		Array of session(
			cart => array (
				book_isbn (get from $_POST['book_isbn']) => number of books
			),
			items => 0,
			total_price => '0.00'
		)
	*/
	session_start();
	require_once "database_functions.php";
	require_once "cart_functions.php";

	// book_isbn got from form post method, change this place later.
	if(isset($_POST['bookisbn'])){
		$book_isbn = $_POST['bookisbn'];
	}

	if(isset($book_isbn)){
		// new iem selected
		if(!isset($_SESSION['cart'])){
			// $_SESSION['cart'] is associative array that bookisbn => qty
			$_SESSION['cart'] = array();

			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$book_isbn])){
			$_SESSION['cart'][$book_isbn] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$book_isbn]++;
			unset($_POST);
		}
	}

	// if save change button is clicked , change the qty of each bookisbn
	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart']["$isbn"]);
			} else {
				$_SESSION['cart']["$isbn"] = $_POST["$isbn"];
			}
		}
	}

	// print out header here
	$title = "Your shopping cart";
	

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
        <form action="cart.php" method="post">

            <?php
		    	foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = db_connect();
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
            <div class="form-container">
                Item: <?php echo $book['book_title'] . " by " . $book['book_author']; ?><br>
                Price: <?php echo "$" . $book['book_price']; ?><br>
                Quantity: <input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"><br><br>

                <div class="tot-cart">
                    Total: <?php echo "$" . $qty * $book['book_price']; ?><br>
                    <?php } ?> TOTAL ITEMS: <?php echo $_SESSION['total_items']; ?><br>
                    TOTAL PRICE: <?php echo "$" . $_SESSION['total_price']; ?><br>
                </div>
                <input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
        </form>

        <br /><br />
        <a href="checkout.php" class="btn btn-primary">Go To Checkout</a>
        <a href="books.php" class="btn btn-primary">Continue Shopping</a>
        </div>
        <?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	
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