<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config.php';

    $login = $_POST["login"];
    $haslo = $_POST["haslo"];

    $sql = "SELECT * FROM uzytkownicy WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($haslo, $user['haslo'])) {
            $_SESSION['login'] = $user['login'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];

            header("Location: index.php");
            exit();
        } else {
            echo "Nieprawidłowe hasło!";
        }
    } else {
        echo "Użytkownik nie istnieje!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie - ByteBox</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Logowanie</h1>
    <form action="logowanie.php" method="post">
        Login: <input type="text" name="login" required><br>
        Hasło: <input type="password" name="haslo" required><br>
        <input type="submit" value="Zaloguj się">
    </form>
    <a href="rejestracja.php">Nie masz konta? Zarejestruj się</a>
</div>
</body>
</html>
