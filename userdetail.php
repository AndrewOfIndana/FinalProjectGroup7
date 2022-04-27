<?php
/**
 * Author: Andrew Choi
 * Description: This page displays user info.
 */ 
$pageTitle = "Your Account - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

//retrieve user id from a query string
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: user id was not found.";
    require_once 'includes/error.php';
    require_once 'includes/footer.php';
    exit();
}
$user_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//select statement
$sql = "SELECT * FROM users WHERE id=" . $user_id;
//execute the query
$query = $conn->query($sql);
//retrieve results
$row = $query->fetch_assoc();

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
//display results in a table
?>
<div class="useroptions">
    <a href="useredit.php?id=<?php echo $row['id'] ?>">Edit Account</a>
    <p> | </p>
    <a href="userdelete.php?id=<?php echo $row['id'] ?>">Delete Account</a>
    <p> | </p>
    <a href="index.php">Back to Home</a>
</div>
<div id="user">
    <h1>User Details</h1>
    <table class="userdetails">
        <tr>
            <th><p>User ID: </p></th>
            <td><p><?php echo $row['id'] ?></td>
        </tr>
        <tr>
            <th><p>Username: </p></th>
            <td><p><?php echo $row['username'] ?></p></td>
        </tr>
        <tr>
            <th><p>Email Address: </p></th>
            <td><p><?php echo $row['email'] ?></p></td>
        </tr>
        <tr>
            <th><p>Password: </p></th>
            <td><p><?php echo $row['password'] ?></p></td>
        </tr>
    </table>
</div>

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>