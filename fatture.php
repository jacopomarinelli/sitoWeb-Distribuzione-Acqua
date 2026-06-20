<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/FattureRep.php';

$repo = new FattureRepository();
?>
<!-- Qui va inserito codice pagina -->
        
        <div class="pagina">

            <form action="" method="GET" class="ricerca" onsubmit="verificaFattura(event)">
                <label for="num_fat" class="campo">Numero della fattura: </label>
                <input type="text" id="num_fat" name="numero_fattura" class="text-area" placeholder="es: FT-2010-12345"
                    pattern="[A-Z]{2}-[0-9]{4}-[0-9]{5}" title="FT(in maiuscolo)-anno-numero di 5 cifre">
                
                <label for="data_fat" class="campo">Data: </label>
                <input type="text" id="data_fat" name="data_fattura" class="text-area" placeholder="es: 01/01/2001"
                    pattern="([1-9]|0[1-9]|[12][0-9]|3[01])/([1-9]|0[1-9]|1[0-2])/[0-9]{4}" title="Formato gg/mm/aaaa">
                
                <div class="sezione-prezzo">
                    <div class="campo-prezzo">
                        <label for="imp" class="campo">Imponibile: </label>
                        <input type="text" id="imp" name="imponibile" class="text-area" placeholder="Inserisci valore">
                    </div>

                    <div class="campo-prezzo">
                        <label for="iva" class="campo">Iva: </label>
                        <input type="text" id="iva" name="iva" class="text-area" placeholder="Inserisci valore">
                    </div>

                    <div class="campo-prezzo">
                        <label for="cos_tot" class="campo">Totale: </label>
                        <input type="text" id="cos_tot" name="totale" class="text-area" placeholder="Inserisci valore">
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
                    
                    <div class="pulsante-nuova">
                        <i class="fa-solid fa-square-plus" onclick="apriFormFattura()"></i>
                    </div>

                </div>

                <div class="risultati">
                    
                <table>
                    <tr>
                        <th id="col_num_fattura">Numero fattura</th>
                        <th id="col_data_fattura">Data</th>
                        <th id="col_imponibile">Imponibile</th>
                        <th id="col_iva">Iva</th>
                        <th id="col_totale">Totale</th>
                    </tr>

                    <?php

                        $fatture = $repo->cerca($_GET);
                        
                        foreach ($fatture as $fattura) {

                        echo "<tr>";

                        echo "<td>" . htmlspecialchars($fattura['NUMERO']) . "</td>";
                        echo "<td>" . htmlspecialchars($fattura['DATA']) . "</td>";
                        echo "<td>" . htmlspecialchars($fattura['IMPONIBILE']) . "</td>";
                        echo "<td>" . htmlspecialchars($fattura['IVA']) . "</td>";
                        echo "<td>" . htmlspecialchars($fattura['TOTALE']) . "</td>";

                        echo "</tr>";
                        
                    }?>
                    
                </table>

                </div>

            </div>

            <!-- popup usato per la creazione/modifica di una fattura -->
            <div id="blocco_schermo"></div>

            <div id="azione_fattura" class="finestra-fattura">
                <div class="header-fattura">
                    <h3 id="compito-azione">INSERISCI I DATI</h3>

                    <button class="pulsante-chiusura" onclick="chiudiFormFattura()">
                        <i class="fa-solid fa-square-xmark pulsante-chiusura"></i>
                    </button>
                </div>    

                <form action="" method="GET" class="contenuto-fattura" onsubmit="verificaNuovaFattura(event)">
                    <div class="sezione-info">
                        <div class="campo-info" id="primo_campo_info">
                            <label for="nuovo_num_fat" class="campo">Numero della fattura: *</label>
                            <input type="text" id="nuovo_num_fat" name="nuovo_numero_fattura" class="text-area" placeholder="es: FT-2010-12345"
                                pattern="[A-Z]{2}-[0-9]{4}-[0-9]{5}" title="FT-anno-numero" required>
                        </div>

                        <div class="campo-info">
                            <label for="nuova_data_fat" class="campo">Data: *</label>
                            <input type="date" id="nuova_data_fat" name="nuova_data_fattura" class="text-area" required placeholder="es: 01/01/2001"
                                pattern="([1-9]|0[1-9]|[12][0-9]|3[01])/([1-9]|0[1-9]|1[0-2])/[0-9]{4}" title="Formato gg/mm/aaaa">
                        </div>
                    </div>

                    <div class="sezione-prezzo">
                        <div class="campo-prezzo" id="primo_campo_prezzo">
                            <label for="nuovo_imp" class="campo">Imponibile: *</label>
                            <input type="text" id="nuovo_imp" name="nuovo_imponibile" class="text-area" required
                                onchange="calcolaTotale()">
                        </div>

                        <div class="campo-prezzo">
                            <label for="nuova_iva" class="campo">Iva: *</label>
                            <input type="text" id="nuova_iva" name="nuova_iva" class="text-area" required
                                onchange="calcolaTotale()">
                        </div>

                        <div class="campo-prezzo">
                            <label for="nuovo_cos_tot" class="campo">Totale: </label>
                            <input type="text" id="nuovo_cos_tot" name="nuovo_totale" class="text-area">
                        </div>
                    </div>

                    <input type="submit" id="avvio" value="AGGIUNGI" class="pulsante-fattura">
                </form>
            </div>

        </div>

<!-- Qui va inserito codice pagina -->
<?php
include 'footer.php';
?>