/* CONTROLLO GENERALE */
function verificaFattura(event){
    verificaPrezzoTotale(event);
}

/* CONTROLLO PREZZI FATTURA */
function verificaPrezzoTotale(event) {
    // per i decimali, la virgola va trasformata in un punto
    let imponibile = Number(document.getElementById("imp").value.replace(",", "."));
    let iva = Number(document.getElementById("iva").value.replace(",", "."));
    let totale = Number(document.getElementById("cos_tot").value.replace(",", "."));
    // dati del form aggiornati a due cifre decimali
    document.getElementById("imp").value = Math.round(imponibile * 100) / 100;
    document.getElementById("iva").value = Math.round(iva * 100) / 100;
    document.getElementById("cos_tot").value = Math.round(totale * 100) / 100;
    // confronta somma e totale
    if ((imponibile + iva).toFixed(2) !== totale.toFixed(2)){
        event.preventDefault();  // evita invio del form
        creaMessaggioErrore("Il costo totale della fattura non corrisponde alla somma dei suoi campi.");
        apriPopup();
    }
}

/* FUNZIONI CREAZIONE FATTURA */
function inserisciFormNelPopup() {
    document.getElementById("messaggio_popup").innerHTML = `
        <form action="" method="GET" class="ricerca-popup" onsubmit="verificaPrezzoTotale(event)">
            
            <label for="num_fat" class="campo">Numero della fattura: </label>
            <input type="text" id="num_fat" name="numero_fattura" class="text-area">

            <label for="data_fat" class="campo">Data: </label>
            <input type="date" id="data_fat" name="data_fattura" class="text-area">

            <div class="prezzo-fattura">

                <div class="campo-prezzo">
                    <label for="imp" class="campo">Imponibile: </label>
                    <input type="text" id="imp" name="imponibile" class="text-area">
                </div>

                <div class="campo-prezzo">
                    <label for="iva" class="campo">Iva: </label>
                    <input type="text" id="iva" name="iva" class="text-area">
                </div>

                <div class="campo-prezzo">
                    <label for="cos_tot" class="campo">Totale: </label>
                    <input type="text" id="cos_tot" name="totale" class="text-area">
                </div>

            </div>

            <input type="submit" value="AGGIUNGI" class="avvio-ricerca-popup">

        </form>
    `;
}

function creaFattura() {
    inserisciFormNelPopup();
    apriPopup();
}