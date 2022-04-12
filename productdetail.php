<?php
/**
 * Author: Andrew Choi
 * Description: This is the home page of Steros Electronics
 */
$page_title = "Product Details - Steros Electronics";
require 'includes/header.php';
require_once('includes/database.php');

//if product id cannot retrieved, terminate the script.
if (!filter_has_var(INPUT_GET, "id")) {
    $conn->close();
    require_once ('includes/footer.php');
    die("Your request cannot be processed since there was a problem retrieving book id.");
}

//retrieve product id from a query string variable.
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//MySQL SELECT statement
$sql = "SELECT * FROM products WHERE id=$id";

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

if (!$row = $query->fetch_assoc()) {
    $conn->close();
    require 'includes/footer.php';
    die("Product not found.");
}
?>

<div id="productDetails">
    <h2><?php echo $row['name'] ?></h2>
    <table id="productdetails" class="productdetails">
        <tr>
            <td class="col1">
                <img src="<?php echo $row['image'] ?>" alt="" width="500" />
            </td>
            <td class="col2">
                <h4>Category ID:</h4>
                <h4>Stock:</h4>
                <h4>Price:</h4>
                <h4>Description:</h4>
            </td>
            <td class="col3">
                <p><?php echo $row['category_id'] ?></p>
                <p><?php echo $row['stock'] ?> In Stock</p>
                <p>$<?php echo $row['price'] ?></p>
                <p><?php echo $row['description'] ?></p>
            </td>
        </tr>
    </table>
</div>

<?php
include ('includes/footer.php');