<?php
session_start();
include 'includes/db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // Redirect to home if not an admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Admin Dashboard</h1>
        <nav class="mt-4">
            <ul class="list-unstyled">
                <li><a href="view_reports.php" class="btn btn-info">View Reports</a></li>
                <li><a href="add_report.php" class="btn btn-success">Add Report</a></li>
                <li><a href="backup_reports.php?format=csv" class="btn btn-warning">Download Reports as CSV</a></li>
                <li><a href="backup_reports.php?format=sql" class="btn btn-warning">Download Reports as SQL</a></li>
                <li><a href="logout.php" class="btn btn-danger">Logout</a></li>
            </ul>
        </nav>
        <h2>Manage Reports</h2>
        <p>Use the links above to manage reports and download backups.</p>
    </div>
</body>
</html>
