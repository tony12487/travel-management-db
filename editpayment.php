<?php
include "dbconn.php";
$sql = "SELECT * FROM Payments WHERE PaymentID=?";
$PaymentID = $_REQUEST["PaymentID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PaymentID);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management - Edit Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Edit Payment</h2>

    <div class="card">
        <div class="card-body">
            <form action="updatepayment.php" method="GET">
                <input type="hidden" name="PaymentID" value="<?php echo $row['PaymentID']; ?>">

                <div class="mb-3">
                    <label for="PaymentDate" class="form-label">Payment Date:</label>
                    <input type="text" id="PaymentDate" name="PaymentDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>

                </div>
                <div class="mb-3">
                    <label for="Amount" class="form-label">Amount:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" id="Amount" name="Amount" class="form-control" value="<?php echo $row['Amount']; ?>" required>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Payment</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
