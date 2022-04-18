<?php
/**
 * Author: Andrew Choi
 * Description: This page updates an user's account.
 */
$pageTitle = "Account Updated - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';
 
//retrieve, sanitize, and escape all fields from the form
$id = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT)));
$user_name = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'user_name', FILTER_SANITIZE_STRING)));
$user_email = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'user_email', FILTER_SANITIZE_EMAIL)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING)));

 
//Define MySQL update statement
$sql = "UPDATE users SET
username='$user_name',
email='$user_email',
password='$password' WHERE id=$id";

//Execute the query.
$query = @$conn->query($sql);
 
//Handle selection errors
if(!$query) {
    $errno = $conn->errno;
   $errmsg = $conn->error;
   echo "Insertion failed with: ($errno) $errmsg<br/>\n";
   $conn->close();
   require_once 'includes/error.php';
   require_once 'includes/footer.php';
   exit;
}
echo "<div id='form'>";
    echo "<h2>Account has been updated.</h2>";
    echo "<p><a href='userdetail.php?id=$id'>Go To Account</a></p>";
echo "</div>";

// close the connection.
$conn->close();

require_once 'includes/footer.php';
