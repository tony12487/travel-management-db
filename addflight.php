<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_REQUEST["BookingID"]) || empty($_REQUEST["BookingID"])) {
    die("Error: BookingID is missing.");
}

$sql = "INSERT INTO Flights (FlightNumber, FlightArrival, FlightDeparture, Price, Bookings_BookingID, Destinations_DestinationID) VALUES (?, ?, ?, ?, ?, ?)";

$DestinationID = $_REQUEST["DestinationID"];
$BookingID = $_REQUEST["BookingID"];
$FlightNumber = $_REQUEST["FlightNumber"];
$FlightDeparture = $_REQUEST["FlightDeparture"];
$FlightArrival = $_REQUEST["FlightArrival"];
$Price = $_REQUEST["Price"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdii", $FlightNumber, $FlightArrival, $FlightDeparture, $Price, $BookingID, $DestinationID);

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
    <title>Travel Management - Add Flight Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Add Flight Information</h2>
    <div class="card">
        <div class="card-body">
            <form action="addflight.php" method="POST">
                <input type="hidden" name="BookingID" value="<?php echo $_GET['BookingID']; ?>">
                <input type="hidden" name="DestinationID" value="<?php echo $_GET['DestinationID']; ?>">
                
                <div class="mb-3">
                    <label for="FlightNumber" class="form-label">Flight Number:</label>
                    <input type="text" id="FlightNumber" name="FlightNumber" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="FlightArrival" class="form-label">Flight Arrival:</label>
                    <input type="date" id="FlightArrival" name="FlightArrival" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="FlightDeparture" class="form-label">Flight Departure:</label>
                    <input type="date" id="FlightDeparture" name="FlightDeparture" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Price" class="form-label">Price:</label>
                    <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" id="Price" name="Price" class="form-control" required>
                </div>
            </div> 
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

