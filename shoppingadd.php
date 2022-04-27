<?php
/**
 * Author: Andrew Choi
 * Description: This page adds item to cart.
 */
    require_once 'includes/database.php';

    //Start a new session if it has not already started
    if (session_status() == PHP_SESSION_NONE) {  
        session_start();  
    } 

    if (isset($_SESSION['cart'])) {  
        $cart = $_SESSION['cart'];  
    } else {  
        $cart = array();  
    }

    //if there were problems retrieving product id, the script must end.
    if (!filter_has_var(INPUT_GET, 'id') ||
        !filter_has_var(INPUT_GET, 'quantity')) {
        $error = "product id not found. Operation cannot proceed.<br><br>";  
        header("Location: error.php?m=$error");  
        die();  
    }

    //retrieve, sanitize, and escape all fields from the form
    $id = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    $qty = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'quantity', FILTER_SANITIZE_NUMBER_INT)));

    if (!is_numeric($id) || !is_numeric($qty)) {  
    $error = "product id not found. Operation cannot proceed.<br><br>";  
        header("Location: error.php?m=$error");  
        die();  
    }
 
    if (array_key_exists($id, $cart)) {  
        $cart[$id] = $cart[$id] + $qty;  
    } else {  
        $cart[$id] = $qty;  
    }  

    //update the session variable  
    $_SESSION['cart'] = $cart;

    //redirect to the showcart page.  
    header('Location: shoppingcart.php');
?>