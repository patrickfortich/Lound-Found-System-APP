<?php
session_start();
include 'includes/db.php';

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    die("Access denied. You must be an admin to perform this action.");
}

// Function to export the reports table as CSV
function exportToCSV($conn) {
    $filename = "reports_backup_" . date("Y-m-d_H-i-s") . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Item Name', 'Description', 'Date Found', 'Image']); // Column headers

    $stmt = $conn->prepare("SELECT * FROM reports");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row); // Write each row to the CSV
    }

    fclose($output);
    exit();
}

// Function to export the reports table as SQL
function exportToSQL($conn) {
    $filename = "reports_backup_" . date("Y-m-d_H-i-s") . ".sql";
    header('Content-Type: application/sql');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');
    $stmt = $conn->prepare("SELECT * FROM reports");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $sql = "INSERT INTO reports (item_name, description, date_found, image) VALUES ('" . 
            $conn->real_escape_string($row['item_name']) . "', '" . 
            $conn->real_escape_string($row['description']) . "', '" . 
            $conn->real_escape_string($row['date_found']) . "', '" . 
            $conn->real_escape_string($row['image']) . "');";
        fwrite($output, $sql . "\n"); // Write each insert statement to the SQL file
    }

    fclose($output);
    exit();
}

// Check the requested format
if (isset($_GET['format']) && $_GET['format'] === 'csv') {
    exportToCSV($conn);
} elseif (isset($_GET['format']) && $_GET['format'] === 'sql') {
    exportToSQL($conn);
} else {
    die("Invalid format specified. Use 'format=csv' or 'format=sql'.");
}
?>
