<?php
session_start();


$host = "localhost";
$user = "root";         
$password = "";         
$dbname = "wp_products"; 


$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM login WHERE login = ? AND password = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['login'];
        $_SESSION['role'] = $user['role'];

       
        header('Location: dashboard.php');
        exit();
    } else {
        
        header('Location: index.html?error=1');
        exit();
    }
}
?>

