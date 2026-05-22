<?php
include 'header.php';
?>
<!-- Qui va inserito codice pagina -->
        
        <div class="cliente">

            <form action="" method="GET" class="ricerca">
                <p class="campo">Inserisci i dati per la ricerca</p>

                <label for="cod" class="campo">Codice del cliente: </label>
                <input type="text" id="cod" name="codice" class="text-area">
                
                <label for="cod_fis" class="campo">Codice fiscale del cliente: </label>
                <input type="text" id="cod_fis" name="cod_fis" class="text-area">
                
                <label for="rag_soc" class="campo">Nome dell'azienda: </label>
                <input type="text" id="rag_soc" name="rag_soc" class="text-area"> 
                
                <label for="ind" class="campo">Indirizzo: </label>
                <input type="text" id="ind" name="indirizzo" class="text-area">
                
                <label for="cit" class="campo">Città: </label>
                <input type="text" id="cit" name="città" class="text-area">
                
                <input type="submit" id="avvio" value="CERCA" class="avvio-ricerca">

            </form>

            <div class="mostra-risultati">
                
                <div class="campo-ricerca">
                    <h3>CLIENTI</h3>
                </div>

                <div class="risultati">
                    <!-- <php if risultati>0 ?>
                    <p>Ecco i risultati della tua ricerca</p>
                    <php else if risultati==0 ?>
                    <p>La tua ricerca non ha prodotto risultati</p>
                    <php else ?> -->
                    <p>Nessuna ricerca effettuata</p>
                </div>

                <button type="button" class="nuova-ricerca">NUOVA RICERCA</button>

            </div>

        </div>

<!-- Qui va inserito codice pagina -->
<?php
include 'footer.php';
?>