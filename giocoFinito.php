<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gioco Finito</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .game-over {
            text-align: center;
            margin-top: 50px;
        }
        .score {
            font-size: 32px;
            margin: 20px 0;
        }
        .restart {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="game-over">
            <h1>Gioco Finito!</h1>
            <div class="score">
                Punteggio: <?php echo isset($_GET['score']) ? htmlspecialchars($_GET['score']) : '0'; ?>
            </div>
            <div class="image">
                <?php
                $score = isset($_GET['score']) ? (int)$_GET['score'] : 0;
                
                if ($score >= 20) {
                    echo '<img src="https://via.placeholder.com/400x300?text=Super+Esperto" alt="Super Esperto">';
                } elseif ($score >= 10) {
                    echo '<img src="https://via.placeholder.com/400x300?text=Eccellente" alt="Eccellente">';
                } elseif ($score >= 5) {
                    echo '<img src="https://via.placeholder.com/400x300?text=Bravo" alt="Bravo">';
                } else {
                    echo '<img src="https://via.placeholder.com/400x300?text=Prova+Ancora" alt="Prova Ancora">';
                }
                ?>
            </div>
            <div class="message">
                <?php
                if ($score >= 20) {
                    echo '<p>Sei un vero esperto di geografia! Sfida i tuoi amici!</p>';
                } elseif ($score >= 10) {
                    echo '<p> Ottimo risultato! Continua così!</p>';
                } elseif ($score >= 5) {
                    echo '<p>Nice! Hai dimostrato di conoscere bene i paesi!</p>';
                } else {
                    echo '<p>Non preoccuparti, continua a giocare e migliorerai!</p>';
                }
                ?>
            </div>
            <div class="restart">
                <a href="quizPopolazioni.php">Riprova</a>
            </div>
        </div>
    </div>
</body>
</html>