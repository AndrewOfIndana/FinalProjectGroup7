<?php
/**
 * Author: Andrew Choi
 * Description: This is the home page of Steros Electronics
 */
$page_title = "Browse Our Store - Steros Electronics";
require 'includes/header.php';
require_once('includes/database.php');

//SELECT statement
$sql = "SELECT * FROM products";

//execute the query
$query = @$conn->query($sql);

//Handle errors
if (!$query) {
    $errno = $conn->errno;
    $error = $conn->error;
    $conn->close();
    require 'includes/footer.php';
    die("Selection failed: ($errno) $error.");
}
?>

<div id="product">
    <h1>Our Products</h1>
    <h2>Search for any product by name</h2>
    <form action="searchresult.php" method="get">
        <input type="text" name="terms" size="70" required />&nbsp;&nbsp;
        <input type="submit" name="Submit" id="Submit" value="Search" />
    </form>
    <h2>Browse for products</h2>
    <table id="productlist" class="productlist">
        <tr class="firstRow">
            <th class="col1">Product Name</th>
            <th class="col2">Stock in Shelf Remaining</th>
            <th class="col3">Price</th>
        </tr>
        <!-- add PHP code here to list all books from the "books" table -->
        <?php
            while ($row = $query->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='productdetail.php?id=", $row['id'], "'>", $row['name'], "</a></td>";
                echo "<td>", $row['stock'], " remaining</td>";
                echo "<td>$", $row['price'], "</td>";
                echo "</tr>";
            }
            ?>
    </table>
</div>

<?php
include ('includes/footer.php');