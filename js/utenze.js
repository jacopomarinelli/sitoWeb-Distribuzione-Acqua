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

/* CONTROLLO SU STATO E DATA DI CHIUSURA */
function verificaStato() {  // abilita e disabilita la data di chiusura
    var data = document.getElementById("data_ch");
    var stato = document.querySelector(".attività input[type='radio']:checked")?.value;
    if (stato ===  "attiva") {
        data.classList.add("data_non_ammessa");  // aggiunge classe 
        data.disabled = true;  // disabilita campo data
        data.value = "";  // svuota scelta già presente
    } else {
        data.classList.remove("data_non_ammessa");  // rimuove classe
        data.disabled = false;  // abilita campo data
    }
}