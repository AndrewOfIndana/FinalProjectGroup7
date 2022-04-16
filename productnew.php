<?php
/**
 * Author: Andrew Choi
 * Description: This page allows the admin to add a new product.
 */
$pageTitle = "Add New Product - Steros Electronics";
require_once 'includes/header.php';
?>
<h2>Add New Product</h2>

<form action="productcreate.php" method="post">
    <table class="newproduct">
        <tr>
            <td>Product Name: </td>
            <td><input name="product_name" type="text" required /></td>
        </tr>
        <tr>
            <td>Amount in Stock: </td>
            <td><input name="stock" type="number"  required /></td>
            <td>Price: </td>
            <td><input name="price" type="number" step="0.01" required /></td>
        </tr>
        <tr>
            <td>Category: </td>
            <td>
                <select name="category">
                    <option value="1">Computers, Printers, and Scanners</option>
                    <option value="2">Laptops and Tablets</option>
                    <option value="3">Phones and Phone Accessories</option>
                    <option value="4">TVs and Monitors</option>
                    <option value="5">Electronic Parts</option>
                    <option value="6">Screws and Batteries</option>
                    <option value="7">Cords and Wires</option>
                    <option value="8">Other Accessories</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Image: </td>
            <td><input name="image" type="text" size="100" required /></td>
        </tr>
        <tr>
            <td>Description: </td>
            <td><textarea name="description" rows="6" cols="65"></textarea></td>
        </tr>
    </table>
        <input type="submit" value="Add Product" />
        <input type="button" value="Cancel" onclick="window.location.href='product.php'" />
</form>

<?php
require_once 'includes/footer.php';
