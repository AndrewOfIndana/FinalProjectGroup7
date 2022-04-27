<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the user to sign in into their account.
 */
$pageTitle = "Log In - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

$message = "";
//check the login status
$login_status = '';  
if (isset($_SESSION['login_status']))  
$login_status = $_SESSION['login_status'];

//the user's last login attempt succeeded  
if ($login_status == 1) {  
    echo "<div id='form'>";
        echo "<h2>Login Successful, Welcome to the site " . $_SESSION['login'] . "</h2>";
        echo "<p><a href='userdetail.php?id=" . $_SESSION['id'] . "'>Go To Account</a></p>";
        echo "<a href='userlogout.php'>Logout</a><br />";  
    echo "</div>";
    include ('includes/footer.php');  
    exit();  
}
//the user's last login attempt failed  
if($login_status == 2) {  
    $message = "Username or password invalid. Please try again.";  
}

?>
<div id="form">
    <p><?php echo $message; ?></p><br><br>
    <h1>Log In</h1>
    <form action="userlogin.php" method="post">
        <div class="formRowSingle">
            <p>User Name: </p>
            <input name="user_name" type="text" required />
        </div>
        <div class="formRowSingle">
            <p>Password: </p>
            <input name="password" type='password' required />
        </div>
        <input type="submit" name="Submit" class="Submit" value="Login" />
        <input type="button" class="Submit" value="Cancel" onclick="window.location.href='index.php'" />
    </form>
</div>

</form>

<?php
//include the footer
require_once 'includes/footer.php';
?>