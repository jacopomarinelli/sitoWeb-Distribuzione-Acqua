<?php
require_once 'backend/Database.php';
require_once 'backend/FattureRep.php';

$repo = new FattureRepository();

function conversioneImportoDB($valore) {
    if ($valore === '') {
        return null;
    }

    $valore = str_replace(' €', '', $valore);
    $valore = str_replace('.', '', $valore);
    $valore = str_replace(',', '.', $valore);

    return $valore;
}

if (isset($_GET['action']) && $_GET['action'] === 'inserisci') {

    $fattura = [
        'numero' => $_POST['nuovo_numero_fattura'],
        'data' => $_POST['nuova_data_fattura'],
        'imponibile' => conversioneImportoDB($_POST['nuovo_imponibile']),
        'iva' => conversioneImportoDB($_POST['nuova_iva']),
        'totale' => conversioneImportoDB($_POST['nuovo_totale'])
    ];

    if ($repo->insertOperation($fattura)) {
        header("Location: fatture.php");
        exit;
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'elimina') {

    $fatture = json_decode(file_get_contents("php://input"), true);

    $repo->deleteOperation($fatture);

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'modifica') {

    $fattura = [
        'numero' => $_POST['nuovo_numero_fattura'],
        'data' => $_POST['nuova_data_fattura'],
        'imponibile' => conversioneImportoDB($_POST['nuovo_imponibile']),
        'iva' => conversioneImportoDB($_POST['nuova_iva']),
        'totale' => conversioneImportoDB($_POST['nuovo_totale'])
    ];

    if ($repo->updateOperation($fattura)) {
        header("Location: fatture.php");
        exit;
    }
}

include 'header.php';

?>
<script src="js/fatture.js" defer></script>
<script src="js/selezione.js" defer></script>
<!-- Qui va inserito codice pagina -->
        
        <div class="pagina">

            <form action="fatture.php" method="GET" class="ricerca" onsubmit="verificaFattura(event)">
                <label for="num_fat" class="campo">Codice fattura: </label>
                <input type="text" id="num_fat" name="numero_fattura" class="text-area" placeholder="es: FT-2026-12345"
                    pattern="[A-Z]{2}-[0-9]{4}-[0-9]{5}" title="FT-anno-numero(di 5 cifre)">
                
                <label for="data_fat" class="campo">Data: </label>
                <input type="text" id="data_fat" name="data_fattura" class="text-area widget-data" placeholder="gg/mm/aaaa"
                    readonly>
                
                <div class="sezione-prezzo">
                    <div class="campo-prezzo">
                        <label for="imp" class="campo">Imponibile: </label>
                        <input type="text" id="imp" name="imponibile" class="text-area" placeholder="Inserisci valore"
                            pattern="[0-9]{1,3}(\.[0-9]{3})?(,[0-9]{1,2})? €" title="Formato italiano" onblur="calcolaTotale('imp', 'iva', 'cos_tot')">
                    </div>

                    <div class="campo-prezzo">
                        <label for="iva" class="campo">Iva: </label>
                        <input type="text" id="iva" name="iva" class="text-area" placeholder="Inserisci valore"
                            pattern="[0-9]{1,3}(\.[0-9]{3})?(,[0-9]{1,2})? €" title="Formato italiano" onblur="calcolaTotale('imp', 'iva', 'cos_tot')">
                    </div>

                    <div class="campo-prezzo">
                        <label for="cos_tot" class="campo">Totale: </label>
                        <input type="text" id="cos_tot" name="totale" class="text-area" placeholder="Inserisci valore"
                            pattern="[0-9]{1,3}(\.[0-9]{3})?(,[0-9]{1,2})? €" title="Formato italiano">
                    </div>
                </div>
                
                <div class="pulsanti-ricerca">
                    <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">
                    <input type="reset" id="svuota" value="SVUOTA" class="svuota-ricerca">
                </div>

            </form>

            <div class="mostra-risultati">
                
                <div class="header-risultati">

                    <div class="campo-ricerca">
                        <h3>FATTURE</h3>
                    </div>

                    <div class="ordinamento" id="ordine-fatture">
                        <p>Ordina per</p>

                        <select name="colonna" id="colonna-ordinata-fatture" class="selezione-ordine">
                            <option value="col_num_fattura">CODICE FATTURA</option>
                            <option value="col_data_fattura">DATA</option>
                            <option value="col_totale">TOTALE</option>
                        </select>

                        <select name="ordine" id="senso-colonna-fatture" class="selezione-ordine">
                            <option value="crescente">CRESCENTE</option>
                            <option value="decrescente">DECRESCENTE</option>
                        </select>
                    </div>
                    
                    <div class="pulsante-nuova">
                        <i id="btn-aggiungi" class="fa-solid fa-square-plus" onclick="cambiaTitolo('inserisci'); nuovaFattura();"></i>
                        <i id="btn-modifica" class="fa-solid fa-pen-to-square" onclick="cambiaTitolo('modifica'); modificaFattura()"></i>
                        <i id="btn-elimina" class="fa-solid fa-trash" onclick="eliminaFatture()"></i>
                    </div>

                </div>

                <div class="risultati">
                    
                <table>
                    <thead>
                    <tr>
                        <th id="col_num_fattura" data-tipo="codice-fattura">Codice fattura</th>
                        <th id="col_data_fattura" data-tipo="data">Data</th>
                        <th id="col_imponibile">Imponibile</th>
                        <th id="col_iva">Iva</th>
                        <th id="col_totale" data-tipo="prezzo">Totale</th>
                        <!-- <th id="numero_fatture-letture">Letture</th> -->
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                        $fatture = $repo->cerca($_GET);
                        
                        foreach ($fatture as $fattura) {

                        echo "<tr data-numero='" . htmlspecialchars($fattura['NUMERO']) . "'>";

                        echo "<td data-valore='".htmlspecialchars($fattura['NUMERO'])."'>" . htmlspecialchars($fattura['NUMERO']) . "</td>";
                        echo "<td data-valore='".htmlspecialchars($fattura['DATA'])."'>" . htmlspecialchars($fattura['DATA']) . "</td>";
                        echo "<td>" . number_format($fattura['IMPONIBILE'], 2, ",", ".") . " €" . "</td>";
                        echo "<td>" . number_format($fattura['IVA'], 2, ",", ".") . " €" . "</td>";
                        echo "<td data-valore='".$fattura['TOTALE']."'>" . number_format($fattura['TOTALE'], 2, ",", ".") . " €" . "</td>";
                        //echo "<td>" . htmlspecialchars($fattura['NUMERO_LETTURE']) . "</td>";

                        echo "</tr>";
                    }?>
                    </tbody>
                    
                </table>

                </div>

                <?php if (count($fatture) == 0) { ?>
                <div class="messaggio-ricerca">
                <h3>LA TUA RICERCA NON HA PRODOTTO RISULTATI. <br>MODIFICA I PARAMETRI DI RICERCA INSERITI.</h3>
                </div>
                <?php } ?>

            </div>

            <!-- popup usato per la creazione/modifica di una fattura -->
            <div id="blocco_schermo"></div>

            <div id="azione_fattura" class="finestra-fattura">
                <div class="header-fattura">
                    <h3 id="compito-azione"></h3>

                    <button class="pulsante-chiusura" onclick="chiudiFormFattura()">
                        <i class="fa-solid fa-square-xmark pulsante-chiusura"></i>
                    </button>
                </div>

                <form action="fatture.php?action=inserisci" method="POST" class="contenuto-fattura" onsubmit="verificaNuovaFattura(event)">
                    <div class="sezione-info">
                        <div class="campo-info" id="primo_campo_info">
                            <label for="nuovo_num_fat" class="campo">Codice fattura: *</label>
                            <input type="text" id="nuovo_num_fat" name="nuovo_numero_fattura" class="text-area" placeholder="es: FT-2026-12345"
                                pattern="[A-Z]{2}-[0-9]{4}-[0-9]{5}" title="FT-anno-numero(di 5 cifre)" required>
                        </div>

                        <div class="campo-info">
                            <label for="nuova_data_fat" class="campo">Data: *</label>
                            <input type="text" id="nuova_data_fat" name="nuova_data_fattura" class="text-area widget-data" required
                                placeholder="gg/mm/aaaa" readonly>
                        </div>
                    </div>

                    <div class="sezione-prezzo">
                        <div class="campo-prezzo" id="primo_campo_prezzo">
                            <label for="nuovo_imp" class="campo">Imponibile: *</label>
                            <input type="text" id="nuovo_imp" name="nuovo_imponibile" class="text-area" required
                                pattern="[0-9]{1,3}(\.[0-9]{3})?(,[0-9]{1,2})? €" title="Formato italiano"
                                placeholder="Inserisci valore" onchange="calcolaTotale('nuovo_imp', 'nuova_iva', 'nuovo_cos_tot')">
                        </div>

                        <div class="campo-prezzo">
                            <label for="nuova_iva" class="campo">Iva: </label>
                            <input type="text" id="nuova_iva" name="nuova_iva" class="text-area"
                                pattern="[0-9]{1,3}(\.[0-9]{3})?(,[0-9]{1,2})? €" title="Formato italiano"
                                placeholder="Inserisci valore" onchange="calcolaTotale('nuovo_imp', 'nuova_iva', 'nuovo_cos_tot')">
                        </div>

                        <div class="campo-prezzo">
                            <label for="nuovo_cos_tot" class="campo">Totale: </label>
                            <input type="text" id="nuovo_cos_tot" name="nuovo_totale" class="text-area" placeholder="Inserisci valore"
                                pattern="[0-9]{1,3}(\.[0-9]{3})?(,[0-9]{1,2})? €" title="Formato italiano">
                        </div>
                    </div>

                    <input type="submit" id="popup_invio" value="" class="pulsante-fattura">
                </form>
            </div>

        </div>

<!--  -->
<?php
include 'footer.php';
?>