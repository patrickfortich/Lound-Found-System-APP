<?php
session_start();
include 'includes/db.php';

// Fetch the report to edit
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM reports WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$report = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Report</h2>
        <form action="edit_report_process.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" class="form-control" name="item_name" value="<?php echo htmlspecialchars($report['item_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" required><?php echo htmlspecialchars($report['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="date_found">Date Found:</label>
                <input type="date" class="form-control" name="date_found" value="<?php echo htmlspecialchars($report['date_found']); ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Upload New Image (optional):</label>
                <input type="file" class="form-control-file" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Update Report</button>
        </form>
    </div>
</body>
</html>
