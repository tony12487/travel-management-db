<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Booking Summary</h2>
<?php

include "dbconn.php";
echo "<table class='table table-bordered table-striped'><thead class='table-dark'>
<tr>
<th>Booking ID</th><th>User Name</th><th>Email</th><th>Destination</th><th>Flight Number</th>
</tr>
</thead>
<tbody>";

$sql = "SELECT * FROM booking_summary";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row["BookingID"]}</td>
                <td>{$row['FirstName']} {$row['LastName']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['DestinationName']}</td>
                <td>{$row['FlightNumber']}</td>
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


