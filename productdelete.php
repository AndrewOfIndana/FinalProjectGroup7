<?php
/**
 * Author: Andrew Choi, Paul Lanier
 * Description: This page deletes products from database
 */
$pageTitle = "Product Deleted - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';


//if there were problems retrieving product id, the script must end.
if(!filter_has_var(INPUT_GET, 'id')) {
    echo "Deletion cannot continue since there were problems retrieving product id";
    require_once 'includes/error.php';
    require_once 'includes/footer.php';
    exit;
}

//retrieve, sanitize, and escape all fields from the form
$id = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//Define MySQL insert statement
$sql = "DELETE FROM products WHERE id='$id'";

//Execute the query
$query = @$conn->query($sql); 

//Handle errors
if(!$query) {
    $errno = $conn->errno;
   $errmsg = $conn->error;
   echo "Insertion failed with: ($errno) $errmsg<br/>\n";
   $conn->close();
   require_once 'includes/error.php';
   require_once 'includes/footer.php';
   exit;
}

//close database connection
$conn->close();

//display a confirmation message
echo "<div id='form'>";
    echo "<h2>You have successfully deleted a product from the database.</h2>";
    echo "<p><a href='product.php'>Go Back to Store</a></p>";
echo "</div>";

require_once 'includes/footer.php';