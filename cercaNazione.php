<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Country</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        async function cercaNazione() {
            let nazione = document.getElementById("nazione").value;
            if (nazione == "") {
                alert('Nome non valido');
                return;
            }

            // Build the API URL
            const apiUrl = "https://restcountries.com/v3.1/name/" + encodeURIComponent(nazione);

            try {
                // Make the API request
                let risposta = await fetch(apiUrl);

                // Check if the request was successful
                if (!risposta.ok) {
                    throw new Error('richiesta API fallita');
                }

                // Decode the JSON response
                let data = await risposta.json();

                // Display the results
                let divRisultato = document.getElementById("risultato");
                divRisultato.innerHTML = ''; // Clear previous results

                if (data.length == 0) {
                    const p = document.createElement('p');
                    p.textContent = 'Paese non trovato';
                    divRisultato.appendChild(p);
                    return;
                }

                for (const country of data) {
                    // Create container div for country info
                    let divNazione = document.createElement('div');
                    divNazione.style.marginBottom = '20px';
                    divNazione.style.padding = '10px';
                    divNazione.style.border = '1px solid #ddd';
                    divNazione.style.borderRadius = '5px';


                    let nameH3 = document.createElement('h3');
                    nameH3.textContent = country.name.common;
                    divNazione.appendChild(nameH3);

                    let capitalP = document.createElement('p');
                    capitalP.textContent = "Capitale: "+country.capital;
                    divNazione.appendChild(capitalP);

                    let regionP = document.createElement('p');
                    regionP.textContent = `Region: ${country.region}`;
                    divNazione.appendChild(regionP);

                    let populationP = document.createElement('p');
                    populationP.textContent = `Population: ${country.population.toLocaleString()}`;
                    divNazione.appendChild(populationP);

                    let areaP = document.createElement('p');
                    areaP.textContent = `Area: ${country.area ? country.area.toLocaleString() + ' km²' : 'No area data'}`;
                    divNazione.appendChild(areaP);

                    let currenciesP = document.createElement('p');
                    currenciesP.textContent = `Currencies: ${Object.values(country.currencies || {}).map(c => c.name).join(', ') || 'No currency data'}`;
                    divNazione.appendChild(currenciesP);

                    let languagesP = document.createElement('p');
                    languagesP.textContent = `Languages: ${Object.values(country.languages || {}).join(', ') || 'No language data'}`;
                    divNazione.appendChild(languagesP);

                    let flagImg = document.createElement('img');
                    flagImg.src = country.flags.png;
                    flagImg.alt = `${country.name.common} flag`;
                    flagImg.style.width = '200px';
                    flagImg.style.height = 'auto';
                    flagImg.style.marginTop = '10px';
                    divNazione.appendChild(flagImg);

                    // Add country info to result container
                    divRisultato.appendChild(divNazione);
                }

            } catch (error) {
                alert('Error searching country. Please try again.');
            }
        }
    </script>
</head>
<body>
    <h2>Cerca nazione:</h2>
    <label for="nazione">Nome nazione:</label>
    <input type="text" name="nazione" id="nazione">
    <button type="button" onclick="cercaNazione()">Cerca</button>
    <div id="risultato"></div>

    <p><a href="index.php">Torna all'index</a></p>
</body>
</html>