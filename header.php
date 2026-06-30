<!-- questo file va incluso in tutte le pagine -->
<html>
    <?php $page = basename($_SERVER['PHP_SELF']);?>
    
    <head>
        <link rel="stylesheet" href="css/stile.css">
        <!-- import di jquery e localizzazione italiana -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js" defer></script>
        <!-- import di file js che servono a tutte le pagine -->
        <script src="js/funzioni_comuni.js" defer></script>
        <script src="js/autocompletamento.js" defer></script>
    </head>
    <body>
        
        <div class="header">
            <div class="banner">
                <h1>Aquabear</h1>
            </div>

            <nav>
                <ul>
                     <li><a href="index.php" id="home" class="<?= $page == 'index.php' ? 'active' : '' ?>">Home</a></li>
                     <li><a href="clienti.php" id="clienti" class="<?= $page == 'clienti.php' ? 'active' : '' ?>">Clienti</a></li>
                     <li><a href="utenze.php" id="utenze" class="<?= $page == 'utenze.php' ? 'active' : '' ?>">Utenze</a></li>
                     <li><a href="letture.php" id="letture" class="<?= $page == 'letture.php' ? 'active' : '' ?>">Letture</a></li>
                     <li><a href="fatture.php" id="fatture" class="<?= $page == 'fatture.php' ? 'active' : '' ?>">Fatture</a></li>
                </ul>
            </nav>
        </div>