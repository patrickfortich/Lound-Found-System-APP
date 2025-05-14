   <?php
   session_start(); // Start the session
   include 'includes/db.php'; // Include the database connection

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $email = $_POST['email'];
       $password = $_POST['password'];

       // Prepare and execute the query
       $stmt = $conn->prepare("SELECT id, password, user_role FROM users WHERE email = ?");
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $stmt->store_result();

       if ($stmt->num_rows > 0) {
           $stmt->bind_result($id, $hashed_password, $user_role); // Ensure user_role is fetched
           $stmt->fetch();

           // Verify the password
           if (password_verify($password, $hashed_password)) {
               // Password is correct, set session variables
               $_SESSION['user_id'] = $id;
               $_SESSION['user_role'] = $user_role; // Set user role in session
               header("Location: admin_dashboard.php"); // Redirect to admin dashboard
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
   
   