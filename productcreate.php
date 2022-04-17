<?php
/**
 * Author: Andrew Choi
 * Description: This is the page where new products are added into the database
 */
$pageTitle = "Product Added - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';
 
//if the script did not received post data, display an error message and then terminite the script immediately
if (!filter_has_var(INPUT_POST, 'product_name') ||
        !filter_has_var(INPUT_POST, 'stock') ||
        !filter_has_var(INPUT_POST, 'price') ||
        !filter_has_var(INPUT_POST, 'category') ||
        !filter_has_var(INPUT_POST, 'image') ||
        !filter_has_var(INPUT_POST, 'description')) {   
    echo "There were problems retrieving product details. New product cannot be added.";
    $conn->close();
    require_once 'includes/error.php';
    require_once 'includes/footer.php';
    die();
}

//retrieve, sanitize, and escape user's input from a form
$product_name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING)));
$stock = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, 
FILTER_FLAG_ALLOW_FRACTION)));
$category = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_DEFAULT)));
$image = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

//Define MySQL insert statement
$sql = "INSERT INTO products VALUES (NULL, '$product_name', '$stock', '$price',
'$category', '$image', '$description')";

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

//determine the id of the newly added product
$id = $conn->insert_id;

// close the connection.
$conn->close();

//display a confirmation message and a link to display details of the new product
echo "<div id='form'>";
    echo "<h2>You have successfully added the new product into the database.</h2>";
    echo "<p><a href='productdetail.php?id=$id'>See New Product</a></p>";
echo "</div>";

require_once 'includes/footer.php';

