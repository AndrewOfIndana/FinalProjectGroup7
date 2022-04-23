<?php
/**
 * Author: Andrew Choi
 * Description: This is the products page where it will list all products for the user, the user can click on a product, or use the search bar to look for a specific product
 */
$pageTitle = "Browse Our Store - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

//SELECT statement
$sql = "SELECT * FROM products";

//execute the query
$query = @$conn->query($sql);

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
?>
<div id="product">
    <h1>Our Products</h1>
    <h2>Search for any product by name</h2>
    <form action="productsearchresult.php" method="get">
        <input type="text" name="terms" required />&nbsp;&nbsp;
        <input type="submit" name="Submit" id="Submit" value="Search" />
    </form>
    <h2>Browse for products</h2>
    <table id="productlist" class="productlist">
        <tr class="firstRow">
            <th class="col1">Product Image</th>
            <th class="col2">Product Name</th>
            <th class="col3">Stock in Shelf Remaining</th>
            <th class="col4">Price</th>
        </tr>
        <?php
            while ($row = $query->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='productdetail.php?id=", $row['id'], "'><img src=", $row['image'], " width='75' height='75'/></a></td>";
                echo "<td><a href='productdetail.php?id=", $row['id'], "'>", $row['name'], "</a></td>";
                echo "<td>", $row['stock'], " remaining</td>";
                echo "<td>$", $row['price'], "</td>";
                echo "</tr>";
            }
            ?>
    </table>
</div>

<?php
require_once 'includes/footer.php';