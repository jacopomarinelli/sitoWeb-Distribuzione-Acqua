/* CONTROLLO GENERALE */
function verificaFattura(event){
    verificaPrezzoTotale(event);
}

function verificaNuovaFattura(event){
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

/* FUNZIONI FORM AZIONE FATTURA */
function apriFormFattura(){
    document.getElementById("azione_fattura").display = "flex";
}
function chiudiFormFattura(){
    document.getElementById("azione_fattura").display = "none";
}