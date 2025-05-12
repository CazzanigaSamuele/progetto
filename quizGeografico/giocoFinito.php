<?php
$punteggio = isset($_GET['score']) ? intval($_GET['score']) : 0;
$tipologia = isset($_GET['tipologia']) ? htmlspecialchars($_GET['tipologia']) : 'sconosciuta';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gioco Finito</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Stili esistenti */
    </style>
</head>
<body>
    <div class="container">
        <div class="game-over">
            <h1>Gioco Finito!</h1>
            <div class="score">
                Punteggio: <?php echo $punteggio; ?>
            </div>
            <div class="tipologia">
                Tipologia di gioco: <?php echo $tipologia; ?>
            </div>
            <!-- Altri contenuti -->
            <div class="restart">
                <a href="logout.php">Torna all'index</a>
                <a href="quizBandiere.php">Riprova</a>
            </div>
        </div>
    </div>
</body>
</html>