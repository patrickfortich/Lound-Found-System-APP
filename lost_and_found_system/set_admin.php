<?php
session_start();
include 'includes/db.php'; // Include your database connection
// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // Redirect to home if not an admin
    exit();
}
// Get the user ID from the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE users SET user_role = 'admin' WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        header("Location: admin_manage_users.php"); // Redirect back to user management page
        exit();
    } else {
        echo "Error: " . $stmt->error; // Display error if the update fails
    }
    $stmt->close();
} else {
    echo "No user ID specified.";
}
$conn->close();
?>