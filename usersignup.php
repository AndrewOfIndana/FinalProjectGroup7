<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the user to sign up and create an account.
 */
$pageTitle = "Sign Up - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

//check the login status
$login_status = '';  
if (isset($_SESSION['login_status']))  
$login_status = $_SESSION['login_status'];

//the user's last login attempt succeeded  
if ($login_status == 1) {  
    echo "<div id='form'>";
        echo "<h2>New User Account has been Created</h2>";
        echo "<p><a href='userdetail.php?id=" . $_SESSION['id'] . "'>Go To Account</a></p>";
        echo "<a href='userlogout.php'>Logout</a><br />";  
    echo "</div>";
    include ('includes/footer.php');  
    exit();  
}
?>
<div id="form">
    <h1>Sign Up</h1>
    <form action="usercreate.php" method="post">
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
            <input name="password" type='password' required />
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