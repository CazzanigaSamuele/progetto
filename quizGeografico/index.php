<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informazioni sui Paesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .menu {
            display: flex;
            gap: 20px;
            margin: 20px 0;
        }
        .menu a {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .menu a:hover {
            background-color: #45a049;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Applicazione Informazioni sui Paesi</h1>
    <p>Seleziona una delle seguenti opzioni:</p>
    
    <div class="menu">
        <a href="cercaNazione.php">Cerca nazione</a>
        <a href="quizBandiere.php">Prova quiz delle bandiere</a>
    </div>
</body>
</html>