<?php
	session_start();
	
	$title = "Add new book";
	
	require "database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$author = trim($_POST['author']);
		$author = mysqli_real_escape_string($conn, $author);
		
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);
		
		$publisher = trim($_POST['publisher']);
		$publisher = mysqli_real_escape_string($conn, $publisher);

		// add image
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}

		// find publisher and return pubid
		// if publisher is not in db, create new
		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
		$findResult = mysqli_query($conn, $findPub);
		if(!$findResult){
			// insert into publisher table and return id
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
			$insertResult = mysqli_query($conn, $insertPub);
			if(!$insertResult){
				echo "Can't add new publisher " . mysqli_error($conn);
				exit;
			}
			$publisherid = mysql_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($findResult);
		
		}


		$query = "INSERT INTO books VALUES ('" . $isbn . "', '" . $title . "', '" . $author . "', '" . $image . "', '" . $descr . "', '" . $price . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {
			header("Location: admin_book.php");
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
                <a href="index.html#home">home</a>

                <a href="admin_book.php" class="btn btn-primary">admin panel</a>

                <a class="lead"><a href="admin_add.php">Add new book</a>
                    <a href="admin_signout.php" class="btn btn-primary">Sign out!</a>
            </nav>
        </div>
    </header>

    <!-- header section ends -->

    <!-- bottom navbar  -->

    <nav class="bottom-navbar">
        <a href="#home" class="fas fa-home"></a>
        <a href="admin_book.php" class="btn btn-primary">admin panel</a>

        <a class="lead"><a href="admin_add.php">Add new book</a>
            <a href="admin_signout.php" class="btn btn-primary">Sign out!</a>
    </nav>
</body>

</html>
<div class="form-group">
    <form method="post" action="admin_add.php" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <th>ISBN</th>
                <td><input type="text" name="isbn" class="form-control"></td>
            </tr>
            <tr>
                <th>Title</th>
                <td><input type="text" name="title" class="form-control" required></td>
            </tr>
            <tr>
                <th>Author</th>
                <td><input type="text" name="author" class="form-control" required></td>
            </tr>
            <tr>
                <th>Image</th>
                <td><input type="file" name="image" class="form-control"></td>
            </tr>
            <tr>

                <th>Description</th>
                <td><textarea name="descr" cols="40" rows="5" class="form-control"></textarea></td>

            </tr>
            <tr>
                <th>Price</th>
                <td><input type="text" name="price" class="form-control" required></td>
            </tr>
            <tr>
                <th>Publisher</th>
                <td><input type="text" name="publisher" class="form-control" required></td>
            </tr>
        </table>
        <input type="submit" name="add" value="Add new book" class="btn btn-primary">
        <input type="reset" value="cancel" class="btn btn-default">
    </form>
</div>
<br />
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

<?php
	if(isset($conn)) {mysqli_close($conn);}
	
?>