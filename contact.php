<?php
/**
 * Author: Andrew Choi
 * Description: This is the contact page of Steros Electronics
 */
$pageTitle = "Contact Us - Steros Electronics";
require_once 'includes/header.php';
?>

<div id="contact">
    <h1>Contact Us</h1>
    <form name="contactForm" action="contact.php" method="post">
        <div class="formRowDouble">
            <p>Firstname: </p>
            <input type="text" name="firstname" required>
            <p>Lastname: </p>
            <input type="text" name="lastname" required>
        </div>
        <div class="formRowSingle">
            <p>E-mail: </p><input type="text" name="email " required>
        </div>
        <div class="formRowTextarea">
            <p>Message: </p>: <textarea name="message" rows="10" cols="80" required></textarea></textarea>
        </div>
        <input type="submit" class="Submit" value="Submit Message" />
	</form>
</div>

<?php
require_once 'includes/footer.php';