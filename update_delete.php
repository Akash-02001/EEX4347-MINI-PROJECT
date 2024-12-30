<?php
include('dbconnect.php');

// Handle Search
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $nic = $_POST['nic'];

    
    $query = "SELECT * FROM students WHERE nic = '$nic'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
        $name = $student['name'];
        $address = $student['address'];
        $tel = $student['tel'];
        $course = $student['course'];
    } else {
        echo "No student found with NIC $nic";
    }
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $course = $_POST['course'];

    // Update student details
    $update_query = "UPDATE students SET name = '$name', address = '$address', tel = '$tel', course = '$course' WHERE nic = '$nic'";
    
    if (mysqli_query($conn, $update_query)) {
        $successMessage= "Student updated successfully!";
    } else {
        $errorMessage= "Error: " . mysqli_error($conn);
    }
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $nic = $_POST['nic'];

    // Delete student record
    $delete_query = "DELETE FROM students WHERE nic = '$nic'";
    
    if (mysqli_query($conn, $delete_query)) {
        $successMessage="Student deleted successfully!";
       
        $nic = $name = $address = $tel = $course = '';
    } else {
        $errorMessage= "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Student | Student Portal</title>
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
            <h2>Update or Delete Student</h2>

            <!-- Search Form -->
            <form action="update_delete.php" method="POST">
                <div class="form-group">
                    <label for="nic">Enter NIC Number</label>
                    <input type="text" class="form-control" id="nic" name="nic" 
                           value="<?php echo isset($nic) ? $nic : ''; ?>" required>
                </div>
                <button type="submit" name="search" class="btn">Search Student</button>
            </form>

            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success">
                    <?php echo $successMessage; ?>
                </div>
            <?php elseif (isset($errorMessage)): ?>
                <div class="alert alert-error">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($student)): ?>
            <!-- Update/Delete Form -->
            <form action="update_delete.php" method="POST">
                <input type="hidden" name="nic" value="<?php echo $nic; ?>">
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo isset($name) ? $name : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" 
                           value="<?php echo isset($address) ? $address : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="tel">Telephone Number</label>
                    <input type="text" class="form-control" id="tel" name="tel" 
                           value="<?php echo isset($tel) ? $tel : ''; ?>" required>
                </div>
                
                <div class="form-group">
  <label for="course">Course</label>
  <select class="form-control" id="course" name="course" required>
    <option value="">Select a Course</option>
    <option value="BSc IT" <?php if($course == 'BSc IT') echo 'selected'; ?>>BSc IT</option>
    <option value="Business Management" <?php if($course == 'Business Management') echo 'selected'; ?>>Business Management</option>
    <option value="Engineering" <?php if($course == 'Engineering') echo 'selected'; ?>>Engineering</option>
  </select>
</div>
                
                <button type="submit" name="update" class="btn">Update Student</button>
                <button type="submit" name="delete" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this student?');">
                    Delete Student
                </button>
            </form>
            <?php endif; ?>

            <a href="dashboard.php" class="btn" style="margin-top: 1rem; background: #607D8B;">
                Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>