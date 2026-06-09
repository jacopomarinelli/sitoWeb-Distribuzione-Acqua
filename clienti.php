<?php
include 'header.php';
require_once 'backend/Database.php';
require_once 'backend/ClientiRep.php';

$repo = new ClientiRepository();
?>
<!-- Qui va inserito codice pagina -->
        
        <div class="cliente">

            <form action="clienti.php" method="GET" class="ricerca">
                <label for="cod" class="campo">Codice del cliente: </label>
                <!-- in tutti input sotto da aggiungere value="es: esempio" e onclick="{document.getElementById('id').value = ''}"
                 che al click puliscono la scritta interna ma la rimettiono appena tolto il click -->
                <input type="text" id="cod" name="codice" class="text-area">
                
                <label for="cod_fis" class="campo">Codice fiscale del cliente: </label>
                <input type="text" id="cod_fis" name="codice_fiscale" class="text-area">
                
                <label for="rag_soc" class="campo">Nome dell'azienda: </label>
                <div class="autocomplete"><input type="text" id="rag_soc" name="ragione_sociale" class="text-area"></div>
                
                <label for="ind_cli" class="campo">Indirizzo: </label>
                <input type="text" id="ind_cli" name="indirizzo" class="text-area">
                
                <label for="cit_cli" class="campo">Città: </label>
                <div class="autocomplete"><input type="text" id="cit_cli" name="citta" class="text-area"></div>
                
                <div class="pulsanti-ricerca">
                    <input type="reset" id="svuota" value="SVUOTA" class="svuota-ricerca">
                    <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">
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