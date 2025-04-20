<?php
include "dbconn.php";

$sql = "SELECT * FROM Destinations WHERE DestinationID=?";
$DestinationID = $_REQUEST["DestinationID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $DestinationID);
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
    <title>Travel Management - Edit Destination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Edit Destination</h2>

    <div class="card">
        <div class="card-body">
            <form action="updatedestination.php" method="GET">
                <input type="hidden" name="DestinationID" value="<?php echo $_GET['DestinationID']; ?>">

                <div class="mb-3">
                    <label for="DestinationName" class="form-label">Destination Name:</label>
                    <input type="text" id="DestinationName" name="DestinationName" class="form-control" 
                           value="<?php echo htmlspecialchars($row['DestinationName']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Country" class="form-label">Country:</label>
                    <input type="text" id="Country" name="Country" class="form-control" 
                           value="<?php echo htmlspecialchars($row['Country']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description:</label>
                    <input type="text" id="Description" name="Description" class="form-control" 
                           value="<?php echo htmlspecialchars($row['Description']); ?>">
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Destination</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
