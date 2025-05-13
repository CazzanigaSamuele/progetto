<?php
$punteggio = $_GET['score'];
$tipologia = $_GET['tipologia'];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gioco Finito</title>
    <link rel="stylesheet" href="css/styles.css">
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

            <div class="restart">
                <a href="paginaPrincipale.php">Torna all'index</a>
                <!-- Modifica qui: Usa la tipologia per determinare il quiz da riprovare -->
                <?php if ($tipologia == 'bandiere'){?>
                    <a href="quizBandiere.php">Riprova</a>
                <?php }elseif ($tipologia == 'popolazioni'){ ?>
                    <a href="quizPopolazioni.php">Riprova</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>