<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Cerca un Paese</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Alcuni stili di base per una visualizzazione ordinata */
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .result { margin-top: 20px; padding: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cerca un Paese</h1>
        <form id="countryForm">
            <div class="form-group">
                <label for="countryName">Nome del Paese:</label>
                <input type="text" id="countryName" name="countryName" required>
            </div>
            <button type="submit">Cerca</button>
        </form>
        <div id="result" class="result"></div>
        <div class="back-link" style="margin-top:20px;">
            <a href="index.html">Torna alla Home</a>
        </div>
    </div>

    <script>
        document.getElementById("countryForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "infoNazione.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const resultDiv = document.getElementById("result");
                    if (response.status === "OK") {
                        const country = response.data;
                        let html = `<h2>${country.name.common}</h2>`;
                        html += `<img src="${country.flags.png}" alt="${country.name.common}" style="max-width:100%;"><br>`;
                        html += `<p><strong>Capitale:</strong> ${country.capital ? country.capital[0] : 'N/A'}</p>`;
                        html += `<p><strong>Popolazione:</strong> ${Number(country.population).toLocaleString()}</p>`;
                        html += `<p><strong>Regione:</strong> ${country.region}</p>`;
                        html += `<p><strong>Lingue:</strong> ${country.languages ? Object.values(country.languages).join(', ') : 'N/A'}</p>`;
                        html += `<p><strong>Valuta:</strong> ${country.currencies ? country.currencies[Object.keys(country.currencies)[0]].name : 'N/A'}</p>`;
                        html += `<p><strong>Confina con:</strong> ${country.borders ? country.borders.join(', ') : 'N/A'}</p>`;
                        resultDiv.innerHTML = html;
                    } else {
                        resultDiv.innerHTML = `<p style="color:red;">Errore: ${response.msg}</p>`;
                    }
                }
            };
            const countryName = document.getElementById("countryName").value;
            xhr.send("countryName=" + encodeURIComponent(countryName));
        });
    </script>
</body>
</html>
