<?php
/**
 * Author: Andrew Choi
 * Description: This page displays all of the items inside of shopping cart
 */
$pageTitle = "Shopping Cart - Steros Electronics";
require_once 'includes/header.php';
require_once 'includes/database.php';

if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    echo "<div id='form'>";
        echo "<h2>Your shopping cart is empty.</h2>";
        echo "<p><a href='product.php'>Go To Store</a></p>";
    echo "</div>";
    include ('includes/footer.php');
    exit();
}

//proceed since the cart is not empty
$cart = $_SESSION['cart'];
$total = 0;

?>
<div id="shoppingcart">
    <h1>My Shopping Cart</h1>
    <table id="productlist" class="productlist">
        <tr class="firstRow">
            <th class="col1">Product Image</th>
            <th class="col2">Product Name</th>
            <th class="col4">Price</th>
            <th class="col4">Quantity</th>
            <th class="col4">Price</th>
        </tr>
        <?php
            //select statement  
            $sql = "SELECT id, image, name, price FROM products WHERE 0";  
            foreach (array_keys($cart) as $id) {  
                $sql .= " OR id=$id";  
            }
            //execute the query  
            $query = $conn->query($sql);

            //fetch products and display them in a table  
            while ($row = $query->fetch_assoc()) {
                $id = $row['id'];
                $image = $row['image'];  
                $name = $row['name']; 
                $qty = $cart[$id];
                $price = $row['price'];  
                $subtotal = $qty * $price;  
                $total = $total + $subtotal;

                echo "<tr>";
                    echo "<td><a href='productdetail.php?id=$id'><img src='$image' width='75' height='75'/></a></td>";
                    echo "<td><a href='productdetail.php?id=$id'>$name</a></td>";
                    echo "<td>$$price</td>";
                    echo "<td>$qty</td>";
                    echo "<td>$$subtotal</td>";
                echo "</tr>";
            }
            ?>
    </table>
    <h2>Your total is $<?php echo $total ?></h2>
</div>
<div id="shoppingform">
    <input type="button" class="Submit" value="Checkout" onclick="window.location.href = 'shoppingcheckout.php'"/>
    <input type="button" class="Submit" value="Clear Cart" onclick="window.location.href = 'shoppingclear.php'"/>
    <input type="button" class="Submit" value="Cancel" onclick="window.location.href = 'product.php'" />
</div>
<br><br>

<?php
include ('includes/footer.php');
