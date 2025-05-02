<?php
// quizBandiere.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Bandiere</title>
    <style>
        img { max-width: 300px; display: block; margin: 10px 0; }
        .feedback { font-weight: bold; margin-top: 10px; }
        #risultato button { margin-top: 10px; }
    </style>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        let nomePaeseCorretto = "";

        async function caricaLaBandiera() {
            try {
                let risposta = await fetch("ajax/bandieraRandom.php");

                if (!risposta.ok) {
                    throw new Error('Richiesta API fallita');
                }

                let data = await risposta.json();
                let divBandiera = document.getElementById("immagineBandiera");

                if (data.status === "OK") {
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

        async function controllaLaRisposta() {
            const input = document.getElementById("nomeBandiera");
            const guess = input.value.trim().toLowerCase();
            const corretto = nomePaeseCorretto.trim().toLowerCase();
            const risultato = document.getElementById("risultato");

            let isCorretto = false;

            if (guess==corretto) {
                isCorretto=true;
                risultato.innerHTML = "✅ Corretto!";
            } else {
                risultato.innerHTML = `❌ Sbagliato! Era <strong>${nomePaeseCorretto}</strong>`;
            }

            // Chiamata GET per aggiornare il punteggio
            try {
                const response = await fetch(`ajax/aggiornaPunteggio.php?corretto=${isCorretto}`);
                const data = await response.json();
                if (data.status === "OK") {
                    document.getElementById("punteggio").innerText = "Punteggio: " + data.punteggio;
                }
            } catch (error) {
                console.error("Errore aggiornamento punteggio:", error);
            }

            // Bottone per continuare
            const bottoneContinua = document.createElement("button");
            bottoneContinua.textContent = "Continua";
            bottoneContinua.addEventListener("click", function () {
                caricaLaBandiera();
                bottoneContinua.remove();
            });

            risultato.appendChild(document.createElement("br"));
            risultato.appendChild(bottoneContinua);
        }

        

        document.addEventListener("DOMContentLoaded", function () {
            caricaLaBandiera();
        });
    </script>
</head>
<body>
    <h1>Indovina la Bandiera</h1>

    <div id="immagineBandiera"></div>
    
    <div id="punteggio">Punteggio:</div>
    <div id="guessBandiera">
        <input type="text" id="nomeBandiera" placeholder="Nome del paese">
        <button onclick="controllaLaRisposta()">Invia</button>
    </div>

    <div id="risultato" class="risultato"></div>

    <div id="tornaIndex">
        <a href="index.php">Torna all'index</a>
    </div>
</body>
</html>
