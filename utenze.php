<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/UtenzeRep.php';

$repo = new UtenzeRepository();
?>
<!-- Sezione contenente il codice della pagina -->

        <div class="pagina">

            <form novalidate action="" method="GET" class="ricerca" onsubmit="verificaUtenza(event)">
                <label for="cod_ut" class="campo">Codice dell'utenza: </label>
                <input type="text" id="cod_ut" name="codice" class="text-area" placeholder="es: 10001234"
                    pattern="[0-9]{8}" title="8 numeri di seguito">
                
                <label for="cod_cli" class="campo">Codice del cliente: </label>
                <input type="text" id="cod_cli" name="cod_fis" class="text-area" placeholder="es: AAA111"
                    pattern="[A-Z]{3}[0-9]{3}" title="3 lettere seguite da 3 numeri">
                
                <label for="ind" class="campo">Indirizzo: </label>
                <input type="text" id="ind" name="indirizzo" class="text-area">
                
                <label for="cit_ut" class="campo">Città: </label>
                <div class="autocomplete"><input type="text" id="cit_ut" name="citta" class="text-area"></div>
                
                <div class="attività">
                    <label class="campo">Stato: </label>
                    <input type="radio" id="attiva" name="stato" value="attiva">
                    <label for="attiva">Attiva</label>
                    <input type="radio" id="disattiva" name="stato" value="disattiva">
                    <label for="disattiva">Disattiva</label>
                </div>

                <div class="date-area">
                    <div class="campo-data">
                        <label for="data_ap" class="campo">Data apertura: </label>
                        <input type="date" id="data_ap" name="data_ap" class="data-area">
                    </div>
                    <div class="campo-data" id="campo-data-chiusura">
                        <label for="data_ch" class="campo">Data chiusura: </label>
                        <input type="date" id="data_ch" name="data_ch" class="date-area">
                    </div>
                </div>
                
                <div class="pulsanti-ricerca">
                    <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">
                    <input type="reset" id="svuota" value="SVUOTA" class="svuota-ricerca">
                </div>

            </form>

            <div class="mostra-risultati">
                
                <div class="campo-ricerca">
                    <h3>UTENZE</h3>
                </div>

                <div class="risultati">
                    <table>
                        <tr>
                            <th id="col_cod_utenza">Codice utenza</th>
                            <th id="col_cod_cliente">Codice cliente</th>
                            <th id="col_data_apertura">Data apertura</th>
                            <th id="col_indirizzo">Indirizzo</th>
                            <th id="col_città">Città</th>
                            <th id="col_stato">Stato</th>
                            <th id="col_data_chiusura">Data chiusura</th>
                        </tr>

                        <?php

                        $utenze = $repo->cerca($_GET);
                        
                        foreach ($utenze as $utenza) {

                        echo "<tr>";

                        echo "<td>" . htmlspecialchars($utenza['CODICE']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['CLIENTE']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['DATA_APERTURA']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['INDIRIZZO']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['CITTA']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['STATO']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['DATA_CHIUSURA']) . "</td>";
                        
                        echo "</tr>";
                        
                    }?>

                    </table>
                </div>
                
            </div>

        </div>

<!--  -->
<?php
include 'footer.php';
?>