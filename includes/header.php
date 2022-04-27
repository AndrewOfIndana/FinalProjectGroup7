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

    //variables for a user’s login, name, and role  
    $login = '';  
    $id = 0;
    $role = 0;

    //if the use has logged in, retrieve login, name, and role.  
    if (isset($_SESSION['login']) AND  
    isset($_SESSION['role']))   {  
        $login = $_SESSION['login'];  
        $id = $_SESSION['id'];  
        $role = $_SESSION['role'];  
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
                <?php  
                    if ($role == 1) {  
                        echo "<a href='productnew.php'>Add New Product</a><p>|</p>";  
                    }  
                    if (empty($login)) {
                        echo "<a href='usersignin.php'>Login</a><p>|</p>";
                        echo "<a href='usersignup.php'>Sign Up</a>";
                    }
                    else {  
                        echo "<a href='userdetail.php?id=$id'>My Account</a><p>|</p>";
                        echo "<a href='userlogout.php'>Logout</a>";
                    }  
                ?>
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
