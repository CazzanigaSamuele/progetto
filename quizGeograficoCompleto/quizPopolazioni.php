<?php
session_start(); // Inizia la sessione

// Verifica se l'utente è autenticato
if (!isset($_SESSION['autenticato']) || $_SESSION['autenticato'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gioco Popolazioni</title>
    <link rel="stylesheet" href="css/styles.css">
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
    
    <a href="paginaPrincipale.php">Torna all'index</a>
    <script>
        let punteggioCorrente = 0;

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
                    punteggioCorrente = dati.punteggio;
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
                    
                    punteggioCorrente = dati.punteggio;
                    
                    // Controlla se la risposta è sbagliata
                    if (dati.risultato.includes('Sbagliato')) {
                        // Reindirizza a salvaPunteggio.php con il punteggio corrente e tipologia
                        window.location.href = `salvaPunteggio.php?score=${punteggioCorrente}&tipologia=popolazioni`;
                    } else {
                        setTimeout(() => {
                            document.getElementById('popolazioneSuccessivo').style.display = 'none';
                            caricaDati();
                        }, 1500);
                    }
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