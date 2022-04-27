<?php
/**
 * Author: Andrew Choi
 * Description: This page validates if the user signs in or not.
 */
require_once 'includes/database.php';

//start session if it has not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//create variable login status.
$_SESSION['login_status'] = 2;
$username = $passcode = "";

//retrieve user name and password from the form in the login form
if (filter_has_var(INPUT_POST, 'user_name') || filter_has_var(INPUT_POST, 'password')) {
    $username = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING)));
    $password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
}

//validate user name and password against a record in the users table in the database. If they are valid, create session variables.
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$query = @$conn->query($sql);  
if ($query->num_rows) {  
    //It is a valid user. Need to store the user in session variables.  
    $row = $query->fetch_assoc();
    $_SESSION['id'] = $row['id'];   
    $_SESSION['login'] = $username;  
    $_SESSION['role'] = $row['role'];  
    $_SESSION['login_status'] = 1;  
}
//close the connection
$conn->close();

//redirect to the loginform.php page
header("Location: usersignin.php");
?>
