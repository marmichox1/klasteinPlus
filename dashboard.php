<?php
session_start();
include 'db.php';

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <div class="navbar">
            <h1>Dashboard</h1>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </nav>
    <div class="sidebar">
        <?php if ($role === 'admin' || $role === 'administrator') : ?>
            <a href="user_management.php">User Management</a>
        <?php endif; ?>
        <a href="product_management.php">Product Management</a>
    </div>
    <div class="content">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['login']); ?>!</h2>
        <p>Access the product management section to view, add, edit, or delete products.</p>
       
    </div>
</body>
</html>
