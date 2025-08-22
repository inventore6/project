<?php
session_start();
require_once 'config.php'; // deve contenere la variabile $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM studente WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['email'] = $row['email'];
            header("Location: homepage.php"); // Reindirizza a home.php
            exit();
        }
    }

    // Se arrivo qui, login fallito
    header("Location: login.php?error=1");
    exit();
}
?>