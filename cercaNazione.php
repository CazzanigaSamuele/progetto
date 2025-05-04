<?php
session_start(); // Inizia la sessione
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerca nazione</title> <!-- Titolo della pagina -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Link al file CSS -->
    <script>
        async function cercaNazione() { // Funzione per cercare una nazione
            let nazione = document.getElementById("nazione").value; // Ottiene il valore dell'input
            if (nazione == "") { // Controlla se l'input è vuoto
                alert('Nome non valido'); // Visualizza un alert
                return;
            }

            // Costruisce l'URL dell'API utilizzando il nome della nazione
            const apiUrl = "https://restcountries.com/v3.1/name/" + encodeURIComponent(nazione);

            try {
                // Effettua una richiesta all'API
                let risposta = await fetch(apiUrl);

                // Controlla se la richiesta è andata a buon fine
                if (!risposta.ok) {
                    throw new Error('richiesta API fallita'); // Gestisce l'errore
                }

                // Decodifica la risposta JSON
                let data = await risposta.json();

                // Visualizza i risultati
                let divRisultato = document.getElementById("risultato");
                divRisultato.innerHTML = ''; // Pulisce i risultati precedenti

                if (data.length == 0) { // Controlla se ci sono risultati
                    const p = document.createElement('p');
                    p.textContent = 'Paese non trovato'; // Visualizza un messaggio
                    divRisultato.appendChild(p);
                    return;
                }

                // Ciclo attraverso i risultati e li visualizza
                for (const country of data) {
                    // Crea un contenitore per le informazioni sulla nazione
                    let divNazione = document.createElement('div');
                    divNazione.style.marginBottom = '20px';
                    divNazione.style.padding = '10px';
                    divNazione.style.border = '1px solid #ddd';
                    divNazione.style.borderRadius = '5px';

                    // Crea e aggiunge elementi per le informazioni sulla nazione
                    let nameH3 = document.createElement('h3');
                    nameH3.textContent = country.name.common;
                    divNazione.appendChild(nameH3);

                    let capitalP = document.createElement('p');
                    capitalP.textContent = "Capitale: "+country.capital;
                    divNazione.appendChild(capitalP);

                    // Aggiunge altre informazioni sulla nazione...

                    // Aggiunge l'immagine della bandiera
                    let flagImg = document.createElement('img');
                    flagImg.src = country.flags.png;
                    flagImg.alt = `${country.name.common} flag`;
                    flagImg.style.width = '200px';
                    flagImg.style.height = 'auto';
                    flagImg.style.marginTop = '10px';
                    divNazione.appendChild(flagImg);

                    // Aggiunge le informazioni alla pagina
                    divRisultato.appendChild(divNazione);
                }

            } catch (error) {
                alert('Error searching country. Please try again.'); // Gestisce gli errori
            }
        }
    </script>
</head>
<body>
    <h2>Cerca nazione:</h2> <!-- Titolo -->
    <!-- Etichetta e input per la ricerca -->
    <label for="nazione">Nome nazione:</label>
    <input type="text" name="nazione" id="nazione">
    <button type="button" onclick="cercaNazione()">Cerca</button> <!-- Pulsante per cercare -->
    <div id="risultato"></div> <!-- Contenitore per i risultati -->

    <p><a href="index.php">Torna all'index</a></p> <!-- Link per tornare all'index -->
</body>
</html>