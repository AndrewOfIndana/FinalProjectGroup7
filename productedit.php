<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the admin to edit a product's detail's.
 */
$pageTitle = "Edit Product - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

//retrieve user id from a query string
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
<h2>Edit Product</h2> 
<form name="editproduct" action="productupdate.php" method="get">
    <table class="editproductdetails">
        <tr>
            <th>Product ID</th>
            <td><input name="id" value="<?php echo $row['id'] ?>" readonly="readonly" /></td>
        </tr>
        <tr>
            <th>Product Name</th>
            <td><input name="product_name" type="text" value="<?php echo $row['name'] ?>" required /></td>
        </tr>
        <tr>
            <th>Amount in Stock</th>
            <td><input name="stock" type="number" value="<?php echo $row['stock'] ?>" required /></td>
        </tr>
        <tr>
            <th>Price</th>
            <td><input name="price" type="number" step="0.01" value="<?php echo $row['price'] ?>" required /></td>
        </tr>
        <tr>
            <th>Category</th>
            <td>
                <input name="category" value="<?php echo $row['category_id'] ?>" readonly="readonly" />
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
            </td>
        </tr>
        <tr>
            <th>Image</th>
            <td><input name="image" type="text" size="100" value="<?php echo $row['image'] ?>" required /></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><input name="description" value="<?php echo $row['description']?>" rows="6" cols="65"></input></td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Update">&nbsp;&nbsp;
    <input type="button" onclick="window.location.href='productdetail.php?id=<?php echo$row['id'] ?>'" value="Cancel">
</form>
<p><a href="product.php">Back to the Store</a></p>

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once 'includes/footer.php';
?>