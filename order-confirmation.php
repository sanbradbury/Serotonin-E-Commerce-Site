
<?php 
require_once 'dbh.inc.php';
session_start();

//Check if user is logged in
if (isset($_SESSION["user"])) {
    $userEmail = $_SESSION["user"];

    //Retrieve user's name from the users table
    $sql2 = "SELECT user_id, full_name FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql2);
    $stmt -> bind_param('s', $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $userId = $user["user_id"];
    $fullName = $user["full_name"];
    $stmt->close();
} else {
    $userId = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serotonin</title>
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

    <div class="order-confirmation-main">
        <i class='bx bxs-check-circle bx-md' style='color:#44cd19'  ></i>
        <p>Your order has been confirmed</p>
        <a href="index.php" target="_blank"><div class="home">Go To Home</div></a>
        <a href="products.php"><div class="Shop">Shop More</div></a>
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

    <script src="script.js"></script>
    
</body>
</html>