<?php
    require_once 'includes/database.php';
    
    if (session_status() == PHP_SESSION_NONE) {  
        session_start();  
    }
      
    //empty the shopping cart  
    $_SESSION['cart'] = null;  
    //set page title  
    $pageTitle = "Check Out - Steros Electronics";
    require_once 'includes/header.php';
    ?>
<div id='form'>
    <h2>Checkout</h2>
    <p>Thank you for shopping with us. Your business is greatly appreciated. You will be notified once your items are shipped.</p>
    <p><a href='index.php'>Go Back Home</a></p>
</div>
<?php  
    include ('includes/footer.php');  
?>  