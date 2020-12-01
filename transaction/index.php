<?php
// Create database connection using config file
include_once("./../config.php");

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT *
FROM order_items 
INNER JOIN product ON order_items.product_id = product.id
INNER JOIN orders ON order_items.order_id = orders.id
ORDER BY order_items.order_id");
?>

<html>

<head>
    <title>Transaction Table</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="./../products/">Products</a></li>
            <li><a href="./../">Apriori</a></li>
        </ul>
    </nav>

    <h1>Transaction Table</h1>
    <a href="add.php">Add New Transaction</a><br /><br />

    <table width='80%' border=1>

        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <!-- <th>Update</th> -->
        </tr>
        <?php
        while ($product = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $product['name'] . "</td>";
            echo "<td>" . $product['quantity'] . "</td>";
            // echo "<td><a href='edit.php?id=$product[id]'>Edit</a> | <a href='delete.php?id=$product[id]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>