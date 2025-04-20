<?php
include "dbconn.php";
$sql = "SELECT * FROM Hotels WHERE HotelID=?";
$HotelID = $_REQUEST["HotelID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $HotelID);
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
    <title>Travel Management - Edit Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Edit Hotel</h2>

    <div class="card">
        <div class="card-body">
            <form action="updatehotel.php" method="GET">
                <input type="hidden" name="HotelID" value="<?php echo $row['HotelID']; ?>">
                
                <div class="mb-3">
                    <label for="HotelName" class="form-label">Hotel Name:</label>
                    <input type="text" id="HotelName" name="HotelName" class="form-control" value="<?php echo $row['HotelName']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="HotelAddress" class="form-label">Hotel Address:</label>
                    <input type="text" id="HotelAddress" name="HotelAddress" class="form-control" value="<?php echo $row['HotelAddress']; ?>" required>
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
                <button type="submit" class="btn btn-primary w-100">Update Hotel</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
