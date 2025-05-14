<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title> <!-- Titolo della pagina -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Link al file CSS -->
</head>
<body>
    <div class="container">
        <h2>Registrazione</h2> <!-- Titolo -->
        <!-- Form per la registrazione -->
        <form action="gestoreRegistrazione.php" method="get">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Registrati</button>
        </form>
        <p>Hai già un account? <a href="login.php">Accedi qui</a></p>
    </div>
</body>
</html>