<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management</h2>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconn.php";
echo "<table class='table table-bordered table-striped'><thead class='table-dark'>
<tr>
<th>Payment ID</th><th>User</th><th>Booking ID</th><th>Payment Date</th><th>Amount Paid</th><th>Total Payment</th><th>Amount Left</th><th>
</tr>
</thead>
<tbody>";

$sql = "SELECT Payments.PaymentID, Payments.PaymentDate, Payments.Amount, 
               Users.FirstName, Users.LastName, 
               Payments.Bookings_BookingID, Users.UserID
        FROM Payments
        JOIN Bookings ON Payments.Bookings_BookingID = Bookings.BookingID
        JOIN Users ON Payments.Bookings_Users_UserID = Users.UserID";
$result = $conn->query($sql);

// This part calls the 3 functions that gets the total cost and displays it under "Total Payment"
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $userID = $row["UserID"];       

// car rental prices        
$totalCarRentalSql = "SELECT GetTotalCarPrice($userID) AS totalCarRental";
$totalCarRentalResult = $conn->query($totalCarRentalSql);
$totalCarRental = 0.00;
if ($totalCarRentalResult && $totalCarRentalResult->num_rows > 0) {
    $rowCarRental = $totalCarRentalResult->fetch_assoc();
    $totalCarRental = $rowCarRental["totalCarRental"];
}

// hotel prices
$totalHotelsSql = "SELECT GetTotalHotelPrice($userID) AS totalHotels";
$totalHotelsResult = $conn->query($totalHotelsSql);
$totalHotels = 0.00;
if ($totalHotelsResult && $totalHotelsResult->num_rows > 0) {
    $rowHotel = $totalHotelsResult->fetch_assoc();
    $totalHotels = $rowHotel["totalHotels"];
} 

// flight prices
$totalFlightsSql = "SELECT GetTotalFlightPrice($userID) AS totalFlights";
$totalFlightsResult = $conn->query($totalFlightsSql);
$totalFlights = 0.00;
if ($totalFlightsResult && $totalFlightsResult->num_rows > 0) {
    $rowFlight = $totalFlightsResult->fetch_assoc();
    $totalFlights = $rowFlight["totalFlights"];
}

// This part calls the stored procedure that returned the updated total price
$totalPaymentSql = "CALL GetUpdatedTotalPayment(?)";
        $totalPaymentResult = $conn->prepare($totalPaymentSql);
if ($totalPaymentResult) {
    $totalPaymentResult->bind_param("i", $userID);
    $totalPaymentResult->execute();
    $resultPayment = $totalPaymentResult->get_result();
$totalPayment = 0.00;
if ($resultPayment && $resultPayment->num_rows > 0) {
    $rowPayment = $resultPayment->fetch_assoc();
    $totalPayment = $rowPayment["TotalPayment"];
}
$totalPaymentResult->close();
}

// Returns the total cost with the hotel, flight, and car rental
$totalCombined = $totalCarRental + $totalFlights + $totalHotels;

        echo "<tr>
        <td>{$row["PaymentID"]}</td>
        <td>{$row["FirstName"]} {$row["LastName"]}</td>
        <td>{$row["Bookings_BookingID"]}</td>
        <td>{$row["PaymentDate"]}</td>
        <td>\${$row["Amount"]}</td>
        <td>\${$totalCombined}</td>
        <td>\${$totalPayment}</td>
        <td>
        <a href='editpayment.php?PaymentID={$row["PaymentID"]}' class='btn btn-warning btn-sm'>Edit</a>
        <a href='delpayment.php?PaymentID={$row["PaymentID"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        <a href='addpayment.php?BookingID={$row["Bookings_BookingID"]}&UserID={$row["UserID"]}' class='btn btn-primary btn-sm'>Add Payment</a>
        </td>
      </tr>";
    }
}
echo "</tbody></table>";
$conn->close();
?>
<div class="text-center mt-4">
            <!-- <a href="adduser.htm" class="btn btn-book btn-lg">🏝️ Select a Destination</a> -->
            <a href="Users.php" class="btn btn-book btn-lg">✈️ Main Menu</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
