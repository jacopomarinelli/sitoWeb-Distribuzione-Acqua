/* FUNZIONI POPUP */
function creaMessaggioErrore(messaggio) {  // mostra messaggio di errore nel popup
    document.getElementById("messaggio_popup").innerHTML = `
        <i class="fa-solid fa-triangle-exclamation icona-popup"></i>
        <div class="testo-popup">
            ${messaggio}<br>
            Ricontrolla i dati inseriti.
        </div>
    `;
}

function apriPopup() { 
    document.getElementById("popup").style.display = "flex";
}

function chiudiPopup() {
    document.getElementById("messaggio_popup").innerText = "";  // pulisce contenuto del popup
    document.getElementById("popup").style.display = "none";
}

function chiudiSeFuori(event) {
    if (event.target.id === "popup") {
        chiudiPopup();
    }
}