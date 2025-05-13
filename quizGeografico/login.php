<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title> <!-- Titolo della pagina -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Link al file CSS -->
</head>
<body>
    <div class="container">
        <h2>Login</h2> <!-- Titolo -->
        <!-- Form per il login -->
        <form action="gestoreLogin.php" method="get">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Non hai un account? <a href="registrazione.php">Registrati qui</a></p>
    </div>
</body>
</html>