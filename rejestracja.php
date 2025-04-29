<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config.php';

    $login = $_POST["login"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];

    // Sprawdzanie, czy login lub email już istnieją
    $sql = "SELECT * FROM uzytkownicy WHERE login = '$login' OR email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login lub email już istnieje!";
    } else {
        // Wstawienie nowego użytkownika
        $sql = "INSERT INTO uzytkownicy (login, haslo, email) VALUES ('$login', '$haslo', '$email')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['login'] = $login; // Ustawiamy sesję po rejestracji
            echo "Rejestracja zakończona sukcesem!";
            header("Location: index.php"); // Przekierowanie na stronę główną
            exit();
        } else {
            echo "Błąd: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja - ByteBox</title>
</head>
<body>
    <h1>Rejestracja</h1>
    <form action="rejestracja.php" method="post">
        Login: <input type="text" name="login" required><br>
        Email: <input type="email" name="email" required><br>
        Hasło: <input type="password" name="haslo" required><br>
        <input type="submit" value="Zarejestruj się">
    </form>
    <a href="index.php">Powrót do strony głównej</a>
</body>
</html>
