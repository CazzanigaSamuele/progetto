<?php 
    session_start();
    if (!isset($_SESSION['autenticato'])){
        header("index.php");
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informazioni sui Paesi</title> <!-- Titolo della pagina -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Link al file CSS -->
</head>
<body>
    <div class="container">
        <h1>Applicazione Informazioni sui Paesi</h1> <!-- Titolo -->
        
        <p>Benvenuto, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Logout</a></p>

        <p>Seleziona una delle seguenti opzioni:</p> <!-- Messaggio -->
        
        <!-- Menu delle opzioni -->
        <div class="menu">
            <a href="cercaNazione.php">Cerca nazione</a>
            <a href="quizBandiere.php">Prova quiz delle bandiere</a>
            <a href="quizPopolazioni.php">Prova quiz delle popolazioni</a>
            <a href="classifica.php">Guarda classifica giochi</a>
        </div>
    </div>
</body>
</html>