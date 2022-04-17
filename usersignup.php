<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the user to sign up and create an account.
 */
$pageTitle = "Sign Up - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';
?>

<h2>Sign Up</h2>

<form action="usercreate.php" method="get">
    <table class="newuser">
        <tr>
            <td>User Name: </td>
            <td><input name="user_name" type="text" required /></td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td><input name="user_email" type="email" size="40" required /></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input name="password" type="text" size="40" required /></td>
        </tr>
    </table>
    <input type="submit" name="Submit" id="Submit" value="Sign Up" />
</form>

<?php
//include the footer
require_once 'includes/footer.php';
?>