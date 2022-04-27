<?php
/**
 * Author: Andrew Choi
 * Description: This is the about page of the website
 */
$pageTitle = "About Us - Steros Electronics";
require_once 'includes/header.php';
?>
<div id="about">
    <h1>Meet Our Team</h1>
    <table>
        <tr>
            <td>
                <img src="assets/about01.png" width="200px" height="200px"><div class="aboutText">
                <h2>Albert West</h2>
                <p>CEO and President</p></div>
            </td>
            <td>
                <img src="assets/about02.jpg" width="200px" height="200px"><div class="aboutText">
                <h2>Louis Joplis</h2>
                <p>Sales Executive Manager</p></div>
            </td>
        </tr>
        <tr>
            <td>
                <img src="assets/about03.png" width="200px" height="200px"><div class="aboutText">
                <h2>Janet Harrison</h2>
                <p>Chief Operating Officer</p></div>
            </td>
            <td>
                <img src="assets/about04.jpg" width="200px" height="200px"><div class="aboutText">
                <h2>Larry Ken</h2>
                <p>Chief Financial Officer</p></div>
            </td>
        </tr>
        <tr>
            <td>
                <img src="assets/about05.jpg" width="200px" height="200px"><div class="aboutText">
                <h2>Elliot Chamner</h2>
                <p>Chief Marketing Officer</p></div>
            </td>
            <td>
                <img src="assets/about06.jpg" width="200px" height="200px"><div class="aboutText">
                <h2>Terry Cartington</h2>
                <p>Human Resources Manager</p></div>
            </td>
        </tr>
    </table>
</div>

<?php
include ('includes/footer.php');