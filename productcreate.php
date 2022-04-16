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
    require_once 'includes/footer.php';
    $conn->close();
    die();
}

//retrieve, sanitize, and escape user's input from a form
$product_name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING)));
$stock = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT)));
$category = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_DEFAULT)));
$image = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

//Define MySQL insert statement
$sql = "INSERT INTO products VALUES (NULL, '$product_name', '$stock', '$price',
'$category', '$image', '$description')";

//Execute the query
$query = @$conn->query($sql); 

//handle error
if(!$query) {
    $errno = $conn->errno;
   $errmsg = $conn->error;
   echo "Insertion failed with: ($errno) $errmsg<br/>\n";
   $conn->close();
   include 'includes/footer.php';
   exit;
}

//determine the id of the newly added product
$id = $conn->insert_id;

// close the connection.
$conn->close();

//display a confirmation message and a link to display details of the new product
echo "You have successfully added the new product into the database.";
echo "<p><a href='productdetails.php?id=$id'>See New Product</a></p>";
require_once 'includes/footer.php';
