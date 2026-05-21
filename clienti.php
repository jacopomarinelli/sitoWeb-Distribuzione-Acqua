<?php
include 'header.php';
?>
<!-- Qui va inserito codice pagina -->
        
        <div class="cliente">

            <form action="" method="GET" class="ricerca">

            <div class="campo">
                <label><h3>Codice: </h3></label>
                <input type="text" name="codice" class="textarea">
            </div>
            <div class="campo">
                <label><h3>Codice fiscale: </h3></label>
                <input type="text" name="cod_fis" class="textarea">
            </div>
            <div class="campo">
                <label><h3>Ragione sociale: </h3></label>
                <input type="text" name="rag_soc" class="textarea">
            </div>
            <div class="campo">
                <label><h3>Indirizzo: </h3></label>
                <input type="text" name="indirizzo" class="textarea">
            </div>
            <div class="campo">
                <label><h3>Città: </h3></label>
                <input type="text" name="città" class="textarea">
            </div>
            <div class="avvio-ricerca">
                <button type="submit">CERCA</button>
            </div>

            </form>

            <div class="risultati">
                <p>Qui verranno mostrati i risultati</p>
            </div>

        </div>

<!-- Qui va inserito codice pagina -->
<?php
include 'footer.php';
?>