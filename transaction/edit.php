<?php
// include database connection file
include_once("./../config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $productId = (int)$_POST['name'];
    $quantity = (int)$_POST['quantity'];

    // update user data
    $result = mysqli_query($mysqli, "UPDATE product SET product_id='$product_id',quantity='$quantity' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM order_items INNER JOIN product ON order_items.product_id = product.id INNER JOIN orders ON order_items.order_id = orders.id WHERE order_items.id='$id'");

while ($product = mysqli_fetch_array($result)) {
    $name = $product['name'];
    $quantity = $product['quantity'];
}

$resultProduct = mysqli_query($mysqli, "SELECT * FROM `product`");
var_dump($name);
var_dump((int)$quantity);
?>
<html>

<head>
    <title>Edit transaction Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="update_product" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Product</td>
                <td>
                    <select name="name" id="name">
                        <option selected value="<?php echo $idProduct ?>"><?php echo $name ?></option>
                        <?php while ($product = mysqli_fetch_array($resultProduct)) : ?>

                            <option value="<?php echo $product['id'] ?>">
                                <?php echo $product['name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td>
                    <input type="number" name="quantity">
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>