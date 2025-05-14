<?php
include "conn.php";

// Query per ottenere i migliori punteggi per le bandiere
$bandiereQuery = "
    SELECT 
        u.username,
        MAX(p.punteggio) AS punteggio
    FROM punteggi p
    LEFT JOIN utenti u ON p.utente_id = u.id
    WHERE p.tipologia = 'bandiere'
    GROUP BY p.utente_id
    ORDER BY punteggio DESC
    LIMIT 5
";

// Query per ottenere i migliori punteggi per le popolazioni
$popolazioniQuery = "
    SELECT 
        u.username,
        MAX(p.punteggio) AS punteggio
    FROM punteggi p
    LEFT JOIN utenti u ON p.utente_id = u.id
    WHERE p.tipologia = 'popolazioni'
    GROUP BY p.utente_id
    ORDER BY punteggio DESC
    LIMIT 5
";

$bandiereRisultati = $conn->query($bandiereQuery);
$popolazioniRisultati = $conn->query($popolazioniQuery);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica Migliori Punteggi</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Classifica Migliori Punteggi</h1>
        
        <div class="classifiche-container">
            <div class="classifica">
                <h2 class="subtitle">Quiz Bandiere</h2>
                <ul class="lista-classifica">
                    <?php
                    $posizione = 1;
                    if ($bandiereRisultati->num_rows > 0) {
                        while($row = $bandiereRisultati->fetch_assoc()) {
                            echo "<li class='classifica-item'>
                                <span class='posizione'>{$posizione}.</span>
                                <span class='utente'>{$row['username']}</span>
                                <span class='punteggio'>{$row['punteggio']}</span>
                            </li>";
                            $posizione++;
                        }
                    } else {
                        echo "<li class='classifica-item'>Nessun punteggio registrato</li>";
                    }
                    ?>
                </ul>
            </div>
            
            <div class="classifica">
                <h2 class="subtitle">Quiz Popolazioni</h2>
                <ul class="lista-classifica">
                    <?php
                    $posizione = 1;
                    if ($popolazioniRisultati->num_rows > 0) {
                        while($row = $popolazioniRisultati->fetch_assoc()) {
                            echo "<li class='classifica-item'>
                                <span class='posizione'>{$posizione}.</span>
                                <span class='utente'>{$row['username']}</span>
                                <span class='punteggio'>{$row['punteggio']}</span>
                            </li>";
                            $posizione++;
                        }
                    } else {
                        echo "<li class='classifica-item'>Nessun punteggio registrato</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        
        <div class="back-link">
            <a href="paginaPrincipale.php" class="link">Torna all'index</a>
        </div>
    </div>
</body>
</html>