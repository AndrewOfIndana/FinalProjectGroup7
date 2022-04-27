<?php
    if (session_status() == PHP_SESSION_NONE) {  
        session_start();  
    }
    if (!isset($_SESSION['login'])) {  
        header("Location: usersignin.php");  
        exit();  
    }  
      
    //empty the shopping cart  
    $_SESSION['cart'] = null;  
    //set page title  
    $pageTitle = "Check Out - Steros Electronics";
    require_once 'includes/header.php';
    ?>
<div id='form'>
    <h2>Shopping Cart Cleared</h2>
    <p>Sorry to hear about that, please tell us why you canceled your order.</p>
    <p><a href='index.php'>Go Back Home</a></p>
</div>
<?php  
    include ('includes/footer.php');  
?>  