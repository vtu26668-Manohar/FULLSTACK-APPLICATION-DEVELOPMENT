<?php
$conn = new mysqli("localhost", "root", "", "banking_system");

$user_id = 1;       // Manu
$merchant_id = 2;   // Amazon
$amount = 2000;

// Start transaction
$conn->begin_transaction();

try {

    // Check user balance
    $result = $conn->query("SELECT balance FROM accounts WHERE id = $user_id");
    $row = $result->fetch_assoc();
    $user_balance = $row['balance'];

    if ($user_balance < $amount) {
        throw new Exception("Insufficient Balance!");
    }

    // Deduct from user
    $conn->query("UPDATE accounts SET balance = balance - $amount WHERE id = $user_id");

    // Add to merchant
    $conn->query("UPDATE accounts SET balance = balance + $amount WHERE id = $merchant_id");

    // Commit if everything works
    $conn->commit();
    echo "Payment Successful! Transaction Committed.";

} catch (Exception $e) {

    // Rollback on failure
    $conn->rollback();
    echo "Transaction Failed! Rolled Back.";
}
?>