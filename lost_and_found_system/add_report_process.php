<?php
session_start();
include 'includes/db.php';

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $date_found = $_POST['date_found'];
    $contact_number = $_POST['contact_number']; // Get contact number
    $user_id = $_SESSION['user_id']; // Get the user ID from the session

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/"; // Directory to save uploaded images
        $target_file = $target_dir . basename($image);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO reports (item_name, description, date_found, contact_number, user_id, image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $item_name, $description, $date_found, $contact_number, $user_id, $target_file);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: view_reports.php"); // Redirect to view reports page
                exit();
            } else {
                echo "Error: " . $stmt->error; // Display error if the insert fails
            }

            $stmt->close();
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "No image uploaded or there was an upload error.";
    }
}
?>
