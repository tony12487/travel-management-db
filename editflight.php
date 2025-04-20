<?php
include "dbconn.php";
$sql = "SELECT * FROM Flights WHERE FlightID=?";
$FlightID = $_REQUEST["FlightID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $FlightID);
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
    <title>Travel Management - Edit Flight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Edit Flight</h2>

    <div class="card">
        <div class="card-body">
            <form action="updateflight.php" method="GET">
                <input type="hidden" name="FlightID" value="<?php echo $row['FlightID']; ?>">
                
                <div class="mb-3">
                    <label for="FlightNumber" class="form-label">Flight Number:</label>
                    <input type="text" id="FlightNumber" name="FlightNumber" class="form-control" value="<?php echo $row['FlightNumber']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="FlightArrival" class="form-label">Flight Arrival:</label>
                    <input type="date" id="FlightArrival" name="FlightArrival" class="form-control" value="<?php echo $row['FlightArrival']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="FlightDeparture" class="form-label">Flight Departure:</label>
                    <input type="date" id="FlightDeparture" name="FlightDeparture" class="form-control" value="<?php echo $row['FlightDeparture']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Price" class="form-label">Price:</label>
                    <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" id="Price" name="Price" class="form-control" value="<?php echo $row['price']; ?>" required>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Flight</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
