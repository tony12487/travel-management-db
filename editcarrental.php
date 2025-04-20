<?php
include "dbconn.php";
$sql = "SELECT * FROM CarRental WHERE CarID=?";
$CarID = $_REQUEST["CarID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $CarID);
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
    <title>Travel Management - Edit Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Edit Car Rental</h2>

    <div class="card">
        <div class="card-body">
            <form action="updatecarrental.php" method="GET">
                <input type="hidden" name="CarID" value="<?php echo $row['CarID']; ?>">
                
                <div class="mb-3">
                    <label for="RentalStart" class="form-label">Rental Start:</label>
                    <input type="date" id="RentalStart" name="RentalStart" class="form-control" value="<?php echo $row['RentalStart']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="RentalEnd" class="form-label">Rental End:</label>
                    <input type="date" id="RentalEnd" name="RentalEnd" class="form-control" value="<?php echo $row['RentalEnd']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Price" class="form-label">Price:</label>
                    <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" id="Price" name="Price" class="form-control" value="<?php echo $row['price']; ?>" required>
                </div>
                    <div class="mb-3">
                    <label for="Description" class="form-label">Description:</label>
                    <input type="text" id="Description" name="Description" class="form-control" 
                           value="<?php echo htmlspecialchars($row['Description']); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Car Rental</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
