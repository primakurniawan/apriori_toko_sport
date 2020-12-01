<?php
// Create database connection using config file
include_once("./../config.php");

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM product");
?>

<html>

<head>
    <title>Product Table</title>
</head>

<body>

    <nav>
        <ul>
            <li><a href="./../transaction/">Transaction</a></li>
            <li><a href="./../">Apriori</a></li>
        </ul>
    </nav>

    <h1>Product Table</h1>

    <a href="add.php">Add New Product</a><br /><br />

    <table width='80%' border=1>

        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Update</th>
        </tr>
        <?php
        while ($product = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $product['name'] . "</td>";
            echo "<td>" . $product['price'] . "</td>";
            echo "<td><a href='edit.php?id=$product[id]'>Edit</a> | <a href='delete.php?id=$product[id]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>