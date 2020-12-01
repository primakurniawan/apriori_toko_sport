<?php
// Create database connection using config file
include_once("./../config.php");

// Fetch all users data from database
$resultProduct = mysqli_query($mysqli, "SELECT * FROM `product`");
$resultId = mysqli_query($mysqli, "SELECT orders.id FROM `orders` ORDER BY id DESC LIMIT 1");
$orderId = isset($_COOKIE['orderId']) ? (int)$_COOKIE['orderId'] : 0;

if ($orderId == 0) $orderId = (int)mysqli_fetch_array($resultId)['id'] + 1;
?>
<html>

<head>
    <title>Add Transaction</title>
</head>

<body>
    <a href="index.php">Go to Home</a>
    <br /><br />

    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Product</td>
                <td>
                    <select name="product" id="product">
                        <?php while ($product = mysqli_fetch_array($resultProduct)) : ?>

                            <option value="<?php echo $product['id'] ?>">
                                <?php echo $product['name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>quantity</td>
                <td><input type="number" name="quantity"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
                <td><input type="submit" name="Save" value="Save"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $productId = (int)$_POST['product'];
        $quantity = (int)$_POST['quantity'];

        // include database connection file
        include_once("./../config.php");

        // Insert user data into table
        $resultOrderId = mysqli_query($mysqli, "INSERT INTO `orders`() VALUES ()");
        $result = mysqli_query($mysqli, "INSERT INTO order_items(order_id, product_id, quantity) VALUES ('$orderId','$productId','$quantity')");

        setcookie('orderId', $orderId, time() + 60);

        // Show message when user added
        echo "Transaction added successfully. <a href='index.php'>View Product</a>";
    }
    ?>
</body>

</html>