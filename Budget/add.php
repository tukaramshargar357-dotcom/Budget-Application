<?php  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "budget";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_sql = "SELECT id, transaction_type FROM transaction_type ORDER BY transaction_type ASC";
$user_result = $conn->query($user_sql);

$category_sql = "SELECT id, category FROM category ORDER BY category ASC";
$category_result = $conn->query($category_sql);

$payment_sql = "SELECT id, payment_type FROM payment_type ORDER BY payment_type ASC";
$payment_result = $conn->query($payment_sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Budget</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="bg-info">

    <div class="container py-5">
      <div class="row py-5">
        <div class="col-md-3"></div>

        <div class="col-6 bg-info-subtle py-5 px-5">
          <h1><u>Budget</u></h1>

          <a class="btn btn-success mb-3" href="table.php">See data</a>

          <form class="row g-3" action="create.php" method="post">

            <div class="col-12">
              <label class="form-label">Transaction Type</label>
              <select class="form-select" name="transaction_type_id" required>
                <option value="">--Select--</option>
                <?php
                if ($user_result && $user_result->num_rows > 0) {
                    while ($row = $user_result->fetch_assoc()) {
                ?>
                    <option value="<?= $row['id'] ?>">
                        <?= $row['transaction_type'] ?>
                    </option>
                <?php
                    }
                }
                ?>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Date</label>
              <input type="date" class="form-control" name="date" required>
            </div>

            <div class="col-12">
              <label class="form-label">Category</label>
              <select class="form-select" name="category_id" required>
                <option value="">--Select--</option>
                <?php
                if ($category_result && $category_result->num_rows > 0) {
                    while ($row = $category_result->fetch_assoc()) {
                ?>
                    <option value="<?= $row['id'] ?>">
                        <?= $row['category'] ?>
                    </option>
                <?php
                    }
                }
                ?>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label">Payment Type</label>
              <select class="form-select" name="payment_type_id" required>
                <option value="">--Select--</option>
                <?php
                if ($payment_result && $payment_result->num_rows > 0) {
                    while ($row = $payment_result->fetch_assoc()) {
                ?>
                    <option value="<?= $row['id'] ?>">
                        <?= $row['payment_type'] ?>
                    </option>
                <?php
                    }
                }
                ?>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label">Amount</label>
              <input type="number" class="form-control" name="amount" required>
            </div>

            <div class="col-12">
              <label class="form-label">Particulars</label>
              <input type="text" class="form-control" name="particulars" required>
            </div>

            <div class="col-12">
              <label class="form-label">Remark</label>
              <input type="text" class="form-control" name="remark" required>
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>

          </form>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>