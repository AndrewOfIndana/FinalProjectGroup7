<?php
/**
 * Author: Andrew Choi, Abraham Johnson
 * Description: This is the database that holds all products, and users info
 */
//define parameters
$host = "localhost";
$login = "phpuser";
$password = "phpuser";
$database = "steros_electronics_db";

//Connect to the mysql server
$conn = @new mysqli($host, $login, $password, $database);

//handle connection errors
if ($conn->connect_errno != 0) {
    $errno = $conn->connect_errno;
    $errmsg = $conn->connect_error;
    die ("Connection failed with: ($errno) $errmsg.");
}