<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Indovina le Bandiere</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Stili base per il quiz */
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .flag-container { text-align: center; margin-bottom: 20px; }
        .flag-img { max-width: 100%; height: auto; }
        .alert { padding: 10px; border: 1px solid #ccc; margin-top: 10px; }
        .alert-info { background-color: #e7f3fe; }
        .alert-danger { background-color: #f8d7da; }
        .back-link { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Indovina le Bandiere</h1>
        
        <div id="quiz-container">
            <div class="flag-container">
                <!-- La bandiera verrà caricata dinamicamente -->
                <img id="flag" src="" alt="Bandiera" class="flag-img">
            </div>
            
            <!-- Form per l'invio della risposta -->
            <form id="quizForm">
                <div class="form-group">
                    <label for="countryGuess">Qual è questo paese?</label>
                    <input type="text" id="countryGuess" name="countryGuess" required>
                </div>
                <button type="submit" class="btn btn-success">Invia</button>
            </form>
            
            <!-- Area per visualizzare il messaggio di risultato -->
            <div id="result"></div>
        </div>
        
        <div class="back-link">
            <a href="index.php" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
    
    <script>
        // Funzione per caricare una bandiera casuale via AJAX
        function loadRandomFlag() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "randomFlag.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === "OK") {
                        document.getElementById("flag").src = response.flagUrl;
                        document.getElementById("flag").alt = response.countryName;
                    } else {
                        document.getElementById("result").innerHTML = `<div class="alert alert-danger">${response.msg}</div>`;
                    }
                }
            };
            xhr.send();
        }
        
        // Funzione per inviare la risposta del quiz via AJAX
        function submitQuizAnswer() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "quizCheck.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            const answer = document.getElementById("countryGuess").value;
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const res = JSON.parse(xhr.responseText);
                    document.getElementById("result").innerHTML = `<div class="alert alert-info">${res.msg}</div>`;
                }
            };
            xhr.send("countryGuess=" + encodeURIComponent(answer));
        }
        
        // Gestione del submit del form usando AJAX
        document.getElementById("quizForm").addEventListener("submit", function(e) {
            e.preventDefault();
            submitQuizAnswer();
        });
        
        // Carica la bandiera casuale quando la pagina viene visualizzata
        window.onload = loadRandomFlag;
    </script>
</body>
</html>
