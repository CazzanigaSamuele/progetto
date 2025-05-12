<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gioco Popolazioni</title>
    <style>
        /* Stile aggiuntivo */
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .infoPaese {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .schedaPaese {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            width: 48%;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .schedaPaese:hover {
            transform: scale(1.05);
        }
        .bandiera {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .popolazione {
            font-weight: bold;
            margin-top: 8px;
        }
        .punteggio {
            font-size: 22px;
            margin-bottom: 15px;
        }
        .risultato {
            font-weight: bold;
            margin: 15px 0;
            min-height: 24px;
        }
        .nascosto {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Gioco Popolazioni</h1>
    <div class="punteggio">Punteggio: <span id="punteggio">0</span></div>
    
    <div class="infoPaese">
        <div class="schedaPaese" onclick="makeGuess('attuale')">
            <img id="bandieraCorrente" class="bandiera" src="" alt="Bandiera Paese Corrente">
            <h2 id="nomePaeseCorrente">Caricamento...</h2>
            <p class="popolazione" id="popolazioneCorrente">--</p>
        </div>
        <div class="schedaPaese" onclick="makeGuess('successivo')">
            <img id="bandieraSuccessivo" class="bandiera" src="" alt="Bandiera Paese Successivo">
            <h2 id="nomePaeseSuccessivo">Caricamento...</h2>
            <p class="popolazione nascosto" id="popolazioneSuccessivo">--</p>
        </div>
    </div>
    
    <div class="risultato" id="risultato"></div>
    
    <a href="index.php">Torna all'index</a>
    <script>
        async function caricaDati() {
            try {
                const risposta = await fetch('ajax/giocoPopolazione.php');
                const dati = await risposta.json();
                
                if (dati.stato == 'OK') {
                    document.getElementById('bandieraCorrente').src = dati.paeseAttuale.bandiera;
                    document.getElementById('nomePaeseCorrente').innerText = dati.paeseAttuale.nome;
                    document.getElementById('popolazioneCorrente').innerText = dati.paeseAttuale.popolazione;
                    document.getElementById('bandieraSuccessivo').src = dati.paeseSuccessivo.bandiera;
                    document.getElementById('nomePaeseSuccessivo').innerText = dati.paeseSuccessivo.nome;
                    document.getElementById('punteggio').innerText = dati.punteggio;
                    document.getElementById('popolazioneSuccessivo').style.display = 'none';
                    document.getElementById('risultato').innerText = '';
                } else {
                    document.getElementById('risultato').innerText = dati.messaggio;
                }
            } catch (errore) {
                console.error('Errore durante il caricamento dei dati:', errore);
                document.getElementById('risultato').innerText = 'Errore durante la comunicazione con il server';
            }
        }
        
        async function makeGuess(guess) {
            try {
                const risposta = await fetch(`ajax/giocoPopolazione.php?stima=${guess}`);
                const dati = await risposta.json();
                
                if (dati.stato == 'OK') {
                    document.getElementById('bandieraCorrente').src = dati.paeseAttuale.bandiera;
                    document.getElementById('nomePaeseCorrente').innerText = dati.paeseAttuale.nome;
                    document.getElementById('popolazioneCorrente').innerText = dati.paeseAttuale.popolazione;
                    document.getElementById('bandieraSuccessivo').src = dati.paeseSuccessivo.bandiera;
                    document.getElementById('nomePaeseSuccessivo').innerText = dati.paeseSuccessivo.nome;
                    document.getElementById('punteggio').innerText = dati.punteggio;
                    document.getElementById('risultato').innerText = dati.risultato;
                    document.getElementById('popolazioneSuccessivo').style.display = 'inline';
                    document.getElementById('popolazioneSuccessivo').innerText = dati.popolazioneRivelata;
                    
                    setTimeout(() => {
                        document.getElementById('popolazioneSuccessivo').style.display = 'none';
                        caricaDati();
                    }, 1500);
                } else {
                    document.getElementById('risultato').innerText = dati.messaggio;
                }
            } catch (errore) {
                console.error('Errore durante la stima:', errore);
                document.getElementById('risultato').innerText = 'Errore durante la comunicazione con il server';
            }
        }
        
        caricaDati();
    </script>
</body>
</html>