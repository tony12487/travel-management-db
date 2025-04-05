<?php
include "dbconn.php";
$sql = "SELECT * FROM Users where UserID=?";
$UserID = $_REQUEST["UserID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row =  $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management - Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management - Edit User</h2>

    <div class="card">
        <div class="card-body">
            <form action="updateuser.php" method="GET">
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name:</label>
                    <input type="text" id="fname" name="fname" class="form-control" value="<?php echo htmlspecialchars($row["FirstName"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name:</label>
                    <input type="text" id="lname" name="lname" class="form-control" value="<?php echo htmlspecialchars($row["LastName"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row["Email"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($row["Phone"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($row["Address"]); ?>" required>
                </div>

                <input type="hidden" id="userid" name="userid" value="<?php echo $row["UserID"]; ?>">

                <button type="submit" class="btn btn-primary w-100">Update User</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>