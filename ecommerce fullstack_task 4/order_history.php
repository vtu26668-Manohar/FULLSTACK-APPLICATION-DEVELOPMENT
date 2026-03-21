<?php
$conn = new mysqli("localhost", "root", "", "ecommerce");

$sql = "SELECT customers.name, products.product_name, products.price,
orders.quantity, (products.price * orders.quantity) AS total_price,
orders.order_date
FROM orders
JOIN customers ON orders.customer_id = customers.id
JOIN products ON orders.product_id = products.id
ORDER BY orders.order_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Order History</title>
<style>
body {
    font-family: Arial;
    background: #f4f4f4;
}
table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    background: white;
}
th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}
th {
    background: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<h2 style="text-align:center;">Customer Order History</h2>

<table>
<tr>
    <th>Name</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Date</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['total_price']; ?></td>
    <td><?php echo $row['order_date']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>