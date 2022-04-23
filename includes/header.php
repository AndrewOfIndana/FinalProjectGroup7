<?php
if (session_status() == PHP_SESSION_NONE) {  
        session_start();  
    }
    
    $count=0;  

    //retrieve cart content  
    if (isset($_SESSION['cart'])) {  
        $cart = $_SESSION['cart'];

        if ($cart) {  
        $count = array_sum($cart);  
        }  
    }  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="css/styles.css" />
    </head>

    <body>
        <div class="header">
            <div class="navbarTop">
                <a href="index.php">
                    <img src="assets/logo.png" height = "75px">
                </a>
                <div class="userLinks">
                    <a href="productnew.php">Add New Product</a><p>|</p>
                    <a href="userdetail.php?id=1">My Account</a><p>|</p>
                    <a href="usersignup.php">Sign Up</a>
                </div>
            </div>
            <div class="navbarBottom">
                <div class="links">
                    <a href="index.php">Home</a><p> | </p>
                    <a href="product.php">Browse Store</a><p> | </p>
                    <a href="shoppingcart.php">Shopping Cart - (<?php echo $count ?>)</a><p> | </p>
                    <a href="about.php">About Us</a><p> | </p>
                    <a href="contact.php">Contact</a>
                </div>
            </div>
        </div>

        <div class="contentBody">
