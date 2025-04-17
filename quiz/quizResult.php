<?php
session_start();

if (!isset($_SESSION['quizResult'])) {
    header("Location: quiz.php");
    exit();
}

$result = $_SESSION['quizResult'];
unset($_SESSION['quizResult']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato del Quiz</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Risultato del Quiz</h1>
        
        <!-- Visualizza il risultato del quiz -->
        <div class="result-container">
            <p class="result-text"><?php echo $result; ?></p>
        </div>
        
        <!-- Opzioni per tornare indietro -->
        <div class="back-link">
            <a href="quiz.php" class="btn btn-success">Prova Ancora</a>
            <a href="index.php" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</body>
</html>