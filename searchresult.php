<?php
/**
 * Author: Andrew Choi
 * Description: This is the home page of Steros Electronics
 */
$page_title = "Search Results - Steros Electronics";

require_once ('includes/header.php');
require_once('includes/database.php');

if (filter_has_var(INPUT_GET, "terms")) {
    $terms_str = filter_input(INPUT_GET, 'terms', FILTER_SANITIZE_STRING);
} else {
    echo "There was not search terms found.";
    include ('includes/footer.php');
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
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg.";
    $conn->close();
    include ('includes/footer.php');
    exit;
}
?>

<div id="product">
    <h1>Our Products</h1>
    <h2>Search for any product by name</h2>
    <form action="searchresult.php" method="get">
        <input type="text" name="terms" size="70" required />&nbsp;&nbsp;
        <input type="submit" name="Submit" id="Submit" value="Search" />
    </form>
    <?php
    echo "<h3>Terms Used: $terms_str </h3>";
    //display results in a table
    if ($query->num_rows == 0)
        echo "Your search <i>'$terms_str'</i> did not match any products in our inventory";
    else {
?>
    <h2>Browse for products</h2>
    <table id="productlist" class="productlist">
        <tr class="firstRow">
            <th class="col1">Product Name</th>
            <th class="col2">Stock in Shelf Remaining</th>
            <th class="col3">Price</th>
        </tr>
        <!-- add PHP code here to list all books from the "books" table -->
        <?php
            while (($row = $query->fetch_assoc()) !== NULL) {
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
}
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

include ('includes/footer.php');
