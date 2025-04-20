<?php
include "dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_REQUEST["TravelDate"]) || empty($_REQUEST["TravelDate"])) {
        die("Error: TravelDate is missing.");
    }
if (!isset($_REQUEST["UserID"]) || empty($_REQUEST["UserID"])) {
    die("Error: UserID is missing.");
}

$sql = "INSERT INTO Bookings (BookingDate, TravelDate, Users_UserID) VALUES (?, ?, ?)";

$UserID = $_REQUEST["UserID"];
$BookingDate = date("Y-m-d");
$TravelDate = $_REQUEST["TravelDate"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $BookingDate, $TravelDate, $UserID);

if ($stmt->execute() === TRUE) {
    $BookingID = $stmt->insert_id;
    echo "<script>window.location.href = 'addtraveldocument.php?BookingID={$BookingID}&UserID={$UserID}'</script>";
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
    <title>Travel Management - Add Booking Date</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Add Booking Date</h2>
    <div class="card">
        <div class="card-body">
            <form action="addbooking.php" method="POST">
                <input type="hidden" name="UserID" value="<?php echo $_GET['UserID']; ?>">

                <div class="mb-3">
                    <label for="BookingDate" class="form-label">Booking Date:</label>
                    <input type="text" id="BookingDate" name="BookingDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="TravelDate" class="form-label">Travel Date:</label>
                    <input type="date" id="TravelDate" name="TravelDate" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

