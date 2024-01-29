<?php
session_start();
if (isset($_SESSION["user"])) {
    header("location: index.php");
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

    <div class="signup-main">
        <?php 
        if (isset($_POST["submit"])) {
            $user_name = $_POST["user_name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
            $surname = $_POST["surname"];
            $phone = $_POST["phone"];
            $street = $_POST["street"];
            $suburb = $_POST["suburb"];
            $postalCode = $_POST["postalCode"];

            $errors = array();

            if (empty($user_name) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($surname) OR empty($phone) OR empty($street) OR empty($suburb) OR empty($postalCode)){
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8){
                array_push($errors, "Password must be atleast 8 characters");
            }
            if ($password !== $passwordRepeat){
                array_push($errors, "Password does not match");
            }
            require_once "dbh.inc.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already exists!");
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (email, phone, full_name, surname, pass, street, suburb, postal_code) VALUES ('$email', '$phone', '$user_name', '$surname', '$password', '$street', '$suburb', '$postalCode')";
                if (mysqli_query($conn, $sql)) {
                    echo "<div class= 'alert alert-success'>You are registered.</div>";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Something went wrong.</div>";
                }
            }
        }
        ?>
        <form class="signup-form" method="post" action="signUp.php">
            <p id="signup-heading">Sign up</p>
            <div class="signup-field">
                <input autocomplete="off" placeholder="Name" class="signup-input-field" type="text" name="user_name">
            </div>
            <div class="signup-field">
                <input autocomplete="off" placeholder="Surname" class="signup-input-field" type="text" name="surname">
            </div>
            <div class="signup-field">
                <input autocomplete="off" placeholder="E-mail" class="signup-input-field" type="email" name="email">
            </div>
            <div class="signup-field">
                <input placeholder="Phone Number" class="signup-input-field" type="tel" name="phone">
            </div>
            <div class="signup-field">
                <input placeholder="Password" class="signup-input-field" type="password" name="password">
            </div>
            <div class="signup-field">
                <input placeholder="Confirm Password" class="signup-input-field" type="password" name="repeat_password">
            </div>
            <div class="signup-field">
                <input type="text" name="street" placeholder="street" class="signup-input-field">
            </div>
            <div class="signup-field">
                <input type="text" name="suburb" placeholder="suburb" class="signup-input-field">
            </div>
            <div class="signup-field">
                <input type="text" name="postalCode" placeholder="Postal code" class="signup-input-field">
            </div>
            <div class="signup-btn">
                <button class="signup-button1" type="submit" value="Register" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign up&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                <button class="signup-button2">Login</button>
            </div>
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