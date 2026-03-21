<?php
$conn = new mysqli("localhost", "root", "", "audit_system");

$result = $conn->query("SELECT * FROM daily_activity_report");
?>

<table border="1">
<tr>
    <th>Date</th>
    <th>Action</th>
    <th>Total</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['activity_date']; ?></td>
    <td><?php echo $row['action_type']; ?></td>
    <td><?php echo $row['total_actions']; ?></td>
</tr>
<?php } ?>

</table>