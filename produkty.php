<?php
session_start();
require 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: logowanie.php");
    exit();
}

$sql = "SELECT * FROM produkty LIMIT 5"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Produkty - ByteBox</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="container">
    <h1>Produkty w sklepie ByteBox</h1>
    <a href="index.php"><button>Powrót do strony głównej</button></a>

    <div class="produkty">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="produkt">
                    
                    <img src="img/<?php echo $row['obrazek']; ?>" alt="<?php echo $row['nazwa']; ?>" width="150">
                    <h3><?php echo $row['nazwa']; ?></h3>
                    <p><?php echo $row['opis']; ?></p>
                    <p><strong><?php echo number_format($row['cena'], 2); ?> zł</strong></p>
                    <form action="koszyk.php" method="post">
                        <input type="hidden" name="id_produktu" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Dodaj do koszyka">
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Brak produktów w sklepie.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
