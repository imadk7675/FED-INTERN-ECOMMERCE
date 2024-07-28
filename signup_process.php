<?php
$host = 'localhost';
$db   = 'golu';
$user = 'root';
$pass = 'golu1234'; // Password if you have set any

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    // Redirect to homepage or login page
    header('Location: index.html');
    exit;
}
?>
