<?php
/**
 * Author: Andrew Choi
 * Description: This page create a new account.
 */
$pageTitle = "Account Created - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';
 
//retrieve, sanitize, and escape user's input from a form
$user_name = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'user_name', FILTER_SANITIZE_STRING)));
$user_email = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'user_email', FILTER_SANITIZE_EMAIL)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING)));
 
 
//Define MySQL insert statement
$sql = "INSERT INTO users VALUES (NULL, '$user_name', '$user_email', '$password',
'2')";

//Execute the query
$query = @$conn->query($sql); 

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

$conn->close();
 
echo "New User Account has been Created.";
echo "<p><a href='userdetail.php?id=$id'>Go To Account</a></p>";

include 'includes/footer.php';
