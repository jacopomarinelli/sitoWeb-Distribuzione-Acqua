<?php
include 'header.php';
?>
<!-- Qui va inserito codice pagina -->
        
        <div class="cliente">

            <form action="" method="GET" class="ricerca">
                <p class="campo">Inserisci i dati per la ricerca</p>

                <label for="cod" class="campo">Codice: </label>
                <input type="text" id="cod" name="codice" class="campo">
                
                <label for="cod_fis" class="campo">Codice fiscale: </label>
                <input type="text" id="cod_fis" name="cod_fis" class="campo">
                
                <label for="rag_soc" class="campo">Ragione sociale: </label>
                <input type="text" id="rag_soc" name="rag_soc" class="campo"> 
                
                <label for="ind" class="campo">Indirizzo: </label>
                <input type="text" id="ind" name="indirizzo" class="campo">
                
                <label for="cit" class="campo">Città: </label>
                <input type="text" id="cit" name="città" class="campo">
                
                <input type="submit" value="CERCA" class="avvio-ricerca">

            </form>

            <div class="risultati">
                <!-- <php if risultati>0 ?>
                <p>Ecco i risultati della tua ricerca</p>
                <php else if risultati==0 ?>
                <p>La tua ricerca non ha prodotto risultati</p>
                <php else ?> -->
                <p>Nessuna ricerca effettuata</p>
            </div>

        </div>

<!-- Qui va inserito codice pagina -->
<?php
include 'footer.php';
?>