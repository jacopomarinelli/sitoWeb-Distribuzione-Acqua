<?php
include 'header.php';
include 'database.php';
?>
<!-- Qui va inserito codice pagina -->
        
        <div class="cliente">

            <form action="clienti.php" method="GET" class="ricerca">
                <p class="campo">Inserisci i dati per la ricerca</p>

                <label for="cod" class="campo">Codice del cliente: </label>
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
                        <th>Codice cliente</th>
                        <th>Codice fiscale</th>
                        <th>Ragione sociale</th>
                        <th>Indirizzo</th>
                        <th>Città</th>
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