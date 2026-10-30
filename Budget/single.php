<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "budget";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$budget_id = (int)($_GET['id'] ?? 0);

$sql = "SELECT b.*, tt.transaction_type
        FROM budget b
        LEFT JOIN transaction_type tt
        ON b.transaction_type_id = tt.id
        WHERE b.id = $budget_id";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $id = $row['id'];
    $transaction_type = $row['transaction_type'];
    $date = $row['date'];
    $category_id = $row['category_id'];
    $payment_type_id = $row['payment_type_id'];
    $amount = $row['amount'];
    $particulars = $row['particulars'];
    $remark = $row['remark'];

} else {
    die("Record not found.");
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Budget</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet">
</head>

<body class="bg-info">

<div class="container py-5">
    <div class="row py-5">
        <div class="col-md-3"></div>

        <div class="col-md-6 bg-light p-5 rounded">

            <h2 class="mb-4">
                <u>VIEW BUDGET</u>
            </h2>

            <div class="mb-3">
                <strong>ID :</strong>
                <?php echo $id; ?>
            </div>

            <div class="mb-3">
                <strong>Transaction Type :</strong>
                <?php echo $transaction_type; ?>
            </div>

            <div class="mb-3">
                <strong>Date :</strong>
                <?php echo $date; ?>
            </div>

            <div class="mb-3">
                <strong>Category ID :</strong>
                <?php echo $category_id; ?>
            </div>

            <div class="mb-3">
                <strong>Payment Type ID :</strong>
                <?php echo $payment_type_id; ?>
            </div>

            <div class="mb-3">
                <strong>Amount :</strong>
                <?php echo $amount; ?>
            </div>

            <div class="mb-3">
                <strong>Particulars :</strong>
                <?php echo $particulars; ?>
            </div>

            <div class="mb-3">
                <strong>Remark :</strong>
                <?php echo $remark; ?>
            </div>

            <a href="table.php" class="btn btn-success">
                Go Back
            </a>

        </div>
    </div>
</div>

</body>
</html>