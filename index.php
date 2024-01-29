<?php
    session_start();
    require_once 'dbh.inc.php';
    $sql = "SELECT * FROM products";
    $all_product = $conn->query($sql);   

    //Check if user is logged in
    if (isset($_SESSION["user"])) {
        $userEmail = $_SESSION["user"];

        //Retrieve user's name from the users table
        $sql2 = "SELECT user_id, full_name FROM users WHERE email = '$userEmail'";
        $result = $conn->query($sql2);
        $user = $result->fetch_assoc();
        $fullName = $user["full_name"];
        $userId = $user["user_id"];
    } else {
        $userId = null;
    }

    $sql3 = "SELECT * FROM products";
    $stmt = $conn->prepare($sql3);
    $stmt->execute();
    $resultsq = $stmt->get_result();

    if ($resultsq) {
        $products = $resultsq->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "error executing";
    }
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@900&display=swap" rel="stylesheet">
    <title>Serotonin</title>
</head>
<body>
    <div class="top-nav">
        <div class="dropdown">
            <?php if (isset($_SESSION["user"])) : ?>
                <a href="#">Hi, <?php echo $fullName; ?></a>
            <?php else: ?>
            <a href="login.php">Sign in</a>
            <div class="dropdown-content">
                <a href="login.php">Sign in</a>
                <a href="signUp.php">Join Us</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="nav-divider">
            |
        </div>
        <div class="dropdown-account">
            <a href="#"><i class='bx bx-user bx-sm'></i></a>
            <div class="dropdown-content-account">
                <a href="logout.php">Logout</a>
            </div>
        </div>    
    </div>

    <div class="nav-container">
        <div class="logo">
            <p>Serotonin</p>
        </div>
        <nav class="nav-bar">
            <i class='bx bx-menu bx-lg'></i>  
            <ul>
                <li><a href="index.php">Home</a></li> 
                <li><a href="new.php">New</a></li>
                <li><a href="gender.php?gender=women" >Women</a></li>
                <li><a href="gender.php?gender=men" >Men</a></li>
            </ul>
        </nav>

        <form class="form">
            <label for="search">
                <input required="" autocomplete="off" placeholder="search products" id="search" type="text">
                <div class="icon">
                    <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="swap-on">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </div>
            </label>
        </form>

        <div class="icons">
            <a href="cart.php"><i class='bx bx-shopping-bag bx-sm' ></i></a>
        </div>
    </div>

    <span class="divider"></span>

    <div class="CTA">
        <div class="image-cta">
            <h1>Winter Collection</h1>
            <p>Rock this winter with our new collection!</p>

            <div class="buttons">
                <a href="new.php"><div>Explore</div></a>
            </div> 
        </div>
        <div class="collection-pieces">
            <ul>
                <li><a href="new.php"><img src="https://static.zara.net/photos///2022/I/0/1/p/2731/322/430/2/w/750/2731322430_6_1_1.jpg?ts=1668012724155"></a></li>
                <li><a href="new.php"><img src="https://static.zara.net/photos///2022/I/0/1/p/2731/323/430/2/w/293/2731323430_6_1_1.jpg?ts=1668012721008"></a></li>
                <li><a href="new.php"><img src="https://static.zara.net/photos///2022/I/0/1/p/2731/315/430/2/w/293/2731315430_6_1_1.jpg?ts=1669308123866"></a></li>
                <li><a href="new.php"><img src="https://static.zara.net/photos///2022/I/0/1/p/2731/308/400/2/w/293/2731308400_6_1_1.jpg?ts=1666082167858"></a></li>
                <li><a href="new.php"><img src="https://static.zara.net/photos///2022/I/0/1/p/9017/987/800/2/w/293/9017987800_6_1_1.jpg?ts=1666082249824"></a></li>
            </ul>
        </div>
    </div>


    <div class="trending">
        <div class="trending-heading">
            <p>Trending this week</p>
        </div>
        
        <div class="vertical-scroll">
        <?php 
            foreach($products as $product):  ?>
            <a href="product-details.php?product_id=<?php echo $product['product_id'];?>">
                <div class="new-shirt-prod">
                    <div class="product-image" style="background-image: url('Admin/<?php echo $product['prod_image']; ?>')"></div>
                    <div class="product-desc">
                        <span class="desc-price">
                            <h2><?php echo $product['prod_name'];?></h2>
                            <p>R<?php echo $product['price'];?></p>
                        </span>
                        <p><?php echo $product['gender'];?></p>
                    </div>
                
                </div>
            </a> 
            <?php endforeach; ?>
        </div>
    </div>

    <div class="explore">
        <p>More to Explore</p>
        <div class="explore-categories">
            <div class="explore-women">
                <a href="gender.php?gender=women"><div id="cat-women">Women</div></a>
            </div>

            <div class="explore-men">
                <a href="gender.php?gender=men"><div id="cat-men">Men</div></a>
            </div>

            <div class="explore-new">
                <a href="new.php"><div id="cat-new">New</div></a>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-nav">
            <ul class="help">
                <li id="help-h"><a href="#">GET HELP</a></li>
                <li><a href="#">Order Status</a></li>
                <li><a href="#">Shipping</a></li>
                <li><a href="#">Returns</a></li>
                <li><a href="#">Payment Options</a></li>
            </ul>

            <ul class="about">
                <li id="about-h"><a href="#">ABOUT SEROTONIN</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Investors</a></li>
                <li><a href="#">Sustainability</a></li>
            </ul>

            <ul class="contact">
                <li id="contact-h"><a href="#">CONTACT US</a></li>
                <li><a href="#">SerotoninApparel@gmail.com</a></li>
                <li><a href="#">0718644170</a></li>
                <li><a href="#">0118564363</a></li>
                <li><a href="https://goo.gl/maps/KYRwAk81X17bQ8sN9" target="_blank">P.O Box</a></li>
            </ul>
        </div>
        <div class="social-media">
            <a href="https://twitter.com/Sandevelops" target="_blank"><i class='bx bxl-twitter bx-md'></i></a>
            <a href="https://www.instagram.com/serotonin.apparel/" target="_blank"><i class='bx bxl-instagram bx-md' ></i></a>
            <a href="https://www.facebook.com/profile.php?id=100092407935966" target="_blank"><i class='bx bxl-facebook bx-md' ></i></a>
        </div>
    </div>



    
    <script> 
        var user_id = <?php echo json_encode($userId); ?>;
    </script>
    <script src="script.js"></script>   
</body>
</html>