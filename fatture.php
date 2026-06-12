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
                <input type="text" id="num_fat" name="numero_fattura" class="text-area">
                
                <label for="data_fat" class="campo">Data: </label>
                <input type="date" id="data_fat" name="data_fattura" class="text-area">
                
                <div class="prezzo-fattura">
                    <div class="campo-prezzo">
                        <label for="imp" class="campo">Imponibile: </label>
                        <input type="text" id="imp" name="imponibile" class="text-area">
                    </div>

                    <div class="campo-prezzo">
                        <label for="iva" class="campo">Iva: </label>
                        <input type="text" id="iva" name="iva" class="text-area">
                    </div>

                    <div class="campo-prezzo">
                        <label for="cos_tot" class="campo">Totale: </label>
                        <input type="text" id="cos_tot" name="totale" class="text-area">
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
                        <i class="fa-solid fa-square-plus"></i>
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

        </div>

<!-- Qui va inserito codice pagina -->
<?php
include 'footer.php';
?>