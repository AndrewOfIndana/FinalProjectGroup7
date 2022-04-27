<?php
/**
 * Author: Andrew Choi
 * Description: This page deletes account and ends session.
 */ 
$pageTitle = "Account Deleted - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';


//if there were problems retrieving user id, the script must end.
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: user id was not found.";
    require_once 'includes/error.php';
    require_once 'includes/footer.php';
    exit();
}

//retrieve, sanitize, and escape all fields from the form
$id = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//Define MySQL insert statement
$sql = "DELETE FROM users WHERE id='$id'";

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

//start session if it has not already started  
if (session_status() == PHP_SESSION_NONE) {  
    session_start();  
}  
//unset all the session variables  
$_SESSION = array();  
//delete the session cookie  
setcookie(session_name(), "", time() - 3600);  
//destroy the session  
session_destroy();

//close database connection
$conn->close();

//display a confirmation message
echo "<div id='form'>";
    echo "<h2>You have successfully deleted your account.</h2>";
    echo "<p><a href='index.php'>Back to Home</a></p>";
echo "</div>";

require_once 'includes/footer.php';