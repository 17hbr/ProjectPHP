<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config.php';

    $login = $_POST["login"];
    $haslo = $_POST["haslo"];

   
    $sql = "SELECT * FROM uzytkownicy WHERE login = '$login' AND haslo = '$haslo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['login'] = $login; 
        echo "Zalogowano pomyślnie!";
        header("Location: index.php"); 
        exit();
    } else {
        echo "Nieprawidłowy login lub hasło!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie - ByteBox</title>
</head>
<body>
    <h1>Logowanie</h1>
    <form action="logowanie.php" method="post">
        Login: <input type="text" name="login" required><br>
        Hasło: <input type="password" name="haslo" required><br>
        <input type="submit" value="Zaloguj się">
    </form>
    <a href="index.php">Powrót do strony głównej</a>
</body>
</html>
