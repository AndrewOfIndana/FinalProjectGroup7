<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the user to sign up and create an account.
 */
$pageTitle = "Sign Up - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';
?>
<div id="form">
    <h1>Sign Up</h1>
    <form action="usercreate.php" method="get">
        <div class="formRowSingle">
            <p>User Name: </p>
            <input name="user_name" type="text" required />
        </div>
        <div class="formRowSingle">
            <p>E-mail: </p>
            <input name="user_email" type="email" required />
        </div>
        <div class="formRowSingle">
            <p>Password: </p>
            <input name="password" type="text" required />
        </div>
        <input type="submit" name="Submit" class="Submit" value="Sign Up" />
        <input type="button" class="Submit" value="Cancel" onclick="window.location.href='index.php'" />
    </form>
</div>

</form>

<?php
//include the footer
require_once 'includes/footer.php';
?>