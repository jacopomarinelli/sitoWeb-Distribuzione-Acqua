/* CONTROLLO GENERALE */
function verificaFattura(event){
    modificaDatiPrezzo("imp", "iva", "cos_tot");
    if (!verificaPercentualeIva(event, "imp", "iva")) {return}
    if (!verificaPrezzoTotale(event, "imp", "iva", "cos_tot")) {return}
    salvaFattura();
}

function verificaNuovaFattura(event){
    modificaDatiPrezzo("nuovo_imp", "nuova_iva", "nuovo_cos_tot");
    if (!verificaPercentualeIva(event, "nuovo_imp", "nuova_iva")) {return}
    if (!verificaPrezzoTotale(event, "nuovo_imp", "nuova_iva", "nuovo_cos_tot")) {return}
}

/* CONTROLLO PREZZI FATTURA */
function modificaDatiPrezzo(id1, id2, id3){
    // per i decimali, la virgola va trasformata in un punto
    let imponibile = Number(document.getElementById(id1).value.replace(",", "."));
    let iva = Number(document.getElementById(id2).value.replace(",", "."));
    let totale = Number(document.getElementById(id3).value.replace(",", "."));
    // dati del form aggiornati
    document.getElementById(id1).value = Math.round(imponibile * 100) / 100;
    document.getElementById(id2).value = Math.round(iva * 100) / 100;
    document.getElementById(id3).value = Math.round(totale * 100) / 100;
}

function calcolaNuovoTotale() {
    if (document.getElementById("nuovo_imp").value !== "" && document.getElementById("nuova_iva").value !== ""){
        let imponibile = Number(document.getElementById("nuovo_imp").value);
        let iva = Number(document.getElementById("nuova_iva").value);
        let totale = imponibile + iva;
        document.getElementById("nuovo_cos_tot").value = totale;
    }
}

function verificaPercentualeIva(event, id1, id2){
    if (document.getElementById(id2).value !== ""){ // se campo iva non è vuoto fa controllo
        let imponibile = Number(document.getElementById(id1).value);
        let iva = Number(document.getElementById(id2).value);
        let percentuale = iva / imponibile;
        if (percentuale < 0.10 || percentuale > 0.20) {
            event.preventDefault();
            creaMessaggioErrore("L'iva dovrebbe essere compresa tra il 10% e 20%.");
            apriPopup();
            return false;
        }
    }
    return true;
}

function verificaPrezzoTotale(event, id1, id2, id3) {
    if (document.getElementById(id1).value !== "" && document.getElementById(id2).value !== ""){ // se campi imp e iva non sono vuoti fa controllo
        let imponibile = Number(document.getElementById(id1).value);
        let iva = Number(document.getElementById(id2).value);
        let totale = Number(document.getElementById(id3).value);
        // confronta somma e totale
        if ((imponibile + iva).toFixed(2) !== totale.toFixed(2)){
            event.preventDefault();
            creaMessaggioErrore("Il costo totale della fattura non corrisponde alla somma dei suoi campi.");
            apriPopup();
            return false;
        }
    }
    return true;
}

/* SALVA DATI DELLA RICERCA */
function salvaFattura() {
    const fattura = {
        num_fattura: document.getElementById("num_fat").value,
        data_fattura: document.getElementById("data_fat").value,
        imponibile: document.getElementById("imp").value,
        iva: document.getElementById("iva").value,
        totale: document.getElementById("cos_tot").value
    };
    sessionStorage.setItem(
        "ricercaFattura",
        JSON.stringify(fattura)
    );
}
document.addEventListener("DOMContentLoaded", function() {
    const dati = JSON.parse(
        sessionStorage.getItem("ricercaFattura")
    );

    if (!dati) return;
    document.getElementById("num_fat").value = dati.num_fattura;
    document.getElementById("data_fat").value = dati.data_fattura;
    document.getElementById("imp").value = dati.imponibile;
    document.getElementById("iva").value = dati.iva;
    document.getElementById("cos_tot").value = dati.totale;
});

/* FUNZIONI FORM AZIONE FATTURA */
function apriFormFattura(){
    document.querySelector(".contenuto-fattura").action ="fatture.php?action=inserisci";
    document.getElementById("blocco_schermo").style.display = "block"; // blocca interazioni con pagina sottostante
    document.getElementById("azione_fattura").style.display = "flex"; // mostra finestra
}
function chiudiFormFattura(){
    document.getElementById("blocco_schermo").style.display = ""; // annulla blocco schermo
    document.getElementById("azione_fattura").style.display = "none"; // nasconde finestra
}

function cambiaTitolo(stato) {
    if(stato === "inserisci") {
        document.getElementById("compito-azione").textContent = "INSERISCI I DATI";
        document.getElementById("popup_invio").value = "AGGIUNGI";
    } else if(stato === "modifica") {
        document.getElementById("compito-azione").textContent = "MODIFICA I DATI";
        document.getElementById("popup_invio").value = "SALVA E CHIUDI";
    }
}