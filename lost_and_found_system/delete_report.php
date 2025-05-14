<?php
session_start();
include 'includes/db.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
// Get the report ID to delete
$id = $_GET['id'];
// Prepare and execute the delete statement
$stmt = $conn->prepare("DELETE FROM reports WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']); // Ensure only the owner can delete
if ($stmt->execute()) {
    header("Location: view_reports.php"); // Redirect to view reports page
    exit();
} else {
    echo "Error: " . $stmt->error; // Display error if the delete fails
}
$stmt->close();
$conn->close(); // Close the database connection
?>