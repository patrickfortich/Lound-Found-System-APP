<?php
// Start the session
session_start();

// Include the database connection
include 'includes/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $contact_info = $_POST['contact_info'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, contact_info) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $contact_info);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
        // Optionally, redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <label for="contact_info">Contact Info:</label>
        <input type="text" name="contact_info" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
