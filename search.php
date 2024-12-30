<?php
include('dbconnect.php');

// Initialize variables to avoid undefined errors
$name = $address = $tel = $course = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nic'])) {
    $nic = $_POST['nic'];

    // Escape special characters to prevent SQL injection
    $nic = mysqli_real_escape_string($conn, $nic);

    // Query to find student by NIC
    $query = "SELECT * FROM students WHERE nic = '$nic'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn)); // Show the error if the query fails
    }

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);

        
        // Assign values
        $name = $student['name'];
        $address = $student['address'];
        $tel = $student['tel'];
        $course = $student['course'];

        
    } else {
        $errorMessage = "No student found with NIC: $nic";
        echo $errorMessage;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Student | Student Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
<nav class="navbar">
        <a href="index.html" class="logo">OUSL</a>
        <a href="index.html" class="home-btn">Back to Home</a>
    </nav>
    <div class="container">
        <div class="card">
            <h2>Search Student</h2>
            
            <form action="search.php" method="POST">
                <div class="form-group">
                    <label for="nic">Enter NIC Number</label>
                    <input type="text" class="form-control" id="nic" name="nic" required>
                </div>
                <button type="submit" class="btn">Search</button>
            </form>

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($name) || !empty($address) || !empty($tel) || !empty($course)): ?>
                <div class="search-result">
                    <div class="form-group">
                        <label>Name</label>
                        <div class="form-control">
                            <?php echo !empty($name) ? htmlspecialchars($name) : 'No data'; ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Address</label>
                        <div class="form-control">
                            <?php echo !empty($address) ? htmlspecialchars($address) : 'No data'; ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Telephone</label>
                        <div class="form-control">
                            <?php echo !empty($tel) ? htmlspecialchars($tel) : 'No data'; ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Course</label>
                        <div class="form-control">
                            <?php echo !empty($course) ? htmlspecialchars($course) : 'No data'; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <a href="dashboard.php" class="btn" style="margin-top: 1rem; background: #607D8B;">
                Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>
