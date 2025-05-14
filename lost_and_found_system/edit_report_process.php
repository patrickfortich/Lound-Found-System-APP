<?php
session_start();
include 'includes/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $date_found = $_POST['date_found'];

    // Handle file upload if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $stmt = $conn->prepare("UPDATE reports SET item_name = ?, description = ?, date_found = ?, image = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $item_name, $description, $date_found, $target_file, $id);
    } else {
        $stmt = $conn->prepare("UPDATE reports SET item_name = ?, description = ?, date_found = ? WHERE id = ?");
        $stmt->bind_param("sssi", $item_name, $description, $date_found, $id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: view_reports.php"); // Redirect to view reports page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
