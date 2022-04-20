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
	session_start();
	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
		}
		break;
	}

	if($_SESSION['err'] == 0){
		header("Location: checkout.php");
	} else {
		unset($_SESSION['err']);
	}


	$_SESSION['ship'] = array();
	foreach($_POST as $key => $value){
		if($key != "submit"){
			$_SESSION['ship'][$key] = $value;
		}
	}
	require_once "database_functions.php";
	// print out header here
	$title = "Purchase";
	
	// connect database
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>
        <table class="table">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
			    foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = db_connect();
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
            <tr>
                <td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
                <td><?php echo "$" . $book['book_price']; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo "$" . $qty * $book['book_price']; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th><?php echo $_SESSION['total_items']; ?></th>
                <th><?php echo "$" . $_SESSION['total_price']; ?></th>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>20.00</td>
            </tr>
            <tr>
                <th>Total Including Shipping</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th><?php echo "$" . ($_SESSION['total_price'] + 20); ?></th>
            </tr>
        </table>
        <form method="post" action="process.php" class="form-horizontal">
            <?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
            <p class="text-danger">All fields have to be filled</p>
            <?php } ?>
            <div class="form-group">
                <label for="card_type" class="col-lg-2 control-label">Type</label>
                <div class="col-lg-10">
                    <select class="form-control" name="card_type">
                        <option value="VISA">VISA</option>
                        <option value="MasterCard">MasterCard</option>
                        <option value="American Express">American Express</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="card_number" class="col-lg-2 control-label">Number</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="card_number">
                </div>
            </div>
            <div class="form-group">
                <label for="card_PID" class="col-lg-2 control-label">PID</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="card_PID">
                </div>
            </div>
            <div class="form-group">
                <label for="card_expire" class="col-lg-2 control-label">Expiry Date</label>
                <div class="col-lg-10">
                    <input type="date" name="card_expire" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="card_owner" class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="card_owner">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Purchase</button>
                </div>
            </div>
        </form><br>
        <p class="lead">
            <center><strong>Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.
                </strong></center>
        </p>
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