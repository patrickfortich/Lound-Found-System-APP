<?php
session_start();
include 'includes/db.php';
include 'encryption.php'; // Include the encryption functions

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $contact_info = encrypt($_POST['contact_info']); // Encrypt contact info

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, contact_info) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $contact_info);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
