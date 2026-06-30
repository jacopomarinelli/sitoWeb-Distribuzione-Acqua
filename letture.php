<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/LettureRep.php';

$repo = new LettureRepository();
?>
<!-- Qui va inserito codice pagina -->

        <div class="pagina">

            <form action="letture.php" method="GET" class="ricerca" onsubmit="verificaLettura(event)">
                <label for="num_let" class="campo">Numero lettura: </label>
                <input type="text" id="num_let" name="num_lettura" class="text-area" placeholder="es: 12345678"
                    pattern="[0-9]{8}" title="Codice di 8 numeri">
                
                <label for="cod_ute" class="campo">Codice utenza: </label>
                <input type="text" id="cod_ute" name="codice_utenza" class="text-area" placeholder="es: 10001234"
                    pattern="[0-9]{8}" title="Codice di 8 numeri">
                
                <label for="fattura" class="campo">Codice fattura: </label>
                <input type="text" id="fattura" name="fattura" class="text-area" placeholder="es: FT-2026-12345"
                    pattern="[A-Z]{2}-[0-9]{4}-[0-9]{5}" title="FT(in maiuscolo)-anno-numero di 5 cifre">
                
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
                        <th id="col_valore">Valore lettura (m<sup>3</sup>)</th>
                    </tr>

                    <?php

                        $letture = $repo->cerca($_GET);
                        
                        foreach ($letture as $lettura) {

                        echo "<tr>";

                        echo "<td>" . htmlspecialchars($lettura['NUMERO']) . "</td>";
                        echo "<td>" . htmlspecialchars($lettura['UTENZA']) . "</td>";
                        echo "<td>" . htmlspecialchars($lettura['FATTURA']) . "</td>";
                        echo "<td>" . htmlspecialchars($lettura['DATA']) . "</td>";
                        echo "<td>" . htmlspecialchars($lettura['VALORE']) . "</td>";
                        
                        echo "</tr>";
                        
                    }?>
                    
                </table>

                </div>

            </div>

        </div>


        <script src="js/letture.js" defer></script>

<!--  -->
<?php
include 'footer.php';
?>