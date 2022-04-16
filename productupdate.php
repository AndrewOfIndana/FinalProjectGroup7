<?php
/**
 * Author: Andrew Choi
 * Description: This page updates a product's detaills.
 */
$pageTitle = "Product Edited - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';
 
//retrieve, sanitize, and escape all fields from the form
$id = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
$product_name = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'product_name', FILTER_SANITIZE_STRING)));
$stock = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'stock', FILTER_SANITIZE_NUMBER_INT)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'price', FILTER_SANITIZE_NUMBER_FLOAT)));
$category = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_DEFAULT)));
$image = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));
 
//Define MySQL update statement
$sql = "UPDATE products SET
product_name='$product_name',
stock='$stock',
price='$price',
category='$category',
image='$image',
description='$description' WHERE id=$id";

//Execute the query.
$query = @$conn->query($sql);
 
//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Connection Failed with: $errno, $errmsg<br/>\n";
    include ('includes/footer.php');
    exit;
}
echo "Your account has been updated.";
 
// close the connection.
$conn->close();

require_once 'includes/footer.php';
