<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/LettureRep.php';

$repo = new LettureRepository();
?>
<script src="js/letture.js" defer></script>
<!-- Qui va inserito codice pagina -->

        <div class="pagina">

            <form action="letture.php" method="GET" class="ricerca" onsubmit="verificaLettura(event)">
                <label for="num_let" class="campo">Numero lettura: </label>
                <input type="text" id="num_let" name="numero" class="text-area" placeholder="Inserisci il numero della lettura"
                    pattern="[0-9]{8}" title="Codice di 8 numeri">
                
                <label for="cod_ute" class="campo">Codice utenza: </label>
                <input type="text" id="cod_ute" name="utenza" class="text-area" placeholder="Inserisci il codice dell'utenza"
                    pattern="[0-9]{8}" title="Codice di 8 numeri">
                
                <label for="fattura" class="campo">Codice fattura: </label>
                <input type="text" id="fattura" name="fattura" class="text-area" placeholder="es: FT-2026-12345"
                    pattern="[A-Z]{2}-[0-9]{4}-[0-9]{5}" title="FT-anno-numero(di 5 cifre)">
                
                <div class="dati-lettura">
                    <div class="data-lettura">
                        <label for="data" class="campo">Data: </label>
                        <input type="text" id="data" name="data" class="text-area widget-data" placeholder="gg/mm/aaaa"
                            readonly>
                    </div>

                    <div class="valore-lettura" id="valore-lettura">
                        <label for="valore" class="campo">Valore letto: </label>
                        <input type="number" id="valore" name="valore" class="text-area" min="0" placeholder="Inserisci valore">
                    </div>
                </div>
                
                <div class="pulsanti-ricerca">
                    <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">
                    <input type="reset" id="svuota" value="SVUOTA" class="svuota-ricerca">
                </div>

            </form>

            <div class="mostra-risultati">
                
                <div class="campo-ricerca">
                    <h3>LETTURE</h3>
                </div>

                <div class="risultati">
                    
                <table>
                    <tr>
                        <th id="col_num_let">Numero lettura</th>
                        <th id="col_cod_ute">Codice utenza</th>
                        <th id="cod_cod_fatt">Codice fattura</th>
                        <th id="col_data">Data</th>
                        <th id="col_valore">Valore lettura</th>
                    </tr>

                    <?php

                        $letture = $repo->cerca($_GET);
                        
                        foreach ($letture as $lettura) {

                        echo "<tr>";

                        echo "<td>" . htmlspecialchars($lettura['NUMERO']) . "</td>";
                        echo "<td>" . htmlspecialchars($lettura['UTENZA']) . "</td>";
                        if ($lettura['FATTURA'] !== "") {
                            echo "<td>" . htmlspecialchars($lettura['FATTURA']) . "</td>";
                        } else {
                            echo "<td>" . "--" . "</td>";
                        }
                        echo "<td>" . htmlspecialchars($lettura['DATA']) . "</td>";
                        echo "<td>" . htmlspecialchars($lettura['VALORE']) . " m<sup>3</sup>" . "</td>";
                        
                        echo "</tr>";
                        
                    }?>
                    
                </table>

                </div>

                <?php if (count($letture) == 0) { ?>
                <div class="messaggio-ricerca">
                <h3>LA TUA RICERCA NON HA PRODOTTO RISULTATI. <br>MODIFICA I PARAMETRI DI RICERCA INSERITI.</h3>
                </div>
                <?php } ?>

            </div>

        </div>

<!--  -->
<?php
include 'footer.php';
?>