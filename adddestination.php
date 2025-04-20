<?php
include "dbconn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_REQUEST["UserID"]) || empty($_REQUEST["UserID"])) {
    die("Error: UserID is missing.");
}
if (!isset($_REQUEST["BookingID"]) || empty($_REQUEST["BookingID"])) {
    die("Error: BookingID is missing.");
}

$sql = "INSERT INTO Destinations (DestinationName, Country, Description, Bookings_BookingID) VALUES (?, ?, ?, ?)";

$UserID = $_REQUEST["UserID"];
$BookingID = $_REQUEST["BookingID"];
$DestinationName = $_REQUEST["DestinationName"];
$Country = $_REQUEST["Country"];
$Description = $_REQUEST["Description"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $DestinationName, $Country, $Description, $BookingID);

if ($stmt->execute() === TRUE) {
    $DestinationID = $stmt->insert_id;
    echo "<script>window.location.href = 'Destinations.php'</script>";
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
    <title>Travel Management - Add Destination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Add Destination</h2>
    <div class="card">
        <div class="card-body">
            <form action="adddestination.php" method="POST">
                <input type="hidden" name="BookingID" value="<?php echo $_GET['BookingID']; ?>">
                <input type="hidden" name="UserID" value="<?php echo $_GET['UserID']; ?>">

                <div class="mb-3">
                    <label for="DestinationName" class="form-label">Destination Name:</label>
                    <input type="text" id="DestinationName" name="DestinationName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Country" class="form-label">Country:</label>
                    <input type="text" id="Country" name="Country" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description:</label>
                    <input type="text" id="Description" name="Description" class="form-control">
                </div>
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

