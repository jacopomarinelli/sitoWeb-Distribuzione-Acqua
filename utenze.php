<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/UtenzeRep.php';

$repo = new UtenzeRepository();
?>
<script src="js/utenze.js" defer></script>
<!-- Sezione contenente il codice della pagina -->

        <div class="pagina">

            <form action="utenze.php" method="GET" class="ricerca" onsubmit="verificaUtenza(event)">
                <label for="cod_ut" class="campo">Codice dell'utenza: </label>
                <input type="text" id="cod_ut" name="codice" class="text-area" placeholder="Inserisci il codice dell'utenza"
                    pattern="[0-9]{8}" title="Codice di 8 numeri">
                
                <label for="cod_cli" class="campo">Codice del cliente: </label>
                <input type="text" id="cod_cli" name="cliente" class="text-area" placeholder="es: AAA111"
                    pattern="[A-Z]{3}[0-9]{3}" title="Codice di 3 lettere seguite da 3 numeri">
                
                <label for="ind" class="campo">Indirizzo: </label>
                <input type="text" id="ind" name="indirizzo" class="text-area" placeholder="Inserisci indirizzo del cliente">
                
                <label for="cit_ut" class="campo">Città: </label>
                <div class="autocomplete"><input type="text" id="cit_ut" name="citta" class="text-area"
                    placeholder="Inserisci nome della città"></div>
                
                <div class="attività">
                    <label class="campo">Stato: </label>
                    <input type="radio" id="attiva" name="stato" value="attiva" onchange="verificaStato()">
                    <label for="attiva">Attiva</label>
                    <input type="radio" id="disattiva" name="stato" value="disattiva" onchange="verificaStato()">
                    <label for="disattiva">Inattiva</label>
                </div>

                <div class="date-area">
                    <div class="campo-data">
                        <label for="data_ap" class="campo">Data apertura: </label>
                        <input type="text" id="data_ap" name="data_ap" class="date-area widget-data" placeholder="gg/mm/aaaa"
                            readonly>
                    </div>
                    <div class="campo-data" id="campo-data-chiusura">
                        <label for="data_ch" class="campo">Data chiusura: </label>
                        <input type="text" id="data_ch" name="data_ch" class="date-area widget-data" placeholder="gg/mm/aaaa"
                            readonly>
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
                        <h3>UTENZE</h3>
                    </div>

                    <div class="ordinamento">
                        <p>Ordina per</p>

                        <select name="colonna" id="colonna-ordinata-utenze" class="selezione-ordine">
                            <option value="col_cod_utenza">Codice utenza</option>
                            <option value="col_cod_cliente">Codice cliente</option>
                            <option value="col_data_apertura">Data apertura</option>
                            <option value="col_data_chiusura">Data chiusura</option>
                            <option value="numero_utenza-lettura">Numero letture</option>
                        </select>

                        <select name="ordine" id="senso-colonna-utenze" class="selezione-ordine">
                            <option value="crescente">Crescente</option>
                            <option value="decrescente">Decrescente</option>
                        </select>
                    </div>
                </div>

                <div class="risultati">
                    <table>
                        <thead>
                        <tr>
                            <th id="col_cod_utenza" data-tipo="codice-numerico">Codice utenza</th>
                            <th id="col_cod_cliente" data-tipo="codice-cliente">Codice cliente</th>
                            <th id="col_indirizzo">Indirizzo</th>
                            <th id="col_città">Città</th>
                            <th id="col_stato">Stato</th>
                            <th id="col_data_apertura" data-tipo="data">Data apertura</th>
                            <th id="col_data_chiusura" data-tipo="data">Data chiusura</th>
                            <th id="numero_utenza-lettura" data-tipo="valore">Letture</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php

                        $utenze = $repo->cerca($_GET);
                        
                        foreach ($utenze as $utenza) {

                        echo "<tr>";

                        echo "<td data-valore='".htmlspecialchars($utenza['CODICE'])."'>" . htmlspecialchars($utenza['CODICE']) . "</td>";
                        echo "<td data-valore='".htmlspecialchars($utenza['CLIENTE'])."'>" . htmlspecialchars($utenza['CLIENTE']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['INDIRIZZO']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['CITTA']) . "</td>";
                        echo "<td>" . htmlspecialchars($utenza['STATO']) . "</td>";
                        echo "<td data-valore='".htmlspecialchars($utenza['DATA_CHIUSURA'])."'>" . htmlspecialchars($utenza['DATA_APERTURA']) . "</td>";
                        if ($utenza['DATA_CHIUSURA'] !== "") {
                            echo "<td data-valore='".htmlspecialchars($utenza['DATA_CHIUSURA'])."'>" . htmlspecialchars($utenza['DATA_CHIUSURA']) . "</td>";
                        } else {
                            echo "<td data-valore='".""."'>" . "--" . "</td>";
                        }
                        echo "<td data-valore='".htmlspecialchars($utenza['NUMERO_LETTURE'])."'>" . htmlspecialchars($utenza['NUMERO_LETTURE']) . "</td>";
                        
                        echo "</tr>";
                        
                    }?>
                    </body>

                    </table>
                </div>

                <?php if (count($utenze) == 0) { ?>
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