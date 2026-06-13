<!-- questo file va incluso in tutte le pagine -->
<html>
    <head>
        <link rel="stylesheet" href="css/stile.css">
        <!-- L'ordine degli import deve essere funzioni_comuni e poi le altre -->
        <script src="js/funzioni_comuni.js"></script>
        <script src="js/autocompletamento.js"></script>
        <script src="js/fatture.js"></script>
        <script src="js/utenze.js"></script>
    </head>
    <body>
        
        <div class="header">
            <div class="banner">
                <h1>Aquabear</h1>
            </div>

            <nav>
                <ul>
                    <li><a href="index.php" id="home">Home</a></li>
                    <li><a href="clienti.php" id="clienti">Clienti</a></li>
                    <li><a href="utenze.php" id="utenze">Utenze</a></li>
                    <li><a href="letture.php" id="letture">Letture</a></li>
                    <li><a href="fatture.php" id="fatture">Fatture</a></li>
                </ul>
            </nav>
        </div>