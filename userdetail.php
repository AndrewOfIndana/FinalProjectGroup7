<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the user's details.
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

<h2>User Details</h2>

<table class="userlist">
    <tr>
        <th>User ID</th>
        <td><?php echo $row['id'] ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo $row['username'] ?></td>
    </tr>
    <tr>
        <th>Email Address</th>
        <td><?php echo $row['email'] ?></td>
    </tr>
    <tr>
        <th>Password</th>
        <td><?php echo $row['password'] ?></td>
    </tr>
</table>
<p>
    <a href="useredit.php?id=<?php echo $row['id'] ?>">Edit Account</a>
    <a href="userdelete.php?id=<?php echo $row['id'] ?>">Delete Account</a>
</div>

</p>
<p><a href="index.php">Back to Home</a></p>

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>