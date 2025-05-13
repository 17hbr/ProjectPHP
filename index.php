<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>ByteBox - Strona Główna</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Witamy w sklepie komputerowym ByteBox!</h1>

    <?php if (!isset($_SESSION['login'])): ?>
        <p>Aby kontynuować, zarejestruj się lub zaloguj:</p>
        <a href="rejestracja.php"><button>Zarejestruj się</button></a>
        <a href="logowanie.php"><button>Zaloguj się</button></a>
    <?php else: ?>
        <p>Zalogowany jako: <strong><?php echo $_SESSION['login']; ?></strong></p>
        <a href="produkty.php"><button>Przejdź do sklepu</button></a>
        <a href="wyloguj.php"><button>Wyloguj się</button></a>
    <?php endif; ?>
</div>
</body>
</html>
