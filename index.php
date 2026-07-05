<?php
include 'header.php';
require_once 'backend/Database.php';

require_once 'backend/ClientiRep.php';
require_once 'backend/UtenzeRep.php';
require_once 'backend/LettureRep.php';
require_once 'backend/FattureRep.php';

$clientiRep = new ClientiRepository();
$utenzeRep = new UtenzeRepository();
$lettureRep = new LettureRepository();
$fattureRep = new FattureRepository();

$totaleClienti = $clientiRep->contaTutti();
$totaleUtenze = $utenzeRep->contaTutti();
$totaleLetture = $lettureRep->contaTutti();
$totaleFatture = $fattureRep->contaTutti();

?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<div class="home">
    <div class="dati-totali">
    
    <h5 class="card-home">
        <span class="card-icon"><i class="fa-solid fa-users"></i></span>
        <span class="card-info">
            <span class="titolo-card">Utenti</span>
            <span class="numero-grande"><?php echo $totaleUtenti ?? '12.845'; ?></span>
        </span>
    </h5>

    <h5 class="card-home">
        <span class="card-icon"><i class="fa-solid fa-droplet"></i></span>
        <span class="card-info">
            <span class="titolo-card">Utenze</span>
            <span class="numero-grande"><?php echo $totaleUtenze ?? '18.532'; ?></span>
        </span>
    </h5>

    <h5 class="card-home">
        <span class="card-icon"><i class="fa-solid fa-chart-line"></i></span>
        <span class="card-info">
            <span class="titolo-card">Letture</span>
            <span class="numero-grande"><?php echo $totaleLetture ?? '245.781'; ?></span>
        </span>
    </h5>

    <h5 class="card-home">
        <span class="card-icon"><i class="fa-solid fa-file-invoice-dollar"></i></span>
        <span class="card-info">
            <span class="titolo-card">Fatture</span>
            <span class="numero-grande"><?php echo $totaleFatture ?? '4.328'; ?></span>
        </span>
    </h5>

</div>



    <div class="home-layout">
        
        <div class="mappa-container">
            <div id="map"></div>
        </div>

        <div class="contenuto-destra">
    
    <?php 
    // Richiamiamo la nuova funzione per ottenere la lista e contarla
    $listaAziende = $clientiRep->ottieniAziendeDistinte();
    $totaleAziende = count($listaAziende);
    ?>

    <div class="blocco-fornitori">
        
        <div class="fornitori-header">
            <h3>Aziende attive</h3>
            <span class="badge-fornitori"><?php echo $totaleAziende; ?> Attive</span>
        </div>

        <ul class="lista-fornitori">
            <?php foreach ($listaAziende as $index => $azienda): 
                // Estrae la prima lettera e la fa maiuscola
                $iniziale = strtoupper(substr(trim($azienda['RAGIONE_SOCIALE']), 0, 1));
                // Crea il numero progressivo (partendo da 1)
                $numero = $index + 1;
            ?>
                <li>
                    <div class="iniziale-azienda"><?php echo $iniziale; ?></div>
                    
                    <div class="dati-azienda">
                        <strong><?php echo htmlspecialchars($azienda['RAGIONE_SOCIALE']); ?></strong>
                    </div>

                    <div class="numero-azienda"><?php echo $numero; ?></div>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

</div>

    </div>

</div>

<script src="js/mappa.js"></script>

<?php
include 'footer.php';
?>