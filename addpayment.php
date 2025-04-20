<?php
include "dbconn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_REQUEST["UserID"]) || empty($_REQUEST["UserID"])) {
    die("Error: UserID is missing.");
}
if (!isset($_REQUEST["BookingID"]) || empty($_REQUEST["BookingID"])) {
    die("Error: BookingID is missing.");
}

$sql = "INSERT INTO Payments (PaymentDate, Amount, Bookings_BookingID, Bookings_Users_UserID) VALUES (?, ?, ?, ?)";

$UserID = $_REQUEST["UserID"];
$BookingID = $_REQUEST["BookingID"];
$PaymentDate = date("Y-m-d");
$Amount = $_REQUEST["Amount"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("sdii", $PaymentDate, $Amount, $BookingID, $UserID);

if ($stmt->execute() === TRUE) {
    $BookingID = $stmt->insert_id;
    echo "<script>window.location.href = 'Users.php'</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management - Add Payment Amount</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Add Payment Amount</h2>
    <div class="card">
        <div class="card-body">
            <form action="addpayment.php" method="POST">
                <input type="hidden" name="BookingID" value="<?php echo $_GET['BookingID']; ?>">
                <input type="hidden" name="UserID" value="<?php echo $_GET['UserID']; ?>">

                <div class="mb-3">
                    <label for="PaymentDate" class="form-label">Payment Date:</label>
                    <input type="text" id="PaymentDate" name="PaymentDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="Amount" class="form-label">Amount:</label>
                    <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" id="Amount" name="Amount" class="form-control" required>
                </div>
            </div> 
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

