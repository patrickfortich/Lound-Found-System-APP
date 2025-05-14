<?php
session_start();
include 'includes/db.php';

// Fetch reports from the database
$stmt = $conn->prepare("SELECT * FROM reports");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom CSS -->
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Lost and Found</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="view_reports.php">View Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="add_report.php">Add Report</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center">Reports</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Date Found</th>
                    <th>Contact Number</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($report = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($report['id']); ?></td>
                        <td><?php echo htmlspecialchars($report['item_name']); ?></td>
                        <td><?php echo htmlspecialchars($report['description']); ?></td>
                        <td><?php echo htmlspecialchars($report['date_found']); ?></td>
                        <td><?php echo htmlspecialchars($report['contact_number']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($report['image']); ?>" alt="Image" style="width: 50px;"></td>
                        <td>
                            <?php if ($_SESSION['user_id'] == $report['user_id']): ?>
                                <a href="delete_report.php?id=<?php echo $report['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

