/* CONTROLLO GENERALE */
function verificaUtenza(event) {
    if (!verificaCronologicamenteDate(event)) {return};
    salvaUtenza();
}


/* CONTROLLO CHE DATA CHIUSURA SIA DOPO DATA APERTURA */
function modificaTipoData(id_data) {
    const valore = document.getElementById(id_data).value;
    const [giorno, mese, anno] = valore.split("/");
    return new Date(anno, mese-1, giorno);
}

function verificaCronologicamenteDate(event) {
    let apertura = modificaTipoData("data_ap");
    let chiusura = modificaTipoData("data_ch");
    if (apertura > chiusura){
        event.preventDefault();
        creaMessaggioErrore("La data di chiusura precede la data di apertura. <br>Ricontrolla i dati inseriti.");
        return false;
    }
    return true;
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

/* SALVA DATI DELLA RICERCA */
function salvaUtenza() {
    const utenza = {
        cod_utenza: document.getElementById("cod_ut").value,
        cod_cliente: document.getElementById("cod_cli").value,
        indirizzo: document.getElementById("ind").value,
        città: document.getElementById("cit_ut").value,
        attiva: document.getElementById("attiva").value,
        disattiva: document.getElementById("disattiva").value,
        data_apertura: document.getElementById("data_ap").value,
        data_chiusura: document.getElementById("data_ch").value
    };
    sessionStorage.setItem(
        "ricercaUtenza",
        JSON.stringify(utenza)
    );
}
document.addEventListener("DOMContentLoaded", function() {
    const dati = JSON.parse(
        sessionStorage.getItem("ricercaUtenza")
    );

    if (!dati) return;
    document.getElementById("cod_ut").value = dati.cod_utenza;
    document.getElementById("cod_cli").value = dati.cod_cliente;
    document.getElementById("ind").value = dati.indirizzo;
    document.getElementById("cit_ut").value = dati.città;
    document.getElementById("attiva").value = dati.attiva;
    document.getElementById("disattiva").value = dati.disattiva;
    document.getElementById("data_ap").value = dati.data_apertura;
    document.getElementById("data_ch").value = dati.data_chiusura;
});