<?php
session_start();

if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
} elseif (isset($_SESSION['countryInfo'])) {
    $countryInfo = $_SESSION['countryInfo'];
    unset($_SESSION['countryInfo']);
} else {
    header("Location: search.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informazioni sul Paese</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Informazioni sul Paese</h1>
        
        <?php if (isset($errorMessage)): ?>
            <!-- Visualizza un messaggio di errore -->
            <div class="alert alert-danger">
                <?php echo $errorMessage; ?>
            </div>
            <a href="search.php" class="btn btn-primary">Torna alla Ricerca</a>
        <?php else: ?>
            <!-- Visualizza le informazioni sul paese -->
            <div class="card">
                <img src="<?php echo $countryInfo[0]['flags']['png']; ?>" class="card-img-top" alt="<?php echo $countryInfo[0]['name']['common']; ?>">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $countryInfo[0]['name']['common']; ?></h3>
                    <p class="card-text"><strong>Capitale:</strong> <?php echo $countryInfo[0]['capital'][0] ?? 'N/A'; ?></p>
                    <p class="card-text"><strong>Popolazione:</strong> <?php echo number_format($countryInfo[0]['population']); ?></p>
                    <p class="card-text"><strong>Regione:</strong> <?php echo $countryInfo[0]['region']; ?></p>
                    <p class="card-text"><strong>Lingue:</strong> <?php echo implode(', ', array_values($countryInfo[0]['languages'])); ?></p>
                    <p class="card-text"><strong>Valuta:</strong> <?php echo $countryInfo[0]['currencies'][key($countryInfo[0]['currencies'])]['name']; ?></p>
                    <p class="card-text"><strong>Confina con:</strong> <?php echo implode(', ', $countryInfo[0]['borders'] ?? []); ?></p>
                </div>
            </div>
            <a href="search.php" class="btn btn-primary mt-4">Torna alla Ricerca</a>
        <?php endif; ?>
    </div>
</body>
</html>