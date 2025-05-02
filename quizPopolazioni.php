<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Higher or Lower Population Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .country-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .country-card {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            width: 48%;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .country-card:hover {
            transform: scale(1.05);
        }
        .flag {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .population {
            font-weight: bold;
            margin-top: 8px;
        }
        .score {
            font-size: 22px;
            margin-bottom: 15px;
        }
        .result {
            font-weight: bold;
            margin: 15px 0;
            min-height: 24px;
        }
        .hidden {
            display: none;
        }
    </style>
    
</head>
<body>
    <h1>Higher or Lower Population Game</h1>
    <div class="score">Score: <span id="score">0</span></div>
    
    <div class="country-info">
        <div class="country-card" onclick="makeGuess('current')">
            <img id="currentFlag" class="flag" src="" alt="Current Country Flag">
            <h2 id="currentCountryName">Loading...</h2>
            <p class="population" id="currentPopulation">--</p>
        </div>
        <div class="country-card" onclick="makeGuess('next')">
            <img id="nextFlag" class="flag" src="" alt="Next Country Flag">
            <h2 id="nextCountryName">Loading...</h2>
            <p class="population hidden" id="nextPopulation">--</p>
        </div>
    </div>
    
    <div class="result" id="result"></div>
    
    <a href="index.php">Torna all'index</a>
    <script>
        async function fetchData() {
            try {
                const response = await fetch('ajax/giocoPopolazione.php');
                const data = await response.json();
                
                if (data.status === 'OK') {
                    document.getElementById('currentFlag').src = data.currentCountry.flag;
                    document.getElementById('currentCountryName').innerText = data.currentCountry.name;
                    document.getElementById('currentPopulation').innerText = data.currentCountry.population;
                    document.getElementById('nextFlag').src = data.nextCountry.flag;
                    document.getElementById('nextCountryName').innerText = data.nextCountry.name;
                    document.getElementById('score').innerText = data.score;
                    document.getElementById('nextPopulation').style.display = 'none';
                    document.getElementById('result').innerText = '';
                } else {
                    document.getElementById('result').innerText = data.msg;
                }
            } catch (error) {
                console.error('Error fetching data:', error);
                document.getElementById('result').innerText = 'Errore durante la comunicazione con il server';
            }
        }
        
        async function makeGuess(guess) {
            try {
                const response = await fetch('ajax/giocoPopolazione.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'guess=' + guess
                });
                
                const data = await response.json();
                
                if (data.status === 'OK') {
                    document.getElementById('currentFlag').src = data.currentCountry.flag;
                    document.getElementById('currentCountryName').innerText = data.currentCountry.name;
                    document.getElementById('currentPopulation').innerText = data.currentCountry.population;
                    document.getElementById('nextFlag').src = data.nextCountry.flag;
                    document.getElementById('nextCountryName').innerText = data.nextCountry.name;
                    document.getElementById('score').innerText = data.score;
                    document.getElementById('result').innerText = data.result;
                    document.getElementById('nextPopulation').style.display = 'inline';
                    document.getElementById('nextPopulation').innerText = data.revealedPopulation;
                    
                    // Rimuovi la popolazione visualizzata dopo un ritardo
                    setTimeout(() => {
                        document.getElementById('nextPopulation').style.display = 'none';
                        fetchData(); // Aggiornamento dati dopo una pausa
                    }, 1500);
                } else {
                    document.getElementById('result').innerText = data.msg;
                }
            } catch (error) {
                console.error('Error making guess:', error);
                document.getElementById('result').innerText = 'Errore durante la comunicazione con il server';
            }
        }
        
        // Initial data load
        fetchData();
    </script>
</body>
</html>