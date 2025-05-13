<?php
session_start(); // Inizia la sessione

// Verifica se l'utente è autenticato
if (!isset($_SESSION['autenticato']) || $_SESSION['autenticato'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Bandiere</title> <!-- Titolo della pagina -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Link al file CSS -->
    <script>
        let nomePaeseCorretto = ""; // Variabile per il nome del paese corretto
        let punteggioCorrente = 0; // Variabile per gestire il punteggio

        // Funzione per caricare una bandiera random
        async function caricaLaBandiera() {
            try {
                // Effettua una richiesta all'API
                let risposta = await fetch("ajax/bandieraRandom.php");

                // Controlla se la richiesta è andata a buon fine
                if (!risposta.ok) {
                    throw new Error('Richiesta API fallita');
                }

                // Decodifica la risposta JSON
                let data = await risposta.json();
                let divBandiera = document.getElementById("immagineBandiera");

                // Controlla se ci sono dati
                if (data.status == "OK") {
                    let urlBandiera = data.flagUrl;
                    let immagineBandiera = document.createElement("img");
                    immagineBandiera.src = urlBandiera;
                    nomePaeseCorretto = data.countryName;
                    divBandiera.innerHTML = "";
                    divBandiera.appendChild(immagineBandiera);
                } else {
                    divBandiera.innerHTML = "Bandiera non trovata!";
                }

                // Pulisce i campi
                document.getElementById("nomeBandiera").value = "";
                document.getElementById("risultato").innerHTML = "";

            } catch (err) {
                console.error(err);
                document.getElementById("immagineBandiera").innerHTML = "Errore nella richiesta!";
            }
        }

        // Funzione per controllare la risposta
        async function controllaLaRisposta() {
            const input = document.getElementById("nomeBandiera");
            const guess = input.value.trim().toLowerCase();
            const corretto = nomePaeseCorretto.trim().toLowerCase();
            const risultato = document.getElementById("risultato");

            // Controlla se la risposta è corretta
            if (guess == corretto) {
                punteggioCorrente++;
                risultato.innerHTML = "✅ Corretto!";
                document.getElementById("punteggio").innerText = "Punteggio: " + punteggioCorrente;
                
                // Aggiunge un bottone per continuare
                const bottoneContinua = document.createElement("button");
                bottoneContinua.textContent = "Continua";
                bottoneContinua.addEventListener("click", function () {
                    caricaLaBandiera();
                    bottoneContinua.remove();
                });

                risultato.appendChild(document.createElement("br"));
                risultato.appendChild(bottoneContinua);
            } else {
                // Reindirizza a salvaPunteggio.php con il punteggio corrente
                window.location.href = `salvaPunteggio.php?score=${punteggioCorrente}&tipologia=bandiere`;
                $SESSION["nazioneCorretta"]=$nomePaeseCorretto;
            }
        }

        // Carica la bandiera all'avvio
        document.addEventListener("DOMContentLoaded", function () {
            caricaLaBandiera();
        });
    </script>
</head>
<body>
    <h1>Indovina la Bandiera</h1> <!-- Titolo -->
    <div id="immagineBandiera"></div> <!-- Contenitore per la bandiera -->
    <div id="punteggio">Punteggio: 0</div> <!-- Visualizza il punteggio -->
    <!-- Form per l'input della risposta -->
    <div id="guessBandiera">
        <input type="text" id="nomeBandiera" placeholder="Nome del paese">
        <button onclick="controllaLaRisposta()">Invia</button>
    </div>
    <div id="risultato" class="risultato"></div> <!-- Contenitore per i risultati -->
    <div id="tornaIndex">
        <a href="paginaPrincipale.php">Torna all'index</a> <!-- Link per tornare all'index -->
    </div>
</body>
</html>