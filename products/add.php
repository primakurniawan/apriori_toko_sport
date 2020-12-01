<html>
<head>
    <title>Add Products</title>
</head>

<body>
    <a href="index.php">Go to Home</a>
    <br/><br/>

    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr> 
                <td>price</td>
                <td><input type="number" name="price"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $name = $_POST['name'];
        $price = (int)$_POST['price'];

        // include database connection file
        include_once("./../config.php");

        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO users(name,price) VALUES('$name','$price')");

        // Show message when user added
        echo "User added successfully. <a href='index.php'>View Product</a>";
    }
    ?>
</body>
</html>