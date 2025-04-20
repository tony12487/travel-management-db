<?php
include "dbconn.php";

if (!isset($_GET['BookingID']) && !isset($_GET['DocumentID'])) {
    die("Error: BookingID or DocumentID is missing.");
}

if (isset($_GET['BookingID'])) {
$BookingID = $_REQUEST['BookingID'];

$sql = "SELECT * FROM TravelDocuments WHERE Bookings_BookingID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Error: Travel Document not found.");
}
}
elseif (isset($_GET['DocumentID'])) {
$DocumentID = $_REQUEST['DocumentID'];
$sql = "SELECT * FROM TravelDocuments WHERE DocumentID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $DocumentID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $BookingID = $row['Bookings_BookingID'];
} else {
    die("Error: Travel Document not found.");
}
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
            <form action="updatetraveldocument.php" method="GET">
            <input type="hidden" name="TravelDocumentID" value="<?php echo $row['TravelDocumentID']; ?>">
            <input type="hidden" name="BookingID" value="<?php echo $BookingID; ?>">

                <div class="mb-3">
                    <label for="DocumentType" class="form-label">Document Type:</label>
                    <select id="DocumentType" name="DocumentType" class="form-control" required>
                        <option value="">Select Document Type</option>
                        <option value="Passport" <?php if ($row['DocumentType'] == 'Passport') echo 'selected'; ?>>Passport</option>
                        <option value="Visa" <?php if ($row['DocumentType'] == 'Visa') echo 'selected'; ?>>Visa</option>
                        <option value="ID Card" <?php if ($row['DocumentType'] == 'ID Card') echo 'selected'; ?>>ID Card</option>
                        <option value="Other" <?php if ($row['DocumentType'] == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="DocumentNumber" class="form-label">Document Number:</label>
                    <input type="text" id="DocumentNumber" name="DocumentNumber" class="form-control" value="<?php echo $row['DocumentNumber']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="CountryIssued" class="form-label">Country Issued:</label>
                    <input type="text" id="CountryIssued" name="CountryIssued" class="form-control" value="<?php echo $row['CountryIssued']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="IssuedDate" class="form-label">Issued Date:</label>
                    <input type="date" id="IssuedDate" name="IssuedDate" class="form-control" value="<?php echo $row['IssuedDate']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="ExpirationDate" class="form-label">Expiration Date:</label>
                    <input type="date" id="ExpirationDate" name="ExpirationDate" class="form-control" value="<?php echo $row['ExpirationDate']; ?>" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Update Document</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="TravelDocuments.php?BookingID=<?php echo $BookingID; ?>" class="btn btn-primary btn-lg">Back to Travel Documents</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>