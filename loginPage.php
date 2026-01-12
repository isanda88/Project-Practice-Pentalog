<?php
session_start();
require_once "connectionUs.php";

$conn = new ConnectionUs();
$pdo = $conn->connect();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

/* aici imi cauta in baza de date ioana si library sau orice utilizator inscris in baza de date  */
$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $username,
    'password' => $password
]);

$user = $stmt->fetch();
if ($user) {
    $_SESSION['username'] = $username;
    header("Location:loginSucces.php");
    exit;
} else {
    echo "Wrong!";
}


?>