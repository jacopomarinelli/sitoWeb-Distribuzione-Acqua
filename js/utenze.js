/* CONTROLLO GENERALE */
function verificaUtenza(event) {
    verificaCronologicamenteDate(event);
}

/* CONTROLLO CHE DATA CHIUSURA SIA DOPO DATA APERTURA */
function verificaCronologicamenteDate(event) {
    let apertura = new Date(document.getElementById("data_ap").value);
    let chiusura = new Date(document.getElementById("data_ch").value);
    if (apertura > chiusura){
        event.preventDefault();
        creaMessaggioErrore("La data di chiusura precede la data di apertura.");
        apriPopup();
    }
}