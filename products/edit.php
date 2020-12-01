<?php
// include database connection file
include_once("./../config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
    $id = $_POST['id'];

    $name=$_POST['name'];
    $price=$_POST['price'];

    // update user data
    $result = mysqli_query($mysqli, "UPDATE product SET name='$name',price='$price' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM product WHERE id=$id");

while($product = mysqli_fetch_array($result))
{
    $name = $product['name'];
    $price = $product['price'];
}
?>
<html>
<head>  
    <title>Edit product Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br/><br/>

    <form name="update_product" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" value=<?php echo $name;?>></td>
            </tr>
            <tr> 
                <td>Price</td>
                <td><input type="text" name="price" value=<?php echo $price;?>></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>