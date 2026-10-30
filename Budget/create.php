<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "budget";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$transaction_type_id = !empty($_POST['transaction_type_id']) ? (int)$_POST['transaction_type_id'] : NULL;
$date = $_POST['date'] ?? '';
$category_id = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : NULL;
$payment_type_id = !empty($_POST['payment_type_id']) ? (int)$_POST['payment_type_id'] : NULL;
$amount = !empty($_POST['amount']) ? (float)$_POST['amount'] : 0;
$particulars = $_POST['particulars'] ?? '';
$remark = $_POST['remark'] ?? '';

if (
    empty($transaction_type_id) ||
    empty($date) ||
    empty($category_id) ||
    empty($payment_type_id) ||
    empty($amount)
) {
    die("Please fill all required fields");
}

$sql = "INSERT INTO budget
(transaction_type_id, date, category_id, payment_type_id, amount, particulars, remark)
VALUES
(
    $transaction_type_id,
    '$date',
    $category_id,
    $payment_type_id,
    $amount,
    '$particulars',
    '$remark'
)";

if ($conn->query($sql) === TRUE) {
    header("Location: table.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>