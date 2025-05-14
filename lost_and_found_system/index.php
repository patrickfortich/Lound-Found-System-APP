<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Lost and Found System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom CSS -->
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron text-center">
            <h1 class="display-4">Welcome to the Lost and Found System</h1>
            <p class="lead">Easily report and find lost items in your community.</p>
            <hr class="my-4">
            <p>Get started by logging in or registering below.</p>
        </div>
        
        <div class="row text-center">
            <div class="col-md-3">
                <a href="login.php" class="btn btn-primary btn-lg btn-block">Login</a>
            </div>
            <div class="col-md-3">
                <a href="register.php" class="btn btn-secondary btn-lg btn-block">Register</a>
            </div>
            <div class="col-md-3">
                <a href="view_reports.php" class="btn btn-info btn-lg btn-block">View Reports</a>
            </div>
            <div class="col-md-3">
                <a href="add_report.php" class="btn btn-success btn-lg btn-block">Add Report</a>
            </div>
        </div>
        
        <div class="text-center mt-4">
          <p>Need help? <a href="https://www.facebook.com/patrickomode666" target="_blank">Contact us</a></p>
        </div>
    </div>
    
    <footer class="text-center mt-5">
        <p>&copy; <?php echo date("Y"); ?> Lost and Found System. All rights reserved.</p>
    </footer>
</body>
</html>
