<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include "dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_REQUEST["BookingID"]) || empty($_REQUEST["BookingID"])) {
        die("Error: BookingID is missing.");
    }
    if (!isset($_REQUEST["UserID"]) || empty($_REQUEST["UserID"])) {
        die("Error: UserID is missing.");
    }

    $sql = "INSERT INTO TravelDocuments (DocumentType, DocumentNumber, CountryIssued, IssuedDate, ExpirationDate, Users_UserID, Bookings_BookingID) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $BookingID = $_REQUEST["BookingID"];
    $UserID = $_REQUEST["UserID"];
    $DocumentType = $_REQUEST["DocumentType"];
    $DocumentNumber = $_REQUEST["DocumentNumber"];
    $CountryIssued = $_REQUEST["CountryIssued"];
    $IssuedDate = $_REQUEST["IssuedDate"];
    $ExpirationDate = $_REQUEST["ExpirationDate"];

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $DocumentType, $DocumentNumber, $CountryIssued, $IssuedDate, $ExpirationDate, $UserID, $BookingID);

    if ($stmt->execute()) {
        echo "<script>
        if (confirm('Travel document added successfully! Do you want to add a destination?')) {
            window.location.href = 'adddestination.php?BookingID={$BookingID}&UserID={$UserID}';
        } else {
            window.location.href = 'Users.php'; // Redirect to main page or another relevant page
        }
    </script>";
    } else {
        die("Error: " . $stmt->error);
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
    <title>Travel Management - Add Travel Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Add Travel Document</h2>
    <div class="card">
        <div class="card-body">
            <form action="addtraveldocument.php" method="POST">
                <input type="hidden" name="BookingID" value="<?php echo $_GET['BookingID']; ?>">
                <input type="hidden" name="UserID" value="<?php echo $_GET['UserID']; ?>">

                <div class="mb-3">
                    <label for="DocumentType" class="form-label">Document Type:</label>
                    <select id="DocumentType" name="DocumentType" class="form-control" required>
                        <option value="">Select Document Type</option>
                        <option value="Passport">Passport</option>
                        <option value="Visa">Visa</option>
                        <option value="ID Card">ID Card</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="DocumentNumber" class="form-label">Document Number:</label>
                    <input type="text" id="DocumentNumber" name="DocumentNumber" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="CountryIssued" class="form-label">Country Issued:</label>
                    <input type="text" id="CountryIssued" name="CountryIssued" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="IssuedDate" class="form-label">Issued Date:</label>
                    <input type="date" id="IssuedDate" name="IssuedDate" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="ExpirationDate" class="form-label">Expiration Date:</label>
                    <input type="date" id="ExpirationDate" name="ExpirationDate" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>