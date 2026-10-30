<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "budget";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="bg-primary bg-gradient">

    <div class="container py-5">
        <div class="row">

            <div class="col-12 bg-primary-subtle p-4 rounded">

                <h3 class="text-secondary text-center">Payment Status Data</h3>

                <a class="btn btn-success mb-3" href="add.php">Add data</a>

                <table class="table table-striped-columns">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Transaction Type</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Particulars</th>
                            <th>Remark</th>
                            <th>View</th>
                        </tr>
                    </thead>

                    <tbody>

<?php

$sql = "SELECT
            b.id,
            tt.transaction_type,
            b.date,
            c.category,
            pt.payment_type,
            b.amount,
            b.particulars,
            b.remark
        FROM budget b
        JOIN transaction_type tt ON b.transaction_type_id = tt.id
        JOIN category c ON b.category_id = c.id
        JOIN payment_type pt ON b.payment_type_id = pt.id
        ORDER BY b.id ASC";

$dbresult = $conn->query($sql);

if ($dbresult && $dbresult->num_rows > 0) {

    while ($row = $dbresult->fetch_assoc()) {

        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['transaction_type']}</td>";
        echo "<td>{$row['date']}</td>";
        echo "<td>{$row['category']}</td>";
        echo "<td>{$row['payment_type']}</td>";
        echo "<td>{$row['amount']}</td>";
        echo "<td>{$row['particulars']}</td>";
        echo "<td>{$row['remark']}</td>";

        echo "<td>
                <a class='btn btn-primary btn-sm' href='single.php?id={$row['id']}'>View</a>
              </td>";

        echo "</tr>";
    }

} else {
    echo "<tr><td colspan='9' class='text-center'>No records found</td></tr>";
}

?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>