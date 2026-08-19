/* CONTROLLO GENERALE */
function verificaFattura(event){
    if (!verificaPercentualeIva(event, "imp", "iva")) {return}
    if (!verificaPrezzoTotale(event, "imp", "iva", "cos_tot")) {return}
    salvaFattura();
}

function verificaNuovaFattura(event){
    if (!verificaConfrontoAnno(event)) {return}
    if (!verificaPercentualeIva(event, "nuovo_imp", "nuova_iva")) {return}
    if (!verificaPrezzoTotale(event, "nuovo_imp", "nuova_iva", "nuovo_cos_tot")) {return}
}

/* CONTROLLO PREZZI FATTURA */
const formatter = new Intl.NumberFormat('it-IT', {minimumFractionDigits: 2, maximumFractionDigits: 2, useGrouping: "always"});

function leggiValorePrezzo(id) {
    // operazioni fatte in ordine: tolto euro, tolti spazi, sostituiti separatori
    return Number(document.getElementById(id).value.replace(" €", "").replace(".", "").replace(",", "."));
}

function verificaPercentualeIva(event, id_imp, id_iva){
    if (document.getElementById(id_iva).value !== ""){ // se campo iva non è vuoto fa controllo
        let imponibile = leggiValorePrezzo(id_imp);
        let iva = leggiValorePrezzo(id_iva);
        let percentuale = iva / imponibile;
        if (percentuale < 0.10 || percentuale > 0.25) {
            event.preventDefault();
            creaMessaggioErrore("L'iva dovrebbe essere compresa tra il 10% e 25%. <br>Ricontrolla i dati inseriti.");
            return false;
        }
    }
    return true;
}

/* CON LA FUNZIONE calcolaTotale() QUESTA FUNZIONE PRATICAMENTE NON VIENE USATA POICHE SEMPRE VERA */
function verificaPrezzoTotale(event, id_imp, id_iva, id_tot) {
    if (document.getElementById(id_imp).value !== "" && document.getElementById(id_iva).value !== ""){ // se campi imp e iva non sono vuoti fa controllo
        let imponibile = leggiValorePrezzo(id_imp);
        let iva = leggiValorePrezzo(id_iva);
        let totale = leggiValorePrezzo(id_tot);
        // confronta somma e totale
        if ((imponibile + iva).toFixed(2) !== totale.toFixed(2)){
            event.preventDefault();
            creaMessaggioErrore("Il costo totale della fattura non corrisponde alla somma dei suoi campi. <br>Ricontrolla i dati inseriti.");
            return false;
        }
    }
    return true;
}

function verificaConfrontoAnno(event) {  // verifica che anno in codice fattura e anno in data corrispondono
    const [cod, cod_anno, cod_num] = document.getElementById("nuovo_num_fat").value.split("-");
    const [giorno_fat, mese_fat, anno_fat] = document.getElementById("nuova_data_fat").value.split("/");
    if (cod_anno !== anno_fat) {
        event.preventDefault();
        creaMessaggioErrore("L'anno nel codice della fattura e l'anno della data inserita non corrispondono! <br>Ricontrolla i dati inseriti.");
        return false;
    }
    return true;
}

/* MODIFICA AUTOMATICAMENTE PREZZO TOTALE INSERITO IN FATTURA SOMMANDO ADDENDI */
function calcolaTotale(id_imp, id_iva, id_tot) {
    const campoImp = document.getElementById(id_imp);
    const campoIva = document.getElementById(id_iva);
    const campoTot = document.getElementById(id_tot);

    if (campoImp.value!=="" && campoIva.value !== "") {
        const imp = leggiValorePrezzo(id_imp);
        const iva = leggiValorePrezzo(id_iva);
        if (!isNaN(imp) && !isNaN(iva)) {
            campoImp.value = formatter.format(imp)+" €";
            campoIva.value = formatter.format(iva)+" €";
            campoTot.value = formatter.format(imp + iva)+" €";
        } else {
            campoTot.value = "";
        }
    } else {
        campoTot.value = "";
    }
}

/* FUNZIONI ELIMINAZIONE */
function confermaEliminazione(selezionate) {
    return new Promise(resolve => {
        creaMessaggioEliminazione(selezionate, resolve)
    });
}

function creaMessaggioEliminazione(selezionate, resolve) { // in futuro possibilità di separare creazione messaggio in una funzione separata
    let messaggio;
    if (selezionate === 1){
        messaggio = "Stai eliminando una fattura.";
    } else {
        messaggio = "Stai eliminando " + selezionate + " fatture.";
    }
    document.getElementById("messaggio_popup").innerHTML = `
        <div class="contenuto-eliminazione">
            <div class="testo-popup">
                ${messaggio}<br>
                Per confermare digita ELIMINA nella casella sottostante.
            </div>
            <input type=text id="testo_conferma" placeholder="Inserisci qui">
        </div>
        <button id="pulsante_conferma" disabled>Elimina definitivamente</button>
    `;
    document.getElementById("popup").style.display = "flex";   // apre popup

    const input = document.getElementById("testo_conferma");
    const pulsante = document.getElementById("pulsante_conferma");

    input.addEventListener("input", () => {
        const valido = input.value === "ELIMINA";
        pulsante.disabled = !valido;  // disabled deve essere il contrario di valido
        pulsante.classList.toggle("abilitato", valido); // se valido=true aggiunge "abilitato", in caso contrario lo toglie
    });
    pulsante.addEventListener("click", () => {
        chiudiPopup();
        resolve(true);
    });
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