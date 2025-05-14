   <?php
   session_start(); // Start the session
   include 'includes/db.php'; // Include the database connection

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $email = $_POST['email'];
       $password = $_POST['password'];

       // Prepare and execute the query
       $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $stmt->store_result();

       if ($stmt->num_rows > 0) {
           $stmt->bind_result($id, $hashed_password);
           $stmt->fetch();

           // Verify the password
           if (password_verify($password, $hashed_password)) {
               // Password is correct, set session variables
               $_SESSION['user_id'] = $id;
               header("Location: view_reports.php"); // Redirect to reports page
               exit();
           } else {
               echo "Invalid password.";
           }
       } else {
           echo "No user found with that email.";
       }

       $stmt->close();
   }
   $conn->close();
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom CSS -->
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        <form action="login_process.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
