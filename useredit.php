<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the user to edit their account.
 */
$pageTitle = "Edit Account - Steros Electronics";
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
<div id="form">
    <h2>Edit User Details</h2> 

    <form name="edituser" action="userupdate.php" method="get">
        <table class="userdetails">
            <tr>
                <th>User ID</th>
                <td><input name="user_id" value="<?php echo $row['id'] ?>" readonly="readonly" /></td>
            </tr>
            <tr>
                <th>Username: </th>
                <td><input name="user_name" value="<?php echo $row['username'] ?>" size="30" required /></td>
            </tr>
            <tr>
                <th>Email Address: </th>
                <td><input type="email" name="user_email" value="<?php echo $row['email'] ?>" size="40" required /></td>
            </tr>
            <tr>
                <th>Password: </th>
                <td><input name="password" value="<?php echo $row['password'] ?>" size="30" required /></td>
            </tr>
        </table>
        <br>
        <input type="submit" value="Update">&nbsp;&nbsp;
        <input type="button" onclick="window.location.href='userdetails.php?id=<?php echo$row['id'] ?>'" value="Cancel">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</div>
<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once 'includes/footer.php';
?>