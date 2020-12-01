<?php
include_once("./config.php");

$result = mysqli_query($mysqli, "SELECT * FROM order_items INNER JOIN product ON order_items.product_id = product.id INNER JOIN orders ON order_items.order_id = orders.id ORDER BY order_items.order_id");

$new_array = array();
while ($transaction = mysqli_fetch_assoc($result)) {
    $new_array[$transaction['order_id']][] = $transaction['name'];
}


require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Association\Apriori;

$associator = new Apriori();
$associator->train($new_array, []);

$aprioriTable = $associator->getRules();
?>

<html>

<head>
    <title>Apriori</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="./transaction/">Transaction</a></li>
            <li><a href="./products/">Products</a></li>
        </ul>
    </nav>
    <h1>Apriori Table</h1>
    <table width='80%' border=1>
        <tr>
            <th>Antecedent</th>
            <th>Consequent</th>
            <th>Support</th>
            <th>Confidence</th>
        </tr>
        <?php foreach ($aprioriTable as $aprioriRow) : ?>
            <tr>
                <td>
                    <?php foreach ($aprioriRow['antecedent'] as $antecedent) : ?>
                        <?php echo $antecedent . " | "; ?>
                    <?php endforeach ?>
                </td>
                <td>
                    <?php foreach ($aprioriRow['consequent'] as $consequent) : ?>
                        <?php echo $consequent . " | "; ?>
                    <?php endforeach ?>
                </td>
                <td><?php echo round($aprioriRow['support'] * 100) . "%"; ?></td>
                <td><?php echo round($aprioriRow['confidence'] * 100) . "%"; ?></td>
            </tr>;
        <?php endforeach ?>

        <table />
</body>

</html>