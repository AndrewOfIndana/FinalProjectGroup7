<?php
/**
 * Author: Andrew Choi, Paul Lanier
 * Description: This page allows the user to add a new product
 */
$pageTitle = "Add New Product - Steros Electronics";
require_once 'includes/header.php';
?>
<div id="form">
    <h1>Add New Product</h1>
    <form action="productcreate.php" method="post">
        <div class="formRowSingle">
            <p>Product Name: </p>
            <input name="product_name" type="text" required />
        </div>
        <div class="formRowDouble">
            <p>Amount in Stock: </p>
            <input name="stock" type="number"  required />
            <p>Price: </p>
            <input name="price" type="number" step="0.01" required />
        </div>
        <div class="formRowSingle">
            <p>Category: </p> 
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
            <input name="image" type="text" required />
        </div>
        <div class="formRowTextarea">
            <p>Description: </p> 
            <textarea name="description" rows="10" cols="80" required></textarea>
        </div>
        <input type="submit" class="Submit" value="Add Product" />
        <input type="button" class="Submit" value="Cancel" onclick="window.location.href='product.php'" />
    </form>
</div>
<?php
require_once 'includes/footer.php';
