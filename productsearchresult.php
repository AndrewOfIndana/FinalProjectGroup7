<?php
/**
 * Author: Andrew Choi
 * Description: This page displays the search results of the user
 */
$pageTitle = "Search Results - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

if (filter_has_var(INPUT_GET, "terms")) {
    $terms_str = filter_input(INPUT_GET, 'terms', FILTER_SANITIZE_STRING);
} else {
    echo "There was not search terms found.";
    require_once 'includes/footer.php';
    exit;
}

//explode the search terms into an array
$terms = explode(" ", $terms_str);

//select statement using pattern search. Multiple terms are concatnated in the loop.
$sql = "SELECT * FROM products WHERE 1";
foreach ($terms as $term) {
    $sql .= " AND name LIKE '%$term%'";
}

//execute the query
$query = $conn->query($sql);

//Handle selection errors
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
        <input type="text" name="terms" size="70" required />&nbsp;&nbsp;
        <input type="submit" name="Submit" id="Submit" value="Search" />
    </form>
    <?php
    echo "<h3>Terms Used: $terms_str </h3>";
    //display results in a table
    if ($query->num_rows == 0)
        echo "<p>Your search <i>'$terms_str'</i> did not match any products in our inventory</p>";
    else {
?>
    <h2>Browse for products</h2>
    <table id="productlist" class="productlist">
        <tr class="firstRow">
            <th class="col1">Product Image</th>
            <th class="col2">Product Name</th>
            <th class="col3">Stock in Shelf Remaining</th>
            <th class="col4">Price</th>
        </tr>
        <!-- add PHP code here to list all books from the "books" table -->
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
}
// clean up resultsets when we're done with them!
$query->close();
// close the connection.
$conn->close();

require_once 'includes/footer.php';
