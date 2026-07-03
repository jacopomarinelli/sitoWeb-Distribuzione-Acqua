<?php
include 'header.php';
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<div class="home">
    <div class="dati-totali">
        <h5>Utenti:</h5>
        <h5>Utenze:</h5>
        <h5>Letture:</h5>
        <h5>Fatture:</h5>
    </div>

    <div class="home-layout">
        
        <div class="mappa-container">
            <div id="map"></div>
        </div>

        <div class="contenuto-destra">
            <h2>Informazioni Aggiuntive</h2>
            <p>Qui puoi inserire testi, tabelle, dati sui clienti, utenze o qualsiasi altra cosa desideri mostrare a fianco della mappa.</p>
        </div>

    </div>

</div>

<script src="js/mappa.js"></script>

<?php
include 'footer.php';
?>