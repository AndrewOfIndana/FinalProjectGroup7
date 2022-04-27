<?php
/**
/**
 * Author: Andrew Choi, Paul Lanier
 * Description: This page allows the user to edit a product
 */
$pageTitle = "Edit Product - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

//retrieve product id from a query string
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: product id was not found.";
    require_once 'includes/error.php';
    require_once 'includes/footer.php';
    exit;
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//select statement
$sql = "SELECT * FROM products WHERE id=" . $id;
//execute the query
$query = $conn->query($sql);
//retrieve results
$row = $query->fetch_assoc();

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
//display results in a table
?>
<div id="form">
    <h1>Edit Product</h1> 
    <form name="editproduct" action="productupdate.php" method="get">
        <div class="formRowSingle">
            <p>Product ID: </p>
            <input name="id" value="<?php echo $row['id'] ?>" readonly="readonly" />
        </div>
        <div class="formRowSingle">
            <p>Product Name: </p>
            <input name="product_name" type="text" value="<?php echo $row['name'] ?>" required />
        </div>
        <div class="formRowDouble">
            <p>Amount in Stock: </p>
            <input name="stock" type="number" value="<?php echo $row['stock'] ?>" required />
            <p>Price: </p>
            <input name="price" type="number" step="0.01" value="<?php echo $row['price'] ?>" required />
        </div>
        <div class="formRowDouble">
            <p>Old Category: </p> 
            <input name="category" value="<?php echo $row['category_id'] ?>" readonly="readonly" />
            <p>New Category: </p> 
            <select name="category">
                <option value="1">1 - Computers, Printers, and Scanners</option>
                <option value="2">2 - Laptops and Tablets</option>
                <option value="3">3 - Phones and Phone Accessories</option>
                <option value="4">4 - TVs and Monitors</option>
                <option value="5">5 - Electronic Parts</option>
                <option value="6">6 - Screws and Batteries</option>
                <option value="7">7 - Cords and Wires</option>
                <option value="8">8 - Other Accessories</option>
            </select>
        </div>
        <div class="formRowSingle">
            <p>Image: </p>
            <input name="image" type="text" value="<?php echo $row['image'] ?>" required />
        </div>
        <div class="formRowTextarea">
            <p>Description: </p> 
            <textarea name="description" rows="10" cols="80" value="<?php echo $row['description']?>"  required></textarea>
        </div>
        <input type="submit" class="Submit" value="Update">
        <input type="button" class="Submit" onclick="window.location.href='productdetail.php?id=<?php echo$row['id'] ?>'" value="Cancel">
        <input type="button" class="Submit" onclick="window.location.href='product.php'" value="Back to Store">
    </form>
</div>
<?php
// clean up result sets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once 'includes/footer.php';
?>