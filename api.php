<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
    $stmt = $pdo->query("SELECT * FROM wp_k_products");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM wp_k_products WHERE product_aid = :id");
    $stmt->execute(['id' => $_GET['id']]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO wp_k_products (product_name_en, ...) VALUES (:product_name_en, ...)");
    $stmt->execute(['product_name_en' => $data['product_name_en'], ...]);
    echo json_encode(['status' => 'success']);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("UPDATE wp_k_products SET product_name_en = :product_name_en WHERE product_aid = :id");
    $stmt->execute(['product_name_en' => $data['product_name_en'], 'id' => $data['id']]);
    echo json_encode(['status' => 'success']);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("DELETE FROM wp_k_products WHERE product_aid = :id");
    $stmt->execute(['id' => $data['id']]);
    echo json_encode(['status' => 'success']);
    exit();
}
?>
