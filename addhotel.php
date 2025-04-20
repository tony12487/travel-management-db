<?php
include "dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_REQUEST["BookingID"]) || empty($_REQUEST["BookingID"])) {
    die("Error: BookingID is missing.");
}

$sql = "INSERT INTO Hotels (HotelName, HotelAddress, Price, Description, Bookings_BookingID, Destinations_DestinationID) VALUES (?, ?, ?, ?, ?, ?)";

$DestinationID = $_REQUEST["DestinationID"];
$BookingID = $_REQUEST["BookingID"];
$HotelName = $_REQUEST["HotelName"];
$HotelAddress = $_REQUEST["HotelAddress"];
$Price = $_REQUEST["Price"];
$Description = $_REQUEST["Description"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsii", $HotelName, $HotelAddress, $Price, $Description, $BookingID, $DestinationID);

if ($stmt->execute() === TRUE) {
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
    <title>Travel Management - Add Hotel Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Add Hotel Information</h2>
    <div class="card">
        <div class="card-body">
            <form action="addhotel.php" method="POST">
                <input type="hidden" name="BookingID" value="<?php echo $_GET['BookingID']; ?>">
                <input type="hidden" name="DestinationID" value="<?php echo $_GET['DestinationID']; ?>">
                
                <div class="mb-3">
                    <label for="HotelName" class="form-label">Hotel Name:</label>
                    <input type="text" id="HotelName" name="HotelName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="HotelAddress" class="form-label">Hotel Address:</label>
                    <input type="text" id="HotelAddress" name="HotelAddress" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Price" class="form-label">Price:</label>
                    <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" id="Price" name="Price" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description:</label>
                    <input type="text" id="Description" name="Description" class="form-control">
                </div>
            </div> 
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

