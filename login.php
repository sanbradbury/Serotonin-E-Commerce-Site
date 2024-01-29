<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
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

    <div class="login-main">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "dbh.inc.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if ($password === $user["pass"]) {
                    $_SESSION["user"] = $user["email"];
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <form class="login-form" action="login.php" method="post">
            <p id="login-heading">Login</p>
            <div class="login-field">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                </svg>
                <input autocomplete="off" placeholder="Email" class="login-input-field" type="text" name="email">
            </div>
            <div class="login-field">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                </svg>
                <input placeholder="Password" class="login-input-field" type="password" name="password">
            </div>
            <div class="login-btn">
                <button class="login-button1" type="submit" name="login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                <button class="login-button2">Sign Up</button>
            </div>
            <button class="login-button3">Forgot Password</button>
        </form>
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
</body>
</html>