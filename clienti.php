<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/ClientiRep.php';

$repo = new ClientiRepository();
?>
<script src="js/clienti.js" defer></script>
<!-- Qui va inserito codice pagina -->
        
        <div class="pagina">

            <form action="clienti.php" method="GET" class="ricerca" onsubmit="verificaCliente(event)">
                <label for="cod" class="campo">Codice del cliente: </label>
                <input type="text" id="cod" name="codice" class="text-area" placeholder="es: AAA111"
                    pattern="[A-Z]{3}[0-9]{3}" title="Codice di 3 lettere seguite da 3 numeri" >
                
                <label for="cod_fis" class="campo">Codice fiscale del cliente: </label>
                <input type="text" id="cod_fis" name="codice_fiscale" class="text-area" placeholder="es: AAAAAA11A11A111A" 
                    pattern="[A-Z]{6}[0-9]{2}[A-Z]{1}[0-9]{2}[A-Z]{1}[0-9]{3}[A-Z]{1}" title="Codice fiscale: AAAAAANNANNANNNA (A lettera, N numero)">
                
                <label for="rag_soc" class="campo">Nome dell'azienda: </label>
                <div class="autocomplete"><input type="text" id="rag_soc" name="ragione_sociale" class="text-area"
                    placeholder="Inserisci nome dell'azienda"></div>
                
                <label for="ind_cli" class="campo">Indirizzo: </label>
                <input type="text" id="ind_cli" name="indirizzo" class="text-area" placeholder="Inserisci indirizzo del cliente">
                
                <label for="cit_cli" class="campo">Città: </label>
                <div class="autocomplete"><input type="text" id="cit_cli" name="citta" class="text-area"
                    placeholder="Inserisci nome della città"></div>
                
                <div class="pulsanti-ricerca">
                    <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">
                    <input type="reset" id="svuota" value="SVUOTA" class="svuota-ricerca">
                </div> 

            </form>

            <div class="mostra-risultati">
                
                <div class="header-risultati">
                    <div class="campo-ricerca">
                        <h3>CLIENTI</h3>
                    </div>

                    <div class="ordinamento">
                        <p>Ordina per</p>

                        <select name="colonna" id="colonna-ordinata-clienti" class="selezione-ordine">
                            <option value="col_cod_cli">CODICE CLIENTE</option>
                            <option value="col_cod_fis">CODICE FISCALE</option>
                            <option value="numero_cliente-utenze">NUMERO UTENZE</option>
                        </select>

                        <select name="ordine" id="senso-colonna-clienti" class="selezione-ordine">
                            <option value="crescente">CRESCENTE</option>
                            <option value="decrescente">DECRESCENTE</option>
                        </select>
                    </div>
                </div>

                <div class="risultati">
                    
                <table>
                    <thead>
                    <tr>
                        <th id="col_cod_cli" data-tipo="codice-cliente">Codice cliente</th>
                        <th id="col_cod_fis" data-tipo="codice-fiscale">Codice fiscale</th>
                        <th id="cod_rag_soc">Ragione sociale</th>
                        <th id="col_indirizzo_cliente">Indirizzo</th>
                        <th id="col_città_cliente">Città</th>
                        <th id="numero_cliente-utenze" data-tipo="valore">Utenze</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                    <?php

                        $clienti = $repo->cerca($_GET);
                        
                        foreach ($clienti as $cliente) {

                        echo "<tr>";

                        echo "<td data-valore='".htmlspecialchars($cliente['CODICE'])."'>" . htmlspecialchars($cliente['CODICE']) . "</td>";
                        echo "<td data-valore='".htmlspecialchars($cliente['CODICE_FISCALE'])."'>" . htmlspecialchars($cliente['CODICE_FISCALE']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['RAGIONE_SOCIALE']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['INDIRIZZO']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['CITTA']) . "</td>";
                        echo "<td data-valore='".htmlspecialchars($cliente['NUMERO_UTENZE'])."'>" . htmlspecialchars($cliente['NUMERO_UTENZE']) . "</td>";

                        echo "</tr>";
                        
                    }?>
                    </tbody>
                    
                </table>

                </div>

                <?php if (count($clienti) == 0) { ?>
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