<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/LettureRep.php';

$repo = new LettureRepository();
?>
<!-- Qui va inserito codice pagina -->

        <div class="pagina">

            <form autocomplete="off" action="" method="GET" class="ricerca">
                <label for="num_let" class="campo">Numero lettura: </label>
                <input type="text" id="num_let" name="numero" class="text-area">
                
                <label for="cod_ute" class="campo">Codice utenza: </label>
                <input type="text" id="cod_ute" name="utenza" class="text-area">
                
                <label for="fattura" class="campo">Codice fattura (opzionale): </label>
                <input type="text" id="fattura" name="fattura" class="text-area">
                
                <div class="dati-lettura">
                    <div class="data-lettura">
                        <label for="data" class="campo">Data: </label>
                        <input type="date" id="data" name="data" class="text-area">
                    </div>

                    <div class="valore-lettura" id="valore-lettura">
                        <label for="valore" class="campo">Valore letto: </label>
                        <input type="number" id="valore" name="valore" class="text-area">
                    </div>
                </div>
                
                <div class="pulsanti-ricerca">
                    <input type="reset" id="svuota" value="SVUOTA" class="svuota-ricerca">
                    <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">
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
                        <th id="col_valore">Valore</th>
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

<!-- Qui va inserito codice pagina -->
<?php
include 'footer.php';
?>