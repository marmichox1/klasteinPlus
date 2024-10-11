<?php
session_start();
include 'db.php';

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}


$role = $_SESSION['role'];


$stmt = $pdo->query("SELECT * FROM wp_k_products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Product Management</title>
</head>
<body>
    <nav>
        <div class="navbar">
            <h1>Product Management</h1>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </nav>
    <div class="content">
        <h2>Products List</h2>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['product_name_en']); ?></td>
                <td>
                    <?php if ($role !== 'sales') : ?>
                        <a href="edit_product.php?id=<?php echo $product['product_aid']; ?>">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['product_aid']; ?>">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($role !== 'sales') : ?>
            <a href="add_product.php">Add Product</a>
        <?php endif; ?>
    </div>
</body>
</html>
