<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login2.php"); 
    exit();
}


$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
<nav class="navbar">
        <a href="index.html" class="logo">OUSL</a>
        <a href="dashboard.php" class="home-btn">ABOUT</a>
    </nav>
    <div class="container">
        <div class="card">
            <div class="user-welcome">
                Welcome, <span class="highlight"><?php echo $username; ?></span>
            </div>
            <p style="text-align: center; margin-bottom: 2rem;">
                What would you like to do today?
            </p>
            
            <form action="#update_delete.php" method="GET">
                <button type="submit" class="btn" style="background: #4CAF50;">
                    Discussion Forum
                </button>
            </form>
            
            <form action="#search.php" method="post">
                <button type="submit" class="btn" style="background: #2196F3;">
                    Event And Workshop
                </button>
            </form>
            
             <form action="#search.php" method="post">
                <button type="submit" class="btn" style="background: #2196F3;">
                    Messaging And Notification
                </button>
            </form>
            

             <form action="#search.php" method="post">
                <button type="submit" class="btn" style="background: #2196F3;">
                   Gamification
                </button>
            </form> 

             <form action="#search.php" method="post">
                <button type="submit" class="btn" style="background: #2196F3;">
                  Collaborative Tools
                </button>
            </form>

              <form action="#search.php" method="post">
                <button type="submit" class="btn" style="background: #2196F3;">
                   Study Groups
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
