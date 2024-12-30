<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login.php"); 
    exit();
}


$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ADMIN</title>
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
            <div class="welcome">
                Hello....Welcome.....
            </div>
            <p style="text-align: center; margin-bottom: 2rem;">
                What would you like to do today?
            </p>
            
            <form action="update_delete.php" method="GET">
                <button type="submit" class="btn" style="background: #4CAF50;">
                    Update/Delete Student
                </button>
            </form>
            
            <form action="search.php" method="post">
                <button type="submit" class="btn" style="background: #2196F3;">
                    Search Student
                </button>
            </form>
            
            <form action="logout.php" method="POST">
                <button type="submit" class="btn" style="background: #f44336;">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>
