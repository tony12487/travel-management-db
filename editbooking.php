<?php
include "dbconn.php";
$sql = "SELECT * from Bookings where BookingID=?";
$BookingID = $_REQUEST["BookingID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row =  $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management - Edit Booking Date</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Edit Booking Date</h2>

    <div class="card">
        <div class="card-body">
            <form action="updatebooking.php" method="GET">
            <input type="hidden" name="BookingID" value="<?php echo $_GET['BookingID']; ?>">

<div class="mb-3">
    <label for="BookingDate" class="form-label">Booking Date:</label>
    <input type="text" id="BookingDate" name="BookingDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
</div>
<div class="mb-3">
                <label for="TravelDate" class="form-label">Travel Date:</label>
                <input type="date" id="TravelDate" name="TravelDate" class="form-control" required>
                <button type="submit" class="btn btn-primary w-100">Update Booking</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>