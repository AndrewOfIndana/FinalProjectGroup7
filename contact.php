<?php
/**
 * Author: Andrew Choi
 * Description: This is the contact page of Steros Electronics
 */
$pageTitle = "Contact Us - Steros Electronics";
include ('includes/header.php');
?>

<div id="contact">
    <h1>Contact Us</h1>
    <form name="contactForm" action="contact.php" method="post">
        <div class="contactNamesRow">
            <p>Firstname: </p><input type="text" name="firstname" required>
            <p>Lastname: </p><input type="text" name="lastname" required>
        </div>
        <div class="contactEmailRow">
            <p>E-mail: </p><input type="text" name="email " required>
        </div>
        <div class="contactMessageRow">
            <p>Message: </p>: <textarea name="message" rows="10" cols="80" required></textarea></textarea>
        </div>
        <div class="contactSubmit">
            <input type="submit" value="Submit Message" />
        </div>
	</form>
    <?php
        echo "<br><br><h2>Your message has been sent</h2>";
    ?>
</div>

<?php
include ('includes/footer.php');