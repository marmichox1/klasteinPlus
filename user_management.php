<?php
session_start();
include 'db.php';

if (!isset($_SESSION['login']) || !in_array($_SESSION['role'], ['admin', 'administrator'])) {
    header('Location: index.php');
    exit();
}


$stmt = $pdo->query("SELECT * FROM login");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Management</title>
</head>
<body>
    <nav>
        <div class="navbar">
            <h1>User Management</h1>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </nav>
    <div class="content">
        <h2>Users List</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['login']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                   
                    <a href="edit_user.php?id=<?php echo $user['login']; ?>">Edit</a>
                    <a href="delete_user.php?id=<?php echo $user['login']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="add_user.php">Add User</a>
    </div>
</body>
</html>
