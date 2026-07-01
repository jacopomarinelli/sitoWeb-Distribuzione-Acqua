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
                <input type="text" id="cod_fis" name="codice_fiscale" class="text-area" placeholder="es: ABCDEF12G34H567I" 
                    pattern="[A-Z]{6}[0-9]{2}[A-Z]{1}[0-9]{2}[A-Z]{1}[0-9]{3}[A-Z]{1}" title="Codice fiscale">
                
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
                
                <div class="campo-ricerca">
                    <h3>CLIENTI</h3>
                </div>

                <div class="risultati">
                    
                <table>
                    <tr>
                        <th id="col_cod_cli">Codice cliente</th>
                        <th id="col_cod_fis">Codice fiscale</th>
                        <th id="cod_rag_soc">Ragione sociale</th>
                        <th id="col_indirizzo_cliente">Indirizzo</th>
                        <th id="col_città_cliente">Città</th>
                        <th id="numero_cliente-utenze">Utenze</th>
                    </tr>
                    
                    <?php

                        $clienti = $repo->cerca($_GET);
                        
                        foreach ($clienti as $cliente) {

                        echo "<tr>";

                        echo "<td>" . htmlspecialchars($cliente['CODICE']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['CODICE_FISCALE']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['RAGIONE_SOCIALE']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['INDIRIZZO']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['CITTA']) . "</td>";

                        // stampa il numero di utenze
                        echo "<td>" . htmlspecialchars($cliente['NUMERO_UTENZE']) . "</td>";

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