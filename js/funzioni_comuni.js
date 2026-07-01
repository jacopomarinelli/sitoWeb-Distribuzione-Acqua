/* FUNZIONE WIDGET DATA */
$(function () {
    $.datepicker.setDefaults($.datepicker.regional["it"]); // mette in italiano
    $(".widget-data").datepicker({  // aggiunge widget a tutti elementi con classe widget-data
        dateFormat: "dd/mm/yy",  // selezione formato 
        firstDay: 1, // parte da lunedì
        changeMonth: true,
        changeYear: true,
        yearRange: "2020:2030"
    });
});

/* FUNZIONI POPUP */
function creaMessaggioErrore(messaggio) {  // mostra messaggio di errore nel popup
    document.getElementById("messaggio_popup").innerHTML = `
        <i class="fa-solid fa-triangle-exclamation icona-popup"></i>
        <div class="testo-popup">
            ${messaggio}
        </div>
    `;
    document.getElementById("popup").style.display = "flex";   // apre popup
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