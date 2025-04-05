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
<th>FirstName</th><th>LastName</th><th>Email</th><th>Address</th><th>Phone</th><th>Options</th></tr>
</thead>
<tbody>";

$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row["FirstName"]}</td>
                <td>{$row["LastName"]}</td>
                <td>{$row["Email"]}</td>
                <td>{$row["Address"]}</td>
                <td>{$row["Phone"]}</td>
                <td>
                    <a href='edituser.php?UserID={$row["UserID"]}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='deluser.php?UserID={$row["UserID"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    <a href='addbooking.php?UserID={$row["UserID"]}' class='btn btn-primary btn-sm'>Book a Trip</a>
                </td>
              </tr>";
    }
}
echo "</tbody></table>";
$conn->close();
?>
<div class="text-center mt-4">
            <a href="adduser.php" class="btn btn-book btn-lg">📅 Add New User</a>
            <a href="Bookings.php" class="btn btn-book btn-lg">📅 View Bookings</a>
            <a href="Payments.php" class="btn btn-book btn-lg">💰 View Payments</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


