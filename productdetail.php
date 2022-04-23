<?php
/**
 * Author: Andrew Choi
 * Description: This page details the product,admin's can delete or edit the page, and the customer can put his page on their shopping cart.
 */
$pageTitle = "Product Details - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

//if product id cannot retrieved, terminate the script.
if (!filter_has_var(INPUT_GET, "id")) {
    echo "Your request cannot be processed since there was a problem retrieving product id";
    $conn->close();
    require_once 'includes/error.php';
    require_once 'includes/footer.php';
    exit;
}

//retrieve product id from a query string variable.
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//MySQL SELECT statement
$sql = "SELECT * FROM products WHERE id=$id";

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

if (!$row = $query->fetch_assoc()) {
    $conn->close();
    require 'includes/footer.php';
    die("Product not found.");
}
?>
<div class="adminEdit">
    <a href="productedit.php?id=<?php echo $row['id'] ?>">Edit Product</a>
    <p> | </p>
    <a href="productdelete.php?id=<?php echo $row['id'] ?>">Delete Product</a>
</div>
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
            <td>
                
            </td>
        </tr>
    </table>
    <br><br>
    <div id="form">
        <h2>Make an order</h2>
        <form name="productbuy" action="shoppingadd.php" method="get">
            <div class="formRowSingle">
                <p>Name: </p>
                <input name="product_name" type="text" value="<?php echo $row['name'] ?>" readonly="readonly" />
            </div>
            <div class="formRowDouble">
                <p>Price of 1: </p>
                <input name="price" type="number" step="0.01" value="<?php echo $row['price'] ?>" readonly="readonly" />
                <p>Quantity: </p>
                <input name="quantity" type="number" required />
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            <input type="submit" class="Submit" value="Make An Order">
        </form>
    </div>
</div>

<?php
require_once 'includes/footer.php';
