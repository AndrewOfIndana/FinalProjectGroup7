<?php
/**
 * Author: Andrew Choi
 * Description: This page registers new account.
 */ 
//retrieve user inputs from the form
if(!filter_has_var(INPUT_POST, 'user_name') || 
        !filter_has_var(INPUT_POST, 'user_email') ||
        !filter_has_var(INPUT_POST, 'password') ) {
    $error = "The service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}

require_once 'includes/database.php';

//retrieve, sanitize, and escape user's input from a form
$user_name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING)));
$user_email = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_STRING)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
$role = 2;  //regular user

//Define MySQL insert statement
$sql = "INSERT INTO users VALUES (NULL, '$user_name', '$user_email', '$password',
'$role')";

//Execute the query
$query = @$conn->query($sql); 

//determine the id of the newly added user
$id = $conn->insert_id;

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $error = $conn->error;
    $error = "Insertion failed with: ($errno) $error.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$conn->close();

//start session if it has not already started
if (session_status() == PHP_SESSION_NONE) {  
    session_start();  
}  
//create session variables
$_SESSION['id'] = $id;
$_SESSION['login'] = $user_name;  
$_SESSION['role'] = 2;
$_SESSION['login_status'] = 1;  

header("Location: usersignup.php");  