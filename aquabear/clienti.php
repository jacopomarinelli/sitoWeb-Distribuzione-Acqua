<?php
include 'header.php';
include '../backend/clientiRep.php';
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
                <input type="text" id="rag_soc" name="ragione_sociale" class="text-area"> 
                
                <label for="ind" class="campo">Indirizzo: </label>
                <input type="text" id="ind" name="indirizzo" class="text-area">
                
                <label for="cit" class="campo">Città: </label>
                <input type="text" id="cit" name="citta" class="text-area">
                
                <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">

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
                    
                    <?php foreach ($clienti as $c) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($c['CODICE']); ?></td>
                        <td><?php echo htmlspecialchars($c['CODICE_FISCALE']); ?></td>
                        <td><?php echo htmlspecialchars($c['RAGIONE_SOCIALE']); ?></td>
                        <td><?php echo htmlspecialchars($c['INDIRIZZO']); ?></td>
                        <td><?php echo htmlspecialchars($c['CITTA']); ?></td>
                    </tr><?php } ?>
                    
                </table>

                </div>

            </div>

        </div>

<!-- Qui va inserito codice pagina -->
<?php
include 'footer.php';
?>